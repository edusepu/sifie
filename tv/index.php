<?php
session_start();
//var_dump($_SESSION);
if (isset($_SESSION['rolTV'])) {
    if ($_SESSION["rolTV"] === 1) {
        echo "    <a href='listado.php' class='btn btn-primary'>Cargar imagenes</a>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Página TV's</title>
   <?php header("Set-Cookie: cross-site-cookie=whatever; SameSite=None; Secure");?>
    <meta http-equiv="refresh" content="1800">


</head>
<body>
<script src="http://code.jquery.com/jquery.js"> </script>



<div name="banner">
    <img src="./info/banner.jpg" width=100% height=15%  align="middle"/>

</div>
<!-- Compiled and minified Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
<!-- Minified JS library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>

<!-- Carousel wrapper -->







<!-- Carousel wrapper -->
<div id="myCarousel2" class="carousel slide carousel-fade" data-ride="carousel" data-interval="false">
    <?php
    $liArray2=array();
    $divArray2=array();
    $divVideos2=array();
    $cont2='0';
    $folder_path = './imagenes/';
    $num_files = glob($folder_path . "*.{JPG,jpg,jpeg,gif,png,bmp}", GLOB_BRACE);
    $num_videos =  glob($folder_path . "*.{mp4}", GLOB_BRACE);
    $folder = opendir($folder_path);
    if( !empty($num_files)){
        foreach($num_files as $num){
            if( $cont2 == '0' ){
                //echo "El valor de cont es cero";
                array_push($liArray2, " <li data-target='#myCarousel2' class='active'></li>");
                array_push($divArray2, " <div class='carousel-inner'> ");
                array_push($divArray2, " <div class='active item c2' align='center' id='".$cont2."'><img src='$num' alt='banner1' 
				width=80% height=65%  align='middle' /></div>");
            }else{
                array_push($liArray2, " <li data-target='#myCarousel2'></li>");
                $ban=$cont2+1;
                array_push($divArray2, " <div class='item c2' align='center'  id='".$cont2."'>
 
 <img  src='$num' alt='banner$ban' 
				width=80% height=65%  align='middle' /></div>");
            }
            //}
            $cont2++;
        }
    }
    echo "<!-- Inicia carga de imagenes -->\n";
    foreach($divArray2 as $div2){
        echo $div2."\n";
    }
    echo "</div><!-- Fin carga de Imagenes -->\n";
    ?>
</div>
<!--<div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="false" style="display: none;">-->
<!---->
<!--    --><?php
//    $liArray=array();
//    $divArray=array();
//    $divVideos=array();
//    $cont='100';
//    //	$folder_path = './imgram/';
//    $folder_path = './imagenes/';
//    $num_files = glob($folder_path . "*.{JPG,jpg,jpeg,gif,png,bmp}", GLOB_BRACE);
//    $num_videos =  glob($folder_path . "*.{mp4}", GLOB_BRACE);
//    //var_dump($num_videos);exit;
//    $folder = opendir($folder_path);
//    if( !empty($num_files)){
//        //while(false !== ($file = readdir($folder)))  {
//        foreach($num_files as $num){
//            //$file = readdir($folder);
//            //$file_path = $folder_path.$file;
//            //$extension = strtolower(pathinfo($file ,PATHINFO_EXTENSION));
//            //if($extension=='jpg' || $extension =='png' || $extension == 'gif' || $extension == 'bmp') {
//            // var_dump($cont);exit;
//            if( $cont == '100' ){
//                //echo "El valor de cont es cero";
//                array_push($liArray, " <li data-target='#myCarousel' class='active'></li>");
//                array_push($divArray, " <div class='carousel-inner'> ");
//                array_push($divArray, " <div class='active item c1' align='center' id='".$cont."'><img src='$num' alt='banner1'
//				width=80% height=65%  align='middle' /></div>");
//            }else{
//                array_push($liArray, " <li data-target='#myCarousel'></li>");
//                $ban=$cont+1;
//                array_push($divArray, " <div class='item c1' align='center'  id='".$cont."'>
//
// <img  src='$num' alt='banner$ban'
//				width=80% height=65%  align='middle' /></div>");
//            }
//            //}
//            $cont++;
//        }
//        //echo "<h5>TEST</h5>";
//        //echo "<pre>";
//        //print_r($divArray);
//        //echo "</pre>";
//    }
//    //echo "<h4> Fin TEST </h4>";
//
//    //	foreach($liArray as $li){
//    //	   echo $li."\n";
//    //	}
//    //	echo "</ol>\n";
//    echo "<!-- Inicia carga de imagenes -->\n";
//    foreach($divArray as $div){
//        echo $div."\n";
//    }
//    echo "</div><!-- Fin carga de Imagenes -->\n";
//    //pause:true,
//    if ( !empty($num_videos)){
//        //var_dump($num_videos);exit;
//        $cantVideo=0;
//        foreach($num_videos as $video){
//            //echo $video;
//        }
//        array_push($divVideos, "<div class='item'>");
//        array_push($divVideos, "<video  autoplay loop muted> <source src='".$video."' type='video/mp4' /> </video>");
//        array_push($divVideos, "</div>");
////			echo "<div class='item'>");
////			echo "<video  autoplay loop muted> <source src='$video' type='video/mp4' /> </video>");
////			echo "</div>");
//    }
//    echo "<!-- Inicio de videos --> \n";
//
//    foreach($divVideos as $videos){
//        echo $videos."\n";
//    }
//    echo "<!-- Fin de Videos -->\n";
//
//    ?>
<!--</div>-->





<script type="text/javascript">
    // Call carousel manually
   /* $('#myCarousel').carousel({
        interval: 3000,
        pause:false,
        wrap:true

    });*/
	
	 
	
    $('#myCarousel2').carousel({
		interval: 10000,
        pause:false,
        wrap:true

    });
	
	


    $('#myCarousel2').on('slide.bs.carousel', function () {
        // do something…
        var elementos = document.getElementsByClassName("active item c2");
        var actual = 0;
        //actual=elementos[0].getAttribute("id");
        actual=parseFloat(elementos[0].getAttribute("id"))+1;
        var contador = document.getElementsByClassName("c2").length;
        console.log("cantidad de imagenes carrousel 2: "+contador);
        console.log("id actual carrousel 2: "+actual);
        if(contador==actual){
            console.log("////////////////////////////////////");
            var x = document.getElementById("myCarousel2");
            var y = document.getElementById("myCarousel");

            /*if (x.style.display === "none") {
                x.style.display = "block";
                y.style.display = "none";
            } else {
                x.style.display = "none";
                y.style.display = "block";

            }*/
        }
    })

</script>

</body>
</html>
