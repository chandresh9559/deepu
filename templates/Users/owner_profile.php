<?php
$myTemplates = [
  'inputContainer' => '<div class="input-group input-group-outline">{{content}}</div>'
];
$this->Form->setTemplates($myTemplates);
?>
<style>
    .err{
        color: red;
    }
</style>
<div class="container-fluid px-2 px-md-4">
    <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
        <span class="mask  bg-gradient-primary  opacity-6"></span>
    </div>
    <div class="card card-body mx-3 mx-md-4 mt-n6 user-view">
        <div class="row">
            <div class="row">
                <div class="col">
                    <div class="card card-plain h-100">
                        <div class="card-body p-3">
                            <?php echo $this->Form->create($owner) ?>
                            <h3 class="text-center">Profile Information</h3>
                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-4 mt-3">
                                    <label>First Name<span class="err">*</span></label>
                                    <?php echo $this->Form->control('user_profile.first_name', ['required' => false, 'class' => 'form-control mb-3', 'label' =>false]) ?>
                                    <label >Last Name<span class="err">*</span></label>
                                    <?php echo $this->Form->control('user_profile.last_name', ['required' => false, 'class' => 'form-control mb-3', 'label' =>false]) ?>
                                    <label >Email<span class="err">*</span></label>
                                    <?php echo $this->Form->control('email', ['required' => false, 'class' => 'form-control mb-3', 'label' =>false]) ?>

                                    <label >Phone<span class="err">*</span></label>
                                    <?php echo $this->Form->control('user_profile.phone', ['required' => false, 'class' => 'form-control mb-3', 'label' =>false]) ?>

                                    <label >Address 1<span class="err">*</span></label>
                                    <?php echo $this->Form->control('user_profile.address1', ['required' => false, 'class' => 'form-control mb-3', 'label' =>false]) ?>
                                </div>
                                <div class="col-md-4 mt-3">
                                    <label >Address2<span class="err">*</span></label>
                                    <?php echo $this->Form->control('user_profile.address2', ['required' => false, 'class' => 'form-control mb-3', 'label' =>false]) ?>
                                    <label>State<span class="err">*</span></label>
                                    <?php echo $this->Form->control('user_profile.state', ['required' => false, 'class' => 'form-control mb-3', 'label' =>false]) ?>
                                    <label >City<span class="err">*</span></label>
                                    <?php echo $this->Form->control('user_profile.city', ['required' => false, 'class' => 'form-control mb-3', 'label' =>false]) ?>
                                    <label >Pincode<span class="err">*</span></label>
                                    <?php echo $this->Form->control('user_profile.pincode', ['required' => false, 'class' => 'form-control mb-3', 'label' =>false]) ?>
                                </div>
                                 
                                <div class="text-center">
                                   <?= $this->Form->button(__('Save'), ['action' => 'edit' , 'class' => 'btn bg-gradient-primary w-10 mt-4 mb-0']) ?>
                                </div>
                               <?php echo $this->Form->end() ?>
                               </div>
                              
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>