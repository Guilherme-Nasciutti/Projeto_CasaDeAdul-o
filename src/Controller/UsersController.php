<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Entity\User;
use Cake\Http\Exception\BadRequestException;
use Cake\Routing\Router;
use Cake\Utility\Security;
use Cake\Mailer\MailerAwareTrait;
use Exception;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow(['logout', 'add', 'rescuePassword', 'changePassword']);
    }

    public function login()
    {
        try {
            if ($this->request->is('post')) {
                $user = $this->Auth->identify();

                if ($user) {
                    $this->Auth->setUser($user);
                    return $this->redirect($this->Auth->redirectUrl());
                }
                $this->Flash->error('E-mail ou senha incorreto(s).');
            }

        } catch (Exception $exc) {
            $this->Flash->error('Entre em contato com o administrador do sistema.');
        }
    }

    public function logout()
    {
        try {
            $this->Flash->success('Deslogado com sucesso!');
            return $this->redirect($this->Auth->logout());

        } catch (Exception $exc) {
            $this->Flash->error('Entre em contato com o administrador do sistema.');
        }
    }

    public function home()
    {
        try {
            $full_name = $this->Auth->user('full_name');
            $this->set(compact('full_name'));
        } catch (Exception $exc) {
            $this->Flash->error('Entre em contato com o administrador do sistema.');
        }
    }

    public function profile()
    {
        try {
            $user = $this->Auth->user();
            $this->set(compact('user'));
        } catch (Exception $exc) {
            $this->Flash->error('Entre em contato com o administrador do sistema.');
        }
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        try {
            $users = $this->paginate($this->Users);
            $this->set(compact('users'));

        } catch (Exception $exc) {
            $this->Flash->error('Entre em contato com o administrador do sistema.');
        }
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        try {
            $user = $this->Users->get($id);
            $this->set('user', $user);

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
            $user = $this->Users->newEntity();

            if ($this->request->is('post')) {
                $user = $this->Users->patchEntity($user, $this->request->getData());

                if ($this->Users->save($user)) {
                    $this->Flash->success(__('Administrador cadastrador com sucesso.'));
                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('Não foi possivel cadastrar o administrador. Por favor, tente novamente.'));
            }
            $this->set(compact('user'));

        } catch (Exception $exc) {
            $this->Flash->error('Entre em contato com o administrador do sistema.');
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        try {
            $user = $this->Users->get($id);

            if ($this->request->is(['patch', 'post', 'put'])) {
                $user = $this->Users->patchEntity($user, $this->request->getData());

                if ($this->Users->save($user)) {
                    $this->Flash->success(__('Administrador editado com sucesso.'));
                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('Não foi possivel editar o administrador. Por favor, tente novamente.'));
            }
            $this->set(compact('user'));

        } catch (Exception $exc) {
            $this->Flash->error('Entre em contato com o administrador do sistema.');
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        try {
            $this->request->allowMethod(['post', 'delete']);
            $user = $this->Users->get($id);

            $this->Users->delete($user) ?
            $this->Flash->success(__('Administrador apagado com sucesso.')) :
            $this->Flash->error(__('Não foi possivel apagar o administrador. Por favor, tente novamente.'));

            return $this->redirect(['action' => 'index']);

        } catch (Exception $exc) {
            $this->Flash->error('Entre em contato com o administrador do sistema.');
        }
    }

    use MailerAwareTrait;
    public function rescuePassword()
    {
        try {
            $user = $this->Users->newEntity();

            if ($this->request->is('post')) {
                $user_exist = $this->Users->getUserByEmail($this->request->getData('email'));

                if ($user_exist) {
                    $user_rescue = $this->Users->getRescuePassword($user_exist->id);
                    $user->password_reset_token = $this->createTokenForPassword($user_rescue->id);

                    $user->id = $user_rescue->id;

                    if ($this->Users->save($user)) {
                        $user_mailer = $this->setValuesToUsermailer($user_rescue, $user->password_reset_token);

                        // Notifica o usuário com link
                        $this->getMailer('Email')->send('sendLinkPassword', [$user_mailer]);

                        $this->Flash->success(__('E-mail enviado com sucesso, verifique sua caixa de entrada!'));
                        return $this->redirect(['controller' => 'Users', 'action' => 'login']);
                    }
                    $this->Flash->error(__('Não foi possível enviar o e-mail! Por favor, tente novamente.'));
                }
                $this->Flash->error(__('O e-mail informado não se encontra cadastrado! Por favor, verifique e tente novamente.'));
            }

        } catch (Exception $exc) {
            $this->Flash->error(__('Erro desconhecido! Por favor, entre em contato com o suporte.'.$exc));
        } finally {
            $this->set(compact('user'));
        }
    }

    private function createTokenForPassword($id_user)
    {
        return Security::hash(
            $this->request->getData('email') . $id_user . date('Y-m-d H:i:s'),
            'sha256',
            false
        );
    }

    private function setValuesToUsermailer($user_rescue, $token)
    {
        $user_mailer = new User();
        $user_mailer->name = $user_rescue->full_name;
        $user_mailer->email = $user_rescue->email;
        $user_mailer->password_reset_token = $token;
        $user_mailer->host_name = Router::fullBaseUrl() . $this->request->getAttribute('webroot');

        return $user_mailer;
    }

    public function changePassword($token = null)
    {
        try {
            $user = $this->tokenIsValid();

            if ($this->request->is(['patch', 'post', 'put'])) {
                $user = $this->Users->patchEntity($user, $this->request->getData());
                $user->password_reset_token = null;

                if ($this->Users->save($user)) {
                    $this->Flash->success(__('Nova senha cadastrada com sucesso!'));
                    return $this->redirect(['controller' => 'Users', 'action' => 'login']);
                }
                $this->Flash->error(__('Não foi possível cadastrar uma nova senha! Por favor, tente novamente.'));
            }
            $this->set(compact('user'));

        } catch (BadRequestException $exc) {
            $this->Flash->error(__($exc->getMessage()));
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);

        } catch (Exception $exc) {
            $this->Flash->error(__('Erro desconhecido! Por favor, entre em contato com o suporte.'));
        }
    }

    private function tokenIsValid()
    {
        $user = $this->Users->getUserByPasswordToken($this->request->getParam('token'));

        if (!$user) {
            throw new BadRequestException('Página não encontrada!');
        }
        return $user;
    }
}
