<?php

include_once "db.php";


function getPostsList($filter)
{

    //connect to database
    $db =  connectToDB('localhost', 'root', '', 'svap');

    //array storing sql where clouse
    $sql = array();

    //array for storing the bind parameters
    $parameters = array();

    //add all the filtered catecory tag to the array
    if ($filter) {
        $sql = array_fill(0, count($filter), " post.category = ? ");
        $parameters = $filter;
    }

    //write a query to select the unique post data we need from joined tables
    $query = "SELECT MAX(post.title), MAX(image_path.image_path), post.post_id, MAX(member.name) FROM post  
                INNER JOIN image_path ON post.post_id = image_path.post_id
                INNER JOIN member ON member.email = post.email ";

    //add where clause to the sql query
    if ($sql) {
        $clouse = implode(' OR ', $sql);
        $query .= ' WHERE ' . $clouse;
    }

    //add group by clause to the sql query
    $query .= " GROUP BY post.post_id ";

    //echo $query;
    //send the query to database to execute and return the result
    $stmt = $db->prepare($query);
    if ($parameters) {
        $stmt->bind_param(str_repeat('s', count($filter)), ...$parameters);
    }
    $stmt->execute();
    $stmt->bind_result($title, $imagePath, $postID, $username);

    //make each of chat information to html element and send them to ajax to render on the page
    $result = '<div class="post-list">';
    $pathStart = '../../server/'; //the path to reach the folder
    while ($stmt->fetch()) {
        $result .= '<div class="post-wrap">';
        $result .= '<img class="post-image" src = "'.$pathStart.$imagePath.'" alt="post image"/>';
        $result .= '<p class="post-title">' . $title . '</p>';
        $result .= '</div>';
    }

    $result .= '</div>';


    return $result;
}
