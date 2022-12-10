<style>
    #filter {
        display: flex;
        flex-direction: column;
        box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
        margin: 20px;
        padding: 20px;
        flex: 0 0 250px;
    }

    .sub-filter {
        display: flex;
        flex-direction: column;
        margin-left: 40px;
    }

    .filter-title-wrap input {
        margin: 12px;
    }

    .filter-title-wrap {
        font-size: 16px;
        font-weight: 600;
        margin-top: 30px;
    }

    .post-container {
        display: flex;
        justify-content: center;
        flex: 1 1 100%;
    }

    .post-list {
        display: inline-flex;
        padding: 20px;
        flex-wrap: wrap;
        flex: 1 1 100%;
        height: fit-content;
    }

    .post-wrap {
        box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
        height: 310px;
        width: 250px;
        margin: 15px;
        transition: .4s;
        display: flex;
        flex-direction: column;
    }

    .post-title {
        width: 80%;
        margin: auto;
        height: 20px;
        overflow: hidden;
        font-weight: 400;
        font-size: 17px;
    }

    .post-wrap a {
        transition: .4s;
    }

    .post-wrap a:hover {
        transform: translateY(-10px);
        transition: .4s;
        box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
    }

    .text-wrap {
        display: flex;
        justify-content: center;
        align-items: center;
        flex: 1 1 auto;
        padding: 0 15px;
    }

    .star {
        width: 40px;
        height: 40px;
        font-size: 30px;
        display: flex;
        justify-content: center;
        align-items: center;
        transition: .3s;
    }

    .star:hover {
        cursor: pointer;
        transform: scale(1.3);
        transition: .3s;

    }

    .unlike {
        color: darkorange
    }
</style>

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
    <h1 style="text-align:left; margin: 40px; margin-bottom:0;">My Posts</h1>
    <!---------------------------------Display Posts------------>
    <div class="post-container" id="posts">
        <?php echo getMyPost(); ?>
    </div>

</div>


<script src="../js/mypostProcess.js"></script>
<?php require "../components/footer.php"; ?>