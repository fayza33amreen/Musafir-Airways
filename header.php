<!--
	Title: 	Header section file for "Musafir Airways" website
	Author:	Md. Fahim Mohiuddin
	Date:	1-Feb-2016

	User instructions:
		1.	Include this file in every page of the website at the starting of <body>
			using 'require' function of php.

		2.	Follow this serial in every pgae: 	header.php > 
												heading section of the page >
												contents of the page >

		3.	For making the page header, create a <div> and give it id="page_heading".
			Use simple text without any formatting or tag.
			All necessary formatting is provided in #page_heading css style in this file.

		4.	In <body> write everything under different <div>.
			For every <div> write: 	
								margin-left: 150px;
								margin-right: 150px;
-->
<html>
<head>
	<style type="text/css">
		/* format of title section */
		#title {
			position: relative;
			margin-left: 150px;
			margin-right: 150px;
		}
		#title_logo {
			height: 150px;
			left: 150px;
			margin-bottom: 15px;
		}
		#title_slogan {
			display: inline;
			position: absolute;
			right: 15px;
			top: 0;
			font-family: 'Century Gothic', CenturyGothic, AppleGothic, sans-serif;
			font-size: 35px;
			color: rgb(158,124,108);
		}
		#title_form {
			display: inline;
			position: absolute;
			right: 15px;
			bottom: 5px;
		}
		.title_form_button {
			padding: 15px;
			height: 50px;

			background-color: rgb(225,142,44);	
			color: white;
			font-size: 18px;
			font-family: 'Century Gothic', CenturyGothic, AppleGothic, sans-serif;

			border: none;
			border-radius: 5px;

			text-decoration: none;
		}

		/* format of page heading */
		#page_heading {
			padding-left: 150px;
			padding-top: 10px;
			padding-bottom: 10px;
			margin-top: 20px;
			background-color: rgb(93,49,46);
			color: white;
			font-family: 'Century Gothic', CenturyGothic, AppleGothic, sans-serif;
			font-size: 45px;
		}

		/* general body properties correction */
		body {
			padding: 0; 
			margin: 0;
			font-family: 'Century Gothic', CenturyGothic, AppleGothic, sans-serif;
		}
	</style>
</head>

<body>
	<div id="title" >
		<img id="title_logo" src="img/common/logo.png" >
		<p id="title_slogan" >Your comfort is our priority!</p>
		<!-- horrible mistake not reported by browser -->
		<form id="title_form" name="navigation_form" type="POST" action="" >
			<!--<input class="title_form_button" type="submit" name="home_page" value="HOME" >-->
			<a class="title_form_button" href="index.php">HOME</a>

			<a class="title_form_button" href="check_status.php">Booking Status</a>
			
			<!--<input class="title_form_button" type="submit" name="rules_page" value="RULES" href="rules.php" >-->
			<a class="title_form_button" href="rules.php">RULES</a>
			
			<!--<input class="title_form_button" type="submit" name="contact_page" value="CONTACT US" >-->
			<a class="title_form_button" href="">CONTACT US</a>
		</form>
	</div>
</body>

</html>