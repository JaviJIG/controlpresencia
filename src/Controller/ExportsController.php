<?php 
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
// Prior to 3.6 use Cake\Network\Exception\NotFoundException
use Cake\Http\Exception\NotFoundException;

use Cake\Utility\Hash;

class ExportsController extends AppController
{

    public function index() {
        $this->set('csrf', $this->request->getParam('_csrfToken'));

        $this->loadModel('Buildings');
        // $this->loadModel('Rooms');
        $this->loadModel('Staffs');
        $this->loadModel('Logs');

        if ($this->request->is('post')) {
            $data = $this->request->data;
            $conditions = [];
            if (!empty($data['building_id'])) {
                array_push($conditions, 'Logs.building_id = '.$data['building_id']);
            }
            if (!empty($data['room_id'])) {
                array_push($conditions, 'Logs.room_id = '. $data['room_id']);
            }
            if (!empty($data['staff_id'])) {
                array_push($conditions, 'Logs.staff_id = '.$data['staff_id']);                
            }
            if (!empty($data['fecha_ini'])) {
                array_push($conditions, 'Logs.timestamp >= "'. $this->dayAsSql($data['fecha_ini']).' 00:00:00"');
            }
            if (!empty($data['fecha_fin'])) {
                array_push($conditions, 'Logs.timestamp <= "'.$this->dayAsSql($data['fecha_fin']).' 23:59:59"');
            }
            $logs = $this->Logs->find()->where($conditions)->contain(['Buildings', 'Rooms', 'Staffs', 'Actions'])->order(['Logs.timestamp' => 'ASC']);

            $this->loadComponent('PhpExcel');

            $PhpExcel=$this->PhpExcel;
            $PhpExcel->createExcel();

            //Comenzamos a generar el excel
            $PhpExcel->writeCellValue('A1', 'Edificio');
            $PhpExcel->writeCellValue('B1', 'Sala');
            $PhpExcel->writeCellValue('C1', 'Empleado');
            $PhpExcel->writeCellValue('D1', 'Acción');
            $PhpExcel->writeCellValue('E1', 'Latitud');
            $PhpExcel->writeCellValue('F1', 'Longitud');
            $PhpExcel->writeCellValue('G1', 'Dia y Hora');
            $PhpExcel->writeCellValue('H1', 'Marca teléfono');
            // Pintamos la parte superior
            $PhpExcel->fillCellColour('A1', 'b8ff4d');
            $PhpExcel->fillCellColour('B1', 'b8ff4d');
            $PhpExcel->fillCellColour('C1', 'b8ff4d');
            $PhpExcel->fillCellColour('D1', 'b8ff4d');
            $PhpExcel->fillCellColour('E1', 'b8ff4d');
            $PhpExcel->fillCellColour('F1', 'b8ff4d');
            $PhpExcel->fillCellColour('G1', 'b8ff4d');
            $PhpExcel->fillCellColour('H1', 'b8ff4d');


            $contador = 2;
            foreach ($logs as $log) {
                $PhpExcel->writeCellValue('A'.$contador, $log->building->name);
                $PhpExcel->writeCellValue('B'.$contador, (isset($log->room->name) ? $log->room->name : ''));
                $PhpExcel->writeCellValue('C'.$contador, $log->staff->name. ' '. $log->staff->surnames);
                $PhpExcel->writeCellValue('D'.$contador, $log->action->name);
                $PhpExcel->writeCellValue('E'.$contador, $log->latitude);
                $PhpExcel->writeCellValue('F'.$contador, $log->longitude);
                $PhpExcel->writeCellValue('G'.$contador, $log->timestamp->i18nFormat('dd-MM-YYYY HH:mm'));
                $PhpExcel->writeCellValue('H'.$contador, $log->brand);
                
                $contador++;
            }

            $archivo = 'Exportacion_'.date('Y-m-d');
            $PhpExcel->downloadFile($archivo);
        }
        $buildings = $this->Buildings->find()->select(['id', 'name']);
        // $rooms = $this->Rooms->find()->select(['id', 'name']);
        $staffs = $this->Staffs->find()->select(['id', 'name', 'surnames']);

        $this->set(compact('buildings', 'staffs'));
    }

    public function getRooms() {
        $this->autoRender = false;
        $this->loadModel('Rooms');
        $master = ['id' => '', 'name' => ''];
        $salas = $this->Rooms->find()->select(['id', 'name'])->where(['building_id' => $this->request->data['building_id']])->toArray();
        $return = [];
        $contador = 0;
        foreach ($salas as $sala) {
            $sala = json_decode(json_encode($sala),1);
            $return[$contador] = array_intersect_key($sala,$master);
            $contador++;
        }
        echo \json_encode($return);

    }
}
