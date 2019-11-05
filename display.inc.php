<?php

declare(strict_types=1);
include_once 'inc/header.inc.php';
include_once './elements.php';
error_reporting(-1);
ini_set('display_errors', '1');
$status=session_status();
if($status===PHP_SESSION_NONE){
  session_start();
}
include_once 'inc/db_connect.inc.php';
//connection to database
                        foreach($C as $name=>$val){
                          define($name,$val);
                        }
                          $DBHost='localhost';
                          $DBName='smigroup';
                          $DBUser='root';
                          $DBPass='';


                                $dsn="mysql:host=".$DBHost.";port=3306;dbname=".$DBName;
                                try{
                                  $dbo=new PDO($dsn,$DBUser,$DBPass);
                                }
                                catch(PDOException $e){
                                  return $e->getMessage();
                                }
                                $dbo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
//javascript script for the search window
echo '
		<div class="options" id="optionsSlider">
            <ul>
                <li><a href="index.php?to_do=input">ALLOCATE ORDER</a></li>
                <li><a href="index.php?to_do=scanPick">FIND LOCATION</a></li>
                <li><a href="display.inc.php?action=listing">LIST ALL ORDERS</a></li>
            </ul>
            </div>

		<script>
		function Filtering(){
		var input,filter,t_able,td,t_d;
		input=document.getElementById("search");
		filter=input.value.toUpperCase();
		t_able=document.getElementById("orders");
		tds=document.querySelectorAll("table.ordlist tr");
		var num=tds.length;
		console.log(num);
		for(var i=0;i<tds.length;++i){
				var check=tds[i];
					if(check.innerHTML.toUpperCase().indexOf(filter)>-1){
						check.style.display="";
					}else{
						check.style.display="none";
					}
		}
			}
		</script>';

//object declarations
                  $ord=new orders($dbo);
                  $user=new user;
                  if(isset($_GET['loszar'])=='loszar'){
                    $ord=$_GET['ord'];
                    $loc=$_GET['loc'];
                    echo 'This is approve that the order'.$ord.'with the location'.$loc.' was passed by jQuery';
                  }

if(isset($_GET['action']) && $_GET['action']=='listing'){
    $user->login('emb');
  
  $display=$ord->listOrders();
  
}
//display appropriate info on the page for each user
if(isset($_SESSION['username'])){

    if(isset($_GET['to_do']) && $_GET['to_do']=='input'){
      if($_SESSION['username']=='Embroidery department' || $_SESSION['username']=='HS department'){
      $option=$formInput2;
    }else{
      $option=$wrongus;
    }

    }
    if(isset($_GET['to_do']) && $_GET['to_do']=='scanDone'){
      if($_SESSION['username']=='Finished picking process'){
        $option= $scanItemp;
        $option.='<br><div id="processed"></div>';
      }else{
        $option=$wrongus;
      }
    }
    //display the order list
    if(isset($_GET['to_do']) && $_GET['to_do']=='list'){
      $option=$listing;
    }
                  //allocations options
                    if(isset($_GET['result']) && $_GET['result']=='uploaded'){
                      $add='<p class="successupload">Your order allocations was succesfull.</p>';
                      $option.=$add;
                    }
                    if(isset($_GET['result']) && $_GET['result']=='exist'){
                      $getOrd=$_GET['ord'];
                      $loc=$_GET['loc'];
                      $disp='<p class="update">The order number '.$getOrd. 'is alrady allocated in the location <span class="loc">'.$loc.'</span>.</p><p class="update">Fill up the update form below if you want to make changes.</p>';
                        $extratd=$gobackbutton;
                        $formUpdate.=$disp;
                        $option=$formUpdate;
                    }
                  }
                  else
                  {
			
                    $option=$login;
                    if(isset($_GET['wrong'])){
                      if($_GET['wrong']==="wrong_user"){
                        $option.=$warningus;
                      }
                      elseif($_GET['wrong']==="wrong_pass"){
                        $option.=$warningpass;
                      }
                    }
                  }

                  //scan page display
                    if(isset($_GET['to_do']) && $_GET['to_do']=='scanPick'){
                      $extratd='';
                      $option=$scanItem;
                    }


function __autoload($classname){
  $fileName=__DIR__.'/class/class.'.$classname.'.inc.php';
  if(file_exists($fileName)){
    include_once $fileName;
  }else{
    echo 'No classes found.';
  }
}
include_once 'inc/footer.inc.php';
?>
