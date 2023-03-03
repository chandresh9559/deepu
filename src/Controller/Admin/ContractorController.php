<?php
namespace App\Controller\Admin;
use App\Controller\AppController;
use App\Form\ContactForm;
use Cake\ORM\TableRegistry;
use Cake\Mailer\Email;
use Cake\Mailer\Mailer;
use Cake\Mailer\TransportFactory;
use Cake\View\View;

class ContractorController extends AppController{
    public function initialize(): void{
        parent::initialize();
         $this->loadModel('UserProfile');
         $this->loadModel('Users');
        // $this->loadModel('Project');
       
    }
    // gc work
    public function generalListing(){
        $this->viewBuilder()->setLayout('admin_layout');
        $users =  $this->paginate($this->Users->find('all')->contain(['UserProfile'])->where(['user_type'=>2]));
         $this->set(compact('users'));
    }

    public function approv($id = null){
        $this->autoRender = false;
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);
        if($user->status == 0){
            $user->status = 1;
            if($this->Users->save($user)){
                $mailer = new Mailer('default');
                    $mailer->setTransport('gmail'); //your email configuration name
                    $mailer->setFrom(['chandreshck9559@gmail.com' => 'chandresh']);
                    $mailer->setTo($user->email);
                    $mailer->setEmailFormat('text');
                    $mailer->setSubject('Approp Your Account');
                    $mailer->deliver('Dear Owener Your Account is Approved you login successfully');
                  
                    $this->Flash->success(__('Appropped Successfully'));

                    return $this->redirect(['controller' => 'Contractor', 'action' => 'generalListing', 'prefix' => 'Admin']); 
            }
        }

    }
    // soft delete 
    public function deleteRecover($id = null){
       
            $this->autoRender =false;
           
            $users = $this->Users->get($id);
            if($users->status == 1){
                $data = array('id' => $id, 'status' => 2);
            }else{
                $data = array('id' => $id, 'status' => 1);
            }
            $users = $this->Users->patchEntity($users,$data);
           
            if($this->Users->save($users,['modified' => false])){
                return $this->redirect(['controller' => 'Contractor', 'action' => 'generalListing', 'prefix' => 'Admin']); 
            }
    }

    // owner edit
    public function generalContractorEdit($id = null)
    {
        $this->viewBuilder()->setLayout('admin_layout');
        $user = $this->Users->get($id, [
            'contain' => ['UserProfile'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The users has been saved.'));

                return $this->redirect(['controller' => 'Contractor', 'action' => 'generalListing', 'prefix' => 'Admin']); 
            }else{
            $this->Flash->error(__('The users could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('user'));
    }

    //Active Inactive  function

    public function activeInactive($id){
        $this->autoRender =false;
           
        $users = $this->Users->get($id);
        if($users->status == 1){
            $data = array('id' => $id, 'status' => 0);
        }else{
            $data = array('id' => $id, 'status' => 1);
        }
        $users = $this->Users->patchEntity($users,$data);
       
        if($this->Users->save($users,['modified' => false])){
            return $this->redirect(['controller' => 'Contractor', 'action' => 'generalListing', 'prefix' => 'Admin']); 
        }
    }

    /*==================================================================================================== SC Management ======================================================= */

     // gc work
     public function subListing(){
        $this->viewBuilder()->setLayout('admin_layout');
        $users =  $this->paginate($this->Users->find('all')->contain(['UserProfile'])->where(['user_type'=>3]));
         $this->set(compact('users'));
    }

    public function subApprov($id = null){
        $this->autoRender = false;
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);
        if($user->status == 0){
            $user->status = 1;
            if($this->Users->save($user)){
                $mailer = new Mailer('default');
                    $mailer->setTransport('gmail'); //your email configuration name
                    $mailer->setFrom(['chandreshck9559@gmail.com' => 'chandresh']);
                    $mailer->setTo($user->email);
                    $mailer->setEmailFormat('text');
                    $mailer->setSubject('Approp Your Account');
                    $mailer->deliver('Dear Owener Your Account is Approved you login successfully');
                  
                    $this->Flash->success(__('Appropped Successfully'));

                    return $this->redirect(['controller' => 'Contractor', 'action' => 'subListing', 'prefix' => 'Admin']); 
            }
        }

    }
    // soft delete 
    public function subDeleteRecover($id = null){
       
            $this->autoRender =false;
           
            $users = $this->Users->get($id);
            if($users->status == 1){
                $data = array('id' => $id, 'status' => 2);
            }else{
                $data = array('id' => $id, 'status' => 1);
            }
            $users = $this->Users->patchEntity($users,$data);
           
            if($this->Users->save($users,['modified' => false])){
                return $this->redirect(['controller' => 'Contractor', 'action' => 'subListing', 'prefix' => 'Admin']); 
            }
    }

    // owner edit
    public function subContractorEdit($id = null)
    {    
        $this->viewBuilder()->setLayout('admin_layout');
        $user = $this->Users->get($id, [
            'contain' => ['UserProfile'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The users has been saved.'));

                return $this->redirect(['controller' => 'Contractor', 'action' => 'subListing', 'prefix' => 'Admin']); 
            }else{
            $this->Flash->error(__('The users could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('user'));
    }

    //Active Inactive  function

    public function subActiveInactive($id){
        $this->autoRender =false;
           
        $users = $this->Users->get($id);
        if($users->status == 1){
            $data = array('id' => $id, 'status' => 0);
        }else{
            $data = array('id' => $id, 'status' => 1);
        }
        $users = $this->Users->patchEntity($users,$data);
       
        if($this->Users->save($users,['modified' => false])){
            return $this->redirect(['controller' => 'Contractor', 'action' => 'subListing', 'prefix' => 'Admin']); 
        }
    }

    
}
?>