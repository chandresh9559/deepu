<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use App\Form\ContactForm;
use Cake\ORM\TableRegistry;
use Cake\Mailer\Email;
use Cake\Mailer\Mailer;
use Cake\Mailer\TransportFactory;
use Cake\View\View;

class ProjectsController extends AppController{
    public function initialize(): void
    {
        parent::initialize();
         $this->loadModel('UserProfile');
         $this->loadModel('Users');
         $this->loadModel('Projects');
         $this->loadModel('OwnerServices');
         $this->loadModel('UserServices');
         $this->loadModel('Services');
       
    }

    public function unAssignProject(){
        $this->viewBuilder()->setLayout('admin_layout');
        $projects =  $this->paginate($this->Projects,['contain'=>['Users','UserProfile']]);
        $this->set(compact(['projects']));
    }

   
    public function projectView($id = null){
        $this->viewBuilder()->setLayout('admin_layout');
        $project = $this->Projects->get($id, [
            'contain' => ['Users','UserProfile'],
        ]);
        $owner_services = $this->OwnerServices->find('all')->contain(['Services'])->where(['project_id'=>$id])->all();
        $contractor = $project->contractor;
        $users = $this->Users->find('all')->contain(['UserProfile'])->where(['user_type'=>$contractor])->all();
        if ($this->request->is(['patch', 'post', 'put'])) {
            $project = $this->Projects->patchEntity($project, $this->request->getData());
            if ($this->Projects->save($project)) {
                $this->Flash->success(__('The project has been saved.'));

                return $this->redirect(['controller'=>'projects','action' => 'unAssignProject','prefix'=>'Admin']);
            }
            $this->Flash->error(__('The project could not be saved. Please, try again.'));
        }
       
        $this->set(compact('project','owner_services','users'));
        

    }
    public function serviceView(){
        if($this->request->is('ajax')){
            $this->autoRender = false;
            $id = $this->request->getQuery('id');
            $user_services = $this->UserServices->find('all')->contain(['Services'])->where(['user_id'=>$id])->all();
            $data = "";
           foreach($user_services as $user){
            $data ='<tr>
               <td>'.$user->service->service.'</td>
               </tr>';
             echo $data; 
            }
        }

    }

    public function assign(){
        $service = $this->Services->newEmptyEntity();
        if ($this->request->is('ajax')) {
            $this->autoRender = false;
            dd($this->request->getData());
            $service = $this->Services->patchEntity($service, $this->request->getData());
            if ($this->Services->save($service)) {
              
            }
            $this->Flash->error(__('The service could not be saved. Please, try again.'));
        }
    }
    
}

?>