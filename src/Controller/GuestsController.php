<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Guests Controller
 *
 * @property \App\Model\Table\GuestsTable $Guests
 *
 * @method \App\Model\Entity\Guest[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class GuestsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Persons'],
        ];
        $guests = $this->paginate($this->Guests);

        $this->set(compact('guests'));
    }

    /**
     * View method
     *
     * @param string|null $id Guest id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $guest = $this->Guests->get($id, [
            'contain' => ['Persons', 'Activities'],
        ]);

        $this->set('guest', $guest);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $guest = $this->Guests->newEntity();
        if ($this->request->is('post')) {
            $guest = $this->Guests->patchEntity($guest, $this->request->getData());
            if ($this->Guests->save($guest)) {
                $this->Flash->success(__('The guest has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The guest could not be saved. Please, try again.'));
        }
        $persons = $this->Guests->Persons->find('list', ['limit' => 200]);
        $activities = $this->Guests->Activities->find('list', ['limit' => 200]);
        $this->set(compact('guest', 'persons', 'activities'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Guest id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $guest = $this->Guests->get($id, [
            'contain' => ['Activities'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $guest = $this->Guests->patchEntity($guest, $this->request->getData());
            if ($this->Guests->save($guest)) {
                $this->Flash->success(__('The guest has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The guest could not be saved. Please, try again.'));
        }
        $persons = $this->Guests->Persons->find('list', ['limit' => 200]);
        $activities = $this->Guests->Activities->find('list', ['limit' => 200]);
        $this->set(compact('guest', 'persons', 'activities'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Guest id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $guest = $this->Guests->get($id);
        if ($this->Guests->delete($guest)) {
            $this->Flash->success(__('The guest has been deleted.'));
        } else {
            $this->Flash->error(__('The guest could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
