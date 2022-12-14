<?php
session_start();
//import web elements generation helper
require "../components/elements.php";

//initialize the page (detect login status and https application, and redirect)
if(!initialize(false, true)) exit();

//import header elements
require "../components/header.php";

?>

<section style="height: 100vh; display:flex; flex-direction: column; justify-content:center;">

    <form method="post" style="width: 300px; margin:auto;">

        <h1>Create Account</h1>
       

        <?php
         
        //display the input field
        // makeInput($label, $name, $type, $value = "", $space = false);
        echo "<p class = \"errorMssg\"></p>";
        makeInput("Name", "name", "text");
        makeInput("Email", "email", "text");
        makeInput("Phone(optional)", "phone", "text");

        //City List
        $cityList = ['Surrey' => 'Surrey', 'Burnaby' => 'Burnaby', 'Richmond' => 'Richmond', 'Coquitlam' => 'Coquitlam', 'Langley'=>'Langley', 'Delta'=>'Delta', 'North Vancouver'=>'North Vancouver', 'Maple Ridge' => 'Maple Ridge', 'New West' => 'New West', 'West Vancouver'=>'West Vancouver', 'Port Moody'=> 'Port Moody','White Rock'=>'White Rock'];
        createDropDown("City", "city", $cityList, "");
        
        //password
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