$(document).ready(function(){
    $(".button-collapse").sideNav();
    $('input[type="submit"]').on('click', function(){
        $('.message').css({'display': 'none'});
        $('.progress').css({'display': 'block'})
    });
    $('.modal-trigger').leanModal();
    $('.btn-edit').on('click', editar);
    clientes();    
    ultimo_visto();
});
function editar(){
    var ultimo = $(this).parent('div').parent('li').attr('id');
    console.log(ultimo);
    localStorage.setItem('ultimo', ultimo);
}
function ultimo_visto(){
    var ultimo = localStorage.getItem('ultimo');
    var elemento = '#' + ultimo;
    console.log(elemento);
    if(ultimo != null){
        if($(elemento).length){
            console.log('existe elemento')
            $('.ultimo_visto').append($(elemento));
        }else{
            console.log('El elemento no existe')
            $('.ultimo_visto').css({'display': 'none'});
        }
        console.log('si existe localStorage');
    }else{
        console.log('No existe localStorage');            
        $('.ultimo_visto').css({'display': 'none'});
    }
    console.log('Se movio');
}
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
        //console.log(data);
        $('input.autocomplete.clientes').autocomplete(data);               
    });
}
function prestamo(capital, porcentaje, meses, fecha_inicio){
            var fecha       = new Date(fecha_inicio);
            capital         = capital,
            porcentaje      = porcentaje,
            meses           = meses,
            interes_mensual = ((capital * porcentaje) /100),
            interes_total   = interes_mensual * meses,
            total           = capital + interes_total,
            ultima_cuota    = interes_mensual + capital;

            for(i=0; i < meses; i++){
                fecha.setMonth(fecha.getMonth() + 1);
                var month   = fecha.getMonth()+1;
                var day     = fecha.getDate();
                var year    = fecha.getFullYear();
                if(i != (meses - 1)){
                    console.log('mes: ' + (i+1) + '\n Cuota a pagar: '+ interes_mensual +'.00 $USD\n fecha de pago: ' + day + '/' + month + '/' + year +'\n\n');
                }else{
                    console.log('mes: ' + (i+1) + '\n Cuota a pagar: '+ ultima_cuota +'.00 $USD \n fecha de pago: ' + day + '/' + month + '/' + year +'\n\n');
                }
            }
        }