<link rel="stylesheet" href="../css/postlist.css">


<?php
session_start();

//import web elements generation helper
include_once "../components/elements.php";

//initialize the page (detect login status and https application, and redirect)
if (!initialize(true, false)) exit();

//include helper Functions
include_once("../../server/helper/postHelper.php");

//import header elements
require "../components/header.php";

//import navbar
require "../components/nav.php";

?>




<div class="container" style="min-height:90vh;">
    <h1 style="text-align:left; margin: 40px; margin-bottom:0;">Your WatchList</h1>
    <!---------------------------------Display Posts------------>
    <div class="post-container" id="posts">
        <?php echo getCollectionList() ?>
    </div>

</div>


<script src="../js/collectionProcess.js"></script>
<?php require "../components/footer.php"; ?>