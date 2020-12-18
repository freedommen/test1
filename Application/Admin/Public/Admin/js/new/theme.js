$(function(){
	//radio
	$('.jc-info p label').click(function(){
	    var radioId = $(this).attr('name');
	    $(this).attr('class', 'checked').siblings().removeAttr('class');
	    $('input[type="radio"]').removeAttr('checked') && $('#' + radioId).attr('checked', 'checked');
	});
})