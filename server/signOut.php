<?php
    //start the session if no session existed
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

    session_destroy();
?>