$(document).ready(function () {
    $("#formulario").submit(function () {
      if(!check_fields()) return false;
      if(!check_email()) return false;
      if(!check_question()) return false;
      if(!check_difficulty()) return false;
      $("#aviso").html("");
      return true;
    });
    $("#reset").click( function(){
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
      $("#aviso").html("");
    });
});

function check_fields(){
  if(!$("#user1").is(":checked") && !$("#user2").is(":checked")){ $("#aviso").html("Selecciona un tipo de usuario."); ;return false;}
  if($("#email").val().length == 0){ $("#aviso").html("Indica tu email."); return false;}
  if($("#enunciado").val().length == 0){ $("#aviso").html("Indica un enunciado."); return false;}
  if($("#correcta").val().length == 0){ $("#aviso").html("Indica la respuesta correcta."); return false;}
  if($("#incorrecta1").val().length == 0){ $("#aviso").html("Indica las respuestas incorrectas."); return false;}
  if($("#incorrecta2").val().length == 0){ $("#aviso").html("Indica las respuestas incorrectas."); return false;}
  if($("#incorrecta3").val().length == 0){ $("#aviso").html("Indica las respuestas incorrectas."); return false;}
  if($("#dificultad").val().length == 0){ $("#aviso").html("Selecciona un nivel de dificultad."); return false;}
  if($("#tema").val().length == 0){ $("#aviso").html("Indica un tema para la pregunta.");return false;}
  return true;
}

function check_email(){
  var pattern;
  if($("#user1").is(":checked")){
    pattern = /^([a-z]|[A-Z])+[0-9]{3}@ikasle.ehu.(es|eus)$/;
  }else{
    pattern = /^([a-z]|[A-Z])+(.([a-z]|[A-Z])+)?@ehu.(es|eus)$/;
  }
  if(pattern.test($("#email").val())){
    return true;
  }else{
    $("#aviso").html("Email incorrecto para el tipo de usuario indicado.");
    return false;
  }
}

function check_question(){
  if($("#enunciado").val().length < 10){ $("#aviso").html("El enunciado es demasiado corto."); return false;}
  return true;
}

function check_difficulty(){
  var pattern = /^(1|2|3)$/;
  if(pattern.test($("#dificultad").val())){
    return true;
  }else {
    $("#aviso").html("Nivel de dificultad incorrecto, elige un numero del 1 al 3.");
    return false;
  }
}
