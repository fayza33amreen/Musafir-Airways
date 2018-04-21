<html>
<head>
	<style>
		table, th, td {
 		   border: 1px solid black;
    	border-collapse: collapse;
		}
	</style>
</head>
<body>
	<a href="index.php"><h3>Home</h3></a>
	
	<h2>Add Route</h2>

	<form method="POST" action="add_route.php">
		Select source:<br>
		<select name="source_city" >
			<?php
				require "musafir_database_connection.php";

				$source_query = "select * from cities";
				$source_result = mysql_query($source_query);

				// showing the cities
				while ($row = mysql_fetch_assoc($source_result)) {
					$city_name = $row['city_name'];
					$city_id = $row['city_id'];
					echo "<option value=$city_id >$city_name</option>";
				}
				$source_city_id = $_POST[ 'source_city' ];
			?>
		</select> <br><br>

		Select destination:<br>
		<select name="destination_city" >
			<?php
				// moving internal data pointer
				mysql_data_seek($source_result, 0);

				// showing the cities
				while ($row = mysql_fetch_assoc($source_result)) {
					$city_name = $row['city_name'];
					$city_id = $row['city_id'];
					echo "<option value=$city_id >$city_name</option>";
				}

				$destination_city_id = $_POST[ 'destination_city' ];	
			?>
		</select> <br><br>

		<input type="submit" name="add" value="Add" >
		<?php
			if( isset($_POST[ 'add' ]) ) {
				$query = "
					insert into route_list ( source_id, destination_id )
					values ( ".$source_city_id.", ".$destination_city_id." )
				";
				mysql_query($query);
				header('location: add_route.php');
			}
		?>
	</form>

	<h2>Existing Routes</h2>

	<table>
		<tr>
			<th>Source</th>
			<th>Destination</th>
		</tr>

		<?php
			$query = "
				select s.city_name as s_name, d.city_name as d_name from route_list, cities as s, cities as d where
				s.city_id=source_id and d.city_id=destination_id
			";
			$result = mysql_query($query);
			while ($row=mysql_fetch_assoc($result)) {
				echo "
					<tr>
						<td>".$row['s_name']."</td>
						<td>".$row['d_name']."</td>
					</tr>
				";
			}
		?>

	</table>

</body>

</html>