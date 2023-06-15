$(document).ready(function () {
    tablaPersonas = $("#tablaPersonas").DataTable({
        "order": [[ 0, "asc" ]],
        "columnDefs": [{

        }
        ],
        "buttons": [
            {
                extend: 'nuevo',
                text: '<button class="btn-success ocultar" id="botonVerde">Nuevo  <i class="fa-solid fa-plus"></i></button>',
            },
            {
                extend: 'qr',
                text: '<button class="btn-dark"  data-toggle="modal" id="btnQRNuevo">Imprimir Etiquetas  <i class="fa-solid fa-qrcode"></i></button>',
            },

            {
                extend: 'pdfHtml5',
                text: '<button class="btn-danger">Exportar a PDF <i class="far fa-file-pdf"></i></button>',
                download: 'open',
                //className: '',
                //messageTop: ' ',
                title:'Listado Efectos Regulados',
                orientation: 'landscape',
                pageSize: 'A4',
                exportOptions: {
                    columns: [ 0, 1, 2,3, 14,16,17 ],
                    //  columns: ':visible',
                    search: 'applied',
                    order: 'applied'
                },
                customize:function(doc) {

                    doc.content.splice(0,1);
                    var now = new Date();
                    var jsDate = now.getDate()+'-'+(now.getMonth()+1)+'-'+now.getFullYear();
                    doc.pageMargins = [20,60,20,40];
                    doc.defaultStyle.fontSize = 9;
                    doc.styles.tableHeader.fontSize = 10;

                    doc['header']=(function() {
                        return {
                            columns: [
                                {
                                    //image: logo,
                                    //width: 24
                                },
                                {
                                    alignment: 'left',
                                    italics: true,
                                    text: 'Listado de Efectos Regulados',
                                    fontSize: 18,
                                    margin: [10,0]
                                },
                                {
                                    /*  alignment: 'right',
                                      fontSize: 14,
                                      text: 'Custom PDF export with dataTables'
                                  */
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


    var fila; //capturar la fila para editar o borrar el registro

    //botón EDITAR    
    $(document).on("click", ".btnConfeccionar", function () {
        fila = $(this).closest("tr");
        id = parseInt(fila.find('td:eq(0)').text());
        // lugar = fila.find('td:eq(1)').text();
        // salida = fila.find('td:eq(2)').text();
        // entrada = fila.find('td:eq(3)').text();
        // destino = fila.find('td:eq(4)').text();
        // vehiculo = parseInt(fila.find('td:eq(5)').text());
        // conductor = fila.find('td:eq(6)').text();
        // kmsalida = parseInt(fila.find('td:eq(7)').text());
        // kmentrada = parseInt(fila.find('td:eq(8)').text());
        // obs = fila.find('td:eq(9)').text();

        // $("#lugar").val(lugar);
        // $("#salida").val(salida);
        // $("#entrada").val(entrada);
        // $("#destino").val(destino);
        // $("#vehiculo").val(vehiculo);
        // $("#conductor").val(conductor);
        // $("#kmsalida").val(kmsalida);
        // $("#kmentrada").val(kmentrada);
        // $("#obs").val(obs);

       // opcion = 2; //editar

        // $(".modal-header").css("background-color", "#4e73df");
        // $(".modal-header").css("color", "white");
        // $(".modal-title").text("Editar Movimiento");
        // $("#modalCRUD").modal("show");

    });

    //botón BORRAR
    $(document).on("click", ".btnBorrar", function () {
        fila = $(this);
        id = parseInt($(this).closest("tr").find('td:eq(0)').text());
        opcion = 3 //borrar
        var respuesta = confirm("¿Está seguro de eliminar el registro: " + id + "?");
        if (respuesta) {
            $.ajax({
                url: "bd/crud.php",
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
            url: "bd/crud.php",
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
                else { tablaPersonas.row(fila).data([id, lugar, salida, entrada, destino, vehiculo, conductor, kmSalida, kmEntrada, obs]).draw(); }
            }
        });
        $("#modalCRUD").modal("hide");
    });
});