
//Listing Color Changes
$(".listTable tr:even").addClass('listTableChangeColor');

//advanced Search Block Starts

$('#id_search_link').click(function () 
	{
		if($("#id_search_block:hidden").length>0)
			{
				$("#id_search_block:hidden").slideDown();
			}
		else
			{
				$("#id_search_block:visible").slideUp();
			}
	});

//advanced Search Block Ends

// Check All Areaa STARTS
$('#id_check_all').click(function () 
	{
		$("input[name=checkone\[\]]").attr('checked', this.checked);
		deleteButtonStatus();
	});
$("input[name=checkone\[\]]").change(function () 
	{
		deleteButtonStatus();
	});
function deleteButtonStatus()
	{
		if($("input[name=checkone\[\]]:checked").length	>	0)
			{
				$(".cls_btn_hide").fadeIn("slow");
				if($("input[name=checkone\[\]]:checked").length	==	$("input[name=checkone\[\]]").length)
					{
						$('#id_check_all').attr('checked', true);
					}
				else
					{
						$('#id_check_all').attr('checked', false);
					}
			}
		else
			{
				$('#id_check_all').attr('checked', false);
				$(".cls_btn_hide").fadeOut("slow");
			}
	}
$('.cls_btn_hide').click(function () 
		{
			var msg = $(this).attr("msg");
			if(typeof(msg)	==	"undefined")	msg	=	"Are you sure you want to delete these records?";
			thisvar	=	this;
			jConfirm(msg, 'Confirmation Dialog', 
			function(stat) 
				{
					if(stat==true)	
						{
							$("<input type='hidden' name='"+$(thisvar).attr("name")+"' value='"+$(thisvar).val()+"'>").appendTo($(thisvar).parents('form:first'));
							$(thisvar).parents('form:first').submit();	
						}	
				});
			return false;
		});		
$(".cls_btn_hide").hide();
//Check All Areaa ENDS

//number only function
jQuery.fn.ForceNumericOnly =
function()
{
    return this.each(function()
	    {
	        $(this).keydown(function(e)
	        {
	            if(e.shiftKey)
					{
						
						return false;
					}
				var key = e.charCode || e.keyCode || 0;
				
						return (
									key == 17 	|| //control 
									key == 8 	|| //backspace
									key == 9 	|| //horizontal tab
									key == 46 	|| //point
									key == 109 	|| //aloow -
									key == 110 	|| 
									key == 190 	||
									key == 67 	||//ALOWING CNTL+C
									key == 86 	||//ALLOWING CNTL+V
									key == 88 	||//ALLOWING CNTL+x
									(key >= 37 && key <= 40) ||
									(key >= 48 && key <= 57) ||//numbers
									(key >= 96 && key <= 105)
								);
					
			})
	    })
};

(function($)
	{
		$.fn.alphanumeric=function(p)
			{
				p	=	$.extend({ichars:"!@#$%^&*()+=[]\\\';,/{}|\":<>?~`.- ",nchars:"",allow:""},p);
		
				return this.each(function()
					{
							if(p.nocaps)p.nchars+="ABCDEFGHIJKLMNOPQRSTUVWXYZ";
							if(p.allcaps)p.nchars+="abcdefghijklmnopqrstuvwxyz";
							s=p.allow.split('');
							for(i=0;i<s.length;i++)if(p.ichars.indexOf(s[i])!=-1)s[i]="\\"+s[i];
							p.allow=s.join('|');
							var reg=new RegExp(p.allow,'gi');
							var ch=p.ichars+p.nchars;
							ch=ch.replace(reg,'');
							$(this).keypress(function(e)
								{
									if(!e.charCode)k=String.fromCharCode(e.which);
									else k=String.fromCharCode(e.charCode);
									if(ch.indexOf(k)!=-1)e.preventDefault();
									if(e.ctrlKey&&k=='v')e.preventDefault();
								});
							$(this).bind('contextmenu',function()
								{
									return true;
								}
							)
					}
			)};
		$.fn.numeric=function(p)
			{
				var az="abcdefghijklmnopqrstuVwxyz";
				az+=az.toUpperCase();
				p=$.extend({nchars:az},p);
				return this.each(function()
					{
						$(this).alphanumeric(p)
					}
				)
			};
		$.fn.alpha=function(p)
			{
				var nm="1234567890";
				p=$.extend({nchars:nm},p);
				return this.each(function()
					{
						$(this).alphanumeric(p)
					})
			};
}
)(jQuery);
//applying number only functionality to all numberOnly classes
$(".nummberOnly").ForceNumericOnly();
//appy to all fields that can hold alfa-numeric characters
$('.alphaNumeric').alphanumeric();
//apply to all fields that can hold alfa numeric characters exeptions  ". ,space,()-"
$('.validateText').alphanumeric({allow:"., -()/&$?"});
//no capital letter letters 
$('.lowerCaseAlfa').alpha({nocaps:true});
// no small letters
$('.upperCaseAlfa').alpha({allcaps:true});
// for emailid
$('.emailValidate').alphanumeric({allow:"-.,@,_"});
// fro zipcode
$('.validatezip').alphanumeric({allow:"-"});

