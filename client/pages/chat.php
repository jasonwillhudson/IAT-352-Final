<?php
session_start();

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
if (!empty($_GET['contact_email'])) $currentSession = trim($_GET['contact_email']);
?>

<link rel="stylesheet" href="../css/chat.css">

<!-------------------Display the contact list----------------->
<div class="container">
    <div id="contacts">
        <?php
        echo '<ul>';

        echo '<h2 class="contact-title">Contacts</h2>';
        //import chat class
        include('../../server/helper/Chat.php');

        //create a new chat object
        $chat = new Chat();

        //get the chat users list
        $chatUsers = $chat->chatUsers($_SESSION['email']);




        //=========if current session is not empty then active this user as the one to contact with=======
        if ($currentSession != "")
            echo '<li id="' . $currentSession . '" class="contact active' . '" data-touserid="' . $currentSession . '" data-tousername="' . $currentSession . '">';
        $contactName = $chat->getUserDetails($currentSession);
        
        
        //display user name
        foreach ($contactName as $name) {
            echo '<p class="name">' . $name['name']  . '</p>';
        }

        echo '</li>';


        //=====================display other contacts=================//
        foreach ($chatUsers as $user) {

            //prevent showing log in user as a contact 
            if ($user['sender_email'] == $_SESSION['email'] || $user['sender_email']==$currentSession) continue;


            //display the contact side panel elements
            echo '<li id="' . $user['sender_email'] . '" class="contact ' . '" data-touserid="' . $user['sender_email'] . '" data-tousername="' . $user['sender_email'] . '">';

            $unreadCount = $chat->getUnreadMessageCount($user['sender_email'], $_SESSION['email']);
            $username = $chat->getUserDetails($user['sender_email']);

            //display user name
            foreach ($username as $name) {
                echo '<p class="name">' . $name['name']  . '</p>';
            }

            //display the unread message count
            if (!empty($unreadCount)) echo '<span id="unread_' . str_replace(array("@", "."), array("", ""), $user['sender_email']) . '" class="unread">' . $unreadCount . '</span>';
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
        <div class="message-input" id="replySection" style=<?php echo empty($currentSession) ?  "\"display: none;\"'" : "\"\""; ?>>

            <input type="text" class="chatMessage" id="chatMessage" placeholder="Write your message" />
            <button class="submit chatButton" id="chatButton">Send</button>
            <span id="chatid"><?php echo $currentSession;?></span>

        </div>
    </div>

</div>
<script src="../js/chatProcess.js"></script>
<?php
require "../components/footer.php";

?>