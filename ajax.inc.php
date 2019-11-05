<?php
declare(strict_types=1);
/*
*Enable session if is needed
*/
$status=session_status();
if($status==PHP_SESSION_NONE){
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
  $action='';
  define('ACTIONS',array(

    'scan'=>array(
      'object'=>'orders',
      'method'=>'addOrdByjQuery'
    ),
    'addord'=>array(
      'object'=>'orders',
      'method'=>'addNewLoc'
    ),
    'update'=>array(
      'object'=>'orders',
      'method'=>'updateLoc'
    ),
    'scanN'=>array(
      'object'=>'orders',
      'method'=>'checkLoc'
    ),
    'delete'=>array(
      'object'=>'orders',
      'method'=>'deleteOrd'
    ),
    'agridElements'=>array(
      'object'=>'orders',
      'method'=>'getLocations'
    ),
    'login'=>array(
      'object'=>'user',
      'method'=>'login'
    )
  ));

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
                echo $obj->$method();
                  }
                  else{
                    return 'Error in loading the object!';

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
