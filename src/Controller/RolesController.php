<?php
namespace App\Controller;

use App\Controller\AppController;
use Exception;

/**
 * Roles Controller
 *
 * @property \App\Model\Table\RolesTable $Roles
 *
 * @method \App\Model\Entity\Role[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RolesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        try {
            $roles = $this->paginate($this->Roles);
            $this->set(compact('roles'));

        } catch (Exception $exc) {
            $this->Flash->error('Entre em contato com o administrador do sistema.');
        }
    }

    /**
     * View method
     *
     * @param string|null $id Role id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        try {
            $role = $this->Roles->get($id);
            $this->set('role', $role);

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
            $role = $this->Roles->newEntity();

            if ($this->request->is('post')) {
                $role = $this->Roles->patchEntity($role, $this->request->getData());

                if ($this->Roles->save($role)) {
                    $this->Flash->success(__('Perfil cadastrado com sucesso.'));
                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('Não foi possivel cadastrar o perfil. Por favor, tente novamente.'));
            }

        } catch (Exception $exc) {
            $this->Flash->error('Entre em contato com o administrador do sistema.');

        } finally {
            $roles_in_use = $this->Roles->findRolesInUse(['type !=' => TypeRolesENUM::OUTRO]);
            $this->set(compact('role', 'roles_in_use'));
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Role id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        try {
            $role = $this->Roles->get($id);

            if ($this->request->is(['patch', 'post', 'put'])) {
                $role = $this->Roles->patchEntity($role, $this->request->getData());

                if ($this->Roles->save($role)) {
                    $this->Flash->success(__('Perfil editado com sucesso.'));
                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('Não foi possivel editar o perfil. Por favor, tente novamente.'));
            }

        } catch (Exception $exc) {
            $this->Flash->error('Entre em contato com o administrador do sistema.');

        } finally {
            $roles_in_use = $this->Roles->findRolesInUse(["type not in" => [TypeRolesENUM::OUTRO, $role->type]]);
            $this->set(compact('role', 'roles_in_use'));
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id Role id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        try {
            $this->request->allowMethod(['post', 'delete']);
            $role = $this->Roles->get($id);

            $this->Roles->delete($role) ?
            $this->Flash->success(__('Perfil apagado com sucesso.')) :
            $this->Flash->error(__('Não foi possivel apagar o perfil. Por favor, tente novamente.'));

            return $this->redirect(['action' => 'index']);

        } catch (Exception $exc) {
            $this->Flash->error('Entre em contato com o administrador do sistema.');
        }
    }
}
