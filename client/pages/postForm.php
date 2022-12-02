<?php
require "../components/header.php";

//import web elements generation helper
require "../components/elements.php";
?>

<section style="display:flex; flex-direction: column; justify-content:center;">

    <form method="post" style="width: 100%; margin:auto; padding:25px;">

        <h1>Create A New Post</h1>

        <?php
        //display the input field
        //makeInput($label, $name, $type, $value = "", $space = false)

        makeInput("Title", "title", "text");
        echo "<p class = \"errorMssg\"></p>";

        makeInput("Description", "description", "textarea");
        echo "<p class = \"errorMssg\"></p>";

        $arr = array('TV' => 'tv', 'Casset' => 'casset', 'CD' => 'cd', 'DVD' => 'dvd', 'Blu-Ray' => 'blu-ray', 'Laser Disc' => 'laser-disc', 'Funko Pop' => 'funko-pop', 'Figure' => 'figure', 'Lego' => 'lego', 'Desktop' => 'desktop', 'Laptop' => 'laptop', 'Speaker' => 'speaker', 'Phone' => 'phone', 'Gaming Console' => 'game-console');
        createDropDown("Category", "category", $arr, ""); //drop down measurement

        makeInput("Value(CAD)", "value", "number");
        echo "<p class = \"errorMssg\"></p>";


        ?>

        <fieldset class="input-wrapper" style = "padding:15px;">
            <legend style="padding: 5px; margin-left: 10px;">Want to Trade With</legend>
            <?php createCheckBoxes('tradeCategory', $arr) ?>
        </fieldset>

        </br>

        <fieldset class="input-wrapper" style = "padding:15px;">
            <legend style="padding: 5px; margin-left: 10px;">Upload Image</legend>
            <input style= "margin-bottom: 25px;" type="file" id="fileInput" name="image[]" accept="image/*"/>

            <div id="thumb-output"></div>
            <div id="showFiles">show files</div>
        </fieldset>

        </br>

        <div class="input-wrapper">
            <input style="width: 750px;" type="submit" name="post" value="Submit the Post">
        </div>


    </form>
</section>

<script src="../js/formImageDisplay.js"></script>
<?php
require "../components/footer.php";
?>