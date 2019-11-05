<?php
declare(strict_types=1);
error_reporting(-1);
ini_set('display_errors', '1');
$status=session_status();
if($status===PHP_SESSION_NONE){
  session_start();
}
include_once 'inc/db_connect.inc.php';
foreach($C as $name=>$val){
  define($name,$val);
}
  $DBHost='localhost';
  $DBName='smigroup';
  $DBUser='root';
  $DBPass='';
define('ACTIONS',array(
  'list'=>array(
    'object'=>'orders',
     'method'=>'listOrders',
     'header'=>'Location: '
  ),
  'upload'=>array(
    'object'=>'orders',
    'method'=>'addOrders',
    'header'=>'Location:./ '
  ),
  'update'=>array(
    'object'=>'orders',
    'method'=>'updateOrd',
    'header'=>'Location: ./'
  ),
  'login'=>array(
    'object'=>'user',
    'method'=>'login',
    'header'=>'Location:./'
  ),
  ));
  if($_POST['action']=='scan'){
    $ordn=$_POST['order'];
    $location=$_POST['location'];
    $status=$_POST['status'];
    $theOrder=new orders;
    $theOrder->caddOrdByjQuery($ordn,$location,$status);
    //header('Location:./display.inc.php?loszar=loszar&ord='.$ordn.'&loc='.$location);
  }

$dsn="mysql:host=".$DBHost.";port=3306;dbname=".$DBName;
try{
  $dbo=new PDO($dsn,$DBUser,$DBPass);
}
catch(PDOException $e){
  return $e->getMessage();
}
$dbo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

              if(isset(ACTIONS[$_POST['action']])){
                $use_array=ACTIONS[$_POST['action']];
                $obj=new $use_array['object']($dbo);
                $method=$use_array['method'];

                  if(TRUE===$msg=$obj->$method()){
                    header($use_array['header']);
                    echo $obj->$method();
                    exit;
                  }
                  else{
                    exit;
                   //die($msg);
                  }
              }

    //autoload all the classes
function __autoload($classname){
  $fileName=__DIR__.'/class/class.'.$classname.'.inc.php';
  if(file_exists($fileName)){
    include_once $fileName;
  }else{
    echo 'No classes found.';
  }

}
?>
