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
            $this->paginate = [
                'contain' => ['Persons']
            ];

            $instructors = $this->paginate($this->Instructors);
            $this->set(compact('instructors'));

        } catch (Exception $exc) {
            $this->Flash->error('Entre em contato com o administrador do sistema.');
        }
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
                'contain' => ['Persons', 'Activities'],
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

                if ($this->Instructors->save($instructor)) {
                    $this->Flash->success(__('The instructor has been saved.'));
                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('The instructor could not be saved. Please, try again.'));
            }
            $persons = $this->Instructors->Persons->find('list', ['limit' => 200]);
            $this->set(compact('instructor', 'persons'));

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
            $instructor = $this->Instructors->get($id);

            if ($this->request->is(['patch', 'post', 'put'])) {
                $instructor = $this->Instructors->patchEntity($instructor, $this->request->getData());

                if ($this->Instructors->save($instructor)) {
                    $this->Flash->success(__('The instructor has been saved.'));
                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('The instructor could not be saved. Please, try again.'));
            }
            $persons = $this->Instructors->Persons->find('list', ['limit' => 200]);
            $this->set(compact('instructor', 'persons'));

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
            $this->Flash->success(__('The instructor has been deleted.')) :
            $this->Flash->error(__('The instructor could not be deleted. Please, try again.'));

            return $this->redirect(['action' => 'index']);

        } catch (Exception $exc) {
            $this->Flash->error('Entre em contato com o administrador do sistema.');
        }
    }
}
