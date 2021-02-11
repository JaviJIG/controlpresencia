<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Rooms Controller
 *
 * @property \App\Model\Table\RoomsTable $Rooms
 *
 * @method \App\Model\Entity\Room[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RoomsController extends AppController
{

    public function isAuthorized($user)
    {
        if ($user['role'] == 'user' && in_array($this->request->getParam('action'), ['index', 'view'])) {
            return true;
        }
        return parent::isAuthorized($user);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $userRole = $this->Auth->user('role');
        if($userRole == 'admin') {
            $this->paginate = [
                'contain' => ['Buildings'],
            ];
            $rooms = $this->paginate($this->Rooms);
    
            $this->set(compact('rooms'));
        }
        if($userRole == 'user') {
            $room = $this->Rooms->find('all')
            ->join([
                'Buildings' => [
                    'table' => 'buildings',
                    'type' => 'INNER',
                    'conditions' => 'Rooms.building_id = Buildings.id',
                ],
                'UserBuilding' => [
                    'table' => 'user_buildings',
                    'type' => 'INNER',
                    'conditions' => 'UserBuilding.building_id = Buildings.id',
                ],
            ])
            ->where([
                'UserBuilding.user_id' => $this->Auth->user('id')
            ]);
            $this->paginate = [
                'contain' => ['Buildings'],
            ];
            $rooms = $this->paginate($room);
            $this->set(compact('rooms'));
        }



    }

    /**
     * View method
     *
     * @param string|null $id Room id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $puedeVer = $this->Rooms->find('all')
            ->join([
                'Buildings' => [
                    'table' => 'buildings',
                    'type' => 'INNER',
                    'conditions' => 'Rooms.building_id = Buildings.id',
                ],
                'UserBuilding' => [
                    'table' => 'user_buildings',
                    'type' => 'INNER',
                    'conditions' => 'UserBuilding.building_id = Buildings.id',
                ]
            ])
            ->where([
                'UserBuilding.user_id' => $this->Auth->user('id'),
                'Rooms.id' => $id
            ])
            ->toArray();
        if (empty($puedeVer) && $this->Auth->user('role') == 'user') {
            $this->Flash->error(__('No puede acceder a ver la sala, por favor, elija los que tiene disponibles en la siguiente lista.'));

            return $this->redirect(['action' => 'index']);
        }
        $room = $this->Rooms->get($id, [
            'contain' => ['Buildings', 'Logs'  => ['Buildings', 'Rooms', 'Staffs', 'Actions', 'sort' => ['Logs.timestamp' => 'DESC']]],
        ]);

        $this->set('room', $room);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $room = $this->Rooms->newEntity();
        if ($this->request->is('post')) {
            $room = $this->Rooms->patchEntity($room, $this->request->getData());
            $room['url'] = $this->generaUrl();
            if ($this->Rooms->save($room)) {
                $this->Flash->success(__('La sala ha sido guardada.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('no se ha podido guardar la sala, intentelo de nuevo.'));
        }
        $buildings = $this->Rooms->Buildings->find()->select(['id', 'name']);
        $this->set(compact('room', 'buildings'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Room id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $room = $this->Rooms->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $room = $this->Rooms->patchEntity($room, $this->request->getData());
            if ($this->Rooms->save($room)) {
                $this->Flash->success(__('La sala ha sido guardada.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('La sala no se ha podido guardar, intentelo de nuevo.'));
        }
        $buildings = $this->Rooms->Buildings->find()->select(['id', 'name']);
        $this->set(compact('room', 'buildings'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Room id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $room = $this->Rooms->get($id);
        if ($this->Rooms->delete($room)) {
            $this->Flash->success(__('La sala ha sido eliminada.'));
        } else {
            $this->Flash->error(__('No se ha podido eliminar la sala, intentelo de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }


    public function updateUrl(){
        $room = $this->request->data('room_id'); 
        $thisRoom = $this->Rooms->get($room);
        $thisRoom->url = $this->generaUrl();
        if($this->Rooms->save($thisRoom)){
            $this->Flash->success(__('Se ha actualizado la URL correctamente.'));
            return $this->redirect(['action' => 'view', $room]);
        } else {
            $this->Flash->error(__('No se ha podido actualizar. Por favor, intentelo de nuevo.'));
            return $this->redirect(['action' => 'view', $room]);
        }
    }
}
