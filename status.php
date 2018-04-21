<html>
	<head>
		<title>Booking status</title>
		<style>
			.main_div {
				margin-left: 150px;
				margin-right: 150px;
			}
		</style>
	</head>

	<body>
		<?php
			require "header.php";
			require "musafir_database_connection.php";

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
				$id = $_GET[ 'id' ];
			} catch( Exception $e ) {
				header('location: index.php');
			}
		?>
		
		<div id="page_heading">
			Booking status
		</div>

		<div class="main_div" >
			<?php
				$query = "
					select * from tickets where ticket_id=".$id."
				";
				$ticket_row = mysql_fetch_assoc(mysql_query($query));

				$passport_no = $ticket_row[ 'passport_no' ];
				$flight_id = $ticket_row[ 'flight_id' ];
			?>

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

			<?php
				echo "<h2>Ticket Information</h2>";

				echo "Ticket id: ".$ticket_row['ticket_id']."<br>";
				echo "Total seat(s): ".$ticket_row['seat_count']."<br>";
				echo "Total fare: ".$ticket_row['fare_amount']." Taka<br>";
				echo "Booking date: ".$ticket_row['booking_date']."<br>";
				echo "Purchase date: ".$ticket_row['purchase_date']."<br>";
				echo "Booking status: ".$ticket_row['status']."<br>";
			?>

		</div> <br><br>
	</body>
</html>