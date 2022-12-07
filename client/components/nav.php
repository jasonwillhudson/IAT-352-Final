<nav>
	<ul class="nav-list">
		<li class="nav-items">sVap</li>
		<li class="nav-items"><a href="/">Home</a></li>
		<li class="nav-items"><a href="/">Favourites</a></li>
		<li class="nav-items"><a href="/">Chat</a></li>
		<li class="nav-items" style="font-size: 40px"><a href="/">+</a></li>
		<li class="nav-items"><button class="nav-btn"><?php echo empty($_SESSION['email']) ? "Login" : "Sign Out"; ?></button></li>
	</ul>
</nav>