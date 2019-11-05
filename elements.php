<?php
$aSections='';
$bSections='';
$loc=new locations;

if(isset($_SESSION['username'])){
  $usern=$_SESSION['username'];
}else{
  $usern='';
}
$option="<h2>CHOOSE ONE OF THE OPTIONS ABOVE</h2>";
		
$html='<div class="options" id="optionsSlider">
            <ul>
                <li><a href="index.php?to_do=input">ALLOCATE ORDER</a></li>
                <li><a href="index.php?to_do=scanPick">FIND LOCATION</a></li>
                <li><a href="display.inc.php?action=listing">LIST ALL ORDERS</a></li>
            </ul>
            </div>
            <div class="container">';
$extratd='';
$gobackbutton= ' <td>
                          <a href="index.php?to_do=input">
                          <button type="button" name="back" id="back">Allocate New Order</button>
                          </a>
                </td>';

    $scanItem='<div id=humbuk class="scann">
                  <h2 class="scann">SCAN TO SEARCH ORDER</h2>

              </div>';
    $scanItemp='<div class="scanning">
                  <h2 class="scan">SCAN TO PROCESS ORDER</h2>

              </div>';

        $formInput2=
              /*<h3 id="addman">ADD YOUR ORDER</h3>*/
              '<audio id="soundEffect" src="sound/alert.mp3" preload="auto"></audio>
			     <div id="formManual">
                    <form id="allocation" method="post" action="process.inc.php" >
        
            <div id="ord">
              <input type="text" name="order" id="ordNum" class="longinput" value="" style="height: 18px;" placeholder="order" />
            </div>
            <div id="loc">
              <input type="text" name="location" class="longinput" value="" id="location" style="height: 18px;" placeholder="location"/>
              <input type="hidden" name="action" value="upload" />
              <input type="hidden" name="theStat" value="'. $usern.'" />
			 </div>
			 <div id="addlocbutton">
              <input  type="submit" name="update" id="update" value="ADD ORDER">
            </div>
			</div>
            </table>
            <div id="humbuk" class="allocation"></div>';

        $login='
		    <div id="loginn">
            <form id="login" name="login" method="post" action="process.inc.php">
            
                
                <div id="usernamecontainer">
				<input type="text" name="username" value="" placeholder="username" /></td>
                </div>
                
                <div id="passwordcontainer">
				<input type="text" name="password" value="" placeholder="password"/>
                <input type="hidden" name="action" value="login"></td>
                </div>
               
                <div>
				<input type="submit" name="submit" value="login" id="loginbutton" /></td>
                </div>
				</form>
                </div>
              

        ';
        $warningus="<h4> The username you entered is wrong.Try again.</h4>";
        $warningpass="<h4>Your password is incorrect.Try again.</h4>";
       
		$option='';
?>
