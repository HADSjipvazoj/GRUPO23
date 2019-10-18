$(document).ready(function () {
    //Funcion que comprueba que el formulario es valido. Si no lo es, no se envia al servidor.
    /*$("#formulario").submit(function () {
        if (!check_fields()) return false;
        if (!check_email()) return false;
        if (!check_question()) return false;
        if (!check_difficulty()) return false;
        if (!check_image()) return false;
        $("#aviso").html("");
        return true;
    });*/

    //Funcion que resetea los parametros del formulario.
    $("#reset").click(function () {
        $("#user1").prop("checked", false);
        $("#user2").prop("checked", false);
        $("#email").val("");
        $("#enunciado").val("");
        $("#correcta").val("");
        $("#incorrecta1").val("");
        $("#incorrecta2").val("");
        $("#incorrecta3").val("");
        $("#dificultad").val("1");
        $("#tema").val("");
        $("#fileupload").val("");
        $("#imagen_prev").remove();
        $("#aviso").html("");
    });
});

//Funcion que comprueba si los parametros obligatorios han sido rellenados.
function check_fields() {
    if (!$("#user1").is(":checked") && !$("#user2").is(":checked")) {
        $("#aviso").html("Selecciona un tipo de usuario.");;
        return false;
    }
    if ($("#email").val().length == 0) {
        $("#aviso").html("Indica tu email.");
        return false;
    }
    if ($("#enunciado").val().length == 0) {
        $("#aviso").html("Indica un enunciado.");
        return false;
    }
    if ($("#correcta").val().length == 0) {
        $("#aviso").html("Indica la respuesta correcta.");
        return false;
    }
    if ($("#incorrecta1").val().length == 0) {
        $("#aviso").html("Indica las respuestas incorrectas.");
        return false;
    }
    if ($("#incorrecta2").val().length == 0) {
        $("#aviso").html("Indica las respuestas incorrectas.");
        return false;
    }
    if ($("#incorrecta3").val().length == 0) {
        $("#aviso").html("Indica las respuestas incorrectas.");
        return false;
    }
    if ($("#dificultad").val().length == 0) {
        $("#aviso").html("Selecciona un nivel de dificultad.");
        return false;
    }
    if ($("#tema").val().length == 0) {
        $("#aviso").html("Indica un tema para la pregunta.");
        return false;
    }
    return true;
}

//Funcion que comprueba si el email es correcto con respecto al usuario seleccionado.
function check_email() {
    var pattern;
    if ($("#user1").is(":checked")) {
        pattern = /^([a-z]|[A-Z])+[0-9]{3}@ikasle\.ehu\.(es|eus)$/;
    } else {
        pattern = /^([a-z]|[A-Z])+(\.([a-z]|[A-Z])+)?@ehu\.(es|eus)$/;
    }
    if (pattern.test($("#email").val())) {
        return true;
    } else {
        $("#aviso").html("Email incorrecto para el tipo de usuario indicado.");
        return false;
    }
}

//Funcion que comprueba si el enunciado tiene una longitud mayor o igual que 10.
function check_question() {
    if ($("#enunciado").val().length < 10) {
        $("#aviso").html("El enunciado es demasiado corto.");
        return false;
    }
    return true;
}

//Funcion que comprueba si el valor de dificultad es correcto.
function check_difficulty() {
    var pattern = /^(1|2|3)$/;
    if (pattern.test($("#dificultad").val())) {
        return true;
    } else {
        $("#aviso").html("Nivel de dificultad incorrecto, elige un numero del 1 al 3.");
        return false;
    }
}

//Funcion que comprueba si se ha elegido un archivo de imagen valido. Si el formulario no incluye la opcion de subir una imagen, la funcion devuelve siempre true.
function check_image() {
    if ($("#fileupload").length == 0) return true;
    var pattern = /(\.png|\.jpg|\.jpeg)$/i;
    if (pattern.test($("#fileupload").val())) {
        return true;
    } else {
        $("#aviso").html("Elige un archivo de imagen valido (png, jpg, jpeg).");
        return false;
    }
}