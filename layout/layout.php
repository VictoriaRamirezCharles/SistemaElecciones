<?php

class Layout
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
    $header = <<<EOF
      <!DOCTYPE html>
      <html lang="en"><head>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">    
          <title>Gestion Transacciones</title>
          
      <link rel="stylesheet" href="{$this->directory}assets/css/bootstrap.min.css" type="text/css">
      <link rel="stylesheet" href="{$this->directory}assets/css/style.css"  type="text/css">
      <link rel="stylesheet" href="{$this->directory}assets/css/font-awesome/css/font-awesome.css"  type="text/css">
   
      </head>
      
        <body>
        <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
        <a class="my-0 mr-md-auto font-weight-normal text-dark navbar-brand" href="{$this->directory}index.php"><h5>Sistema de Elecciones</h5></a>
        <nav class="my-2 my-md-0 mr-md-3">
        <a class="p-2 text-dark dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-2x fa-user"></i></a>  <span class="loginType">Acceso</span>
          
          <div class="dropdown-menu" aria-labelledby="dropdown01">
          <a class="dropdown-item" href="{$this->directory}usuario/login.php">Administrador</a>
          <a class="dropdown-item" href="{$this->directory}usuario/loginElector.php">Elector</a>
        </div>
        </nav>
      
      </div>

    EOF;
    echo $header;
  }

  public function printFooter()
  {
    $footer = <<<EOF
      <footer class="footer">
 
      </footer>
      <script src="{$this->directory}assets/js/jquery/jquery-3.5.1.min.js"></script>
       <script src="{$this->directory}assets/js/vendor/popper.min.js"></script>
      <script src="{$this->directory}assets/js/bootstrap.min.js"></script>
      <script src="{$this->directory}assets/js/sweetalert.min.js"></script>
      
      </body>
      </html>
    EOF;
    echo $footer;
  }
} 

?>