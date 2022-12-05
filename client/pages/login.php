<?php
//import web elements generation helper
require "../components/elements.php";

//initialize the page (detect login status and https application, and redirect)
if(!initialize(false, true)) exit();

//import header elements
require "../components/header.php";

?>

<section style="height: 100vh; display:flex; flex-direction: column; justify-content:center;">

    <form method="post" style="width: 300px; margin:auto;">

        <h1>Welcome to sVap</h1>

        <?php
        //display the input field
        //makeInput($label, $name, $type, $value = "", $space = false)
        echo "<p class = \"errorMssg\"></p>";
        makeInput("Email", "email", "text");
        makeInput("Password", "password", "password");

        ?>


        <input type="submit" name="login" value="Login">
        <a href="register.php" style="float: right; margin-top: 20px;">Not a member yet?</a>



    </form>
</section>

<script src="../js/loginProcess.js"></script>
<?php
require "../components/footer.php";

?>