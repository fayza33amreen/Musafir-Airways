<html>
	<head>
		<title>Booking successful!</title>
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
				//header('location: index.php');
			}
		?>
		
		<div id="page_heading">
			Booking successful!
		</div>

		<div class="main_div" >
			<p>Your booking has been completed successfully.</p>
			<p>Your booking id is <strong><?php echo $id; ?></strong>. Please carefully preserve this number for future authentication and status checking.</p>
			<p>Pay the fare coming to our office as soon as possible for securing your seats</p>
			<p>Welcome to Musafir Airways. Have a safe journey. Thank you.</p>
		</div>
	</body>
</html>