$(document).ready(function(){
    $(".button-collapse").sideNav();
    $('input[type="submit"]').on('click', function(){
        $('.message').css({'display': 'none'});
        $('.progress').css({'display': 'block'})
    });
    $('.datepicker').pickadate({
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 15 // Creates a dropdown of 15 years to control year
    });
    $('.modal-trigger').leanModal();
    $('.btn-edit').on('click', editar);
    $('#cliente').focusout(buscar_cliente);
    clientes();    
    ultimo_visto();
    $('#preview').on('click', preview);
});
function preview(){
    var cliente         = $('#cliente').val(),
        fecha_inicio    = $('#fecha_inicio').val(),
        capital         = parseInt($('#capital').val()),
        porcentaje      = $('#porcentaje').val(),
        meses           = $('#fraccionamiento').val(),
        guarantee       = $('#guarantee').val();
        if(fecha_inicio == ''){
            console.log('Fecha no encontrada');
        }else
        {
            console.log(fecha_inicio);
        }
    console.log(cliente + fecha_inicio + capital + porcentaje + fraccionamiento + guarantee);
    prestamo(capital, porcentaje, meses, fecha_inicio);
    return false;
}
function buscar_cliente(){
    setTimeout(function(){ 
        var input_cliente = $('#cliente').val(),
            url_base = "http://localhost:8080/primocash-api",
            controlador = 'clientes',
            metodo = 'nombre',
            parametro = input_cliente.replace(/\s/g,"_");
            url_consulta = url_base + '/' + controlador + '/' + metodo + '/' + parametro;
        console.log(url_consulta);
        $.getJSON(url_consulta, function(data){
            console.log(data);
            $('#customer_id').val(data.customer_id);
            $('#pre_customer_name').html(data.customer_name);
            $('#pre_customer_phone').html(data.customer_phone);
        });
     }, 500);
}
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
    //$.getJSON("http://api.primocash.us/", function(data){
    $.getJSON("http://localhost:8080/primocash-api/", function(data){
        //console.log(data);
        $('input.autocomplete.clientes').autocomplete(data);               
    });
}
function prestamo(capital, porcentaje, meses, fecha_inicio){
            $('#cuotas').html('');
            var fecha       = new Date(fecha_inicio);
            capital         = capital,
            porcentaje      = porcentaje,
            meses           = meses,
            interes_mensual = ((capital * porcentaje) /100),
            interes_total   = interes_mensual * meses,
            total           = capital + interes_total,
            ultima_cuota    = interes_mensual + capital;
            $('#pre_capital').html(capital + '.00 $USD');
            for(i=0; i < meses; i++){
                fecha.setMonth(fecha.getMonth() + 1);
                var month   = fecha.getMonth()+1;
                var day     = fecha.getDate();
                var year    = fecha.getFullYear();
                if(i != (meses - 1)){
                    var html = `<p>Cuota Nro ${i+1}</p>
                                <p>Monto: ${interes_mensual}.00 $USD</p> 
                                <p>Fecha de pago: ${day}/${month}/${year}</p> 
                                <br/>   `;
                    $('#cuotas').append(html);
                    console.log('mes: ' + (i+1) + '\n Cuota a pagar: '+ interes_mensual +'.00 $USD\n fecha de pago: ' + day + '/' + month + '/' + year +'\n\n');
                }else{
                    var html = `<p>Cuota nro: ${i+1}</p>
                                <p>Monto: ${ultima_cuota}.00 $USD</p>    `;
                    $('#cuotas').append(html);
                    console.log('mes: ' + (i+1) + '\n Cuota a pagar: '+ ultima_cuota +'.00 $USD \n fecha de pago: ' + day + '/' + month + '/' + year +'\n\n');
                }
            }
        }