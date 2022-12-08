<?php

include_once "db.php";


function getDetail($detail)
{

    //connect to database
    $db =  connectToDB('localhost', 'root', '', 'svap');

    //array storing sql where clouse
    // $sql = array();

    //array for storing the bind parameters
    // $parameters = array();

    //add all the filtered catecory tag to the array
    if ($detail) {
        $sql = array_fill(0, count($detail), " post.post_id = ? ");
        $parameters = $detail;
    }

    //write a query to select the unique post data we need from joined tables
    $query_str = "SELECT post.post_id, post.title, post.description, post.date, post.email, post.category,post.value, image_path.image_path,member.name, member.city, want_to_trade.category, member.phone
    FROM post
    INNER JOIN image_path ON post.post_id = image_path.post_id
    INNER JOIN member ON post.email = member.email
    INNER JOIN want_to_trade ON post.post_id = want_to_trade.post_id
    WHERE post.post_id = ?"; 


    //echo $query;
    //send the query to database to execute and return the result
    $stmt = $db->prepare($query_str);
    $stmt->bind_param('s',$code);
    $stmt->execute();

    $stmt->bind_result($postId,$postTitle,$postDesctib,$postDate,$postEmail,$postCategory,$postValue,$image,$name, $city, $want_trade, $phone);

    //make each of chat information to html element and send them to ajax to render on the page
    $result = '<div class="post-list">';
    $pathStart = '../../server/'; //the path to reach the folder
    while ($stmt->fetch()) {
        $result .= '<div class="post-wrap"><a>';
        $result .= '<img class="post-image" src = "'.$pathStart.$image.'" alt="post image"/>';
        $result .= '<p class="post-title">' . $postTitle . '</p>';
        $result .= '</a></div>';
    }

    $result .= '</div>';


    return $result;
}
