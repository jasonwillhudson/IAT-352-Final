<?php

include_once "./helper/postHelper.php";


if (!empty($_POST['action'])) {

    //execute get filter result function
    if ($_POST['action'] == 'filterResult') {
        $filterResult = getPostsList($_POST['filter']);
        echo $filterResult;
    }

    //execute add to collection function
    else if ($_POST['action'] == 'addCollection') {
        $result = addToCollection($_POST['postID']);
        echo $result;
    }

    //execute remove from collection function
    else if ($_POST['action'] == 'removeCollection') {
        $result = removeFromCollection($_POST['postID']);
        echo $result;
    }

    //remove post from collection and get new page elements
    if ($_POST['action'] == 'removeFromPage') {
        $result = removeFromCollection($_POST['postID']);
        if($result=='success')
        $result = getCollectionList();
        echo $result;
    }

    //remove my post
    if ($_POST['action'] == 'removeMyPost') {
        removePost($_POST['postID']);
        $result = getMyPost();
        echo $result;
    }


} else {
    echo 'error: no command detected';
}
