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
			$statesxDays = $this->StatesxDays->newEntities($this->request->getData(), ['associated' => ['Users' => ['onlyIds' => true]]]);
			debug($statesxDays);
			foreach($statesxDays as $key => $data){
				$data->user->status = $this->request->getData($key.".StatesxDays.status");
				$guardar = $this->StatesxDays->save($data);
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
					$this->Users->updateAll(['active'=>$active],['Users.id'=>$user->id]);
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
        $this->loadModel('Turns');
		$statesxDay = $this->StatesxDays->newEmptyEntity();
        if ($this->request->is('post')) {
			$guardar = false;
			$statesxDays = $this->StatesxDays->newEntities($this->request->getData(), ['associated' => ['Pacients' => ['onlyIds' => true]]]);
			debug($statesxDays);
			foreach($statesxDays as $key => $data){
				$data->pacient->status = $this->request->getData($key.".StatesxDays.status");
				$guardar = $this->StatesxDays->save($data);
				/* $turnos = $this->Turns->find('all')->where(['Turns.group_id' => $this->request->getData($key.'.StatesxDays.group_id'),
					'Turns.net_id' => $this->request->getData($key.'.StatesxDays.net_id'),'Turns.main_gate' => $this->request->getData($key.'.StatesxDays.main_gate'),
					'Turns.pacient_id' => $this->request->getData($key.'.StatesxDays.pacient_id'),'Turns.return_date >'=>date('Y-m-d')])->first();
				if(!empty($turnos) && !empty($this->request->getData($key.'.pacient.isolated'))){
					$fecha_actual = date("Y-m-d");
					$return_date = date("Y-m-d",strtotime($fecha_actual."+ 2 days"));
					$return_time = date("H:i:s");
					$this->Turns->updateAll(['return_date'=>$return_date,'return_time'=>$return_time],['Turns.id'=>$turnos->id]);
				} */
			}
			if($guardar){
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
