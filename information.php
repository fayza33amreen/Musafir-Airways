<html>
	<head>
		<title>Customer Info</title>
		<style>
			.main_div {
				margin-left: 150px;
				margin-right: 150px;
			}
			#address_box {
				width: 450px;
			}
		</style>
	</head>

	<body>
		<?php
			require "header.php";
			require "musafir_database_connection.php";
		?>
		
		<div id="page_heading">
			Customer Information
		</div>

		<?php
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

			//echo "flight_id is ".$flight_id;
		?>

		<div class="main_div" >
			<p>Passport number: <?php echo $passport_no;?></p>

			<form method="POST">
				Name:<br>
				<input type="text" name="name" placeholder="FirstName LastName" required > <br><br>
				
				Gender: <br>
				<select name="gender" >
					<option value="Male" >Male</option>
					<option value="Female" >Female</option>
					<option value="Others" >Others</option>
				</select>

				<br><br>

				Birth date: <br>
				<input type="date" name="birth_date" required > <br><br>

				Contact no: <br>
				<input type="number" name="contact_no" required > <br><br>

				Contact address: <br>
				<input id="address_box" type="text" name="contact_address" required > <br><br>

				<input type="submit" name="proceed" value="PROCEED" ><br><br>
				<?php
					if( isset($_POST['proceed']) ) {
						// collect info
						$name = htmlentities($_POST['name']);
						$gender = $_POST['gender'];
						$birth_date = $_POST['birth_date'];
						$contact_no = htmlentities($_POST['contact_no']);
						$contact_address = htmlentities($_POST['contact_address']);

						// add and redirect
						$query = "
							insert into customers ( passport_no, name, gender, birth_date, contact_no, contact_address )
							values ( '".$passport_no."', '".$name."', '".$gender."', '".$birth_date."', ".$contact_no.", '".$contact_address."' )
						";
						mysql_query($query);

						header( "location: ticket.php?flight_id=".$flight_id."&passport_no=".$passport_no );
					}
				?>

			</form>

		</div>

	</body>
</html>