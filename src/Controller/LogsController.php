<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Logs Controller
 *
 * @property \App\Model\Table\LogsTable $Logs
 *
 * @method \App\Model\Entity\Log[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LogsController extends AppController
{

    public function isAuthorized($user)
    {
        if ($user['role'] == 'user' && in_array($this->request->getParam('action'), ['index'])) {
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
                'contain' => ['Buildings', 'Rooms', 'Staffs', 'Actions'],
                
            ];
            $this->paginate['order'] = ['timestamp' => 'DESC'];
            $logs = $this->paginate($this->Logs);
            $this->set(compact('logs'));
        }
        if($userRole == 'user') {
            $log = $this->Logs->find('all')
            ->join([
                'Buildings' => [
                    'table' => 'buildings',
                    'type' => 'INNER',
                    'conditions' => 'Logs.building_id = Buildings.id',
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
                'contain' => ['Buildings', 'Rooms', 'Staffs', 'Actions'],
            ];
            $logs = $this->paginate($log);
            $this->set(compact('logs'));
        }
    }

    /**
     * View method
     *
     * @param string|null $id Log id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $log = $this->Logs->get($id, [
            'contain' => ['Buildings', 'Rooms', 'Staffs', 'Actions'],
        ]);

        $this->set('log', $log);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $log = $this->Logs->newEntity();
        if ($this->request->is('post')) {
            $log = $this->Logs->patchEntity($log, $this->request->getData());
            if ($this->Logs->save($log)) {
                $this->Flash->success(__('The log has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The log could not be saved. Please, try again.'));
        }
        $buildings = $this->Logs->Buildings->find('list', ['limit' => 200]);
        $rooms = $this->Logs->Rooms->find('list', ['limit' => 200]);
        $staffs = $this->Logs->Staffs->find('list', ['limit' => 200]);
        $actions = $this->Logs->Actions->find('list', ['limit' => 200]);
        $this->set(compact('log', 'buildings', 'rooms', 'staffs', 'actions'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Log id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $log = $this->Logs->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $log = $this->Logs->patchEntity($log, $this->request->getData());
            if ($this->Logs->save($log)) {
                $this->Flash->success(__('The log has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The log could not be saved. Please, try again.'));
        }
        $buildings = $this->Logs->Buildings->find('list', ['limit' => 200]);
        $rooms = $this->Logs->Rooms->find('list', ['limit' => 200]);
        $staffs = $this->Logs->Staffs->find('list', ['limit' => 200]);
        $actions = $this->Logs->Actions->find('list', ['limit' => 200]);
        $this->set(compact('log', 'buildings', 'rooms', 'staffs', 'actions'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Log id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $log = $this->Logs->get($id);
        if ($this->Logs->delete($log)) {
            $this->Flash->success(__('The log has been deleted.'));
        } else {
            $this->Flash->error(__('The log could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
