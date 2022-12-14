<?php
include_once "db.php";


class Chat
{

	//table to use for accessing data
	private $chatTable = 'message';
	private $chatUsersTable = 'member';

	private $dbConnect = false;

	//initialize, connect to database and handle errors
	public function __construct()
	{
		if (!$this->dbConnect) {
			$conn =  connectToDB('localhost', 'root', '', 'svap');;
			if ($conn->connect_error) {
				die("Error failed to connect to MySQL: " . $conn->connect_error);
			} else {
				$this->dbConnect = $conn;
			}
		}
	}

	//get the data from databse
	private function getData($sqlQuery)
	{
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		if (!$result) {
			die('Error in query: ' . mysqli_error($this->dbConnect));
		}
		$data = array();
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			$data[] = $row;
		}
		return $data;
	}

	//get the row count from the result
	private function getNumRows($sqlQuery)
	{
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		if (!$result) {
			die('Error in query: ' . mysqli_error($this->dbConnect));
		}
		$numRows = mysqli_num_rows($result);
		return $numRows;
	}

	//get the list of user this user has chat with
	public function chatUsers($userid)
	{
		$sqlQuery = "SELECT sender_email AS sender_email FROM message 
		WHERE receiver_email = '$userid' GROUP BY sender_email 
		UNION 
		SELECT receiver_email AS sender_email FROM message 
		WHERE sender_email = '$userid' GROUP BY receiver_email";

		return  $this->getData($sqlQuery);
	}

	//get users information such as name phone location and etc.
	public function getUserDetails($userid)
	{
		$sqlQuery = "
			SELECT * FROM " . $this->chatUsersTable . " 
			WHERE email = '$userid'";
		return  $this->getData($sqlQuery);
	}

	//Add the chat information into database
	public function insertChat($reciever_userid, $user_id, $chat_message)
	{
		$sqlInsert = "
			INSERT INTO " . $this->chatTable . " 
			(receiver_email, sender_email, content, status) 
			VALUES ('" . $reciever_userid . "', '" . $user_id . "', '" . $chat_message . "', '1')";
		$result = mysqli_query($this->dbConnect, $sqlInsert);

		//handle errors
		if (!$result) {
			return ('Error in query: ' . mysqli_error($this->dbConnect));
		} else {
			$conversation = $this->getUserChat($user_id, $reciever_userid);
			$data = array(
				"conversation" => $conversation
			);
			echo json_encode($data);
		}
	}

	//get user's coversation from the database
	public function getUserChat($from_user_id, $to_user_id)
	{

		$sqlQuery = "
			SELECT * FROM " . $this->chatTable . " 
			WHERE (sender_email = '" . $from_user_id . "' 
			AND receiver_email = '" . $to_user_id . "') 
			OR (sender_email = '" . $to_user_id . "' 
			AND receiver_email = '" . $from_user_id . "') 
			ORDER BY time_stamp ASC";
		$userChat = $this->getData($sqlQuery);
		$conversation = '<ul>';

		//make each of chat information to html element and send them to ajax to render on the page
		foreach ($userChat as $chat) {

			if ($chat["sender_email"] == $from_user_id) {
				$conversation .= '<li class="sent">';
				//$conversation .= '<img width="22px" height="22px" src="userpics/'.$fromUserAvatar.'" alt="" />';
			} else {
				$conversation .= '<li class="replies">';
				//$conversation .= '<img width="22px" height="22px" src="userpics/'.$toUserAvatar.'" alt="" />';
			}
			$conversation .= '<p>' . $chat["content"] . '</p>';
			$conversation .= '</li>';
		}
		$conversation .= '</ul>';

		// change all the unread message from input user to read	
		$sqlUpdate = "
			UPDATE " . $this->chatTable . " 
			SET status = '0' 
			WHERE sender_email = '" . $to_user_id . "' AND receiver_email = '" . $from_user_id . "' AND status = '1'";
		mysqli_query($this->dbConnect, $sqlUpdate);


		return $conversation;
	}


	// return the user's chat to show on the page
	public function showUserChat($from_user_id, $to_user_id)
	{
		$userDetails = $this->getUserDetails($to_user_id);
		$userSection = '';
		foreach ($userDetails as $user) {
			$userSection = '<p>' . $user['email'] . '</p>';
		}
		// get user conversation
		$conversation = $this->getUserChat($from_user_id, $to_user_id);

		$data = array(
			"userSection" => $userSection,
			"conversation" => $conversation
		);
		echo json_encode($data);
	}

	//count the unread message and return the result to ajax
	public function getUnreadMessageCount($senderUserid, $recieverUserid)
	{
		$sqlQuery = "
			SELECT * FROM " . $this->chatTable . "  
			WHERE sender_email = '$senderUserid' AND receiver_email = '$recieverUserid' AND status = '1'";
		$numRows = $this->getNumRows($sqlQuery);
		$output = '';
		if ($numRows > 0) {
			$output = $numRows;
		}
		return $output;
	}
}
