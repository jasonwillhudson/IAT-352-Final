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
        echo "</br>";
}

//Create filters for user to choose types of goods
function createFilter($name, $value, $var = '')
{
   $ischecked = false; // not checked the first element yet
   foreach ($value as $v) {

      //if no variable defined for audio button
      if (empty($var)) {
         if ($ischecked) echo "<input type=\"checkbox\" name=$name value=$v>";
         else {
            echo "<input type=\"checkbox\" name=$name value=$v checked>";
            $ischecked = true; //checked the element already
         }
      } else {
         if ($ischecked || $var != $v) echo "<input type=\"checkbox\" name=$name value=$v>"; //if not checked or values of variables not equal
         else {
            echo "<input type=\"checkbox\" name=$name value=$v checked>";
            $ischecked = true; //checked the element already
         }
      }

      echo "<label for=$v>$v</label>"; //label for the radio button

   }
}


//create dropdown menu
function createDropDown($label, $name, $var, $select)
{
   echo "<div class='input-wrapper'><label>$label</label>";
   echo "<select name=$name>";
   //create drop down options based on key and value in array
   foreach ($var as $key => $value){
      if(empty($select)) echo "<option value=\"$key\">$value</option>";
      else if($select==$key) echo "<option value=\"$key\" selected=\"selected\">$value</option>";
      else echo "<option value=\"$key\">$value</option>";
   }
   echo "</select></div>";
}
