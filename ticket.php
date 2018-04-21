<html>
	<head>
		<title>Ticket information</title>
		<style>
			.main_div {
				margin-left: 150px;
				margin-right: 150px;
			}
			table, th, td {
 		 	  	border: 1px solid black;
    			border-collapse: collapse;
			}
		</style>
	</head>

	<body>
		<?php
			require "header.php";
			require "musafir_database_connection.php";
			ob_start();

			// to catch 'Notice' errors as exceptions
			set_error_handler('exceptions_error_handler');
			function exceptions_error_handler($severity, $message, $filename, $lineno) {
  				if (error_reporting() == 0) {
    				return;
  				}
  				if (error_reporting() & $severity) {
	    			throw new ErrorException($message, 0, $severity, $filename, $lineno);
  				}
			}

			try {
				$flight_id = $_GET[ 'flight_id' ];
				$passport_no = $_GET[ 'passport_no' ];				
			} catch( Exception $e ) {
				header('location: index.php');
			}
		?>
		
		<div id="page_heading">
			Ticket Information
		</div>

		<div class="main_div" >
			<?php
				$query = "
					select * from customers where passport_no='".$passport_no."'
				";
				$result = mysql_query($query);
				$row = mysql_fetch_assoc($result);

				echo "<h2>Passenger information</h2>";

				echo "Name: ".$row['name']."<br>";
				echo "Passport no.: ".$row['passport_no']."<br>";
				echo "Gender: ".$row['gender']."<br>";
				echo "Date of birth: ".$row['birth_date']."<br>";
				echo "Contact no.: ".$row['contact_no']."<br>";
				echo "Contact address: ".$row['contact_address']."<br>";
			?>

			<?php
				$query = "
					select s.city_name as s_name, d.city_name as d_name, plane_id, departure_date, departure_time,
					arrival_date, arrival_time, vacant_seats, ticket_price
					from flights, route_list, cities as s, cities as d where
					flight_id=".$flight_id." and flights.route_id=route_list.route_id and s.city_id=source_id and d.city_id=destination_id
					order by departure_date, departure_time
				";
				$row = mysql_fetch_assoc(mysql_query($query));

				echo "<h2>Flight Information</h2>";

				echo "Flight no.: ".$flight_id."<br>";
				echo "Source: ".$row['s_name']."<br>";
				echo "Destination: ".$row['d_name']."<br>";
				echo "Departure date: ".$row['departure_date']."<br>";
				echo "Departure time: ".$row['departure_time']."<br>";
				echo "Arrival date: ".$row['arrival_date']."<br>";
				echo "Arrival time: ".$row['arrival_time']."<br>";
				echo "Ticket price: ".$row['ticket_price']." Taka<br>";
			?>

			<form method="POST" >
				<h2>Seat Information</h2>
				Select total number of seats:<br>
				<select name="seat_count" >
					<?php for($seat=1; $seat<=10; $seat++) echo "<option value=$seat >$seat</option>" ?>
				</select><br><br>
				<input type="submit" name="proceed" value="Proceed" >
				<?php
					if( isset($_POST['proceed']) ) {
						$seat_count = $_POST[ 'seat_count' ];
						header( "location: confirm.php?flight_id=".$flight_id."&passport_no=".$passport_no."&seat_count=".$seat_count );
					}
				?>
			</form>

		</div>

	</body>
</html>