<?php
declare(strict_types=1);
error_reporting(-1);
ini_set('display_errors','1');

$wrongus='<h4>PLEASE LOG IN WITH THE APPROPRIATE USER FOR THIS OPERATION</h4>';
$x='A';
$cells=7;

//after declaring the required variables we attach the display elements
include_once './display.inc.php';
include_once './elements.php';
$loc=new locations;

$html.=$option;
echo $html;

include_once 'inc/footer.inc.php';
?>
