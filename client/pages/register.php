<?php
require "../components/header.php";

//import web elements generation helper
require "../components/elements.php";
?>

<section style="height: 100vh; display:flex; flex-direction: column; justify-content:center;">

    <form method="post" style="width: 300px; margin:auto;">

        <h1>Create Account</h1>

        <?php
        //display the input field
        //makeInput($label, $name, $type, $value = "", $space = false)
        echo "<p class = \"errorMssg\"></p>";
        makeInput("Name", "name", "text");
        makeInput("Email", "email", "text");
        makeInput("Phone(optional)", "phone", "text");
        makeInput("City", "city", "text");
        makeInput("Password", "password", "password");
        makeInput("Re-Enter Password", "reEnterPassword", "password");
        ?>

        <input type="submit" name="signup" value="Signup">
        <a href="login.php" style="float: right; margin-top: 20px;">Already have an account?</a>



    </form>
</section>

<script src="../js/registerProcess.js"></script>
<?php
require "../components/footer.php";
?>