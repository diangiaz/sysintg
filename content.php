<?php
session_start();
require_once('mysqlconnect.php');

if(empty($_SESSION['sortBy']))
	   $_SESSION['sortBy'] = 1;
   
	   if(empty($_SESSION['AscDesc']))
	   $_SESSION['AscDesc'] = "ASC";
	   
	   if(isset($_POST['sort'])){
		   if($_POST['sort'] ==  $_SESSION['sortBy']){
				if($_SESSION['AscDesc'] == "DESC")
					$_SESSION['AscDesc'] = "ASC"; else
				if($_SESSION['AscDesc'] == "ASC")
					$_SESSION['AscDesc'] = "DESC";
		   } else $_SESSION['AscDesc'] = "ASC";
		   $_SESSION['sortBy'] = $_POST['sort'];
	   }
	   
if (isset($_POST['school'])){
		$schools = [];
		foreach($_POST['school'] as $choice){
			array_push($schools, $choice);
		}
		
		if(count($schools) == 1){
		$first = $schools[0];
		$schoolQuery = "WHERE university = '$first'";
		} else {	
			$schoolQuery = "WHERE ";
			foreach($schools as $school){
				$schoolQuery = $schoolQuery . "university = '$school' OR ";
			}
			$schoolQuery = rtrim($schoolQuery,"OR ");
		}

$_SESSION['checks'] = $schools;		
}
?>





<div class="section">
                
				<form action="content.php" method="POST">
                  <div class="row">
					<input type="checkbox" name="school[]" value="Ateneo De Manila University" <?php $schools = []; foreach ($_SESSION['checks'] as $check) array_push($schools, $check); if (in_array("Ateneo De Manila University", $schools)) echo "checked"; ?>> ADMU <br>
					<input type="checkbox" name="school[]" value="De La Salle University" <?php $schools = []; foreach ($_SESSION['checks'] as $check) array_push($schools, $check); if (in_array("De La Salle University", $schools)) echo "checked"; ?>> DLSU <br>
					<input type="checkbox" name="school[]" value="Mapua Institute of Technology" <?php $schools = []; foreach ($_SESSION['checks'] as $check) array_push($schools, $check); if (in_array("Maputa Institute of Technology", $schools)) echo "checked"; ?>> MIT <br>
					<input type="checkbox" name="school[]" value="Lyceum of the Philippines University" <?php $schools = []; foreach ($_SESSION['checks'] as $check) array_push($schools, $check); if (in_array("Lyceum of the Philippines", $schools)) echo "checked"; ?>> LPU<br>
					<input type="checkbox" name="school[]" value="University of Santo Tomas" <?php $schools = []; foreach ($_SESSION['checks'] as $check) array_push($schools, $check); if (in_array("University of Santo Tomas", $schools)) echo "checked"; ?>> UST <br>
					<input type="checkbox" name="school[]" value="University of the Philippines" <?php $schools = []; foreach ($_SESSION['checks'] as $check) array_push($schools, $check); if (in_array("University of the Philippines", $schools)) echo "checked"; ?>> UP <br>
					<input type="checkbox" name="school[]" value="Systems Technology Institute" <?php $schools = []; foreach ($_SESSION['checks'] as $check) array_push($schools, $check); if (in_array("Systems Technology Institute", $schools)) echo "checked"; ?>> STI<br>
					<input type="submit" value="Update Table">
                    <div class="col-md-12">
                      <table>
                        <thead>						
                          <tr>
                            <th class="col-sm-2"><button class='link-button' name='sort' type='submit' align='center' value='1' style = 'text-decoration:none; color:#008000;'>First Name</th>
                            <th class="col-sm-2"><button class='link-button' name='sort' type='submit' align='center' value='2' style = 'text-decoration:none; color:#008000;'>Last Name</th>
                            <th class="col-sm-2"><button class='link-button' name='sort' type='submit' align='center' value='3' style = 'text-decoration:none; color:#008000;'>Birthday</th>
                            <th class="col-sm-2"><button class='link-button' name='sort' type='submit' align='center' value='4' style = 'text-decoration:none; color:#008000;'>University</th>
                          </tr>
                        </thead>
                        </table>
					</form>
                    </div>
                    <div class="col-sm-12" style = "height: 65%;overflow-y:auto;overflow-x:auto;margin-bottom:20px">
                      <table border="1">
                        <tbody>
						
							<?php
								if (empty($_POST['search']))
								$search 	= "";
								else						
								$search 	= $_POST['search'];	
								$sortBy 	=  $_SESSION['sortBy'];
								$ascdesc	=  $_SESSION['AscDesc'];
								if (empty($schoolQuery))
									$schoolQuery = "";
								$query = "SELECT name as '0', lastname as '1', birthday as '2', university as '3'
										FROM table1
										$schoolQuery
										ORDER BY $sortBy $ascdesc";
								$result =	mysqli_query($dbc,$query);
								
								while($row=mysqli_fetch_array($result,MYSQL_ASSOC)){
										echo "<tr>                                                    ";
										echo "<td>{$row['0']}</td>		                              ";
										echo "<td>{$row['1']}</td>                                    ";
										echo "<td>{$row['2']}</td>                                    ";
										echo "<td>{$row['3']}</td>                                    ";
										echo "</tr>";
								}
							?>
							
							
							
							
                        </tbody>
						
                      </table>
					  <br>
                  </div>
                </div>
              </div>