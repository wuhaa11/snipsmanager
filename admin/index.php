<?php 
/**
 * Copyright (c) 2010-2011 CodeHave (http://www.codehave.com/), All Rights Reserved
 * A CodeHill Creation (http://www.codehill.com/)
 * 
 * IMPORTANT: 
 * - You may not redistribute, sell or otherwise share this software in whole or in part without
 *   the consent of CodeHave's owners. Please contact the author for more information.
 * 
 * - Link to codehave.com may not be removed from the software pages without permission of CodeHave's
 *   owners. This copyright notice may not be removed from the source code in any case.
 *
 * - This file can be used, modified and distributed under the terms of the License Agreement. You
 *   may edit this file on a licensed Web site and/or for private development. You must adhere to
 *   the Source License Agreement. The latest copy can be found online at:
 * 
 *   http://www.codehave.com/license/
 * 
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS OR 
 * IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND 
 * FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR 
 * CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL
 * DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, 
 * WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY
 * WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * @link        http://www.codehave.com/
 * @copyright   2010-2011 CodeHill LLC (http://www.codehill.com/)
 * @license     http://www.codehave.com/license/
 * @author      Amgad Suliman, CodeHill LLC <amgadhs@codehill.com>
 * @version     2.2
 *
 */
 
session_start(); 
include('../config.php');
include('../includes/functions.php');
connect();

include('header.php'); 

require('../includes/login.class.php');
$loginSys = new LoginSystem();

// if not logged in goto login form, otherwise we can view our page
if(!$loginSys->isLoggedIn()) {
	header("Location: login.php");
	exit;
}?>

	<div class='sub'>
	    <span>Logged in as <?php echo  $_SESSION['userName']; ?>&nbsp;&nbsp;
    	<a href="changepassword.php">Change Password</a>&nbsp;&nbsp;
    	<a href="../includes/logout.php">Logout</a></span>
    	Home</div>

	<div class='content'>
		<div id='error'></div>

<div class='top'></div>
<center>

<script type="text/javascript" src="../includes/ofc/js/swfobject.js"></script>
<script type="text/javascript">
	swfobject.embedSWF("../includes/ofc/open-flash-chart.swf", "admin_days", "575", "300", "9.0.0", "../includes/expressInstall.swf", {"data-file":"../includes/ofc/charts/admin_days.php"});
</script>
<script type="text/javascript">
	swfobject.embedSWF("../includes/ofc/open-flash-chart.swf", "admin_types", "575", "300", "9.0.0", "../includes/expressInstall.swf", {"data-file":"../includes/ofc/charts/admin_types.php"});
</script>

<div class='textbox2' name="gottaload">

<script type="text/javascript" src="js/jquery.idTabs.min.js"></script>
<div id="usual1" class="tabnames"> 
  <ul> 
    <li><a class="selected" href="#days">Days</a></li> 
    <li><a href="#types">Types</a></li>
    <li style="float:right;font-weight:bold;padding-top:6px;"><?php echo ch_gettotalsnippets(); ?> Total Snippets</li>
  </ul>
  <div id="days"><br /><br /><div id="admin_days"></div></div> 
  <div id="types"><br /><br /><div id="admin_types"></div></div> 
</div> 
 
<script type="text/javascript"> 
  $("#usual1 ul").idTabs(); 
</script>

</div>
<div class='bottom'></div>
</center>



<?php include("footer.php"); ?>