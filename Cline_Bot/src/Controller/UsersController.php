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
            return $this->redirect(['action' => 'login']);
        }

        // If not authenticated, redirect to login page
        return $this->redirect(['action' => 'login']);
    }

    public function dashboard()
    {
        $this->viewBuilder()->setLayout('auth');
        $user = $this->Authentication->getIdentity();
        $this->set(compact('user'));
    }

    public function edit()
    {
        $this->viewBuilder()->setLayout('auth');
        $userId = $this->Authentication->getIdentity()->getIdentifier();
        $user = $this->Users->get($userId);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();

            // Only allow updating username, description, and avatar_path
            $allowedFields = ['username', 'description', 'avatar_path'];
            $filteredData = [];
            foreach ($allowedFields as $field) {
                if (isset($data[$field])) {
                    $filteredData[$field] = $data[$field];
                }
            }

            $user = $this->Users->patchEntity($user, $filteredData);
            if ($this->Users->save($user)) {
                // Refresh the authentication identity to include updated data
                $this->Authentication->setIdentity($user);

                $this->Flash->success(__('Your profile has been updated.'));
                return $this->redirect(['action' => 'dashboard']);
            }
            $this->Flash->error(__('Unable to update your profile. Please try again.'));
        }

        $this->set(compact('user'));
    }
}
