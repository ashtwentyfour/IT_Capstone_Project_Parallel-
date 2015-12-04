jQuery(document).ready(function ($) {

	$("#login-form").hide();

	$("#signup").click(function(){
	    $("#login-form").hide();
	    $("#signup-form").show();
	});
	$("#login").click(function(){
		$("#signup-form").hide();
	    $("#login-form").show();
	});

});