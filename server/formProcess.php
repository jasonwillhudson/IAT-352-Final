<?php


// this line refers to the code that has db setup in it
include_once('helper/db.php');

//connect to database
$db =  connectToDB('localhost', 'root', '', 'svap');

//user's email address
$email = "jasonwillhudson@gmail.com";





//======================= Add the basic information to the Post table ===============//

//Write a query which add the basic information to post table
$query = "INSERT INTO post (email, title, description, category, value) VALUES (?,?,?,?,?)";

//send the query to database and execute the query
$stmt = $db->prepare($query);
$stmt->bind_param('ssssd', $email, $_POST['title'], $_POST['description'], $_POST['category'], $_POST['worthValue']);
$stmt->execute();

//get the id of the row just inserted
$post_id = $stmt->insert_id;

//send the error message if failed to upload
if (empty($post_id) || $post_id == 0) {
    echo "failed to upload the post";
    exit();
}




//======================= Store the image of the Post to Server Storage and Add path to Database table===============//
//store the image into storage folder and get an array of path
$path = storeImage($post_id);
//Write a query which add the category information to want_to_trade table
$query = "INSERT INTO image_path (email, post_id, image_path) VALUES (?,?,?)";

//add all of selected category user want to trade with to the database
foreach ($path as $image_path) {
    $stmt = $db->prepare($query);
    $stmt->bind_param('sss', $email, $post_id, $image_path);
    $stmt->execute();
}






//======================= Add the category this post want to trade with to the table===============//

//Write a query which add the category information to want_to_trade table
$query = "INSERT INTO want_to_trade (email, post_id, category) VALUES (?,?,?)";

//add all of selected category user want to trade with to the database
foreach ($_POST['tradeCategory'] as $category) {
    $stmt = $db->prepare($query);
    $stmt->bind_param('sss', $email, $post_id, $category);
    $stmt->execute();
}



echo "success";
exit();



//==============================================  HELPER Functions  ================//
//
//stores all the images for the post and return the file path
function storeImage($postID)
{
    // Count total files
    $countfiles = count($_FILES['files']['name']);

    //use the user email and post id as the folder name
    $folderName = "jasonwillhudson@gmail.com" . "/" . $postID;

    // Upload Location
    $upload_location = "imgStorage/" . $folderName;

    // To store uploaded files path
    $files_arr = array();

    //Check if folder existed, if not then create one
    if (!file_exists($upload_location)) {
        mkdir($upload_location, 0777, true);
    }

    // Loop all files
    for ($index = 0; $index < $countfiles; $index++) {

        // File name
        $filename = $_FILES['files']['name'][$index];
        //Extension of the file
        $extension = explode(".", $filename);
        // File path
        $path = $upload_location . "/" . $index . "." . end($extension);


        // Upload file
        if (move_uploaded_file($_FILES['files']['tmp_name'][$index], $path)) {
            $files_arr[] = $path;
        }
    }


    //return the array of file path
    return $files_arr;
}
