$(document).ready(function () {
    tablaPersonas = $("#tablaPersonas").DataTable({
        "order": [[ 0, "desc" ]],
        "columnDefs": [{
            "targets": -1,
            "data": null,
            "defaultContent": "<div class='text-center'><div class='btn-group'><a id='ubicacion' class='oculto' href='#'><img class='btnUbicacion' style=' height: 38px;' src='../img/ubicacion.png'></a><button class='btn btn-primary btnEditar'>Editar</button><button class='btn btn-danger btnBorrar'>Borrar</button></div></div>"
        }
        ],

        "language": {
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "sProcessing": "Procesando...",
        }
    });

    $("#btnNuevo").click(function () {
        $("#formPersonas").trigger("reset");
        $(".modal-header").css("background-color", "#1cc88a");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Nuevo Usuario");
        $("#modalCRUD").modal("show");
        id = null;
        opcion = 1; //alta
    });
    var fila;
    //botón EDITAR    
    $(document).on("click", ".btnEditar", function () {
        fila = $(this).closest("tr");
        id = parseInt(fila.find('td:eq(0)').text());
        usuario = fila.find('td:eq(1)').text();
        tipo = fila.find('td:eq(2)').text();
        departamento = parseInt(fila.find('td:eq(4)').text());
        cargos = +(fila.find('td:eq(6)').text());
        fundacion = parseInt(fila.find('td:eq(7)').text());
        proyecto = parseInt(fila.find('td:eq(8)').text());
        //fundacion = +(document.getElementById("fundacion").checked);


        $("#usuario").val(usuario);
        $("#tipo").val(tipo);
        $("#departamento").val(departamento);
        $("#cargos").val(cargos);
        $("#fundacion").val(fundacion);
        $("#proyecto").val(proyecto);
        $("#cargos").removeAttr("checked");
        $("#fundacion").removeAttr("checked");
        $("#proyecto").removeAttr("checked");

        if($("#cargos").val() == '1'){
            $("#cargos").prop( "checked", true );

        }else{
            $("#cargos").prop( "checked", false );
        }
        if($("#fundacion").val() == "1"){
            $("#fundacion").prop( "checked", true );
        }else{
            $("#fundacion").prop( "checked", false );
        }
        if($("#proyecto").val() == '1'){
            $("#proyecto").prop( "checked", true );
        }else{
            $("#proyecto").prop( "checked", false );
        }
        opcion = 2; //editar

        $(".modal-header").css("background-color", "#4e73df");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Editar Usuario"+id);
        $("#modalCRUD").modal("show");

    });

    //botón BORRAR
    $(document).on("click", ".btnBorrar", function () {
        fila = $(this);
        id = parseInt($(this).closest("tr").find('td:eq(0)').text());
        opcion = 3 //borrar
        var respuesta = confirm("¿Está seguro de eliminar el USUARIO: " + id + "?");
        if (respuesta) {
            $.ajax({
                url: "bd/crudAdmin.php",
                type: "POST",
                dataType: "json",
                data: { opcion: opcion, id: id },
                success: function () {
                    tablaPersonas.row(fila.parents('tr')).remove().draw();
                }
            });
        }
    });

    $("#formPersonas").submit(function (e) {
        e.preventDefault();
        usuario = $.trim($("#usuario").val());
        tipo = $.trim($("#tipo").val());
        departamento = $.trim($("#departamento").val());
        cargos = +(document.getElementById("cargos").checked);
        fundacion = +(document.getElementById("fundacion").checked);
        proyecto = +(document.getElementById("proyecto").checked);
       // alert(id);
        $.ajax({
            url: "bd/crudAdmin.php",
            type: "POST",
            dataType: "json",
            data: { usuario: usuario, tipo: tipo, departamento: departamento, cargos: cargos, fundacion: fundacion, proyecto: proyecto, id: id, opcion: opcion },
            success: function (data) {
                console.log(data);
                id = data[0].id;

                usuario = data[0].usuario;
                tipo = data[0].tipo;
                tipoDesc = data[0].tipoDesc;
                departamento = data[0].departamento;
                departamentoDesc = data[0].departamentoDesc;
                //cargos = data[0].cargos;
                //fundacion = data[0].fundacion;
                //proyecto = data[0].proyecto;

                if(data[0].fundacion==1){
                    fundacion ="<div style='text-align:center;'><div class='oculto'>"+fundacion+"</div><img style='height: 30px;' src='../img/check.png'></div>";
                }else{
                    fundacion ="<div style='text-align:center;'><div class='oculto'>"+fundacion+"</div><img style='height: 30px;' src='../img/cross.png'></div>";
                }
                if(data[0].cargos==1){
                    cargos ="<div style='text-align:center;'><div class='oculto'>"+cargos+"</div><img style='height: 30px;' src='../img/check.png'></div>";
                }else{
                    cargos ="<div style='text-align:center;'><div class='oculto'>"+cargos+"</div><img style='height: 30px;' src='../img/cross.png'></div>";
                }
                if(data[0].proyecto==1){
                    proyecto ="<div style='text-align:center;'><div class='oculto'>"+proyecto+"</div><img style='height: 30px;' src='../img/check.png'></div>";
                }else{
                    proyecto ="<div style='text-align:center;'><div class='oculto'>"+proyecto+"</div><img style='height: 30px;' src='../img/cross.png'></div>";
                }


                if (opcion == 1) {
                    tablaPersonas.order([0, 'desc']).draw();
                    tablaPersonas.row.add([id, usuario, tipo, tipoDesc, departamento,departamentoDesc, cargos, fundacion,proyecto, ""]).draw();
                    $('#tablaPersonas tbody td').eq(2).addClass('oculto');
                    $('#tablaPersonas tbody td').eq(4).addClass('oculto');



                }
                else { tablaPersonas.row(fila).data([id, usuario, tipo, tipoDesc, departamento,departamentoDesc, cargos, fundacion, proyecto,""]).draw();
                    $('#tablaPersonas tbody td').eq(2).addClass('oculto');
                    $('#tablaPersonas tbody td').eq(4).addClass('oculto');
                }
            }
        });
        $("#modalCRUD").modal("hide");
    });
});