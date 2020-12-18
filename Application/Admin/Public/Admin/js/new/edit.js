$(function(){
	$('.jc-info p label').on("click",function(){
	    var radioId = $(this).attr('name');
	    $(this).attr('class', 'checked').siblings("label").removeAttr('class');
	    $('input[type="radio"]').removeAttr('checked') && $('#' + radioId).attr('checked', 'checked');
		
		if ($(this).attr("id") == "wxz") {
			$(".preordertime .aaa").hide();
		} else if ($(this).attr("id") == "xz"){
			$(".preordertime .aaa").show();
		}

		if ($(this).attr("id") == "xyyg"){
			$(".multiple").show();
		}else if($(this).attr("id") == "yk-bxy"){
			$(".multiple").hide();
		}
	});
	//checkbox
	$('.jc-info div label').on("click",function(){
	    var checkboxId = $(this).attr('name');
	    $(this).toggleClass('checked');
	    $('#' + checkboxId).attr('checked');
	});

	//底部按钮
	$("main p.submit input[type='button']").click(function(){
		$("main p.submit input[type='button']").removeClass("on");
		$(this).addClass("on");
	})
		
})