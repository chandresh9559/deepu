$('.btn-category').on('click',function(){
        alert("ekwl");
    var data = $(this).attr("data-id");
    $.ajax({
        url: "/admin/product-categories/getCategory",
        data: {'category_id':data},
        type: "JSON",
        method: "get",
        success:function(response){
            category = $.parseJSON(response);
            $('#category-name').val(category['category_name']);
           
        }
    });

});

// edit category
$('#edit-category').validate({
    
    rules: { 

        category_name: {
            required: true,
        }
    },
    messages: {

        category_name: {
            required: "Please enter category name",
        },
        
    },submitHandler:function(form){
        alert("fber");
        return false;
        var form_data = (form).serialize();
        alert(form_data);
        return false;
        $.ajax({

            url:'/admin/users/product-categories/edit-category',
            type:'POST',
            method:'JSON',
            data:{form_data},
            success:function(response){
             alert(response);
            }
        });
    }
});