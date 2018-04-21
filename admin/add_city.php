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

	<h2>Add City</h2>

	<h3>Add city</h3>
	<form method="POST" action="add_city.php" >
		<input type="text" name="city_name" placeholder="City Name" required > <br>
		<input type="text" name="country_name" placeholder="Country Name" required > <br>
		<input type="submit" name="add" value="Add" >
	</form>

	<?php
		require "musafir_database_connection.php";

		if( isset($_POST['add']) ) {
			$add_query = "INSERT INTO cities ( city_name, country_name )
						 VALUES ( '".$_POST['city_name']."' , '".$_POST['country_name']."' )";
			mysql_query($add_query);

			header('location: add_city.php');
		}
	?>

	<?php
		require "musafir_database_connection.php";

		echo "<h3>Current cities</h3>";

		$city_result = mysql_query("select * from cities");

		echo "<table>
			<tr>
				<th>City name</th>
				<th>Country name</th>
			</tr>
		";

		while ($row=mysql_fetch_assoc($city_result)) {
			echo "	<tr>
						<td>".$row['city_name']."</td>
						<td>".$row['country_name']."</td>
					</tr>";
		}

		echo "</table>";
	?>
</body>

</html>