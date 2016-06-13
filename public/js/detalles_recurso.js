/**
 * Si la fecha de inicio del recurso ha pasado se oculta el formulario de 
 * inscripción y se muestra un mensaje
 * @param {type} fecha
 * @returns {undefined}
 */
function detalles(fecha) {
    $(document).ready(function () {

        var date = new Date(fecha);
        var current_date = new Date();

        if (date > current_date) {
            $("#alta_cita").show();
            $("#inscripcion_cerrada").hide();
        } else {
            $("#alta_cita").hide();
            $("#inscripcion_cerrada").show();
        }
    });
}