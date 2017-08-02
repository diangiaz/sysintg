<style>
button {
     background:none!important;
     color:inherit;
     border:none; 
     padding:0!important;
     font: inherit;
     /*border is optional*/
     border-bottom:1px solid #444; 
     cursor: pointer;
}
</style>

<?php
session_start();
require_once('mysqlconnect.php');
$schools = [];

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
		foreach($_POST['school'] as $choice){
			array_push($schools, $choice);
		}
		
		if(count($schools) == 1){
		$first = $schools[0];
		$schoolQuery = "WHERE (university = '$first'";
		} else {	
			$schoolQuery = "WHERE (";
			foreach($schools as $school){
				$schoolQuery = $schoolQuery . "university = '$school' OR ";
			}
			$schoolQuery = rtrim($schoolQuery,"OR ");
		}
}

$_SESSION['ADMU'] = (in_array("Ateneo De Manila University", $schools));
$_SESSION['DLSU'] = (in_array("De La Salle University", $schools));
$_SESSION['MIT'] = (in_array("Mapua Institute of Technology", $schools));
$_SESSION['LPU'] = (in_array("Lyceum of the Philippines University", $schools));
$_SESSION['UST'] = (in_array("University of Santo Tomas", $schools));
$_SESSION['UP'] = (in_array("University of the Philippines", $schools));
$_SESSION['STI'] = (in_array("Systems Technology Institute", $schools));

?>


<div class="section">
                
	<form action="content.php" method="POST">
    <div class="row">
	<input type="checkbox" name="school[]" value="Ateneo De Manila University" <?php if ($_SESSION['ADMU']) echo "checked"; ?>> ADMU <br>
	<input type="checkbox" name="school[]" value="De La Salle University" <?php if ($_SESSION['DLSU']) echo "checked"; ?>> DLSU <br>
	<input type="checkbox" name="school[]" value="Mapua Institute of Technology" <?php if ($_SESSION['MIT']) echo "checked"; ?>> MIT <br>
	<input type="checkbox" name="school[]" value="Lyceum of the Philippines University" <?php if ($_SESSION['LPU']) echo "checked"; ?>> LPU<br>
	<input type="checkbox" name="school[]" value="University of Santo Tomas" <?php if ($_SESSION['UST']) echo "checked"; ?>> UST <br>
	<input type="checkbox" name="school[]" value="University of the Philippines" <?php if ($_SESSION['UP']) echo "checked"; ?>> UP <br>
	<input type="checkbox" name="school[]" value="Systems Technology Institute" <?php if ($_SESSION['STI']) echo "checked"; ?>> STI<br>
	<br>
	
	Ages <input type="number" name="ageX" min="0" max="2017" <?php if (isset($_POST['ageX'])){ $ageX = $_POST['ageX']; echo "value=$ageX";} ?>> ~
	Ages <input type="number" name="ageY" min="0" max="2017" <?php if (isset($_POST['ageY'])){ $ageY = $_POST['ageY']; echo "value=$ageY";} ?>> 
	<br>
	<input type="submit" value="Update Table">
		<div class="col-sm-12" style = "height: 65%;overflow-y:auto;overflow-x:auto;margin-bottom:20px">
		<table border = "1">
			<thead>						
			<tr>
				<th class="col-sm-2"><button class='link-button' name='sort' type='submit' align='center' value='1'>First Name</th>
				<th class="col-sm-2"><button class='link-button' name='sort' type='submit' align='center' value='2'>Last Name</th>
				<th class="col-sm-2"><button class='link-button' name='sort' type='submit' align='center' value='3'>Birthday</th>
				<th class="col-sm-2"><button class='link-button' name='sort' type='submit' align='center' value='4'>University</th>
			</tr>
			</thead>
			
	
            <tbody>
		
			<?php
				if (empty($_POST['search']))
				$search 	= "";
				else						
				$search 	= $_POST['search'];	
				$sortBy 	=  $_SESSION['sortBy'];
				$ascdesc	=  $_SESSION['AscDesc'];
				
				if (empty($ageX))
					$ageX = 0;
				
				if (empty($ageY))
					$ageY = 2017;

				if (empty($schoolQuery))
					$schoolQuery = "";
				
				
				
				if ($schoolQuery != ""){
				$query = "SELECT name as '0', lastname as '1', birthday as '2', university as '3'
						FROM table1
						$schoolQuery)
						AND ((((timestampdiff(year, birthday, curdate())) >= $ageX)AND((timestampdiff(year, birthday, curdate())) <= $ageY)) OR 
								(((timestampdiff(year, birthday, curdate())) >= $ageY)AND((timestampdiff(year, birthday, curdate())) <= $ageX)))
						ORDER BY $sortBy $ascdesc";
				} else {
					$query = "SELECT name as '0', lastname as '1', birthday as '2', university as '3'
						FROM table1
						WHERE ((((timestampdiff(year, birthday, curdate())) >= $ageX)AND((timestampdiff(year, birthday, curdate())) <= $ageY)) OR 
								(((timestampdiff(year, birthday, curdate())) >= $ageY)AND((timestampdiff(year, birthday, curdate())) <= $ageX)))
						ORDER BY $sortBy $ascdesc";
				}
				
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
		</div>
    </div>
	</form>
</div>
			  
