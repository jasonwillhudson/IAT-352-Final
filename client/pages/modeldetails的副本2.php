
<?php
session_start();

//import web elements generation helper
include_once "../components/elements.php";

//initialize the page (detect login status and https application, and redirect)
if (!initialize(false, false)) exit();

//import header elements
require "../components/header.php";

//import navbar
require "../components/nav.php";
?>

<!-- <link rel="stylesheet" href="../css/chat.css"> -->

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://kit.fontawesome.com/768de621b8.js" crossorigin="anonymous"></script>
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", Arial, Helvetica, sans-serif}
.mySlides {display: none}
</style>

<?php
include('../components/included_functions.php');
no_SSL();
$code = trim($_GET['post_id']);
$msg = trim($_GET['message']);


$query_str = "SELECT post.post_id, post.title, post.description, post.date, post.email, post.category,post.value, image_path.image_path,member.name, member.city, want_to_trade.category, member.phone
			  FROM post
			  INNER JOIN image_path ON post.post_id = image_path.post_id
              INNER JOIN member ON post.email = member.email
              INNER JOIN want_to_trade ON post.post_id = want_to_trade.post_id
			  WHERE post.post_id = ?"; 
			  
			  
$stmt = $db->prepare($query_str);


$stmt->bind_param('s',$code);
$stmt->execute();

$stmt->bind_result($postId,$postTitle,$postDesctib,$postDate,$postEmail,$postCategory,$postValue,$image,$name, $city, $want_trade, $phone);
// echo "123";
// $query_str = "SELECT * 
// 			  FROM image_path 
// 			  WHERE post_id = ?"; 
			  
			  
// $stmt = $db->prepare($query_str);


// $stmt->bind_param('s',$code);
// $stmt->execute();

// $stmt->bind_result($postId1,$image);


if($stmt->fetch()) {
	// echo "<h3>$postTitle</h3>\n";
	// echo "<p>Item Post At: $postDate,<br> Item Category: $postCategory,<br> Original Buy Price: \$$postValue</p>\n";
	// echo "<p>Description: $postDesctib</p>\n";

	// echo "<img src='../../server/$image' alt='' />";
	}

// $stmt->free_result();

// if(is_logged_in() && !is_in_watchlist($code) ) {
// 	echo "<form action=\"addtowatchlist.php\" method=\"post\">\n";
// 	echo "<input type=\"hidden\" name=\"post_id\" value=$code>\n";
// 	echo "<input type=\"submit\" value=\"I Like It\">\n";
// 	echo "</form>\n";
// } else if (!empty($msg) ) {
// 	echo "<p>$msg</p>\n";
// } else if (is_logged_in()) {
// 	echo "This model is already in your <a href=\"showwatchlist.php\">Likes</a>.";
// }


// echo "123";
$db->close();
?>



<!-- !PAGE CONTENT! -->
<div class="w3-main w3-white" style="margin-left:260px; margin-right:260px ">

  <!-- Push down content on small screens -->
  <div class="w3-hide-large" style="margin-top:80px"></div>
  

  <!-- Slideshow Header -->
  <div class="w3-container" id="apartment">
    <h2 class="w3-text-green"><?php echo "$postTitle" ?> 
	 <i class="fa-regular fa-star"></i></h2>
    <div class="w3-display-container mySlides">
    <img <?php echo "src=../../server/$image" ?> style="width:50%;margin-bottom:-6px">
      <div class="w3-display-bottomleft w3-container w3-black">
        <p>Image1</p>
      </div>
    </div>
    <div class="w3-display-container mySlides">
    <img <?php echo "src=../../server/$image" ?> style="width:50%;margin-bottom:-6px">
      <div class="w3-display-bottomleft w3-container w3-black">
        <p>Image2</p>
      </div>
    </div>
    <div class="w3-display-container mySlides">
    <img <?php echo "src=../../server/$image" ?> style="width:50%;margin-bottom:-6px">
      <div class="w3-display-bottomleft w3-container w3-black">
        <p>Image3</p>
      </div>
    </div>
    <div class="w3-display-container mySlides">
    <img <?php echo "src=../../server/$image" ?> style="width:50%;margin-bottom:-6px">
      <div class="w3-display-bottomleft w3-container w3-black">
        <p>Image4</p>
      </div>
    </div>
  </div>
  <div class="w3-row-padding w3-section">
    <div class="w3-col s3">
      <img class="demo w3-opacity w3-hover-opacity-off" <?php echo "src=../../server/$image" ?> style="width:50%;cursor:pointer" onclick="currentDiv(1)" title="Image1">
    </div>
    <div class="w3-col s3">
      <img class="demo w3-opacity w3-hover-opacity-off" <?php echo "src=../../server/$image" ?> style="width:50%;cursor:pointer" onclick="currentDiv(2)" title="Image2">
    </div>
    <div class="w3-col s3">
      <img class="demo w3-opacity w3-hover-opacity-off" <?php echo "src=../../server/$image" ?> style="width:50%;cursor:pointer" onclick="currentDiv(3)" title="Image3">
    </div>
    <div class="w3-col s3">
      <img class="demo w3-opacity w3-hover-opacity-off" <?php echo "src=../../server/$image" ?> style="width:50%;cursor:pointer" onclick="currentDiv(4)" title="Image4">
    </div>
  </div>

  <div class="w3-container">
	<p>Posted At: <?php echo "$postDate" ?> & Posted By: <?php echo "$name" ?></p>
	<br>
	<?php
	if(is_logged_in() && !is_in_watchlist($postId) ) {
	echo "<form action=\"../components/addtowatchlist.php\" method=\"post\">\n";
	echo "<input type=\"hidden\" name=\"post_id\" value=$postId>\n";
	echo "<input type=\"submit\" value=\"I Like It\">\n";
	echo "</form>\n";
}  else if (!empty($msg) ) {
	echo "<p>$msg</p>\n";
} else if (is_logged_in()) {
	echo "This model is already in your <a href=\"showwatchlist.php\">Likes</a>.";
}
?>

	<h4><strong>Item Description</strong></h4>
    <p><?php echo "$postDesctib" ?></p>
    <hr>
	
    <h4><strong>Basic Information</strong></h4>
    <div class="w3-row w3-large">
      <div class="w3-col s6">
        <p><i class="fa-solid fa-city"></i> City: <?php echo "$city" ?></p>
        <p><i class="fa-sharp fa-solid fa-phone"></i> Phone: <?php echo "$phone" ?></p>
        <p><i class="fa-solid fa-envelope-circle-check"></i> E-mail: <?php echo "$postEmail" ?></p>
      </div>
      <div class="w3-col s6">
        <p><i class="fa fa-fw fa-clock-o"></i> Avaliable 7 days a week</p>
      </div>
    </div>
    <hr>
    
    <h4><strong>Want to trade</strong></h4>
    <div class="w3-row w3-large">
      <div class="w3-col s6">
        <p><i class="fa-duotone fa-arrow-down-arrow-up"></i>  <?php echo "$want_trade" ?></p>
        <!-- <p><i class="fa fa-fw fa-wifi"></i> WiFi</p>
        <p><i class="fa fa-fw fa-tv"></i> TV</p>
      </div>
      <div class="w3-col s6">
        <p><i class="fa fa-fw fa-cutlery"></i> Kitchen</p>
        <p><i class="fa fa-fw fa-thermometer"></i> Heating</p>
        <p><i class="fa fa-fw fa-wheelchair"></i> Accessible</p> -->
      </div>
    </div>
    <hr>

  
  <!-- Contact -->
  <div class="w3-container" id="contact">
    <h2>Contact</h2>
    <p>What's to trade? Talk to the owner:</p>
    <form action="/action_page.php" target="_blank">
      <p><input class="w3-input w3-border" type="text" placeholder="Name" required name="Name"></p>
      <p><input class="w3-input w3-border" type="text" placeholder="Email" required name="Email"></p>
      <p><input class="w3-input w3-border" type="text" placeholder="Message" required name="Message"></p>
    <button type="submit" class="w3-button w3-green w3-third">Send a Message</button>
    </form>
  </div>
  


<!-- End page content -->
</div>

<script>
// Script to open and close sidebar when on tablets and phones
function w3_open() {
  document.getElementById("mySidebar").style.display = "block";
  document.getElementById("myOverlay").style.display = "block";
}
 
function w3_close() {
  document.getElementById("mySidebar").style.display = "none";
  document.getElementById("myOverlay").style.display = "none";
}

// Slideshow Apartment Images
var slideIndex = 1;
showDivs(slideIndex);

function plusDivs(n) {
  showDivs(slideIndex += n);
}

function currentDiv(n) {
  showDivs(slideIndex = n);
}

function showDivs(n) {
  var i;
  var x = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  if (n > x.length) {slideIndex = 1}
  if (n < 1) {slideIndex = x.length}
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" w3-opacity-off", "");
  }
  x[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " w3-opacity-off";
}
</script>
<?php
include('footer.php');
?>