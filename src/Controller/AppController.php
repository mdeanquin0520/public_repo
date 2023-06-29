<?php
declare(strict_types=1);

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

use Cake\Event\EventInterface;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/4/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('FormProtection');`
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();

		$serverName = $this->request->getEnv('SERVER_NAME');
        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false,
        ]);
        $this->loadComponent('Flash');

        $this->loadComponent('Acl', [
            'className' => 'Acl.Acl'
        ]);

        $this->loadComponent('Auth', [
            'authorize' => [
                'Acl.Actions' => [
                  'actionPath' => 'controllers/', 
                  'userModel' => 'Users'
                 ]
            ],
            'authenticate' => [
                'Form' => [
                    'fields' => ['username' => 'username'],
                    'userModel' => 'Users'
                ],
            ],
            'loginAction' => [
                'plugin' => false,
                'controller' => 'Users',
                'action' => 'login'
            ],
            'loginRedirect' => [
                'plugin' => null,
                'controller' => 'Home',
                'action' => 'index'
            ],
            'logoutRedirect' => [
                'plugin' => null,
                'controller' => 'Users',
                'action' => 'login'
            ],
            'unauthorizedRedirect' => [
                'plugin' => null,
                'controller' => 'Home',
                'action' => 'index',
                'prefix' => false
            ],
            'authError' => 'No está autorizado a ingresar a esa página.',
            'flash' => [
                'element' => 'error'
            ]
        ]);

        /*
         * Enable the following component for recommended CakePHP form protection settings.
         * see https://book.cakephp.org/4/en/controllers/components/form-protection.html
         */
        //$this->loadComponent('FormProtection');
    }

	public function beforeFilter(EventInterface $event)
	{
		parent::beforeFilter($event);
        $this->loadModel('Profiles');
		$this->loadModel('Users');
		$id = $this->Auth->user('id');
		$this->set('id', $id);
		$profile_id = $this->Auth->user('profile_id');
		if(!empty($profile_id)){
			$profile = $this->Profiles->get($profile_id);
			$checkEA1 = $this->Acl->check($profile, 'Events/add');
			$this->set('checkEA1', $checkEA1);
			$checkEA2 = $this->Acl->check($profile, 'Events/add', 'create');
			$this->set('checkEA2', $checkEA2);
			$checkED1 = $this->Acl->check($profile, 'Events/delete');
			$this->set('checkED1', $checkED1);
			$checkED2 = $this->Acl->check($profile, 'Events/delete', 'delete');
			$this->set('checkED2', $checkED2);
			$checkEE1 = $this->Acl->check($profile, 'Events/edit');
			$this->set('checkEE1', $checkEE1);
			$checkEE2 = $this->Acl->check($profile, 'Events/edit', 'update');
			$this->set('checkEE2', $checkEE2);
			$checkEI1 = $this->Acl->check($profile, 'Events/index');
			$this->set('checkEI1', $checkEI1);
			$checkEI2 = $this->Acl->check($profile, 'Events/index', 'create');
			$this->set('checkEI2', $checkEI2);
			$checkEI3 = $this->Acl->check($profile, 'Events/index', 'read');
			$this->set('checkEI3', $checkEI3);
			$checkEI4 = $this->Acl->check($profile, 'Events/index', 'update');
			$this->set('checkEI4', $checkEI4);
			$checkEI5 = $this->Acl->check($profile, 'Events/index', 'delete');
			$this->set('checkEI5', $checkEI5);
			$checkEV1 = $this->Acl->check($profile, 'Events/view');
			$this->set('checkEV1', $checkEV1);
			$checkEV2 = $this->Acl->check($profile, 'Events/view', 'create');
			$this->set('checkEV2', $checkEV2);
			$checkEV3 = $this->Acl->check($profile, 'Events/view', 'read');
			$this->set('checkEV3', $checkEV3);
			$checkEV4 = $this->Acl->check($profile, 'Events/view', 'update');
			$this->set('checkEV4', $checkEV4);
			$checkEV5 = $this->Acl->check($profile, 'Events/view', 'delete');
			$this->set('checkEV5', $checkEV5);
			$checkGA1 = $this->Acl->check($profile, 'Groups/add');
			$this->set('checkGA1', $checkGA1);
			$checkGA2 = $this->Acl->check($profile, 'Groups/add', 'create');
			$this->set('checkGA2', $checkGA2);
			$checkGD1 = $this->Acl->check($profile, 'Groups/delete');
			$this->set('checkGD1', $checkGD1);
			$checkGD2 = $this->Acl->check($profile, 'Groups/delete', 'delete');
			$this->set('checkGD2', $checkGD2);
			$checkGE1 = $this->Acl->check($profile, 'Groups/edit');
			$this->set('checkGE1', $checkGE1);
			$checkGE2 = $this->Acl->check($profile, 'Groups/edit', 'update');
			$this->set('checkGE2', $checkGE2);
			$checkGI1 = $this->Acl->check($profile, 'Groups/index');
			$this->set('checkGI1', $checkGI1);
			$checkGI2 = $this->Acl->check($profile, 'Groups/index', 'create');
			$this->set('checkGI2', $checkGI2);
			$checkGI3 = $this->Acl->check($profile, 'Groups/index', 'read');
			$this->set('checkGI3', $checkGI3);
			$checkGI4 = $this->Acl->check($profile, 'Groups/index', 'update');
			$this->set('checkGI4', $checkGI4);
			$checkGI5 = $this->Acl->check($profile, 'Groups/index', 'delete');
			$this->set('checkGI5', $checkGI5);
			$checkGV1 = $this->Acl->check($profile, 'Groups/view');
			$this->set('checkGV1', $checkGV1);
			$checkGV2 = $this->Acl->check($profile, 'Groups/view', 'create');
			$this->set('checkGV2', $checkGV2);
			$checkGV3 = $this->Acl->check($profile, 'Groups/view', 'read');
			$this->set('checkGV3', $checkGV3);
			$checkGV4 = $this->Acl->check($profile, 'Groups/view', 'update');
			$this->set('checkGV4', $checkGV4);
			$checkGV5 = $this->Acl->check($profile, 'Groups/view', 'delete');
			$this->set('checkGV5', $checkGV5);
			$checkIA1 = $this->Acl->check($profile, 'Institutions/add');
			$this->set('checkIA1', $checkIA1);
			$checkIA2 = $this->Acl->check($profile, 'Institutions/add', 'create');
			$this->set('checkIA2', $checkIA2);
			$checkID1 = $this->Acl->check($profile, 'Institutions/delete');
			$this->set('checkID1', $checkID1);
			$checkID2 = $this->Acl->check($profile, 'Institutions/delete', 'delete');
			$this->set('checkID2', $checkID2);
			$checkIE1 = $this->Acl->check($profile, 'Institutions/edit');
			$this->set('checkIE1', $checkIE1);
			$checkIE2 = $this->Acl->check($profile, 'Institutions/edit', 'update');
			$this->set('checkIE2', $checkIE2);
			$checkIG1 = $this->Acl->check($profile, 'Institutions/getInstitutionsMarkers');
			$this->set('checkIG1', $checkIG1);
			$checkIG2 = $this->Acl->check($profile, 'Institutions/getInstitutionsMarkers', 'create');
			$this->set('checkIG2', $checkIG2);
			$checkIG3 = $this->Acl->check($profile, 'Institutions/getInstitutionsMarkers', 'read');
			$this->set('checkIG3', $checkIG3);
			$checkIG4 = $this->Acl->check($profile, 'Institutions/getInstitutionsMarkers', 'update');
			$this->set('checkIG4', $checkIG4);
			$checkIG5 = $this->Acl->check($profile, 'Institutions/getInstitutionsMarkers', 'delete');
			$this->set('checkIG5', $checkIG5);
			$checkII1 = $this->Acl->check($profile, 'Institutions/index');
			$this->set('checkII1', $checkII1);
			$checkII2 = $this->Acl->check($profile, 'Institutions/index', 'create');
			$this->set('checkII2', $checkII2);
			$checkII3 = $this->Acl->check($profile, 'Institutions/index', 'read');
			$this->set('checkII3', $checkII3);
			$checkII4 = $this->Acl->check($profile, 'Institutions/index', 'update');
			$this->set('checkII4', $checkII4);
			$checkII5 = $this->Acl->check($profile, 'Institutions/index', 'delete');
			$this->set('checkII5', $checkII5);
			$checkIS1 = $this->Acl->check($profile, 'Institutions/setgeo');
			$this->set('checkIS1', $checkIS1);
			$checkIS2 = $this->Acl->check($profile, 'Institutions/setgeo', 'update');
			$this->set('checkIS2', $checkIS2);
			$checkIV1 = $this->Acl->check($profile, 'Institutions/view');
			$this->set('checkIV1', $checkIV1);
			$checkIV2 = $this->Acl->check($profile, 'Institutions/view', 'create');
			$this->set('checkIV2', $checkIV2);
			$checkIV3 = $this->Acl->check($profile, 'Institutions/view', 'read');
			$this->set('checkIV3', $checkIV3);
			$checkIV4 = $this->Acl->check($profile, 'Institutions/view', 'update');
			$this->set('checkIV4', $checkIV4);
			$checkIV5 = $this->Acl->check($profile, 'Institutions/view', 'delete');
			$this->set('checkIV5', $checkIV5);
			$checkMA1 = $this->Acl->check($profile, 'MyPermissions/add');
			$this->set('checkMA1', $checkMA1);
			$checkMA2 = $this->Acl->check($profile, 'MyPermissions/add', 'create');
			$this->set('checkMA2', $checkMA2);
			$checkMD1 = $this->Acl->check($profile, 'MyPermissions/delete');
			$this->set('checkMD1', $checkMD1);
			$checkMD2 = $this->Acl->check($profile, 'MyPermissions/delete', 'delete');
			$this->set('checkMD2', $checkMD2);
			$checkME1 = $this->Acl->check($profile, 'MyPermissions/edit');
			$this->set('checkME1', $checkME1);
			$checkME2 = $this->Acl->check($profile, 'MyPermissions/edit', 'update');
			$this->set('checkME2', $checkME2);
			$checkMI1 = $this->Acl->check($profile, 'MyPermissions/index');
			$this->set('checkMI1', $checkMI1);
			$checkMI2 = $this->Acl->check($profile, 'MyPermissions/index', 'create');
			$this->set('checkMI2', $checkMI2);
			$checkMI3 = $this->Acl->check($profile, 'MyPermissions/index', 'read');
			$this->set('checkMI3', $checkMI3);
			$checkMI4 = $this->Acl->check($profile, 'MyPermissions/index', 'update');
			$this->set('checkMI4', $checkMI4);
			$checkMI5 = $this->Acl->check($profile, 'MyPermissions/index', 'delete');
			$this->set('checkMI5', $checkMI5);
			$checkMV1 = $this->Acl->check($profile, 'MyPermissions/view');
			$this->set('checkMV1', $checkMV1);
			$checkMV2 = $this->Acl->check($profile, 'MyPermissions/view', 'create');
			$this->set('checkMV2', $checkMV2);
			$checkMV3 = $this->Acl->check($profile, 'MyPermissions/view', 'read');
			$this->set('checkMV3', $checkMV3);
			$checkMV4 = $this->Acl->check($profile, 'MyPermissions/view', 'update');
			$this->set('checkMV4', $checkMV4);
			$checkMV5 = $this->Acl->check($profile, 'MyPermissions/view', 'delete');
			$this->set('checkMV5', $checkMV5);
			$checkNA1 = $this->Acl->check($profile, 'Nets/add');
			$this->set('checkNA1', $checkNA1);
			$checkNA2 = $this->Acl->check($profile, 'Nets/add', 'create');
			$this->set('checkNA2', $checkNA2);
			$checkND1 = $this->Acl->check($profile, 'Nets/delete');
			$this->set('checkND1', $checkND1);
			$checkND2 = $this->Acl->check($profile, 'Nets/delete', 'delete');
			$this->set('checkND2', $checkND2);
			$checkNE1 = $this->Acl->check($profile, 'Nets/edit');
			$this->set('checkNE1', $checkNE1);
			$checkNE2 = $this->Acl->check($profile, 'Nets/edit', 'update');
			$this->set('checkNE2', $checkNE2);
			$checkNI1 = $this->Acl->check($profile, 'Nets/index');
			$this->set('checkNI1', $checkNI1);
			$checkNI2 = $this->Acl->check($profile, 'Nets/index', 'create');
			$this->set('checkNI2', $checkNI2);
			$checkNI3 = $this->Acl->check($profile, 'Nets/index', 'read');
			$this->set('checkNI3', $checkNI3);
			$checkNI4 = $this->Acl->check($profile, 'Nets/index', 'update');
			$this->set('checkNI4', $checkNI4);
			$checkNI5 = $this->Acl->check($profile, 'Nets/index', 'delete');
			$this->set('checkNI5', $checkNI5);
			$checkNV1 = $this->Acl->check($profile, 'Nets/view');
			$this->set('checkNV1', $checkNV1);
			$checkNV2 = $this->Acl->check($profile, 'Nets/view', 'create');
			$this->set('checkNV2', $checkNV2);
			$checkNV3 = $this->Acl->check($profile, 'Nets/view', 'read');
			$this->set('checkNV3', $checkNV3);
			$checkNV4 = $this->Acl->check($profile, 'Nets/view', 'update');
			$this->set('checkNV4', $checkNV4);
			$checkNV5 = $this->Acl->check($profile, 'Nets/view', 'delete');
			$this->set('checkNV5', $checkNV5);
			$checkOA1 = $this->Acl->check($profile, 'Observations/add');
			$this->set('checkOA1', $checkOA1);
			$checkOA2 = $this->Acl->check($profile, 'Observations/add', 'create');
			$this->set('checkOA2', $checkOA2);
			$checkOD1 = $this->Acl->check($profile, 'Observations/delete');
			$this->set('checkOD1', $checkOD1);
			$checkOD2 = $this->Acl->check($profile, 'Observations/delete', 'delete');
			$this->set('checkOD2', $checkOD2);
			$checkOE1 = $this->Acl->check($profile, 'Observations/edit');
			$this->set('checkOE1', $checkOE1);
			$checkOE2 = $this->Acl->check($profile, 'Observations/edit', 'update');
			$this->set('checkOE2', $checkOE2);
			$checkOI1 = $this->Acl->check($profile, 'Observations/index');
			$this->set('checkOI1', $checkOI1);
			$checkOI2 = $this->Acl->check($profile, 'Observations/index', 'create');
			$this->set('checkOI2', $checkOI2);
			$checkOI3 = $this->Acl->check($profile, 'Observations/index', 'read');
			$this->set('checkOI3', $checkOI3);
			$checkOI4 = $this->Acl->check($profile, 'Observations/index', 'update');
			$this->set('checkOI4', $checkOI4);
			$checkOI5 = $this->Acl->check($profile, 'Observations/index', 'delete');
			$this->set('checkOI5', $checkOI5);
			$checkOV1 = $this->Acl->check($profile, 'Observations/view');
			$this->set('checkOV1', $checkOV1);
			$checkOV2 = $this->Acl->check($profile, 'Observations/view', 'create');
			$this->set('checkOV2', $checkOV2);
			$checkOV3 = $this->Acl->check($profile, 'Observations/view', 'read');
			$this->set('checkOV3', $checkOV3);
			$checkOV4 = $this->Acl->check($profile, 'Observations/view', 'update');
			$this->set('checkOV4', $checkOV4);
			$checkOV5 = $this->Acl->check($profile, 'Observations/view', 'delete');
			$this->set('checkOV5', $checkOV5);
			$checkOrA1 = $this->Acl->check($profile, 'Orders/add');
			$this->set('checkOrA1', $checkOrA1);
			$checkOrA2 = $this->Acl->check($profile, 'Orders/add', 'create');
			$this->set('checkOrA2', $checkOrA2);
			$checkOrD1 = $this->Acl->check($profile, 'Orders/delete');
			$this->set('checkOrD1', $checkOrD1);
			$checkOrD2 = $this->Acl->check($profile, 'Orders/delete', 'delete');
			$this->set('checkOrD2', $checkOrD2);
			$checkOrE1 = $this->Acl->check($profile, 'Orders/edit');
			$this->set('checkOrE1', $checkOrE1);
			$checkOrE2 = $this->Acl->check($profile, 'Orders/edit', 'update');
			$this->set('checkOrE2', $checkOrE2);
			$checkOrI1 = $this->Acl->check($profile, 'Orders/index');
			$this->set('checkOrI1', $checkOrI1);
			$checkOrI2 = $this->Acl->check($profile, 'Orders/index', 'create');
			$this->set('checkOrI2', $checkOrI2);
			$checkOrI3 = $this->Acl->check($profile, 'Orders/index', 'read');
			$this->set('checkOrI3', $checkOrI3);
			$checkOrI4 = $this->Acl->check($profile, 'Orders/index', 'update');
			$this->set('checkOrI4', $checkOrI4);
			$checkOrI5 = $this->Acl->check($profile, 'Orders/index', 'delete');
			$this->set('checkOrI5', $checkOrI5);
			$checkOrV1 = $this->Acl->check($profile, 'Orders/view');
			$this->set('checkOrV1', $checkOrV1);
			$checkOrV2 = $this->Acl->check($profile, 'Orders/view', 'create');
			$this->set('checkOrV2', $checkOrV2);
			$checkOrV3 = $this->Acl->check($profile, 'Orders/view', 'read');
			$this->set('checkOrV3', $checkOrV3);
			$checkOrV4 = $this->Acl->check($profile, 'Orders/view', 'update');
			$this->set('checkOrV4', $checkOrV4);
			$checkOrV5 = $this->Acl->check($profile, 'Orders/view', 'delete');
			$this->set('checkOrV5', $checkOrV5);
			$checkPA1 = $this->Acl->check($profile, 'Pacients/add');
			$this->set('checkPA1', $checkPA1);
			$checkPA2 = $this->Acl->check($profile, 'Pacients/add', 'create');
			$this->set('checkPA2', $checkPA2);
			$checkPD1 = $this->Acl->check($profile, 'Pacients/delete');
			$this->set('checkPD1', $checkPD1);
			$checkPD2 = $this->Acl->check($profile, 'Pacients/delete', 'delete');
			$this->set('checkPD2', $checkPD2);
			$checkPE1 = $this->Acl->check($profile, 'Pacients/edit');
			$this->set('checkPE1', $checkPE1);
			$checkPE2 = $this->Acl->check($profile, 'Pacients/edit', 'update');
			$this->set('checkPE2', $checkPE2);
			$checkPG1 = $this->Acl->check($profile, 'Pacients/getPacientsMarkers');
			$this->set('checkPG1', $checkPG1);
			$checkPG2 = $this->Acl->check($profile, 'Pacients/getPacientsMarkers', 'create');
			$this->set('checkPG2', $checkPG2);
			$checkPG3 = $this->Acl->check($profile, 'Pacients/getPacientsMarkers', 'read');
			$this->set('checkPG3', $checkPG3);
			$checkPG4 = $this->Acl->check($profile, 'Pacients/getPacientsMarkers', 'update');
			$this->set('checkPG4', $checkPG4);
			$checkPG5 = $this->Acl->check($profile, 'Pacients/getPacientsMarkers', 'delete');
			$this->set('checkPG5', $checkPG5);
			$checkPI1 = $this->Acl->check($profile, 'Pacients/index');
			$this->set('checkPI1', $checkPI1);
			$checkPI2 = $this->Acl->check($profile, 'Pacients/index', 'create');
			$this->set('checkPI2', $checkPI2);
			$checkPI3 = $this->Acl->check($profile, 'Pacients/index', 'read');
			$this->set('checkPI3', $checkPI3);
			$checkPI4 = $this->Acl->check($profile, 'Pacients/index', 'update');
			$this->set('checkPI4', $checkPI4);
			$checkPI5 = $this->Acl->check($profile, 'Pacients/index', 'delete');
			$this->set('checkPI5', $checkPI5);
			$checkPM1 = $this->Acl->check($profile, 'Pacients/map');
			$this->set('checkPM1', $checkPM1);
			$checkPM2 = $this->Acl->check($profile, 'Pacients/map', 'create');
			$this->set('checkPM2', $checkPM2);
			$checkPM3 = $this->Acl->check($profile, 'Pacients/map', 'read');
			$this->set('checkPM3', $checkPM3);
			$checkPM4 = $this->Acl->check($profile, 'Pacients/map', 'update');
			$this->set('checkPM4', $checkPM4);
			$checkPM5 = $this->Acl->check($profile, 'Pacients/map', 'delete');
			$this->set('checkPM5', $checkPM5);
			$checkPS1 = $this->Acl->check($profile, 'Pacients/setgeo');
			$this->set('checkPS1', $checkPS1);
			$checkPS2 = $this->Acl->check($profile, 'Pacients/setgeo', 'update');
			$this->set('checkPS2', $checkPS2);
			$checkPV1 = $this->Acl->check($profile, 'Pacients/view');
			$this->set('checkPV1', $checkPV1);
			$checkPV2 = $this->Acl->check($profile, 'Pacients/view', 'create');
			$this->set('checkPV2', $checkPV2);
			$checkPV3 = $this->Acl->check($profile, 'Pacients/view', 'read');
			$this->set('checkPV3', $checkPV3);
			$checkPV4 = $this->Acl->check($profile, 'Pacients/view', 'update');
			$this->set('checkPV4', $checkPV4);
			$checkPV5 = $this->Acl->check($profile, 'Pacients/view', 'delete');
			$this->set('checkPV5', $checkPV5);
			$checkPrA1 = $this->Acl->check($profile, 'Profiles/add');
			$this->set('checkPrA1', $checkPrA1);
			$checkPrA2 = $this->Acl->check($profile, 'Profiles/add', 'create');
			$this->set('checkPrA2', $checkPrA2);
			$checkPrD1 = $this->Acl->check($profile, 'Profiles/delete');
			$this->set('checkPrD1', $checkPrD1);
			$checkPrD2 = $this->Acl->check($profile, 'Profiles/delete', 'delete');
			$this->set('checkPrD2', $checkPrD2);
			$checkPrE1 = $this->Acl->check($profile, 'Profiles/edit');
			$this->set('checkPrE1', $checkPrE1);
			$checkPrE2 = $this->Acl->check($profile, 'Profiles/edit', 'update');
			$this->set('checkPrE2', $checkPrE2);
			$checkPrI1 = $this->Acl->check($profile, 'Profiles/index');
			$this->set('checkPrI1', $checkPrI1);
			$checkPrI2 = $this->Acl->check($profile, 'Profiles/index', 'create');
			$this->set('checkPrI2', $checkPrI2);
			$checkPrI3 = $this->Acl->check($profile, 'Profiles/index', 'read');
			$this->set('checkPrI3', $checkPrI3);
			$checkPrI4 = $this->Acl->check($profile, 'Profiles/index', 'update');
			$this->set('checkPrI4', $checkPrI4);
			$checkPrI5 = $this->Acl->check($profile, 'Profiles/index', 'delete');
			$this->set('checkPrI5', $checkPrI5);
			$checkPrV1 = $this->Acl->check($profile, 'Profiles/view');
			$this->set('checkPrV1', $checkPrV1);
			$checkPrV2 = $this->Acl->check($profile, 'Profiles/view', 'create');
			$this->set('checkPrV2', $checkPrV2);
			$checkPrV3 = $this->Acl->check($profile, 'Profiles/view', 'read');
			$this->set('checkPrV3', $checkPrV3);
			$checkPrV4 = $this->Acl->check($profile, 'Profiles/view', 'update');
			$this->set('checkPrV4', $checkPrV4);
			$checkPrV5 = $this->Acl->check($profile, 'Profiles/view', 'delete');
			$this->set('checkPrV5', $checkPrV5);
			$checkPGA1 = $this->Acl->check($profile, 'ProfilesGates/add');
			$this->set('checkPGA1', $checkPGA1);
			$checkPGA2 = $this->Acl->check($profile, 'ProfilesGates/add', 'create');
			$this->set('checkPGA2', $checkPGA2);
			$checkPGD1 = $this->Acl->check($profile, 'ProfilesGates/delete');
			$this->set('checkPGD1', $checkPGD1);
			$checkPGD2 = $this->Acl->check($profile, 'ProfilesGates/delete', 'delete');
			$this->set('checkPGD2', $checkPGD2);
			$checkPGE1 = $this->Acl->check($profile, 'ProfilesGates/edit');
			$this->set('checkPGE1', $checkPGE1);
			$checkPGE2 = $this->Acl->check($profile, 'ProfilesGates/edit', 'update');
			$this->set('checkPGE2', $checkPGE2);
			$checkPGI1 = $this->Acl->check($profile, 'ProfilesGates/index');
			$this->set('checkPGI1', $checkPGI1);
			$checkPGI2 = $this->Acl->check($profile, 'ProfilesGates/index', 'create');
			$this->set('checkPGI2', $checkPGI2);
			$checkPGI3 = $this->Acl->check($profile, 'ProfilesGates/index', 'read');
			$this->set('checkPGI3', $checkPGI3);
			$checkPGI4 = $this->Acl->check($profile, 'ProfilesGates/index', 'update');
			$this->set('checkPGI4', $checkPGI4);
			$checkPGI5 = $this->Acl->check($profile, 'ProfilesGates/index', 'delete');
			$this->set('checkPGI5', $checkPGI5);
			$checkPGV1 = $this->Acl->check($profile, 'ProfilesGates/view');
			$this->set('checkPGV1', $checkPGV1);
			$checkPGV2 = $this->Acl->check($profile, 'ProfilesGates/view', 'create');
			$this->set('checkPGV2', $checkPGV2);
			$checkPGV3 = $this->Acl->check($profile, 'ProfilesGates/view', 'read');
			$this->set('checkPGV3', $checkPGV3);
			$checkPGV4 = $this->Acl->check($profile, 'ProfilesGates/view', 'update');
			$this->set('checkPGV4', $checkPGV4);
			$checkPGV5 = $this->Acl->check($profile, 'ProfilesGates/view', 'delete');
			$this->set('checkPGV5', $checkPGV5);
			$checkSA1 = $this->Acl->check($profile, 'Schedules/add');
			$this->set('checkSA1', $checkSA1);
			$checkSA2 = $this->Acl->check($profile, 'Schedules/add', 'create');
			$this->set('checkSA2', $checkSA2);
			$checkSD1 = $this->Acl->check($profile, 'Schedules/delete');
			$this->set('checkSD1', $checkSD1);
			$checkSD2 = $this->Acl->check($profile, 'Schedules/delete', 'delete');
			$this->set('checkSD2', $checkSD2);
			$checkSE1 = $this->Acl->check($profile, 'Schedules/edit');
			$this->set('checkSE1', $checkSE1);
			$checkSE2 = $this->Acl->check($profile, 'Schedules/edit', 'update');
			$this->set('checkSE2', $checkSE2);
			$checkSI1 = $this->Acl->check($profile, 'Schedules/index');
			$this->set('checkSI1', $checkSI1);
			$checkSI2 = $this->Acl->check($profile, 'Schedules/index', 'create');
			$this->set('checkSI2', $checkSI2);
			$checkSI3 = $this->Acl->check($profile, 'Schedules/index', 'read');
			$this->set('checkSI3', $checkSI3);
			$checkSI4 = $this->Acl->check($profile, 'Schedules/index', 'update');
			$this->set('checkSI4', $checkSI4);
			$checkSI5 = $this->Acl->check($profile, 'Schedules/index', 'delete');
			$this->set('checkSI5', $checkSI5);
			$checkSV1 = $this->Acl->check($profile, 'Schedules/view');
			$this->set('checkSV1', $checkSV1);
			$checkSV2 = $this->Acl->check($profile, 'Schedules/view', 'create');
			$this->set('checkSV2', $checkSV2);
			$checkSV3 = $this->Acl->check($profile, 'Schedules/view', 'read');
			$this->set('checkSV3', $checkSV3);
			$checkSV4 = $this->Acl->check($profile, 'Schedules/view', 'update');
			$this->set('checkSV4', $checkSV4);
			$checkSV5 = $this->Acl->check($profile, 'Schedules/view', 'delete');
			$this->set('checkSV5', $checkSV5);
			$checkSEA1 = $this->Acl->check($profile, 'SourcingEvents/add');
			$this->set('checkSEA1', $checkSEA1);
			$checkSEA2 = $this->Acl->check($profile, 'SourcingEvents/add', 'create');
			$this->set('checkSEA2', $checkSEA2);
			$checkSED1 = $this->Acl->check($profile, 'SourcingEvents/delete');
			$this->set('checkSED1', $checkSED1);
			$checkSED2 = $this->Acl->check($profile, 'SourcingEvents/delete', 'delete');
			$this->set('checkSED2', $checkSED2);
			$checkSEE1 = $this->Acl->check($profile, 'SourcingEvents/edit');
			$this->set('checkSEE1', $checkSEE1);
			$checkSEE2 = $this->Acl->check($profile, 'SourcingEvents/edit', 'update');
			$this->set('checkSEE2', $checkSEE2);
			$checkSEI1 = $this->Acl->check($profile, 'SourcingEvents/index');
			$this->set('checkSEI1', $checkSEI1);
			$checkSEI2 = $this->Acl->check($profile, 'SourcingEvents/index', 'create');
			$this->set('checkSEI2', $checkSEI2);
			$checkSEI3 = $this->Acl->check($profile, 'SourcingEvents/index', 'read');
			$this->set('checkSEI3', $checkSEI3);
			$checkSEI4 = $this->Acl->check($profile, 'SourcingEvents/index', 'update');
			$this->set('checkSEI4', $checkSEI4);
			$checkSEI5 = $this->Acl->check($profile, 'SourcingEvents/index', 'delete');
			$this->set('checkSEI5', $checkSEI5);
			$checkSEV1 = $this->Acl->check($profile, 'SourcingEvents/view');
			$this->set('checkSEV1', $checkSEV1);
			$checkSEV2 = $this->Acl->check($profile, 'SourcingEvents/view', 'create');
			$this->set('checkSEV2', $checkSEV2);
			$checkSEV3 = $this->Acl->check($profile, 'SourcingEvents/view', 'read');
			$this->set('checkSEV3', $checkSEV3);
			$checkSEV4 = $this->Acl->check($profile, 'SourcingEvents/view', 'update');
			$this->set('checkSEV4', $checkSEV4);
			$checkSEV5 = $this->Acl->check($profile, 'SourcingEvents/view', 'delete');
			$this->set('checkSEV5', $checkSEV5);
			$checkSDAp1 = $this->Acl->check($profile, 'StatesxDays/addPacient');
			$this->set('checkSDAp1', $checkSDAp1);
			$checkSDAp2 = $this->Acl->check($profile, 'StatesxDays/addPacient', 'create');
			$this->set('checkSDAp2', $checkSDAp2);
			$checkSDAu1 = $this->Acl->check($profile, 'StatesxDays/addUser');
			$this->set('checkSDAu1', $checkSDAu1);
			$checkSDAu2 = $this->Acl->check($profile, 'StatesxDays/addUser', 'create');
			$this->set('checkSDAu2', $checkSDAu2);
			$checkSDD1 = $this->Acl->check($profile, 'StatesxDays/delete');
			$this->set('checkSDD1', $checkSDD1);
			$checkSDD2 = $this->Acl->check($profile, 'StatesxDays/delete', 'delete');
			$this->set('checkSDD2', $checkSDD2);
			$checkSDI1 = $this->Acl->check($profile, 'StatesxDays/index');
			$this->set('checkSDI1', $checkSDI1);
			$checkSDI2 = $this->Acl->check($profile, 'StatesxDays/index', 'create');
			$this->set('checkSDI2', $checkSDI2);
			$checkSDI3 = $this->Acl->check($profile, 'StatesxDays/index', 'read');
			$this->set('checkSDI3', $checkSDI3);
			$checkSDI4 = $this->Acl->check($profile, 'StatesxDays/index', 'update');
			$this->set('checkSDI4', $checkSDI4);
			$checkSDI5 = $this->Acl->check($profile, 'StatesxDays/index', 'delete');
			$this->set('checkSDI5', $checkSDI5);
			$checkSDV1 = $this->Acl->check($profile, 'StatesxDays/view');
			$this->set('checkSDV1', $checkSDV1);
			$checkSDV2 = $this->Acl->check($profile, 'StatesxDays/view', 'create');
			$this->set('checkSDV2', $checkSDV2);
			$checkSDV3 = $this->Acl->check($profile, 'StatesxDays/view', 'read');
			$this->set('checkSDV3', $checkSDV3);
			$checkSDV4 = $this->Acl->check($profile, 'StatesxDays/view', 'update');
			$this->set('checkSDV4', $checkSDV4);
			$checkSDV5 = $this->Acl->check($profile, 'StatesxDays/view', 'delete');
			$this->set('checkSDV5', $checkSDV5);
			$checkSGA1 = $this->Acl->check($profile, 'StatusGroups/add');
			$this->set('checkSGA1', $checkSGA1);
			$checkSGA2 = $this->Acl->check($profile, 'StatusGroups/add', 'create');
			$this->set('checkSGA2', $checkSGA2);
			$checkSGD1 = $this->Acl->check($profile, 'StatusGroups/delete');
			$this->set('checkSGD1', $checkSGD1);
			$checkSGD2 = $this->Acl->check($profile, 'StatusGroups/delete', 'delete');
			$this->set('checkSGD2', $checkSGD2);
			$checkSGE1 = $this->Acl->check($profile, 'StatusGroups/edit');
			$this->set('checkSGE1', $checkSGE1);
			$checkSGE2 = $this->Acl->check($profile, 'StatusGroups/edit', 'update');
			$this->set('checkSGE2', $checkSGE2);
			$checkSGG1 = $this->Acl->check($profile, 'StatusGroups/graphics');
			$this->set('checkSGG1', $checkSGG1);
			$checkSGG2 = $this->Acl->check($profile, 'StatusGroups/graphics', 'create');
			$this->set('checkSGG2', $checkSGG2);
			$checkSGG3 = $this->Acl->check($profile, 'StatusGroups/graphics', 'read');
			$this->set('checkSGG3', $checkSGG3);
			$checkSGG4 = $this->Acl->check($profile, 'StatusGroups/graphics', 'update');
			$this->set('checkSGG4', $checkSGG4);
			$checkSGG5 = $this->Acl->check($profile, 'StatusGroups/graphics', 'delete');
			$this->set('checkSGG5', $checkSGG5);
			$checkSGI1 = $this->Acl->check($profile, 'StatusGroups/index');
			$this->set('checkSGI1', $checkSGI1);
			$checkSGI2 = $this->Acl->check($profile, 'StatusGroups/index', 'create');
			$this->set('checkSGI2', $checkSGI2);
			$checkSGI3 = $this->Acl->check($profile, 'StatusGroups/index', 'read');
			$this->set('checkSGI3', $checkSGI3);
			$checkSGI4 = $this->Acl->check($profile, 'StatusGroups/index', 'update');
			$this->set('checkSGI4', $checkSGI4);
			$checkSGI5 = $this->Acl->check($profile, 'StatusGroups/index', 'delete');
			$this->set('checkSGI5', $checkSGI5);
			$checkSGV1 = $this->Acl->check($profile, 'StatusGroups/view');
			$this->set('checkSGV1', $checkSGV1);
			$checkSGV2 = $this->Acl->check($profile, 'StatusGroups/view', 'create');
			$this->set('checkSGV2', $checkSGV2);
			$checkSGV3 = $this->Acl->check($profile, 'StatusGroups/view', 'read');
			$this->set('checkSGV3', $checkSGV3);
			$checkSGV4 = $this->Acl->check($profile, 'StatusGroups/view', 'update');
			$this->set('checkSGV4', $checkSGV4);
			$checkSGV5 = $this->Acl->check($profile, 'StatusGroups/view', 'delete');
			$this->set('checkSGV5', $checkSGV5);
			$checkStD1 = $this->Acl->check($profile, 'Stocks/delete');
			$this->set('checkStD1', $checkStD1);
			$checkStD2 = $this->Acl->check($profile, 'Stocks/delete', 'delete');
			$this->set('checkStD2', $checkStD2);
			$checkStI1 = $this->Acl->check($profile, 'Stocks/index');
			$this->set('checkStI1', $checkStI1);
			$checkStI2 = $this->Acl->check($profile, 'Stocks/index', 'create');
			$this->set('checkStI2', $checkStI2);
			$checkStI3 = $this->Acl->check($profile, 'Stocks/index', 'read');
			$this->set('checkStI3', $checkStI3);
			$checkStI4 = $this->Acl->check($profile, 'Stocks/index', 'update');
			$this->set('checkStI4', $checkStI4);
			$checkStI5 = $this->Acl->check($profile, 'Stocks/index', 'delete');
			$this->set('checkStI5', $checkStI5);
			$checkStV1 = $this->Acl->check($profile, 'Stocks/view');
			$this->set('checkStV1', $checkStV1);
			$checkStV2 = $this->Acl->check($profile, 'Stocks/view', 'create');
			$this->set('checkStV2', $checkStV2);
			$checkStV3 = $this->Acl->check($profile, 'Stocks/view', 'read');
			$this->set('checkStV3', $checkStV3);
			$checkStV4 = $this->Acl->check($profile, 'Stocks/view', 'update');
			$this->set('checkStV4', $checkStV4);
			$checkStV5 = $this->Acl->check($profile, 'Stocks/view', 'delete');
			$this->set('checkStV5', $checkStV5);
			$checkSuA1 = $this->Acl->check($profile, 'Supplies/add');
			$this->set('checkSuA1', $checkSuA1);
			$checkSuA2 = $this->Acl->check($profile, 'Supplies/add', 'create');
			$this->set('checkSuA2', $checkSuA2);
			$checkSuD1 = $this->Acl->check($profile, 'Supplies/delete');
			$this->set('checkSuD1', $checkSuD1);
			$checkSuD2 = $this->Acl->check($profile, 'Supplies/delete', 'delete');
			$this->set('checkSuD2', $checkSuD2);
			$checkSuE1 = $this->Acl->check($profile, 'Supplies/edit');
			$this->set('checkSuE1', $checkSuE1);
			$checkSuE2 = $this->Acl->check($profile, 'Supplies/edit', 'update');
			$this->set('checkSuE2', $checkSuE2);
			$checkSuI1 = $this->Acl->check($profile, 'Supplies/index');
			$this->set('checkSuI1', $checkSuI1);
			$checkSuI2 = $this->Acl->check($profile, 'Supplies/index', 'create');
			$this->set('checkSuI2', $checkSuI2);
			$checkSuI3 = $this->Acl->check($profile, 'Supplies/index', 'read');
			$this->set('checkSuI3', $checkSuI3);
			$checkSuI4 = $this->Acl->check($profile, 'Supplies/index', 'update');
			$this->set('checkSuI4', $checkSuI4);
			$checkSuI5 = $this->Acl->check($profile, 'Supplies/index', 'delete');
			$this->set('checkSuI5', $checkSuI5);
			$checkSuV1 = $this->Acl->check($profile, 'Supplies/view');
			$this->set('checkSuV1', $checkSuV1);
			$checkSuV2 = $this->Acl->check($profile, 'Supplies/view', 'create');
			$this->set('checkSuV2', $checkSuV2);
			$checkSuV3 = $this->Acl->check($profile, 'Supplies/view', 'read');
			$this->set('checkSuV3', $checkSuV3);
			$checkSuV4 = $this->Acl->check($profile, 'Supplies/view', 'update');
			$this->set('checkSuV4', $checkSuV4);
			$checkSuV5 = $this->Acl->check($profile, 'Supplies/view', 'delete');
			$this->set('checkSuV5', $checkSuV5);
			$checkTA1 = $this->Acl->check($profile, 'Turns/add');
			$this->set('checkTA1', $checkTA1);
			$checkTA2 = $this->Acl->check($profile, 'Turns/add', 'create');
			$this->set('checkTA2', $checkTA2);
			$checkTD1 = $this->Acl->check($profile, 'Turns/delete');
			$this->set('checkTD1', $checkTD1);
			$checkTD5 = $this->Acl->check($profile, 'Turns/delete', 'delete');
			$this->set('checkTD5', $checkTD5);
			$checkTE1 = $this->Acl->check($profile, 'Turns/edit');
			$this->set('checkTE1', $checkTE1);
			$checkTE2 = $this->Acl->check($profile, 'Turns/edit', 'update');
			$this->set('checkTE2', $checkTE2);
			$checkTI1 = $this->Acl->check($profile, 'Turns/index');
			$this->set('checkTI1', $checkTI1);
			$checkTI2 = $this->Acl->check($profile, 'Turns/index', 'create');
			$this->set('checkTI2', $checkTI2);
			$checkTI3 = $this->Acl->check($profile, 'Turns/index', 'read');
			$this->set('checkTI3', $checkTI3);
			$checkTI4 = $this->Acl->check($profile, 'Turns/index', 'update');
			$this->set('checkTI4', $checkTI4);
			$checkTI5 = $this->Acl->check($profile, 'Turns/index', 'delete');
			$this->set('checkTI5', $checkTI5);
			$checkTV1 = $this->Acl->check($profile, 'Turns/view');
			$this->set('checkTV1', $checkTV1);
			$checkTV2 = $this->Acl->check($profile, 'Turns/view', 'create');
			$this->set('checkTV2', $checkTV2);
			$checkTV3 = $this->Acl->check($profile, 'Turns/view', 'read');
			$this->set('checkTV3', $checkTV3);
			$checkTV4 = $this->Acl->check($profile, 'Turns/view', 'update');
			$this->set('checkTV4', $checkTV4);
			$checkTV5 = $this->Acl->check($profile, 'Turns/view', 'delete');
			$this->set('checkTV5', $checkTV5);
			$checkUA1 = $this->Acl->check($profile, 'Users/add');
			$this->set('checkUA1', $checkUA1);
			$checkUA2 = $this->Acl->check($profile, 'Users/add', 'create');
			$this->set('checkUA2', $checkUA2);
			$checkUC1 = $this->Acl->check($profile, 'Users/changepassword');
			$this->set('checkUC1', $checkUC1);
			$checkUC2 = $this->Acl->check($profile, 'Users/changepassword', 'update');
			$this->set('checkUC2', $checkUC2);
			$checkUD1 = $this->Acl->check($profile, 'Users/delete');
			$this->set('checkUD1', $checkUD1);
			$checkUD2 = $this->Acl->check($profile, 'Users/delete', 'delete');
			$this->set('checkUD2', $checkUD2);
			$checkUE1 = $this->Acl->check($profile, 'Users/edit');
			$this->set('checkUE1', $checkUE1);
			$checkUE2 = $this->Acl->check($profile, 'Users/edit', 'update');
			$this->set('checkUE2', $checkUE2);
			$checkUGM1 = $this->Acl->check($profile, 'Users/getUserMarkers');
			$this->set('checkUGM1', $checkUGM1);
			$checkUGM2 = $this->Acl->check($profile, 'Users/getUserMarkers', 'create');
			$this->set('checkUGM2', $checkUGM2);
			$checkUGM3 = $this->Acl->check($profile, 'Users/getUserMarkers', 'read');
			$this->set('checkUGM3', $checkUGM3);
			$checkUGM4 = $this->Acl->check($profile, 'Users/getUserMarkers', 'update');
			$this->set('checkUGM4', $checkUGM4);
			$checkUGM5 = $this->Acl->check($profile, 'Users/getUserMarkers', 'delete');
			$this->set('checkUGM5', $checkUGM5);
			$checkUG1 = $this->Acl->check($profile, 'Users/getUsersMarkers');
			$this->set('checkUG1', $checkUG1);
			$checkUG2 = $this->Acl->check($profile, 'Users/getUsersMarkers', 'create');
			$this->set('checkUG2', $checkUG2);
			$checkUG3 = $this->Acl->check($profile, 'Users/getUsersMarkers', 'read');
			$this->set('checkUG3', $checkUG3);
			$checkUG4 = $this->Acl->check($profile, 'Users/getUsersMarkers', 'update');
			$this->set('checkUG4', $checkUG4);
			$checkUG5 = $this->Acl->check($profile, 'Users/getUsersMarkers', 'delete');
			$this->set('checkUG5', $checkUG5);
			$checkUI1 = $this->Acl->check($profile, 'Users/index');
			$this->set('checkUI1', $checkUI1);
			$checkUI2 = $this->Acl->check($profile, 'Users/index', 'create');
			$this->set('checkUI2', $checkUI2);
			$checkUI3 = $this->Acl->check($profile, 'Users/index', 'read');
			$this->set('checkUI3', $checkUI3);
			$checkUI4 = $this->Acl->check($profile, 'Users/index', 'update');
			$this->set('checkUI4', $checkUI4);
			$checkUI5 = $this->Acl->check($profile, 'Users/index', 'delete');
			$this->set('checkUI5', $checkUI5);
			$checkUL1 = $this->Acl->check($profile, 'Users/listAgent');
			$this->set('checkUL1', $checkUL1);
			$checkUL2 = $this->Acl->check($profile, 'Users/listAgent', 'create');
			$this->set('checkUL2', $checkUL2);
			$checkUL3 = $this->Acl->check($profile, 'Users/listAgent', 'read');
			$this->set('checkUL3', $checkUL3);
			$checkUL4 = $this->Acl->check($profile, 'Users/listAgent', 'update');
			$this->set('checkUL4', $checkUL4);
			$checkUL5 = $this->Acl->check($profile, 'Users/listAgent', 'delete');
			$this->set('checkUL5', $checkUL5);
			$checkULN1 = $this->Acl->check($profile, 'Users/listNet');
			$this->set('checkULN1', $checkULN1);
			$checkULN2 = $this->Acl->check($profile, 'Users/listNet', 'create');
			$this->set('checkULN2', $checkULN2);
			$checkULN3 = $this->Acl->check($profile, 'Users/listNet', 'read');
			$this->set('checkULN3', $checkULN3);
			$checkULN4 = $this->Acl->check($profile, 'Users/listNet', 'update');
			$this->set('checkULN4', $checkULN4);
			$checkULN5 = $this->Acl->check($profile, 'Users/listNet', 'delete');
			$this->set('checkULN5', $checkULN5);
			$checkULo1 = $this->Acl->check($profile, 'Users/logout');
			$this->set('checkULo1', $checkULo1);
			$checkULo2 = $this->Acl->check($profile, 'Users/logout', 'create');
			$this->set('checkULo2', $checkULo2);
			$checkULo3 = $this->Acl->check($profile, 'Users/logout', 'read');
			$this->set('checkULo3', $checkULo3);
			$checkULo4 = $this->Acl->check($profile, 'Users/logout', 'update');
			$this->set('checkULo4', $checkULo4);
			$checkULo5 = $this->Acl->check($profile, 'Users/logout', 'delete');
			$this->set('checkULo5', $checkULo5);
			$checkUS1 = $this->Acl->check($profile, 'Users/setgeo');
			$this->set('checkUS1', $checkUS1);
			$checkUS2 = $this->Acl->check($profile, 'Users/setgeo', 'update');
			$this->set('checkUS2', $checkUS2);
			$checkUV1 = $this->Acl->check($profile, 'Users/view');
			$this->set('checkUV1', $checkUV1);
			$checkUV2 = $this->Acl->check($profile, 'Users/view', 'create');
			$this->set('checkUV2', $checkUV2);
			$checkUV3 = $this->Acl->check($profile, 'Users/view', 'read');
			$this->set('checkUV3', $checkUV3);
			$checkUV4 = $this->Acl->check($profile, 'Users/view', 'update');
			$this->set('checkUV4', $checkUV4);
			$checkUV5 = $this->Acl->check($profile, 'Users/view', 'delete');
			$this->set('checkUV5', $checkUV5);
		}
		//Objeto que se va a popular con datos del usuario y se va a pasar
        // - A todos los controllers
        // - A todas las vistas
        $objUser = Array();
        $objUser['isAuth'] = false;
        $status = [1 => 'Sano','Sospechoso','Infectado'];
        $statusAlert = ['Sin datos','Alerta verde','Alerta amarillo','Alerta naranja','Alerta rojo'];

        if($this->Auth->user('id') !== null)
        {
            $objUser['isAuth'] = true;
			$userGroups = $this->Users->get($id, ['contain' => ['GroupsUsers' => ['Groups', 'Nets']]]);
			$groupsArray = [];
			$i = 0;
			if(!empty($userGroups->groups_users))
			{
				foreach($userGroups->groups_users as $group) {
					if(!empty($group->group->id)) {
						$groupsArray[$i]['group_id'] = $group->group->id;
						$groupsArray[$i]['group'] = $group->group->group_name;
					}
					if(!empty($group->net_id)) {
						$groupsArray[$i]['net_id'] = $group->net_id;
						$groupsArray[$i]['net'] = $group->net->net_name;
					}
					if(!empty($group->main_gate)) $groupsArray[$i]['main_gate'] = $group->main_gate;
					$i++;
				}
			}
			$objUser['id'] = $this->Auth->user('id');
            $objUser['profile_id'] = $this->Auth->user('profile_id');
            $objUser['username'] = $this->Auth->user('username');      
            $objUser['firstname'] = $this->Auth->user('firstname');  
            $objUser['fullname'] = $this->Auth->user('firstname') . ' ' . $this->Auth->user('lastname');     
            $objUser['map_lat'] = $this->Auth->user('map_lat'); 
            $objUser['map_long'] = $this->Auth->user('map_long');
			$objUser['isAdmin'] = $this->Auth->user('profile_id') == 1;
            $objUser['isGeneralCoordinator'] = $this->Auth->user('profile_id') == 2;
            $objUser['isGroupCoordinator'] = $this->Auth->user('profile_id') == 3;
            $objUser['isNetCoordinator'] = $this->Auth->user('profile_id') == 4;  
            $objUser['isNodeCoordinator'] = $this->Auth->user('profile_id') == 5;
            $objUser['isTacticOperator'] = $this->Auth->user('profile_id') == 6;
            $objUser['isSanitaryAgent'] = $this->Auth->user('profile_id') == 7; 
            $objUser['role'] = "<strong>".$profile->name."</strong>";
            if(count($groupsArray) !== 0){
				$i = 0;
				if($this->Auth->user('profile_id') == 3) $objUser['group_id'] = array();
				foreach($groupsArray as $value){
					if($this->Auth->user('profile_id') == 3) array_push($objUser['group_id'], $value['group_id']);
					else $objUser['group_id'] = $value['group_id'];
					if($i==0) $objUser['role'] .= " Célula(s): ";
					else $objUser['role'] .= " ";
					$objUser['role'] .= "<strong>".$value['group']."</strong>";
					if(!empty($value['net'])){
						$objUser['net_id'] = $value['net_id'];
						$objUser['role'] .= " - Unidad funcional: <strong>".$value['net']."</strong>";
					}
					if(!empty($value['main_gate'])){
						$objUser['main_gate'] = $value['main_gate'];
						$objUser['role'] .= " - Nodo: <strong>".$value['main_gate']."</strong>";
					}
					$i++;
				}
            }
        }
        $this->set('isAuthenticated',$objUser['isAuth']);
        $this->set('isAdmin',$this->Auth->user('profile_id') == 1);
        $this->controllerUser = $objUser;
        $this->set('viewUser', $objUser);   
        $this->set('statusEnum', $status);   
        $this->set('statusAlertEnum', $statusAlert);   
	}

    public function beforeRender(EventInterface $event)
    {
        $this->set('_serialize', true);
    }
}
