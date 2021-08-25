//cambiar contraseña

$(document).ready(function(){
    $('.newPass').keyup(function(){
        validPass();
    });

    //Form cambiar contraseña
    $('#frmChangePass').submit(function(e){
        e.preventDefault();
        var passActual = $('#txtPassUser').val();
        var passNuevo = $('#txtNewPassUser').val();
        var confirmPassNuevo = $('#txtPassConfirm').val();
        var action = "changePassword";

        if(passNuevo != confirmPassNuevo){
            $('.alertChangePass').html('<p style="color:red;">Las contraseñas no son iguales</p>');
            $('.alertChangePass').slideDown();
            return false;
        }
        if(passNuevo.length < 6){
            $('.alertChangePass').html('<p style="color:red;">La nueva contraseña debe ser de 6 caracteres como mínimo</p>');
            $('.alertChangePass').slideDown();
            return false;
        }

        $.ajax({
            url: 'ajax.php',
            type: "POST",
            async: true,
            data: {action:action,passActual:passActual,passNuevo:passNuevo},

            success: function(response)
            {
               if(response != 'error')
               {
                   var info = JSON.parse(response);
                   if(info.cod == '00'){
                       alert(info.msg);
                       $('#frmChangePass')[0].reset();
                   }else{
                        alert(info.msg);
                   }
                   $('alertChangePass').slideDown();
                   

               }
                
            },
            error: function(error){
                $('.alertChangePass').html('<p>Contraseña actualizada correctamente</p>');
                $('alertChangePass').slideDown();

            }
        });


    });
    
});
function validPass(){
    var passNuevo = $('#txtNewPassUser').val();
    var confirmPassNuevo = $('#txtPassConfirm').val();
    if(passNuevo != confirmPassNuevo){
        $('.alertChangePass').html('<p style="color:red;">Las contraseñas no son iguales</p>');
        $('.alertChangePass').slideDown();
        return false;
    }
    if(passNuevo.length < 6){
        $('.alertChangePass').html('<p style="color:red;">La nueva contraseña debe ser de 6 caracteres como mínimo</p>');
        $('.alertChangePass').slideDown();
        return false;
    }
    $('.alertChangePass').html('');
    $('.alertChangePass').slideUp();
}