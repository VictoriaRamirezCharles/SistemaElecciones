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
                Usuario
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{$this->directory}index.php">Cerrar Sesion</a>
                
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