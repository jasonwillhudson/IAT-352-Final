<?php

//Create a input filed and display on the page
function makeInput($label, $name, $type, $value = "")
{

    strval($value);
    //create a label for the input
    echo "<div class='input-wrapper'><label>$label</label>";

    //display text area if type is textarea
    if ($type == "textarea")
        echo "<textarea id=$name name=$name>$value</textarea></div>";
    else //display the input with the type user chose
        echo "<input type=$type id=$name name=$name value=\"$value\"></input></div>";
}
