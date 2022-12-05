

<!-- <!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>sVap</title>
  <link rel="stylesheet" href="../css/main.css">
  <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
</head>

<body> -->



<html>

<head>
	<title>sVap</title>
	<style>
		a.nav {
			color: white;
			text-decoration: none;
		}

		li a.action {
			text-decoration: none;
			font-size: 70%
		}
	</style>
	<script src="../jquery-3.6.1.js"></script>
	<link rel="stylesheet" href="../css/main.css">
	<!-- <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script> -->
	<script src="../js/lec9.js"></script>

</head>

<body>
	<table style="width:100%;border-spacing:0px" border="0">
		<tr style="height:100px;background-color:black">
			<th style="font-family:verdana;font-size:66px;color:white;text-align:center"  colspan="2">sVap</th>
		</tr>
		<tr height="30" bgcolor="gray">
			<td style="font-family:verdana;font-size:24px;color:white;">
				<strong><a class="nav" href="showmodels.php">Items</a> |
					<a class="nav" href="showwatchlist.php">Likes</a> |
					<?php
					if (isset($_SESSION['valid_user']))
						echo "<a class=\"nav\"  href=\"sign-out.php\">Sign out</a>";
					else
						echo "<a class=\"nav\" href=\"sign-in.php\">Sign In</a>";
					?>
			</td>
			<td style="text-align:right">
				<!-- <?php
				
				if (basename($_SERVER['PHP_SELF']) != "../pages/search.php"){
					print_r("<form action='../pages/search.php' method='get' class='searchBar'>
					Search: <input type='text' name='search' class='searchContent' size = '40'>
					<input type='submit' id='searchBtn1' value='GO'/>
					</form>");
				}
				
				?> -->
				<a class="nav" href="../pages/search.php">Search</a>
			</td>
		<tr bgcolor="FFFFFF">
	</table>
				<!--header ends here-->




