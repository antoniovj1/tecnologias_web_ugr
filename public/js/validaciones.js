/**
 * Validación documento identificacón español
 * @param {type} param1
 * @param {type} value
 * @param {type} element
 */
jQuery.validator.addMethod("identificacionES", function (value, element) {
    "use strict";
    value = value.toUpperCase();
    // Texto común en todos los formatos
    if (!value.match('((^[A-Z]{1}[0-9]{7}[A-Z0-9]{1}$|^[T]{1}[A-Z0-9]{8}$)|^[0-9]{8}[A-Z]{1}$)')) {
        return false;
    }
    /* Inicio validacion NIF */
    if (/^[0-9]{8}[A-Z]{1}$/.test(value)) {
        return ("TRWAGMYFPDXBNJZSQVHLCKE".charAt(value.substring(8, 0) % 23) === value.charAt(8));
    }
    //  Hay ciertos NIFs que empiezan por K, L o M
    if (/^[KLM]{1}/.test(value)) {
        return (value[ 8 ] === String.fromCharCode(64));
    }
    /* Fin validacion NIF */

    /* Inicio validacion NIE */
    if (/^[T]{1}/.test(value)) {
        return (value[ 8 ] === /^[T]{1}[A-Z0-9]{8}$/.test(value));
    }
    // Con los que empiezan por XYZ
    if (/^[XYZ]{1}/.test(value)) {
        return (
                value[ 8 ] === "TRWAGMYFPDXBNJZSQVHLCKE".charAt(
                value.replace('X', '0')
                .replace('Y', '1')
                .replace('Z', '2')
                .substring(0, 8) % 23
                )
                );
    }
    /* Fin validacion NIE */

    /* Inicio validacion CIF */
    var sum,
            num = [],
            digitoControl;
    for (var i = 0; i < 9; i++) {
        num[ i ] = parseInt(value.charAt(i), 10);
    }
    // Comprobamos el CIF
    sum = num[ 2 ] + num[ 4 ] + num[ 6 ];
    for (var count = 1; count < 8; count += 2) {
        var tmp = (2 * num[ count ]).toString(),
                tmpValor = tmp.charAt(1);
        sum += parseInt(tmp.charAt(0), 10) + (tmpValor === '' ? 0 : parseInt(tmpValor, 10));
    }
    if (/^[ABCDEFGHJNPQRSUVW]{1}/.test(value)) {
        sum += '';
        digitoControl = 10 - parseInt(sum.charAt(sum.length - 1), 10);
        value += digitoControl;
        return (num[ 8 ].toString() === String.fromCharCode(64 + digitoControl) || num[ 8 ].toString() === value.charAt(value.length - 1));
    }
    /* Fin validacion CIF */
    return false;
}, "Por favor indica un NIF / NIE / CIF correcto.");

/**
 * Validación nombre o apellidos
 */
jQuery.validator.addMethod("nombreapellido", function (value, element) {
    return this.optional(element) || /^[a-z\ ñáéíóúàèìòùâêîôû]+$/i.test(value);
}, "Solo letras, espacios y guiones");

/**
 * Validación formato de fecha
 */
jQuery.validator.addMethod("datetime", function (value, element) {
    var matches = value.match(/^(\d{4})\/(\d{2})\/(\d{2}) (\d{2}):(\d{2})$/);
    if (matches === null) {
        matches = value.match(/^(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2})$/);
    }

    var matches2 = value.match(/^(\d{4})\/(\d{2})\/(\d{2}) (\d{2}):(\d{2}):(\d{2})$/);
    if (matches2 === null) {
        matches2 = value.match(/^(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})$/);
    }

    if (matches === null && matches2 === null) {
        return false;

    } else {
        if (matches !== null) {
            // now lets check the date sanity
            var year = parseInt(matches[1], 10);
            var month = parseInt(matches[2], 10) - 1; // months are 0-11
            var day = parseInt(matches[3], 10);
            var hour = parseInt(matches[4], 10);
            var minute = parseInt(matches[5], 10);
            var date = new Date(year, month, day, hour, minute);

            if (date.getFullYear() !== year
                    || date.getMonth() !== month
                    || date.getDate() !== day
                    || date.getHours() !== hour
                    || date.getMinutes() !== minute
                    ) {
                return false;
            } else {
                return true;
            }
        } else {
            var year = parseInt(matches2[1], 10);
            var month = parseInt(matches2[2], 10) - 1; // months are 0-11
            var day = parseInt(matches2[3], 10);
            var hour = parseInt(matches2[4], 10);
            var minute = parseInt(matches2[5], 10);
            var second = parseInt(matches2[6], 10);
            var date = new Date(year, month, day, hour, minute, second);
            if (date.getFullYear() !== year
                    || date.getMonth() !== month
                    || date.getDate() !== day
                    || date.getHours() !== hour
                    || date.getMinutes() !== minute
                    || date.getSeconds() !== second
                    ) {
                return false;
            } else {
                return true;
            }
        }
    }

}, "Fecha no valida. Formato AAAA/MM/DD HH:MM[:SS] o AAAA-MM-DD HH:MM[:SS] ");



/**
 *Comprobación de que la fecha no es pasada. 
 */
jQuery.validator.addMethod("datetimeNoPasada", function (value, element) {
    var date = new Date(value);
    var current_date = new Date();

    if (date < current_date) {
        return false;
    } else {
        return true;
    }

}, "No se puede usar una fecha pasada.");


/**
 * Comprobación de que la fecha fin es posterior a la de inicio
 */
jQuery.validator.addMethod("fecha_fin_mayor_inicio", function (value, element) {
    var fin = new Date(value);
    var ini = new Date($('#fecha_ini').val());

    if (fin < ini) {
        return false;
    } else {
        return true;
    }

}, "La fecha de fin debe ser mayor que la de inicio.");


//De esta forma las validaciones se adatan al dominio del sevidor.
var pathArray = window.location.pathname.split('/');

var base_url = window.location.protocol + "//" + window.location.host;

if (pathArray[1] !== 'index.php' && pathArray[1] !== '') {
    base_url = base_url + "/" + pathArray[1];
}

/**
 * Todas las validaciones
 * @param {type} param
 */
$(document).ready(function () {

    var email_admin = base_url + "/index.php/administrador/validar_email";
    var nick_admin = base_url + "/index.php/administrador/validar_nick";

    var email_prof = base_url + "/index.php/profesor/validar_email";
    var nick_prof = base_url + "/index.php/profesor/validar_nick";

    var validar_codigo = base_url + "/index.php/validar_codigo";
    var nick_recurso = base_url + "/index.php/administrador/validar_nick_recurso";
    var login = base_url + "/index.php/validar_login";
    var dni_usado = base_url + "/index.php/validar_dni";


    $("#crear-cita").validate({
        onfocusout: function (element) {
            this.element(element);
        },
        rules: {
            nombre: {
                required: true,
                nombreapellido: true,
                maxlength: 30

            },
            apellidos: {
                required: true,
                nombreapellido: true,
                maxlength: 30
            },
            dni: {
                required: true,
                identificacionES: true,
                remote: {
                    url: dni_usado,
                    type: "post",
                    data: {
                        id_recurso: function () {
                            return $('#id_recurso').val();
                        }
                    }

                }
            },
            email: {
                required: true,
                email: true,
                maxlength: 50
            }
        },
        messages: {
            nombre: {
                required: "<label class='error_validacion'>Introduzca su nombre </label>",
                nombreapellido: "<label class='error_validacion'>Nombre no válido </label>",
                maxlength: "<label class='error_validacion'>Demasiados caracteres</label>"

            },
            apellidos: {
                required: "<label class='error_validacion'>Introduzca sus apellidos </label>",
                nombreapellido: "<label class='error_validacion'>Apellido no válido </label>",
                maxlength: "<label class='error_validacion'>Demasiados caracteres</label>"

            },
            dni: {
                required: "<label class='error_validacion'>Introduzca el DNI</label>",
                identificacionES: "<label class='error_validacion'>Por favor indica un NIF / NIE / CIF correcto</label>",
                remote: "<label class='error_validacion'>Ya está apuntado en esta cola</label>"
            },
            email: {
                email: "<label class='error_validacion'>El email no es valido</label>",
                required: "<label class='error_validacion'>Introduzca su email</label>",
                maxlength: "<label class='error_validacion'>Demasiados caracteres</label>"

            }
        },
        submitHandler: function (form) {
            form.submit();
        }
    });


    $("#alerta").validate({
        onfocusout: function (element) {
            this.element(element);
        },
        rules: {
            mensaje: {
                required: true,
                maxlength: 70

            }
        },
        messages: {
            mensaje: {
                required: "<label class='error_validacion'>Introduzca el mensaje </label>",
                maxlength: "<label class='error_validacion'>Demasiados caracteres (MAX 70 )</label>"

            }
        },
        submitHandler: function (form) {
            form.submit();
        }
    });

    $("#alta-usuario").validate({
        onfocusout: function (element) {
            this.element(element);
        },
        rules: {
            nombre: {
                required: true,
                nombreapellido: true,
                maxlength: 30
            },
            apellidos: {
                required: true,
                nombreapellido: true,
                maxlength: 30
            },
            email: {
                required: true,
                email: true,
                maxlength: 50,
                remote: {
                    url: email_admin,
                    type: "post"
                }
            },
            nick: {
                required: true,
                maxlength: 30,
                remote: {
                    url: nick_admin,
                    type: "post"
                }
            },
            passw: {
                required: true,
                minlength: 4,
                maxlength: 30
            },
            departamento: {
                required: {
                    depends: function (element) {
                        return ($('#rol').val() === '2');
                    }
                }
            }
        },
        messages: {
            nombre: {
                required: "<label class='error_validacion'>Introduzca su nombre </label>",
                nombreapellido: "<label class='error_validacion'>Nombre no válido </label>",
                maxlength: "<label class='error_validacion'>Demasiados caracteres. Max 30</label>"

            },
            apellidos: {
                required: "<label class='error_validacion'>Introduzca sus apellidos </label>",
                nombreapellido: "<label class='error_validacion'>Apellido no válido </label>",
                maxlength: "<label class='error_validacion'>Demasiados caracteres. Max 30</label>"

            },
            passw: {
                required: "<label class='error_validacion'>Introduzca la contraseña</label>",
                minlength: "<label class='error_validacion'>La contraseña debe tener como mínimo 4 caracteres</label>",
                maxlength: "<label class='error_validacion'>Demasiados caracteres. Max 30</label>"

            },
            email: {
                required: "<label class='error_validacion'>Introduzca el email</label>",
                email: "<label class='error_validacion'>El email no es valido</label>",
                remote: "<label class='error_validacion'>El email ya está en uso</label>",
                maxlength: "<label class='error_validacion'>Demasiados caracteres. Max 50</label>"

            },
            nick: {
                required: "<label class='error_validacion'>Introduzca el nombre de usuario</label>",
                remote: "<label class='error_validacion'>El nombre de usuario ya está en uso</label>",
                maxlength: "<label class='error_validacion'>Demasiados caracteres. Max 30</label>"

            },
            departamento: "<label class='error_validacion'>Introduzca el departamento</label>"
        },
        submitHandler: function (form) {
            form.submit();
        }
    });

    $("#perfil-profesor").validate({
        onfocusout: function (element) {
            this.element(element);
        },
        rules: {
            nombre: {
                required: true,
                nombreapellido: true,
                maxlength: 30
            },
            apellidos: {
                required: true,
                nombreapellido: true,
                maxlength: 30
            },
            email: {
                required: true,
                email: true,
                maxlength: 50,
                remote: {
                    url: email_prof,
                    type: "post"
                }
            },
            nick: {
                required: true,
                maxlength: 30,
                remote: {
                    url: nick_prof,
                    type: "post"
                }
            },
            passw: {
                required: false,
                minlength: 4,
                maxlength: 30
            },
            departamento: {
                required: true
            }
        },
        messages: {
            nombre: {
                required: "<label class='error_validacion'>Introduzca su nombre </label>",
                nombreapellido: "<label class='error_validacion'>Nombre no válido </label>",
                maxlength: "<label class='error_validacion'>Demasiados caracteres. Max 30</label>"

            },
            apellidos: {
                required: "<label class='error_validacion'>Introduzca sus apellidos </label>",
                nombreapellido: "<label class='error_validacion'>Apellido no válido </label>",
                maxlength: "<label class='error_validacion'>Demasiados caracteres. Max 30</label>"

            },
            passw: {
                required: "<label class='error_validacion'>Introduzca la contraseña</label>",
                minlength: "<label class='error_validacion'>La contraseña debe tener como mínimo 4 caracteres</label>",
                maxlength: "<label class='error_validacion'>Demasiados caracteres. Max 30</label>"

            },
            email: {
                required: "<label class='error_validacion'>Introduzca el email</label>",
                email: "<label class='error_validacion'>El email no es valido</label>",
                remote: "<label class='error_validacion'>El email ya está en uso</label>",
                maxlength: "<label class='error_validacion'>Demasiados caracteres. Max 50</label>"

            },
            nick: {
                required: "<label class='error_validacion'>Introduzca el nombre de usuario</label>",
                remote: "<label class='error_validacion'>El nombre de usuario ya está en uso</label>",
                maxlength: "<label class='error_validacion'>Demasiados caracteres. Max 30</label>"

            },
            departamento: "<label class='error_validacion'>Introduzca el departamento</label>"
        },
        submitHandler: function (form) {
            form.submit();
        }
    });


    $("#detalles-usuario").validate({
        onfocusout: function (element) {
            this.element(element);
        },
        rules: {
            nombre: {
                required: true,
                nombreapellido: true,
                maxlength: 30
            },
            apellidos: {
                required: true,
                nombreapellido: true,
                maxlength: 30
            },
            email: {
                required: true,
                email: true,
                maxlength: 50,
                remote: {
                    url: email_admin,
                    type: "post",
                    data: {
                        id: function () {
                            return $('#id').val();
                        }
                    }
                }
            },
            nick: {
                required: true,
                maxlength: 30,
                remote: {
                    url: nick_admin,
                    type: "post",
                    data: {
                        id: function () {
                            return $('#id').val();
                        }
                    }
                }
            },
            passw: {
                required: false,
                minlength: 4,
                maxlength: 30
            },
            departamento: {
                required: {
                    depends: function (element) {
                        return ($('#rol').val() === '2');
                    }
                }
            }
        },
        messages: {
            nombre: {
                required: "<label class='error_validacion'>Introduzca su nombre </label>",
                nombreapellido: "<label class='error_validacion'>Nombre no válido </label>",
                maxlength: "<label class='error_validacion'>Demasiados caracteres. Max 30</label>"

            },
            apellidos: {
                required: "<label class='error_validacion'>Introduzca sus apellidos </label>",
                nombreapellido: "<label class='error_validacion'>Apellido no válido </label>",
                maxlength: "<label class='error_validacion'>Demasiados caracteres. Max 30</label>"

            },
            passw: {
                required: "<label class='error_validacion'>Introduzca la contraseña</label>",
                minlength: "<label class='error_validacion'>La contraseña debe tener como mínimo 4 caracteres</label>",
                maxlength: "<label class='error_validacion'>Demasiados caracteres. Max 30</label>"

            },
            email: {
                required: "<label class='error_validacion'>Introduzca el email</label>",
                email: "<label class='error_validacion'>El email no es valido</label>",
                remote: "<label class='error_validacion'>El email ya está en uso</label>",
                maxlength: "<label class='error_validacion'>Demasiados caracteres. Max 50</label>"

            },
            nick: {
                required: "<label class='error_validacion'>Introduzca el nombre de usuario</label>",
                remote: "<label class='error_validacion'>El nombre de usuario ya está en uso</label>",
                maxlength: "<label class='error_validacion'>Demasiados caracteres. Max 30</label>"

            },
            departamento: "<label class='error_validacion'>Introduzca el departamento</label>"
        },
        submitHandler: function (form) {
            form.submit();
        }
    });

    $("#consultar-turno").validate({
        onfocusout: function (element) {
            this.element(element);
        },
        rules: {
            codigo: {
                required: true,
                remote: {
                    url: validar_codigo,
                    type: "post"
                }
            }
        },
        messages: {
            codigo: {
                required: "<label class='error_validacion'>Introduzca el codigo</label>",
                remote: "<label class='error_validacion'>El código no existe</label>"
            }
        },
        submitHandler: function (form) {
            form.submit();
        }
    });
    $("#crear-recurso").validate({
        onfocusout: function (element) {
            this.element(element);
        },
        rules: {
            lugar: {
                required: true,
                maxlength: 50
            },
            asignatura: {
                required: true,
                maxlength: 50
            },
            fecha_ini: {
                required: true,
                datetime: true,
                datetimeNoPasada: true
            },
            fecha_fin: {
                required: true,
                datetime: true,
                fecha_fin_mayor_inicio: true
            },
            descripcion: {
                required: true,
                maxlength: 50
            }
        },
        messages: {
            lugar: {
                required: "<label class='error_validacion'>Campo requerido</label>",
                maxlength: "<label class='error_validacion'>Máximo 50 caracteres</label>"
            },
            asignatura: {
                required: "<label class='error_validacion'>Campo requerido</label>",
                maxlength: "<label class='error_validacion'>Máximo 50 caracteres</label>"
            },
            fecha_ini: {
                required: "<label class='error_validacion'>Campo requerido</label>",
                datetime: "<label class='error_validacion'>Fecha no valida. Formato AAAA-MM-DD HH:MM:SS</label>",
                datetimeNoPasada: "<label class='error_validacion'>No se puede usar una fecha pasada</label>"
            },
            fecha_fin: {
                required: "<label class='error_validacion'>Campo requerido</label>",
                datetime: "<label class='error_validacion'>Fecha no valida. Formato AAAA-MM-DD HH:MM:SS</label>",
                fecha_fin_mayor_inicio: "<label class='error_validacion'>La fecha de fin debe ser posterior a la de inicio</label>"
            },
            descripcion: {
                required: "<label class='error_validacion'>Campo requerido</label>",
                maxlength: "<label class='error_validacion'>Máximo 50 caracteres</label>"
            }
        },
        submitHandler: function (form) {
            form.submit();
        }
    });

    $("#crear-recurso-admin").validate({
        onfocusout: function (element) {
            this.element(element);
        },
        rules: {
            lugar: {
                required: true,
                maxlength: 50
            },
            asignatura: {
                required: true,
                maxlength: 50
            },
            fecha_ini: {
                required: true,
                datetime: true,
                datetimeNoPasada: true
            },
            fecha_fin: {
                required: true,
                datetime: true,
                fecha_fin_mayor_inicio: true
            },
            descripcion: {
                required: true,
                maxlength: 50
            },
            nick: {
                required: true,
                remote: {
                    url: nick_recurso,
                    type: "post"
                }
            }

        },
        messages: {
            lugar: {
                required: "<label class='error_validacion'>Campo requerido</label>",
                maxlength: "<label class='error_validacion'>Máximo 50 caracteres</label>"
            },
            asignatura: {
                required: "<label class='error_validacion'>Campo requerido</label>",
                maxlength: "<label class='error_validacion'>Máximo 50 caracteres</label>"
            },
            fecha_ini: {
                required: "<label class='error_validacion'>Campo requerido</label>",
                datetime: "<label class='error_validacion'>Fecha no valida. Formato AAAA-MM-DD HH:MM:SS</label>",
                datetimeNoPasada: "<label class='error_validacion'>No se puede usar una fecha pasada</label>"
            },
            fecha_fin: {
                required: "<label class='error_validacion'>Campo requerido</label>",
                datetime: "<label class='error_validacion'>Fecha no valida. Formato AAAA-MM-DD HH:MM:SS</label>",
                fecha_fin_mayor_inicio: "<label class='error_validacion'>La fecha de fin debe ser posterior a la de inicio</label>"
            },
            descripcion: {
                required: "<label class='error_validacion'>Campo requerido</label>",
                maxlength: "<label class='error_validacion'>Máximo 50 caracteres</label>"
            },
            nick: {
                required: "<label class='error_validacion'>Introduzca el nombre de usuario</label>",
                remote: "<label class='error_validacion'>El nombre de usuario no existe o no corresponde a un profesor</label>"
            }
        },
        submitHandler: function (form) {
            form.submit();
        }
    });

    $("#login").validate({
        onfocusout: false,
        onkeyup: false,
        rules: {
            nick: "required",
            passw: {
                required: true,
                minlength: 3,
                remote: {
                    url: login,
                    type: "post",
                    data: {
                        nick: function () {
                            return $('#nick').val();
                        }
                    }

                }
            }
        },
        groups: {
            Login: "nick passw"
        },
        messages: {
            passw: {
                required: "<label class='error_validacion'>Please provide a password</label>",
                remote: "<label class='error_validacion'>Usuario o contraseña no valido.</label>",
                minlength: "<label class='error_validacion'>Your password must be at least 5 characters long</label>"
            },
            nick: "<label class='error_validacion'>El nombre de usuario no es valido</label>"
        },
        submitHandler: function (form) {
            form.submit();
        }
    });
});