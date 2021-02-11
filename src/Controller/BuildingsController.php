<?php
namespace App\Controller;
use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Buildings Controller
 *
 * @property \App\Model\Table\BuildingsTable $Buildings
 *
 * @method \App\Model\Entity\Building[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BuildingsController extends AppController
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
            $buildings = $this->paginate($this->Buildings);

            $this->set(compact('buildings'));
        }
        if($userRole == 'user') {
            $build = $this->Buildings->find()
            ->join([
                'UserBuilding' => [
                    'table' => 'user_buildings',
                    'type' => 'INNER',
                    'conditions' => 'UserBuilding.building_id = Buildings.id',
                ],
            ])
            ->where([
                'UserBuilding.user_id' => $this->Auth->user('id')
            ]);
            $buildings = $this->paginate($build);
            $this->set(compact('buildings'));
        }
    }

    /**
     * View method
     *
     * @param string|null $id Building id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        // Comprobamos que este usuario puede ver esta building
        $tableUserBuildings = TableRegistry::getTableLocator()->get('UserBuildings');
        $puedeVer = $tableUserBuildings->find('all')->where(['user_id' => $this->Auth->user('id'), 'building_id' => $id])->toArray();
        if (empty($puedeVer) && $this->Auth->user('role') == 'user') {
            $this->Flash->error(__('No puede acceder a ver el edificio, por favor, elija los que tiene disponibles en la siguiente lista.'));

            return $this->redirect(['action' => 'index']);
        }

        $filtros = [['Buildings.id' => $id]];

        if ($this->request->is('post')) {
            $datos = $this->request->data;
            if ($datos['staff_id'] != '') {
                array_push($filtros, ['Logs.staff_id' => $datos['staff_id']]);
                $this->set($datos['staff_id'], 'staff_id');
            }
            if ($datos['action_id'] != '') {
                array_push($filtros, ['Logs.action_id' => $datos['action_id']]);
                $this->set($datos['action_id'], 'action_id');
            }
            if ($datos['fecha_inicio'] != '') {
                array_push($filtros, ['Logs.timestamp >=' => $this->dayAsSql($datos['fecha_inicio']).' 00:00:00']);
                $this->set($datos['fecha_inicio'], 'fecha_inicio');
            }
            if ($datos['fecha_fin'] != '') {
                array_push($filtros, ['Logs.timestamp <=' => $this->dayAsSql($datos['fecha_fin']).' 23:59:59']);
                $this->set($datos['fecha_fin'], 'fecha_fin');
            }
        }
        if ($this->request->is('get')) {
            if (isset($_SESSION['Building']['Filters'][$id])) {
                $filtros = $_SESSION['Building']['Filters'][$id];
            }
        }
        $this->set('filtros', $filtros);
        $tableLogs = TableRegistry::getTableLocator()->get('Logs');
        $logs = $tableLogs->find('all')
        ->join([
            'Buildings' => [
                'table' => 'buildings',
                'type' => 'INNER',
                'conditions' => 'Logs.building_id = Buildings.id',
            ],
        ])
        ->where($filtros)
        ->order(['Logs.timestamp' => 'desc']);

        $this->paginate = [
            'contain' => ['Buildings', 'Rooms', 'Staffs', 'Actions'],
        ];
        $logs = $this->paginate($logs);
        // Si buildings no tiene ningun log, cargamos el building nada más
        $primero = $logs->first();
        if (empty($primero)) {
            $building = $this->Buildings->find('all')->where(['Buildings.id' => $id]);

            $this->set('building', $building->first());
        }
        $this->set('logs', $logs);


        $staffsQuery = TableRegistry::getTableLocator()->get('Staffs');
        $staffs = $staffsQuery->find('all')
            ->join([
                'Logs' => [
                    'table' => 'logs',
                    'type' => 'INNER',
                    'conditions' => 'Logs.staff_id = Staffs.id'
                ],
            ])
            ->where(['Logs.building_id' => $id])
            ->group(['Staffs.code'])
            ->toArray();
        $actionsQuery = TableRegistry::getTableLocator()->get('Actions');
        $actions = $actionsQuery->find('all')
            ->join([
                'Logs' => [
                    'table' => 'logs',
                    'type' => 'INNER',
                    'conditions' => 'Logs.action_id = Actions.id'
                ],
            ])
            ->where(['Logs.building_id' => $id])
            ->group(['Actions.name'])
            ->toArray();
        $this->set(compact('staffs', 'actions'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $building = $this->Buildings->newEntity();
        if ($this->request->is('post')) {
            $building = $this->Buildings->patchEntity($building, $this->request->getData());
            $building['url'] = $this->generaUrl();
            if ($this->Buildings->save($building)) {
                $this->Flash->success(__('El nuevo edificio ha sido guardado.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se ha podido guardar el edificio, pruebe de nuevo.'));
        }
        $this->set(compact('building'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Building id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $building = $this->Buildings->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $building = $this->Buildings->patchEntity($building, $this->request->getData());
            if ($this->Buildings->save($building)) {
                $this->Flash->success(__('El edificio ha sido guardado.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se ha podido guardar el edificio, pruebe de nuevo.'));
        }
        $this->set(compact('building'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Building id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $building = $this->Buildings->get($id);
        if ($this->Buildings->delete($building)) {
            $this->Flash->success(__('El edificio ha sido eliminado.'));
        } else {
            $this->Flash->error(__('The building could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }


    public function updateUrl(){
        $build = $this->request->data('room_id'); 
        $thisBuild = $this->Buildings->get($build);
        $thisBuild->url = $this->generaUrl();
        if($this->Buildings->save($thisBuild)){
            $this->Flash->success(__('Se ha actualizado la URL correctamente.'));
            return $this->redirect(['action' => 'view', $build]);
        } else {
            $this->Flash->error(__('No se ha podido actualizar. Por favor, intentelo de nuevo.'));
            return $this->redirect(['action' => 'view', $build]);
        }
    }
}
