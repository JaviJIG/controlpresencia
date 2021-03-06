<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Core\Configure;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false,
        ]);
        $this->loadComponent('Flash');
        $this->loadComponent('Auth', [
            'authorize' => ['Controller'],
            'authError' => 'No tienes permiso suficiente para acceder a este apartado.',
            'loginRedirect' => [
                'controller' => 'buildings',
                'action' => 'index'
            ],
            'logoutRedirect' => [
                'controller' => 'users',
                'action' => 'login'
            ]
        ]);

        /*
         * Enable the following component for recommended CakePHP security settings.
         * see https://book.cakephp.org/3/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
    }
    
    public function beforeFilter(Event $event)
    {
        $userName = $this->Auth->user('username');
        $userRole = $this->Auth->user('role');
        $baseUrl = Configure::read('Url.Base');
        $ajaxUrl = Configure::read('Url.Ajax');
        $this->set(compact('userName', 'userRole', 'baseUrl', 'ajaxUrl'));
    }

    public function isAuthorized($user)
    {
        // Admin can access every action
        if (isset($user['role']) && $user['role'] === 'admin') {
            return true;
        }

        // Default deny
        return false;
    }

    public function generaUrl(){
        return uniqid();
    }

    /**
     * Convierte una fecha dd/mm/yyyy al formato de sql
     */
    public function dayAsSql($fecha) {
		$mifecha = explode("/", $fecha);
		if (isset($mifecha[0]) && isset($mifecha[1]) && isset($mifecha[2])){
			return $mifecha[2]."-".$mifecha[1]."-".$mifecha[0];
		} else {
			return null;
		}
    }
}
