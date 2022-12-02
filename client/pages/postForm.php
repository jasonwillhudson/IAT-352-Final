<?php
require "../components/header.php";

//import web elements generation helper
require "../components/elements.php";
?>

<section style="height: 100vh; display:flex; flex-direction: column; justify-content:center;">

    <form method="post" style="width: 100%; margin:auto;">

        <h1>Create Account</h1>

        <?php
        //display the input field
        //makeInput($label, $name, $type, $value = "", $space = false)

        makeInput("Title", "title", "text");
        echo "<p class = \"errorMssg\"></p>";

        makeInput("Description", "description", "text");
        echo "<p class = \"errorMssg\"></p>";

        makeInput("Category", "category", "text");
        echo "<p class = \"errorMssg\"></p>";

        

        makeInput("Name", "name", "text");
        echo "<p class = \"errorMssg\"></p>";

        ?>

        <div class="input-wrapper">
            <input type="file" id="fileInput" name="image[]" multiple class="opacity-0" />
            <div id="thumb-output" class="grid grid-cols-3 gap-2"></div>
            <div class="bg-black text-white rounded p-2 cursor-pointer mt-5" id="showFiles">Show Files</div>
        </div>
        <div class="input-wrapper">
            <input style="width: 750px;" type="submit" name="post" value="Submit the Post">
        </div>


    </form>
</section>

<script src="../js/postForm.js"></script>
<?php
require "../components/footer.php";
?>