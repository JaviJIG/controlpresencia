<?php 
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
// Prior to 3.6 use Cake\Network\Exception\NotFoundException
use Cake\Http\Exception\NotFoundException;

class FormController extends AppController
{

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        // Allow users to register and logout.
        // You should not add the "login" action to allow list. Doing so would
        // cause problems with normal functioning of AuthComponent.
        $this->Auth->allow(['acceso', 'getStaff', 'registerLog', 'success']);
    }

    public function acceso() {
        $this->set('csrf', $this->request->getParam('_csrfToken'));
        $this->viewBuilder()->setLayout('front');
        // Obtenemos los datos de la url ej: /form/acceso?building=fsgs45r&room=g6asd5fvgs5v1
        if (isset(array_keys($this->request->query())[0])) {
            $type =  array_keys($this->request->query())[0];
            $class = ucwords($type).'s';
            $other = $class == 'Rooms' ? 'Buildings' : 'Rooms';
            $value = $this->request->query($type);

            //Si se pasa vacio o es otro, pues que no ponga nai
            if (!in_array($class,['Rooms','Buildings'])) {
                $error = 'HA HABIDO UN PROBLEMA EN LA LLAMADA AL SERVIDOR';
                $this->set(compact('error'));
                $this->render('error');
            } else {
                // Hacemos la llamada respectiva
                $this->loadModel($class);
                $data = $this->{$class}->find()->where([$class.'.url' => $value])->contain([$other])->first();
                if (isset($data->building)) {
                    $roomName = $data->name;
                    $roomId = $data->id;
                    $buildingName = $data->building->name;
                    $buildingId = $data->building->id;
                    $this->set(compact('roomName', 'roomId', 'buildingName', 'buildingId'));
                }
                else {
                    if (isset($data->name)) {
                        $buildingName = $data->name;
                        $buildingId = $data->id;
                        $this->set(compact('buildingName', 'buildingId'));
                    }else {
                        $error = 'HA HABIDO UN PROBLEMA EN LA LLAMADA AL SERVIDOR';
                        $this->set(compact('error'));
                        $this->render('error');
                    }
                }
                $this->loadModel('Actions');
                $acciones = $this->Actions->find('list')->toArray();
                $this->set(compact('acciones'));
            }
        }
        else {
            $error = 'HA HABIDO UN PROBLEMA EN LA LLAMADA AL SERVIDOR';
            $this->set(compact('error'));
            $this->render('error');
        }
    }

    public function getStaff() {
        $this->autoRender = false;
        $codigo = $this->request->data('codigo');
        $this->loadModel('Staffs');
        $data = $this->Staffs->find()->where(['code' => $codigo])->first();
        if (isset($data->name)) {
            $respuesta = [
                'nombre' => $data->name,
                'apellidos' => $data->surnames,
                'id' => $data->id
            ];
            echo json_encode($respuesta);
        }
    }

    public function registerLog($data = null) {
        $this->autoRender = false;
        $this->loadModel('Logs');
        $log = $this->Logs->newEntity();
        if ($this->request->is('post') && $data == null) {
            $data = $this->request->getData();
            $data['timestamp'] = date('Y-m-d H:i:s', strtotime('+1 hours'));
            $log = $this->Logs->patchEntity($log, $data);
            //debug($log); die;
            if ($this->Logs->save($log)) {
                $this->redirect(['action' => 'registerLog', json_encode($data)]);
            }
            else {
                $this->Flash->error(__('No se ha registrado correctamente, por favor, intentelo de nuevo.'));
            }
        }
        else {
            // NO le llegan los datos a Data que le quiero pasar en el redirect de 5 lineas mas parriba, a por ello el lunes campeón! :) 
            // Atentamente tu yo del viernes
            $data = json_decode($data, 1);
            $this->loadModel('Buildings');
            $this->loadModel('Rooms');
            $this->loadModel('Staffs');
            $this->loadModel('Actions');
            $building = $this->Buildings->get($data['building_id'])->name;
            if (isset($data['room_id'])) {
                $room = $this->Rooms->get($data['room_id'])->name;
                $this->set(compact('room'));
            }
            $staffName = $this->Staffs->get($data['staff_id'])->name;
            $staffSurnames = $this->Staffs->get($data['staff_id'])->surnames;
            $action = $this->Actions->get($data['action_id'])->name;
            $fecha = $data['timestamp'];
            $this->viewBuilder()->setLayout('front');
            $this->set(compact('building','staffName', 'staffSurnames', 'action', 'fecha'));
            $this->render('success');
        }
    }
}