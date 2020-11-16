<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Staffs Controller
 *
 * @property \App\Model\Table\StaffsTable $Staffs
 *
 * @method \App\Model\Entity\Staff[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class StaffsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $staffs = $this->paginate($this->Staffs);

        $this->set(compact('staffs'));
    }

    /**
     * View method
     *
     * @param string|null $id Staff id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        // $staff = $this->Staffs->get($id, [
        //     'contain' => ['Logs'],
        // ]);
        $staff = $this->Staffs->get($id, [
            'contain' => [
                'Logs' => [
                    'Buildings', 'Rooms', 'Actions'
                ]
            ],
        ]);

        $this->set(compact('staff'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $staff = $this->Staffs->newEntity();
        if ($this->request->is('post')) {
            $staff = $this->Staffs->patchEntity($staff, $this->request->getData());
            if ($this->Staffs->save($staff)) {
                $this->Flash->success(__('The staff has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The staff could not be saved. Please, try again.'));
        }
        $this->set(compact('staff'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Staff id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $staff = $this->Staffs->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $staff = $this->Staffs->patchEntity($staff, $this->request->getData());
            if ($this->Staffs->save($staff)) {
                $this->Flash->success(__('The staff has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The staff could not be saved. Please, try again.'));
        }
        $this->set(compact('staff'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Staff id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $staff = $this->Staffs->get($id);
        if ($this->Staffs->delete($staff)) {
            $this->Flash->success(__('The staff has been deleted.'));
        } else {
            $this->Flash->error(__('The staff could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
