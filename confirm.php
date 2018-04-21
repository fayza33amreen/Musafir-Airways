<html>
	<head>
		<title>Confirmation</title>
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
				$seat_count = $_GET[ 'seat_count' ];
			} catch( Exception $e ) {
				//header('location: index.php');
			}
		?>
		
		<div id="page_heading">
			Confirm Booking
		</div>

		<div class="main_div" >
			<h2>Total bill:</h2>
			<table>
				<tr>
					<th>Number of seats</th>
					<th>Price per seat</th>
					<th>Total</th>
				</tr>
				<tr>
					<td><?php echo $seat_count; ?></td>
					<td>
						<?php
							$query = "
								select * from flights where flight_id=".$flight_id."
							";
							$ticket_price = mysql_fetch_assoc(mysql_query($query))['ticket_price'];
							echo $ticket_price." Taka";
						?>
					</td>
					<td><?php echo $seat_count*$ticket_price." Taka"; ?></td>
				</tr>
			</table>

			<p>Are you sure you want to confirm this booking?</p>

			<form method="POST" >
				<input type="submit" name="confirm" value="Confirm" > <br>
				<?php
					if( isset($_POST['confirm']) ) {
						$query = "
							insert into tickets ( passport_no, flight_id, seat_count, fare_amount, booking_date, status )
							values ( '".$passport_no."', ".$flight_id.", ".$seat_count.", ".$seat_count*$ticket_price.", '".date('Y-m-d')."', 'Booked' )
						";
						mysql_query($query);

						$query = "
							select MAX(ticket_id) as id from tickets
						";
						$id = mysql_fetch_assoc(mysql_query($query))['id'];
						header("location: success.php?id=".$id);
					}
				?>
			</form>
		</div>
	</body>
</html>