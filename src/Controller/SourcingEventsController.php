<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Orm\Entity;

/**
 * SourcingEvents Controller
 *
 * @property \App\Model\Table\SourcingEventsTable $SourcingEvents
 * @method \App\Model\Entity\SourcingEvent[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SourcingEventsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Profiles'],
        ];
        $sourcingEvents = $this->paginate($this->SourcingEvents);

        $this->set(compact('sourcingEvents'));
    }

    /**
     * View method
     *
     * @param string|null $id Sourcing Event id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $sourcingEvent = $this->SourcingEvents->get($id, [
            'contain' => ['Profiles'],
        ]);

        $this->set(compact('sourcingEvent'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$this->loadModel("ProfilesGates");
        $sourcingEvent = $this->SourcingEvents->newEmptyEntity();
		if ($this->request->is('post')) {
			$sourcingEvent = $this->SourcingEvents->patchEntity($sourcingEvent, $this->request->getData(), ['associated' => 'Profiles']);
			debug($sourcingEvent);
			if(!empty($sourcingEvent->profiles)) {
				foreach($sourcingEvent->profiles as $key => $profile){
					if(!empty($profile->id)){
						$main_gate = $this->request->getData('profiles.'.$key.'._joinData.main_gate');
						$profile->_joinData = new Entity(['main_gate' => $main_gate], ['markNew' => true]);
					}
				}
			}
			if ($this->SourcingEvents->save($sourcingEvent)) {
				$this->Flash->success(__('El evento ha sido creado'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Flash->error(__('No se pudo crear el evento'));
		}
		$profiles = $this->ProfilesGates->find('all')->contain('Profiles');
        $this->set(compact('sourcingEvent', 'profiles'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Sourcing Event id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $sourcingEvent = $this->SourcingEvents->get($id, [
            'contain' => ['Profiles'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $sourcingEvent = $this->SourcingEvents->patchEntity($sourcingEvent, $this->request->getData());
            if ($this->SourcingEvents->save($sourcingEvent)) {
                $this->Flash->success(__('El evento de abastecimiento ha sido modificado.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('El evento de abastecimiento no pudo ser modificado. Por favor, intente nuevamente.'));
        }
        $profiles = $this->SourcingEvents->Profiles->find('list', ['limit' => 200])->all();
        $this->set(compact('sourcingEvent', 'profiles'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Sourcing Event id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $sourcingEvent = $this->SourcingEvents->get($id);
        if ($this->SourcingEvents->delete($sourcingEvent)) {
            $this->Flash->success(__('El evento de abastecimiento ha sido eliminado.'));
        } else {
            $this->Flash->error(__('El evento de abastecimiento no pudo ser eliminado. Por favor, intente nuevamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
