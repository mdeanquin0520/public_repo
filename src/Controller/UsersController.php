<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Utility\Security;
use Cake\Mailer\Mailer;
use Cake\Routing\Router;
use Cake\Utility\Hash;
use Cake\Orm\Entity;
use Cake\Orm\Query;
use App\Model\Table\UsersTable;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 * @method \App\Model\Entity\Userarray()|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = array())
 */
class UsersController extends AppController
{
	public function initialize() : void 
	{
		parent::initialize();
		$countUsers = $this->Users->find()->count();
		if(empty($countUsers)) $this->Auth->allow();
		else $this->Auth->allow(['forgotpassword', 'resetpassword']);

		$this->loadComponent('Search.Search', [
			'actions' => ['index'],
		]);
	}

	public function login() {
		$this->loadModel('MyPermissions');
		if ($this->request->is('post')) {
			$user = $this->Auth->identify();
			if ($user) {
				$this->Auth->setUser($user);
				return $this->redirect($this->Auth->redirectUrl());
			}
			$this->Flash->error(__('Usuario o contraseña incorrecta.'));
		}
		$countUsers = $this->Users->find()->count();
		$this->set('countUsers', $countUsers);
		$countProfiles = $this->Users->Profiles->find()->count();
		$this->set('countProfiles', $countProfiles);
		$countPermissions = $this->MyPermissions->find()->count();
		$this->set('countPermissions', $countPermissions);
	}

	public function logout() {
		$this->Flash->success(__('Chau'));
		$this->redirect($this->Auth->logout());
	}

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = ['contain' => ['Profiles', 'Referrer', 'GroupsUsers' => ['Groups', 'Nets']]];
		$users = [];
        if ($this->controllerUser['isAdmin']){
			$users = $this->paginate($this->Users->find('search', ['search' => $this->request->getQuery()])->distinct(['Users.id'])
				->where(['Users.profile_id IN' => [1,2,3,4,5,6,7]]));
		} elseif($this->controllerUser['isGeneralCoordinator']){
			$users = $this->paginate($this->Users->find('search', ['search' => $this->request->getQuery()])->distinct(['Users.id'])
				->where(['Users.profile_id IN' => [2,3,4,5,6,7]]));
		} elseif ($this->controllerUser['isGroupCoordinator']){
            $users = $this->paginate($this->Users->find('search', ['search' => $this->request->getQuery()])->distinct(['Users.id'])
				->where(['Users.profile_id IN' => [3,4,5,6,7], 'Groups.id in' => $this->controllerUser['group_id']]));
        } elseif ($this->controllerUser['isNetCoordinator']){
            $users = $this->paginate($this->Users->find('search', ['search' => $this->request->getQuery()])->distinct(['Users.id'])
				->where(['Users.profile_id IN' => [4,5,6,7], 'Groups.id' => $this->controllerUser['group_id'], 
				'GroupsUsers.net_id' => $this->controllerUser['net_id']]));
        } elseif ($this->controllerUser['isNodeCoordinator']){
            $users = $this->paginate($this->Users->find('search', ['search' => $this->request->getQuery()])->distinct(['Users.id'])
				->where(['Users.profile_id IN' => [4,5,6,7], 'Groups.id' => $this->controllerUser['group_id'], 
				'GroupsUsers.net_id' => $this->controllerUser['net_id'], 
                'GroupsUsers.main_gate' => $this->controllerUser['main_gate']]));
        } elseif ($this->controllerUser['isTacticOperator']){
            $users = $this->paginate($this->Users->find('search', ['search' => $this->request->getQuery()])->distinct(['Users.id'])
				->where(['Users.profile_id IN' => [4,5,6,7], 'Groups.id' => $this->controllerUser['group_id'], 
				'GroupsUsers.net_id' => $this->controllerUser['net_id'], 
                'GroupsUsers.main_gate' => $this->controllerUser['main_gate']]));
        } elseif ($this->controllerUser['isSanitaryAgent']){
            $users = $this->paginate($this->Users->find('search', ['search' => $this->request->getQuery()])->distinct(['Users.id'])
				->where(['Users.profile_id IN' => [4,5,6,7], 'Groups.id' => $this->controllerUser['group_id'], 
				'GroupsUsers.net_id' => $this->controllerUser['net_id'], 
                'GroupsUsers.main_gate' => $this->controllerUser['main_gate']]));
        }
        $this->set(compact('users'));
		$this->set('_serialize', ['users']);
    }

    /**
     * View method
     *
     * @param string|null $id Users id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		$user = $this->Users->get($id, [
            'contain' => ['Profiles', 'Referrer', 'StatesxDays', 'Observations', 'Pacients', 'StatusGroups', 'Turns', 
				'Events' => function ($q) use ($id) {
					return $q->leftJoinWith('EventsUsers')->where(['EventsUsers.user_id' => $id]);
				}, 
				'Groups' => function ($q) use ($id) {
					return $q->leftJoinWith('GroupsUsers')->where(['GroupsUsers.user_id' => $id]);
				},
				'Stocks' => function ($q) use ($id) {
					return $q->leftJoinWith('StocksUsers')->where(['StocksUsers.user_id' => $id]);
				}
			]
		]);
		$this->set(compact('user'));
	}

    public function listAgent($net_id, $main_gate, $user_id = null)
	{
		$this->autorender = false;
		$users =  $this->Users->find('list')->leftJoinWith('Groups')->where(['GroupsUsers.net_id' => $net_id, 'GroupsUsers.main_gate' => $main_gate, 'Users.profile_id' => 7]);
		$html = '<option value="0">- Seleccione un agente -</option>\n';
		foreach($users as $key => $value) {
			$selected = !empty($user_id) && $user_id == $key ? " selected" : "";
			$html .= '<option value="' . $key . '"' . $selected . '>' . $value . '</option>\n';
		}
		return $this->response->withStringBody($html);
	}

    public function listNet($id, $net_id = null)
	{
		$this->autorender = false;
		$nets  =  $this->Users->Groups->Nets->find('list')->where(['group_id' => $id]);
		$html = '<option value="0">- Seleccione una unidad funcional -</option>\n';
		foreach($nets as $key => $value) {
			$selected = !empty($net_id) && $net_id == $key ? " selected" : "";
			$html .= '<option value="' . $key . '"' . $selected . '>' . $value . '</option>\n';
		}
		return $this->response->withStringBody($html);
	}

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
			$image_file_name_url = $this->request->getData('image_file_name_url') ?? null;
			$type = $image_file_name_url->getClientMediaType() ?? null;
			if($type == "image/gif" || $type == "image/jpeg" || $type == "image/x-png" || empty($type)) {
				$size = $image_file_name_url->getSize() ?? 0;
				if($size < 2097152) {
					$user = $this->Users->patchEntity($user, $this->request->getData(), ['associated' => ['Groups' => ['onlyIds' => true]]]);
					if(!empty($this->request->getData('groups.0._joinData'))){
						$net_id = $this->request->getData('groups.0._joinData.net_id') ?? null;
						$main_gate = $this->request->getData('groups.0._joinData.main_gate') ?? null;
						$joinData = new Entity(['net_id' => $net_id, 'main_gate' => $main_gate], ['markNew' => true]);
						$user->groups[0]->_joinData = $joinData;
					}
					if(!empty($image_file_name_url)){
						$user->image_file_name_url = Router::url("/", true) . "upload/" . $this->modelClass . "/" . $image_file_name_url->getClientFilename();
						$user->image_file_name = WWW_ROOT . 'upload' . DS . $this->modelClass . DS . $image_file_name_url->getClientFilename();
						$user->image_file_name_filename = $image_file_name_url->getClientFilename();
					}
					if ($this->Users->save($user)) {
						if(!empty($image_file_name_url)) $image_file_name_url->moveTo(WWW_ROOT . 'upload' . DS . $this->modelClass . DS . $image_file_name_url->getClientFilename());
						$this->Flash->success(__('El usuario ha sido guardado.'));

						$id = $this->Auth->user('id') ?? null;

						$action = (!empty($id)) ? 'index' : 'login';
						return $this->redirect(['action' => $action]);
					}
					$this->Flash->error(__('El usuario no pudo ser guardado. Por favor, intente nuevamente.'));
				}else{
					$this->Flash->error(__('Debe seleccionar una imagen de 2 mb máximo.'));
				}
			}
        }
        $profiles = $this->Users->Profiles->find('list', ['limit' => 200])->all();
        $groups = $this->Users->Groups->find('list', ['limit' => 200])->all();
        $referrer = $this->Users->find('list', ['limit' => 200])->all();
        $this->set(compact('user', 'profiles', 'referrer', 'groups'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Users id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Groups'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
			$image_file_name_url = $this->request->getData('image_file_name_url') ?? null;
			$type = $image_file_name_url->getClientMediaType() ?? null;
			if($type == "image/gif" || $type == "image/jpeg" || $type == "image/x-png" || empty($type)) {
				$size = $image_file_name_url->getSize() ?? 0;
				if($size < 2097152) {
					$user = $this->Users->patchEntity($user, $this->request->getData(), [
						'associated' => [
							'Groups' => [
								'onlyIds' => true,
								[
									'_joinData' => [
										'net_id' => $this->request->getData('groups.0._joinData.net_id'),
										'main_gate' => $this->request->getData('groups.0._joinData.main_gate'),
									]
								]
							]
						]
					]);
					if(!empty($this->request->getData('groups.0._joinData'))){
						$net_id = $this->request->getData('groups.0._joinData.net_id') ?? null;
						$main_gate = $this->request->getData('groups.0._joinData.main_gate') ?? null;
						$joinData = new Entity(['net_id' => $net_id, 'main_gate' => $main_gate], ['markNew' => true]);
						$user->_joinData = $joinData;
						$user->groups[0]->_joinData = $joinData;
					}
					if(!empty($image_file_name_url)){
						$user->image_file_name_url = Router::url("/", true) . "upload/" . $this->modelClass . "/" . $image_file_name_url->getClientFilename();
						$user->image_file_name = WWW_ROOT . 'upload' . DS . $this->modelClass . DS . $image_file_name_url->getClientFilename();
						$user->image_file_name_filename = $image_file_name_url->getClientFilename();
					}
					if ($this->Users->save($user)) {
						if(!empty($image_file_name_url)) $image_file_name_url->moveTo(WWW_ROOT . 'upload' . DS . $this->modelClass . DS . $image_file_name_url->getClientFilename());
						$this->Flash->success(__('El usuario ha sido modificado.'));

						return $this->redirect(['action' => 'index']);
					}
					$this->Flash->error(__('El usuario no pudo ser modificado. Por favor, intente nuevamente.'));
				}
			}
        }
        $this->set('profile_id',$user->profile_id);
        $profiles = $this->Users->Profiles->find('list', ['limit' => 200])->all();
        $referrer = $this->Users->Referrer->find('list', ['limit' => 200])->all();
        $groups = $this->Users->Groups->find('list', ['limit' => 200])->all();
        $this->set(compact('user', 'profiles', 'referrer', 'groups'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Users id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            unlink($user->image_file_name);
			$this->Flash->success(__('El usuario ha sido eliminado.'));
        } else {
            $this->Flash->error(__('El usuario no pudo ser eliminado. Por favor, intente nuevamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }

	public function forgotpassword()
	{
		if ($this->request->is('post')) {
			$email = $this->request->getData('email');
			$token = Security::hash(Security::randomBytes(25));
			
			if ($email == NULL) {
				$this->Flash->error(__('Por favor ingrese su dirección de correo')); 
			}
			if	($user = $this->Users->find('all')->where(['email'=>$email])->first()) { 
				$user->token = $token;
				if ($this->Users->save($user)){
					$mailer = new Mailer('default');
					$mailer->setTransport('default');
					$mailer->setFrom(['mdeanquin@gmail.com' => 'Estado a tu lado'])
					->setTo($email)
					->setEmailFormat('html')
					->setSubject('Solicitud de olvido de contraseña')
					->deliver("Hola {$user->full_name}<br/>Por favor haga clic en el link debajo para resetear su contraseña<br/><br/>".Router::url(['action' => 'resetpassword', $token], true));
					$this->Flash->success('Se ha enviado a su correo ('.$email.') el link para resetear su contraseña');
					return $this->redirect(['action'=>'login']);
				}
			}
			if	($total = $this->Users->find('all')->where(['email'=>$email])->count()==0) {
				$this->Flash->error(__('Este e-mail no está registrado en el sistema'));
			}
		}
	}

	public function resetpassword($token)
	{
		if($user = $this->Users->find('all')->where(['token'=>$token])->first()) {
			if($this->request->is('post')){
				$user = $this->Users->patchEntity($user, $this->request->getData());
				$user->token = null;
				if ($this->Users->save($user)) {
					$this->Flash->success('Se reseteó su contraseña exitosamente. Por favor ingrese al sistema usando su nueva contraseña');
					return $this->redirect(['action'=>'login']);
				}
				$this->Flash->error(__('No se pudo resetear la contraseña. Por favor intente nuevamente.'));
			}
		}else{
			$this->Flash->error(__('Este token ya ha sido utilizado.'));
			return $this->redirect(['action'=>'login']);
		}
	}

    public function changepassword($id = null)
    {
        $user = $this->Users->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Se ha modificado la contraseña.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('La contraseña no pudo ser modificada. Por favor, intente nuevamente.'));
        }
        $this->set(compact('user'));
    }

    public function getUsersMarkers() {
		$this->viewBuilder()->setLayout('ajax');
        if ($this->controllerUser['isAdmin'] || $this->controllerUser['isGeneralCoordinator']){
			$users = $this->Users->find('all')->distinct(['Users.id'])->where(['Users.profile_id IN' => [4,5,6,7]])
				->contain(['Profiles', 'Pacients', 'Groups' => 'Nets'])->leftJoinWith('Groups');
		} elseif ($this->controllerUser['isGroupCoordinator']){
            $users = $this->Users->find('all')->distinct(['Users.id'])
				->contain(['Profiles', 'Pacients', 'Groups' => 'Nets'])->leftJoinWith('Groups')
				->where(['Users.profile_id IN' => [4,5,6,7], 'Groups.id in' => $this->controllerUser['group_id']]);
        } elseif ($this->controllerUser['isNetCoordinator']){
            $users = $this->Users->find('all')->distinct(['Users.id'])
				->contain(['Profiles', 'Pacients', 'Groups' => 'Nets'])->leftJoinWith('Groups')
				->where(['Users.profile_id IN' => [4,5,6,7], 'Groups.id' => $this->controllerUser['group_id'], 'GroupsUsers.net_id' => $this->controllerUser['net_id']]);
        } elseif ($this->controllerUser['isNodeCoordinator']){
            $users = $this->Users->find('all')->distinct(['Users.id'])
				->contain(['Profiles', 'Pacients', 'Groups' => 'Nets'])->leftJoinWith('Groups')
				->where(['Users.profile_id IN' => [4,5,6,7], 'Groups.id' => $this->controllerUser['group_id'], 'GroupsUsers.net_id' => $this->controllerUser['net_id'], 
                'GroupsUsers.main_gate' => $this->controllerUser['main_gate']]);
        } elseif ($this->controllerUser['isTacticOperator']){
            $users = $this->Users->find('all')->distinct(['Users.id'])
				->contain(['Profiles', 'Pacients', 'Groups' => 'Nets'])->leftJoinWith('Groups')
				->where(['Users.profile_id IN' => [4,5,6,7], 'Groups.id' => $this->controllerUser['group_id'], 'GroupsUsers.net_id' => $this->controllerUser['net_id'], 
                'GroupsUsers.main_gate' => $this->controllerUser['main_gate']]);
        } elseif ($this->controllerUser['isSanitaryAgent'] ){
            $users = $this->Users->find('all')->distinct(['Users.id'])
				->contain(['Profiles', 'Pacients', 'Groups' => 'Nets'])->leftJoinWith('Groups')
				->where(['Users.profile_id IN' => [4,5,6,7], 'Groups.id' => $this->controllerUser['group_id'], 'GroupsUsers.net_id' => $this->controllerUser['net_id'], 
                'GroupsUsers.main_gate' => $this->controllerUser['main_gate']]);
        }

        $jsonResponse = ["type" => "FeatureCollection", "features" => []];
		foreach($users as $user){
            $properties["name"] = $user->full_name;
            $properties["profile_id"] = $user->profile->id;
            $properties["profile"] = $user->profile->name;
            if(!empty($user->groups)){
				$properties["group"] = "";
				$properties["net"] = "";
				$properties["gate"] = "";
				foreach($user->groups as $group){
					if(!empty($properties["group"])) $properties["group"] .= "<br />";
					$properties["group"] .= $group->group_name;
					if(!empty($group->_joinData->net_id)){
						$i = $group->_joinData->net_id - 1;
						$properties["net"] = $group->nets[$i]->net_name;
					}
					if(!empty($group->_joinData->main_gate)) $properties["gate"] = $group->_joinData->main_gate;
				}
			}
            if($user->has("pacients")){
                $properties["pacients"] = '';
                foreach ($user->pacients as $pacient){
                    $properties["pacients"] .= '<br/>'. $pacient->name . ' '. $pacient->lastname;
                }
            }
			$geometry = ["type" => "Point", "coordinates" => [$user->map_long, $user->map_lat]];
            $properties["avatar"] = $user->image_file_name_url;  
        
            switch($user->profile->id){
                case 4: $properties["icon"] = Router::url("/", true).'img/marker-cuf.png'; break;
                case 5: $properties["icon"] = Router::url("/", true).'img/marker-rn.png'; break;
                case 6: $properties["icon"] = Router::url("/", true).'img/marker-ot.png'; break;
                case 7: $properties["icon"] = Router::url("/", true).'img/marker-as.png'; break;
                default: $properties["icon"] = 'unknown'; break;
            }
			$feature = ["type" => "Feature", "properties" => $properties, "geometry" => $geometry];
            array_push($jsonResponse["features"], $feature);
        }
        $this->set(compact('jsonResponse'));
    }

    public function getUserMarkers($id) {
		$this->viewBuilder()->setLayout('ajax');
        $user = $this->Users->get($id, ['contain' => ['Profiles', 
			'Groups' => function ($q) use ($id) {
				return $q->contain(['Nets'])->leftJoinWith('GroupsUsers')->where(['GroupsUsers.user_id' => $id]);
			}
		]]);

        $jsonResponse = ["type" => "FeatureCollection", "features" => []];
		$properties["name"] = $user->full_name;
		$properties["profile_id"] = $user->profile->id;
		$properties["profile"] = $user->profile->name;
		if(!empty($user->groups)){
			$properties["group"] = "";
			$properties["net"] = "";
			$properties["gate"] = "";
			foreach($user->groups as $group){
				if(!empty($properties["group"])) $properties["group"] .= "<br />";
				$properties["group"] .= $group->group_name;
				if(!empty($group->_joinData->net_id)){
					$i = $group->_joinData->net_id - 1;
					$properties["net"] = $group->nets[$i]->net_name;
				}
				if(!empty($group->_joinData->main_gate)) $properties["gate"] = $group->_joinData->main_gate;
			}
		}
		if(!empty($user->pacients)){
			$properties["pacients"] = '';
			foreach ($user->pacients as $pacient){
				$properties["pacients"] .= '<br/>'. $pacient->name . ' '. $pacient->lastname;
			}
		}
		$geometry = ["type" => "Point", "coordinates" => [$user->map_long, $user->map_lat]];
		$properties["avatar"] = $user->image_file_name_url;  
	
		switch($user->profile->id){
			case 4: $properties["icon"] = Router::url("/", true).'img/marker-cuf.png'; break;
			case 5: $properties["icon"] = Router::url("/", true).'img/marker-rn.png'; break;
			case 6: $properties["icon"] = Router::url("/", true).'img/marker-ot.png'; break;
			case 7: $properties["icon"] = Router::url("/", true).'img/marker-as.png'; break;
			default: $properties["icon"] = 'unknown'; break;
		}
		$feature = ["type" => "Feature", "properties" => $properties, "geometry" => $geometry];
		array_push($jsonResponse["features"], $feature);
        $this->set(compact('jsonResponse'));
    }

    public function setgeo($id = null) {
        $this->viewBuilder()->setLayout('map');
        $user = $this->Users->get($id);
        if ($this->request->is(['post', 'put'])) {
			$user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Los datos del usuario han sido modificados'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(__('No se pudo modificar el usuario'));
        }
        $this->set(compact('user'));
    }
}
?>