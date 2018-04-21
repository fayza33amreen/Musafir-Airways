<html>
	<head>
		<title>Greetings from Musafir Airways</title>
		<style type="text/css">
			
			/* cover image section of homepage */
			#cover {

			}
			#cover_image {
				width: 100%;
			}

			#search_flight {
				margin-left: 150px;
				margin-right: 150px;
				margin-top: 30px;				
				margin-bottom: 80px;
			}

			#search_results {
				margin-left: 150px;
				margin-right: 150px;
				margin-bottom: 80px;
			}

			h2 {
				font-family: font-family: 'Century Gothic', CenturyGothic, AppleGothic, sans-serif;
				color: rgb(65,27,35);
			}

			#result_table {
				border: 1px solid black;
			}
			
		</style>
	</head>

	<body>
		<?php
			require "header.php";
			// connecting database
			require "musafir_database_connection.php";
		?>
		
		<!-- Cover image section -->
		<div id="cover">
			<img id="cover_image" src="img/index/img1.jpg">
		</div>

		<!-- Page heading section -->
		<div id="page_heading" >
			Home
		</div>

		<div id="search_flight" >
			<h2>Search for flight schedule:</h2>

			<form method="POST" action="index.php#search_results" name="flight_search_form" >
				Select date:<br>
				<input type="date" name="flight_date" required > <br><br>
				
				Select source:<br>
				<select name="source_city" >
					<?php
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
				</select>

				<br><br>
				<input type="submit" name="search" value="SEARCH" > <br><br>
			</form>
		</div>

		<div id="search_results" >
			<?php
				if( isset($_POST[ 'search' ]) ) {
					$route_query = "select route_id from route_list where source_id=".$source_city_id." and destination_id=".$destination_city_id;
					$route_result = mysql_query($route_query);
					if( $row=mysql_fetch_assoc($route_result) ) {
						$route_id = $row[ 'route_id' ];

						// searching for flight on date
						$flight_date_input = $_POST[ 'flight_date' ];
						$flight_query = "select * from flights where departure_date='".$flight_date_input."' and route_id=".$route_id;	
						$flight_search_result = mysql_query($flight_query);

						$source_city_name = mysql_fetch_assoc( mysql_query( "select city_name from cities where city_id = ".$source_city_id ) )[ 'city_name' ];
						$destination_city_name = mysql_fetch_assoc( mysql_query( "select city_name from cities where city_id = ".$destination_city_id ) )[ 'city_name' ];

						echo "<h3>Total ".mysql_num_rows($flight_search_result)." flights found on $flight_date_input from $source_city_name to $destination_city_name<br></h3>";

						// the search table
						if( mysql_num_rows($flight_search_result) !=0 ) {
							echo "<table id='result_table'>
									<tr>
										<th>Departure Date</th>
										<th>Departure Time</th>
										<th>Arrival Date</th>
										<th>Arrival Time</th>
										<th>Plane Type</th>
										<th>Vacant Seats</th>
										<th>Ticket Price</th>
										<th>Book</th>
									</tr>
							";
							while ($flight=mysql_fetch_assoc($flight_search_result)) {
								$flight_id = $flight[ 'flight_id' ];
								echo "
									<tr>
										<td>".$flight[ 'departure_date' ]."</td>
										<td>".$flight[ 'departure_time' ]."</td>
										<td>".$flight[ 'arrival_date' ]."</td>
										<td>".$flight[ 'arrival_time' ]."</td>
										<td>".mysql_fetch_assoc(
											mysql_query("select plane_type_name from plane_types, planes where plane_id=".$flight['plane_id']." and planes.plane_type_id=plane_types.plane_type_id")
											)['plane_type_name']."</td>
										<td>".$flight[ 'vacant_seats' ]."</td>
										<td>".$flight[ 'ticket_price' ]."</td>
										<td><a href='book.php?flight_id=$flight_id' >Click to book</a></td>
									</tr>
								";
							}

							echo "</table>";
						}
					} else {
						echo "<h3>Sorry, we don't operate in the specified route!</h3>";
					}
				}
			?>
		</div>

	</body>
</html>