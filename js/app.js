var pageCounter = 0;


jQuery( document ).ready( function( $ ) {
// firstPage
// prevPage
// nextPage
// lastPage

    $("#firstPage").click(function(e){
        
        e.preventDefault();
         $(".spinner").show();
        var productsPerpage = $("#productsPerPage").val();
        if( productsPerpage == ''){
            productsPerpage = 16;
        }
        $('input[name="category-check"]:checked').each(function(){
                if( $(this).val() == 0 ){
                    $('input[name="category-check"]').each(function(){
                        allcheckBox.push($(this).val() );
                    });
                }
    	        allcheckBox.push($(this).val() );   
    	});
    	   
    	allcheckBox = allcheckBox.reduce(function(a,b){if(a.indexOf(b)<0)a.push(b);return a;},[]);
    	const registry_id = $(this).data('registry_id');
        $.ajax({
	    		url: ajax_url,
	    		type: 'post',
	    		data : {
	    			action: 'dbtfetchRegistryPagination',
	    			productsPerpage: productsPerpage,
	    			allcheckBox: JSON.stringify(allcheckBox),
	    			registry_id: registry_id,
	    		},
	    	
	        success:function(response){
	        	let res = JSON.parse(response);
	        	//console.log(res);
	        	excludes = [];
	        	$(".spinner").hide();
	        	$(".products_box").html();
	        	if(res != ''){
	        	    $(".products_box").html(res);
	        	    $(".products_box").scrollView();
	        	}else{
	        	    $(".products_box").html('No Products in this category.');
	        	}
	        
	        }
		});
    });
    
    $("#lastPage").click(function(e){
         e.preventDefault();
         $(".spinner").show();
        var productsPerpage = $("#productsPerPage").val();
        if( productsPerpage == ''){
            productsPerpage = 16;
        }
        $('input[name="category-check"]:checked').each(function(){
                if( $(this).val() == 0 ){
                    $('input[name="category-check"]').each(function(){
                        allcheckBox.push($(this).val() );
                    });
                }
    	        allcheckBox.push($(this).val() );   
    	});
    	   
    	allcheckBox = allcheckBox.reduce(function(a,b){if(a.indexOf(b)<0)a.push(b);return a;},[]);
    	const registry_id = $(this).data('registry_id');
        $.ajax({
	    		url: ajax_url,
	    		type: 'post',
	    		data : {
	    			action: 'dbtfetchRegistryPaginationLast',
	    			productsPerpage: productsPerpage,
	    			allcheckBox: JSON.stringify(allcheckBox),
	    			registry_id: registry_id
	    		},
	    	
	        success:function(response){
	        	let res = JSON.parse(response);
	        	//console.log(res);
	        	excludes = [];
	        	$(".spinner").hide();
	        	$(".products_box").html();
	        	if(res != ''){
	        	    $(".products_box").html(res);
	        	    $(".products_box").scrollView();
	        	}else{
	        	    $(".products_box").html('No Products in this category.');
	        	}
	        
	        }
		});
    });
    
    $("#nextPage").click(function(e){
        
        e.preventDefault();
        $(".spinner").show();
        var productsPerpage = $("#productsPerPage").val();
        if( productsPerpage == ''){
            productsPerpage = 16;
            pageCounter = parseInt(pageCounter, 10) + parseInt(productsPerpage, 10);
        }else{
            pageCounter = parseInt(pageCounter, 10) + parseInt(productsPerpage, 10);
        }
        $('input[name="category-check"]:checked').each(function(){
                if( $(this).val() == 0 ){
                    $('input[name="category-check"]').each(function(){
                        allcheckBox.push($(this).val() );
                    });
                }
    	        allcheckBox.push($(this).val() );   
    	});
    	const registry_id = $(this).data('registry_id');
    	   
    	allcheckBox = allcheckBox.reduce(function(a,b){if(a.indexOf(b)<0)a.push(b);return a;},[]);
        $.ajax({
	    		url: ajax_url,
	    		type: 'post',
	    		data : {
	    			action: 'dbtfetchRegistryPaginationNext',
	    			productsPerpage: productsPerpage,
	    			allcheckBox: JSON.stringify(allcheckBox),
	    			pageCounter: pageCounter,
	    			registry_id: registry_id
	    		},
	    	
	        success:function(response){
	        	let res = JSON.parse(response);
	        	//console.log(res);
	        	excludes = [];
	        	$(".spinner").hide();
	        	$(".products_box").html();
	        	if(res != ''){
	        	    $(".products_box").html(res);
	        	    $(".products_box").scrollView();
	        	}else{
	        	    $(".products_box").html('<div class="col-md-12"><h4 style="color:#800080">No Products in this category.</h4></div>');
	        	}
	        
	        }
		});
    });
    
      $("#prevPage").click(function(e){
        
        e.preventDefault();
         
        if(pageCounter > 0){
                var productsPerpage = $("#productsPerPage").val();
            if( productsPerpage == ''){
                productsPerpage = 16;
                pageCounter -= productsPerpage;
                if(pageCounter == 0 ){
                     $("#prevPage").attr('disabled', true);
                }
            }else{
                pageCounter -= productsPerpage;
                
            }
               
                $('input[name="category-check"]:checked').each(function(){
                        if( $(this).val() == 0 ){
                            $('input[name="category-check"]').each(function(){
                                allcheckBox.push($(this).val() );
                            });
                        }
            	        allcheckBox.push($(this).val() );   
            	});
        	   
        	    allcheckBox = allcheckBox.reduce(function(a,b){if(a.indexOf(b)<0)a.push(b);return a;},[]);
                const registry_id = $(this).data('registry_id');
                $(".spinner").show();     
                $.ajax({
        	    		url: ajax_url,
        	    		type: 'post',
        	    		data : {
        	    			action: 'dbtfetchRegistryPaginationNext',
        	    			productsPerpage: productsPerpage,
        	    			allcheckBox: JSON.stringify(allcheckBox),
        	    			pageCounter: pageCounter,
        	    			registry_id: registry_id
        	    		},
        	    	
        	        success:function(response){
        	        	let res = JSON.parse(response);
        	        	//console.log(res);
        	        	excludes = [];
        	        	$(".spinner").hide();
        	        	$(".products_box").html();
        	        	if(res != ''){
        	        	    $(".products_box").html(res);
        	        	    $(".products_box").scrollView();
        	        	}else{
        	        	    $(".products_box").html('<div class="col-md-12"><h4 style="color:#800080">No Products in this category.</h4></div>');
        	        	}
        	        
        	        }
        		});
        }else{
            $("#prevPage").css({'background-color': '#222', 'color':'#fff'});
        }
    });

    $.fn.scrollView = function () {
      return this.each(function () {
        $('html, body').animate({
          scrollTop: $(this).offset().top
        }, 2000);
      });
    };
    
    
    $(".submit-feedback").click(function(){
        const firstname = $("#firstname").val();
        const feedback = $("#feedback").val();
        const lastname = $("#lastname").val();
        const email = $("#email").val();
        const feedback_type = $("#feedback_type").val();

        if(firstname == ''){
            $(".firstnameErr").html('<span class="text-danger">Firstname is required</span>');
        }else{
            $(".firstnameErr").html('');
        }
        
        if(feedback == ''){
            $(".describefeedbackErr").html('<span class="text-danger">Lastname is required</span>');
        }else{
            $(".describefeedbackErr").html('');
        }
        
        if(lastname == ''){
            $(".lastnameErr").html('<span class="text-danger">Last name is required</span>');
        }else{
            $(".lastnameErr").html('');
        }
        
        if(email == ''){
             $(".emailErr").html('<span class="text-danger">Email is required</span>');
        }else{
            $(".emailErr").html('');
        }
        
        if( feedback_type == ''){
            $(".feedback_typeErr").html("<span class='text-danger'>Feedback type is required</span>");
        }else{
            
        }
        
        if( firstname != '' && feedback != '' && lastname != '' && email != ''&& feedback_type != ''){
             $(".spinner").show();     
                $.ajax({
        	    		url: ajax_url,
        	    		type: 'post',
        	    		data : {
        	    			action: 'dbtfeedbackFormResponse',
        	    			firstname: firstname,
        	    			feedback: feedback,
        	    			lastname: lastname,
        	    			email: email,
        	    			feedback_type: feedback_type,
        	    		},
        	    	
        	        success:function(response){
        	        	let res = JSON.parse(response);
        	        	if(res == 1){
        	        	    $("#feebackRes").html('<span class="text-success">Feedback Sent</span>');
        	        	    $(".spinner").hide();
        	        	}
        	        
        	        }
        		});
        }
    });
    
    $(".delRegistry").click(function(){
        const reg_id = $(this).data('registry');
        const res = confirm("Are you sure you want to delete this registry?");
        if(res == true){
             $(".spinner").show();     
                $.ajax({
        	    		url: ajax_url,
        	    		type: 'post',
        	    		data : {
        	    			action: 'dbdelete_registry',
        	    			registry_id: reg_id,
        	    	
        	    		},
        	    	
        	        success:function(response){
        	        	let res = JSON.parse(response);
        	        	if(res == 1){
        	        	  window.location.reload();
        	        	    $(".spinner").hide();
        	        	}
        	        
        	        }
        		});
        }
    })

});