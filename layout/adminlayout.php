<?php

class AdminLayout
{
  private $isRoot;
  private $directory;

  function __construct($page)
  {
    $this->isRoot = $page;
    $this->directory = ($this->isRoot) ? "../": "";
  }
public function printHeader2 ()
{
  $admin = <<<EOF

  <!DOCTYPE html>
  <html lang="en">
  
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href={$this->directory}assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="{$this->directory}assets/img/favicon.png">
    <title>
      Sistema de Elecciones
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="{$this->directory}assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="{$this->directory}assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="{$this->directory}assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="{$this->directory}assets/css/soft-ui-dashboard.css?v=1.0.1" rel="stylesheet" />
    <style>
    .navbar-vertical .navbar-nav>.nav-item .nav-link.active .icon {
      background-image: linear-gradient(
      310deg, #167a63 0%, #167a63 100%);
      }
    </style>
    </head>
  
  <body class="g-sidenav-show  bg-gray-100">
    <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-left ms-3" id="sidenav-main">
      <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute right-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="#">
       
          <span class="ms-1 font-weight-bold"><h4>Administrador<h4></span>
        </a>
      </div>
      <hr class="horizontal dark mt-0">
      <div class="collapse navbar-collapse  w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link  active" href="{$this->directory}usuario/index.php">
              <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
          
              </div>
              <span class="nav-link-text ms-1">Usuarios</span>
            </a>
          </li>
          <li class="nav-item mt-3">
           
          </li>
          <li class="nav-item">
            <a class="nav-link active " href="{$this->directory}candidatos/index.php">
              <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
      
              </div>
              <span class="nav-link-text ms-1">Candidatos</span>
            </a>
          </li>
          <li class="nav-item mt-3">
           
          </li>
          <li class="nav-item">
            <a class="nav-link active  " href="{$this->directory}ciudadanos/index.php">
              <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
          
              </div>
              <span class="nav-link-text ms-1">Ciudadanos</span>
            </a>
          </li>
          <li class="nav-item mt-3">
           
          </li>
          <li class="nav-item">
            <a class="nav-link active "  href="{$this->directory}partidos/index.php">
              <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
          
              </div>
              <span class="nav-link-text ms-1">Partidos</span>
            </a>
          </li>
          <li class="nav-item mt-3">
           
          </li>
          <li class="nav-item">
            <a class="nav-link active "  href="{$this->directory}elecciones/index.php">
              <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                
              </div>
              <span class="nav-link-text ms-1">Elecciones</span>
            </a>
          </li>
          <li class="nav-item mt-3">
           
          </li>
          <li class="nav-item">
            <a class="nav-link active "  href="{$this->directory}puesto_electivo/index.php">
              <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
 
              </div>
              <span class="nav-link-text ms-1">Puestos Electivos</span>
            </a>
          </li>
          
        </ul>
      </div>
     
    </aside>
    <main class="main-content mt-1 border-radius-lg">
      <!-- Navbar -->
      <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
        <div class="container-fluid py-1 px-3">
          <nav aria-label="breadcrumb">
            
            <h6 class="font-weight-bolder mb-0">Mantenimientos</h6>
          </nav>
          <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
              <div class="input-group">
      
              </div>
            </div>
            <ul class="navbar-nav  justify-content-end">
            
              <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                  <div class="sidenav-toggler-inner">
                    <i class="sidenav-toggler-line"></i>
                    <i class="sidenav-toggler-line"></i>
                    <i class="sidenav-toggler-line"></i>
                  </div>
                </a>
              </li>
           
              <li class="nav-item dropdown pe-2 d-flex align-items-center">
                <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-user me-sm-1"></i>
                </a>
                <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                
              Administrador
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="{$this->directory}usuario/logout.php">Cerrar Sesion</a>
                
              </div>
            </li>
              </li>
            </ul>
          </div>
        </div>
      </nav>

    


  EOF;
  echo $admin;
}

public function printFooter2()
{
  $footer = <<<EOF
  <!--   Core JS Files   -->
  <script src="{$this->directory}assets/js/core/popper.min.js"></script>
  <script src="{$this->directory}assets/js/core/bootstrap.min.js"></script>
  <script src="{$this->directory}assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="{$this->directory}assets/js/soft-ui-dashboard.min.js?v=1.0.1"></script>
  <script src="{$this->directory}assets/js/plugins/chartjs.min.js"></script>
  <script src="{$this->directory}assets/js/plugins/Chart.extension.js"></script>
  <script src="{$this->directory}assets/js/jquery/jquery-3.5.1.min.js"></script>
  <script src="{$this->directory}assets/js/bootstrap.bundle.min.js"></script>
  <script src="{$this->directory}assets/js/bootstrap.min.js"></script>
  <script src="{$this->directory}assets/js/sweetalert.min.js"></script>

  
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>
EOF;
  echo $footer;

}

  public function printHeader()
  {
    $admin = <<<EOF
    <!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Administrador</title>
  <link href="{$this->directory}assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="{$this->directory}assets/css/simple-sidebar.css" rel="stylesheet">
  <link href="{$this->directory}assets/css/font-awesome/css/font-awesome.css" rel="stylesheet">


</head>

<body>

  <div class="d-flex" id="wrapper">


    <div class="bg-light border-right" id="sidebar-wrapper">
 
      <a href="{$this->directory}administrador.php" class="navbar-brand sidebar-heading text-dark">Administrador</a>
      <div class="list-group list-group-flush">
        <a href="{$this->directory}usuario/index.php" class="list-group-item list-group-item-action bg-light">Usuarios</a>
        <a href="{$this->directory}candidatos/index.php" class="list-group-item list-group-item-action bg-light">Candidatos</a>
        <a href="{$this->directory}puesto_electivo/index.php" class="list-group-item list-group-item-action bg-light">Puesto Electivo</a>
        <a href="{$this->directory}elecciones/index.php" class="list-group-item list-group-item-action bg-light">Elecciones</a>
        <a href="{$this->directory}ciudadanos/index.php" class="list-group-item list-group-item-action bg-light">Ciudadanos</a>
        <a href="{$this->directory}partidos/index.php" class="list-group-item list-group-item-action bg-light">Partidos</a>

      </div>
    </div>
 
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <button class="btn btn-primary menu-bar" id="menu-toggle"><i class="fa fa-bars"></i></button>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
      
          
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Administrador
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{$this->directory}usuario/logout.php">Cerrar Sesion</a>
                
              </div>
            </li>
          </ul>
        </div>
      </nav>

   


  
EOF;
echo $admin;
}
public function printFooter()
{
  $footer = <<<EOF
  </div>

  <script src="{$this->directory}assets/js/jquery/jquery-3.5.1.min.js"></script>
  <script src="{$this->directory}assets/js/bootstrap.bundle.min.js"></script>
  <script src="{$this->directory}assets/js/bootstrap.min.js"></script>
  <script src="{$this->directory}assets/js/sweetalert.min.js"></script>

  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
  </script>

</body>

</html>
EOF;
  echo $footer;
}
} 

?>