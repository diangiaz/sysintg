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
?>
<div class="section">
                
                  <div class="row">
                    <div class="col-md-12">
					<form action="content.php" method="POST">
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
								//$school		= $_POST['school'];
								$sortBy 	=  $_SESSION['sortBy'];
								$ascdesc	=  $_SESSION['AscDesc'];
								$query = "SELECT name as '0', lastname as '1', birthday as '2', university as '3'
										FROM students
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