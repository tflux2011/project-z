var ErrorChecker = 0;
 var flag = 0;
 var allcheckBox = [];
 var friendsGroup = [];
 var inputGroup = '';
 const inputShareGroups = jQuery(".friendsShareGroup");
 var excludes = [];

function copyToClipboard(element, id) {
  var $temp = jQuery("<input>");
  jQuery("body").append($temp);
  $temp.val(jQuery(element).text()).select();
  document.execCommand("copy");
  $temp.remove();
  jQuery('.p'+id).tooltip('enable').tooltip('show');
  
}

function copy2Clipboard(element, notification){
  var $temp = jQuery("<input>");
  jQuery("body").append($temp);
  $temp.val(jQuery(element).text()).select();
  document.execCommand("copy");
  $temp.remove();
  jQuery(notification).tooltip('enable').tooltip('show');
  
}


jQuery( document ).ready( function( $ ) {
	feather.replace();
	$(".spinner").hide();
	$("#co-registrant").hide();
	jQuery('.p').tooltip('disable');
	$("#registry-co-registrants").change(function(){
		const coregistrant_res = $("#registry-co-registrants").val();
		if(coregistrant_res == 1 ){
			$("#co-registrant").show('slow');
		}else{
			$("#co-registrant").hide('slow');
		}
		
	});
    
    $('#publishRegistryModal').on('hidden.bs.modal', function (e) {
        window.location.reload();
    });
    
    $('[data-toggle="tooltip"]').tooltip();
    
    $("#btnCheckPassword").click(function(){
       const password = $("#password").val();
       const reg_id = $(this).data('registry');
       if(password === ''){
           $("#passwordErrorField").html("Please enter a valid password");
       }else{
           $("#passwordErrorField").html();
           $(".spinner").show();
           	$.ajax({
		    		url: ajax_url,
		    		type: 'post',
		    		data : {
		    			action: 'dbt_check_password',
		    			password: password,
		    			reg_id: reg_id
		    		
		    		},
		    	
		        success:function(response){
		        	let res = JSON.parse(response);
		        	$(".spinner").hide();
		        	if(res == 1 ){
		        	    $("#passwordErrorField").html();
		        		$("#registry_box").removeClass('d-none');
		        		$("#password_area").addClass('d-none');
		        	}else{
		        		//window.location.reload();
		        		$("#passwordErrorField").html("Password is wrong");
		        	}
		        }
			});
       }
    });

	$("#createRegistry").click(function(e){
	    e.preventDefault();
		const registryTitle = $("#registry_title").val();
		const registryBanner = $("#").val();
		const registryPrivacy = $("#registry-privacy").val();
		const registryCoRegistrantsCheck = $("#registry-co-registrants").val();
		
		const coRegistrantLastName = $("#registry-co-registrants_lastname").val(0);
		const coRegistrantFirstName = $("#registry-co-registrants_firstname").val(0);
		const coRegistrantEmail = $("#registry-co-registrants_email").val(0);
		
		const registry_event_type = $("#registry-event_type").val();
		const registry_event_date = $("#registry-event_date").val();
		const registry_event_location = $("#registry-event_location").val();
		const registry_event_message = $("#registry-event_message").val();
		const registry_author = $(this).data('author');
		const registry_cash_gift = $("#registry-cash_gift").val();
		
		const slider_check = $(this).data('slider');
	   
       if(registryPrivacy == 'passworded' ){
          var password =  $("#registry_password").val();
          var cpassword = $("#cregistry_password").val();
          if(password == '' || password != cpassword){
              flag = 1;
              
                $("#registryCPasswordErrHelpMssg").html('<span style="color:#ff0000">Password mismatch/empty field</span>');
                $("#registryPasswordErrHelpMssg").html('<span style="color:#ff0000">Password mismatch/empty field</span>');
          }else{
              $("#registryCPasswordErrHelpMssg").html();
                $("#registryPasswordErrHelpMssg").html();
          }
          
       }else{
           var password = '';
           flag = 0;
       }

		if( registryTitle == ''){
			$("#registryTitleErrHelpMssg").html("<span style='color:#ff0000'>Please enter a registry title</span>");
			$("#registry_title").focus();
		}else{
			$("#registryTitleErrHelpMssg").html("");
		}

		if( registryPrivacy == ''){
			$("#registryPrivacyErrHelpMssg").html("<span style='color:#ff0000'>Please select a Privacy setting</span>");
			$("#registry-privacy").focus();
		}else{
			$("#registryPrivacyErrHelpMssg").html("");
		}

		if( registryCoRegistrantsCheck == ''){
			$("#registryCoregistrantErrHelpMssg").html("<span style='color:#ff0000'>Please select an option</span>");
			$("#registry-co-registrants").focus();
		}else if (registryCoRegistrantsCheck == '0' ){
			ErrorChecker = 0;
		}else{
			$("#registryCoregistrantErrHelpMssg").html("");
			if(coRegistrantLastName == '' ){
				$("#registryCoregistrantLastNameErrHelpMssg").html("<span style='color:#ff0000'>Last Name is required</span>");
				$("#registry-co-registrants_lastname").focus();
				ErrorChecker++;
			}else{
				$("#registryCoregistrantLastNameErrHelpMssg").html("");
			}
			if(coRegistrantFirstName == '' ){
				$("#registryCoregistrantFirstNameErrHelpMssg").html("<span style='color:#ff0000'>First Name is required</span>");
				$("#registry-co-registrants_firstname").focus();
				ErrorChecker++;
			}else{
				$("#registryCoregistrantFirstNameErrHelpMssg").html("");
			}
			if(coRegistrantEmail == '' ){
				$("#registryCoregistrantEmailErrHelpMssg").html("<span style='color:#ff0000'>Email is required</span>");
				$("#registry-co-registrants_email").focus();
				ErrorChecker++;
			}else{
				$("#registryCoregistrantFirstNameErrHelpMssg").html("");
			}
		}

		if( registry_event_type == '' ){
			$("#registry-event_typeErrHelpMssg").html("<span style='color:#ff0000'>Please select an Event Type</span>");
			$("#registry-event_type").focus();
		}else{
			$("#registry-event_typeErrHelpMssg").html("");
		}

		if( registry_event_location == '' ){
			$("#registry-event_locationErrHelpMssg").html("<span style='color:#ff0000'>Please enter an Event Location</span>");
			$("#registry-event_location").focus();
		}else{
			$("#registry-event_locationErrHelpMssg").html("");
		}

		if( registry_event_date == '' ){
			$("#registry-event_dateErrHelpMssg").html("<span style='color:#ff0000'>Please enter an Event Date</span>");
			$("#registry-event_date").focus();
		}else{
			$("#registry-event_dateErrHelpMssg").html("");
		}

		if( registry_event_message == '' ){
			$("#registry-event_messageErrHelpMssg").html("<span style='color:#ff0000'>Please enter an Event Message</span>");
			$("#registry-event_message").focus();
		}else{
			$("#registry-event_messageErrHelpMssg").html("");
		}
		if( registry_event_message != '' && registry_event_date != '' && registry_event_type != ''  &&  registryPrivacy != '' && registryCoRegistrantsCheck != '' && registryTitle != '' && ErrorChecker < 1 && flag < 1 ){
			$(".spinner").show();
			var file_data = $("#registry_banner").prop('files')[0];
            var form_data = new FormData();
            form_data.append('action', 'dbt_create_registry');
            form_data.append('file', file_data);
            form_data.append('registry_event_message', registry_event_message);	    			
		    form_data.append('registry_event_date', registry_event_date);
		    form_data.append('registry_event_location', registry_event_location);
		    form_data.append('registry_event_type', registry_event_type);
		    form_data.append('registryPrivacy', registryPrivacy);
		    form_data.append('registryCoRegistrantsCheck', registryCoRegistrantsCheck);
		    form_data.append('registryTitle', registryTitle);
		    form_data.append('registry_author', registry_author);
		    form_data.append('coRegistrantLastName', coRegistrantLastName);
		    form_data.append('coRegistrantFirstName', coRegistrantFirstName);
		    form_data.append('coRegistrantEmail', coRegistrantEmail);
		    form_data.append('password', password);
		    form_data.append('registry_cash_gift', registry_cash_gift);
		  
			$.ajax({
		    		url: ajax_url,
		    		type: 'post',
		    		processData: false,
		    		contentType: false,
		    		data : form_data,
		    	
		        success:function(response){
		        	let res = JSON.parse(response);
		        	$(".spinner").hide();
		        	
		        	if(res.length > 0 ){
		        		if( slider_check == 0 ){
		        		    window.location.href=res[0];
		        		}else{
		        		    $('.page3').addClass('d-none');
                            $('.page4').removeClass('d-none');
                            const href = 'http://silvercastle.co/giftshop/?mypage='+res[1];
                            $(".addGiftsBtn").attr('href', href);
		        		}
		        	}else{
		        		//window.location.reload();
		        	}
		        }
			});
		}else{
		    console.log('Test');
		}
		
	});
    
    $("#btnCheckPassword").click(function(){
        
    });
    $(".find_a_coupleBtn").click(function(){
        var registry_title = $("#registry_title").val();
        //var registrant_fullname = $("#registrant_fullname");
        
        /*if(registry_title == '' && registrant_fullname != ''){
            $("#registry_titleErrorMessage").html("Registry Title is required");
        }else{
            $("#registry_titleErrorMessage").html();
        }
        
        if(registrant_fullname == '' && registry_title != ''){
            $("#registry_fullnameErrorMessage").html("Registry full name is required");
        }else{
            $("#registry_fullnameErrorMessage").html();
        }
        */
         if(registry_title == ''){
            $("#registry_titleErrorMessage").html("Registry Title is required");
        }else{
            $("#registry_titleErrorMessage").html();
        }
        
        if(  registry_title != ''){
            	$.ajax({
		    		url: ajax_url,
		    		type: 'post',
		    		data : {
		    			action: 'dbt_find_couple_registry',
		    			registry_title: registry_title,
		    		
		    		},
		    	
		        success:function(response){
		        	let res = JSON.parse(response);
		        	$(".spinner").hide();
		        	if(res[0] == 1 ){
		        		//var url = res[1]+'/registry/close-registry';
		        		window.location.href=res[1];
		        	}else{
		        		window.location.reload();
		        	}
		        }
			});
        }
    });
    
	$("#updateRegistry").click(function(){
		
		const registry_id = $(this).data("registry");
		const registryTitle = $("#registry_title").val();
		const registryBanner = $("#").val();
		const registryPrivacy = $("#registry-privacy").val();
		const registryCoRegistrantsCheck = $("#registry-co-registrants").val();
		
		const coRegistrantLastName = $("#registry-co-registrants_lastname").val();
		const coRegistrantFirstName = $("#registry-co-registrants_firstname").val();
		const coRegistrantEmail = $("#registry-co-registrants_email").val();
		
		const registry_event_type = $("#registry-event_type").val();
		const registry_event_date = $("#registry-event_date").val();
		const registry_event_location = $("#registry-event_location").val();
		const registry_event_message = $("#registry-event_message").val();
		const registry_author = $(this).data('author');
		
		const registry_cash_gift = $("#registry-cash_gift").val();

		if( registryTitle == ''){
			$("#registryTitleErrHelpMssg").html("<span style='color:#ff0000'>Please enter a registry title</span>");
			$("#registry_title").focus();
		}else{
			$("#registryTitleErrHelpMssg").html("");
		}

		if( registryPrivacy == ''){
			$("#registryPrivacyErrHelpMssg").html("<span style='color:#ff0000'>Please select a Privacy setting</span>");
			$("#registry-privacy").focus();
		}else{
			$("#registryPrivacyErrHelpMssg").html("");
		}

		if( registryCoRegistrantsCheck == ''){
			$("#registryCoregistrantErrHelpMssg").html("<span style='color:#ff0000'>Please select an option</span>");
			$("#registry-co-registrants").focus();
		}else if (registryCoRegistrantsCheck == '0' ){
			ErrorChecker = 0;
		}else{
			$("#registryCoregistrantErrHelpMssg").html("");
			if(coRegistrantLastName == '' ){
				$("#registryCoregistrantLastNameErrHelpMssg").html("<span style='color:#ff0000'>Last Name is required</span>");
				$("#registry-co-registrants_lastname").focus();
				ErrorChecker++;
			}else{
				$("#registryCoregistrantLastNameErrHelpMssg").html("");
			}
			if(coRegistrantFirstName == '' ){
				$("#registryCoregistrantFirstNameErrHelpMssg").html("<span style='color:#ff0000'>First Name is required</span>");
				$("#registry-co-registrants_firstname").focus();
				ErrorChecker++;
			}else{
				$("#registryCoregistrantFirstNameErrHelpMssg").html("");
			}
			if(coRegistrantEmail == '' ){
				$("#registryCoregistrantEmailErrHelpMssg").html("<span style='color:#ff0000'>Email is required</span>");
				$("#registry-co-registrants_email").focus();
				ErrorChecker++;
			}else{
				$("#registryCoregistrantFirstNameErrHelpMssg").html("");
			}
		}

		if( registry_event_type == '' ){
			$("#registry-event_typeErrHelpMssg").html("<span style='color:#ff0000'>Please select an Event Type</span>");
			$("#registry-event_type").focus();
		}else{
			$("#registry-event_typeErrHelpMssg").html("");
		}

		if( registry_event_location == '' ){
			$("#registry-event_locationErrHelpMssg").html("<span style='color:#ff0000'>Please enter an Event Location</span>");
			$("#registry-event_location").focus();
		}else{
			$("#registry-event_locationErrHelpMssg").html("");
		}

		if( registry_event_date == '' ){
			$("#registry-event_dateErrHelpMssg").html("<span style='color:#ff0000'>Please enter an Event Date</span>");
			$("#registry-event_date").focus();
		}else{
			$("#registry-event_dateErrHelpMssg").html("");
		}

		if( registry_event_message == '' ){
			$("#registry-event_messageErrHelpMssg").html("<span style='color:#ff0000'>Please enter an Event Message</span>");
			$("#registry-event_message").focus();
		}else{
			$("#registry-event_messageErrHelpMssg").html("");
		}
		if( registry_event_message != '' && registry_event_date != '' && registry_event_type != ''  &&  registryPrivacy != '' && registryCoRegistrantsCheck != '' && registryTitle != '' && registry_event_location!= '' && ErrorChecker < 1){
			$(".spinner").show();
			var file_data = $("#registry_banner").prop('files')[0];
            var form_data = new FormData();
            form_data.append('action', 'dbt_updateRegistry');
            form_data.append('file', file_data);
            form_data.append('registry_event_message', registry_event_message);	    			
		    form_data.append('registry_event_date', registry_event_date);
		    form_data.append('registry_event_location', registry_event_location);
		    form_data.append('registry_event_type', registry_event_type);
		    form_data.append('registryPrivacy', registryPrivacy);
		    form_data.append('registryCoRegistrantsCheck', registryCoRegistrantsCheck);
		    form_data.append('registryTitle', registryTitle);
		    form_data.append('registry_author', registry_author);
		    form_data.append('coRegistrantLastName', coRegistrantLastName);
		    form_data.append('coRegistrantFirstName', coRegistrantFirstName);
		    form_data.append('coRegistrantEmail', coRegistrantEmail);
		    form_data.append('registry_id', registry_id);
		    form_data.append('registry_cash_gift', registry_cash_gift);
		  
			$.ajax({
		    		url: ajax_url,
		    		type: 'post',
		    		processData: false,
		    		contentType: false,
		    		data : form_data,
		    	
		        success:function(response){
		        	let res = JSON.parse(response);
		        	$(".spinner").hide();
		        	if(res.length != 0 ){
		        		window.location.reload();
		        	}else{
		        		//window.location.reload();
		        	}
		        }
			});
		}
	});

	$("#closeRegistry").click(function(){
	    $(".spinner").show('slow');
		const shipping_house_address = $("#shipping_house_address").val();
		const shipping_city = $("#shipping_city").val();
		const shipping_state = $("#shipping_state").val();
		const shipping_country = $("#shipping_country").val();
		const registry_id = $("#registry_id").val();
        const user_id = $(this).data('user_id');
		$.ajax({
		    		url: ajax_url,
		    		type: 'post',
		    		data : {
		    			action: 'dbt_close_registry',
		    			shipping_house_address: shipping_house_address,
		    			shipping_city: shipping_city,
		    			shipping_state: shipping_state,
		    			shipping_country: shipping_country,
		    			registry_id:registry_id, 
		    			user_id: user_id,
		    		},
		    	
		        success:function(response){
		        	let res = JSON.parse(response);
		        	$(".spinner").hide();
		        	$(".spinner").hide('slow');
		        	if(res[0] == 1 ){
		        		var url = res[1]+'/registry/close-registry';
		        		window.location.href=url;
		        	}else{
		        		window.location.reload();
		        	}
		        }
			});


	});
	
	/*
	$(".addProductToRegistry").click(function(){
//	$('.addProductToRegistry').on('click', 'a', function(){
	    //console.log('Added!');
		var id = $(this).data('id');
		var registry = $(this).data('registry');
		const priority = $("#priority"+id).val();
		const qty = $("#qty"+id).val();
		if(priority == ''){
			$("#priorityErrorMessage"+id).html("<span style='color:#ff0000'>Please select a priority</span>");
			$("#priority"+id).focus();
		}else{
			$("#priorityErrorMessage"+id).html("");
			$(".spinner").show('slow');
				$.ajax({
		    		url: ajax_url,
		    		type: 'post',
		    		data : {
		    			action: 'dbtaddProductToRegistry',
		    			product_id: id,
		    			registry: registry,
		    			priority: priority,
		    			qty: qty
		    		},
		    	
		        success:function(response){
		        	let res = JSON.parse(response);
		        	$(".spinner").hide();
		        	if(res != 0 ){
		        		$("#priority"+id).hide();
		        		$("#qty"+id).html();
		        		$("#addProductToRegistry"+id).hide('slow');
		        		$("#AddErrorSuccessMessage"+id).html("<span class='text-green'>Successfully Added to Registry</span>");
		        	}else{
		        		window.location.reload();
		        	}
		        }
			});
		}
	});
	*/
	$("#enable_cashgift").click(function(){
	    var registry_id = $(this).data('registry');
	    $(".spinner").show('slow');
	    		$.ajax({
		    		url: ajax_url,
		    		type: 'post',
		    		data : {
		    			action: 'dbt_enable_cashgift',
		    			registry: registry_id,
		    			
		    		},
		    	
		        success:function(response){
		        	let res = JSON.parse(response);
		        	$(".spinner").hide();
		        	if(res != 0 ){
		        		window.location.reload();
		        	}else{
		        		window.location.reload();
		        	}
		        }
			});
	});
	
	$("#disable_cashgift").click(function(){
	    var registry_id = $(this).data('registry');
	    $(".spinner").show('slow');
	    		$.ajax({
		    		url: ajax_url,
		    		type: 'post',
		    		data : {
		    			action: 'dbt_disable_cashgift',
		    			registry: registry_id,
		    			
		    		},
		    	
		        success:function(response){
		        	let res = JSON.parse(response);
		        	$(".spinner").hide();
		        	if(res != 0 ){
		        		window.location.reload();
		        	}else{
		        		window.location.reload();
		        	}
		        }
			});
	});
	
	$('.products_box').on('click', '.addProductToRegistry', function(){
	    
		var id = $(this).data('id');
		var registry = $(this).data('registry');
		const priority = $("#priority"+id).val();
		const qty = $("#qty"+id).val();
		if(priority == ''){
			$("#priorityErrorMessage"+id).html("<span style='color:#ff0000'>Please select a priority</span>");
			$("#priority"+id).focus();
		}else{
			$("#priorityErrorMessage"+id).html("");
			$(".spinner").show('slow');
				$.ajax({
		    		url: ajax_url,
		    		type: 'post',
		    		data : {
		    			action: 'dbtaddProductToRegistry',
		    			product_id: id,
		    			registry: registry,
		    			priority: priority,
		    			qty: qty
		    		},
		    	
		        success:function(response){
		        	let res = JSON.parse(response);
		        	$(".spinner").hide();
		        	if(res != 0 ){
		        		$("#priority"+id).hide();
		        		$("#qty"+id).hide('slow');
		        		$("#addProductToRegistry"+id).hide('slow');
		        		$("#AddErrorSuccessMessage"+id).html("<span class='text-green'>Successfully Added to Registry</span>");
		        		const counter = parseInt($(".giftsCounter").text(), 10 ) + 1 ;
		        		$(".giftsCounter").text(counter);
		        		$("#publishRegistry").removeClass('d-none');
		        		
		        	}else{
		        		window.location.reload();
		        	}
		        }
			});
		}
	});
	$('#registry-event_date').datepicker({
	    autoclose: true,
	    format: 'dd/mm/yyyy'
	});
	$(".updateProductRegistry").click(function(){
		var id = $(this).data('id');
		var registry = $(this).data('registry');
		const priority = $("#priority"+id).val();
		const qty = $("#qty"+id).val();
		if(priority == ''){
			$("#priorityErrorMessage"+id).html("<span style='color:#ff0000'>Please select a priority</span>");
			$("#priority"+id).focus();
		}else{
			$("#priorityErrorMessage"+id).html("");
			$(".spinner").show('slow');
				$.ajax({
		    		url: ajax_url,
		    		type: 'post',
		    		data : {
		    			action: 'dbtupdateProductRegistry',
		    			product_id: id,
		    			registry: registry,
		    			priority: priority,
		    			qty: qty
		    		},
		    	
		        success:function(response){
		        	let res = JSON.parse(response);
		        	$(".spinner").hide();
		        	if(res != 0 ){
		        		//$("#priority"+id).hide('slow');
		        		//$("#qty"+id).hide('slow');
		        		//$("#addProductToRegistry"+id).hide('slow');
		        		$("#AddErrorSuccessMessage"+id).html("<span class='text-green'>Successfully Updated Product</span>");
		        		setTimeout(function(){
		        		    $("#AddErrorSuccessMessage"+id).html("");
		        		}, 3000);
		        		
		        	}else{
		        		//window.location.reload();
		        	}
		        }
			});
		}
	});
	
	$(".removeProductRegistry").click(function(){
	    var id = $(this).data('id');
		var registry = $(this).data('registry');
	    var res = confirm('Are you sure you want to delete this product?');
	    if(res == true ){
			$("#priorityErrorMessage"+id).html("");
			$(".spinner").show('slow');
				$.ajax({
		    		url: ajax_url,
		    		type: 'post',
		    		data : {
		    			action: 'dbtRemoveProductRegistry',
		    			product_id: id,
		    			registry: registry,
		    			
		    		},
		    	
		        success:function(response){
		        	let res = JSON.parse(response);
		        	$(".spinner").hide();
		        	if(res != 0 ){
		        		//$("#priority"+id).hide('slow');
		        		//$("#qty"+id).hide('slow');
		        		//$("#addProductToRegistry"+id).hide('slow');
		        		const counter = parseInt($(".giftsCounter").text(), 10 ) - 1;
		        		$(".giftsCounter").text(counter);
		        		window.location.reload();
		        	}else{
		        		//window.location.reload();
		        	}
		        }
			});
	   }else{
	       
	   }
		
	});
	
	$(".cashGiftForRegistry").click(function(){
    	    var registry = $(this).data('registry');
    	    const key = $(this).data('paystack');
    	    var price = $("#amtDonatedCashgift").val();
    	    
    	     const firstname  = $("#firstname_cashgift").val();
            const lastname  = $("#lastname_cashgift").val();
            const email  = $("#email_cashgift").val();
            const phone  = $("#phone_cashgift").val();
            const message = $("#message_cashgift").val();
            const annonymousCheck = $("#annonymousCheck_cashgift").val();
            var user_data = {
                firstname: firstname,
                lastname: lastname,
                email: email,
                phone: phone,
                message: message,
                annonymousCheck: annonymousCheck
            }
            if(email === ''){
                $("#emailErrorMessage_cashgift").html('<span style="color:red">Email is required</span>');
            }else{
                $("#emailErrorMessage_cashgift").html('');
            }
        
            if( firstname === ''){
                $("#firstnameErrorMessage_cashgift").html('<span style="color:red">First name is required</span>');
            }else{
                $("#firstnameErrorMessage_cashgift").html('');
            }
      
            if( lastname === ''){
                $("#lastnameErrorMessage_cashgift").html('<span style="color:red">Last name is required</span>');
            }else{
                $("#lastnameErrorMessage_cashgift").html('');
            }
            
            if( phone === ''){
                $("#phoneErrorMessage_cashgift").html('<span style="color:red">Phone is required</span>');
            }else{
                $("#phoneErrorMessage_cashgift").html('');
            }
            
            if(email != '' && firstname != '' && lastname != '' && phone != '' ){
    		var paystack_callback = function(response){
    				          //alert('success. transaction ref is ' + response.reference);
    				          $.ajax({
    				    		url: ajax_url,
    				    		type: 'post',
    				    		data : {
    				    			action: 'dbtaddProductToSales_cashgift',
    				    			registry: registry,
    				    			price: price,
    				    			user_data: user_data,
    				    			message: message
    				    			
    				    		},
    				    	
    				        success:function(response){
    				        	let res = JSON.parse(response);
    				        	$(".spinner").hide();
    				        	if(res != 0 ){
    				        		window.location.reload();
    				        	}else{
    				        		window.location.reload();
    				        	}
    				        }
    					});
    				      };
    	                var handler = PaystackPop.setup({
    				      key: key,
    				      email: email,
    				      amount: price+'00',
    				      currency: "NGN",
    				      //ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
    				      metadata: {
    				         
    				      },
    				      callback: paystack_callback,
    				      onClose: function(){
    				          alert('window closed');
    				      }
    				    });
    				    handler.openIframe();
				    
            }
        
	});
	
	$(".buyProductForRegistry").click(function(){
		var id = $(this).data('id');
		var group_gift_flag = $(this).data('group_gift_flag');
		var registry = $(this).data('registry');
		const priority = $("#priority"+id).val();
		const qty = $("#qty"+id).val();
		const key = $(this).data('paystack');
		const crowdingFlag = $(this).data('crowding');
		const annonymousCheck = $("#annonymousCheck"+id).val();
		if(crowdingFlag == 1 ){
		   var price = $("#amtDonated"+id).val();
		}else{
		    var price = $(this).data('price');
			    price = parseInt(price, 10) * parseInt(qty, 10);
		}
        const firstname  = $("#firstname"+id).val();
        const lastname  = $("#lastname"+id).val();
        const email  = $("#email"+id).val();
        const phone  = $("#phone"+id).val();
        const message = $("#message"+id).val();
        
        var user_data = {
            firstname: firstname,
            lastname: lastname,
            email: email,
            phone: phone,
            message: message,
            annonymousCheck: annonymousCheck
        }
        
        if(email === ''){
            $("#emailErrorMessage"+id).html('<span style="color:red">Email is required</span>');
        }else{
            $("#emailErrorMessage"+id).html('');
        }
        
        if( firstname === ''){
            $("#firstnameErrorMessage"+id).html('<span style="color:red">First name is required</span>');
        }else{
            $("#firstnameErrorMessage"+id).html('');
        }
      

        if( lastname === ''){
            $("#lastnameErrorMessage"+id).html('<span style="color:red">Last name is required</span>');
        }else{
            $("#lastnameErrorMessage"+id).html('');
        }
        
         if( phone === ''){
            $("#phoneErrorMessage"+id).html('<span style="color:red">Phone is required</span>');
        }else{
            $("#phoneErrorMessage"+id).html('');
        }
        
        if(email != '' && firstname != '' && lastname != '' && phone != '' ){
    		var paystack_callback = function(response){
    				          //alert('success. transaction ref is ' + response.reference);
    				          $.ajax({
    				    		url: ajax_url,
    				    		type: 'post',
    				    		data : {
    				    			action: 'dbtaddProductToSales',
    				    			product_id: id,
    				    			registry: registry,
    				    			priority: priority,
    				    			qty: qty,
    				    			price: price,
    				    			user_data: user_data,
    				    			group_gift_flag: group_gift_flag,
    				    		},
    				    	
    				        success:function(response){
    				        	let res = JSON.parse(response);
    				        	$(".spinner").hide();
    				        	if(res != 0 ){
    				        		//window.location.reload();
    				        	}else{
    				        		window.location.reload();
    				        	}
    				        }
    					});
    				      };
    	                var handler = PaystackPop.setup({
    				      key: key,
    				      email: email,
    				      amount: price+'00',
    				      currency: "NGN",
    				      //ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
    				      metadata: {
    				         custom_fields: [
    				            {
    				                display_name: "Quantity",
    				                variable_name: "quantity",
    				                value: qty
    				            }
    				         ]
    				      },
    				      callback: paystack_callback,
    				      onClose: function(){
    				          alert('window closed');
    				      }
    				    });
    				    handler.openIframe();
				    
            }
		});
	$('.manage-registry').DataTable();
	
	$('input[type=checkbox].category-check').change(function(){
	//$(".category-checkbox").change(function(){
	   
	   if( $(this).val() == 0){
	       window.location.reload();
	   }else{
	        $('#allChecked').prop('checked', false);
    	   
    	   if($(this).is(':checked') ){
    	       
    	       $('input[name="category-check"]:checked').each(function(){
    	            allcheckBox.push($(this).val() );   
        	   });
        	   
    	   }else{
    	       const unchecked = $(this).val();
    	       for( var i = 0; i < allcheckBox.length; i++){ 
                   if ( allcheckBox[i] === unchecked) {
                     allcheckBox.splice(i, 1); 
                   }
                }
    	   }
    	   
    	   allcheckBox = allcheckBox.reduce(function(a,b){if(a.indexOf(b)<0)a.push(b);return a;},[]);
    	    $(".spinner").show(); 
    	   var registry_id = jQuery("#registry_id").val();
    	   var productsPerPage = jQuery("#productsPerPage").val();
    	   	$.ajax({
    		    		url: ajax_url,
    		    		type: 'post',
    		    		data : {
    		    			action: 'dbtfetchRegistryProducts',
    		    			checkboxValue: JSON.stringify(allcheckBox),
    		    			registry_id: registry_id,
    		    			productsPerPage: productsPerPage
    		    			
    		    		},
    		    	
    		        success:function(response){
    		        	let res = JSON.parse(response);
    		        	
    		        	$(".spinner").hide();
    		        	$(".products_box").html();
    		        	if(res != 0){
    		        	    //console.log(res[0]);
    		        	    $(".products_box").html(res[0]);
    		        	    // $(".pagination_field").html();
    		        	    //$(".pagination_field").html(res[1]);
    		        	    pageCounter = 0;
    		        	    
    		        	}else{
    		        	    $(".products_box").html('<div class="col-md-12"><h4 style="color:#800080">No Products in this category.</h4></div>');
    		        	}
    		        
    		        }
    			});
    	}	
	   
	});
	
     $(".password_section").hide();
    $("#registry-privacy").change(function(){
       const privacy = $("#registry-privacy").val();
       if(privacy == 'passworded' ){
           $(".password_section").show('slow');
       }else{
            $(".password_section").hide('slow');
       }
    });
    
    
    // $(".page-link").click(function(e){
    //     //e.preventDefault();
    //     var exclude_ids = $(this).data('exclude');
    //     if( excludes.length < 1 ){
            
    //         excludes.push(exclude_ids);
    //     }
    //     exclude_ids = excludes;
        
    //     var productsPerpage = $("#productsPerPage").val();
    //     if( productsPerpage == ''){
    //         productsPerpage = 16;
    //     }
    //     const registry_id = $("#registry_id").val();
    //     $('input[name="category-check"]:checked').each(function(){
    //             if( $(this).val() == 0 ){
    //                 $('input[name="category-check"]').each(function(){
    //                     allcheckBox.push($(this).val() );
    //                 });
    //             }
    // 	        allcheckBox.push($(this).val() );   
    // 	   });
    	   
    // 	 allcheckBox = allcheckBox.reduce(function(a,b){if(a.indexOf(b)<0)a.push(b);return a;},[]);
    	 
    	 
    //     $.ajax({
    // 		    		url: ajax_url,
    // 		    		type: 'post',
    // 		    		data : {
    // 		    			action: 'dbtfetchRegistryPagination',
    // 		    			productsPerpage: productsPerpage,
    // 		    			exclude_ids: exclude_ids,
    // 		    			registry_id: registry_id,
    // 		    			allcheckBox: JSON.stringify(allcheckBox),
    // 		    		},
    		    	
    // 		        success:function(response){
    // 		        	let res = JSON.parse(response);
    // 		        	console.log(res);
    // 		        	excludes = [];
    // 		        	$(".spinner").hide();
    // 		        	$(".products_box").html();
    // 		        	if(res != ''){
    // 		        	    $(".products_box").html(res);
    // 		        	}else{
    // 		        	    $(".products_box").html('No Products in this category.');
    // 		        	}
    		        
    // 		        }
    // 			});
        
    // });
    
    
    $("#productsPerPage").change(function(){
        const productsPerpage = $(this).val();
        const registry_id = $("#registry_id").val();
        $('input[name="category-check"]:checked').each(function(){
                if( $(this).val() == 0 ){
                    $('input[name="category-check"]').each(function(){
                        allcheckBox.push($(this).val() );
                    });
                }
    	        allcheckBox.push($(this).val() );   
    	   });
    	   
    	 allcheckBox = allcheckBox.reduce(function(a,b){if(a.indexOf(b)<0)a.push(b);return a;},[]);
        if(productsPerpage == '' ){
            
        }else{
            $(".spinner").show('slow');
             	$.ajax({
    		    		url: ajax_url,
    		    		type: 'post',
    		    		data : {
    		    			action: 'dbtfetchRegistryProductsUsingProductsNumber',
    		    			productsPerpage: productsPerpage,
    		    			allcheckBox: JSON.stringify(allcheckBox),
    		    			registry_id: registry_id
    		    			
    		    		},
    		    	
    		        success:function(response){
    		        	let res = JSON.parse(response);
    		        	console.log(res);
    		        	$(".spinner").hide();
    		        	$(".products_box").html();
    		        	if(res.length > 0){
    		        	    $(".products_box").html(res[0]);
    		        	    //$(".pagination_field").html();
    		        	   // $(".pagination_field").html(res[1]);
    		        	    
    		        	}else{
    		        	    $(".products_box").html('No Products in this category.');
    		        	}
    		        
    		        }
    			});
        }
    });
    
    /*
    $(".page").click(function(){
        var gotoPage = $(this).data('pagenumber');
        var productsPerPage = $("#productsPerPage").val();
        if(productsPerPage == '' ){
            $('input[name="category-check"]:checked').each(function(){
                if( $(this).val() == 0 ){
                    $('input[name="category-check"]').each(function(){
                        allcheckBox.push($(this).val() );
                    });
                }
    	        allcheckBox.push($(this).val() );   
    	   });
    	   
    	    allcheckBox = allcheckBox.reduce(function(a,b){if(a.indexOf(b)<0)a.push(b);return a;},[]);
    	 	$.ajax({
    		    		url: ajax_url,
    		    		type: 'post',
    		    		data : {
    		    			action: 'dbtfetchRegistryProductsPagination',
    		    			productsPerPage: productsPerPage,
    		    			allcheckBox: JSON.stringify(allcheckBox),
    		    			gotoPage: gotoPage
    		    			
    		    		},
    		    	
    		        success:function(response){
    		        	let res = JSON.parse(response);
    		        	console.log(res);
    		        	$(".spinner").hide();
    		        	$(".products_box").html();
    		        	if(res != ''){
    		        	    $(".products_box").html(res);
    		        	}else{
    		        	    $(".products_box").html('No Products in this category.');
    		        	}
    		        
    		        }
    			});
        }else{
            
        }
        
    });*/

  
    
    $("#InviteFriendsbtn").click(function(){
        var registry_id = $(this).data('registry');
        var fullname1 = $("#fullname1").val();
        var phone1 = $("#phone1").val();
        
        var fullname2 = $("#fullname2").val();
        var phone2 = $("#phone2").val();
        
        var fullname3 = $("#fullname3").val();
        var phone3 = $("#phone3").val();
        
       	$.ajax({
    		    		url: ajax_url,
    		    		type: 'post',
    		    		data : {
    		    			action: 'dbtInviteFriendRegistry',
    		    			registry_id: registry_id,
    		    			fullname1:fullname1,
                            phone1:phone1,
                            fullname2:fullname2,
                            phone2:phone2,
                            fullname3:fullname3,
                            phone3:phone3,
    		    		
    		    		},
    		    	
    		        success:function(response){
    		        	let res = JSON.parse(response);
    		        	//console.log(res);
    		        
    		        	if(res == 1){
    		        	    var url = 'http://silvercastle.co/registry/share-registry';
    		        	    window.location.href=url;
    		        	}else{
    		        	   
    		        	}
    		        
    		        }
    			});
       
    });
    
    var flag= 0;
    $(".tbl_resp").hide();
    $(".AddMoreEmailInvitees").click(function(){
        const id = $(this).data('id');
       
            inputGroup = jQuery(".form"+id);
            $(".friendsGroup").each(function(){
                 
                var fullname = $(this).find(".fullname").val();
                var email = $(this).find(".email").val();
                var message = $(this).find(".message").val();
                 if(email != ''){
                    
                    var data = [
                        fullname = fullname,
                        email = email, 
                        message = message
                    ]
                    const index = friendsGroup.push(data);
                    console.log(index);
                    let html = '<div class="row border p-3 my-2 curr_friend'+index+'"><div class="col-md-4">'+fullname+'</div><div class="col-md-5">'+email+'</div><div class="col-md-3 text-center"><span class="text-danger remFriends" style="cursor:pointer" data-index="'+index+'">Remove</span></div></div>';
                    $(".tbl_resp").show();
                    $(".tbl_resp").append(html);
                    
                 }
                 
                $(this).find(".fullname").val('');
                $(this).find(".email").val('');
               // $(this).find(".message").val('');
  
            });
        
        flag = 1;
        //inputGroup.clone().appendTo(".referral"+id);
       
    });
    
    $(".tbl_resp").on('click','.remFriends',function(){
        let index = $(this).data('index');
       $('.curr_friend'+index).remove();
       friendsGroup.splice(index-1, 1);
    });
    
    $("#addMoreReferralFriends").click(function(){
         const id = $(this).data('id');
        if(flag == 0 ){
            inputGroup = jQuery(".p"+id);
        
        }
        flag = 1;
        inputGroup.clone().appendTo(".friendsShareGroup");
    });
    
    $(".sendInvitees").click(function(){
        const flag = $(this).data('flag');
        const source = $(this).data('source');
        $(".ResponseReferralField").html('<span style="color:red">Sending Email...<span style="color:green">');
        var registry_id = $(this).data('id');
        
            $(".friendsGroup").each(function(){
                 
                var fullname = $(this).find(".fullname").val();
                var email = $(this).find(".email").val();
                var message = $(this).find(".message").val();
                 if(email != ''){
                    
                    var data = [
                        fullname = fullname,
                        email = email, 
                        message = message
                    ]
                    friendsGroup.push(data);
                 }
               
               
                
                
            });
            
            $.ajax({
    		    		url: ajax_url,
    		    		type: 'post',
    		    		data : {
    		    			action: 'dbt_sendEmailToReferrals',
    		    			data: JSON.stringify(friendsGroup),
    		    			registry_id: registry_id,
    		    			source: source,
    		    		
    		    		},
    		    	
    		        success:function(response){
    		        	let res = JSON.parse(response);
    		        	//console.log(res);
    		        
    		        	if(res == 1){
    		        	    $(".ResponseReferralField").html('<span style="color:green">Email Sent Successfully</span>');
    		        	    friendsGroup= [];
    		        	    if( flag == 0 ){
        		        	    setTimeout(function(){
        		        	        window.location.reload();
        		        	    }, 3000);
    		        	    }else{
    		        	        let flag = parseInt($(".sharedCounter").text(), 10) + 1;
    		        	        $(".sharedCounter").text(flag);
    		        	        var counter = parseInt($(".sharedCounter").text(), 10 );
    		        	        setTimeout(function(){
        		        	        if( counter > 3 ){
                                        $(".lastpage").removeClass('d-none');
                                        $(".sharepage").addClass('d-none');
                                    }else{
                                        $('#pills-tab a[href="#pills-profile"]').tab('show');
                                        
                                    }
        		        	    }, 3000);
                                
    		        	        
    		        	    }
    		        	}else{
    		        	   
    		        	}
    		        
    		        }
    			});
    });
    
    $("#pushReferralData").click(function(){
        $(".fullname").each(function(){
            var fullname = $(".fullname").val();
            var email = $(".email").val();
            var data = [
                fullname = fullname,
                email = email
            ]
            friendsGroup.push(data);
        });
    });
    
    $("#publishRegistry").click(function(){
        var registry_id = $("#registry_id").val();
        var res = confirm("Are you sure you want to publish this registry?");
        var messageFriends = $("#messageFriends").val();
        const slider_check = $(this).data('slider');
        if(res == true ){
             $(".spinner").show();
       	    $.ajax({
    		    		url: ajax_url,
    		    		type: 'post',
    		    		data : {
    		    			action: 'dbtPublishRegistry',
    		    			registry_id: registry_id,
    		    			messageFriends: messageFriends
    		    		
    		    		},
    		    	
    		        success:function(response){
    		        	let res = JSON.parse(response);
    		        	//console.log(res);
    		             $(".spinner").hide();
    		        	if(res == 1){
    		        	    if( slider_check == 0 ){
    		        	        $("#publishRegistryModal").modal('toggle');
    		        	    }else{
    		        	        window.location.href='https://silvercastle.co/share/?mypage='+registry_id;
    		        	    }
    		        	 
    		        	}else{
    		        	   
    		        	}
    		        
    		        }
    			});
        }
    });
    
    
    $("#sendMailToReferralFriends").click(function(){
        $(".ResponseField").html('<span style="color:red">Sending Email...<span style="color:green">');
        var registry_id = $("#registry_id").val();
        //var messageFriends = $("#messageFriends").val();
            $(".friendsShareGroup").each(function(){
                 
                var fullname = $(this).find(".fullname").val();
                var email = $(this).find(".email").val();
                var message = $(this).find(".message").val();
                if(email != '' ){
                    var data = [
                        fullname = fullname,
                        email = email,
                        message = message
                    ]
                    friendsGroup.push(data);
                }
                
            });
            
            $.ajax({
    		    		url: ajax_url,
    		    		type: 'post',
    		    		data : {
    		    			action: 'dbt_sendEmailToClient',
    		    			data: JSON.stringify(friendsGroup),
    		    			registry_id: registry_id,
    		    			
    		    		
    		    		},
    		    	
    		        success:function(response){
    		        	let res = JSON.parse(response);
    		        	//console.log(res);
    		        
    		        	if(res == 1){
    		        	    $(".ResponseField").html('<span style="color:green">Email Sent Successfully</span>');
    		        	    friendsGroup = [];
    		        	}else{
    		        	   
    		        	}
    		        
    		        }
    			});
    });
    
    $("#updateAccountSettings").click(function(){
        const firstname = $("#billing_first_name").val();
        const lastname = $("#billing_last_name").val();
        const password = $("#user_password").val();
        const cpassword = $("#confirm_user_password").val();
        const phone = $("#billing_phone").val();
        
        if(password == '' && cpassword == ''){
            $("#user_cpasswordErrorField").html('Password is required');
            $("#user_passwordErrorField").html('Password is required');
            ErrorChecker += 1;
        }else if(password == '' && cpassword != '' || password != '' && cpassword == ''){
            
            $("#user_cpasswordErrorField").html('Password Mismatch');
            $("#user_passwordErrorField").html('Password Mismatch');
            ErrorChecker += 1;
            
        }else if(password != '' && cpassword != ''){
            if(password == cpassword){
                ErrorChecker = 0;
            }else{
                $("#user_cpasswordErrorField").html('Password Mismatch');
                $("#user_passwordErrorField").html('Password Mismatch');
                ErrorChecker += 1;
            }
        }
        
        if(firstname == ''){
            $("#first_nameErrorField").html('First Name is required');
        }else{
            $("#first_nameErrorField").html('');
        }
        
        if(phone == ''){
            $("#phoneErrorField").html('Phone is required');
        }else{
            $("#phoneErrorField").html('');
        }
        
        if(lastname == ''){
            $("#last_nameErrorField").html('Last Name is required');
        }else{
            $("#last_nameErrorField").html('');
        }
        const user_id = $("#user_id").val();
        
        if(lastname != '' && firstname != '' && phone != '' && ErrorChecker < 1){
            $(".ResponseField").html('<span style="color:green">Please wait...</span>');
            $.ajax({
    		    		url: ajax_url,
    		    		type: 'post',
    		    		data : {
    		    			action: 'dbt_updateUserAcct',
    		    			
    		    			lastname: lastname,
    		    			firstname: firstname,
    		    			password: password,
    		    			cpassword: cpassword,
    		    		    user_id: user_id,
    		    		    phone: phone
    		    		},
    		    	
    		        success:function(response){
    		        	let res = JSON.parse(response);
    		        	//console.log(res);
    		        
    		        	if(res == 1){
    		        	    $(".ResponseField").html('<span style="color:green">Account was updated successfully</span>');
    		        	 
    		        	}else{
    		        	   
    		        	}
    		        
    		        }
    			});
        }
    });
    
    $(".button-gifting").click(function(){
       var product_id = $(this).data('id');
       var registry_id = $(this).data('registry');
       $(".spinner").show('slow');
        $.ajax({
    		    		url: ajax_url,
    		    		type: 'post',
    		    		data : {
    		    			action: 'dbt_make_group_gifting',
    		    			product_id: product_id,
    		    			registry_id: registry_id,
    		    		
    		    		},
    		    	
    		        success:function(response){
    		        	let res = JSON.parse(response);
    		        	//console.log(res);
    		        
    		        	if(res == 1){
    		        	    $(".spinner").hide('slow');
    		        	    window.location.reload();
    		        	    
    		        	}else{
    		        	   $(".spinner").hide();
    		        	}
    		        
    		        }
    	});
    });
    
    $(".button-remove-gifting").click(function(){
       var product_id = $(this).data('id');
       var registry_id = $(this).data('registry');
       $(".spinner").show('slow');
        $.ajax({
    		    		url: ajax_url,
    		    		type: 'post',
    		    		data : {
    		    			action: 'dbt_remove_group_gifting',
    		    			product_id: product_id,
    		    			registry_id: registry_id,
    		    		
    		    		},
    		    	
    		        success:function(response){
    		        	let res = JSON.parse(response);
    		        	//console.log(res);
    		        
    		        	if(res == 1){
    		        	    $(".spinner").hide('slow');
    		        	    window.location.reload();
    		        	}else{
    		        	   $(".spinner").hide('slow');
    		        	}
    		        
    		        }
    	});
    });
});