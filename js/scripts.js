$(document).ready(function() {

    $('select').material_select();

    $('.modal-trigger').leanModal();

    $('#textarea1').val();
 	$('#textarea1').trigger('autoresize');

    $("#drop-menu").hide();
    $("#req-success").hide();

    $("#drop").click(function(){
	    $("#drop-menu").toggle();
	});

    // $("#add").click(function(){
    // 	var domain_form = '<div class="input-field col s12 req"><br><select><option value="" disabled selected>Choose your option</option><option value="1">United States</option><option value="2">Option 2</option><option value="3">Option 3</option></select><label>Domain</label></div>';
    // 	$(".req").append(domain_form);                                
    // });

	

	$('#req-submit').change(function() {
	    if($(this).val()===""){ 
	        console.log('empty');    
	    }
	    else{
	    	$("#req").click(function(){
		    	$("#req-success").show();
			});
	    }
	});

	$('#assessment-q').on('change', function() {
    	$('#q-sub').prop('disabled', false);
    	$('#q-sub').parent().removeClass("disabled");
	});

	$('#q-sub').on('click', function() {
	    var val = $('#assessment-q').val();
	});

	$('#domain_select').on('change', function() {
    	var new_href;
    	var dom_id = $(this).val();
    	var client_id = $('#client_select').val();
  		new_href = $('#req').attr('href') + dom_id + "&c_id=" + client_id;
  		$('#req').attr('href', new_href);
	});

	$('#client_select').on('change', function() {
		var new_href;
		var client_id = $('#client_select').val();
		new_href = 'dashboard_int.php?c_id=' + client_id;
		location.href = new_href;
	});

 });

