<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * UserBuildings Controller
 *
 * @property \App\Model\Table\UserBuildingsTable $UserBuildings
 *
 * @method \App\Model\Entity\UserBuilding[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UserBuildingsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index($id = null)
    {
        if ($id == null) {
            $this->Flash->error(__('No se ha detectado usuario.'));
            return $this->redirect(['controller' => 'users','action' => 'index']);
        }
        $this->paginate = [
            'contain' => ['Users', 'Buildings'],
        ];
        $userBuildings = $this->paginate($this->UserBuildings->find()->where(['Users.id' => $id]));
        $buildings = TableRegistry::getTableLocator()->get('Buildings');
        $buildings = $buildings->find()->toArray();
        //Datos por si no hay info en buildings
        $tableUsers = TableRegistry::getTableLocator()->get('Users');
        $username = $tableUsers->find()->select(['Users.username', 'Users.id'])->where(['Users.id' => $id])->toArray();
        $userId = $username[0]->id;
        $username = $username[0]->username;

        $this->set(compact('userBuildings', 'buildings', 'username', 'userId'));
    }

    /**
     * View method
     *
     * @param string|null $id User Building id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $userBuilding = $this->UserBuildings->get($id, [
            'contain' => ['Users', 'Buildings'],
        ]);

        $this->set('userBuilding', $userBuilding);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $userBuilding = $this->UserBuildings->newEntity();
        if ($this->request->is('post')) {
            $userBuilding = $this->UserBuildings->patchEntity($userBuilding, $this->request->getData());
            if ($this->UserBuildings->save($userBuilding)) {
                $this->Flash->success(__('The user building has been saved.'));

                return $this->redirect(['action' => 'index', $this->request->getData('user_id')]);
            }
            $this->Flash->error(__('The user building could not be saved. Please, try again.'));
        }
        $users = $this->UserBuildings->Users->find('list', ['limit' => 200]);
        $buildings = $this->UserBuildings->Buildings->find('list', ['limit' => 200]);
        $this->set(compact('userBuilding', 'users', 'buildings'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User Building id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $userBuilding = $this->UserBuildings->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $userBuilding = $this->UserBuildings->patchEntity($userBuilding, $this->request->getData());
            if ($this->UserBuildings->save($userBuilding)) {
                $this->Flash->success(__('The user building has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user building could not be saved. Please, try again.'));
        }
        $users = $this->UserBuildings->Users->find('list', ['limit' => 200]);
        $buildings = $this->UserBuildings->Buildings->find('list', ['limit' => 200]);
        $this->set(compact('userBuilding', 'users', 'buildings'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User Building id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $userBuilding = $this->UserBuildings->get($id);
        if ($this->UserBuildings->delete($userBuilding)) {
            $this->Flash->success(__('The user building has been deleted.'));
        } else {
            $this->Flash->error(__('The user building could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index', $userBuilding->user_id]);
    }
}
