<?php 
    include_once 'perfil.php';
    $usuarioLogado = $_SESSION['nome'];
    $perfil = $_SESSION['perfil'];
?>
<!DOCTYPE html>


<head>

    <!--<meta charset="utf-8">-->
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>TCC</title>   
    
    <script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
    <script src="https://www.amcharts.com/lib/3/serial.js"></script>
    <script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <script src="https://www.amcharts.com/lib/3/themes/dark.js"></script>


    <link rel="stylesheet" type="text/css" href="../css/estilo.css">

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" type="text/css" href="../vendor/bootstrap-3.3.7-dist/css/bootstrap.min.css">

    <!-- MetisMenu CSS -->
    <link rel="stylesheet" type="text/css" href="../vendor/metisMenu/metisMenu.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="../dist/css/sb-admin-2.css">

    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="../vendor/datatables-plugins/dataTables.bootstrap.css">

        <!-- DataTables Responsive CSS -->
    <link rel="stylesheet" type="text/css" href="../vendor/datatables-responsive/dataTables.responsive.css">

    <!-- DatePicker CSS -->
    <link rel="stylesheet" type="text/css" href="../vendor/bootstrap-datepicker-1.6.4/css/bootstrap-datepicker.css">

    <!-- ClockPick -->
    <link rel="stylesheet" type="text/css" href="../vendor/clockpicker-gh-pages/dist/bootstrap-clockpicker.min.css">
    <link rel="stylesheet" type="text/css" href="../vendor/clockpicker-gh-pages/assets/css/github.min.css">

    <!-- Custom Fonts -->
    <link rel="stylesheet" type="text/css" href="../vendor/font-awesome/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="../sweetalert-master/dist/sweetalert.css">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="../pages/index.php">TCC</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <!--MENSAGEM (OCULTA)-->
                <li class="dropdown ocultar">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <a href="#">
                                <div>
                                    <strong><?php echo $usuarioLogado;?></strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <strong><?php echo $usuarioLogado;?></strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <strong><?php echo $usuarioLogado;?></strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>Read All Messages</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-messages -->
                </li>
                <!-- /.dropdown -->
                <!--BARRAS DE PROGRESSO (OCULTAS)-->
                <li class="dropdown ocultar">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-tasks fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-tasks">
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 1</strong>
                                        <span class="pull-right text-muted">40% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                            <span class="sr-only">40% Complete (success)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 2</strong>
                                        <span class="pull-right text-muted">20% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                            <span class="sr-only">20% Complete</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 3</strong>
                                        <span class="pull-right text-muted">60% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                            <span class="sr-only">60% Complete (warning)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 4</strong>
                                        <span class="pull-right text-muted">80% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                            <span class="sr-only">80% Complete (danger)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>See All Tasks</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-tasks -->
                </li>
                <!--ALERTAS (OCULTAS)-->
                <!-- /.dropdown -->
                <li class="dropdown ocultar">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-comment fa-fw"></i> New Comment
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                    <span class="pull-right text-muted small">12 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-envelope fa-fw"></i> Message Sent
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-tasks fa-fw"></i> New Task
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>See All Alerts</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-alerts -->
                </li>
                <!--USUÁRIO (OCULTAS)-->
                <!-- /.dropdown -->
                <li class="dropdown ocultar">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li>
                            <a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="../index.php"><i class="fa fa-sign-out fa-fw"></i> Sair</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <li>
                    Olá <?php echo $_SESSION['nome'];?>
                </li>
                <li>
                    <a href="../index.php"><i class="fa fa-sign-out fa-fw"></i> Sair</a>
                </li>
                <!-- /.dropdown -->
            </ul>

            <!-- /.navbar-top-links -->
            <!--MENU LATERAL-->
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="../pages/index.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <?php
                        switch ($_SESSION['perfil'])
                        {
                            case EPerfil::Secretaria:
                                include_once 'menu-secretaria.php';
                                break;
                            case EPerfil::Professor:
                                include_once 'menu-professor.php';
                                break;
                            case EPerfil::Aluno:
                                include_once 'menu-aluno.php';
                                break;
                        }
                        
                        ?>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
    </div>

        <script type="text/javascript" src="../vendor/jquery/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script type="text/javascript" src="../vendor/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script type="text/javascript" src="../vendor/metisMenu/metisMenu.min.js"></script>

        <script type="text/javascript" src="../sweetalert-master/dist/sweetalert.min.js"></script>

        <!-- Custom Theme JavaScript -->
        <script type="text/javascript" src="../dist/js/sb-admin-2.js"></script>

        <!-- Adicionar arquivos do Jquery -->
        <script type="text/javascript" src="../vendor/jquery/jquery.maskedinput.js"></script>
        <script type="text/javascript" src="../vendor/jquery/ui/1.12.1/jquery-ui.js"></script>
        
        <!-- Adicionar arquivos js do bootstrap -->
        <script type="text/javascript" src="../vendor/bootstrap-datepicker-1.6.4/js/bootstrap-datepicker.js"></script>
        <script type="text/javascript" src="../vendor/bootstrap-datepicker-1.6.4/locales/bootstrap-datepicker.pt-BR.min.js"></script>

        <!-- Plugin ClockPick -->
        <script type="text/javascript" src="../vendor/clockpicker-gh-pages/dist/bootstrap-clockpicker.js"></script>
        <script type="text/javascript" src="../vendor/clockpicker-gh-pages/dist/bootstrap-clockpicker.min.js"></script>
        <script type="text/javascript" src="../vendor/clockpicker-gh-pages/dist/jquery-clockpicker.js"></script>
        <script type="text/javascript" src="../vendor/clockpicker-gh-pages/dist/jquery-clockpicker.min.js"></script>
        <script type="text/javascript" src="../vendor/clockpicker-gh-pages/assets/js/highlight.min.js"></script>
    
    </body>
</html>