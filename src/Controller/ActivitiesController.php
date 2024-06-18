<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Http\Exception\BadRequestException;
use ErrorException;
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
                'contain' => ['Instructors' => 'Persons']
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
                'contain' => ['Instructors' => 'Persons', 'Guests' => 'Persons']
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

        } catch (Exception $exc) {
            $this->Flash->error('Entre em contato com o administrador do sistema.');
        } finally {
            $instructors = $this->Activities->Instructors->findInstructorsCreatingIdAndNameForList();
            $this->isThereData($instructors, 'instrutor');
            $guests = $this->Activities->Guests->find('all', ['contain' => 'Persons'])->toList();
            $this->isThereData($guests, 'hóspede');

            $this->set(compact('activity', 'instructors', 'guests'));
        }
    }

    private function isThereData($data, $message)
    {
        if (empty($data)) {
            $this->Flash->error(__('Atividade não cadastrada! Por favor, revise as informações e tente novamente.'));
            $this->Flash->warning(__('Por favor, cadastre pelo menos um ' . $message . ' para que seja possível cadastrar uma atividade!'));
            return $this->redirect(['action' => 'index']);
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

        } catch (Exception $exc) {
            $this->Flash->error('Entre em contato com o administrador do sistema.');
        } finally {
            $instructors = $this->Activities->Instructors->findInstructorsCreatingIdAndNameForList();
            $guests = $this->Activities->Guests->find('all', ['contain' => 'Persons'])->toList();
            $guest_associated_activity = $this->findGuestsAssociatedActivity($id);

            $this->set(compact('activity', 'instructors', 'guests', 'guest_associated_activity'));
        }
    }

    /**
     * Busca vinculo de hóspedes e atividade
     */
    private function findGuestsAssociatedActivity($activity_id)
    {
        $this->loadModel('Guests_Activities');

        return $this->Guests_Activities->find('list', [
            'valueField' => 'guest_id'
            ])->where([
                'activity_id ' => $activity_id
            ])
        ->toList();
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
