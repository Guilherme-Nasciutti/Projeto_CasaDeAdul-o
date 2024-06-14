<?php
namespace App\Controller;

use App\Controller\AppController;
use Exception;

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
        try {
            $this->paginate = [
                'contain' => ['Persons'],
            ];

            $guests = $this->paginate($this->Guests);
            $this->set(compact('guests'));

        } catch (Exception $exc) {
            $this->Flash->error('Entre em contato com o administrador do sistema.');
        }
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
        try {
            $guest = $this->Guests->get($id, [
                'contain' => ['Persons', 'Activities']
            ]);

            $this->set('guest', $guest);

        } catch (Exception $exc) {
            $this->Flash->error('Entre em contato com o administrador do sistema.');
        }
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        try {
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

        } catch (Exception $exc) {
            $this->Flash->error('Entre em contato com o administrador do sistema.');
        }
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
        try {
            $guest = $this->Guests->get($id, [
                'contain' => ['Activities']
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

        } catch (Exception $exc) {
            $this->Flash->error('Entre em contato com o administrador do sistema.');
        }
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
        try {
            $this->request->allowMethod(['post', 'delete']);
            $guest = $this->Guests->get($id);

            $this->Guests->delete($guest) ?
            $this->Flash->success(__('The guest has been deleted.')) :
            $this->Flash->error(__('The guest could not be deleted. Please, try again.'));

            return $this->redirect(['action' => 'index']);

        } catch (Exception $exc) {
            $this->Flash->error('Entre em contato com o administrador do sistema.');
        }
    }
}
