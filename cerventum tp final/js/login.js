$("#log").click(function (){
    $.ajax({
        type: post,
        url: "../php/header.php",
        success: function(result){
            $("#linkUser").text = result;
            $("#ingresar").hide();
            $("#registrarse").hide();
        }

    })
})