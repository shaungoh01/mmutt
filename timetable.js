$(document).ready(function(){
	$("div.gray").hide();
	$("div.pop").hide();
	$("div.gray1").show();
	$("div.pop1").show();

	$("div.sync_google_btn").click(function(){
		$("div.gray").fadeIn();
		$("div.pop").fadeIn();
	});
	

	$("div.gray").click(function(){
		$("div.pop").fadeOut();
		$("div.gray").fadeOut();
	});

	$("div.pop").click(function(){
		$("div.gray").show();
		$("div.pop").show();
	});

	$("button.gray1_close").click(function(){
		$("div.pop1").fadeOut();
		$("div.gray1").fadeOut();
	});
});