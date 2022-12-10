
$(document).ready(function(){

    //keep update user list and unread message 
	setInterval(function(){
		//updateUserList();	
		updateUnreadMessageCount();	
	}, 1000);	

    //keep update user chat
	setInterval(function(){
		updateUserChat();			
	}, 1000);
	$(".messages").animate({ 
		scrollTop: $(document).height() 
	}, "fast");


    //active the user chat when click on the user name
	$('.contact').on('click', function(){	
		$('.contact').removeClass('active');
		$(this).addClass('active');
		var to_user_id = $(this).data('touserid');
		showUserChat(to_user_id);
		$("#chatid").html(to_user_id.toString());
        $(".unread").hide();
        $(".message-input").css("display", "flex");
        $(".messages").animate({ scrollTop: $('.messages ul').height() }, "fast");
	});	

    //send the message to the user
	$(document).on("click", '.submit', function(event) { 
		var to_user_id = $("#chatid").text();
		sendMessage(to_user_id);
	});
		
}); 



//========================================== Helper --------------------------//

//send request to update the contact list panel
function updateUserList() {
	$.ajax({
		url:"../../server/chat/chat_action.php",
		method:"POST",
		dataType: "json",
		data:{action:'update_user_list'},
		success:function(response){			
		}
	});
}

//send request to add the message to database
function sendMessage(to_user_id) {
	message = $(".message-input input").val();
	$('.message-input input').val('');
	if($.trim(message) == '') {
		return false;
	}
	$.ajax({
		url:"../../server/chat/chat_action.php",
		method:"POST",
		data:{to_user_id:to_user_id, chat_message:message, action:'insert_chat'},
		dataType: "json",
		success:function(response) {
            
            //update the chat status
			var resp = JSON.parse(response);			
			$('#conversation').html(resp.conversation);				
			$(".messages").animate({ scrollTop: $('.messages ul').height() }, "fast");
		}
	});	
}

//get the chat messages and display the user chat to the page
function showUserChat(to_user_id){
    console.log("execute showuserchat..." + to_user_id);
	$.ajax({
		url:"../../server/chat/chat_action.php",
		method:"POST",
		data:{to_user_id:to_user_id, action:'show_chat'},
		dataType: "json",
		success:function(response){
            //console.log("showuserchat" + JSON.stringify(response));
			//$('#userSection').html(response.userSection);
			$('#conversation').html(response.conversation);	
			$('#unread_'+to_user_id.toString().replace(/@|./g,'')).html('');
		},
        error: function(response){console.log("error "+ JSON.stringify(response));} 
	});
}

//update the current chat content
function updateUserChat() {
	$('li.contact.active').each(function(){
		var to_user_id = $(this).attr('data-touserid');
		$.ajax({
			url:"../../server/chat/chat_action.php",
			method:"POST",
			data:{to_user_id:to_user_id, action:'update_user_chat'},
			dataType: "json",
			success:function(response){	
                //console.log("updateuserchat" + JSON.stringify(response));			
				$('#conversation').html(response.conversation);			
			}
		});
	});
}

//keep updating the unread message status in the side chanel
function updateUnreadMessageCount() {
	$('li.contact').each(function(){
		if(!$(this).hasClass('active')) {
			var to_user_id = $(this).attr('data-touserid');
			$.ajax({
				url:"../../server/chat/chat_action.php",
				method:"POST",
				data:{to_user_id:to_user_id, action:'update_unread_message'},
				dataType: "json",
				success:function(response){	
                    //console.log("unread" + response.count);	
					if(response.count) {
						$('#unread_'+to_user_id.toString().replace(/@|./g,'')).html(response.count);	
					}					
				},
                error: 
                function(response){	
                    console.log("error" + JSON.stringify(response));	
					
				}
			});
		}
	});
}
