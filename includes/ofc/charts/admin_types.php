<?php
/**
 * Copyright (c) 2010-2011 SnipsManager (http://www.snipsmanager.com/), All Rights Reserved
 * A CodeHill Creation (http://www.codehill.com/)
 * 
 * IMPORTANT: 
 * - You may not redistribute, sell or otherwise share this software in whole or in part without
 *   the consent of SnipsManager's owners. Please contact the author for more information.
 * 
 * - Link to snipsmanager.com may not be removed from the software pages without permission of SnipsManager's
 *   owners. This copyright notice may not be removed from the source code in any case.
 *
 * - This file can be used, modified and distributed under the terms of the License Agreement. You
 *   may edit this file on a licensed Web site and/or for private development. You must adhere to
 *   the Source License Agreement. The latest copy can be found online at:
 * 
 *   http://www.snipsmanager.com/license/
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
 * @link        http://www.snipsmanager.com/
 * @copyright   2010-2011 CodeHill LLC (http://www.codehill.com/)
 * @license     http://www.snipsmanager.com/license/
 * @author      Amgad Suliman, CodeHill LLC <amgadhs@codehill.com>
 * @version     2.2
 *
 *
 * This page creates the JSON text needed to display the Days chart in admin/index.php
 *
 */

session_start(); 
include('../../../config.php');
include('../../../includes/functions.php');
connect();

include("../open-flash-chart.php");

//create the line chart and set the values
$result = mysql_query("SELECT `type` as `typeid`, count(id) as `tcount` FROM `codes` group by `type` order by `tcount` desc");
	
$labels = array();
$values = array();

// 1 PHP, 2 Javascript, 3 Text, 4 Other

if($result) {	
	while ($row = mysql_fetch_array($result)){
		$values[] = (int)$row['tcount'];

		switch($row['typeid']) {
			case 0:
				$labels[] = "Not Defined";
				break;
			case 1:
				$labels[] = "PHP";
				break;
			case 2:
				$labels[] = "JavaScript";
				break;
			case 3:
				$labels[] = "Text";
				break;
			case 4:
				$labels[] = "Other";
				break;			
			case 5:
				$labels[] = 'C++';
				break;
			case 6:
				$labels[] = 'ActionScript';
				break;
			case 7:
				$labels[] = 'Apache';
				break;
			case 8:
				$labels[] = 'AppleScript';
				break;
			case 9:
				$labels[] = 'AWK';
				break;
			case 10:
				$labels[] = 'Bash';
				break;
			case 11:
				$labels[] = 'C';
				break;
			case 12:
				$labels[] = 'C#';
				break;
			case 13:
				$labels[] = 'CSS';
				break;
			case 14:
				$labels[] = 'Delphi';
				break;
			case 15:
				$labels[] = 'Fortran';
				break;
			case 16:
				$labels[] = 'Haskell';
				break;
			case 17:
				$labels[] = 'Java';
				break;
			case 18:
				$labels[] = 'jQuery';
				break;
			case 19:
				$labels[] = 'Modula-2';
				break;
			case 20:
				$labels[] = 'MySQL';
				break;
			case 21:
				$labels[] = 'Perl';
				break;
			case 22:
				$labels[] = 'Python';
				break;
			case 23:
				$labels[] = 'Ruby on Rails';
				break;
			case 24:
				$labels[] = 'Scheme';
				break;
			case 25:
				$labels[] = 'SQL';
				break;
			case 26:
				$labels[] = 'Visual Basic';
				break;
			case 27:
				$labels[] = 'Visual Basic .NET';
				break;
			case 28:
				$labels[] = 'Vim';
				break;
			case 29:
				$labels[] = 'XML';
				break;
		}
	}
}

$bars = new bar();
$bars->set_values($values);
$bars->set_colour("1111ff");

//create a Y Axis object and set the minimum and maximum
$ymax =(max($values)) + (10 - (max($values) % 10));  //round the maximum to the nearest 10
$y = new y_axis();
$y->set_range( 0, $ymax, $ymax/5);
$y->set_grid_colour("dddddd");
$y->set_colour("000000");

//create an X Axis object
$x = new x_axis();
$x->set_grid_colour("ffffff");
$x->set_colour("000000");
//$x->offset(false);

//set the values displayed on the X Axis and their look
$x_label = new x_axis_labels();
$x_label->set_labels($labels);
$x_label->set_vertical();
$x->set_labels($x_label);

$chart = new open_flash_chart();
$chart->add_element($bars);
$chart->set_bg_colour("ffffff");
$chart->set_y_axis($y);
$chart->set_x_axis($x);

echo $chart->toPrettyString();   //print out the above parameters in JSON

?>