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
                'contain' => ['Persons']
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

                if ($this->Guests->save($guest, ['associated' => ['Persons']])) {
                    $this->Flash->success(__('Hóspede cadastrado com sucesso.'));
                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('Não foi possivel cadastrar o hóspede. Por favor, tente novamente.'));
            }
            $this->set(compact('guest'));

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
                'contain' => ['Persons']
            ]);

            if ($this->request->is(['patch', 'post', 'put'])) {
                $guest = $this->Guests->patchEntity($guest, $this->request->getData());

                if ($this->Guests->save($guest, ['associated' => ['Persons']])) {
                    $this->Flash->success(__('Hóspede editado com sucesso.'));
                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('Não foi possivel editar o instrutor. Por favor, tente novamente.'));
            }
            $this->set(compact('guest'));

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
            $this->Flash->success(__('Hóspede apagado com sucesso..')) :
            $this->Flash->error(__('Não foi possivel apagar o hóspede. Por favor, tente novamente.'));

            return $this->redirect(['action' => 'index']);

        } catch (Exception $exc) {
            $this->Flash->error('Entre em contato com o administrador do sistema.');
        }
    }
}
