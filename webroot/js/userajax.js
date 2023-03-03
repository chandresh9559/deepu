$(document).ready(function(){
    $('#form').on('submit',function(){

        var form_data = new FormData(this);
        // alert(form_data);
        // return false;
        $.ajax({

            url:"http://localhost:8765/users/sign-up",
            type:"JSON",
            method:"POST",
            data :form_data,
            success: function(response){
                alert("You have successfully registered");
                window.location.href = "http://localhost:8765/users/login";
            }
        })
    })
})