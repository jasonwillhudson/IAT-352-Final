<nav>
	<ul class="nav-list">
		<li class="nav-items">sVap</li>
		<li class="nav-items"><a href="../pages/showmodels.php">Home</a></li>
		<li class="nav-items"><a href="/">Favourites</a></li>
		<li class="nav-items"><a href="../pages/chat.php">Chat</a></li>
		<li class="nav-items" style="font-size: 40px"><a href="../pages/postForm.php">+</a></li>
		<li class="nav-items"><button class="nav-btn"><?php echo empty($_SESSION['email']) ? "Login" : "Sign Out"; ?></button></li>
	</ul>
</nav>