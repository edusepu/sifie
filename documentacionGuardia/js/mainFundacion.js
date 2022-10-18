$(document).ready(function () {
    tablaFundacion = $("#tablaFundacion").DataTable({
        "order": [[ 0, "desc" ]],
        "columnDefs": [{
            "targets": -1,
            "data": null,
            "defaultContent": "<div class='text-center'><div class='btn-group'><a id='' class='oculto' href='#'><img class='btnUbicacion' style=' height: 38px;' src='../img/ubicacion.png'></a><a id='detalle' class='oculto' href='#'><img class='btnQR' style=' height: 38px;' src='../img/qr.png'></a><button class='btn btn-dark btnQR' style=''>QR</button><button class='btn btn-info btnDetalle' style='width: 110px;'>Detalle PC</button><button class='btn btn-primary btnEditar'>Editar</button><button class='btn btn-danger btnBorrar'>Borrar</button></div></div>"
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
        $(".modal-title").text("Nuevo Efecto");
        $("#modalCRUD").modal("show");
        id = null;
        opcion = 1; //alta
    });



    var fila; //capturar la fila para editar o borrar el registro
    //botón Detalle    
    $(document).on("click", ".btnDetalle", function () {
        fila = $(this).closest("tr");
        id = parseInt(fila.find('td:eq(0)').text());
        elemento = fila.find('td:eq(1)').text();
        descripcion = fila.find('td:eq(2)').text();
        dpto = fila.find('td:eq(3)').text();
        ubicacion = fila.find('td:eq(4)').text();

        idDetalle = parseInt(fila.find('td:eq(5)').text());
        marcaProcesador = parseInt(fila.find('td:eq(6)').text());
        procesador = (fila.find('td:eq(7)').text());
        ram = parseInt(fila.find('td:eq(8)').text());
        tipoDisco = parseInt(fila.find('td:eq(9)').text());
        capacidadDisco = parseInt(fila.find('td:eq(10)').text());
        medidaCapacidad = parseInt(fila.find('td:eq(11)').text());
        sistemaOperativo = (fila.find('td:eq(12)').text());
        observaciones = (fila.find('td:eq(13)').text());
        observacion = (fila.find('td:eq(14)').text());

        //alert(observaciones);
        $("#elemento").val(elemento);
        $("#descripcion").val(descripcion);
        $("#dpto").val(dpto);
        $("#ubicacion").val(ubicacion);
        $("#idDetalle").val(idDetalle);
        $("#micro").val(procesador);
        $("#so").val(sistemaOperativo);
        $("#ram").val(ram);
        $("#disco").val(capacidadDisco);
        $("#tipoMicro").val(marcaProcesador);
        $("#tipoDisco").val(tipoDisco);
        $("#capacidadDisco").val(medidaCapacidad);
        $("#obs").val(observaciones);
        $("#observacion").val(observacion);


        //detalle

        if (idDetalle) {            
            $(".modal-header").css("background-color", "#4e73df");
            $(".modal-header").css("color", "white");
            $(".modal-title").text("Editar Detalle a EFECTO ID: " + idDetalle);
            $('#detalle').attr('href', 'detalleF.php?id='+idDetalle);
            $('.detalle').attr('href', 'detalleF.php?id='+idDetalle);
            $('.detalle').show();
            opcion = 2;
        } else {
            $("#formDetalle").trigger("reset");
            $(".modal-header").css("background-color", "#1cc88a");
            $(".modal-header").css("color", "white");
            $(".modal-title").text("Asignar Detalle a EFECTO ID: " + id);

            //$('#detalle').attr('href', 'detalle.php?id='+idDetalle);
            $('.detalle').hide();
            opcion = 1; //alta
        }

        $("#modalDetalle").modal("show");

    });
    //botón EDITAR    
    $(document).on("click", ".btnEditar", function () {
        fila = $(this).closest("tr");
        id = parseInt(fila.find('td:eq(0)').text());
        elemento = fila.find('td:eq(1)').text();
        descripcion = fila.find('td:eq(2)').text();
        dpto = fila.find('td:eq(3)').text();
        ubicacion = fila.find('td:eq(4)').text();
        idDetalle = parseInt(fila.find('td:eq(5)').text());
        marcaProcesador = parseInt(fila.find('td:eq(6)').text());
        procesador = (fila.find('td:eq(7)').text());
        ram = parseInt(fila.find('td:eq(8)').text());
        tipoDisco = parseInt(fila.find('td:eq(9)').text());
        capacidadDisco = parseInt(fila.find('td:eq(10)').text());
        medidaCapacidad = parseInt(fila.find('td:eq(11)').text());
        sistemaOperativo = (fila.find('td:eq(12)').text());
        observaciones = (fila.find('td:eq(13)').text());
        observacion = (fila.find('td:eq(14)').text());
        $("#elemento").val(elemento);
        $("#descripcion").val(descripcion);
        $("#dpto").val(dpto);
        $("#ubicacion").val(ubicacion);
        $("#observacion").val(observacion);

        opcion = 2; //editar


        $(".modal-header").css("background-color", "#4e73df");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Editar Efecto");
        $("#modalCRUD").modal("show");

    });

    //botón BORRAR
    $(document).on("click", ".btnBorrar", function () {
        fila = $(this);
        id = parseInt($(this).closest("tr").find('td:eq(0)').text());
        opcion = 3 //borrar
        var respuesta = confirm("¿Está seguro de eliminar el registro: " + id + "?");
        if (respuesta) {
            $.ajax({
                url: "bdF/crud.php",
                type: "POST",
                dataType: "json",
                data: { opcion: opcion, id: id },
                success: function () {
                    tablaFundacion.row(fila.parents('tr')).remove().draw();
                }
            });
        }
    });

    $("#formPersonas").submit(function (e) {
//        alert("anda");
        e.preventDefault();
        elemento = $.trim($("#elemento").val());
        descripcion = $.trim($("#descripcion").val());
        dpto = $.trim($("#dpto").val());
        ubicacion = $.trim($("#ubicacion").val());
        observacion = $.trim($("#observacion").val());
        proyecto = $.trim($("#proyecto").val());
console.log(observacion);
//        console.log("sssss");
        $.ajax({
            url: "bdF/crud.php",
            type: "POST",
            dataType: "json",
            data: { elemento: elemento, descripcion: descripcion, dpto: dpto, ubicacion: ubicacion, observacion: observacion, proyecto: proyecto, id: id, opcion: opcion },
            success: function (data) {
                //console.log(data);
                id = data[0].id;
                elemento = data[0].elemento;
                descripcion = data[0].descripcion;
                dpto = data[0].dpto;
                ubicacion = data[0].ubicacion;
                //observacion = data[0].observacion;
                proyecto = data[0].proyecto;
                idDetalle = data[0].idDetalle;
                marcaProcesador = data[0].marcaProcesador;
                procesador = data[0].procesador;
                ram = data[0].ram;
                tipoDisco = data[0].tipoDisco;
                capacidadDisco = data[0].capacidadDisco;
                medidaCapacidad = data[0].medidaCapacidad;
                sistemaOperativo = data[0].sistemaOperativo;
                observaciones = data[0].observaciones;
                observacion = data[0].observacion;

                if (opcion == 1) {
                    tablaFundacion.order([0, 'desc']).draw();
                    tablaFundacion.row.add([id, elemento, descripcion, '', ubicacion, "", "", "", "", "", "", "", "", "", observacion]).draw();
                    $('#tablaFundacion tbody td').eq(3).addClass('oculto');
                    $('#tablaFundacion tbody td').eq(5).addClass('oculto');
                    $('#tablaFundacion tbody td').eq(6).addClass('oculto');
                    $('#tablaFundacion tbody td').eq(7).addClass('oculto');
                    $('#tablaFundacion tbody td').eq(8).addClass('oculto');
                    $('#tablaFundacion tbody td').eq(9).addClass('oculto');
                    $('#tablaFundacion tbody td').eq(10).addClass('oculto');
                    $('#tablaFundacion tbody td').eq(11).addClass('oculto');
                    $('#tablaFundacion tbody td').eq(12).addClass('oculto');

                    $('#tablaFundacion tbody td').eq(13).addClass('oculto');
                    $('#tablaFundacion tbody td').eq(14).addClass('oculto');


                }
                else { tablaFundacion.row(fila).data([id, elemento, descripcion, '', ubicacion, idDetalle, marcaProcesador, procesador, ram, tipoDisco, capacidadDisco, medidaCapacidad, sistemaOperativo, observaciones, observacion]).draw(); }
            }
        });
        $("#modalCRUD").modal("hide");

    });



    $("#formDetalle").submit(function (e) {
        // alert("anda detalle" +opcion);
        e.preventDefault();

        micro = $.trim($("#micro").val());
        marcaProcesador = $.trim($("#tipoMicro").val());
        ram = $.trim($("#ram").val());
        tipoDisco = $.trim($("#tipoDisco").val());
        disco = $.trim($("#disco").val());
        medidaCapacidad = $.trim($("#capacidadDisco").val());
        so = $.trim($("#so").val());
        obs = $.trim($("#obs").val());

        /*   INE = $.trim($("#INE").val());
           NI = $.trim($("#NI").val());
           dpto = $.trim($("#dpto").val());*/

        $.ajax({
            url: "bdF/crudDetalle.php",
            type: "POST",
            dataType: "json",
            data: {id: id, marcaProcesador:marcaProcesador, micro: micro, ram:ram, tipoDisco:tipoDisco, disco:disco, medidaCapacidad:medidaCapacidad,so:so,obs:obs,opcion: opcion },
            success: function (data) {
                //console.log(data);
                id = data[0].id;
                micro = data[0].micro;
                elemento = data[0].elemento;
                descripcion = data[0].descripcion;
                dpto = data[0].dpto;
                ubicacion = data[0].ubicacion;
                idDetalle = data[0].id;
                marcaProcesador = data[0].marcaProcesador;
                procesador = data[0].procesador;
                ram = data[0].ram;
                tipoDisco = data[0].tipoDisco;
                capacidadDisco = data[0].capacidadDisco;
                medidaCapacidad = data[0].medidaCapacidad;
                sistemaOperativo = data[0].sistemaOperativo;
                observaciones = data[0].observaciones;
                observacion = data[0].observacion;


                if (opcion == 1) { tablaFundacion.row(fila).data([id, elemento, descripcion, '',ubicacion,id, marcaProcesador, procesador, ram, tipoDisco, capacidadDisco, medidaCapacidad, sistemaOperativo, observaciones, observacion]).draw(); }
                else { tablaFundacion.row(fila).data([id, elemento, descripcion, '', ubicacion, idDetalle, marcaProcesador, procesador, ram, tipoDisco, capacidadDisco, medidaCapacidad, sistemaOperativo, observaciones, observacion]).draw(); }
            }
        });
        $("#modalDetalle").modal("hide");


    });
    $("#btnQR").click(function () {

        $("#formQR").trigger("reset");
        $(".modal-header").css("background-color", "#1cc88a");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Imprimir Obleas QR");
        $("#modalQR").modal("show");
    });

    $(document).on("click", ".btnQR", function (event) {
        var sizeqr="300";
        fila = $(this).closest("tr");
        id = parseInt(fila.find('td:eq(0)').text());
        var textqr="sifie/efectos/efectos/detalleF.php?id="+id;
        parametros={"textqr":textqr,"sizeqr":sizeqr};
        window.open("generarqrF.php?id="+id, '_blank');
        event.preventDefault();
    });

    $(document).on("click", ".btnUbicacion", function (event) {
        fila = $(this).closest("tr");
        var idurl =parseInt(fila.find('td:eq(0)').text());
        window.open("mapa.php?id="+idurl, '_self');
        event.preventDefault();

    });

});