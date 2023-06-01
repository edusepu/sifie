<?php
session_start();
if ($_SESSION["s_usuario"] === null) {
    header("Location: ../index.php");
}
?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Sistema de Efectos</title>
    <link rel="shortcut icon" href="../imagenes/icono.ico">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free-6.1.1-web/css/all.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
          rel="stylesheet">


    <!--datables CSS básico-->
    <link rel="stylesheet" type="text/css" href="vendor/datatables/datatables.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!--datables estilo bootstrap 4 CSS-->
    <link rel="stylesheet" type="text/css"
          href="vendor/datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
    <link href="css/sb-admin-2.css" rel="stylesheet">
    <link href="../efectos/css/estilo.css" rel="stylesheet">

</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../efectos/index.php">
            <!--  <div class="sidebar-brand-icon rotate-n-15">-->
            <div>
                <img src="img/logoBlanco.ico" style="background: #E8F0FE; border-radius: 50%; max-height: 50px;">
                <img class="" style=" height: 50px;" src="img/Logo_FIE_hor.png">
            </div>
            <!--<div class="sidebar-brand-text mx-3">Logo_FIE_hor</div>-->
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <?php
        if ($_SESSION["cargos"] == 1) {
            echo "<li class='nav-item active'>";
        } else {
            echo "<li style='display:none' class='nav-item active'>";
        }
        ?>


<!--        <li class="nav-item">-->
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#menuefectos" aria-expanded="true" aria-controls="menuefectos">
                <i class="fas fa-fw fa-cog"></i>
                <span>Efectos Regulados</span>
            </a>
            <div id="menuefectos" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Efectos Regulados</h6>
                    <a class="collapse-item" href="../efectos/efectos.php">
                        <i class="fas fa-fw fa-solid fa-computer"></i>
                        <span>Computadoras</span></a>
                    <a class="collapse-item" href="../efectos/monitores.php">
                        <i class="fas fa-fw fa-solid fa-print"></i>
                        <span>Monitores</span></a>
                    <a class="collapse-item" href="../efectos/efectossindetalle.php">
                        <i class="fas fa-fw fa-solid fa-print"></i>
                        <span>Otros Efectos</span></a>

                </div>
            </div>
        </li>



        <!-- Divider -->
        <hr class="sidebar-divider">
        <?php
        if ($_SESSION["fundacion"] == 1) {
            echo "<li class='nav-item active'>";
        } else {
            echo "<li style='display:none' class='nav-item active'>";
        }
        ?>
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#menufundacion" aria-expanded="true" aria-controls="menufundacion">
            <i class="fas fa-fw fa-cog"></i>
            <span>Efectos Fundación</span>
        </a>
        <div id="menufundacion" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Efectos Fundación</h6>
                <a class="collapse-item" href="efectosFundacion.php">
                    <i class="fas fa-fw fa-solid fa-computer"></i>
                    <span>Computadoras</span></a>
                <a class="collapse-item" href="monitores.php">
                    <i class="fas fa-fw fa-solid fa-print"></i>
                    <span>Monitores</span></a>
                <a class="collapse-item" href="efectosfundacionsindetalle.php">
                    <i class="fas fa-fw fa-solid fa-print"></i>
                    <span>Otros Efectos</span></a>

            </div>
        </div>



        </li>

        <hr class="sidebar-divider">
        <?php
        if ($_SESSION["proyecto"] == 1) {
            echo "<li class='nav-item active'>";
        } else {
            echo "<li style='display:none' class='nav-item active'>";
        }
        ?>


        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#menuproyecto" aria-expanded="true" aria-controls="menuproyecto">
            <i class="fas fa-fw fa-cog"></i>
            <span>Efectos Fundación</span>
        </a>
        <div id="menuproyecto" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Efectos Fundación</h6>
                <a class="collapse-item" href="efectosProyecto.php">
                    <i class="fas fa-fw fa-solid fa-computer"></i>
                    <span>Computadoras</span></a>
                <a class="collapse-item" href="monitores.php">
                    <i class="fas fa-fw fa-solid fa-print"></i>
                    <span>Monitores</span></a>
                <a class="collapse-item" href="efectossindetalle.php">
                    <i class="fas fa-fw fa-solid fa-print"></i>
                    <span>Otros Efectos</span></a>

            </div>
        </div>

        <!-- Heading -->





        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>


                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto no-seleccionable">
                    <div style="width:100%">
                        <img class="" style=" height: 50px;" src="img/banner.png">
                    </div>
                    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                    <li class="nav-item dropdown no-arrow d-sm-none">
                        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-search fa-fw"></i>
                        </a>
                        <!-- Dropdown - Messages -->
                        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                             aria-labelledby="searchDropdown">
                            <form class="form-inline mr-auto w-100 navbar-search">
                                <div class="input-group">
                                    <input type="text" class="form-control bg-light border-0 small"
                                           placeholder="Search for..." aria-label="Search"
                                           aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button">
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </li>

                    <!-- Nav Item - Alerts -->
                    <li class="nav-item dropdown no-arrow mx-1">
                        <!-- <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           <i class="fas fa-bell fa-fw"></i>

                        <span class="badge badge-danger badge-counter">3+</span>
                      </a>-->
                        <!-- Dropdown - Alerts -->
                        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                             aria-labelledby="alertsDropdown">
                            <h6 class="dropdown-header">
                                Alerts Center
                            </h6>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="mr-3">
                                    <div class="icon-circle bg-primary">
                                        <i class="fas fa-file-alt text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="small text-gray-500">December 12, 2019</div>
                                    <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                </div>
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="mr-3">
                                    <div class="icon-circle bg-success">
                                        <i class="fas fa-donate text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="small text-gray-500">December 7, 2019</div>
                                    $290.29 has been deposited into your account!
                                </div>
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="mr-3">
                                    <div class="icon-circle bg-warning">
                                        <i class="fas fa-exclamation-triangle text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="small text-gray-500">December 2, 2019</div>
                                    Spending Alert: We've noticed unusually high spending for your account.
                                </div>
                            </a>
                            <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                        </div>
                    </li>

                    <!-- Nav Item - Messages -->
                    <li class="nav-item dropdown no-arrow mx-1">
                        <!-- <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           <i class="fas fa-envelope fa-fw"></i>
                            Counter - Messages
                        <span class="badge badge-danger badge-counter">7</span>
                      </a>-->
                        <!-- Dropdown - Messages -->
                        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                             aria-labelledby="messagesDropdown">
                            <h6 class="dropdown-header">
                                Message Center
                            </h6>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="dropdown-list-image mr-3">
                                    <img class="rounded-circle" src="https://source.unsplash.com/fn_BT9fwg_E/60x60"
                                         alt="">
                                    <div class="status-indicator bg-success"></div>
                                </div>
                                <div class="font-weight-bold">
                                    <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                        problem I've been having.
                                    </div>
                                    <div class="small text-gray-500">Emily Fowler · 58m</div>
                                </div>
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="dropdown-list-image mr-3">
                                    <img class="rounded-circle" src="https://source.unsplash.com/AU4VPcFN4LE/60x60"
                                         alt="">
                                    <div class="status-indicator"></div>
                                </div>
                                <div>
                                    <div class="text-truncate">I have the photos that you ordered last month, how would
                                        you like them sent to you?
                                    </div>
                                    <div class="small text-gray-500">Jae Chun · 1d</div>
                                </div>
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="dropdown-list-image mr-3">
                                    <img class="rounded-circle" src="https://source.unsplash.com/CS2uCrpNzJY/60x60"
                                         alt="">
                                    <div class="status-indicator bg-warning"></div>
                                </div>
                                <div>
                                    <div class="text-truncate">Last month's report looks great, I am very happy with the
                                        progress so far, keep up the good work!
                                    </div>
                                    <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                                </div>
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="dropdown-list-image mr-3">
                                    <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60"
                                         alt="">
                                    <div class="status-indicator bg-success"></div>
                                </div>
                                <div>
                                    <div class="text-truncate">Am I a good boy? The reason I ask is because someone told
                                        me that people say this to all dogs, even if they aren't good...
                                    </div>
                                    <div class="small text-gray-500">Chicken the Dog · 2w</div>
                                </div>
                            </a>
                            <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                        </div>
                    </li>

                    <div class="topbar-divider d-none d-sm-block"></div>

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION["s_usuario"]; ?></span>
                            <!--                <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">-->
                            <img class="img-profile rounded-circle" src="img/user.png">
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                             aria-labelledby="userDropdown">
                            <!-- <a class="dropdown-item" href="#">
                               <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                               Profile
                             </a>
                             <a class="dropdown-item" href="#">
                               <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                               Settings
                             </a>
                             <a class="dropdown-item" href="#">
                               <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                               Activity Log
                             </a>-->
                            <?php
                            if ($_SESSION["s_rol"] == 1) {
                                echo "<div class='dropdown-divider'></div>";
                                echo "<a class='dropdown-item' href='admin.php'";
                                echo "<i class='fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400'></i>";
                                echo "Administración";
                                echo "</a>";
                            } ?>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Cerrar Sesión
                            </a>
                        </div>
                    </li>

                </ul>

            </nav>
            <!-- End of Topbar -->
