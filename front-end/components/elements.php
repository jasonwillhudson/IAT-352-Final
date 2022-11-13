<?php

//Create a input filed and display on the page
function makeInput($label, $name, $type, $value = "")
{

    strval($value);
    //create a label
    echo "<div class='input-wrapper'><label>$label</label>";

    //use text area if type is textarea
    if ($type == "textarea")
        echo "<textarea name=$name>$value</textarea></div>";
    else //use the type user entered
        echo "<input type=$type name=$name value=\"$value\"></input></div>";
}
