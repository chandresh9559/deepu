<div class="table-responsive p-0 mt-4">
    <table class="table align-items-center mb-0">
        <thead>

            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">Project Name</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Assigned Status</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Acceptance Status</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Created Date</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Assigned Contractor</th>
        </thead>
        <tbody>
            <?php foreach($projects as $project):?>
                <tr>
                    <td><?php echo h($project->project_name)?></td>
                    <td>
                        <?php if($project->assigned_status == 0){?>
                            <?php echo h('Not Assigned')?>
                        <?php }else{?>    
                            <?php echo h('Assigned')?>
                        <?php }?>  
                    </td>  
                    <td>
                        <?php if($project->assigned_status == 0){?>
                            <?php echo h('Not Accepted')?>
                        <?php }else{?>    
                            <?php echo h('Accepted')?>
                        <?php }?>  
                    </td>
                    <td><?php echo h($project->created_date)?></td>
                    <td>
                        <?php echo $this->Html->link(__('<i style="margin-left:50px;font-size:18px" class="fa fa-eye"></i>'),[],['escape'=>false,'data-bs-toggle'=>'modal','data-bs-target'=>'#exampleModal'])?>
                     </td>
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div>