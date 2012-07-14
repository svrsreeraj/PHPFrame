function closeIt()
	{
		$.unblockUI();
	}
function voteIt(msg)
	{
		if(msg)
			{
				document.getElementById("id_vote_div").innerHTML	=	msg;
			}

		$.blockUI({ message: $("#pop_up2"),		
		cursor	:	'default',
			css: { 
			top:  ($(window).height() - $("#pop_up2").height()) /2 + 'px', 
			left: ($(window).width() - $("#pop_up2").width()) /2 + 'px',
			border	:	"0",
			cursor	:	"default"
		}}); 																			
		$(".blockOverlay").css("cursor","default");	
	}
function markIt()
	{
		var id			=	$("a#votecheck").attr("rel");
		/*var where_to	=	confirm("Are you sure want to vote this deal?");
		if (where_to	==	true)
			{*/
				$.ajax({
						   type	: 	"POST",
						   url	: 	Root_Url_for_JS+"votePopup.php", 
						   data	:	"actionvar=AddVote&deal="+id,
						   dataType: "html",
						   success: function(msg){
							   if(msg!=0)
									{
										voteIt(msg);
									}
								else
									{
										$.unblockUI();
									}
							}
					 });
		/*	}*/
			
	}
