<?php

session_start();


//import web elements generation helper
require "../components/elements.php";

//initialize the page (detect login status and https application, and redirect)
if(!initialize(true, false)) exit();

//import header elements
require "../components/header.php";
?>

<section style="display:flex; flex-direction: column; justify-content:center;">

    <form method="post" style="width: 100%; margin:auto; padding:25px;">

        <h1>Create A New Post</h1>

        <?php

        //display text input field
        makeInput("Title", "title", "text", true);

        //display description input field
        makeInput("Description", "description", "textarea", true);;

        //display category drop down menu
        $arr = array('TV' => 'tv', 'Casset' => 'casset', 'Collectible' => 'collectible','CD' => 'cd', 'DVD' => 'dvd', 'Blu-Ray' => 'blu-ray', 'Laser Disc' => 'laser-disc', 'Funko Pop' => 'funko-pop', 'Figure' => 'figure', 'Lego' => 'lego', 'Desktop' => 'desktop', 'Laptop' => 'laptop', 'Speaker' => 'speaker', 'Phone' => 'phone', 'Gaming Console' => 'game-console');
        createDropDown("Category", "category", $arr, ""); //drop down measurement

        //display value input field
        makeInput("Value(CAD)", "worthValue", "number", true);

        ?>

        <!---------- Check Box---------->
            <fieldset class="input-wrapper" style="padding:15px;">
                <legend style="padding: 5px; margin-left: 10px;">Want to Trade With</legend>
                <p id="checkErrMssg">please check at least one box</p>
                <?php createCheckBoxes('tradeCategory', $arr) ?>
            </fieldset>

            </br>

            <!---------- Image Input---------->
            <fieldset class="input-wrapper" style="padding:15px;">
                <legend style="padding: 5px; margin-left: 10px;">Upload Image</legend>
                <input style="margin-bottom: 25px;" type="file" id="fileInput" name="image[]" accept="image/*" required/>

                <div id="thumb-output"></div>
                <div id="showFiles">show files</div>
            </fieldset>

            </br>

            <!---------- Submit Button---------->
            <div class="input-wrapper">
                <input style="width: 750px;" type="submit" name="post" value="Submit the Post">
            </div>


    </form>
</section>

<script src="../js/formImageDisplay.js"></script>
<script src="../js/formProcess.js"></script>
<?php
require "../components/footer.php";
?>