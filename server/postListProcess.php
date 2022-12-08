<?php

include_once "./helper/postHelper.php";

$filterResult = getPostsList($_POST['filter']);

echo $filterResult;