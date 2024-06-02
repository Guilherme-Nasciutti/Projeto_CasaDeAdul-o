<?php
namespace App\Controller;

use App\Controller\AppController;
use Exception;

/**
 * Persons Controller
 *
 * @property \App\Model\Table\PersonsTable $Persons
 *
 * @method \App\Model\Entity\Person[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PersonsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        try {
            $conditions = [];

            if (!empty($this->request->getQuery('filter'))) {
                $conditions[] = [
                    'OR' => [
                        'persons.first_name like' => '%' . $this->request->getQuery('filter') . '%',
                        'persons.last_name like' => '%' . $this->request->getQuery('filter') . '%',
                        'persons.phone like' => '%' . $this->request->getQuery('filter') . '%',
                    ]
                ];
            }

            $persons = $this->paginate($this->Persons->find('all', ['contain' => ['Roles']])->where($conditions))->toList();
            $this->set(compact('persons'));

        } catch (Exception $exc) {
            $this->Flash->error('Entre em contato com o administrador do sistema.');
        }
    }

    /**
     * View method
     *
     * @param string|null $id Person id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        try {
            $person = $this->Persons->get($id, [
                'contain' => ['Roles']
            ]);

            $this->set('person', $person);

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
            $person = $this->Persons->newEntity();

            if ($this->request->is('post')) {
                $person = $this->Persons->patchEntity($person, $this->request->getData());

                if ($this->Persons->save($person)) {
                    $this->Flash->success(__('Pessoa cadastrada com sucesso.'));
                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('Não foi possivel cadastrar a pessoa. Por favor, tente novamente.'));
            }

        } catch (Exception $exc) {
            $this->Flash->error('Entre em contato com o administrador do sistema.');

        } finally {
            $roles = $this->Persons->Roles->find('list');
            $this->set(compact('person', 'roles'));
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Person id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        try {
            $person = $this->Persons->get($id);

            if ($this->request->is(['patch', 'post', 'put'])) {
                $person = $this->Persons->patchEntity($person, $this->request->getData());

                if ($this->Persons->save($person)) {
                    $this->Flash->success(__('Pessoa editada com sucesso.'));
                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('Não foi possivel editar a pessoa. Por favor, tente novamente.'));
            }

        } catch (Exception $exc) {
            $this->Flash->error('Entre em contato com o administrador do sistema.');

        } finally {
            $roles = $this->Persons->Roles->find('list');
            $this->set(compact('person', 'roles'));
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id Person id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        try {
            $this->request->allowMethod(['post', 'delete']);
            $person = $this->Persons->get($id);

            $this->Persons->delete($person) ?
            $this->Flash->success(__('Pessoa apagada com sucesso.')) :
            $this->Flash->error(__('Não foi possivel apagar a pessoa. Por favor, tente novamente.'));

            return $this->redirect(['action' => 'index']);

        } catch (Exception $exc) {
            $this->Flash->error('Entre em contato com o administrador do sistema.');
        }
    }
}
