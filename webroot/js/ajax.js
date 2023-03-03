
var csrfToken = $('meta[name="csrfToken"]').attr('content');
      
    $('#modal-form').on('submit',function(e){
        e.preventDefault();
        var data = $('#service').val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': csrfToken
              },
            url:'/admin/services/addServices',
            type:'JSON',
            method:'POST',
            data : {'service':data},
            success : function(response){
                if(response == 1){
                    $('#exampleModal').modal('hide');
                    swal({
                        title: "Data insert successful",
                        text: "You clicked the button!",
                        icon: "success",
                        button: "Okk",
                      });
                      $('#table-hide').load('/admin/services/serviceManagment #table-hide');
                      $('#modal-form').load('/admin/services/serviceManagment #modal-form');
                      
                    }else{
                        $('#service-error').text('Aleardy exits').css('color','red');
                    }

            }
        })
        return false;
    });

    // service edit 
    $('.edit').on('click',function(e){
        e.preventDefault();
        var id = $(this).attr('data-id');
        $.ajax({
           url:'/admin/services/editDataGet',
            type:'JSON',
            method:'get',
            data : {'id':id},
            success : function(response){
             var data = JSON.parse(response);
            
                $('#edit').modal('show');
                $('#service-id').val(data['id'])
                $('#get-service').val(data['service']);
             
           

             }
        })
        return false;
    });

    // service edit 
    $('.edit-form').on('click',function(e){
        e.preventDefault();
        var data = $('#edit-form').serialize();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': csrfToken
              },
            url:'/admin/services/editService',
            type:'JSON',
            method:'POST',
            data :data,
            success : function(response){
                if(response == 1){
                    $('#edit').modal('hide');
                    swal({
                        title: "Data insert successful",
                        text: "You clicked the button!",
                        icon: "success",
                        button: "Okk",
                      });
                      $('#table-hide').load('/admin/services/serviceManagment #table-hide');
                      
                }

            }
        })
        return false;
    });
   
    $('.view').on('click',function(e){
        e.preventDefault();
        var id = $(this).attr('data-id');
        $.ajax({
           url:'/admin/projects/serviceView',
            type:'JSON',
            method:'get',
            data : {'id':id},
            success : function(response){
             $('#edit').modal('show');
               $('#show').html(response); 
            }
        })
        return false;
    });

    $('#assigned-form').on('submit',function(e){
        e.preventDefault();
        var data = $('#assigned-form').serialize();
        alert(data);
        $.ajax({

            url:'/admin/projects/assign',
            type:'JSON',
            method:'get',
            data:data,
            success:function(response){
                alert(response);
            }
        });
    });
    

