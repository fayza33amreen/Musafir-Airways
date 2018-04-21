<html>
	<head>
		<title>Booking</title>
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
				$flight_id = $_GET[ 'flight_id' ];			
			} catch( Exception $e ) {
				header('location: index.php');
			}
		?>
		
		<div id="page_heading">
			Book a ticket
		</div>

		<div class="main_div" >
			Enter passport number:<br><br>
			<form method="POST" >
				<input type="text" name="passport_no" required > <br><br>
				<input type="submit" name="find" value="SUBMIT" > <br><br>
				<?php
					if( isset($_POST['find']) ) {
						$passport_no = htmlentities($_POST['passport_no']);
						$query = "
							select * from customers where passport_no = '".$passport_no."'
						";
						$result = mysql_query($query);
						if( $row = mysql_fetch_assoc($result) ) {
							header( "location: ticket.php?flight_id=".$flight_id."&passport_no=".$passport_no );
						} else {
							header( "location: information.php?flight_id=".$flight_id."&passport_no=".$passport_no );
						}
					}
				?>
			</form>
		</div>

	</body>
</html>