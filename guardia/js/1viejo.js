$(document).ready(function () {
    tablaPersonas = $("#tablaPersonas").DataTable({
        "order": [[ 0, "asc" ]],
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
                title:'   ',
                orientation: 'landscape',
                pageSize: 'A4',
                exportOptions: {
                    columns: [ 0, 1, 2,3],
                    //  columns: ':visible',
                    search: 'applied',
                    order: 'applied'
                },
                customize:function(doc) {
                    var now = new Date();
                    var jsDate = now.getDate()+'-'+(now.getMonth()+1)+'-'+now.getFullYear();
                    doc.content.splice(1, 0, {
                            columns: [
                                [
                                //     {
                                //     text: 'Registro de pagos',
                                //     fontSize: 22,
                                //     bold: true,
                                //     alignment: 'right',
                                //     margin: [0, 0, 0, 15],
                                //     width: '*'
                                // },
                                //     {
                                //         stack: [{
                                //             columns: [{
                                //                 text: 'Projecto #'+jsDate,
                                //                 fontSize: 12,
                                //                 alignment: 'right',
                                //                 width: '*'
                                //
                                //             },
                                //                 {
                                //                     text: '00001',
                                //                     fontSize: 12,
                                //                     alignment: 'right',
                                //                     width: 100
                                //
                                //                 }
                                //             ]
                                //         },
                                //             {
                                //                 columns: [{
                                //                     text: 'Fecha inicio',
                                //                     fontSize: 12,
                                //                     alignment: 'right',
                                //                     width: '*'
                                //                 },
                                //                     {
                                //                         text: 'June 01, 2016',
                                //                         fontSize: 12,
                                //                         alignment: 'right',
                                //                         width: 100
                                //                     }
                                //                 ]
                                //             },
                                //             {
                                //                 columns: [{
                                //                     text: 'Fecha Entrega',
                                //                     fontSize: 12,
                                //                     alignment: 'right',
                                //                     width: '*'
                                //                 },
                                //                     {
                                //                         text: 'June 05, 2016',
                                //                         fontSize: 12,
                                //                         alignment: 'right',
                                //                         width: 100
                                //                     }
                                //                 ]
                                //             },
                                //         ]
                                //     }
                                ],
                            ],
                        },
                        // Billing Headers
                        {
                            columns: [{
                                text: 'Ejército Argentino',
                                fontSize: 14,
                                bold: true,
                                alignment: 'left',
                                margin: [40, 0, 0, 5],

                            }]
                        },
                        {
                            columns: [{
                                text: 'Facultad de Ingeniería del Ejército',
                                fontSize: 14,
                                bold: true,
                                alignment: 'left',
                                margin: [0, 0, 0, 5],

                            }]
                        },
                        // Billing Details
                        {
                            columns: [{
                                text: 'Primero de Mayo, #606 \n Toluca, Estado de México, México C.P. 50090 \n (722) 385 4119 ',
                                alignment: 'left'
                            }]
                        },
                        // Billing Address Title
                        {
                            columns: [{
                                text: 'Cliente',
                                margin: [0, 7, 0, 3],
                                bold: true
                            }]
                        },
                        // Billing Address
                        {
                            columns: [{
                                text: 'Nombre: \n Direccion: \n   Teléfono: '
                            }]
                        },
                        // Line breaks
                        '\n\n',

                        // Signature
                        {
                            columns: [{
                                text: '',
                            },
                                {
                                    stack: [{
                                        text: '_________________________________',
                                        style: 'signaturePlaceholder'
                                    },
                                        {
                                            text: 'Cliente',
                                            style: 'signatureName'

                                        },
                                        {
                                            text: 'Banda',
                                            style: 'signatureJobTitle'

                                        }
                                    ],
                                    width: 180
                                },
                            ]
                        }, {
                            text: 'NOTA:',
                            style: 'notesTitle'
                        }, {
                            text: 'Este registro de pagos es un documento acordado entre el representante de Estudios 606 y el cliente \n\n En el presente el cliente se compromete a pagar en su totalidad la cantidad acordada antes de que le sea completado el servicio solicitado, estando de acuerdo que si el pago no se realiza, Estudios 606 se reserva el derecho de entregar el producto final',
                            style: 'notesText'
                        }

                    );

                   var now = new Date();
                    var jsDate = now.getDate()+'-'+(now.getMonth()+1)+'-'+now.getFullYear();
                    doc.pageMargins = [20,60,20,40];
                    doc.defaultStyle.fontSize = 9;
                    doc.styles.tableHeader.fontSize = 10;

                    doc['header']=(function() {
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
                                    margin: [10,0]
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

                    doc['footer']=(function(page, pages) {
                        return {
                            columns: [
                                {
                                    //  alignment: 'left',
                                    // text: ['Created on: ', { text: jsDate.toString() }]
                                },
                                {
                                    alignment: 'right',
                                    text: ['Página ', { text: page.toString() },	' de ',	{ text: pages.toString() }]
                                }
                            ],
                            margin: 20
                        }
                    });
                    var objLayout = {};
                    objLayout['hLineWidth'] = function(i) { return .5; };
                    objLayout['vLineWidth'] = function(i) { return .5; };
                    objLayout['hLineColor'] = function(i) { return '#aaa'; };
                    objLayout['vLineColor'] = function(i) { return '#aaa'; };
                    objLayout['paddingLeft'] = function(i) { return 4; };
                    objLayout['paddingRight'] = function(i) { return 4; };
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
        var respuesta = confirm("¿Está seguro de eliminar el registro: " + id + "?");
        if (respuesta) {
            tablaPersonas.row(fila.parents('tr')).remove().draw();

            $.ajax({
                url: "bd/crud1.php",
                type: "POST",
                dataType: "json",
                data: { opcion: opcion, id: id },
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
            data: { lugar: lugar, salida: salida, entrada: entrada, destino: destino, vehiculo: vehiculo, conductor: conductor, kmsalida: kmsalida, kmentrada: kmentrada, obs: obs, id: id,fecha:fecha, opcion: opcion },
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
                botones= "<td><div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditar'>EDITAR</button><button class='btn btn-danger btnBorrar'>ELIMINAR</button></div></div></td>";
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


                }
                else {
                    if (opcion == 2) {
                        tablaPersonas.row(fila).data([id, lugar, salida, entrada, destino, vehiculo, conductor, kmSalida, kmEntrada, obs, botones]).draw();
                    }else{
                        tablaPersonas.row(fila).data([id, lugar, salida, entrada, destino, vehiculo, conductor, kmSalida, kmEntrada, obs, botones]).draw();
                    }

                }
            }
        });
        $("#modalCRUD").modal("hide");
    });
});