$(document).ready(function () {
    tablaPersonas = $("#tablaPersonas").DataTable({
        "order": [[0, "asc"]],
        // "columnDefs": [{
        //      "targets": -1,
        //      "data": null,
        //      "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditar'>EDITAR</button><button class='btn btn-danger btnBorrar'>ELIMINAR</button></div></div>"
        // }
        // ],
        "dom": '<"dt-buttons"Bf><"clear">lirtp',
        "buttons": [
            {
                extend: 'pdfHtml5',
                text: '<button class="btn-danger">Ver Planilla<i class="far fa-file-pdf"></i></button>',
                download: 'open',
                //className: '',
                //messageTop: ' ',
                title: '   ',
                orientation: 'landscape',
                pageSize: 'A4',
                exportOptions: {
                    columns: [1, 2, 3,4,5,6,7,8,9],
                    //  columns: ':visible',
                    search: 'applied',
                    order: 'applied'
                },
                customize: function (doc) {
                    var now = new Date();
                    var jsDate = now.getDate() + '-' + (now.getMonth() + 1) + '-' + now.getFullYear();

                    let fecha = new Date(document.getElementById("fechaElevar").value);
                    let auxGu = (document.getElementById("auxGu").value);
                    let jGu = (document.getElementById("jGu").value);
                    let ofSer = (document.getElementById("ofSer").value);

                    //console.log(fecha.toDateString());
                    let dia, mes, anio;
                    dia = fecha.getDay();
                    mes = new Intl.DateTimeFormat('es-ES', {month: 'long'}).format(fecha);
                    anio = fecha.getFullYear();

                    doc.content.splice(1, 0,
                        {
                            columns: [{

                                text: 'PLANILLA DE REGISTRO DE MOVIMIENTOS DE VEHÍCULOS OFICIALES \n ' +
                                    'Servicio de Guardia del día ' + dia + ' al ' + (dia + 1) + ' de ' + mes + ' de ' + anio + '\n\n',
                                fontSize: 13,
                                decoration: 'underline',
                                alignment: 'center',
                                margin: [0, 0, 0, 0]
                            }]
                        },{
                            columns: [{

                                text: 'OFICIAL DE SERVICIO: \t'+ auxGu +
                                    '\nJEFE DE GUARDIA: \t' + jGu +
                                '\nAUXILIAR DE GUARDIA: \t' + ofSer+ '\n\n',
                                fontSize: 13,

                                alignment: 'left',
                                margin: [0, 1, 0, 0]
                            }]
                        }
                    );

                    var now = new Date();
                    var jsDate = now.getDate() + '-' + (now.getMonth() + 1) + '-' + now.getFullYear();
                    doc.pageMargins = [20, 60, 20, 40];
                    doc.defaultStyle.fontSize = 9;
                    doc.styles.tableHeader.fontSize = 10;

                    doc.content[1].maxWidth = 20;


                    doc['header'] = (function () {
                        return {
                            columns: [
                                {
                                    text: 'Ejército Argentino\n Facultad de Ingeniería del Ejército',
                                    fontSize: 13,
                                    italics: true,
                                    alignment: 'center',
                                    margin: [0, 0, 0, 5],
                                },
                                {
                                    alignment: 'left',
                                    italics: true,
                                    text: '',
                                    fontSize: 18,
                                    margin: [10, 0]
                                },
                                {
                                    alignment: 'left',
                                    fontSize: 14,
                                    text: ''

                                }

                            ],
                            margin: 20
                        }
                    });

                    doc['footer'] = (function (page, pages) {
                        return {
                            columns: [
                                {
                                    //   alignment: 'left',
                                    // text: ['Created on: ', { text: jsDate.toString() }]
                                },
                                {
                                    alignment: 'right',
                                    text: ['Página ', {text: page.toString()}, ' de ', {text: pages.toString()}]
                                }
                            ],
                            margin: 20
                        }
                    });
                    var objLayout = {};
                    objLayout['hLineWidth'] = function (i) {
                        return .5;
                    };
                    objLayout['vLineWidth'] = function (i) {
                        return .5;
                    };
                    objLayout['hLineColor'] = function (i) {
                        return '#aaa';
                    };
                    objLayout['vLineColor'] = function (i) {
                        return '#aaa';
                    };
                    objLayout['paddingLeft'] = function (i) {
                        return 4;
                    };
                    objLayout['paddingRight'] = function (i) {
                        return 4;
                    };
                    doc.content[0].layout = objLayout;
                }
            }],
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
    $("#btnObservar").click(function () {
        $("#formObservar").trigger("reset");
        $(".modal-header").css("background-color", "#1cc88a");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Observar Planilla");
        $("#modalObservar").modal("show");
        id = null;
        opcion = 1; //alta
    });
    var fila; //capturar la fila para editar o borrar el registro

    //botón EDITAR
    $(document).on("click", ".btnEditar", function () {
        fila = $(this).closest("tr");
        id = parseInt(fila.find('td:eq(0)').text());
        // nro = parseInt(fila.find('td:eq(1)').text());
        lugar = fila.find('td:eq(1)').text();
        salida = fila.find('td:eq(2)').text();
        entrada = fila.find('td:eq(3)').text();
        destino = fila.find('td:eq(4)').text();
        vehiculo = 1;//parseInt(fila.find('td:eq(5)').text());
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
        //alert(id);
        //tablaPersonas.row(id).remove().draw();
        opcion = 3 //borrar
        var respuesta = confirm("¿Está seguro de eliminar el registro?");
        if (respuesta) {
            tablaPersonas.row(fila.parents('tr')).remove().draw();

            $.ajax({
                url: "bd/crud1.php",
                type: "POST",
                dataType: "json",
                data: {opcion: opcion, id: id},
                success: function () {
                    // tablaPersonas.row(fila.parents('tr')).remove().draw();

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
        fecha = $.trim($("#fecha1").val());

        // var table = $('#tablaPersonas').DataTable();

        //alert( 'Rows '+table.data().count()+' are selected' );
        // cant=table.data().count()+1;

        $.ajax({
            url: "bd/crud1.php",
            type: "POST",
            dataType: "json",
            data: {
                lugar: lugar,
                salida: salida,
                entrada: entrada,
                destino: destino,
                vehiculo: vehiculo,
                conductor: conductor,
                kmsalida: kmsalida,
                kmentrada: kmentrada,
                obs: obs,
                id: id,
                fecha: fecha,
                opcion: opcion
            },
            success: function (data) {
                // console.log(data);
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
                botones = "<td><div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditar btn-sm'>EDITAR</button><button class='btn btn-danger btnBorrar btn-sm'>ELIMINAR</button></div></div></td>";
                if (opcion == 1) {
                    tablaPersonas.order([0, 'desc']).draw();

                    tablaPersonas.row.add([id, lugar, salida, entrada, destino, vehiculo, conductor, kmSalida, kmEntrada, obs, botones]).draw();
                    $('#tablaPersonas tbody td').eq(0).addClass('oculto');
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
                    tablaPersonas.order([0, 'asc']).draw();


                } else {
                    if (opcion == 2) {
                        tablaPersonas.row(fila).data([id, lugar, salida, entrada, destino, vehiculo, conductor, kmSalida, kmEntrada, obs, botones]).draw();
                    } else {
                        tablaPersonas.row(fila).data([id, lugar, salida, entrada, destino, vehiculo, conductor, kmSalida, kmEntrada, obs, botones]).draw();
                    }

                }
            }
        });
        $("#modalCRUD").modal("hide");
    });
});