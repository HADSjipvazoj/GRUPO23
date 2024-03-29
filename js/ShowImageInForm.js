$(document).ready(function () {
    //Funcion que modifica el DOM y muestra la imagen elegida para la pregunta.
    $("#fileupload").change( function(){
        var pattern = /(\.png|\.jpg|\.jpeg)$/i;
        $("#imagen_prev").remove();
        if(pattern.test($("#fileupload").val())){
            $("#fileupload").after("<img src='' id='imagen_prev' name = 'imagen'>");
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#imagen_prev').attr('src', e.target.result);
            };
            reader.readAsDataURL(this.files[0]);
        }
    });
});
