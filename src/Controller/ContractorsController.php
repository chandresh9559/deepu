<?php

declare(strict_types=1);
namespace App\Controller;


class ContractorsController extends AppController

{

    public function beforeFilter(\Cake\Event\EventInterface $event){
        parent::beforeFilter($event);
        $this->loadModel('Users');
        $this->loadModel('UserProfile');
        $this->loadModel('Projects');
        $this->loadModel('Services');
        $this->loadModel('AssignedUsers');
        $this->viewBuilder()->setLayout('scgc_layout');
    }

/*********************MyProfile ********************** */

    public function gcProfile()
    {
        $services = $this->paginate($this->Services);
        $auth = $this->Authentication->getIdentity();
        $id = $auth->id;
        $this->viewBuilder()->setLayout('scgc_layout');
        $gc = $this->Users->get($id,['contain' => ['UserProfile']]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $gc->user_services['user_id']=$id;
            $user = $this->Users->patchEntity($gc, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('gc','services'));
    }

/********************************************* */

    public function assignedProjectList(){

        $assignedUsers = $this->paginate($this->Projects,['contain'=>['Users','UserProfile']]);
        // dd($assignedUsers);
        $this->set(compact('assignedUsers'));
    }

/*********************Project Details************************ */
    public function projectDetails($id = null)
    {
        $assigned = $this->Projects->get($id, [
            'contain' => ['Users','UserProfile'],
        ]);
        $services = $this->paginate($this->Services);
        $this->set(compact('assigned','services'));
    }

/********************************************* */

    public function scProfile(){
            $auth = $this->Authentication->getIdentity();
            $id = $auth->id;
            $this->viewBuilder()->setLayout('scgc_layout');
            $sc = $this->Users->get($id,['contain' => ['UserProfile']]);
            if ($this->request->is(['patch', 'post', 'put'])) {
                $user = $this->Users->patchEntity($sc, $this->request->getData());
                if ($this->Users->save($user)) {
                    $this->Flash->success(__('The user has been saved.'));
                    return $this->redirect(['action' => 'index']);
                }
        $this->Flash->error(__('The user could not be saved. Please, try again.'));
    }
    $this->set(compact('sc' ));
    }
}
