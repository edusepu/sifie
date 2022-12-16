<?php
    $id=$_GET['id'];
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Detalle PC</title>
  <link rel="shortcut icon" href="../imagenes/icono.ico">
  <meta name="description" content="">
  <meta name="author" content="LayoutIt!">

  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">

</head>
<style>
  .modal-dialog {
    max-width: 1200px;
    margin: 30px auto;
  }
</style>


<body style="background-image: url('../imagenes/fondo.jpg');">

  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="row">
          <div class="center">
            <img src="planos/PB/mapa.png" usemap="#image-map0" class="map0">

            <map name="image-map0">
              <area class="area btn1" id="area1" target="" alt="" title="" href="#" coords="153,71,551,251"
                shape="rect">
              <area class="area btn2" id="area2" target="" alt="" title="" href="#" coords="553,71,951,254"
                shape="rect">
              <area class="area btn3" id="area3" target="" alt="" title="" href="#" coords="418,252,684,504"
                shape="rect">
              <area class="area btn4" id="area4" target="" alt="" title="" href="#" coords="435,652,166,474"
                shape="rect">
              <area class="area btn5" id="area5" target="" alt="" title="" href="#" coords="437,506,692,652"
                shape="rect">
              <area class="area btn6" id="area6" target="" alt="REFERENCIAS" title="REFERENCIAS" href="#"
                coords="694,293,957,593" shape="rect">
            </map>
          </div>

        </div>
      </div>
    </div>
  </div>


  <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="false">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
              aria-hidden="false">&times;</span>
          </button>
        </div>
        <form id="form1">
          <div class="modal-body">
            <div class="center">
              <img src="planos/PB/1.png" usemap="#image-map" class="map">

              <map name="image-map">

                  <?php
                  $fila[0] = array("32","44,52,189,51,189,210,42,208", "poly");
                  $fila[1] = array("33","41,214,189,254", "rect");
                  $fila[2] = array("34","42,260,233,367", "rect");
                  $fila[3] = array("35","236,256,409,366", "rect");
                  $fila[4] = array("36","411,256,527,368", "rect");
                  $fila[5] = array("37","531,256,584,364", "rect");
                  $fila[6] = array("38","587,255,698,366", "rect");
                  $fila[7] = array("39","701,255,778,322", "rect");
                  $fila[8] = array("40","781,255,850,323", "rect");
                  $fila[9] = array("30","586,149,531,53", "rect");
                  $fila[10] = array("29","589,55,637,202", "rect");
                  $fila[11] = array("28","640,54,701,201", "rect");
                  $fila[12] = array("27","704,76,800,201", "rect");
                  $fila[13] = array("26","802,77,898,159", "rect");
                  $fila[14] = array("24","951,77,1000,163", "rect");
                  $fila[15] = array("31","192,52,527,52,528,149,581,150,582,246,193,253", "poly");

                  $count = count($fila);



                  for ($i = 0; $i < $count; $i++) {
echo "<area style='background-color: rgb(153,102,153);' alt=".$fila[$i][0]." title=".$fila[$i][0]." href='bd/ubicar.php?local=".$fila[$i][0]."&id=".$id."' coords='".$fila[$i][1]."' shape='".$fila[$i][2]."'>";
                  }
                  ?>
               <!-- <area selected target="" alt="32" title="32" href="bd/ubicar.php?local=32&id=<?php echo $id; ?>" coords="44,52,189,51,189,210,42,208" shape="poly">
                <area target="" alt="33" title="33" href="bd/ubicar.php?local=33&id=<?php echo $id; ?>" coords="41,214,189,254" shape="rect">
                <area target="" alt="34" title="34" href="bd/ubicar.php?local=34&id=<?php echo $id; ?>" coords="42,260,233,367" shape="rect">
                <area target="" alt="35" title="35" href="bd/ubicar.php?local=35&id=<?php echo $id; ?>" coords="236,256,409,366" shape="rect">
                <area target="" alt="36" title="36" href="bd/ubicar.php?local=36&id=<?php echo $id; ?>" coords="411,256,527,368" shape="rect">
                <area target="" alt="37" title="37" href="bd/ubicar.php?local=37&id=<?php echo $id; ?>" coords="531,256,584,364" shape="rect">
                <area target="" alt="38" title="38" href="bd/ubicar.php?local=38&id=<?php echo $id; ?>" coords="587,255,698,366" shape="rect">
                <area target="" alt="39" title="39" href="bd/ubicar.php?local=39&id=<?php echo $id; ?>" coords="701,255,778,322" shape="rect">
                <area target="" alt="40" title="40" href="bd/ubicar.php?local=40&id=<?php echo $id; ?>" coords="781,255,850,323" shape="rect">
                <area target="" alt="30" title="30" href="bd/ubicar.php?local=30&id=<?php echo $id; ?>" coords="586,149,531,53" shape="rect">
                <area target="" alt="29" title="29" href="bd/ubicar.php?local=29&id=<?php echo $id; ?>" coords="589,55,637,202" shape="rect">
                <area target="" alt="28" title="28" href="bd/ubicar.php?local=28&id=<?php echo $id; ?>" coords="640,54,701,201" shape="rect">
                <area target="" alt="27" title="27" href="bd/ubicar.php?local=27&id=<?php echo $id; ?>" coords="704,76,800,201" shape="rect">
                <area target="" alt="26" title="26" href="bd/ubicar.php?local=26&id=<?php echo $id; ?>" coords="802,77,898,159" shape="rect">
                <area target="" alt="24" title="24" href="bd/ubicar.php?local=24&id=<?php echo $id; ?>" coords="951,77,1000,163" shape="rect">
                <area target="" alt="31" title="31" href="bd/ubicar.php?local=31&id=<?php echo $id; ?>" coords="192,52,527,52,528,149,581,150,582,246,193,253" shape="poly">-->
              </map>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
          </div>
        </form>
      </div>
    </div>
  </div>


  <div class="modal fade" id="modal4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
              aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="form4">
          <div class="modal-body">
            <div class="center">
              <img src="planos/PB/4.png" usemap="#image-map" class="map">

              <map name="image-map">
                <area class="area" target="" alt="" title="" href="#" coords="153,71,551,251" shape="rect">
                <area class="area" target="" alt="" title="" href="google.com" coords="153,71,551,251" shape="rect">
                <area class="area" target="" alt="" title="" href="google.com" coords="553,71,951,254" shape="rect">
                <area target="" alt="" title="" href="google.com" coords="418,252,684,504" shape="rect">
                <area target="" alt="" title="" href="google.com" coords="435,652,166,474" shape="rect">
                <area target="" alt="" title="" href="google.comb" coords="437,506,692,652" shape="rect">
                <area target="" alt="REFERENCIAS" title="REFERENCIAS" href="google.com" coords="694,293,957,593"
                  shape="rect">
              </map>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modal5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
              aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="form5">
          <div class="modal-body">
            <div class="center">
              <img src="planos/PB/5.png" usemap="#image-map" class="map">

              <map name="image-map">
                <area class="area" target="" alt="" title="" href="#" coords="153,71,551,251" shape="rect">
                <area class="area" target="" alt="" title="" href="google.com" coords="153,71,551,251" shape="rect">
                <area class="area" target="" alt="" title="" href="google.com" coords="553,71,951,254" shape="rect">
                <area target="" alt="" title="" href="google.com" coords="418,252,684,504" shape="rect">
                <area target="" alt="" title="" href="google.com" coords="435,652,166,474" shape="rect">
                <area target="" alt="" title="" href="google.comb" coords="437,506,692,652" shape="rect">
                <area target="" alt="REFERENCIAS" title="REFERENCIAS" href="google.com" coords="694,293,957,593"
                  shape="rect">
              </map>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
          </div>
        </form>
      </div>
    </div>
  </div>


  <div class="modal fade" id="modal6" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
              aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="form6">
          <div class="modal-body">
            <div class="center">
              <img src="planos/PB/6.png" usemap="#image-map" class="map">

              <map name="image-map">
                <area class="area" target="" alt="" title="" href="#" coords="153,71,551,251" shape="rect">
                <area class="area" target="" alt="" title="" href="google.com" coords="153,71,551,251" shape="rect">
                <area class="area" target="" alt="" title="" href="google.com" coords="553,71,951,254" shape="rect">
                <area target="" alt="" title="" href="google.com" coords="418,252,684,504" shape="rect">
                <area target="" alt="" title="" href="google.com" coords="435,652,166,474" shape="rect">
                <area target="" alt="" title="" href="google.comb" coords="437,506,692,652" shape="rect">
                <area target="" alt="REFERENCIAS" title="REFERENCIAS" href="google.com" coords="694,293,957,593"
                  shape="rect">
              </map>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
              aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="form2">
          <div class="modal-body">
            <div class="center">
              <img src="planos/PB/2.png" usemap="#image-map2" class="map2">

              <map name="image-map2">
                <area class="area" target="" alt="" title="" href="#" coords="153,71,551,251" shape="rect">
                <area class="area" target="" alt="" title="" href="google.com" coords="153,71,551,251" shape="rect">
                <area class="area" target="" alt="" title="" href="google.com" coords="553,71,951,254" shape="rect">
                <area target="" alt="38" title="38" href="38" coords="587,255,698,366" shape="rect">
                <area target="" alt="39" title="39" href="39" coords="701,255,778,322" shape="rect">
                <area target="" alt="40" title="40" href="40" coords="781,255,850,323" shape="rect">
                <area target="" alt="30" title="30" href="30" coords="586,149,531,53" shape="rect">
                <area target="" alt="29" title="29" href="29" coords="589,55,637,202" shape="rect">
              
              </map>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
          </div>
        </form>
      </div>
    </div>
  </div>


  <div class="modal fade" id="modal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
              aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="form3">
          <div class="modal-body">
            <div class="center">
              <img src="planos/PB/3.png" usemap="#image-map" class="map">

              <map name="image-map">
                <area class="area" target="" alt="" title="" href="#" coords="153,71,551,251" shape="rect">
                <area class="area" target="" alt="" title="" href="google.com" coords="153,71,551,251" shape="rect">
                <area class="area" target="" alt="" title="" href="google.com" coords="553,71,951,254" shape="rect">
                <area target="" alt="" title="" href="google.com" coords="418,252,684,504" shape="rect">
                <area target="" alt="" title="" href="google.com" coords="435,652,166,474" shape="rect">
                <area target="" alt="" title="" href="google.comb" coords="437,506,692,652" shape="rect">
                <area target="" alt="REFERENCIAS" title="REFERENCIAS" href="google.com" coords="694,293,957,593"
                  shape="rect">
              </map>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
          </div>
        </form>
      </div>
    </div>
  </div>


  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/scripts.js"></script>
  <script type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/maphilight/1.4.0/jquery.maphilight.min.js"></script>

  <script type="text/javascript">
    $(function () {
      $('.map0').maphilight();
    });
    $(function () {
      $('.mape').maphilight();
    });
    $(function () {
      $('.map2').maphilight();
    });

    $(document).on("click", ".btn1", function (event) {
      setTimeout(function () {
        $('.modal img').maphilight();
      }, 300);
      var sizeqr = "300";
      fila = $(this).closest("tr");
      id = parseInt(fila.find('td:eq(0)').text());
      var textqr = "10.24.39.215/efectos/efectos/detalle.php?id=" + id;
      parametros = { "textqr": textqr, "sizeqr": sizeqr };
      /*$.ajax({
          type: "POST",
          url: "qr.php",
          data: parametros,
          success: function(datos){
              $(".result").html(datos);
          }

      })*/
      //alert(sizeqr);
      event.preventDefault();
      $(".modal-title").text("Elija Ubicación para el EFECTO");
      $(".modal-header").css("background-color", "#4e73df");
      $(".modal-header").css("color", "white");
      $("#modal1").modal("show");
    });

    $(document).on("click", ".btn2", function (event) {
      setTimeout(function () {
        $('.modal img').maphilight();
      }, 300);
      var sizeqr = "300";
      fila = $(this).closest("tr");
      id = parseInt(fila.find('td:eq(0)').text());
      var textqr = "10.24.39.215/efectos/efectos/detalle.php?id=" + id;
      parametros = { "textqr": textqr, "sizeqr": sizeqr };
      /*$.ajax({
          type: "POST",
          url: "qr.php",
          data: parametros,
          success: function(datos){
              $(".result").html(datos);
          }

      })*/
      //alert(sizeqr);
      event.preventDefault();
      $(".modal-title").text("Elija Ubicación para el EFECTO");
      $(".modal-header").css("background-color", "#4e73df");
      $(".modal-header").css("color", "white");
      $("#modal2").modal("show");
    });

    $(document).on("click", ".btn3", function (event) {
      var sizeqr = "300";
      fila = $(this).closest("tr");
      id = parseInt(fila.find('td:eq(0)').text());
      var textqr = "10.24.39.215/efectos/efectos/detalle.php?id=" + id;
      parametros = { "textqr": textqr, "sizeqr": sizeqr };
      /*$.ajax({
          type: "POST",
          url: "qr.php",
          data: parametros,
          success: function(datos){
              $(".result").html(datos);
          }

      })*/
      //alert(sizeqr);
      event.preventDefault();
      $(".modal-title").text("Elija Ubicación para el EFECTO");
      $(".modal-header").css("background-color", "#4e73df");
      $(".modal-header").css("color", "white");
      $("#modal3").modal("show");
    });

    $(document).on("click", ".btn4", function (event) {
      var sizeqr = "300";
      fila = $(this).closest("tr");
      id = parseInt(fila.find('td:eq(0)').text());
      var textqr = "10.24.39.215/efectos/efectos/detalle.php?id=" + id;
      parametros = { "textqr": textqr, "sizeqr": sizeqr };
      /*$.ajax({
          type: "POST",
          url: "qr.php",
          data: parametros,
          success: function(datos){
              $(".result").html(datos);
          }

      })*/
      //alert(sizeqr);
      event.preventDefault();
      $(".modal-title").text("Elija Ubicación para el EFECTO");
      $(".modal-header").css("background-color", "#4e73df");
      $(".modal-header").css("color", "white");
      $("#modal4").modal("show");
    });

    $(document).on("click", ".btn5", function (event) {
      var sizeqr = "300";
      fila = $(this).closest("tr");
      id = parseInt(fila.find('td:eq(0)').text());
      var textqr = "10.24.39.215/efectos/efectos/detalle.php?id=" + id;
      parametros = { "textqr": textqr, "sizeqr": sizeqr };
      /*$.ajax({
          type: "POST",
          url: "qr.php",
          data: parametros,
          success: function(datos){
              $(".result").html(datos);
          }

      })*/
      //alert(sizeqr);
      event.preventDefault();
      $(".modal-title").text("Elija Ubicación para el EFECTO");
      $(".modal-header").css("background-color", "#4e73df");
      $(".modal-header").css("color", "white");
      $("#modal5").modal("show");
    });

    $(document).on("click", ".btn6", function (event) {
      var sizeqr = "300";
      fila = $(this).closest("tr");
      id = parseInt(fila.find('td:eq(0)').text());
      var textqr = "10.24.39.215/efectos/efectos/detalle.php?id=" + id;
      parametros = { "textqr": textqr, "sizeqr": sizeqr };
      /*$.ajax({
          type: "POST",
          url: "qr.php",
          data: parametros,
          success: function(datos){
              $(".result").html(datos);
          }

      })*/
      //alert(sizeqr);
      event.preventDefault();
      $(".modal-title").text("Elija Ubicación para el EFECTO");
      $(".modal-header").css("background-color", "#4e73df");
      $(".modal-header").css("color", "white");
      $("#modal6").modal("show");
    });


  </script>
</body>

</html>

<!-- Image Map Generated by http://www.image-map.net/ -->