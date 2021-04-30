<?php
require_once 'ciudadanos/ciudadanos.php';
require_once 'layout/electlayout.php';

$layout = new ElectLayout(false);

?>
<?php echo $layout->printHeader2() ?>

<?php echo $layout->printFooter2() ?>