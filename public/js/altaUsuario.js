/**
 * Muestra u oculta los campos propios del profesor
 * @param {type} param
 */

$( document ).ready( $('#rol').on('change', function () {
    var selected = this.value;

    switch (selected) {
        case '2': //Rol profesor=2
            $("#extraProfesor").show(250);
            break;
        default :
            $("#extraProfesor").hide(250);
    }
}));