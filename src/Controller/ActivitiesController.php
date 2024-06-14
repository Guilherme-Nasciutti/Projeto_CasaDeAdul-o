<?php
namespace App\Controller;

use App\Controller\AppController;
use Exception;

/**
 * Activities Controller
 *
 * @property \App\Model\Table\ActivitiesTable $Activities
 *
 * @method \App\Model\Entity\Activity[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ActivitiesController extends AppController
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
                'contain' => ['Instructors']
            ];

            $activities = $this->paginate($this->Activities);
            $this->set(compact('activities'));

        } catch (Exception $exc) {
            $this->Flash->error('Entre em contato com o administrador do sistema.');
        }
    }

    /**
     * View method
     *
     * @param string|null $id Activity id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        try {
            $activity = $this->Activities->get($id, [
                'contain' => ['Instructors', 'Guests']
            ]);

            $this->set('activity', $activity);

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
            $activity = $this->Activities->newEntity();

            if ($this->request->is('post')) {
                $activity = $this->Activities->patchEntity($activity, $this->request->getData());

                if ($this->Activities->save($activity)) {
                    $this->Flash->success(__('Atividade cadastrada com sucesso.'));
                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('Não foi possivel cadastrar a atividade. Por favor, tente novamente.'));
            }
            $instructors = $this->Activities->Instructors->find('list', ['limit' => 200]);
            $guests = $this->Activities->Guests->find('list', ['limit' => 200]);
            $this->set(compact('activity', 'instructors', 'guests'));

        } catch (Exception $exc) {
            $this->Flash->error('Entre em contato com o administrador do sistema.');
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Activity id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        try {
            $activity = $this->Activities->get($id, [
                'contain' => ['Guests']
            ]);

            if ($this->request->is(['patch', 'post', 'put'])) {
                $activity = $this->Activities->patchEntity($activity, $this->request->getData());

                if ($this->Activities->save($activity)) {
                    $this->Flash->success(__('Atividade editada com sucesso.'));
                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('Não foi possivel editar a atividade. Por favor, tente novamente.'));
            }
            $instructors = $this->Activities->Instructors->find('list', ['limit' => 200]);
            $guests = $this->Activities->Guests->find('list', ['limit' => 200]);
            $this->set(compact('activity', 'instructors', 'guests'));

        } catch (Exception $exc) {
            $this->Flash->error('Entre em contato com o administrador do sistema.');
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id Activity id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        try {
            $this->request->allowMethod(['post', 'delete']);
            $activity = $this->Activities->get($id);

            $this->Activities->delete($activity) ?
            $this->Flash->success(__('Atividade apagada com sucesso.')) :
            $this->Flash->error(__('Não foi possivel apagar a atividade. Por favor, tente novamente.'));

            return $this->redirect(['action' => 'index']);

        } catch (Exception $exc) {
            $this->Flash->error('Entre em contato com o administrador do sistema.');
        }
    }
}
