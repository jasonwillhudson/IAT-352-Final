<?php


//import web elements generation helper
include_once "../components/elements.php";

//initialize the page (detect login status and https application, and redirect)
if (!initialize(true, false)) exit();

//import header elements
require "../components/header.php";

//import navbar
require "../components/nav.php";

//Detect if any chat is initiated
$currentSession = "";
?>

<link rel="stylesheet" href="../css/chat.css">

<!-------------------Display the contact list----------------->
<div class="container">
    <div id="contacts">
        <?php
        echo '<ul>';

        //import chat class
        include('../../server/helper/Chat.php');

        //create a new chat object
        $chat = new Chat();

        //get the chat users list
        $chatUsers = $chat->chatUsers($_SESSION['email']);

        foreach ($chatUsers as $user) {

            //prevent showing log in user as a contact 
            if($user['sender_email'] == $_SESSION['email']) continue;

            
            //display the contact side panel elements
            echo '<li id="' . $user['sender_email'] . '" class="contact '.($currentSession == $user['sender_email'] ? "active" : "").'" data-touserid="' . $user['sender_email'] . '" data-tousername="' . $user['sender_email'] . '">';

            $unreadCount = $chat->getUnreadMessageCount($user['sender_email'], $_SESSION['email']);
            $username = $chat->getUserDetails($user['sender_email']);

            //display user name
            foreach($username as $name){echo '<p class="name">' . $name['name']  .'</p>';}
            
            //display the unread message count
            if(!empty($unreadCount)) echo '<span id="unread_' . str_replace(array("@", "."), array("", ""), $user['sender_email']) . '" class="unread">' . $unreadCount . '</span>';
 
            echo '</li>';
        }
        echo '</ul>';


        ?>
    </div>



 <!---------------------------------Message Section------------->
    <div class="message-wrapper">


        <!---------------------------------Display Conversasion------------->
        <div class="messages" id="conversation">
            
            <?php
            echo $chat->getUserChat($_SESSION['email'], $currentSession);
            ?>
        </div>


        <!---------------------------------Input box for sending the message------------->
        <div class="message-input" id="replySection" style= <?php echo empty($currentSession) ?  "\"display: none;\"'" : "\"\"";?>>

            <input type="text" class="chatMessage" id="chatMessage" placeholder="Write your message" />
            <button class="submit chatButton" id="chatButton">Send</button>
            <span id="chatid"></span>
            
        </div>
    </div>
    <script src="../js/chatProcess.js"></script>
    <?php
    require "../components/footer.php";

    ?>