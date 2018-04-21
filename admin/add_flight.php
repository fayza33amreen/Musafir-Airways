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
	
	<h2>Add Flight</h2>	

	<form method="POST" action="add_flight.php" >
		Select Route:<br>
		<select name="route" >
			<?php
				require "musafir_database_connection.php";
				$query = "
					select route_id, s.city_name as s_name, d.city_name as d_name from route_list, cities as s, cities as d where
					s.city_id=source_id and d.city_id=destination_id
				";
				$result = mysql_query($query);
				while ($row=mysql_fetch_assoc($result)) {
					echo "<option value=".$row['route_id']." >".$row['s_name']." -- to -- ".$row['d_name']."</option>";
				}
			?>
		</select> <br><br>

		Select Plane:<br>
		<select name="plane" >
			<?php
				$query = "
					select plane_id, plane_type_name, plane_type_capacity from plane_types, planes where
					planes.plane_type_id = plane_types.plane_type_id order by plane_id
				";
				$result = mysql_query($query);
				while ($row=mysql_fetch_assoc($result)) {
					$coded = $row['plane_type_capacity'];
					$coded = $coded * 1000;
					$coded = $coded + $row[ 'plane_id' ];
					echo "<option value=".$coded." >#".$row['plane_id']." -- ".$row['plane_type_name']." -- seats: ".$row['plane_type_capacity']."</option>";
				}
			?>
		</select> <br><br>

		Departure:
		<input type="date" name="departure_date" required > at: <input type="time" name="departure_time" required ><br><br>

		Arrival:
		<input type="date" name="arrival_date" required > at: <input type="time" name="arrival_time" required ><br><br>

		Ticket price:
		<input type="number" name="ticket_price" placeholder="/= Taka" required ><br><br>

		<input type="submit" name="add" >
		<?php
			if( isset($_POST['add']) ) {
				$coded = $_POST[ 'plane' ];
				$plane_id = $coded % 1000;
				$vacant_seats = $coded / 1000;
				$route_id = $_POST[ 'route' ];
				$query = "
					insert into flights ( plane_id, route_id, departure_date, departure_time, arrival_date, arrival_time, vacant_seats, ticket_price )
					values ( ".$plane_id.", ".$route_id.", '".$_POST['departure_date']."', '".$_POST['departure_time']."', '".$_POST['arrival_date']."', '".$_POST['arrival_time']."', ".$vacant_seats.", ".$_POST['ticket_price']." )
				";
				mysql_query($query);
				header('location: add_flight.php');
			}
		?>

	</form>

	<h2>Current Flights</h2>

	<table>
		<tr>
			<th>Source</th>
			<th>Destination</th>
			<th>Plane #</th>
			<th>Departure Date</th>
			<th>Departure Time</th>
			<th>Arrival Date</th>
			<th>Arrival Time</th>
			<th>Vacant Seats</th>
			<th>Ticket Price</th>

		</tr>

		<?php
			$query = "
				select s.city_name as s_name, d.city_name as d_name, plane_id, departure_date, departure_time,
				arrival_date, arrival_time, vacant_seats, ticket_price
				from flights, route_list, cities as s, cities as d where
				flights.route_id=route_list.route_id and s.city_id=source_id and d.city_id=destination_id
				order by departure_date, departure_time
			";
			$result = mysql_query($query);
			while ($row=mysql_fetch_assoc($result)) {
				echo "
					<tr>
						<td>".$row['s_name']."</td>
						<td>".$row['d_name']."</td>
						<td>".$row['plane_id']."</td>
						<td>".$row['departure_date']."</td>
						<td>".$row['departure_time']."</td>
						<td>".$row['arrival_date']."</td>
						<td>".$row['arrival_time']."</td>
						<td>".$row['vacant_seats']."</td>
						<td>".$row['ticket_price']."</td>
					</tr>
				";
			}
		?>

	</table>

</body>

</html>