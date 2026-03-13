<?php
namespace App\Controller;

use Cake\Event\EventInterface;

class UsersController extends AppController
{
    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
        // Allow users to register and login.
        // You should not add the "logout" action to this list.
        $this->Authentication->addUnauthenticatedActions(['login', 'register']);
    }

    public function login()
    {
        $this->request->allowMethod(['get', 'post']);
        $result = $this->Authentication->getResult();

        // If the user is already logged in, redirect to dashboard
        if ($result->isValid()) {
            $target = $this->Authentication->getLoginRedirect() ?? '/dashboard';
            return $this->redirect($target);
        }

        if ($this->request->is('post') && !$result->isValid()) {
            $this->Flash->error(__('Invalid email or password, try again'));
        }
    }

    public function register()
    {
        $user = $this->Users->newEmptyEntity();

        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());

            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'login']);
            }

            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }

        $this->set(compact('user'));
    }

    public function logout()
    {
        $result = $this->Authentication->getResult();

        // Allow both GET and POST for logout to work from browser links
        if ($result->isValid()) {
            $this->Authentication->logout();
            return $this->redirect(['controller' => 'Pages', 'action' => 'display', 'home']);
        }

        // If not authenticated, redirect to home
        return $this->redirect(['controller' => 'Pages', 'action' => 'display', 'home']);
    }

    public function dashboard()
    {
        $this->viewBuilder()->setLayout('auth');
        $user = $this->Authentication->getIdentity();
        $this->set(compact('user'));
    }
}
