$(document).ready(function () {
    get_entradas();
    get_alertas();
});

/**
 * Refresca las entradas cada 3 segundos
 */
setInterval(function () {
    get_entradas();
}, 1000);

/**
 * Refresca las altertas cada 3 segundos
 */
setInterval(function () {
    get_alertas();
}, 3000);



//De esta forma las validaciones se adatan al dominio del sevidor.
var pathArray = window.location.pathname.split('/');

var base_url = window.location.protocol + "//" + window.location.host;

if (pathArray[1] !== 'index.php' && pathArray[1] !== '' ) {
    base_url = base_url + "/" + pathArray[1];
}


/**
  * Obtiene las entradas que se mostraran la pantalla de visualizacion
  */
function get_entradas() {
    $.ajax({
        type: "GET",
        url: base_url+"/index.php/visualizacion/entradas_json/",
        dataType: "json",
        success: function (response) {
            var i = 1;
            $.each(response.data.entradas, function (key, value) {
                var id_codigo = "#idc" + i;
                var id_lugar = "#idl" + i;
                var id_hora = "#idh" + i;

                $(id_codigo).text(value.codigo);
                $(id_lugar).text(value.lugar);
                $(id_hora).text(value.hora);

                i++;
            });
        }
    });
}

/**
  * Obtiene las alertas que se mostraran la pantalla de visualizacion
  */
function get_alertas() {
    $.ajax({
        type: "GET",
        url: base_url+"/index.php/visualizacion/alertas_json/",
        dataType: "json",
        success: function (response) {
            var alertas = "";

            $.each(response.data.alertas, function (key, value) {
                alertas = alertas +"  -  "+value.nombre+" "+value.apellidos+": "+value.mensaje + " (" + value.fecha + ")";
            });
            $("#alertas").text(alertas);
        }
    });
}
