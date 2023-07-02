<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * StatesxDays Controller
 *
 * @property \App\Model\Table\StatesxDaysTable $StatesxDays
 * @method \App\Model\Entity\StatesxDay[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class StatesxDaysController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index() {
        $this->paginate = [
            'contain' => ['Users', 'Groups', 'Nets', 'Pacients'],
        ];
		if($this->controllerUser["isNetCoordinator"]){
			$statesxDays = $this->paginate($this->StatesxDays->find("all")->where(['date'=>date("Y-m-d"),'StatesxDays.group_id' => $this->controllerUser['group_id'],
				'StatesxDays.net_id' => $this->controllerUser['net_id']]));
		}else{
			$statesxDays = $this->paginate($this->StatesxDays->find("all")->where(['date'=>date("Y-m-d")]));
		}
        $this->set(compact('statesxDays'));
	}

    /**
     * View method
     *
     * @param string|null $id Estadosx Dia id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $statesxDay = $this->StatesxDays->get($id, [
            'contain' => ['Users', 'Groups', 'Nets', 'Pacients'],
        ]);

        $this->set(compact('statesxDay'));
    }

    public function addUser() {
        $this->loadModel('SourcingEvents');
		$statesxDay = $this->StatesxDays->newEmptyEntity();
        if ($this->request->is('post')) {
			$guardar = false;
			$user = $this->StatesxDays->Users->newEntities($this->request->getData(), [
				'associated' => [
					'StatesxDays' => [
						'associated' => [
							'Users' => [
								'onlyIds' => true
							]
						]
					]
				]
			]);
			debug($user);
			foreach($user->statesx_days as $data){
				/*$isolated = (!empty($this->request->data['Users']['isolated'][$key])) ? $this->request->data['Users']['isolated'][$key] : 0;
				$data = array('StatesxDays' => array('status'=>$value,'isolated'=>$isolated,'date'=>$this->request->data['Users']['date'][$key],
					'hora'=>$this->request->data['Users']['hora'][$key],'user_id'=>$this->request->data['Users']['user_id'][$key],'doctor_id'=>$this->request->data['Users']['doctor_id'][$key],
					'group_id'=>$this->request->data['Users']['group_id'][$key],'net_id'=>$this->request->data['Users']['net_id'][$key],
					'main_gate'=>$this->request->data['Users']['main_gate'][$key]));
				$this->StatesxDays->create();*/
				$guardar = $this->StatesxDays->save($data);
				/*if($guardar){
					$user = $this->StatesxDays->Users->get($data->user_id);
					$this->StatesxDays->Users->updateAll(array('status'=>$value,'isolated'=>$isolated),array('Users.id'=>$this->request->getData['Users']['doctor_id'][$key]));
				}*/
			}
			/*if(!empty($this->request->getData('sourcing_event_id'))){
				$sourcingEventsProfiles = $this->SourcingEvents->SourcingEventsProfiles->find('all')->where(['sourcing_event_id'=>$this->request->getData('sourcing_event_id')]);
				$strConditions = "\$conditions = ['OR' => [";
				$i = 0;
				foreach($sourcingEventsProfiles as $value){
					if(!empty($i)) $strConditions .= ",";
					$strConditions .= "['AND' => [['Users.profile_id'=>{$value->profile_id},
						'GroupsUsers.group_id'=>{$this->controllerUser['group_id']},'GroupsUsers.net_id' =>{$this->controllerUser['net_id']}";
					if($value->profile_id>4) $strConditions .= ",'GroupsUsers.main_gate' =>{$value->main_gate}";
					$strConditions .= "]]]";
					$i++;
				}
				$strConditions .= "]];";
				eval($strConditions);
				$users = $this->StatesxDays->Users->find('all')->leftJoinWith('Groups')->where($conditions);
				$active = ($this->request->getData('estado')==1) ? true : false;
				foreach($users as $user){
					$this->Users->updateAll(array('active'=>$active),array('Users.id'=>$user['Users']['id']));
				}
			}*/
			if($guardar){
				$this->Flash->success(__('Se modificaron los estados de los usuarios.'));
				return $this->redirect(['action' => 'index']);
			}
            $this->Flash->error(__('No se pudieron modificar los estados de los usuarios'));
		}
		$users = $this->StatesxDays->Users->find('all')->leftJoinWith('Groups')->where(['GroupsUsers.net_id' => $this->controllerUser['net_id']])
			->contain(['Groups' => ['Nets'], 'Profiles']);
		$sourcingEvents = $this->SourcingEvents->find('list');
		$this->set(compact('statesxDay', 'users', 'sourcingEvents'));
	}

	public function addPacient()
	{
        $statesxDay = $this->StatesxDays->newEmptyEntity();
        if ($this->request->is('post')) {
			$guardar = false;
			$statesxDay = $this->StatesxDays->newEntities($this->request->getData('statesxDays'));
			foreach($statesxDay as $data){
				/* $isolated = (!empty($this->request->data['Pacient']['isolated'][$key])) ? $this->request->data['Pacient']['isolated'][$key] : 0;
				$data = array('StatesxDays'=>array('status' => $value,'isolated'=>$isolated,'date' => $this->request->data['Pacient']['date'][$key],
					'hora' => $this->request->data['Pacient']['hora'][$key],'user_id' => $this->request->data['Pacient']['user_id'][$key],
					'pacient_id' => $this->request->data['Pacient']['pacient_id'][$key],'group_id' => $this->request->data['Pacient']['group_id'][$key],
					'net_id' =>$this->request->data['Pacient']['net_id'][$key],'main_gate' => $this->request->data['Pacient']['main_gate'][$key]));
				$this->StatesxDays->create(); */
				$guardar = $this->StatesxDays->save($data);
				/* $turnos = $this->Turns->find('first',array('conditions'=>array('Turns.group_id' => $this->request->data['Pacient']['group_id'][$key],
					'Turns.net_id' => $this->request->data['Pacient']['net_id'][$key],'Turns.main_gate' => $this->request->data['Pacient']['main_gate'][$key],
					'Turns.pacient_id' => $this->request->data['Pacient']['pacient_id'][$key],'Turns.fecha_volver >'=>date('Y-m-d'))));
				if(!empty($turnos) && !empty($this->request->data['Pacient']['isolated'][$key])){
					$fecha_actual = date("Y-m-d");
					$fecha_volver = date("Y-m-d",strtotime($fecha_actual."+ 2 days"));
					$hora_volver = date("H:i:s");
					$this->Turns->updateAll(array('fecha_volver'=>$fecha_volver,'hora_volver'=>$hora_volver),array('Turns.id'=>$turnos['Turns']['id']));
				} */
			}
			if($guardar){
				/*foreach($this->request->data['Pacient']['statusAlert'] as $key => $status){
					$isolated = (!empty($this->request->data['Users']['isolated'][$key])) ? $this->request->data['Users']['isolated'][$key] : 0;
					$this->Pacient->updateAll(array('statusAlert' => $status,'isolated'=>$isolated),
						array('Pacient.id' => $this->request->data['Pacient']['pacient_id'][$key]));
				}*/
				$this->Flash->success(__('Se cambió el estado de los pacientes.'));
				return $this->redirect(['action' => 'index']);
			}
            $this->Flash->error(__('No se pudo modificar el estado de los pacientes'));
		}
		$pacients = $this->StatesxDays->Pacients->find('all')->where(['Pacients.net_id' => $this->controllerUser['net_id']])->contain(['Groups', 'Nets', 'Users']);
        $this->set(compact('statesxDay', 'pacients'));
	}

    /**
     * Delete method
     *
     * @param string|null $id Estadosx Dia id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $statesxDay = $this->StatesxDays->get($id);
        if ($this->StatesxDays->delete($statesxDay)) {
            $this->Flash->success(__('El estado de alerta ha sido eliminado.'));
        } else {
            $this->Flash->error(__('El estado de alerta no pudo ser eliminado. Por favor, intente nuevamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
