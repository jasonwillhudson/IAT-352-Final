<nav>

	<ul class="nav-list">
		<li class="nav-items"><a href="../pages/showmodels.php">sVap</a></li>
		<li class="nav-items"><a href="../pages/showmodels.php">Home</a></li>
		<li class="nav-items"><a href="../pages/collection.php">Favourites</a></li>
		<li class="nav-items"><a href="../pages/mypost.php">My Post</a></li>
		<li class="nav-items"><a href="../pages/chat.php">Chat</a></li>
		<li class="nav-items" style="font-size: 40px"><a href="../pages/postForm.php">+</a></li>
		<li class="nav-items"><button class="nav-btn"><?php echo empty($_SESSION['email']) ? "Login" : "Sign Out"; ?></button></li>


	</ul>
	<?php echo "<span id=\"currentpage\" style = 'display:none;'>".basename($_SERVER['PHP_SELF'])."</span>";?>
</nav>

<script src="../js/signOut.js">

</script>