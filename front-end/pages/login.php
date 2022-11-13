<?php
require "../components/header.php";

//import web elements generation helper
require "../components/elements.php";
?>

<section style="height: 100vh; display:flex; flex-direction: column; justify-content:center;">

    <form method="post" style="width: 300px; margin:auto;">

        <h1>Welcome to sVap</h1>

        <?php
        //display the input field
        //makeInput($label, $name, $type, $value = "", $space = false)
        makeInput("Email", "email", "text");
        echo "</br>";
        makeInput("Password", "password", "password");
        echo "</br>";
        ?>

        <div style="width: 100%; display: flex; align-items:center; justify-content: space-between;">
            <input type="submit" name="login" value="Login">
            <label>or</label>
            <input type="submit" name="signup" value="Signup">
        </div>


    </form>
</section>

<?php
require "../components/footer.php";
?>