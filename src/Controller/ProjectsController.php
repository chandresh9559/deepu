<?php
declare(strict_types=1);

namespace App\Controller;


class ProjectsController extends AppController
{

    public function initialize(): void
    {
        parent::initialize();

         $this->Model = $this->loadModel('UserProfile');
         $this->Model = $this->loadModel('Users');
         $this->Model = $this->loadModel('Services');
         $this->Model = $this->loadModel('Projects');
         $this->Model = $this->loadModel('AssignedUsers');
        
    }
    public function requestedProjectList()
    {
        $this->viewBuilder()->setLayout('owner_layout');
        $user = $this->paginate($this->Users,['contain'=>['UserProfile','AssignedUsers']]);
        // $user_profile = $this->paginate($this->UserProfile);

        // dd($user);
        $this->paginate = [
            'contain' => ['Users'],
        ];
        $projects = $this->paginate($this->Projects);

        $this->set(compact('projects','user'));
    }



   

    public function view($id = null)
    {
        $project = $this->Projects->get($id, [
            'contain' => ['Users', 'AssignedUsers', 'OwnerServices'],
        ]);

        $this->set(compact('project'));
    }

/********************view*********************/
    
    public function requestNewProject()
    {
        $this->viewBuilder()->setLayout('owner_layout');
        $auth = $this->Authentication->getIdentity();
        $services = $this->paginate($this->Services);
        $project = $this->Projects->newEmptyEntity();
        if ($this->request->is('post')) {
            // dd($this->request->getData());
            $project['user_id']=$auth->id;
            $project = $this->Projects->patchEntity($project, $this->request->getData());
        
            // dd($project);
            if ($this->Projects->save($project)) {
                $this->Flash->success(__('The project has been saved.'));

                return $this->redirect(['controller'=>'projects','action' => 'requested-project-list']);
            }
            $this->Flash->error(__('The project could not be saved. Please, try again.'));
        }
        $this->set(compact('project', 'services','auth'));
    }

    
    public function edit($id = null)
    {
        $project = $this->Projects->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $project = $this->Projects->patchEntity($project, $this->request->getData());
            if ($this->Projects->save($project)) {
                $this->Flash->success(__('The project has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The project could not be saved. Please, try again.'));
        }
        $users = $this->Projects->Users->find('list', ['limit' => 200])->all();
        $this->set(compact('project', 'users'));
    }

    
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $project = $this->Projects->get($id);
        if ($this->Projects->delete($project)) {
            $this->Flash->success(__('The project has been deleted.'));
        } else {
            $this->Flash->error(__('The project could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
