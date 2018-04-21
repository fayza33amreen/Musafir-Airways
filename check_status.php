<html>
	<head>
		<title>Check status</title>
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
		?>
		
		<div id="page_heading">
			Check booking status
		</div>

		<div class="main_div" >
			<form method="POST" >
				<h3>Enter your booking id:</h3><br><br>
				<input type="number" name="id" placeholder="id" required ><br><br>
				<input type="submit" name="check" value="Check" > <br><br>
				<?php
					if( isset($_POST['check']) ) {
						$ticket_id = $_POST['id'];

						$query = "
							select * from tickets where ticket_id=".$ticket_id."
						";
						$result = mysql_query($query);

						if( $row=mysql_fetch_assoc($result) ) {
							header("location: status.php?id=".$ticket_id);
						} else {
							echo "Sorry this ticket id does not exist!<br>";
						}
					}
				?>
			</form>
		</div>
	</body>
</html>