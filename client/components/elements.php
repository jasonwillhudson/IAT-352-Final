<?php

//Create a input filed and display on the page
function makeInput($label, $name, $type, $required = false, $value = "")
{

   strval($value);
   //create a label for the input
   echo "<div class='input-wrapper'><label>$label</label>";

   $requireOption = ($required ? " required  " : "");
   $decimalOption = ($type == "number" ? "  step=\".01\"  " : "");
   //display text area if type is textarea
   if ($type == "textarea")
      echo "<textarea id=\"$name\" name=\"$name\" " . ($required ? " required" : "") . ">$value</textarea></div>";
   else //display the input with the type user chose
      echo "<input type=\"$type\" id=\"$name\" name=\"$name\" value=\"$value\" " . $requireOption . $decimalOption . "/></div>";
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
            echo "<input type=\"checkbox\" name=\"$name\" value=\"$v\" checked>";
            $ischecked = true; //checked the element already
         }
      }

      echo "<label for=\"$v\">$v</label>"; //label for the radio button

   }
}





//create dropdown menu
function createDropDown($label, $name, $var, $select)
{
   echo "<div class='input-wrapper'><label>$label</label>";
   echo "<select name=\"$name\" id=\"$name\">";
   //create drop down options based on key and value in array
   foreach ($var as $key => $value) {
      if (empty($select)) echo "<option value=\"$value\">$key</option>";
      else if ($select == $value) echo "<option value=\"$value\" selected=\"selected\">$key</option>";
      else echo "<option value=\"$value\">$key</option>";
   }
   echo "</select></div>";
   echo "</br>";
}




//create check box
function createCheckBoxes($name, $var)
{
   echo "<div class='sub-filter' style=\"display: flex; flex-wrap: wrap;\">";
   //create drop down options based on key and value in array
   foreach ($var as $key => $value) {
      echo "<div><input type='checkbox' style=\"margin: 12px;\" name=\"$name\" value=\"$value\">$key&nbsp;&nbsp;</div>";
   }
   echo "</div>";
}


//initialize the web
function initialize($isLoginRequired, $requireHttps = false)
{


   //If this page is for member only, direct user to login page if user not log in
   if ($isLoginRequired && empty($_SESSION['email'])) {

      //store the url before direct to login page
      $_SESSION['url'] = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
      header("location: login.php");
      return false;

   }
   
   //remove url variable if user already login
   if(!empty($_SESSION['email'])) $_SESSION['url'] = "";

   //Direct to http or https 
   if ($requireHttps && $_SERVER["HTTPS"] != "on") {
      header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
      return false;
   } else if (!$requireHttps && !empty($_SERVER["HTTPS"])) {
      header("Location: http://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
      return false;
   } else return true;
}
