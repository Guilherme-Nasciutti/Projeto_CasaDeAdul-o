<?php
namespace App\Controller;

use App\Controller\AppController;

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
        $this->paginate = [
            'contain' => ['Persons'],
        ];
        $instructors = $this->paginate($this->Instructors);

        $this->set(compact('instructors'));
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
        $instructor = $this->Instructors->get($id, [
            'contain' => ['Persons', 'Activities'],
        ]);

        $this->set('instructor', $instructor);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
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
        $instructor = $this->Instructors->get($id, [
            'contain' => [],
        ]);
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
        $this->request->allowMethod(['post', 'delete']);
        $instructor = $this->Instructors->get($id);
        if ($this->Instructors->delete($instructor)) {
            $this->Flash->success(__('The instructor has been deleted.'));
        } else {
            $this->Flash->error(__('The instructor could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
