$(document).ready(function () {
    tablaPersonas = $("#tablaPersonas").DataTable({
        "order": [[ 0, "asc" ]],
        "columnDefs": [{
            "targets": -1,
            "data": null,
            "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditar'>EDITAR</button><button class='btn btn-danger btnBorrar'>ELIMINAR</button></div></div>"
        }
        ],
        "searching": false,
        "paging": false,
        "info": false,
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
        $(".modal-title").text("Nuevo Registro");
        $("#modalCRUD").modal("show");
        id = null;
        opcion = 1; //alta
    });
    $("#btnCerrar").click(function () {
        $("#formPersonas").trigger("reset");
        $(".modal-header").css("background-color", "#1cc88a");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Cerrar Planilla");
        $("#modalCerrar").modal("show");
        id = null;
        opcion = 1; //alta
    });

    var fila; //capturar la fila para editar o borrar el registro

    //botón EDITAR    
    $(document).on("click", ".btnEditar", function () {
        fila = $(this).closest("tr");
        id = parseInt(fila.find('td:eq(0)').text());
        lugar = fila.find('td:eq(1)').text();
        salida = fila.find('td:eq(2)').text();
        entrada = fila.find('td:eq(3)').text();
        destino = fila.find('td:eq(4)').text();
        vehiculo = parseInt(fila.find('td:eq(5)').text());
        conductor = fila.find('td:eq(6)').text();
        kmsalida = parseInt(fila.find('td:eq(7)').text());
        kmentrada = parseInt(fila.find('td:eq(8)').text());
        obs = fila.find('td:eq(9)').text();

        $("#lugar").val(lugar);
        $("#salida").val(salida);
        $("#entrada").val(entrada);
        $("#destino").val(destino);
        $("#vehiculo").val(vehiculo);
        $("#conductor").val(conductor);
        $("#kmsalida").val(kmsalida);
        $("#kmentrada").val(kmentrada);
        $("#obs").val(obs);

        opcion = 2; //editar

        $(".modal-header").css("background-color", "#4e73df");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Editar Movimiento");
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
                url: "bd/crud1.php",
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
        //alert("anda");
        e.preventDefault();
        lugar = $.trim($("#lugar").val());
        salida = $.trim($("#salida").val());
        entrada = $.trim($("#entrada").val());
        destino = $.trim($("#destino").val());
        vehiculo = $.trim($("#vehiculo").val());
        conductor = $.trim($("#conductor").val());
        kmsalida = ($("#kmsalida").val());
        kmentrada = ($("#kmentrada").val());
        obs = $.trim($("#obs").val());
        // console.log(lugar);
        // console.log(salida);
        // console.log(entrada);
        // console.log(destino);
        // console.log(vehiculo);
        // console.log(conductor);
        // console.log(kmsalida);
        // console.log(kmentrada);
        //
        // console.log(obs);


        $.ajax({
            url: "bd/crud1.php",
            type: "POST",
            dataType: "json",
            data: { lugar: lugar, salida: salida, entrada: entrada, destino: destino, vehiculo: vehiculo, conductor: conductor, kmsalida: kmsalida, kmentrada: kmentrada, obs: obs, id: id, opcion: opcion },
            success: function (data) {
                console.log(data);
                id = data[0].id;
                lugar = data[0].lugar;
                salida = data[0].horaSalida;
                entrada = data[0].horaEntrada;
                destino = data[0].destino;
                vehiculo = data[0].vehiculo;
                conductor = data[0].conductor;
                kmSalida = data[0].kmSalida;
                kmEntrada = data[0].kmEntrada;
                obs = data[0].observacion;

                if (opcion == 1) {
                    //alert(id);
                    tablaPersonas.order([0, 'desc']).draw();
                    tablaPersonas.row.add([id, lugar, salida, entrada, destino, vehiculo, conductor, kmSalida, kmEntrada, obs, "", "", ""]).draw();
                    // $('#tablaPersonas tbody td').eq(4).addClass('oculto');
                    // $('#tablaPersonas tbody td').eq(5).addClass('oculto');
                    // $('#tablaPersonas tbody td').eq(6).addClass('oculto');
                    // $('#tablaPersonas tbody td').eq(7).addClass('oculto');
                    // $('#tablaPersonas tbody td').eq(8).addClass('oculto');
                    // $('#tablaPersonas tbody td').eq(9).addClass('oculto');
                    // $('#tablaPersonas tbody td').eq(10).addClass('oculto');
                    // $('#tablaPersonas tbody td').eq(11).addClass('oculto');
                    // $('#tablaPersonas tbody td').eq(12).addClass('oculto');
                    // $('#tablaPersonas tbody td').eq(13).addClass('oculto');
                    // $('#tablaPersonas tbody td').eq(14).addClass('oculto');
                    // $('#tablaPersonas tbody td').eq(15).addClass('oculto');


                }
                else { tablaPersonas.row(fila).data([id, lugar, salida, entrada, destino, vehiculo, conductor, kmSalida, kmEntrada, obs, "edir","",""]).draw(); }
            }
        });
        $("#modalCRUD").modal("hide");
    });
});