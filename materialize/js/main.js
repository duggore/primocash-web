$(document).ready(function(){
    $(".button-collapse").sideNav();
    $('input[type="submit"]').on('click', function(){
        $('.message').css({'display': 'none'});
        $('.progress').css({'display': 'block'})
    });
});
function permiso_menu(e, id_menu, id_user)
{
    $('.progress').css({'display': 'block'})
    var check = $(e).prop('checked');
    console.log(check, id_menu, id_user);
    var  url = "../permisoMenu/" + check + "/" + id_user + "/" + id_menu;
    window.location.href = url;
}