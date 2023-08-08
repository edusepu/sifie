$(document).ready(function () {

    $.fn.dataTable.ext.buttons.nuevo = {
        className: 'dt-button buttons-pdf buttons-html5',

        action: function (e, dt, node, config) {
            //alert( this.text() );
            $("#formPersonas").trigger("reset");
            $(".modal-header").css("background-color", "#1cc88a");
            $(".modal-header").css("color", "white");
            $(".modal-title").text("Nuevo Efecto");
            $("#modalCRUD").modal("show");
            id = null;
            opcion = 1; //alta
        }
    };
    $.fn.dataTable.ext.buttons.qr = {
        className: 'dt-button buttons-pdf buttons-html5',

        action: function (e, dt, node, config) {
            $("#formQR").trigger("reset");
            $(".modal-header").css("background-color", "#1cc88a");
            $(".modal-header").css("color", "white");
            $(".modal-title").text("Imprimir Obleas QR");
            $("#modalQR").modal("show");
        }
    };
    tablaPersonas = $("#tablaPersonas").DataTable(
        {

            "order": [[0, "desc"]],


            "dom": '<"dt-buttons"Bf><"clear">lirtp',
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
                    title: 'Listado Monitores',
                    orientation: 'landscape',
                    pageSize: 'A4',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 5],
                        //  columns: ':visible',
                        search: 'applied',
                        order: 'applied'
                    },
                    customize: function (doc) {

                        doc.content.splice(0, 1);
                        var now = new Date();
                        var jsDate = now.getDate() + '-' + (now.getMonth() + 1) + '-' + now.getFullYear();
                        doc.pageMargins = [20, 60, 20, 40];
                        doc.defaultStyle.fontSize = 9;
                        doc.styles.tableHeader.fontSize = 10;

                        doc['header'] = (function () {
                            return {
                                columns: [
                                    {
                                        //image: logo,
                                        //width: 24
                                    },
                                    {
                                        alignment: 'left',
                                        italics: true,
                                        text: 'Listado de Monitores',
                                        fontSize: 18,
                                        margin: [10, 0]
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

                        doc['footer'] = (function (page, pages) {
                            return {
                                columns: [
                                    {
                                        //  alignment: 'left',
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

    $("#btnQR").click(function () {
        $("#formQR").trigger("reset");
        $(".modal-header").css("background-color", "#1cc88a");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Imprimir Obleas QR");
        $("#modalQR").modal("show");
    });


    var fila; //capturar la fila para editar o borrar el registro

    //botón EDITAR    
    $(document).on("click", ".btnEditar", function () {
        fila = $(this).closest("tr");
        id = parseInt(fila.find('td:eq(0)').text());
        marca = fila.find('td:eq(1)').text();
        modelo = fila.find('td:eq(2)').text();
        tamanio = fila.find('td:eq(3)').text();
        origen = parseInt(fila.find('td:eq(4)').text());
        origenNombre = (fila.find('td:eq(5)').text());
        // ubicacion = (fila.find('td:eq(6)').text());
        // dptoNombre = (fila.find('td:eq(7)').text());
        // marca = (fila.find('td:eq(8)').text());
        // modelo = (fila.find('td:eq(9)').text());

        $("#marca").val(marca);
        $("#modelo").val(modelo);
        $("#tamanio").val(tamanio);
        $("#origen").val(origen);
        $("#origenNombre").val(origenNombre);
        // $("#marca").val(marca);
        // $("#modelo").val(modelo);
        // $("#observacion").val(observacion);

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
                url: "bd/crudmonitores.php",
                type: "POST",
                dataType: "json",
                data: {opcion: opcion, id: id},
                success: function () {
                    tablaPersonas.row(fila.parents('tr')).remove().draw();
                }
            });
        }
    });
    //botón BUSQUEDA
  //  $(document).on("click", "#btnBuscar", function (e) {
        $("#btnBuscar").click(function () {
       // e.preventDefault();
alert("///");
        fila = $(this);
        id = 5;//parseInt($(this).closest("tr").find('td:eq(0)').text());
        opcion = 4 //buscar
            $.ajax({
                url: "bd/crudmonitores.php",
                type: "POST",
                dataType: "json",
                data: {opcion: opcion, id: id},
                success: function () {
                   // tablaPersonas.row(fila.parents('tr')).remove().draw();
                    $("#monitorNombre").val(id);
                }
            });

    });

    $("#formPersonas").submit(function (e) {
//        alert("anda");
        e.preventDefault();
        marca = $.trim($("#marca").val());
        modelo = $.trim($("#modelo").val());
        tamanio = $.trim($("#tamanio").val());
        origen = $.trim($("#origen").val());
        // ubicacion = $.trim($("#ubicacion").val());
        // marca = $.trim($("#marca").val());
        // modelo = $.trim($("#modelo").val());
        // observacion = $.trim($("#observacion").val());

        $.ajax({
            url: "bd/crudmonitores.php",
            type: "POST",
            dataType: "json",
            data: {
                marca: marca,
                modelo: modelo,
                tamanio: tamanio,
                origen: origen,
               // origenNombre: origenNombre,
                // ubicacion: ubicacion,
                // marca: marca,
                // modelo: modelo,
                // observacion: observacion,
                id: id,
                opcion: opcion
            },
            success: function (data) {
                //console.log(data);
                id = data[0].id;
                marca = data[0].marca;
                modelo = data[0].modelo;
                tamanio = data[0].tamanio;
                origen = data[0].origen;
                origenNombre = data[0].origenNombre;
                // observaciones = data[0].observaciones;
                // ubicacion = data[0].ubicacion;
                // dptoNombre = data[0].dptoNombre;
                // marca = data[0].marca;
                // modelo = data[0].modelo;

                acciones = "<div class='text-center'><div class='btn-group'><button class='btn btn-dark btnQR' style=''>QR</button><button class='btn btn-primary btnEditar'>Editar</button><button class='btn btn-danger btnBorrar'>Borrar</button> </div></div>";
                if (opcion == 1) {
                    tablaPersonas.order([0, 'desc']).draw();
                        tablaPersonas.row.add([id, marca, modelo, tamanio, origen, origenNombre, acciones]).draw();
                    $('#tablaPersonas tbody td').eq(4).addClass('oculto');
                } else {
                    tablaPersonas.row(fila).data([id, marca, modelo, tamanio, origen, origenNombre, acciones]).draw();

                  }
            }
        });
        $("#modalCRUD").modal("hide");

    });


    $(document).on("click", ".btnQR", function (event) {
        var sizeqr = "300";
        fila = $(this).closest("tr");
        id = parseInt(fila.find('td:eq(0)').text());
        origen = parseInt(fila.find('td:eq(4)').text());
        //var textqr = "sifie/efectos/efectos/detalle2.php?id=" + id;
        //parametros = {"textqr": textqr, "sizeqr": sizeqr};
        window.open("generarqrm.php?id="+id+"&cual="+origen, '_blank');
        event.preventDefault();
    });

    $(document).on("click", ".btnUbicacion", function (event) {
        fila = $(this).closest("tr");
        //var idurl =parseInt(fila.find('td:eq(0)').text());
        id = parseInt($(this).closest("tr").find('td:eq(0)').text());
        window.open("mapa.php?id=" + idurl, '_self');
        event.preventDefault();

    });

});