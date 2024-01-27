<?php
        	
		function check_if_page_exists($page_title){
			global $wpdb;
			$prefix = $wpdb->prefix."posts";
			$postman = $wpdb->get_var("SELECT ID FROM $prefix WHERE post_title = '$page_title'");
			if(empty($postman) ){
				return false;
			}else{
				return true;
			}
		}

		function dbt_load_scripts(){
		
			$my_js_ver  = '1.0';

			wp_enqueue_script( 'dbtjs', plugins_url( 'js/dbtjs.js', __FILE__ ), array('jquery'), '', true );
			wp_enqueue_script( 'appjs', plugins_url( 'js/app.js', __FILE__ ), array('jquery'), '', true );
			wp_enqueue_script('dbt-data-tables', '//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js', array('jquery'), '', true);
			
			//wp_enqueue_script( 'datepicker', plugins_url( 'js/datapicker.js', __FILE__ ), array('jquery'), '', true );
			//wp_register_style('datapicker_css', plugins_url( 'assets/css/datapicker.css', __FILE__), '', '');
			//wp_enqueue_style ( 'datapicker_css' );

			wp_enqueue_script( 'feather-icons', 'https://unpkg.com/feather-icons', '', '', true );
			wp_enqueue_script( 'paystack', 'https://js.paystack.co/v1/inline.js', '', '', true );
			
			
			wp_register_style('bootstrap_css', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css', '', '');
			wp_register_style('date_css', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css', '', '');
			wp_enqueue_style ( 'date_css' );
			
			wp_register_style('dbt-data-tables_css', '//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css', '','');
			wp_enqueue_style ( 'dbt-data-tables_css' );
			wp_enqueue_style ( 'bootstrap_css' );
			wp_enqueue_script( 'popperjs', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js', array('jquery'), '', true );
			wp_enqueue_script( 'bootstrap_js', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js', array('jquery'), '', true );
			wp_enqueue_script( 'datejs', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js', array('jquery'), '', true );
			

			wp_register_style('dbtcss',  plugins_url( 'css/dbtcss.css', __FILE__ ), '','');
			wp_enqueue_style ( 'dbtcss' );

		}
		add_action('wp_enqueue_scripts', 'dbt_load_scripts');
			
		function dbt_find_couple_registry(){
		    
		    //$registrant_fullname = sanitize_text_field($_POST['registrant_fullname']);
            $registry_title = sanitize_text_field($_POST['registry_title']);
            $url = home_url().'/find-a-registry/'.sanitize_title($registry_title);
            $arr = array(1, $url);
            echo json_encode( $arr );
		    die();
		}
		add_action('wp_ajax_dbt_find_couple_registry', 'dbt_find_couple_registry');
		add_action('wp_ajax_nopriv_dbt_find_couple_registry', 'dbt_find_couple_registry');
		
		function findCoupleRegistryUsingRegistryTitle($post_title){
		    global $wpdb;
		    $prefix = $wpdb->prefix.'posts';
		    $postman = $wpdb->get_results("SELECT * FROM $prefix WHERE post_title = '$post_title' AND post_type = 'gift_registry' AND post_status = 'publish'");
		    return $postman;
		}

		function sirlwf_addAjaxFrontend(){

		?>
			<script>
				var ajax_url = "<?php echo admin_url('admin-ajax.php') ?>";
			</script>
		<?php
		}
		add_action('wp_head', 'sirlwf_addAjaxFrontend');
        
        function email_template(){
             $head = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                    <html xmlns="http://www.w3.org/1999/xhtml">
                    
                    <head>
                      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                      <title>%%Email_Title%%</title>
                      <style type="text/css">
                        /* /\/\/\/\/\/\/\/\/ CLIENT-SPECIFIC STYLES /\/\/\/\/\/\/\/\/ */
                        #outlook a{padding:0;} /* Force Outlook to provide a "view in browser" message */
                        .ReadMsgBody{width:100%;} .ExternalClass{width:100%;} /* Force Hotmail to display emails at full width */
                        .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height: 100%;} /* Force Hotmail to display normal line spacing */
                        body, table, td, p, a, li, blockquote{-webkit-text-size-adjust:100%; -ms-text-size-adjust:100%;} /* Prevent WebKit and Windows mobile changing default text sizes */
                        table, td{mso-table-lspace:0pt; mso-table-rspace:0pt;} /* Remove spacing between tables in Outlook 2007 and up */
                        td ul li {
                          font-size: 16px;
                        }
                        /* /\/\/\/\/\/\/\/\/ RESET STYLES /\/\/\/\/\/\/\/\/ */
                        body {margin: 0; padding: 0; min-width: 100%!important;}
                        img{
                          max-width:100%;
                          border:0;
                          line-height:100%;
                          outline:none;
                          text-decoration:none;
                        }
                        table{border-collapse:collapse !important;}
                        .content {width: 100%; max-width: 600px; border-top: solid 5px #012B7A; border-left: solid 1px #eee;border-right: solid 1px #eee; border-bottom: solid 1px #eee;}
                         .content-footer {width: 100%; max-width: 600px;  }
                        .content img { height: auto; min-height: 1px; }
                    
                        #bodyCellFooter{margin:0; padding:0; width:100% !important;padding-top:19px;padding-bottom:15px;}
                    
                        .templateContainer{
                          border: none;
                          border-radius: 4px;
                          background-clip: padding-box;
                          border-spacing: 0;
                        }
                    
                        /**
                        * @tab Page
                        * @section heading 1
                        * @tip Set the styling for all first-level headings in your emails. These should be the largest of your headings.
                        * @style heading 1
                        */
                        h1{
                          color:#2e2e2e;
                          display:block;
                          font-family:Helvetica;
                          font-size:26px;
                          line-height:1.385em;
                          font-style:normal;
                          font-weight:normal;
                          letter-spacing:normal;
                          margin-top:0;
                          margin-right:0;
                          margin-bottom:15px;
                          margin-left:0;
                          text-align:left;
                        }
                    
                        /**
                        * @tab Page
                        * @section heading 2
                        * @tip Set the styling for all second-level headings in your emails.
                        * @style heading 2
                        */
                        h2{
                          color:#2e2e2e;
                          display:block;
                          font-family:Helvetica;
                          font-size:22px;
                          line-height:1.455em;
                          font-style:normal;
                          font-weight:normal;
                          letter-spacing:normal;
                          margin-top:0;
                          margin-right:0;
                          margin-bottom:15px;
                          margin-left:0;
                          text-align:left;
                        }
                    
                        /**
                        * @tab Page
                        * @section heading 3
                        * @tip Set the styling for all third-level headings in your emails.
                        * @style heading 3
                        */
                        h3{
                          color:#545454;
                          display:block;
                          font-family:Helvetica;
                          font-size:18px;
                          line-height:1.444em;
                          font-style:normal;
                          font-weight:normal;
                          letter-spacing:normal;
                          margin-top:0;
                          margin-right:0;
                          margin-bottom:15px;
                          margin-left:0;
                          text-align:left;
                        }
                    
                        /**
                        * @tab Page
                        * @section heading 4
                        * @tip Set the styling for all fourth-level headings in your emails. These should be the smallest of your headings.
                        * @style heading 4
                        */
                        h4{
                          color:#545454;
                          display:block;
                          font-family:Helvetica;
                          font-size:14px;
                          line-height:1.571em;
                          font-style:normal;
                          font-weight:normal;
                          letter-spacing:normal;
                          margin-top:0;
                          margin-right:0;
                          margin-bottom:15px;
                          margin-left:0;
                          text-align:left;
                        }
                    
                    
                        h5{
                          color:#545454;
                          display:block;
                          font-family:Helvetica;
                          font-size:13px;
                          line-height:1.538em;
                          font-style:normal;
                          font-weight:normal;
                          letter-spacing:normal;
                          margin-top:0;
                          margin-right:0;
                          margin-bottom:15px;
                          margin-left:0;
                          text-align:left;
                        }
                    
                    
                        h6{
                          color:#545454;
                          display:block;
                          font-family:Helvetica;
                          font-size:12px;
                          line-height:2.000em;
                          font-style:normal;
                          font-weight:normal;
                          letter-spacing:normal;
                          margin-top:0;
                          margin-right:0;
                          margin-bottom:15px;
                          margin-left:0;
                          text-align:left;
                        }
                    
                        p {
                          color:#545454;
                          display:block;
                          font-family:Helvetica;
                          font-size:16px;
                          line-height:1.500em;
                          font-style:normal;
                          font-weight:normal;
                          letter-spacing:normal;
                          margin-top:0;
                          margin-right:0;
                          margin-bottom:15px;
                          margin-left:0;
                          text-align:left;
                        }
                    
                        .unSubContent a:visited { color: #a1a1a1; text-decoration:underline; font-weight:normal;}
                        .unSubContent a:focus   { color: #a1a1a1; text-decoration:underline; font-weight:normal;}
                        .unSubContent a:hover   { color: #a1a1a1; text-decoration:underline; font-weight:normal;}
                        .unSubContent a:link   { color: #a1a1a1 ; text-decoration:underline; font-weight:normal;}
                        .unSubContent a .yshortcuts   { color: #a1a1a1 ; text-decoration:underline; font-weight:normal;}
                    
                        .unSubContent h6 {
                          color: #a1a1a1;
                          font-size: 12px;
                          line-height: 1.5em;
                          margin-bottom: 0;
                        }
                    
                        .bodyContent{
                          color:#505050;
                          font-family:Helvetica;
                          font-size:14px;
                          line-height:150%;
                          padding-top:1.143em;
                          padding-right:1.5em;
                          padding-left:1.5em;
                          padding-bottom:1.143em;
                          text-align:left;
                        }
                        .bodyTopContent{
                          color:#505050;
                          font-family:Helvetica;
                          font-size:14px;
                          line-height:150%;
                          padding-top:1.143em;
                          padding-right:3.5em;
                          padding-left:3.5em;
                          padding-bottom:1.143em;
                          text-align:center;
                          width: 40%;
                        }
                        .bodyTopRightContent{
                          color:#505050;
                          font-family:Helvetica;
                          font-size:14px;
                          line-height:150%;
                          padding-top:2.143em;
                          padding-right:3.5em;
                          padding-left:3.5em;
                          padding-bottom:1.143em;
                          text-align:right;
                          float: right;
                          
                        }
                        .logo_text{
                          font-weight: bolder;
                        }
                    
                        /**
                        * @tab Body
                        * @section body link
                        * @tip Set the styling for your email\'s main content links. Choose a color that helps them stand out from your text.
                        */
                        a:visited { color: #3386e4; text-decoration:none;}
                        a:focus   { color: #3386e4; text-decoration:none;}
                        a:hover   { color: #3386e4; text-decoration:none;}
                        a:link   { color: #3386e4 ; text-decoration:none;}
                        a .yshortcuts   { color: #3386e4 ; text-decoration:none;}
                    
                        .bodyContent img{
                          height:auto;
                          max-width:498px;
                        }
                    
                        /**
                        * @tab Footer
                        * @section footer link
                        * @tip Set the styling for your email\'s footer links. Choose a color that helps them stand out from your text.
                        */
                        a.blue-btn {
                          background: #023486;
                          display: block;
                          color: #FFFFFF;
                          border-top:10px solid #023486;
                          border-bottom:10px solid #023486;
                          border-left:20px solid #023486;
                          border-right:20px solid #023486;
                          text-decoration: none;
                          font-size: 14px;
                          margin-top: 1.0em;
                          border-radius: 3px 3px 3px 3px;
                          background-clip: padding-box;
                          text-align:center;
                        }
                      a.border-0-btn {
                          background: #fff;
                          display: block;
                          color: #023486;
                          padding: 10px;
                          border:1px solid #5098ea;
                          text-decoration: none;
                          font-size: 14px;
                          margin-top: 1.0em;
                          border-radius: 3px 3px 3px 3px;
                          background-clip: padding-box;
                          text-align:center;
                        }
                    
                    
                        @media only screen and (max-width: 550px), screen and (max-device-width: 550px) {
                          body[yahoo] .hide {display: none!important;}
                          body[yahoo] .buttonwrapper {background-color: transparent!important;}
                          body[yahoo] .button {padding: 0px!important;}
                          body[yahoo] .button a {background-color: #e05443; padding: 15px 15px 13px!important;}
                          body[yahoo] .unsubscribe { font-size: 14px; display: block; margin-top: 0.714em; padding: 10px 50px; background: #2f3942; border-radius: 5px; text-decoration: none!important;}
                        }
                        /*@media only screen and (min-device-width: 601px) {
                          .content {width: 600px !important;}
                        }*/
                        @media only screen and (max-width: 480px), screen and (max-device-width: 480px) {
                          h1 {
                            font-size:34px !important;
                          }
                          h2{
                            font-size:30px !important;
                          }
                          h3{
                            font-size:24px !important;
                          }
                          h4{
                            font-size:18px !important;
                          }
                          h5{
                            font-size:16px !important;
                          }
                          h6{
                            font-size:14px !important;
                          }
                          p {
                            font-size: 18px !important;
                          }
                          .bodyContent {
                            padding: 6% 5% 6% 6% !important;
                          }
                          .bodyContent img {
                            max-width: 100% !important;
                          }
                          #bodyCellFooter {padding-top: 20px !important;}
                          .hide {display:none !important;}
                        }
                        .ii a[href] {color: inherit !important;}
                        span > a, span > a[href] {color: inherit !important;}
                        a > span, .ii a[href] > span {text-decoration: inherit !important;}
                      </style>
                    </head>
                    <body yahoo bgcolor="#ffffff">
                                            <table width="100%" bgcolor="#ffffff" border="0" cellpadding="10" cellspacing="0">
                                            <tr>
                                              <td>
                                                <!--[if (gte mso 9)|(IE)]>
                                                  <table width="600" align="center" cellpadding="0" cellspacing="0" border="0">
                                                    <tr>
                                                      <td>
                                                <![endif]-->
                                                <table bgcolor="#ffffff" class="content" align="center" cellpadding="0" cellspacing="0" border="0">
                                                  <tr>
                                                    <td align="center" valign="top">
                                                        <!-- BEGIN BODY // -->
                                                        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="templateContainer" style="border-bottom: none;">
                                                          <tr>
                                                            <td valign="top" class="bodyTopContent" mc:edit="body_content">';
                                                            
                return $head;
        }
        
		function dbt_create_registry(){
		    
			
			$title = sanitize_text_field($_POST['registryTitle']);
			$content = sanitize_text_field($_POST['registry_event_message']);
			$author = sanitize_text_field($_POST['registry_author']);
			$event_date = sanitize_text_field($_POST['registry_event_date']);
			$event_type = sanitize_text_field($_POST['registry_event_type']);
			$registry_privacy = sanitize_text_field($_POST['registryPrivacy']);
			$co_registrant_check = sanitize_text_field($_POST['registryCoRegistrantsCheck']);
			$coRegistrantLastName = sanitize_text_field($_POST['coRegistrantLastName']);
			$coRegistrantFirstName = sanitize_text_field($_POST['coRegistrantFirstName']);
			$coRegistrantEmail = sanitize_text_field($_POST['coRegistrantEmail']);
			$eventLocation = sanitize_text_field($_POST['registry_event_location']);
			$password = sanitize_text_field($_POST['password']);
			$registry_cash_gift = sanitize_text_field($_POST['registry_cash_gift']);

			$post_details = array(
			  'post_title'    => $title,
			  'post_content'  => $content,
			  'post_status'   => 'private',
    			  'post_author'   => $author,
			  'post_type' => 'gift_registry'
		   );
	   		$registry_id = wp_insert_post( $post_details );
	   		
	   		
				
			 		
	   		update_post_meta($registry_id, 'event_date', $event_date);
	   		update_post_meta($registry_id, 'event_type', $event_type);
	   		update_post_meta($registry_id, 'eventLocation', $eventLocation);
	   		update_post_meta($registry_id, 'registry_privacy', $registry_privacy);
	   		update_post_meta($registry_id, 'co_registrant_check', $co_registrant_check);
	   		update_post_meta($registry_id, 'password', $password);
	   		update_post_meta($registry_id, 'cash_gift_yes_or_no', $registry_cash_gift);
	   		if($co_registrant_check == 1 ){
	   			update_post_meta($registry_id, 'coRegistrantLastName', $coRegistrantLastName);
	   			update_post_meta($registry_id, 'coRegistrantFirstName', $coRegistrantFirstName);
	   			update_post_meta($registry_id, 'coRegistrantEmail', $coRegistrantEmail);
	   		}
	   		$IMGFileName = $_FILES["file"]["name"];
	   		$upload = wp_upload_bits($IMGFileName, null, file_get_contents($_FILES["file"]["tmp_name"]) );
	   		// check and return file type
			 $imageFile = $upload['file'];
			 $wpFileType = wp_check_filetype($imageFile, null);
			 
			 // Attachment attributes for file
			 $attachment = array(
			 'post_mime_type' => $wpFileType['type'],  // file type
			 'post_title' => sanitize_file_name($imageFile),  // sanitize and use image name as file name
			 'post_content' => '',  // could use the image description here as the content
			 'post_status' => 'inherit'
			 );
			 
			 // insert and return attachment id
			 $attachmentId = wp_insert_attachment( $attachment, $imageFile, $registry_id );
			 
			 // insert and return attachment metadata
			 $attachmentData = wp_generate_attachment_metadata( $attachmentId, $imageFile);
			 
			 // update and return attachment metadata
			 wp_update_attachment_metadata( $attachmentId, $attachmentData );
			 
			 // finally, associate attachment id to post id
			 $success = set_post_thumbnail( $registry_id, $attachmentId );

	   		if($registry_id != 0){
	   			//echo json_encode(1);
	   			//$permalink = array(get_permalink($registry_id) );
	   			$permalink = home_url().'/registry/shop/'.$registry_id;
	   			
	   			$current_user = wp_get_current_user();
    	 		$username = $current_user->user_login;
    	 		$user_id = $current_user->ID;
    			$user_email = $current_user->user_email;
    	 		$billing_last_name = get_user_meta($user_id, 'billing_last_name', true);
    	 		$billing_first_name = get_user_meta($user_id, 'billing_first_name', true);
    	 		
    	 		$array =array($permalink, $registry_id);
	   			echo json_encode($array);
	   			$subject = 'Your new Gift Registry was created successfully';
	   			$first_paragraph = '';
	   			$second_paragraph = 'You have successfully created your Gift Registry, <strong>"'.$title.'"</strong> Gift Registry.<br>';
	   			$second_paragraph .= "<br>Don't wait! go ahead and select your most desired gifts, we promise you’ll be thrilled by our collection.<br><br><a href='".$permalink."'>Start adding your Gifts now</a>, <br>Always here for you,<br>Titi";
    			$receiver = 'Hi '.$billing_last_name.' '.$billing_first_name;
    			$main_paragraphs = '<p>'.$first_paragraph.'</p>';
    			$main_paragraphs .= '<p>'.$second_paragraph.'</p>';
    			$ads_text ="You can also create your own free Gift registry for your Wedding, Birthday, Anniversary or Baby shower/naming all on Silver Castle.";
    			
                
    			$array = array('{{%%greet_receiver%%}}','{{%%client_text%%}}','{{%%cta_button_url%%}}','{{%%cta_button_text%%}}','{{%%ads_text%%}}','
','{{%%ads_button_text%%}}','{{%%Company_name%%}}','{{%%Company_address%%}}','{{%%Company_phone%%}}','{{%%banner_url%%}}','{{%%ads_btn_display%%}}', '{{%%cta_btn_display%%}}','{{%%display_ads%%}}' );
                
                $new_array = array($receiver,$main_paragraphs,'','',$ads_text,'
                        ','','Silver Castle Gift Registry','Lagos, Nigeria','','https://silvercastle.co/wp-content/uploads/2019/12/email-banner.jpg','display:none;', 'display:none;','display:none;' );
                
                $new_mail = str_replace($array, $new_array, silvercastle_email_body_func() );
                        	
    			$headers = array('Content-Type: text/html; charset=UTF-8');
			    wp_mail( $user_email, $subject, $new_mail, $headers );
			    
			    $new_mail = $title.' registry was created on '.date('d-m-Y');
			    $new_mail .= '<br>Registrant Fullname: '.$billing_first_name.' '.$billing_last_name;
			    $new_mail .= '<br>Registrant Location: '.$eventLocation;
			    $new_mail .= '<br>Event Date: '.$event_date;
			    $new_mail .= '<br>Event Type: '.$event_type;
			    dbt_mail_admin('New Registry Alert', $new_mail);
    			
	   		}else{
	   			echo json_encode(0);
	   		}
			die();
		}
		add_action("wp_ajax_dbt_create_registry", "dbt_create_registry");
		add_action("wp_ajax_nopriv_dbt_create_registry", "dbt_create_registry");
		
		function dbt_mail_admin($subject, $new_mail){
		    $headers = array('Content-Type: text/html; charset=UTF-8');
		    $admin_email = get_option('admin_email');
		    wp_mail( $admin_email, $subject, $new_mail, $headers );
		}

		function dbt_updateRegistry(){
			$registry_id = $_POST['registry_id'];
			$title = sanitize_text_field($_POST['registryTitle']);
			$content = sanitize_text_field($_POST['registry_event_message']);
			$author = sanitize_text_field($_POST['registry_author']);
			$event_date = sanitize_text_field($_POST['registry_event_date']);
			$event_type = sanitize_text_field($_POST['registry_event_type']);
			$registry_privacy = sanitize_text_field($_POST['registryPrivacy']);
			$co_registrant_check = sanitize_text_field($_POST['registryCoRegistrantsCheck']);
			$coRegistrantLastName = sanitize_text_field($_POST['coRegistrantLastName']);
			$coRegistrantFirstName = sanitize_text_field($_POST['coRegistrantFirstName']);
			$coRegistrantEmail = sanitize_text_field($_POST['coRegistrantEmail']);
			$eventLocation = sanitize_text_field($_POST['registry_event_location']);
			
			$registry_cash_gift = sanitize_text_field($_POST['registry_cash_gift']);
            
           
			$post = array(
			  'ID' => $registry_id,
			  'post_title'    => $title,
			  'post_content'  => $content,
			  'post_status'   => 'publish',
			  'post_author'   => $author,
			  'post_type' => 'gift_registry'
		   );
	   		$registry_id =  wp_update_post( $post );
	   		update_post_meta($registry_id, 'event_date', $event_date);
	   		update_post_meta($registry_id, 'event_type', $event_type);
	   		update_post_meta($registry_id, 'eventLocation', $eventLocation);
	   		update_post_meta($registry_id, 'registry_privacy', $registry_privacy);
	   		update_post_meta($registry_id, 'co_registrant_check', $co_registrant_check);
	   		update_post_meta($registry_id, 'cash_gift_yes_or_no', $registry_cash_gift);
	   		if($co_registrant_check == 1 ){
	   			update_post_meta($registry_id, 'coRegistrantLastName', $coRegistrantLastName);
	   			update_post_meta($registry_id, 'coRegistrantFirstName', $coRegistrantFirstName);
	   			update_post_meta($registry_id, 'coRegistrantEmail', $coRegistrantEmail);
	   		}
	   		if($_FILES["file"]["name"] != '' ){


		   		$IMGFileName = $_FILES["file"]["name"];
		   		$upload = wp_upload_bits($IMGFileName, null, file_get_contents($_FILES["file"]["tmp_name"]) );
		   		// check and return file type
				 $imageFile = $upload['file'];
				 $wpFileType = wp_check_filetype($imageFile, null);
				 
				 // Attachment attributes for file
				 $attachment = array(
				 'post_mime_type' => $wpFileType['type'],  // file type
				 'post_title' => sanitize_file_name($imageFile),  // sanitize and use image name as file name
				 'post_content' => '',  // could use the image description here as the content
				 'post_status' => 'inherit'
				 );
				 
				 // insert and return attachment id
				 $attachmentId = wp_insert_attachment( $attachment, $imageFile, $registry_id );
				 
				 // insert and return attachment metadata
				 $attachmentData = wp_generate_attachment_metadata( $attachmentId, $imageFile);
				 
				 // update and return attachment metadata
				 wp_update_attachment_metadata( $attachmentId, $attachmentData );
				 
				 // finally, associate attachment id to post id
				 $success = set_post_thumbnail( $registry_id, $attachmentId );
			}
			//echo json_encode($registry_cash_gift);
	   		if($registry_id != 0){
	   			//echo json_encode(1);
	   			$permalink = array(get_permalink($registry_id) );
	   			echo json_encode($permalink);
	   		}else{
	   			echo json_encode(0);
	   		}
	   		die();
		}
		add_action('wp_ajax_dbt_updateRegistry', 'dbt_updateRegistry');
		add_action('wp_ajax_nopriv_dbt_updateRegistry', 'dbt_updateRegistry');

        function dbt_updateUserAcct(){
            $lastname = sanitize_text_field($_POST['lastname']);
            $firstname = sanitize_text_field($_POST['firstname']);
            $password = sanitize_text_field($_POST['password']);
            $cpassword = sanitize_text_field($_POST['cpassword']);
            $user_id = sanitize_text_field($_POST['user_id']);
            $phone = sanitize_text_field($_POST['phone']);
            
            if($password == $cpassword){
                wp_set_password($password, $user_id);
            }
            $update_user = wp_update_user( array('ID' => $user_id, 'first_name' => $firstname, 'last_name' => $lastname) );
           update_user_meta($user_id, 'billing_last_name', $lastname);
           update_user_meta($user_id, 'billing_first_name', $firstname);
           update_user_meta($user_id, 'billing_phone', $phone);
            echo json_encode(1);
            die();
        }
        add_action('wp_ajax_dbt_updateUserAcct', 'dbt_updateUserAcct');
        add_action('wp_ajax_nopriv_dbt_updateUserAcct', 'dbt_updateUserAcct');
        
		function fetchAllRegistriesByAuthor($author_id){
			global $wpdb;
			$prefix = $wpdb->prefix."posts";
			$postman = $wpdb->get_results("SELECT * FROM $prefix WHERE post_type='gift_registry' AND post_author = '$author_id' AND post_status != 'trash' ");
			//$q = "SELECT * FROM $prefix WHERE post_type='gift_registry' AND post_author = '$author_id' AND post_status = 'publish' ";
			return $postman;
			//return $q;
		}
		
		function fetchAllPublishedRegistriesByAuthor($author_id){
		    global $wpdb;
			$prefix = $wpdb->prefix."posts";
			$postman = $wpdb->get_results("SELECT * FROM $prefix WHERE post_type='gift_registry' AND post_author = '$author_id' AND post_status = 'publish' ");
			//$q = "SELECT * FROM $prefix WHERE post_type='gift_registry' AND post_author = '$author_id' AND post_status = 'publish' ";
			return $postman;
			//return $q;
		}
		
		function fetchAllRegistries(){
			global $wpdb;
			$prefix = $wpdb->prefix."posts";
			$postman = $wpdb->get_results("SELECT * FROM $prefix WHERE post_type='gift_registry' AND post_status !='trash'");
			return $postman;
			
		}
		function fetchRegistryByID($registry_id){
			global $wpdb;
			$prefix = $wpdb->prefix."posts";
			$postman = $wpdb->get_results("SELECT * FROM $prefix WHERE ID = '$registry_id'");
			//$q = "SELECT * FROM $prefix WHERE post_type='gift_registry' AND post_author = '$author_id' AND post_status = 'publish'";
			return $postman;
			//return $q;
		}

		function loadProducts($limit){
			global $wpdb;
			$prefix = $wpdb->prefix."posts";
			$limit = ($limit == 'all')?'':'LIMIT 0, $limit';
			$postman = $wpdb->get_results("SELECT * FROM $prefix WHERE post_type = 'product' AND post_status='publish' '$limit'");
			return $postman;
		}
		
		function countAllProducts(){
			global $wpdb;
			$prefix = $wpdb->prefix."posts";
			$postman = $wpdb->get_var("SELECT count(*) as total FROM $prefix WHERE post_type = 'product' AND post_status='publish'");
			return $postman;
		}
		
		function loadProductsByRegistryID($registry_id){
			global $wpdb;
			$prefix = $wpdb->prefix."dbt_giftregistry_shop";
			$postman = $wpdb->get_results("SELECT product_id FROM $prefix WHERE registry_id = '$registry_id' ");
			$prefix_2 = $wpdb->prefix."posts";
			$products_arr = array();
			foreach($postman as $product_id){
				$product_id = $product_id->product_id;
				$postman2 = $wpdb->get_row("SELECT * FROM $prefix_2 WHERE ID = '$product_id'");
				if(!empty($postman2) ){
				    array_push($products_arr, $postman2);
				}else{
				    
				}
			}
			return $products_arr;
		}

		function dbtaddProductToRegistry(){
			global $wpdb;
			//print_r($_POST);
			$product_id = $_POST['product_id'];
			$registry = $_POST['registry'];
			$priority = $_POST['priority'];
			$qty = $_POST['qty'];

			$insert_id = create_product_entry($registry, $product_id, $qty, $priority);
			if($insert_id > 0 ){
				echo json_encode(1);
			}else{
				echo json_encode(0);
			}
			die();
		}
		add_action('wp_ajax_dbtaddProductToRegistry', 'dbtaddProductToRegistry');
		add_action('wp_ajax_nopriv_dbtaddProductToRegistry', 'dbtaddProductToRegistry');
		
		function dbtupdateProductRegistry(){
		    global $wpdb;
			$product_id = $_POST['product_id'];
			$registry = $_POST['registry'];
			$priority = $_POST['priority'];
			$qty = $_POST['qty'];

			$insert_id = update_product_entry($registry, $product_id, $qty, $priority);
			if($insert_id == true ){
				echo json_encode(1);
			}else{
				echo json_encode(0);
			}
			die();
		    
		}
		add_action('wp_ajax_dbtupdateProductRegistry', 'dbtupdateProductRegistry');
		add_action('wp_ajax_nopriv_dbtupdateProductRegistry', 'dbtupdateProductRegistry');

		function create_product_entry($registry_id, $product_id, $qty, $priority){
			global $wpdb;
			$prefix = $wpdb->prefix."dbt_giftregistry_shop";
			$date_added = date('Y-m-d');
			$date_modified= '';
			$postman = $wpdb->query("INSERT INTO $prefix(`registry_id`, `product_id`, `qty`, `priority`, `date_added`, `date_modified`) VALUES ('$registry_id', '$product_id', '$qty', '$priority', '$date_added', '$date_modified')");
			return $wpdb->insert_id;
		}
		
		function update_product_entry($registry_id, $product_id, $qty, $priority){
			global $wpdb;
			$prefix = $wpdb->prefix."dbt_giftregistry_shop";
			
			$date_modified= date('Y-m-d');
			$postman = $wpdb->query("UPDATE $prefix SET qty = '$qty', priority = '$priority', date_modified ='$date_modified' WHERE registry_id = '$registry_id' AND product_id = '$product_id'");
			if($postman){
			    return true;
			}
		}
		
		function dbtRemoveProductRegistry(){
		    global $wpdb;
		    $prefix = $wpdb->prefix."dbt_giftregistry_shop";
			$product_id = $_POST['product_id'];
			$registry = $_POST['registry'];
			$postman = $wpdb->query("DELETE FROM $prefix WHERE registry_id = '$registry' AND product_id = '$product_id' ");
			if($postman){
			    echo  json_encode(1);
			}else{
			    echo  json_encode(0);
			}
		    die();
		
		}
		add_action('wp_ajax_dbtRemoveProductRegistry', 'dbtRemoveProductRegistry');
		add_action('wp_ajax_nopriv_dbtRemoveProductRegistry', 'dbtRemoveProductRegistry');

		function check_if_product_exists_in_registry($product_id, $registry){

			global $wpdb;
			$prefix = $wpdb->prefix."dbt_giftregistry_shop";
			$postman = $wpdb->get_row("SELECT * FROM $prefix WHERE product_id = '$product_id' AND registry_id = '$registry'");
			if(count($postman) > 0 ){
				return true;
			}else{
				return false;
			}
		}

		function count_my_registry_gifts($registry_id){
			global $wpdb;
			$prefix = $wpdb->prefix."dbt_giftregistry_shop";
			$postman = $wpdb->get_var("SELECT count(*) FROM $prefix WHERE registry_id = '$registry_id'");
			if($postman > 0 ){
				return $postman;
			}else{
				return $postman;
			}
		}
		
		function get_all_products_from_registry($registry_id){
		    global $wpdb;
		    $prefix = $wpdb->prefix."dbt_giftregistry_shop";
		    $postman = $wpdb->get_results("SELECT * FROM $prefix WHERE registry_id = '$registry_id'");
		    return $postman;
		}

		function fetch_giftregistry_data($registry_id, $product_id, $data){
			global $wpdb;
			$prefix = $wpdb->prefix."dbt_giftregistry_shop";
			$postman = $wpdb->get_var("SELECT $data FROM $prefix WHERE product_id = '$product_id' AND registry_id = '$registry_id'");
			//$q = "SELECT '$data' FROM $prefix WHERE product_id = '$product_id' AND registry_id = '$registry'";
			return $postman;
			//return $q;

		}
		
		function dbtaddProductToSales_cashgift(){
		    $registry_id = $_POST['registry'];
            $price = $_POST['price'];
            $payee_data = $_POST['user_data'];
            $message = $_POST['message'];
            $date_bought = date('Y-m-d');
            //($registry_id, $product_id,$date_bought, $qty, $price, $payee_data)
            $user_id = get_post_field( 'post_author', $registry_id );
            insert_into_cashgift($registry_id, $user_id, $price);
            $insert_id = create_product_sales($registry_id, 0, $date_bought, 0, $price, json_encode($payee_data));
            if($insert_id > 0 ){
				
				$to = $payee_data['email'];
        		$subject = 'Your Contribution was successful';
        	
	   			$body = email_template();
	   		
			    $first_paragraph = 'You have successfully contributed to "'.get_the_title($registry_id).'" Cash Gift.';
			    $first_paragraph .= '<p>'.$message.'</p>';
			    $second_paragraph = '<div style="border: solid 2px #800080">You can also create your own Gift Registry for your Wedding, Baby Shower, Birthday or Anniversary on Silver Castle Gift Registry';
			    $second_paragraph .= '<br><a href="https://silvercastle.co/registry/new-registry" target="_blank" style="color:#800080">Click here to start</a>';
			    $second_paragraph .= '</div>';
			    //$second_paragraph .= '<br>Silver Castle team.';
			   // $second_paragraph .= '<br>PS: Remember, we are here to make your other occasions and life events such as birthdays, naming, wedding and anniversaries special.';
    			$body .= '<p>Hello '.$payee_data['firstname'].' '.$payee_data['lastname'].',</p>';
    			$body .= '<p>'.$first_paragraph.'</p>';
    			$body .= '<p>'.$second_paragraph.'</p>';
    			$body .= ' </td></tr>';
    			$body .= '<tr>
    				<td align="center" valign="top" id="bodyCellFooter" class="unSubContent">
    					<table width="100%" border="0" cellpadding="0" cellspacing="0" id="templateContainerFooter">
    						<tr>
    							<td valign="top" width="100%" mc:edit="footer_unsubscribe">
    								<h6 style="text-align:center;">Silver Castle Gift Registry</h6>
    								 
    								<h6 style="text-align:center;">Lagos, Nigeria</h6>
    								<h6 style="text-align:center;margin-top: 7px;"><a href="--unsubscribe--">unsubscribe</a></h6>
    							</td>
    						</tr>
    					</table>
    				</td>
    			</tr>';
                $body .= '</table>
                </td></tr></table></td></tr></table></body></html>';
    			
    			$headers = array('Content-Type: text/html; charset=UTF-8');
			    wp_mail( $to, $subject, $body, $headers );
			    
            }
            echo json_encode(1);
            die();
		}
		add_action('wp_ajax_dbtaddProductToSales_cashgift', 'dbtaddProductToSales_cashgift');
		add_action('wp_ajax_nopriv_dbtaddProductToSales_cashgift', 'dbtaddProductToSales_cashgift');

		function dbtaddProductToSales(){
		    global $html_template, $woocommerce;;
			$registry_id = $_POST['registry'];
			$product_id = $_POST['product_id'];
			$date_bought = date('Y-m-d');
			$qty = $_POST['qty'];
			$price = $_POST['price'];
			$payee_data = $_POST['user_data'];
			$group_gift_flag = $_POST['group_gift_flag'];
			
			$product_data = wc_get_product($product_id);
			if ( 'crowding' == $product_data->get_type() || $group_gift_flag == 1 ) { 
			    create_crowdsourcing_trail($registry_id, $product_id, $price);
			    
			}

			$insert_id = create_product_sales($registry_id, $product_id,$date_bought, $qty, $price, json_encode($payee_data));
			if($insert_id > 0 ){
				
				$to = $payee_data['email'];
				
				if ( 'crowding' == $product_data->get_type() || $group_gift_flag == 1 ) {
        		    $subject = 'You have successfully made a contribution towards  '.get_the_title($product_id);
				}else{
				    $subject = 'You have successfully paid for '.get_the_title($product_id);
				}
        	
	   			$body = email_template();
	   		    
	   		    if ( 'crowding' == $product_data->get_type() || $group_gift_flag == 1 ) {
	   		    
	   		        $first_paragraph = 'Thank you for making a Group gifting contribution towards "'.get_the_title($product_id).'"';
	   		    }else{
			        $first_paragraph = 'Thank you for Purchasing "'.get_the_title($product_id).'"';
	   		    }
    			
    		    $receiver  = 'Hello '.$payee_data['firstname'].' '.$payee_data['lastname'];
    			$main_paragraphs =  $first_paragraph;
    			
    			
    			$cta_btn_url = home_url().'/feedback-form/';
    			$cta_btn_text ='Fill Feedback form';
    			$ads_btn_url = home_url().'/registry/new-registry';
    			$ads_btn_text = 'Click here to start your free Gift Registry today';
    			$ads_btn_text = 'Create My Registry';
    			$ads_text = 'You can also create other Gift registries for your life celebrations like your Wedding, Birthday, Anniversary, Baby shower, it’s free';
    			$banner_url = 'https://silvercastle.co/wp-content/uploads/2019/12/email-banner.jpg';
    		    
    		    $array = array('{{%%greet_receiver%%}}','{{%%client_text%%}}','{{%%cta_button_url%%}}','{{%%cta_button_text%%}}','{{%%ads_text%%}}','{{%%ads_button_text%%}}','{{%%Company_name%%}}','{{%%Company_address%%}}','{{%%Company_phone%%}}','{{%%banner_url%%}}',
                        '{{%%ads_btn_display%%}}', '{{%%cta_btn_display%%}}','{{%%display_ads%%}}','{{__ads_btn_url_)}}' );
                
                $new_array = array($receiver, $main_paragraphs,$cta_btn_url,$cta_btn_text,$ads_text,$ads_btn_text,'Silver Castle Gift Registry','Lagos, Nigeria',
                '',$banner_url,'', 'display:none;','',$ads_btn_url );
                
                echo'<pre>';
                print_r($array);
                echo '</pre>';
                
                echo'<pre>';
                print_r($new_array);
                echo '</pre>';
                
                $new_mail = str_replace($array, $new_array, silvercastle_email_body_func() );
                        	
    			$headers = array('Content-Type: text/html; charset=UTF-8');
			    wp_mail( $to, $subject, $new_mail, $headers );
			    
        		
        		
        		
                echo json_encode(1);
                
                

                  $address = array(
                      'first_name' => $payee_data['firstname'],
                      'last_name'  => $payee_data['lastname'],
                      'company'    => '',
                      'email'      => $payee_data['email'],
                      'phone'      => $payee_data['phone'],
                      'address_1'  => '',
                      'address_2'  => '',
                      'city'       => '',
                      'state'      => '',
                      'postcode'   => '',
                      'country'    => ''
                  );
                if($group_gift_flag != 1 || 'crowding' == $product_data->get_type() ){
                  // Now we create the order
                  $order = wc_create_order();
                
                  // The add_product() function below is located in /plugins/woocommerce/includes/abstracts/abstract_wc_order.php
                  $order->add_product( get_product($product_id), 1); // This is an existing SIMPLE product
                  $order->set_address( $address, 'billing' );
                  //
                  $order->calculate_totals();
                  $order->update_status("completed");
                  // The text for the note
                    $note = __("This product was bought for ".get_the_title($registry_id)." registry.");
                    
                    // Add the note
                    $order->add_order_note( $note );
                }
				
			}else{
				echo json_encode(0);
			}
			die();			
		}
		add_action('wp_ajax_dbtaddProductToSales', 'dbtaddProductToSales');
		add_action('wp_ajax_nopriv_dbtaddProductToSales', 'dbtaddProductToSales');

		function create_product_sales($registry_id, $product_id,$date_bought, $qty, $price, $payee_data){
			global $wpdb;
			$prefix = $wpdb->prefix."dbt_giftregistry_bought_goods";
			$postman = $wpdb->query("INSERT INTO $prefix(`registry_id`, `product_id`, `date_bought`, `qty`, `price`, `payee_data`) VALUES ('$registry_id', '$product_id','$date_bought', '$qty', '$price', '$payee_data')");
			return $wpdb->insert_id;
		}
		
		
		function fetch_cash_gift_amt_paid($registry_id){
		    global $wpdb;
			$prefix = $wpdb->prefix."dbt_giftregistry_bought_goods";
			$postman = $wpdb->get_var("SELECT price FROM $prefix WHERE registry_id = '$registry_id' AND product_id = 0");
			return $postman;
		}
        
        function create_crowdsourcing_trail($registry_id, $product_id, $amount){
            global $wpdb;
            $prefix = $wpdb->prefix."crowdsourcing_gift";
            $date = date('Y-m-d');
            $postman = $wpdb->query("INSERT INTO $prefix(`registry_id`, `gift_id`, `amount_paid`, `date`) VALUES ('$registry_id', '$product_id', '$amount','$date')");
            return $postman->insert_id;
        }
        
        function fetch_crowdsourcing_curr_price($registry_id, $product_id){
            global $wpdb;
            $prefix = $wpdb->prefix."crowdsourcing_gift";
            $postman = $wpdb->get_var("SELECT SUM(amount_paid) FROM $prefix WHERE registry_id = '$registry_id' AND gift_id = '$product_id'");
            return $postman;
        }
		function fetch_product_status($registry_id, $product_id){
			global $wpdb;
			$prefix = $wpdb->prefix."dbt_giftregistry_bought_goods";
			$postman = $wpdb->get_var("SELECT qty FROM $prefix WHERE registry_id = '$registry_id' AND product_id = '$product_id'");
			return $postman;
		}

		function dbt_close_registry(){
		    global $html_template;
			$shipping_house_address = sanitize_text_field($_POST['shipping_house_address']);
			$shipping_city = sanitize_text_field($_POST['shipping_city']);
			$shipping_state = sanitize_text_field($_POST['shipping_state']);
			$shipping_country = sanitize_text_field($_POST['shipping_country']);
			$registry_id = sanitize_text_field($_POST['registry_id']);
			$user_id = sanitize_text_field($_POST['user_id'] );
			$user = get_user_by('id', $user_id);
			$user_email = $user->user_email;
			$firstname = $user->firstname;


			update_post_meta($registry_id, 'shipping_house_address', $shipping_house_address);
			update_post_meta($registry_id, 'shipping_city', $shipping_city);
			update_post_meta($registry_id, 'shipping_state', $shipping_state);
			update_post_meta($registry_id, 'shipping_country', $shipping_country);
			update_post_meta($registry_id, 'registry_status', 'closed');

			    //Mail the Closing Agent = dbtsc_shipping_agent;
			    $shipping_agent = get_option('dbtsc_shipping_agent', true);
			    $to = $shipping_agent;
                
                $subject = 'ATTN: '.get_the_title($registry_id).' Registry has just been closed';
                $receiver  = 'Hello '.$to;
    			$main_paragraphs =  'This is to inform you that '.get_the_title($registry_id).' was closed on '.date('H:i:s, d-m-Y');
    			$main_paragraphs .= '<br><br><strong>Shipping Information</strong><br> House Address:'.$shipping_house_address.'<br>';
    			$main_paragraphs .= 'City: '.$shipping_city.'<br>';
    			$main_paragraphs .= 'State: '.$shipping_state.'<br>';
    			$main_paragraphs .= 'Country: '.$shipping_country.'<br>';
    			$cta_btn_url = home_url().'/feedback-form/';
    			$cta_btn_text ='Fill Feedback form';
    			$ads_btn_url = home_url().'/registry/new-registry';
    			//$ads_btn_text = 'Click here to start your free Gift Registry today';
    			$ads_btn_text = 'Create My Registry';
    			$ads_text = 'You can also create other Gift registries for your life celebrations like your Wedding, Birthday, Anniversary, Baby shower, it’s free';
    			$banner_url = 'https://silvercastle.co/wp-content/uploads/2019/12/email-banner.jpg';
    		    
    		    $array = array('{{%%greet_receiver%%}}','{{%%client_text%%}}','{{%%cta_button_url%%}}','{{%%cta_button_text%%}}','{{%%ads_text%%}}','{{%%ads_button_text%%}}','{{%%Company_name%%}}','{{%%Company_address%%}}','{{%%Company_phone%%}}','{{%%banner_url%%}}',
                        '{{%%ads_btn_display%%}}', '{{%%cta_btn_display%%}}','{{%%display_ads%%}}','{{__ads_btn_url_)}}' );
                
                $new_array = array($receiver, $main_paragraphs,$cta_btn_url,$cta_btn_text,$ads_text,$ads_btn_text,'Silver Castle Gift Registry',
                'Lagos, Nigeria','',$banner_url,'', 'display:none;','display:none;',$ads_btn_url );
                
                $new_mail = str_replace($array, $new_array, silvercastle_email_body_func() );
                        	
    			$headers = array('Content-Type: text/html; charset=UTF-8');
			    wp_mail( $to, $subject, $new_mail, $headers );
			    
                
                //Mail to client closing registry
                $subject = get_the_title($registry_id).' Registry has just been closed';
	   			$body = email_template();
	   			
			    $first_paragraph = 'It’s been an interesting journey… now that you have closed your Gift registry, our excellent customer experience team will contact you to schedule a convenient delivery date for you to take delivery of your precious gifts.<br>';
			    $second_paragraph = '<br>We would also love to hear from you, do fill out our Feedback form <a href="'.home_url().'/feedback-form/"  style="color:#800080">Here</a>, it will only take a minute.';
			    $second_paragraph .= 'Thank you for choosing Silver Castle.<br>';
			    
			    $second_paragraph .= '<br>Always here for you,';
			    $second_paragraph .= '<br>The Silver Castle team.';

    			$body .= '<p>Hello '.$firstname.'</p>';
    			$body .= '<p>'.$first_paragraph.'</p>';
    			$body .= '<p>'.$second_paragraph.'</p>';
    	

			    $receiver  = 'Hello '.$firstname;
    			$main_paragraphs =  $first_paragraph;
    			$main_paragraphs .= ''.$second_paragraph.'';
    			$cta_btn_url = home_url().'/feedback-form/';
    			$cta_btn_text ='Fill Feedback form';
    			$ads_btn_url = home_url().'/registry/new-registry';
    			//$ads_btn_text = 'Click here to start your free Gift Registry today';
    			$ads_btn_text = 'Create My Registry';
    			$ads_text = 'You can also create other Gift registries for your life celebrations like your Wedding, Birthday, Anniversary, Baby shower, it’s free';
    			$banner_url = 'https://silvercastle.co/wp-content/uploads/2019/12/email-banner.jpg';
    		    
    		    $array = array('{{%%greet_receiver%%}}','{{%%client_text%%}}','{{%%cta_button_url%%}}','{{%%cta_button_text%%}}','{{%%ads_text%%}}','{{%%ads_button_text%%}}','{{%%Company_name%%}}','{{%%Company_address%%}}','{{%%Company_phone%%}}','{{%%banner_url%%}}','{{%%ads_btn_display%%}}', '{{%%cta_btn_display%%}}','{{%%display_ads%%}}' ,'{{__ads_btn_url_)}}');
                
                $new_array = array($receiver, $main_paragraphs,$cta_btn_url,$cta_btn_text,$ads_text,$ads_btn_text,'Silver Castle Gift Registry','Lagos, Nigeria','',$banner_url,'', 'display:none;','',$ads_btn_url);
                
                $new_mail = str_replace($array, $new_array, silvercastle_email_body_func() );
                        	
    			$headers = array('Content-Type: text/html; charset=UTF-8');
			    wp_mail( $user_email, $subject, $new_mail, $headers );
            
			$home_url = array(1, home_url() );
			echo json_encode($home_url);
			die();
		}
		add_action('wp_ajax_dbt_close_registry', 'dbt_close_registry');
		add_action('wp_ajax_nopriv_dbt_close_registry', 'dbt_close_registry');

		function silvercastle_mailme_in_html($to, $subject, $body){
	
			$headers = array('Content-Type: text/html; charset=UTF-8');
			wp_mail( $to, $subject, $body, $headers );
		}
		
		function dbtfetchRegistryProducts(){
		    
		    $checkboxValue = sanitize_text_field($_POST['checkboxValue']);
		    $checkboxValue = json_decode(stripslashes($checkboxValue));
		    $registry_id = $_POST['registry_id'];
		    $productsPerPage = !empty($_POST['productsPerPage'] )?$_POST['productsPerPage']:15;
		   
		    $args = array(
                'post_type'             => 'product',
                'post_status'           => 'publish',
                'ignore_sticky_posts'   => 1,
                'posts_per_page'        => -1,
                'tax_query'             => array(
                    array(
                        'taxonomy'      => 'product_cat',
                        'field' => 'term_id', //This is optional, as it defaults to 'term_id'
                        'terms'         => array_map('intval', $checkboxValue),
                        'operator'      => 'IN' // Possible values are 'IN', 'NOT IN', 'AND'.
                    ),
                    array(
                        'taxonomy'      => 'product_visibility',
                        'field'         => 'slug',
                        'terms'         => 'exclude-from-catalog', // Possibly 'exclude-from-search' too
                        'operator'      => 'NOT IN'
                    )
                )
            );
            
            $the_query = new WP_Query($args);
            $products = $the_query->posts;
            // echo '<pre>';
            // print_r($products);
            // echo '</pre>';
            $limit = $productsPerPage;
			//$products = loadProducts($limit);
			$total_product_count = count($products);
		    $curr_categories = array_map('intval', $checkboxValue);
		    update_option('product_categories',$curr_categories);
			$tbl = 'posts';
			
			if($total_product_count > 1 ){
			$extra_q = "post_type = 'product' AND post_status='publish'";
			$pageno = (get_query_var('nextpage') )?get_query_var('nextpage'):1;
			$products = dbt_initialize_pagination_2($tbl, $pageno, $extra_q, $limit, $products);
			$total_rows = $total_product_count;
            $no_of_records_per_page = $limit;
            $total_pages = ceil($total_rows / $no_of_records_per_page);
            $page_no = $pageno;
            
            // echo '<pre>';
            // print_r($products);
            // echo '</pre>';
            
            $html = '';
            foreach($products as $product ){
                		$product_data = wc_get_product($product->ID);
						$image = $product_data->get_image();
						$product_details = $product_data->get_data();
					    $img = get_the_post_thumbnail_url($product->ID, array(300, 300));
						$html .= '<div class="card shadow-sm ml-3 mr-3 mb-3 d-inline-block" style="width:26rem">';
						$html .= '<img src="'.$img.'">';
						   //$html .= printf($image);
						   $html .='
						  <div class="card-body">
						    <h5 class="card-title" data-toggle="modal" data-target="#productModal'.$product->ID.'" style="cursor: pointer">'.$product->post_title .'</h5>
						    <h6 class="card-text font-red">'. $product_data->get_price_html().'</h6>';
						     if( check_if_product_exists_in_registry($product->ID, $registry_id) != true ){
						    $html .= '<p><select style="width: 100%" value="1" id="priority'.$product->ID.'">';
						    $html .= '<option value="">Select priority</option>
						    	<option value="3">High</option>
						    	<option value="2">Medium</option>
						    	<option value="1">Low</option>
						    	</select></p>
						    	<p><small class="text-muted" id="priorityErrorMessage'.$product->ID.'"></small></p>
						    <p><input type="number" style="width: 11.1rem" value="1" id="qty'. $product->ID .'"><a class="button addProductToRegistry" data-id="'.$product->ID.'" data-registry="'.$registry_id.'" id="addProductToRegistry'.$product->ID .'">Add to Registry</a></p>
						    <p><small class="text-muted" id="AddErrorSuccessMessage'.$product->ID.'"></small></p>';
						    }else{ 
						    		$html .= '<p><small class="text-muted">Added to this Registy</small></p>';
						     }
						    
						    $html .='<p></p><p></p><p></p>
						  </div>
						</div>
						<div class="modal fade" id="productModal'.$product->ID.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  <div class="modal-dialog modal-dialog-centered" role="document">
					    <div class="modal-content">
					      
					      <div class="modal-body">
					        <div class="card mb-3 ml-2 mr-2" >
							  <div class="row">
							    <div class="col-md-5">';
							       	$html .= '<img src="'.$img.'">
							    </div>
							    <div class="col-md-7">
							      <div class="card-body">
							        <h5 class="card-title">'.$product->post_title .'</h5>
							        <p class="card-text">'.$product_data->get_price_html().'</p>
							        <p class="card-text text-justify">'. $product_details['short_description'].'</p>
							      </div>
							    </div>
							  </div>
							</div>
					      </div>
					    </div>
					  </div>
					</div>';
					
								
            }
            // The Loop
            $disabled = ($page_no <= 1)?"disabled":'';
            $disabled_2 = ($page_no >= $total_pages)?"disabled":'';
            $disabled_3 = ($page_no >= $total_pages)?'disabled':''; ;
            $next_url = ($page_no >= $total_pages)?"#":"?nextpage=".($page_no + 1);
            $last_url = '?nextpage='.$total_pages;
            $html_2 = '<div class="col-md-6 offset-md-3">
    					<ul class="pagination">
                    	    <li class="page-item"><a class="page-link" href="?nextpage=1">First</a></li>
                    	    <li class="page-item '.$disabled.'">
                    	        <a  class="page-link" href="'.$disabled_2.'">Prev</a>
                    	    </li>
                    	    <li class="page-item '.$disabled_2.'">
                    	        <a class="page-link" href="'.$next_url.'">Next</a>
                    	    </li>
                    	    <li class="page-item"><a class="page-link" href="'.$last_url.'">Last</a></li>
                    	</ul>
                	</div>';
            //print_r();
            
            $arr = array($html, $html_2);
            
			}else{
			    $arr = array(0);
			}
			echo json_encode($arr);
            die();
		}
		add_action('wp_ajax_dbtfetchRegistryProducts', 'dbtfetchRegistryProducts');
		add_action('wp_ajax_nopriv_dbtfetchRegistryProducts', 'dbtfetchRegistryProducts');
		
		
		function dbt_check_password(){
		    $reg_id = $_POST['reg_id'];
		    $password = sanitize_text_field($_POST['password']);
		    $registry_password = get_post_meta($reg_id, 'password', true);
		    if($password === $registry_password){
		        echo json_encode(1);
		    }else{
		        echo json_encode(0);
		    }
		   // echo $registry_password;
		    die();
		}
		add_action('wp_ajax_dbt_check_password', 'dbt_check_password');
		add_action('wp_ajax_nopriv_dbt_check_password', 'dbt_check_password');
		
		function dbtfetchRegistryProductsUsingProductsNumber(){
		    $productsPerpage = sanitize_text_field($_POST['productsPerpage']);
		     $checkboxValue = $_POST['allcheckBox'];
		     $registry_id = $_POST['registry_id'];
		      
		     $checkboxValue = json_decode(stripslashes($checkboxValue));
    		   
		      $args = array(
                'post_type'             => 'product',
                'post_status'           => 'publish',
                'ignore_sticky_posts'   => 1,
                'posts_per_page'        => $productsPerpage,
                'tax_query'             => array(
                    array(
                        'taxonomy'      => 'product_cat',
                        'field' => 'term_id', //This is optional, as it defaults to 'term_id'
                        'terms'         => array_map('intval', $checkboxValue),
                        'operator'      => 'IN' // Possible values are 'IN', 'NOT IN', 'AND'.
                    ),
                    array(
                        'taxonomy'      => 'product_visibility',
                        'field'         => 'slug',
                        'terms'         => 'exclude-from-catalog', // Possibly 'exclude-from-search' too
                        'operator'      => 'NOT IN'
                    )
                )
            );
            //echo print_r($args);
            $the_query = new WP_Query($args);
            $products = $the_query->posts;
            
            $limit = $productsPerpage;
			$num_records_per_page = $limit - 1;
            $products = dbt_initialize_pagination_3(1, $num_records_per_page, $products, 0);
	
            $html = '';
            foreach($products as $product ){
                		$product_data = wc_get_product($product->ID);
						$image = $product_data->get_image();
						$product_details = $product_data->get_data();
					    $img = get_the_post_thumbnail_url($product->ID, array(300, 300));
						$html .= '<div class="card shadow-sm ml-3 mr-3 mb-3 d-inline-block" style="width:26rem">';
						$html .= '<img src="'.$img.'">';
						   //$html .= printf($image);
						   $html .='
						  <div class="card-body">
						    <h5 class="card-title" data-toggle="modal" data-target="#productModal'.$product->ID.'" style="cursor: pointer">'.$product->post_title .'</h5>
						    <h6 class="card-text font-red">'. $product_data->get_price_html().'</h6>';
						     if( check_if_product_exists_in_registry($product->ID, $registry_id) != true ){
						    $html .= '<p><select style="width: 100%" value="1" id="priority'.$product->ID.'">';
						    $html .= '<option value="">Select priority</option>
						    	<option value="3">High</option>
						    	<option value="2">Medium</option>
						    	<option value="1">Low</option>
						    	</select></p>
						    	<p><small class="text-muted" id="priorityErrorMessage'.$product->ID.'"></small></p>
						    <p><input type="number" style="width: 11.1rem" value="1" id="qty'. $product->ID .'"><a class="button addProductToRegistry" data-id="'.$product->ID.'" data-registry="'.$registry_id.'" id="addProductToRegistry'.$product->ID .'">Add to Registry</a></p>
						    
						    <p><small class="text-muted" id="AddErrorSuccessMessage'.$product->ID.'"></small></p>';
						    }else{ 
						    		$html .= '<p><small class="text-muted">Added to this Registy</small></p>';
						    		$html .= '<p style="margin: 5px;"><a class="button-solid button-gifting" data-id="<?php echo $product->ID ?>" data-registry="<?php echo $registry_id ?>" id="addProductToRegistry<?php echo $product->ID ?>">Make Group Gifting</a></p>';
						     }
						    
						    $html .='<p></p><p></p><p></p>
						  </div>
						</div>';
				// 		$html = '<div class="modal fade" id="productModal'.$product->ID.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				// 	  <div class="modal-dialog modal-dialog-centered" role="document">
				// 	    <div class="modal-content">
					      
				// 	      <div class="modal-body">
				// 	        <div class="card mb-3 ml-2 mr-2" >
				// 			  <div class="row">
				// 			    <div class="col-md-5">';
				// 			       	$html .= '<img src="'.$img.'">
				// 			    </div>
				// 			    <div class="col-md-7">
				// 			      <div class="card-body">
				// 			        <h5 class="card-title">'.$product->post_title .'</h5>
				// 			        <p class="card-text">'.$product_data->get_price_html().'</p>
				// 			        <p class="card-text text-justify">'. $product_details['short_description'].'</p>
				// 			      </div>
				// 			    </div>
				// 			  </div>
				// 			</div>
				// 	      </div>
				// 	    </div>
				// 	  </div>
				// 	</div>';
					
								
            }
            // The Loop
        //     $disabled = ($page_no <= 1)?"disabled":'';
        //     $disabled_2 = ($page_no >= $total_pages)?"disabled":'';
        //     $disabled_3 = ($page_no >= $total_pages)?'disabled':''; ;
        //     $next_url = ($page_no >= $total_pages)?"#":"?nextpage=".($page_no + 1);
        //     $last_url = '?nextpage='.$total_pages;
        //     $html_2 = '<div class="col-md-6 offset-md-3">
    				// 	<ul class="pagination">
        //             	    <li class="page-item"><a class="page-link" href="?nextpage=1">First</a></li>
        //             	    <li class="page-item '.$disabled.'">
        //             	        <a  class="page-link" href="'.$disabled_2.'">Prev</a>
        //             	    </li>
        //             	    <li class="page-item '.$disabled_2.'">
        //             	        <a class="page-link" href="'.$next_url.'">Next</a>
        //             	    </li>
        //             	    <li class="page-item"><a class="page-link" href="'.$last_url.'">Last</a></li>
        //             	</ul>
        //         	</div>';
            $arr = array($html);
            echo json_encode($arr);
            //print_r($args);
            die();
		}
		add_action('wp_ajax_dbtfetchRegistryProductsUsingProductsNumber', 'dbtfetchRegistryProductsUsingProductsNumber');
		add_action('wp_ajax_nopriv_dbtfetchRegistryProductsUsingProductsNumber', 'dbtfetchRegistryProductsUsingProductsNumber');
		
		
		function dbtfetchRegistryPagination(){
		    $productsPerpage = sanitize_text_field($_POST['productsPerpage']);
		    $checkboxValue = $_POST['allcheckBox'];
		     
		    $checkboxValue = json_decode(stripslashes($checkboxValue));
		   
		     $args = array(
                'post_type'             => 'product',
                'post_status'           => 'publish',
                'ignore_sticky_posts'   => 1,
                'posts_per_page'        => -1,
                'post__not_in'          => '',
                'tax_query'             => array(
                    array(
                        'taxonomy'      => 'product_cat',
                        'field'         => 'term_id', //This is optional, as it defaults to 'term_id'
                        'terms'         => array_map('intval', $checkboxValue),
                        'operator'      => 'IN' // Possible values are 'IN', 'NOT IN', 'AND'.
                    ),
                    array(
                        'taxonomy'      => 'product_visibility',
                        'field'         => 'slug',
                        'terms'         => 'exclude-from-catalog', // Possibly 'exclude-from-search' too
                        'operator'      => 'NOT IN'
                    )
                )
            );
            //echo print_r($args);
            $the_query = new WP_Query($args);
            $products = $the_query->posts;
            $html = '';
            $num_records_per_page = 15;
            $products = dbt_initialize_pagination_3(1, $num_records_per_page, $products, 0);
            // echo'<pre>';
            // print_r($products);
            // echo'</pre>';
            foreach($products as $product ){
                //$curr_products .= $product->ID.', ';
                		$product_data = wc_get_product($product->ID);
						$image = $product_data->get_image();
						$product_details = $product_data->get_data();
					    $img = get_the_post_thumbnail_url($product->ID, array(300, 300));
						$html .= '<div class="card shadow-sm ml-3 mr-3 mb-3 d-inline-block" style="width:26rem">';
						$html .= '<img src="'.$img.'">';
						   //$html .= printf($image);
						   $html .='
						  <div class="card-body">
						    <h5 class="card-title" data-toggle="modal" data-target="#productModal'.$product->ID.'" style="cursor: pointer">'.$product->post_title .'</h5>
						    <h6 class="card-text font-red">'. $product_data->get_price_html().'</h6>';
						     if( check_if_product_exists_in_registry($product->ID, $registry_id) != true ){
						    $html .= '<p><select style="width: 100%" value="1" id="priority'.$product->ID.'">';
						    $html .= '<option value="">Select priority</option>
						    	<option value="3">High</option>
						    	<option value="2">Medium</option>
						    	<option value="1">Low</option>
						    	</select></p>
						    	<p><small class="text-muted" id="priorityErrorMessage'.$product->ID.'"></small></p>
						    <p><input type="number" style="width: 11.1rem" value="1" id="qty'. $product->ID .'"><a class="button addProductToRegistry" data-id="'.$product->ID.'" data-registry="'.$registry_id.'" id="addProductToRegistry'.$product->ID .'">Add to Registry</a></p>
						    <p><small class="text-muted" id="AddErrorSuccessMessage'.$product->ID.'"></small></p>';
						    }else{ 
						    		$html .= '<p><small class="text-muted">Added to this Registy</small></p>';
						     }
						    
						    $html .='<p></p><p></p><p></p>
						  </div>
						</div><div class="modal fade" id="productModal'.$product->ID.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  <div class="modal-dialog modal-dialog-centered" role="document">
					    <div class="modal-content">
					      
					      <div class="modal-body">
					        <div class="card mb-3 ml-2 mr-2" >
							  <div class="row">
							    <div class="col-md-5">';
							       	$html .= '<img src="'.$img.'">
							    </div>
							    <div class="col-md-7">
							      <div class="card-body">
							        <h5 class="card-title">'.$product->post_title .'</h5>
							        <p class="card-text">'.$product_data->get_price_html().'</p>
							        <p class="card-text text-justify">'. $product_details['short_description'].'</p>
							      </div>
							    </div>
							  </div>
							</div>
					      </div>
					    </div>
					  </div>
					</div>';
					
								
            }
            // The Loop
         
            //print_r();
            $arr = array($html);
            echo json_encode($arr);
            
            die();
		}
		add_action('wp_ajax_dbtfetchRegistryPagination', 'dbtfetchRegistryPagination');
		add_action('wp_ajax_nopriv_dbtfetchRegistryPagination', 'dbtfetchRegistryPagination');
		
		function dbtfetchRegistryPaginationLast(){
		     $productsPerpage = sanitize_text_field($_POST['productsPerpage']);
		    $checkboxValue = $_POST['allcheckBox'];
		    $registry_id = $_POST['registry_id'];
		     
		    $checkboxValue = json_decode(stripslashes($checkboxValue));
		   
		     $args = array(
                'post_type'             => 'product',
                'post_status'           => 'publish',
                'ignore_sticky_posts'   => 1,
                'posts_per_page'        => -1,
                'post__not_in'          => '',
                'tax_query'             => array(
                    array(
                        'taxonomy'      => 'product_cat',
                        'field'         => 'term_id', //This is optional, as it defaults to 'term_id'
                        'terms'         => array_map('intval', $checkboxValue),
                        'operator'      => 'IN' // Possible values are 'IN', 'NOT IN', 'AND'.
                    ),
                    array(
                        'taxonomy'      => 'product_visibility',
                        'field'         => 'slug',
                        'terms'         => 'exclude-from-catalog', // Possibly 'exclude-from-search' too
                        'operator'      => 'NOT IN'
                    )
                )
            );
            //echo print_r($args);
            $the_query = new WP_Query($args);
            $products = $the_query->posts;
            $html = '';
            $num_records_per_page = $productsPerpage - 1;
            $total_products = count($products);
            $last = $total_products - $num_records_per_page;
            $last = $total_products - $last;
           // echo $last;
            $products = dbt_initialize_pagination_3(1, $num_records_per_page, $products, $last);
            // echo'<pre>';
            // print_r($products);
            // echo'</pre>';
            foreach($products as $product ){
                //$curr_products .= $product->ID.', ';
                		$product_data = wc_get_product($product->ID);
						$image = $product_data->get_image();
						$product_details = $product_data->get_data();
					    $img = get_the_post_thumbnail_url($product->ID, array(300, 300));
						$html .= '<div class="card shadow-sm ml-3 mr-3 mb-3 d-inline-block" style="width:26rem">';
						$html .= '<img src="'.$img.'">';
						   //$html .= printf($image);
						   $html .='
						  <div class="card-body">
						    <h5 class="card-title" data-toggle="modal" data-target="#productModal'.$product->ID.'" style="cursor: pointer">'.$product->post_title .'</h5>
						    <h6 class="card-text font-red">'. $product_data->get_price_html().'</h6>';
						     if( check_if_product_exists_in_registry($product->ID, $registry_id) != true ){
						    $html .= '<p><select style="width: 100%" value="1" id="priority'.$product->ID.'">';
						    $html .= '<option value="">Select priority</option>
						    	<option value="3">High</option>
						    	<option value="2">Medium</option>
						    	<option value="1">Low</option>
						    	</select></p>
						    	<p><small class="text-muted" id="priorityErrorMessage'.$product->ID.'"></small></p>
						    <p><input type="number" style="width: 11.1rem" value="1" id="qty'. $product->ID .'"><a class="button addProductToRegistry" data-id="'.$product->ID.'" data-registry="'.$registry_id.'" id="addProductToRegistry'.$product->ID .'">Add to Registry</a></p>
						    <p><small class="text-muted" id="AddErrorSuccessMessage'.$product->ID.'"></small></p>';
						    }else{ 
						    		$html .= '<p><small class="text-muted">Added to this Registy</small></p>';
						     }
						    
						    $html .='<p></p><p></p><p></p>
						  </div>
						</div><div class="modal fade" id="productModal'.$product->ID.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  <div class="modal-dialog modal-dialog-centered" role="document">
					    <div class="modal-content">
					      
					      <div class="modal-body">
					        <div class="card mb-3 ml-2 mr-2" >
							  <div class="row">
							    <div class="col-md-5">';
							       	$html .= '<img src="'.$img.'">
							    </div>
							    <div class="col-md-7">
							      <div class="card-body">
							        <h5 class="card-title">'.$product->post_title .'</h5>
							        <p class="card-text">'.$product_data->get_price_html().'</p>
							        <p class="card-text text-justify">'. $product_details['short_description'].'</p>
							      </div>
							    </div>
							  </div>
							</div>
					      </div>
					    </div>
					  </div>
					</div>';
					
								
            }
            // The Loop
         
            //print_r();
            $arr = array($html);
            echo json_encode($arr);
            
            die();
		}
		add_action('wp_ajax_dbtfetchRegistryPaginationLast', 'dbtfetchRegistryPaginationLast');
		add_action('wp_ajax_nopriv_dbtfetchRegistryPaginationLast', 'dbtfetchRegistryPaginationLast');
		
		
		function dbtfetchRegistryPaginationNext(){
		    $productsPerpage = sanitize_text_field($_POST['productsPerpage']);
		    $checkboxValue = $_POST['allcheckBox'];
		     $pageCounter = $_POST['pageCounter'];
		    $checkboxValue = json_decode(stripslashes($checkboxValue));
		    $registry_id = $_POST['registry_id'];
		   
		     $args = array(
                'post_type'             => 'product',
                'post_status'           => 'publish',
                'ignore_sticky_posts'   => 1,
                'posts_per_page'        => -1,
                
                'tax_query'             => array(
                    array(
                        'taxonomy'      => 'product_cat',
                        'field'         => 'term_id', //This is optional, as it defaults to 'term_id'
                        'terms'         => array_map('intval', $checkboxValue),
                        'operator'      => 'IN' // Possible values are 'IN', 'NOT IN', 'AND'.
                    ),
                    array(
                        'taxonomy'      => 'product_visibility',
                        'field'         => 'slug',
                        'terms'         => 'exclude-from-catalog', // Possibly 'exclude-from-search' too
                        'operator'      => 'NOT IN'
                    )
                )
            );
            //echo print_r($args);
            $the_query = new WP_Query($args);
            $products = $the_query->posts;
            
            $html = '';
            $num_records_per_page = $productsPerpage - 1;
            $products = dbt_initialize_pagination_3(1, $num_records_per_page, $products, $pageCounter);
            // echo'<pre>';
            // print_r($products);
            // echo'</pre>';
            
            foreach($products as $product ){
               // $curr_products .= $product->ID.', ';
                		$product_data = wc_get_product($product->ID);
						$image = $product_data->get_image();
						$product_details = $product_data->get_data();
					    $img = get_the_post_thumbnail_url($product->ID, array(300, 300));
						$html .= '<div class="card shadow-sm ml-3 mr-3 mb-3 d-inline-block" style="width:26rem">';
						$html .= '<img src="'.$img.'">';
						   //$html .= printf($image);
						   $html .='
						  <div class="card-body">
						    <h5 class="card-title" data-toggle="modal" data-target="#productModal'.$product->ID.'" style="cursor: pointer">'.$product->post_title .'</h5>
						    <h6 class="card-text font-red">'. $product_data->get_price_html().'</h6>';
						     if( check_if_product_exists_in_registry($product->ID, $registry_id) != true ){
						    $html .= '<p><select style="width: 100%" value="1" id="priority'.$product->ID.'">';
						    $html .= '<option value="">Select priority</option>
						    	<option value="3">High</option>
						    	<option value="2">Medium</option>
						    	<option value="1">Low</option>
						    	</select></p>
						    	<p><small class="text-muted" id="priorityErrorMessage'.$product->ID.'"></small></p>
						    <p><input type="number" style="width: 11.1rem" value="1" id="qty'. $product->ID .'"><a class="button addProductToRegistry" data-id="'.$product->ID.'" data-registry="'.$registry_id.'" id="addProductToRegistry'.$product->ID .'">Add to Registry</a></p>
						    <p><small class="text-muted" id="AddErrorSuccessMessage'.$product->ID.'"></small></p>';
						    }else{ 
						    		$html .= '<p><select style="width: 100%" value="1" id="priority'.$product->ID.'" disabled>
								    	<option value="">Select priority</option>
								    	<option value="3">High</option>
								    	<option value="2">Medium</option>
								    	<option value="1">Low</option>
								    	</select></p>
								    	<p><small class="text-muted" id="priorityErrorMessage'.$product->ID.'"></small></p>
								    <p><input type="number" style="width: 11.1rem" value="1" id="qty'.$product->ID.'" disabled><a class="button-disabled" data-id="'.$product->ID .'" data-registry="'.$registry_id .'" id="addProductToRegistry'.$product->ID.'" disabled>Already Added</a></p>
								    <p style="margin: 5px;"><a class="button-solid button-gifting" data-id="'. $product->ID .'" data-registry="'.$registry_id.'" id="addProductToRegistry'.$product->ID.'">Make Group Gifting</a></p>
								    ';
						     }
						    
						    $html .='<p></p><p></p><p></p>
						  </div>
						</div><div class="modal fade" id="productModal'.$product->ID.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  <div class="modal-dialog modal-dialog-centered" role="document">
					    <div class="modal-content">
					      
					      <div class="modal-body">
					        <div class="card mb-3 ml-2 mr-2" >
							  <div class="row">
							    <div class="col-md-5">';
							       	$html .= '<img src="'.$img.'">
							    </div>
							    <div class="col-md-7">
							      <div class="card-body">
							        <h5 class="card-title">'.$product->post_title .'</h5>
							        <p class="card-text">'.$product_data->get_price_html().'</p>
							        <p class="card-text text-justify">'. $product_details['short_description'].'</p>
							      </div>
							    </div>
							  </div>
							</div>
					      </div>
					    </div>
					  </div>
					</div>';
					
								
            }
            // The Loop
         
            //print_r();
            $arr = array($html);
            echo json_encode($arr);
            
            die();
		}
		add_action('wp_ajax_dbtfetchRegistryPaginationNext', 'dbtfetchRegistryPaginationNext');
		add_action('wp_ajax_nopriv_dbtfetchRegistryPaginationNext', 'dbtfetchRegistryPaginationNext');
		
		function dbtPublishRegistry(){
		    global $wpdb;
		    $registry_id = $_POST['registry_id'];
		    $prefix = $wpdb->prefix.'posts';
		    $postman = $wpdb->query("UPDATE $prefix SET post_status = 'publish' WHERE ID = '$registry_id'");
		    
		    echo json_encode(1);
		    die();
		}
		add_action('wp_ajax_dbtPublishRegistry', 'dbtPublishRegistry');
		add_action('wp_ajax_nopriv_dbtPublishRegistry', 'dbtPublishRegistry');
		
                    	
		function dbt_sendEmailToClient(){
		    global $wpdb, $head;
		    $data = sanitize_text_field($_POST['data']);
		    $data = json_decode(stripslashes($data));
		    $messageFriends = sanitize_text_field($_POST['messageFriends']);
		    $registry_id = $_POST['registry_id'];
		    $post_author_id = get_post_field( 'post_author', $registry_id );
		    $author_id = get_user_by('id', $post_author_id);
		    
		    
		    foreach($data as $data ){
		       
    			//$subject = url_decode(get_the_title($registry_id) ).' is now public! ';
    			$event_type = get_post_meta($registry_id, 'event_type', true);
    		    $subject = ucfirst($author_id->first_name).' '. ucfirst($author_id->last_name).'\'s '.$event_type.' Gift Registry';
    		    
    			$fullname_sender = $data[0];
    			//$first_paragraph = $author_id->first_name.' '. $author_id->last_name.' registry is now live.';
    			$first_paragraph = 'I’m so glad you’re part of my special event. Here is my gift registry link… ';
    			$first_paragraph .= '<a class="blue-btn" href="'.home_url().'/gift_registry/'.sanitize_title(get_the_title($registry_id)).'" ><strong>View My Registry</strong></a>';
    			$second_paragraph = $messageFriends;
    			$second_paragraph .= '';
    			
    	
			 
			 
			    $receiver  = 'Hello '.$fullname_sender;
			    $main_paragraphs = '';
			    if($messageFriends == ''){
    			    $main_paragraphs .= '<p>'.$first_paragraph.'</p>';
    			}else {
    			    $main_paragraphs .= '<p><blockquote style="border:solid 2px #800080">'.$second_paragraph.'</blockquote></p>';
    			}

    			$cta_btn_url = home_url().'/gift_registry/'.sanitize_title(get_the_title($registry_id));
    			$cta_btn_text = 'View My Registry';
    			$ads_btn_url = home_url().'/registry/new-registry';
    			$ads_btn_text = 'Click here to start your free Gift Registry today';
    			$ads_text = 'You can also create your own free Gift registry for your Wedding, Birthday, Anniversary or Baby shower/naming all on Silver Castle.';
    			$banner_url = get_the_post_thumbnail_url($registry_id,'full');
    		    
    		    $array = array('{{%%greet_receiver%%}}','{{%%client_text%%}}','{{%%cta_button_url%%}}','{{%%cta_button_text%%}}','{{%%ads_text%%}}','{{%%ads_button_text%%}}','{{%%Company_name%%}}','{{%%Company_address%%}}','{{%%Company_phone%%}}','{{%%banner_url%%}}','{{%%ads_btn_display%%}}', '{{%%cta_btn_display%%}}','{{%%display_ads%%}}','{{__ads_btn_url_)}}');
                
                $new_array = array($receiver, $main_paragraphs,$cta_btn_url,$cta_btn_text,$ads_text,$ads_btn_text,'Silver Castle Gift Registry','Lagos, Nigeria','',$banner_url,'', '','',$ads_btn_url);
                
                $new_mail = str_replace($array, $new_array, silvercastle_email_body_func() );
                        	
    			$headers = array('Content-Type: text/html; charset=UTF-8');
			    wp_mail( $data[1], $subject, $new_mail, $headers );
    			
				
		    }
		   
		    echo json_encode(1);
		    die();
		     
		}
		add_action('wp_ajax_dbt_sendEmailToClient', 'dbt_sendEmailToClient');
		add_action('wp_ajax_nopriv_dbt_sendEmailToClient', 'dbt_sendEmailToClient');
		
		function dbt_save_referred_friends($friends_email, $friends_fullname, $user_id, $registry_id, $type, $source){
		    global $wpdb;
		    $prefix = $wpdb->prefix."dbt_friends_emails";
		    $date = date('y-m-d');
		    $check_db = $wpdb->get_row("SELECT * FROM $prefix WHERE user_id = '$user_id' AND friends_email = '$friends_email' AND registry_id = '$registry_id'");
		    if(empty($check_db) ){
		        $postman = $wpdb->query("INSERT INTO $prefix(`friends_email`, `friends_fullname`, `user_id`, `date`, `registry_id`, `type`, `source`) VALUES ('$friends_email', '$friends_fullname', '$user_id', '$date', '$registry_id', '$type', '$source')");
		        //$q = "INSERT INTO $prefix(`friends_email`, `friends_fullname`, `user_id`, `date`, `registry_id`, `type`) VALUES ('$friends_email', '$friends_fullname', '$user_id', '$date', '$registry_id', '$type')";
		       
		    }
		    
		    
		}
		
		function dbt_sendEmailToReferrals(){
		    global $wpdb, $html_template;
		    $data = sanitize_text_field($_POST['data']);
		    $data = json_decode(stripslashes($data));
		    
		    $registry_id = $_POST['registry_id'];
		    $post_author_id = get_post_field( 'post_author', $registry_id );
		    $author_id = get_user_by('id', $post_author_id);
		    
		    $source = sanitize_text_field($_POST['source']);
		   
		    foreach($data as $data ){
		        
		        $to = $data[1];
		        dbt_save_referred_friends($to, $data[0], $post_author_id, $registry_id, 'email', $source);
	
    		    //$subject = str_replace("'", "",  ) );
    		    $subject =  get_the_title($registry_id);
    		    //$subject = get_the_title($registry_id);
    		    //echo $subject;
    		    
    		    $event_type = get_post_meta($registry_id, 'event_type', true);
    		    $subject = ucfirst($author_id->first_name).' '. ucfirst($author_id->last_name).'\'s '.$event_type.' Gift Registry';
    			$fullname_sender = $data[0];
    		
    			if(!empty( $data[2] ) ){
    			    
    			    $first_paragraph = ''.$data[2].'';
    			    //$second_paragraph .= 'Here is my Gift Registry link  "<a style="color:#800080" href="'.home_url().'/gift_registry/'.sanitize_title(get_the_title($registry_id) ).'">'.get_the_title($registry_id).'</a>"';
    			    $second_paragraph = 'Kindly use the button below to view my registry';
    			}else{
    			    $first_paragraph = "I’m so glad you’re part of my special event.";
    			    $second_paragraph = 'Kindly use the button below to view my registry';
    			}
    			
    		
    			
    			
    			$receiver  = 'Hello '.$fullname_sender;
    			$main_paragraphs =  $first_paragraph;
    			$main_paragraphs .= '<p>'.$second_paragraph.'</p>';
    			$ads_btn_url = home_url().'/registry/new-registry';
    			//$main_paragraphs .= $ads_btn_url;
    			$cta_btn_url = get_the_permalink($registry_id);
    			$cta_btn_text ='View My Registry';
    			
    			//$ads_btn_text = 'Click here to start your free Gift Registry today';
    			$ads_btn_text = 'Create My Registry';
    			$ads_text = 'You can also create your own free Gift registry for your Wedding, Birthday, Anniversary or Baby shower/naming all on Silver Castle.';
    			$banner_url = get_the_post_thumbnail_url($registry_id,'full');
    		    
    		    $array = array('{{%%greet_receiver%%}}','{{%%client_text%%}}','{{%%cta_button_url%%}}','{{%%cta_button_text%%}}','{{%%ads_text%%}}','{{%%ads_button_text%%}}',
    		    '{{%%Company_name%%}}','{{%%Company_address%%}}','{{%%Company_phone%%}}','{{%%banner_url%%}}',
                        '{{%%ads_btn_display%%}}', '{{%%cta_btn_display%%}}','{{%%display_ads%%}}','{{__ads_btn_url_)}}' );
                
                $new_array = array($receiver,$main_paragraphs,$cta_btn_url,$cta_btn_text,$ads_text,$ads_btn_text,'Silver Castle Gift Registry','Lagos, Nigeria','',$banner_url,
                '', '','', $ads_btn_url);
                
                $new_mail = str_replace($array, $new_array, silvercastle_email_body_func() );
                        	
    			$headers = array('Content-Type: text/html; charset=UTF-8');
			    wp_mail( $data[1], html_entity_decode($subject), $new_mail, $headers );
			    
			 //   echo 'Placeholders: '.count($array) . ' Text: '.count($new_array);
			 //   echo '<pre>';
			 //   print_r($array);
			 //   echo '</pre>';
			 //    echo '<pre>';
			 //   print_r($new_array);
			 //   echo '</pre>';
    			
		    }
		    //print_r($new_emails);
		    echo json_encode(1);
		    die();
		}
		add_action('wp_ajax_dbt_sendEmailToReferrals','dbt_sendEmailToReferrals');
		add_action('wp_ajax_nopriv_dbt_sendEmailToReferrals','dbt_sendEmailToReferrals');
		
		function dbtInsertReferrals($user_id,$referee_name,$referee_phone){
		    global $wpdb;
		    $date = date('Y-m-d');
		    $prefix = $wpdb->prefix."dbt_giftregistry_referral";
		    
		    $check = $wpdb->get_var("SELECT referee_phone FROM $prefix WHERE referee_phone = '$referee_phone'");
		    if(!empty($check) ){
		        
		    }else{
		        $postman = $wpdb->query("INSERT INTO $prefix(`user_id`, `referee_name`, `referee_phone`, `date`) VALUES ('$user_id','$referee_name','$referee_phone','$date')");
		    }
		    die();
		}
		
		function dbtInviteFriendRegistry(){
		    global $wpdb;
		    $registry_id = $_POST['registry_id'];
		    $prefix = $wpdb->prefix.'posts';
		    $postman = $wpdb->get_var("SELECT post_author FROM $prefix WHERE ID = '$registry_id'");
		    $fullname1 = sanitize_text_field($_POST['fullname1']);
            $phone1 = sanitize_text_field($_POST['phone1']);
            $fullname2 = sanitize_text_field($_POST['fullname2']);
            $phone2 = sanitize_text_field($_POST['phone2']);
            $fullname3 = sanitize_text_field($_POST['fullname3']);
            $phone3 = sanitize_text_field($_POST['phone3']);
		    dbtInsertReferrals($user_id,$fullname1,$phone1);
		    dbtInsertReferrals($user_id,$fullname2,$phone2);
		    dbtInsertReferrals($user_id,$fullname3,$phone3);
		    echo json_encode(1);
		    die();
		}
		add_action('wp_ajax_dbtInviteFriendRegistry','dbtInviteFriendRegistry');
		add_action('wp_ajax_nopriv_dbtInviteFriendRegistry','dbtInviteFriendRegistry');
		
		function dbtCheckPublishStatus($registry_id){
		    global $wpdb;
		    $prefix = $wpdb->prefix."posts";
		    $postman = $wpdb->get_var("SELECT post_status FROM $prefix WHERE ID = '$registry_id'");
		    return $postman;
		}
		
		function dbtfetchRegistryProductsPagination(){
		    
		}
		add_action('wp_ajax_dbtfetchRegistryProductsPagination', 'dbtfetchRegistryProductsPagination');
		add_action('wp_ajax_nopriv_dbtfetchRegistryProductsPagination', 'dbtfetchRegistryProductsPagination');

	    	//Redirect function
    	function dbthrms_login_redirect( $redirect_to, $request, $user ) {
    	    
    	    //is there a user to check?
    	    if (isset($user->roles) && is_array($user->roles)) {
    	        //check for subscribers
    	        if (in_array('customer', $user->roles)) {
    	        
    	            	$redirect_to =  home_url().'/registry';
    	            
    	        }
    	        if (in_array('administrator', $user->roles)) {
    	            // redirect them to another URL, in this case, the homepage 
    	           $redirect_to =  home_url();
    	        }
    	       
    	    }
    
    	    return $redirect_to;
    	}
    
    	add_filter( 'login_redirect', 'dbthrms_login_redirect', 10, 3 );
    	
    	
    	function dbt_make_group_gifting(){
    	    global $wpdb;
    	    $prefix = $wpdb->prefix."dbt_groupgifting";
    	    $product_id = $_POST['product_id'];
    	    $registry_id = $_POST['registry_id'];
    	    $date= date('Y-m-d');
    	    $sql = "INSERT INTO $prefix (`product_id`, `registry_id`, `date`) VALUES ('$product_id', '$registry_id', '$date')";
    	    $postman = $wpdb->query($sql);
    	    if($wpdb->insert_id > 0 ){
    	        $flag = 1;
    	        echo json_encode($flag);
    	    }
    	    die();
    	}
    	add_action('wp_ajax_dbt_make_group_gifting', 'dbt_make_group_gifting');
    	add_action('wp_ajax_nopriv_dbt_make_group_gifting', 'dbt_make_group_gifting');
    	
    	function is_group_gift($registry, $product_id){
    	    global $wpdb;
    	    $prefix = $wpdb->prefix."dbt_groupgifting";
    	    $sql = "SELECT * FROM $prefix WHERE product_id = '$product_id' AND registry_id = '$registry'";
    	    $postman = $wpdb->get_row($sql);
    	    if( empty($postman) ){
    	        return false;
    	    }else{
    	        return true;
    	    }
    	}
    	
    	function dbt_remove_group_gifting(){
    	    global $wpdb;
    	    $prefix = $wpdb->prefix."dbt_groupgifting";
    	    $product_id = $_POST['product_id'];
    	    $registry_id = $_POST['registry_id'];
    	    $sql = "SELECT * FROM $prefix WHERE product_id = '$product_id' AND registry_id = '$registry_id'";
    	    $postman = $wpdb->get_row($sql);
    	    
    	    $sql = "DELETE FROM $prefix WHERE ID = $postman->ID";
    	    $postman = $wpdb->query($sql);
    	    
    	    $flag = 1;
    	    echo json_encode($flag);
    	    
    	    die();
    	}
    	add_action('wp_ajax_dbt_remove_group_gifting', 'dbt_remove_group_gifting');
    	add_action('wp_ajax_nopriv_dbt_remove_group_gifting', 'dbt_remove_group_gifting');
    	
    	//Cash Gift Processes
    	function fetch_cashgifts_by_user($user_id){
    	    global $wpdb;
    	    $prefix = $wpdb->prefix."dbt_cashgifts";
    	    $postman = $wpdb->get_results("SELECT * FROM $prefix WHERE user_id = '$user_id'");
    	    
    	    return $postman;
    	    
    	}
    	
    	function insert_into_cashgift($registry_id, $user_id, $cashgift){
    	    global $wpdb;
    	    $prefix = $wpdb->prefix."dbt_cashgifts";
    	    $date = date('Y-m-d');
    	    $postman = $wpdb->query("INSERT INTO $prefix (`registry_id`, `user_id`, `cashgift`, `status`, `date`) VALUES ('$registry_id', '$user_id', '$cashgift','Active', '$date')");
    	}
    	
    	function fetch_cashgift_by_registry($registry_id){
    	     global $wpdb;
    	    $prefix = $wpdb->prefix."dbt_cashgifts";
    	    $postman = $wpdb->get_row("SELECT * FROM $prefix WHERE registry_id = '$registry_id'");
    	    
    	    return $postman;
    	}
    	
    	function dbt_enable_cashgift(){
    	   
    	    $registry = $_POST['registry'];
    	    update_post_meta($registry, 'cash_gift_yes_or_no', 'yes');
    	    echo json_encode(1);
    	    die();
    	}
    	add_action('wp_ajax_dbt_enable_cashgift', 'dbt_enable_cashgift');
    	add_action('wp_ajax_nopriv_dbt_enable_cashgift', 'dbt_enable_cashgift');
    	
    	
    	function dbt_disable_cashgift(){
    	    
    	    $registry = $_POST['registry'];
    	    update_post_meta($registry, 'cash_gift_yes_or_no', 'no');
    	    echo json_encode(1);
    	    die();
    	    
    	}
    	add_action('wp_ajax_dbt_disable_cashgift', 'dbt_disable_cashgift');
    	add_action('wp_ajax_nopriv_dbt_disable_cashgift', 'dbt_disable_cashgift');
    	
    	function dbt_initialize_pagination($tbl, $pageno, $extra_q, $num_records_per_page, $records){
    	    
    	    global $wpdb;
    	    $prefix = $wpdb->prefix.$tbl;
            $total_rows = count($records);
        	$no_of_records_per_page = $num_records_per_page;
        	$offset = ($pageno-1) * $no_of_records_per_page; 
        	$total_pages = ceil($total_rows / $no_of_records_per_page);
        	
        
        	$postman = $wpdb->get_results("SELECT * FROM $prefix WHERE $extra_q ORDER BY ID DESC LIMIT $offset, $no_of_records_per_page ");
        	//$q = "SELECT * FROM $prefix WHERE $extra_q LIMIT $offset, $no_of_records_per_page";
        	return $postman;
        	//return $q;
    	}
    	
    	function dbt_initialize_pagination_2($tbl, $pageno, $extra_q, $num_records_per_page, $records){
    	    
    	    
            $total_rows = count($records);
        	$no_of_records_per_page = $num_records_per_page;
        	$offset = ($pageno-1) * $no_of_records_per_page; 
        	$total_pages = ceil($total_rows / $no_of_records_per_page);
        	
        	$postman = array();
        	for($i=$offset; $i <= $num_records_per_page; $i++ ){
        	    if( empty($records[$i]) ){
        	        break;
        	    }
        	    array_push($postman, $records[$i]);
        	}
        
        	return $postman;
        	
    	}
    	
    	function dbt_initialize_pagination_3($pageno, $num_records_per_page, $records, $offset){
    	    
    	    
            $total_rows = count($records);
        	$no_of_records_per_page = $num_records_per_page;
        	//$offset = ($pageno-1) * $no_of_records_per_page; 
        	$total_pages = ceil($total_rows / $no_of_records_per_page);
        	
        	$postman = array();
        	$num_records_per_page = $num_records_per_page + $offset;
        	for($i=$offset; $i <= $num_records_per_page; $i++ ){
        	    if( empty($records[$i]) ){
        	        break;
        	    }
        	    array_push($postman, $records[$i]);
        	}
        
        	return $postman;
        	
    	}
    	
    	function fetch_wallet_balance($user_id){
    	    
    	   global $wpdb;
    	    $prefix = $wpdb->prefix."dbt_cashgifts";
    	    $postman = $wpdb->get_var("SELECT SUM(cashgift) AS sum FROM $prefix WHERE user_id = '$user_id'");
    	    //$q = "SELECT SUM(cashgift) AS sum FROM $prefix WHERE user_id = '$user_id'";
    	    return $postman;
    	}
    	
    	
    	function dbtfeedbackFormResponse(){
    	    $firstname = sanitize_text_field($_POST['firstname']);
            $feedback = sanitize_text_field($_POST['feedback']);
            $lastname = sanitize_text_field($_POST['lastname']);
            $email = sanitize_text_field($_POST['email']);
            $feedback_type = sanitize_text_field($_POST['feedback_type']);
            
            //Response to Client Feedback
            $subject = 'Thanks for you feedback';
            $body = 'Hello '.$firstname.' <br>We are happy to recieve your feedback.';
            $body .= '<br>We will get back to you shortly';
            $headers = array('Content-Type: text/html; charset=UTF-8;');
			wp_mail( $email, $subject, $body, $headers );
            
            //Feedback sent to Admin
            $subject = 'Feedback from '.$firstname.' '.$lastname;
            $body = '<br>Feeback Type: '.$feedback_type.' <br>';
            $body .= '<br>Feedback: '.$feedback;
            //$admin_email = get_option('admin_email');
            $admin_email = 'hello@silvercastle.co';
            $headers = array('Content-Type: text/html; charset=UTF-8;Reply-To: '.$firstname.' '.$lastname.' <'.$email.'>');
			wp_mail( $admin_email, $subject, $body, $headers );
			
			$post_details = array(
			  'post_title'    => $feedback_type,
			  'post_status'   => 'private',
    		'post_author'   => 1,
			  'post_type' => 'feedbacks'
		   );
	   		$feedback_id = wp_insert_post( $post_details );
	   		



	   		update_post_meta($feedback_id, 'sirl_feedback_desc', $feedback);
	   		update_post_meta($feedback_id, 'sirl_feedback_firstname', $firstname);
	   		update_post_meta($feedback_id, 'sirl_feedback_lastname', $lastname);
	   		update_post_meta($feedback_id, 'sirl_feedback_email', $email);
	   		
			echo json_encode(1);
			die();
    	}
    	add_action('wp_ajax_dbtfeedbackFormResponse', 'dbtfeedbackFormResponse');
    	add_action('wp_ajax_nopriv_dbtfeedbackFormResponse', 'dbtfeedbackFormResponse');
    	
    	
    	function dbdelete_registry(){
    	    global $wpdb;
    	    $registry_id = $_POST['registry_id'];
    	   $post_id =   wp_update_post(array(
            'ID'    =>  $registry_id,
            'post_status'   =>  'trash'
            ));
            echo json_encode(1);
            //echo $post_id;
            die();
    	}
    	add_action('wp_ajax_dbdelete_registry', 'dbdelete_registry');
    	add_action('wp_ajax_nopriv_dbdelete_registry', 'dbdelete_registry');
?>