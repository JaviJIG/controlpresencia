<?php
namespace App\Controller;
use App\Controller\AppController;

/**
 * Buildings Controller
 *
 * @property \App\Model\Table\BuildingsTable $Buildings
 *
 * @method \App\Model\Entity\Building[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BuildingsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $buildings = $this->paginate($this->Buildings);

        $this->set(compact('buildings'));
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
        $building = $this->Buildings->get($id, ['contain' => [
            'Logs' => ['Buildings', 'Rooms', 'Staffs', 'Actions', 'sort' => ['Logs.timestamp' => 'DESC']]]
            ]);

        $this->set('building', $building);
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
