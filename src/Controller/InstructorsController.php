<?php
namespace App\Controller;

use App\Controller\AppController;
use Exception;

/**
 * Instructors Controller
 *
 * @property \App\Model\Table\InstructorsTable $Instructors
 *
 * @method \App\Model\Entity\Instructor[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class InstructorsController extends AppController
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
            $instructors = $this->paginate($this->Instructors->findAllInstructorsByConditions($conditions))->toList();
            $this->set(compact('instructors'));

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
     * @param string|null $id Instructor id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        try {
            $instructor = $this->Instructors->get($id, [
                'contain' => ['Persons']
            ]);

            $this->set('instructor', $instructor);

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
            $instructor = $this->Instructors->newEntity();

            if ($this->request->is('post')) {
                $instructor = $this->Instructors->patchEntity($instructor, $this->request->getData());
                $instructor->person->status = StatusENUM::ATIVO;

                if ($this->Instructors->save($instructor, ['associated' => ['Persons']])) {
                    $this->Flash->success(__('Instrutor cadastrado com sucesso.'));
                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('Não foi possivel cadastrar o instrutor. Por favor, tente novamente.'));
            }
            $this->set(compact('instructor'));

        } catch (Exception $exc) {
            $this->Flash->error('Entre em contato com o administrador do sistema.');
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Instructor id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        try {
            $instructor = $this->Instructors->get($id, [
                'contain' => ['Persons']
            ]);

            if ($this->request->is(['patch', 'post', 'put'])) {
                $instructor = $this->Instructors->patchEntity($instructor, $this->request->getData());

                if ($this->Instructors->save($instructor, ['associated' => ['Persons']])) {
                    $this->Flash->success(__('Instrutor editado com sucesso.'));
                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('Não foi possivel editar o instrutor. Por favor, tente novamente.'));
            }
            $this->set(compact('instructor'));

        } catch (Exception $exc) {
            $this->Flash->error('Entre em contato com o administrador do sistema.');
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id Instructor id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        try {
            $this->request->allowMethod(['post', 'delete']);
            $instructor = $this->Instructors->get($id);

            $this->Instructors->delete($instructor) ?
            $this->Flash->success(__('Instrutor apagado com sucesso.')) :
            $this->Flash->error(__('Não foi possivel apagar o instrutor. Por favor, tente novamente.'));

            return $this->redirect(['action' => 'index']);

        } catch (Exception $exc) {
            $this->Flash->error('Entre em contato com o administrador do sistema.');
        }
    }
}
