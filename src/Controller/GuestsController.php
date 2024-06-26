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
            $conditions = $this->filterDefault();
            $guests = $this->paginate($this->Guests->findAllGuestsByConditions($conditions));
            $this->set(compact('guests'));

        } catch (Exception $exc) {
            $this->Flash->error('Entre em contato com o administrador do sistema.');
        }
    }

    private function filterDefault()
    {
        $conditions = [];

        if (!empty($this->request->getQuery('filter'))) {
            $conditions[] = [
                'OR' => [
                    'persons.first_name like' => '%' . $this->request->getQuery('filter') . '%'
                ]
            ];
        }
        return $conditions;
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
            $this->infoMessageStatus();
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
            $this->infoMessageStatus();

            $guest = $this->Guests->get($id, [
                'contain' => ['Persons']
            ]);

            if ($this->request->is(['patch', 'post', 'put'])) {
                $guest = $this->Guests->patchEntity($guest, $this->request->getData());

                if ($this->Guests->save($guest, ['associated' => ['Persons']])) {
                    $this->Flash->success(__('Hóspede editado com sucesso.'));
                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('Não foi possivel editar o hóspede. Por favor, tente novamente.'));
            }
            $this->set(compact('guest'));

        } catch (Exception $exc) {
            $this->Flash->error('Entre em contato com o administrador do sistema.');
        }
    }

    private function infoMessageStatus()
    {
        $this->Flash->warning(__('A situação do hóspede quando ATIVO, permite o vinculo á atividade!'));
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
            $this->Flash->success(__('Hóspede apagado com sucesso.')) :
            $this->Flash->error(__('Não foi possivel apagar o hóspede. Por favor, tente novamente.'));

            return $this->redirect(['action' => 'index']);

        } catch (Exception $exc) {
            $this->Flash->error('Entre em contato com o administrador do sistema.');
        }
    }

    /**
     * Change the status of a guest.
     *
     * @param int|null $id The ID of the guest.
     * @return \Cake\Http\Response|null The response after changing the status.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When the guest record is not found.
     */
    public function changeStatus($id = null)
    {
        try {
            if ($this->request->is(['patch', 'post', 'put'])) {
                $guest = $this->Guests->get($id);

                $person = $this->Guests->Persons->get($guest->person_id);
                $person->status = ($person->status == StatusENUM::ATIVO) ?
                    StatusENUM::INATIVO :
                    StatusENUM::ATIVO;

                if ($this->Guests->Persons->save($person)) {
                    $this->Flash->success(__('Situação alterada com sucesso.'));
                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('Não foi possivel alterar a situação do hóspede. Por favor, tente novamente.'));
            }

        } catch (Exception $exc) {
            $this->Flash->error('Entre em contato com o administrador do sistema.');
        }
    }
}
