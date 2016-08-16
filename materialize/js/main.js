$(document).ready(function(){
    $(".button-collapse").sideNav();
    $('input[type="submit"]').on('click', function(){
        $('.message').css({'display': 'none'});
        $('.progress').css({'display': 'block'})
    });
    $('.modal-trigger').leanModal();
    clientes();    
});
function permiso_menu(e, id_menu, id_user)
{
    $('.progress').css({'display': 'block'})
    var check = $(e).prop('checked');
    console.log(check, id_menu, id_user);
    var  url = "../permisoMenu/" + check + "/" + id_user + "/" + id_menu;
    window.location.href = url;
}
function clientes(){
    console.log('Clientes fue ejecutado');
    $.getJSON("http://api.primocash.us/", function(data){
        console.log(data);
        $('input.autocomplete.clientes').autocomplete(data);               
    });
}