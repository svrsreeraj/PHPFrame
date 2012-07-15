function checkNumber(val)
	{
		var x		=	val
		var anum	=	/(^\d+$)|(^\d+\.\d+$)/
		if (anum.test(x))
		testresult	=	true
		else{
		alert("Please input a valid number!")
		testresult	=	false
		}
		return (testresult)
	}
function urlCheck(str) 
	{
		var v 		= 	new RegExp(); 
		v.compile("^[A-Za-z]+://[A-Za-z0-9-_]+\\.[A-Za-z0-9-_%&\?\/.=]+$");
		if (!v.test(str)) 
		{
			return false;
		}
		return true;
	}

function emptyCheck(val)
	{
		var len=val.length;
		
		if(len!=0) 
		{
			return true;
		}
		return false;
	}
function emailCheck(val)
	{
		var str 	= 	new String(val);
		var isOK 	= 	true;
		rExp 		= 	/[!\"£$%\^&*()-+=<>,\'#?\\|¬`\/\[\]]/
		if( rExp.test(str) )
			isOK 	= 	false;
		if( str.indexOf('.') == -1 || str.indexOf('@') == -1 )
			isOK 	= 	false;
		if( str.slice(str.lastIndexOf('.')+1,str.length).length < 2 )
			isOK 	= 	false;
		if( str.slice(0,str.indexOf('@')).length < 1 )
			isOK 	= 	false;
		if( str.slice(str.indexOf('@')+1,str.lastIndexOf('.')).length < 1 )
			isOK 	= 	false;
		if(!isOK )
		return false;
		return true;	
	}
function newValidate(formElement)
	{
		$(".val_error_alert").remove();	
		var	errorStat	=	false;
		$(formElement).find('[valtype]').each(function(index) 
			{
				if($(this).attr("disabled") != true)
				{
					var eName		=	$(this).attr('name');
					var eId			=	$(this).attr('id');
					var input		=	$(this).val();
					var eValType	=	$(this).attr('valtype');
					var msgs		=	eValType.split("|");
					var thisvar		=	this;
					$.each(msgs,function(key,value)
						{
							var msgsNew		=	value.split("-");
							var fnToexec	=	msgsNew[0];
							var errMsg		=	msgsNew[1];
							errMsg			=	errMsg.charAt(0).toUpperCase() + errMsg.slice(1);
							var	rtString	=	eval (fnToexec+"(input)");
							if(rtString	==	false)
								{
									errorStat	=	true;
									$(thisvar).first().parent().append("<span class='val_error_alert'>&nbsp;"+errMsg+"</span>");
									
									return false;
								}	
								
						})
				}
			});
			
		$(".val_error_alert").hide().fadeIn('slow');
		if(errorStat	==	false)	return true;
		else						return false;
	}
	


$("[valcheck='true']").click(function()
	{
		return newValidate($("[valcheck='true']").parents('form:first'));
						
	});
$('[valtype]').blur(function()
		{
			$(".val_error_alert").remove();	
			var	errorStat	=	false;
			var input		=	$(this).val();
			var fullMsg		=	$(this).attr('valtype');
			var msg			=	fullMsg.split("|");	
			var element		=	this;
			$.each(msg,function(key,value)
				{
					var newmsg			=	value.split("-");
					var executemsg		=	newmsg[0];
					var errormsg		=	newmsg[1];
					errormsg			=	errormsg.charAt(0).toUpperCase() + errormsg.slice(1);
					var	rtString		=	eval (executemsg+"(input)");
					if(rtString == false)
						{	
							$(element).parent().append("<span class='val_error_alert'>&nbsp;"+errormsg+"</span>");
							return false;
						}
				})
			$(".val_error_alert").hide().fadeIn('slow').fadeOut(3000);
			if(errorStat	==	false)	return true;
			else						return false;
		});
	