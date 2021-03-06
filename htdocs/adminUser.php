<?php  
include("header.php");
include("adminNavBar.php");

$result;
if(isset($_POST['submit'])){
    $searchTerm = $_POST['searchForUser'];
    $result = pg_query_params($db, 'SELECT * FROM useraccount WHERE email = $1 OR name = $1', array($searchTerm));
}else{
    $result = pg_query($db, 'SELECT * FROM useraccount'); 
}
?>

<html>
	<body id = 'adminpage'>
		<h1 class="text-center">Existing User Information</h1>
		<div class="container">
			<div class="row">
				<div class="col-md-10">
					<form action='' method='post'>
						<div class='form-group'>
							<label for='searchForUser'>Search for: </label>
							<input type='text' name='searchForUser' id='searchForUser' size='40'>
							<input type="submit" name="submit" class='btn btn-primary' value="Search">
							<a href="adminUser.php" class='btn btn-primary' role='button'>Refresh?</a>
						</div>
					</form>
				</div>
				<div class="col-md-2">
				<a href="adminCreateUser.php" class='btn btn-primary' role='button'>Create a new user account</a>
				</div>
			</div>
		</div>
		<div id= 'divTable'>
			<table id="table" class="table table-striped table-bordered col-md-10" style="width:100%">
			<?php 
			$counter = 1;
			echo "<thead>
				<tr>
					<th>S/N</th>
					<th>Name</th>
					<th>Gender</th>
					<th>Contact Number</th>
					<th>Email</th>
					<th>Password</th>
					<th>Vehicle Plate</th>
					<th>Capacity</th>
					<th>Is a driver?</th>
					<th>Edit</th>
					<th>Delete</th>
				</tr>
				</thead>";
			echo "<tbody>";
				while($row = pg_fetch_array( $result )) { 
					echo "<tr>";
					echo "<td>" . $counter . "</td>";
					echo "<td>" . $row[0] . "</td>";
					echo "<td>" . $row[1] . "</td>";
					echo "<td>" . $row[2] . "</td>";
					echo "<td>" . $row[3] . "</td>";
					echo "<td>" . $row[4] . "</td>";
					echo "<td>" . $row[5] . "</td>";
					echo "<td>" . $row[6] . "</td>";
					echo "<td>" . $row[7] . "</td>";
					echo "<td class='table-fit'><a href='adminEditUser.php?email=", urlencode($row[3]), "'class='btn btn-primary' role='button'>Edit</a></td>";
					echo "<td class='table-fit'><a href='adminDeleteUser.php?email=", urlencode($row[3]), "'class='btn btn-primary' role='button'>Delete</a></td>";
					echo "</tr>";
					$counter++;
				}
			echo "</tbody>";
			?>
			</table>
		</div>
		<a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button" title="Scroll to top" data-toggle="tooltip" data-placement="left"><i class="fas fa-arrow-up"></i></a>
	</body>
</html>
