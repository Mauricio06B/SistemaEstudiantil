$(document).ready(function(e){
    $("#form_guardarAsistencia").submit(function(e){
        e.preventDefault();
        codigo_estudiante = $("#input_codigo_estudiante").val();
        codigo_clase = $("#input_codigo_clase").val();

        $.ajax({
            url: "guardarAsistencia.php",
            type: "POST",
            dataType: "json",
            data: {
                codigo_estudiante: codigo_estudiante,
                id_clase: codigo_clase
            },
            success: function(data){
                if(data.resultado == "OK"){
                    $("#mensaje_asistencia").html("<div class='alert alert-success'>Asistencia guardada correctamente.</div>");
                    $("#form_guardarAsistencia").hide();
                }else{
                    $("#mensaje_asistencia").html("<div class='alert alert-danger'>Error, por favor verifique la información.</div>");
                }
            },
            error: function(e1, e2, e3){
                console.log(e1);
                console.log(e2);
                console.log(e3);
            }
        });
    })
});