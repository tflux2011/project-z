<?php

	function dbt_registry(){
		$mypage = get_query_var('mypage');
		$npage = get_query_var('npage');
        
       
		if ( is_user_logged_in() ){
			$current_user = wp_get_current_user();
	 		$username = $current_user->user_login;
	 		$user_id = $current_user->ID;

	 	
    		$active1 = '';
    		$active2 = '';
    		if($mypage == 'new-registry'){
			echo '<script>jQuery(".anchor2").addClass("active");</script>';
		?>
			<div class="row mb-5">
				<div class="container">
					<div class="col-md-9">
					    <h6 class="alert text-white" style="background:#800080">We currently deliver only in Lagos. <a href="<?php echo home_url() ?>/delivery" style="color: #D89D23">Learn more</a></h6>
						<div class="spinner" style="position:fixed;top:40%;left:50%; background-color: #333; border-radius: 30px; padding: 10px; color:#fff; z-index: 1054;">Please Wait....</div>
						<form method="post" action="" enctype="multipart/form-data">
						<div class="col-12">
							<h4>New Registry</h4>
							<div class="form-group">
								<label for="registry-title">Registry Title</label>
								<input type="text" class="form-control bigheight" id="registry_title" placeholder="Title of Registry">
								<small class="text-muted" id="registryTitleErrHelpMssg">Example: Wedding - Dogara Weds Faith, Birthday - Uncle Wunmi @ 40, Naming Ceremony - Baby Ogunwole is here.</small>
							</div>
							<div class="form-group">
								<label for="registry-title">Upload Event Banner</label>
								<input type="file" class="form-control bigheight" id="registry_banner">
								<small class="text-muted" id="registryTitleErrHelpMssg">Kindly use 1263px x 283px banner for perfect fit.</small>
							</div>
							<div class="form-group">
								<label for="registry-privacy">Privacy Settings</label>
								<select id="registry-privacy" class="form-control bigPadding">
									<option value="">Select a privacy setting</option>
									<option value="public">Public</option>
									<option value="private">Private</option>
									<option value="passworded">Passworded</option>
								</select>
								<small class="text-muted" id="registryPrivacyErrHelpMssg">Passworded means your registry is password protected. Private means your registry cannot be found via search on this site. </small>
							</div>
							<section class="">
    							<div class="form-group password_section">
    								<label for="registry-password">Enter Password</label>
    								<input type="password" class="form-control bigheight" id="registry_password" placeholder="Registry password">
    								<small class="text-muted" id="registryPasswordErrHelpMssg"></small>
    							</div>
    							<div class="form-group password_section">
    								<label for="cregistry-password">Re-enter Password</label>
    								<input type="password" class="form-control bigheight" id="cregistry_password" placeholder="Confirm Registry password">
    								<small class="text-muted" id="registryCPasswordErrHelpMssg"></small>
    							</div>
    						</section>
							<hr>
					
							<h5>Event Details</h5>
							<div class="form-group">
								<label for="registry-event_type">Event Type</label>
								<select id="registry-event_type" class="form-control bigPadding">
									<option value="">Select your event type</option>
									<?php $event_type = get_option('dbtsc_reg_type', true);
											$event_types = explode(',', $event_type);
											foreach($event_types as $event_type ){
												echo '<option value="'.$event_type.'">'.$event_type.'</option>';
											}

									?>
									<option value="other">Other</option>
								</select>
								<small class="text-muted" id="registry-event_typeErrHelpMssg"></small>
							</div>
							<div class="form-group">
								<label for="registry-event_date">Event Date</label>
								<input type="text" id="registry-event_date" class="form-control bigheight" data-provide="datepicker" placeholder="DD/MM/YYYY">
								<small class="text-muted" id="registry-event_dateErrHelpMssg"></small>
							</div>
							<div class="form-group">
								<label for="registry-event_location">Event Location</label>
								<input type="text" id="registry-event_location" class="form-control bigheight">
								<small class="text-muted" id="registry-event_locationErrHelpMssg"></small>
							</div>
							<div class="form-group">
								<label for="registry-event_location">Message for Guests</label>
								<textarea id="registry-event_message" class="form-control bigheightBigText" rows="5" placeholder="Write a message for your guests here"></textarea>
								<small class="text-muted" id="registry-event_messageErrHelpMssg"></small>
							</div>
							<div class="form-group">
								<label for="registry-event_location">Cash Gift</label>
								<select id="registry-cash_gift" class="form-control bigPadding">
								    <option value="">Select an option</option>
								    <option value="yes">Yes</option>
								    <option value="no">No</option>
								</select>
								<small class="text-muted" id="registry-event_locationErrHelpMssg">This allows monetary contributions to be made towards your event.</small>
							</div>
							<input type="button" data-author="<?php echo $user_id ?>" value="Create Registry" data-slider="0" class="btn btn-alternative" id="createRegistry">
						</div>
						</form>
					</div>
					<div class="col-md-3">
						<div class="card" >
						  <div class="card-body">
						    <h5 class="card-title hint-title" style="background-color:#800080">Hint</h5>
						    <p class="card-text">Hello <?php echo get_user_meta($user_id, 'billing_first_name', true) ?>,<br>
    						    Do you know you can have multiple registries?<br> You can have a registry for any event you want ... in case your event type is not listed simply select <strong>other</strong> as your event type.</p>
    						    To manage your registries, please <a href="<?php echo home_url() ?>/registry/manage-registry" class="card-link" style="color:#D89D23">Click here.</a>
						  </div>
						</div>
					</div>
				</div>
			</div>

		<?php }else if($mypage == 'manage-registry'){
			echo '<script>jQuery(".anchor3").addClass("active");</script>';
			if($npage == 'edit' ){
				$npage = get_query_var('npage');
				$registry_id = get_query_var('nextpage');
				$registry_info = fetchRegistryByID($registry_id);
				//print_r($registry_info);
				
				?>
				
				<div class="row">
					<div class="container">
							<div class="col-12">
							<a href="<?php echo home_url()?>/registry/manage-registry" style="font-size:1.5em">&laquo; Back</a>
							<h4>Edit Registry</h4>
							<div class="form-group">
								<label for="registry-title">Registry Title</label>
								<input type="text" class="form-control bigheight" id="registry_title" value="<?php echo isset($registry_info[0]->post_title)?$registry_info[0]->post_title:''; ?>">
								<small class="text-muted" id="registryTitleErrHelpMssg"></small>
							</div>
							<div class="form-group">
								<label for="registry-title">Upload Event Banner</label>
								<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $registry_id ) ); ?>
								<p><img src="<?php echo $image[0] ?>"></p>
								<input type="file" class="form-control bigheight" id="registry_banner">
								<small class="text-muted" id="registryTitleErrHelpMssg">Kindly use 1263px x 283px banner for perfect fit.</small>
							</div>
							<div class="form-group">
								<label for="registry-privacy">Privacy Setting</label>
								<select id="registry-privacy" class="form-control bigPadding">
									<option value="">Select a privacy setting</option>
									<?php
									$registry_privacy = get_post_meta($registry_id, 'registry_privacy', true );
									if($registry_privacy == 'public' ){
										echo '<option value="public" selected>Public</option>
										<option value="private">Private</option>
										<option value="passworded">Passworded</option>';
									}else if($registry_privacy == 'private' ){
										echo '<option value="public">Public</option>
										<option value="private" selected>Private</option>
										<option value="passworded">Passworded</option>';
									}else if($registry_privacy == 'passworded' ){
										echo '<option value="public" >Public</option>
										<option value="private">Private</option>
										<option value="passworded" selected>Passworded</option>';
									}
									?>
								</select>
								<small class="text-muted" id="registryPrivacyErrHelpMssg"></small>
							</div>
							<?php if($registry_privacy == 'passworded' ){
							    
							    
							    
							    
							} ?>
							<hr>
							
							<h5>Event Details</h5>
							<div class="form-group">
								<label for="registry-event_type">Event Type</label>
								<?php $event_type = get_post_meta($registry_id, 'event_type', true); ?>

								<select id="registry-event_type" class="form-control bigPadding">
									<option value="">Select your event type</option>
									<option value="<?php echo $event_type ?>" selected><?php echo $event_type ?></option>
									<?php $event_type = get_option('dbtsc_reg_type', true);
											$event_types = explode(',', $event_type);
											foreach($event_types as $event_type ){
												echo '<option value="'.$event_type.'">'.$event_type.'</option>';
											}

									?>
								</select>
								<small class="text-muted" id="registry-event_typeErrHelpMssg"></small>
							</div>
							<div class="form-group">
								<label for="registry-event_date">Event Date</label>
								<input type="text" id="registry-event_date" class="form-control bigheight" value="<?php echo get_post_meta($registry_id, 'event_date', true) ?>">
								<small class="text-muted" id="registry-event_dateErrHelpMssg"></small>
							</div>
							<div class="form-group">
								<label for="registry-event_location">Event Location</label>
								<input type="text" id="registry-event_location" class="form-control bigheight" value="<?php echo get_post_meta($registry_id, 'eventLocation', true) ?>">
								<small class="text-muted" id="registry-event_locationErrHelpMssg"></small>
							</div>
							<div class="form-group">
								<label for="registry-event_location">Message for Guests</label>
								<textarea id="registry-event_message" class="form-control bigheightBigText" rows="5"><?php echo isset($registry_info[0]->post_content)?$registry_info[0]->post_content:'' ?></textarea>
								<small class="text-muted" id="registry-event_messageErrHelpMssg"></small>
							</div>
						
						<div class="form-group">
								<label for="registry-event_location">Cash Gift</label>
								<select id="registry-cash_gift" class="form-control bigPadding">
								    <option value="">Select an option</option>
								    <?php $cash_gift_yes_or_no =  get_post_meta($registry_id, 'cash_gift_yes_or_no', true);
								        if( !empty($cash_gift_yes_or_no) ){
    								        if($cash_gift_yes_or_no == 'yes'){
    								            $selected = 'selected';
    								    ?>
    								            <option value="yes" <?php echo $selected ?> >Yes</option>
    								            <option value="no">No</option>
    								    <?php }else if($cash_gift_yes_or_no == 'no'){ 
    								            $selected = 'selected';
    								    ?>
    								            <option value="yes">Yes</option>
    								            <option value="no" <?php echo $selected ?> >No</option>
    								    <?php } 
    								    
    								    }else{
    								        echo '<option value="yes">Yes</option>';
    								        echo '<option value="no">No</option>';
    								    } ?>
								</select>
								<small class="text-muted" id="registry-event_locationErrHelpMssg">This allows monetary contributions to be made towards your event.
							</div>
							<input type="button" data-author="<?php echo $user_id ?>" data-registry="<?php echo $registry_id ?>"value="Update Registry" class="btn btn-alternative" id="updateRegistry">
						</div>
						<div class="spinner" style="position:fixed;top:40%;left:50%; background-color: #333; border-radius: 30px; padding: 10px; color:#fff; z-index: 1054;">Please Wait....</div>
						</form>
					</div>
				</div>
			<?php }else{
			?>
				<div class="row ">
					<div class="container">

						<div class="col-md-12">
						    <div class="spinner" style="position:fixed;top:40%;left:50%; background-color: #333; border-radius: 30px; padding: 10px; color:#fff; z-index: 1054;">Please Wait....</div>
							<h5>Manage Registry</h5>
							<div class="table-responsive">
							<table class="table table-borderless manage-registry">
							  <thead>
							    <tr>
							      <th scope="col">#</th>
							      <th scope="col">Registry Title</th>
							      <th scope="col">Event Type</th>
							      <th scope="col">Date Created</th>
							      <th scope="col">Action</th>
							    </tr>
							  </thead>
							  <tbody>
							  <?php $my_registries = fetchAllRegistriesByAuthor($user_id);
							$index = 1;
							foreach($my_registries as $registry ){ ?>
							    <tr class="shadow-sm">
							      <th scope="row"><?php echo $index ?></th>
							      <td><?php echo $registry->post_title; ?></td>
							      <td><?php echo get_post_meta($registry->ID, 'event_type', true) ?></td>
							      <td><?php echo $registry->post_date; ?></td>
							      <td><a data-toggle="tooltip" data-placement="top" title="Edit Registry" href="<?php echo home_url()?>/registry/manage-registry/edit/?nextpage=<?php echo $registry->ID?>"><i data-feather="edit"></i></a> | <span style="cursor:pointer" data-toggle="tooltip" data-placement="top" title="Delete Registry" class="delRegistry" data-registry="<?php echo $registry->ID ?>"><i data-feather="trash"></i></span> | <a href="<?php echo home_url() ?>/registry/manage-shop/<?php echo $registry->ID ?>">Manage Products</a></td>
							    </tr>
							<?php $index++; }  ?>
							   </tbody>
							</table>
							</div>
						</div>
						
					</div>
				</div>

			<?php }
		} else if($mypage == 'share-registry'){
		    echo '<script>jQuery(".anchor4").addClass("active");</script>';
			?>
				<div class="row ">
					<div class="container">
						<div class="col-md-9">
							
							<div class="col-12">
									
								<h5>Share Registry</h5>
								<table class="table table-borderless table-striped ">
								  <thead class="bg-dark" >
								    <tr>
								      <th class="text-white" scope="col">#</th>
								      <th class="text-white" scope="col">Registry Title</th>
								      <th class="text-white" scope="col">Social Media</th>
								      <th class="text-white" scope="col">Email</th>
								      <th class="text-white" scope="col">Url</th>
								    </tr>
								  </thead>
								  <tbody>
								  <?php $my_registries = fetchAllPublishedRegistriesByAuthor($user_id);
								  
								  if( count($my_registries) < 1 ) {
								    echo '<tr><td colspan="5" style="text-align:center">No Published Registry</td></tr>';
								    
								    }
								$index = 1;
								foreach($my_registries as $registry ){
								
								if( $registry->post_status != 'publish' ) {
								    echo '<tr><td colspan="5">No published registry</td></tr>';
								    
								}else{
								    $personalMssg = empty( get_option('sirl_personal_message') )?'I’m so glad you’re part of my special event.':get_option('sirl_personal_message') ;
								    
								?>
								    <tr class="shadow-sm">
								      <th scope="row"><?php echo $index ?></th>
								      <td><?php echo $registry->post_title; ?></td>
								      <td><a  href="https://www.facebook.com/sharer/sharer.php?u=<?php echo home_url() ?>/gift_registry/<?php echo sanitize_title($registry->post_title) ?>"  target='_blank'><img src="https://silvercastle.co/wp-content/uploads/2019/05/fb.png" style="width:55px; height:45px"></a>
								      <a href="https://twitter.com/share?text=<?php echo $registry->post_title; ?>&url=<?php echo home_url() ?>/gift_registry/<?php echo sanitize_title($registry->post_title) ?>"  target='_blank'><img src="https://silvercastle.co/wp-content/uploads/2019/05/twitter2.png" style="width:55px; height:45px"></a>
								      <a data-toggle="modal" data-target="#shareViaWhatsApp<?php echo $registry->ID ?>" href="#"><img src="https://silvercastle.co/wp-content/uploads/2019/05/whatsapp.png" style="width:55px; height:45px"></a></td>
								      <td><a href="" data-toggle="modal" data-target="#shareViaEmail<?php echo $registry->ID ?>"><i data-feather="mail"></i></a></td>
								      <td><span  id="p<?php echo $registry->ID ?>"><?php echo home_url() ?>/gift_registry/<?php echo sanitize_title($registry->post_title) ?></span>&nbsp;<button class="p p<?php echo $registry->ID ?>" onclick="copyToClipboard('#p<?php echo $registry->ID ?>', <?php echo $registry->ID ?>)" data-toggle="tooltip" title="Copied!">Copy</button></td>
								    </tr>
								    	    <!-- Modal -->
                                    <div class="modal fade" id="shareViaWhatsApp<?php echo $registry->ID ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Share via WhatsApp</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>
                                          <div class="modal-body">
                                        <div class="col-md-12 tbl_resp">
                                            
                                        </div>
                                        <p class="ResponseReferralField"></p>
                                            
                                            <div class="col-md-12 tbl_whatsapp_resp">
                                                            
                                            </div>
                                            <div class='friendsWhatsappGroup form<?php echo $registry->ID ?>'>
                                                <div class="form-group col-md-4">
                                                    <label for="fullname">Fullname</label>
                                                    <input type="text" class="fullname" name="fullname[]" style="width:100%">
                                                    
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="phone">Phone</label>  
                                                    <input type="number" class="phone" name="phone[]" style="width:100%">
                                                </div>
                                                <div class="form-group col-md-3" style="padding-top:2.65rem">
                                                    
                                                    <button class="addMoreWhatsapp" style="border:0; background-color: #333;color:#fff;padding:10px 10px;">+ Add</button>
                                                    
                                                </div>
                                                <div class="form-group col-md-12" style="padding-top:2.65rem">
                                                    <button style="border:0; background-color: #800080;color:#fff;padding:10px 10px;" data-registry_id="<?php echo $registry->ID ?>" data-source="w" id="saveWhatsappContacts">Save Contacts</button>
                                                </div>
                                            </div>
                                            <p class="ResponsWhatsappField"></p>
                                          
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-alternative" data-dismiss="modal">Close</button>
                                            <a class="btn btn-alternative" href="https://wa.me/?text=<?php echo $registry->post_title; ?> - Our Registry: <?php echo home_url() ?>/gift_registry/<?php echo sanitize_title($registry->post_title) ?>" target="_blank">Share Via WhatsApp</a>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
								    <!-- Modal -->
                                    <div class="modal fade" id="shareViaEmail<?php echo $registry->ID ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Share via Email</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>
                                          <div class="modal-body">
                                           <section class="referral<?php echo $registry->ID ?>" style="margin-top: 4rem">
                                            
                                            
                                            <div class='friendsGroup form<?php echo $registry->ID ?>'>
                                                <div class="form-group col-md-6">
                                                    <label for="fullname">Fullname</label>
                                                    <input type="text" class="fullname" name="fullname[]" style="width:100%">
                                                    
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="phone">Email Address</label>  
                                                    <input type="phone" class="email" name="email[]" style="width:100%">
                                                </div>
                                                 <div class="form-group col-md-12">
                                                    <label for="message">Your Message</label>  
                                                    <textarea class="message" name="message[]" style="width:100%" rows="3"><?php echo $personalMssg  ?></textarea>
                                                </div>
                                               
                                            </div>
                                            
                                        </section>
                                        <div class="form-group col-md-6">
                                            <button data-id="<?php echo $registry->ID ?>" class="btn btn-alternative AddMoreEmailInvitees">+ Add Friends</button>
                                        </div>
                                        <div class="col-md-12 tbl_resp">
                                            
                                        </div>
                                       <p class="ResponseReferralField"></p>
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-alternative" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-alternative sendInvitees" data-source="n" data-flag="0" data-id="<?php echo $registry->ID ?>">Send Email</button>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
								<?php  $index++; } } ?>
								   </tbody>
								</table> 
							
							</div>
						</div>
						<div class="col-md-3">
						</div>
					</div>
				</div>

			<?php
		}else if($mypage == 'close-registry'){
			$registry_id = get_query_var('nextpage');
			echo '<script>jQuery(".anchor5").addClass("active");</script>';
				if( empty($registry_id) ){
				   
			?>
				<div class="row ">
					<div class="container">
					    <div class="spinner" style="position:fixed;top:40%;left:50%; background-color: #333; border-radius: 30px; padding: 10px; color:#fff; z-index: 1054;">Please Wait....</div>
						<div class="col-md-9">
							 <h6 class="alert text-white" style="background:#800080">We currently deliver only in Lagos. <a href="<?php echo home_url() ?>/delivery" style="color: #D89D23">Learn more</a></h6>
							<div class="col-12">
										
									
								<h5>Close Registry</h5>
								<table class="table table-borderless ">
								  <thead class="bg-light">
								    <tr>
								      <th scope="col">#</th>
								      <th scope="col">Registry Title</th>
								      <th scope="col">Status</th>
								      <th scope="col">Action</th>
								    </tr>
								  </thead>
								  <tbody>
								  <?php $my_registries = fetchAllRegistriesByAuthor($user_id);
								$index = 1;
								foreach($my_registries as $registry ){ ?>
								    <tr class="shadow-sm">
								      <th scope="row"><?php echo $index ?></th>
								      <td><?php echo $registry->post_title; ?></td>
								      <td><?php echo empty(get_post_meta($registry->ID, 'registry_status', true ) )?'Open':get_post_meta($registry->ID, 'registry_status', true ) ?></td>
								      <td><?php $link = "<a href='".home_url()."/registry/close-registry/?nextpage=".$registry->ID."' class='text-purple'>Close</a>";
								      $view_link = "<a href='".home_url()."/registry/close-registry/?nextpage=".$registry->ID."'>View Shipping</a>";
								       echo empty(get_post_meta($registry->ID, 'registry_status', true ) )?$link:$view_link ?></td>
								    </tr>
								<?php $index++; }  ?>
								   </tbody>
								</table> 
							
						
							</div>
						</div>
						<div class="col-md-3">
						</div>
					</div>
				</div>

				<?php }else if(!empty($registry_id) ){ 
				    	
        				    if ( is_user_logged_in() ) {
        		                $current_user = wp_get_current_user();
        		                $username = $current_user->user_login;
        		                $user_id = $current_user->ID;
        		                $user_email = $current_user->user_email;
        				    }
				?>
					<div class="row ">
					<div class="container">
					    <div class="spinner" style="position:fixed;top:40%;left:50%; background-color: #333; border-radius: 30px; padding: 10px; color:#fff; z-index: 1054;">Please Wait....</div>
						<div class="col-md-9">
							<h5>Where would you like us to ship your gift items?</h5>
							<div class="form-group">
								<label for="shipping_house_address">House Address</label>
								<input type="text" class="form-control bigheight" id="shipping_house_address" value="<?php echo get_post_meta($registry_id, 'shipping_house_address', true) ?>">
								<small class="text-muted" id="shipping_house_addressErrHelpMssg"></small>
							</div>
							<div class="form-group">
								<label for="shipping_city">City</label>
								<input type="text" class="form-control bigheight" id="shipping_city" value="<?php echo get_post_meta($registry_id, 'shipping_city', true) ?>" >
								<small class="text-muted" id="shipping_cityErrHelpMssg"></small>
							</div>
							<div class="form-group">
								<label for="shipping_state">State</label>
								<input type="text" class="form-control bigheight" id="shipping_state" value="<?php echo get_post_meta($registry_id, 'shipping_state', true) ?>" >
								<small class="text-muted" id="shipping_stateErrHelpMssg"></small>
							</div>
							<div class="form-group">
								<label for="shipping_country">Country</label>
								 <select name="countries"  id="shipping_country" aria-describedby="emailHelp" class="form-control bigPadding">
						<option value="">Select Country</option>
						<option value="<?php echo get_post_meta($registry_id, 'shipping_country', true) ?>" selected><?php echo get_post_meta($registry_id, 'shipping_country', true) ?></option>
						<option value="United States">United States</option> 
						<option value="United Kingdom">United Kingdom</option> 
						<option value="Afghanistan">Afghanistan</option> 
						<option value="Albania">Albania</option> 
						<option value="Algeria">Algeria</option> 
						<option value="American Samoa">American Samoa</option> 
						<option value="Andorra">Andorra</option> 
						<option value="Angola">Angola</option> 
						<option value="Anguilla">Anguilla</option> 
						<option value="Antarctica">Antarctica</option> 
						<option value="Antigua and Barbuda">Antigua and Barbuda</option> 
						<option value="Argentina">Argentina</option> 
						<option value="Armenia">Armenia</option> 
						<option value="Aruba">Aruba</option> 
						<option value="Australia">Australia</option> 
						<option value="Austria">Austria</option> 
						<option value="Azerbaijan">Azerbaijan</option> 
						<option value="Bahamas">Bahamas</option> 
						<option value="Bahrain">Bahrain</option> 
						<option value="Bangladesh">Bangladesh</option> 
						<option value="Barbados">Barbados</option> 
						<option value="Belarus">Belarus</option> 
						<option value="Belgium">Belgium</option> 
						<option value="Belize">Belize</option> 
						<option value="Benin">Benin</option> 
						<option value="Bermuda">Bermuda</option> 
						<option value="Bhutan">Bhutan</option> 
						<option value="Bolivia">Bolivia</option> 
						<option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option> 
						<option value="Botswana">Botswana</option> 
						<option value="Bouvet Island">Bouvet Island</option> 
						<option value="Brazil">Brazil</option> 
						<option value="British Indian Ocean Territory">British Indian Ocean Territory</option> 
						<option value="Brunei Darussalam">Brunei Darussalam</option> 
						<option value="Bulgaria">Bulgaria</option> 
						<option value="Burkina Faso">Burkina Faso</option> 
						<option value="Burundi">Burundi</option> 
						<option value="Cambodia">Cambodia</option> 
						<option value="Cameroon">Cameroon</option> 
						<option value="Canada">Canada</option> 
						<option value="Cape Verde">Cape Verde</option> 
						<option value="Cayman Islands">Cayman Islands</option> 
						<option value="Central African Republic">Central African Republic</option> 
						<option value="Chad">Chad</option> 
						<option value="Chile">Chile</option> 
						<option value="China">China</option> 
						<option value="Christmas Island">Christmas Island</option> 
						<option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option> 
						<option value="Colombia">Colombia</option> 
						<option value="Comoros">Comoros</option> 
						<option value="Congo">Congo</option> 
						<option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option> 
						<option value="Cook Islands">Cook Islands</option> 
						<option value="Costa Rica">Costa Rica</option> 
						<option value="Cote D'ivoire">Cote D'ivoire</option> 
						<option value="Croatia">Croatia</option> 
						<option value="Cuba">Cuba</option> 
						<option value="Cyprus">Cyprus</option> 
						<option value="Czech Republic">Czech Republic</option> 
						<option value="Denmark">Denmark</option> 
						<option value="Djibouti">Djibouti</option> 
						<option value="Dominica">Dominica</option> 
						<option value="Dominican Republic">Dominican Republic</option> 
						<option value="Ecuador">Ecuador</option> 
						<option value="Egypt">Egypt</option> 
						<option value="El Salvador">El Salvador</option> 
						<option value="Equatorial Guinea">Equatorial Guinea</option> 
						<option value="Eritrea">Eritrea</option> 
						<option value="Estonia">Estonia</option> 
						<option value="Ethiopia">Ethiopia</option> 
						<option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option> 
						<option value="Faroe Islands">Faroe Islands</option> 
						<option value="Fiji">Fiji</option> 
						<option value="Finland">Finland</option> 
						<option value="France">France</option> 
						<option value="French Guiana">French Guiana</option> 
						<option value="French Polynesia">French Polynesia</option> 
						<option value="French Southern Territories">French Southern Territories</option> 
						<option value="Gabon">Gabon</option> 
						<option value="Gambia">Gambia</option> 
						<option value="Georgia">Georgia</option> 
						<option value="Germany">Germany</option> 
						<option value="Ghana">Ghana</option> 
						<option value="Gibraltar">Gibraltar</option> 
						<option value="Greece">Greece</option> 
						<option value="Greenland">Greenland</option> 
						<option value="Grenada">Grenada</option> 
						<option value="Guadeloupe">Guadeloupe</option> 
						<option value="Guam">Guam</option> 
						<option value="Guatemala">Guatemala</option> 
						<option value="Guinea">Guinea</option> 
						<option value="Guinea-bissau">Guinea-bissau</option> 
						<option value="Guyana">Guyana</option> 
						<option value="Haiti">Haiti</option> 
						<option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option> 
						<option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option> 
						<option value="Honduras">Honduras</option> 
						<option value="Hong Kong">Hong Kong</option> 
						<option value="Hungary">Hungary</option> 
						<option value="Iceland">Iceland</option> 
						<option value="India">India</option> 
						<option value="Indonesia">Indonesia</option> 
						<option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option> 
						<option value="Iraq">Iraq</option> 
						<option value="Ireland">Ireland</option> 
						<option value="Israel">Israel</option> 
						<option value="Italy">Italy</option> 
						<option value="Jamaica">Jamaica</option> 
						<option value="Japan">Japan</option> 
						<option value="Jordan">Jordan</option> 
						<option value="Kazakhstan">Kazakhstan</option> 
						<option value="Kenya">Kenya</option> 
						<option value="Kiribati">Kiribati</option> 
						<option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option> 
						<option value="Korea, Republic of">Korea, Republic of</option> 
						<option value="Kuwait">Kuwait</option> 
						<option value="Kyrgyzstan">Kyrgyzstan</option> 
						<option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option> 
						<option value="Latvia">Latvia</option> 
						<option value="Lebanon">Lebanon</option> 
						<option value="Lesotho">Lesotho</option> 
						<option value="Liberia">Liberia</option> 
						<option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option> 
						<option value="Liechtenstein">Liechtenstein</option> 
						<option value="Lithuania">Lithuania</option> 
						<option value="Luxembourg">Luxembourg</option> 
						<option value="Macao">Macao</option> 
						<option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option> 
						<option value="Madagascar">Madagascar</option> 
						<option value="Malawi">Malawi</option> 
						<option value="Malaysia">Malaysia</option> 
						<option value="Maldives">Maldives</option> 
						<option value="Mali">Mali</option> 
						<option value="Malta">Malta</option> 
						<option value="Marshall Islands">Marshall Islands</option> 
						<option value="Martinique">Martinique</option> 
						<option value="Mauritania">Mauritania</option> 
						<option value="Mauritius">Mauritius</option> 
						<option value="Mayotte">Mayotte</option> 
						<option value="Mexico">Mexico</option> 
						<option value="Micronesia, Federated States of">Micronesia, Federated States of</option> 
						<option value="Moldova, Republic of">Moldova, Republic of</option> 
						<option value="Monaco">Monaco</option> 
						<option value="Mongolia">Mongolia</option> 
						<option value="Montserrat">Montserrat</option> 
						<option value="Morocco">Morocco</option> 
						<option value="Mozambique">Mozambique</option> 
						<option value="Myanmar">Myanmar</option> 
						<option value="Namibia">Namibia</option> 
						<option value="Nauru">Nauru</option> 
						<option value="Nepal">Nepal</option> 
						<option value="Netherlands">Netherlands</option> 
						<option value="Netherlands Antilles">Netherlands Antilles</option> 
						<option value="New Caledonia">New Caledonia</option> 
						<option value="New Zealand">New Zealand</option> 
						<option value="Nicaragua">Nicaragua</option> 
						<option value="Niger">Niger</option> 
						<option value="Nigeria">Nigeria</option> 
						<option value="Niue">Niue</option> 
						<option value="Norfolk Island">Norfolk Island</option> 
						<option value="Northern Mariana Islands">Northern Mariana Islands</option> 
						<option value="Norway">Norway</option> 
						<option value="Oman">Oman</option> 
						<option value="Pakistan">Pakistan</option> 
						<option value="Palau">Palau</option> 
						<option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option> 
						<option value="Panama">Panama</option> 
						<option value="Papua New Guinea">Papua New Guinea</option> 
						<option value="Paraguay">Paraguay</option> 
						<option value="Peru">Peru</option> 
						<option value="Philippines">Philippines</option> 
						<option value="Pitcairn">Pitcairn</option> 
						<option value="Poland">Poland</option> 
						<option value="Portugal">Portugal</option> 
						<option value="Puerto Rico">Puerto Rico</option> 
						<option value="Qatar">Qatar</option> 
						<option value="Reunion">Reunion</option> 
						<option value="Romania">Romania</option> 
						<option value="Russian Federation">Russian Federation</option> 
						<option value="Rwanda">Rwanda</option> 
						<option value="Saint Helena">Saint Helena</option> 
						<option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option> 
						<option value="Saint Lucia">Saint Lucia</option> 
						<option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option> 
						<option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option> 
						<option value="Samoa">Samoa</option> 
						<option value="San Marino">San Marino</option> 
						<option value="Sao Tome and Principe">Sao Tome and Principe</option> 
						<option value="Saudi Arabia">Saudi Arabia</option> 
						<option value="Senegal">Senegal</option> 
						<option value="Serbia and Montenegro">Serbia and Montenegro</option> 
						<option value="Seychelles">Seychelles</option> 
						<option value="Sierra Leone">Sierra Leone</option> 
						<option value="Singapore">Singapore</option> 
						<option value="Slovakia">Slovakia</option> 
						<option value="Slovenia">Slovenia</option> 
						<option value="Solomon Islands">Solomon Islands</option> 
						<option value="Somalia">Somalia</option> 
						<option value="South Africa">South Africa</option> 
						<option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option> 
						<option value="Spain">Spain</option> 
						<option value="Sri Lanka">Sri Lanka</option> 
						<option value="Sudan">Sudan</option> 
						<option value="Suriname">Suriname</option> 
						<option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option> 
						<option value="Swaziland">Swaziland</option> 
						<option value="Sweden">Sweden</option> 
						<option value="Switzerland">Switzerland</option> 
						<option value="Syrian Arab Republic">Syrian Arab Republic</option> 
						<option value="Taiwan, Province of China">Taiwan, Province of China</option> 
						<option value="Tajikistan">Tajikistan</option> 
						<option value="Tanzania, United Republic of">Tanzania, United Republic of</option> 
						<option value="Thailand">Thailand</option> 
						<option value="Timor-leste">Timor-leste</option> 
						<option value="Togo">Togo</option> 
						<option value="Tokelau">Tokelau</option> 
						<option value="Tonga">Tonga</option> 
						<option value="Trinidad and Tobago">Trinidad and Tobago</option> 
						<option value="Tunisia">Tunisia</option> 
						<option value="Turkey">Turkey</option> 
						<option value="Turkmenistan">Turkmenistan</option> 
						<option value="Turks and Caicos Islands">Turks and Caicos Islands</option> 
						<option value="Tuvalu">Tuvalu</option> 
						<option value="Uganda">Uganda</option> 
						<option value="Ukraine">Ukraine</option> 
						<option value="United Arab Emirates">United Arab Emirates</option> 
						<option value="United Kingdom">United Kingdom</option> 
						<option value="United States">United States</option> 
						<option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option> 
						<option value="Uruguay">Uruguay</option> 
						<option value="Uzbekistan">Uzbekistan</option> 
						<option value="Vanuatu">Vanuatu</option> 
						<option value="Venezuela">Venezuela</option> 
						<option value="Viet Nam">Viet Nam</option> 
						<option value="Virgin Islands, British">Virgin Islands, British</option> 
						<option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option> 
						<option value="Wallis and Futuna">Wallis and Futuna</option> 
						<option value="Western Sahara">Western Sahara</option> 
						<option value="Yemen">Yemen</option> 
						<option value="Zambia">Zambia</option> 
						<option value="Zimbabwe">Zimbabwe</option>
					</select>
								<small class="text-muted" id="shipping_countryErrHelpMssg"></small>
							</div>
						<div class="form-group">
							<input type="hidden" id="registry_id" value="<?php echo $registry_id ?>">
							<input type="button" value="Close Registry" data-user_id="<?php echo $user_id ?>" class="btn btn-alternative" id="closeRegistry">
						</div>
						</div>
					</div>
				</div>

				<?php
		    }		
			
		}else if($mypage == 'my-wallets'){
		    echo '<script>jQuery(".anchor7").addClass("active");</script>';
		     if ( is_user_logged_in() ) {
					$current_user = wp_get_current_user();
			 		$username = $current_user->user_login;
			 		$user_id = $current_user->ID;
			 		$user_email = $current_user->user_email;
			        $wallets = fetch_cashgifts_by_user($user_id);
		    }
		    if(empty($wallets) ){
		        echo '<div class="row ">
    					<div class="container">
    						<div class="col-md-9"><h4>Your Wallet is not funded at the moment.</h4>
    					</div>
					</div>';
		    }else{ ?>
		        
		        	<div class="row ">
					<div class="container">
						<div class="col-md-9">
							 <h6 class="alert text-white" style="background:#800080">We currently deliver only in Lagos. <a href="<?php echo home_url() ?>/delivery" style="color: #D89D23">Learn more</a></h6>
							<div class="col-12">
										
									
								<h5>My Wallets</h5>
								<table class="table table-borderless ">
								  <thead class="bg-light">
								    <tr>
								      <th scope="col">#</th>
								      <th scope="col">Registry Title</th>
								      <th scope="col">Amount</th>
								      <th scope="col">Status</th>
								      <th scope="col">Date</th>
								      <th scope="col">Action</th>
								    </tr>
								  </thead>
								  <tbody>
								  <?php 
								$index = 1;
								foreach($wallets as $wallet ){ ?>
								    <tr class="shadow-sm">
								      <th scope="row"><?php echo $index ?></th>
								      <td><?php echo get_the_title($wallet->registry_id); ?></td>
								      <td><?php echo number_format(empty($wallet->cashgift )?'0':$wallet->cashgift); ?></td>
								      <td><?php echo $wallet->status; ?></td>
								      <td><?php echo $wallet->date; ?></td>
								      <td></td>
								    </tr>
								<?php $index++; }  ?>
								   </tbody>
								</table> 
							
						
							</div>
						</div>
						<div class="col-md-3">
						</div>
					</div>
				</div>
		        
		        <?php
		    }
		    
		}else if($mypage == 'settings'){
		    echo '<script>jQuery(".anchor6").addClass("active");</script>';
		    if ( is_user_logged_in() ) {
					$current_user = wp_get_current_user();
			 		$username = $current_user->user_login;
			 		$user_id = $current_user->ID;
			 		$user_email = $current_user->user_email;
			 		$billing_last_name = get_user_meta($user_id, 'billing_last_name', true);
			 		$billing_first_name = get_user_meta($user_id, 'billing_first_name', true);
			 		$billing_phone = get_user_meta($user_id, '$billing_phone', true);
		    }
				?>
				<div class="row ">
					<div class="container">
						<div class="col-md-9">
							<h4>Account Settings</h4>
    						<div class="form-group">
    						    <label for="email">Email</label>
    						    <input type="text" value="<?php echo $user_email ?>" id="user_email" disabled style="width:100%">
    						    <span id="email_ErrorField" class="text-muted"></span>
    						</div>
    						<div class="form-group">
    						    <label for="email">First Name</label>
    						    <input type="text" value="<?php echo $billing_first_name ?>" id="billing_first_name"  style="width:100%">
    						    <span id="first_nameErrorField" class="text-muted"></span>
    						</div>
						    <div class="form-group">
    						    <label for="email">Last Name</label>
    						    <input type="text" value="<?php echo $billing_last_name ?>" id="billing_last_name"  style="width:100%">
    						    <input type="hidden" value="<?php echo $user_id ?>" id="user_id"  style="width:100%">
    						    <span id="last_nameErrorField" class="text-muted"></span>
    						</div>
    						<div class="form-group">
    						    <label for="phone">Phone number</label>
    						    <input type="text" value="<?php echo $billing_phone ?>" id="billing_phone"  style="width:100%">
    						    
    						    <span id="phoneErrorField" class="text-muted"></span>
    						</div>
    						<div class="form-group">
    						    <label for="email">New Password</label>
    						    <input type="password"  id="user_password"  style="width:100%">
    						    <span id="user_passwordErrorField" class="text-muted"></span>
    						</div>
    						<div class="form-group">
    						    <label for="email">Confirm New Password</label>
    						    <input type="password"  id="confirm_user_password"  style="width:100%">
    						    <span id="user_cpasswordErrorField" class="text-muted"></span>
    						</div>
    						<input type="button" class="btn btn-alternative" id="updateAccountSettings" value="Update Account Settings">
							<p class="ResponseField"></p>
						</div>
						<div class="col-md-3">
						    <div class="card" >
    						  <div class="card-body">
    						    <h5 class="card-title hint-title" style="background-color:#800080"><i data-feather="feather"></i> Hint</h5>
    						    <p class="card-text">Changing your password? If not, just leave the password field blank.</p>
    						    You want to manage your registry, <a href="<?php echo home_url() ?>/registry/manage-registry" class="card-link">click here.</a>
    						  </div>
    						</div>
						</div>
					</div>
				</div>

			<?php
		}else if($mypage == 'shop'){ 
    			$registry_id = get_query_var('npage');
    			$orderby = 'name';
                $order = 'asc';
                $hide_empty = false ;
                $cat_args = array(
                    'orderby'    => $orderby,
                    'order'      => $order,
                    'hide_empty' => $hide_empty,
                    //'parent' => 0
                );
                $registry_status = get_post_meta($registry_id, 'registry_status', true);
            if($registry_status == 'closed'){
                echo '<div class="row ">
    					<div class="container">
    					    <h4>Hello, this registry is inaccessible because it was closed by you.</h4>
    				    </div>
    				</div>';
            }else{
             
                $product_categories = get_terms( 'product_cat', $cat_args );
                $all_categories = array();
                foreach($product_categories as $key => $category ){ array_push($all_categories, $category->term_id); }
    			?>
    			<div class="row ">
    					<div class="container">
    						<div class="col-md-12 mb-3 ml-3 mr-3">
    						<div class="spinner" style="position:fixed;top:40%;left:50%; background-color: #333; border-radius: 30px; padding: 10px; color:#fff; z-index: 1054;">Please Wait....</div>
    						<p>&laquo;&nbsp;<a  href="<?php echo home_url() ?>/registry/manage-registry">Back to Manage Registry</a></p>
    						<p class="text-purple">Current Registry: <?php echo get_the_title($registry_id) ?></p>
    							<?php if(dbtCheckPublishStatus($registry_id) == 'publish'){ ?>
    							<div class="card" >
    							  <div class="card-body">
    							    <p class="card-text text-purple">You are adding Products to <strong><?php echo get_the_title($registry_id) ?>. </strong><span class="float-right"></span><a href="<?php echo home_url() ?>/gift_registry/<?php echo sanitize_title(get_the_title($registry_id)); ?>">View My Gift Registry</a></span></p>
    							    <p>Share: <a  href="https://www.facebook.com/sharer/sharer.php?u=<?php echo home_url() ?>/gift_registry/<?php echo sanitize_title(get_the_title($registry_id)) ?>"  target='_blank'><img src="https://silvercastle.co/wp-content/uploads/2019/05/fb.png" style="width:55px; height:45px"></a>
    								      <a href="https://twitter.com/share?text=<?php echo get_the_title($registry_id) ?>&url=<?php echo home_url() ?>/gift_registry/<?php echo sanitize_title(get_the_title($registry_id)) ?>"  target='_blank'><img src="https://silvercastle.co/wp-content/uploads/2019/05/twitter2.png" style="width:55px; height:45px"></a>
    								      <a href="https://wa.me/?text=<?php echo get_the_title($registry_id) ?> - Our Registry: <?php echo home_url() ?>/gift_registry/<?php echo sanitize_title(get_the_title($registry_id)) ?>" target="_blank"><img src="https://silvercastle.co/wp-content/uploads/2019/05/whatsapp.png" style="width:55px; height:45px"></a></p>
    							  </div>
    							</div>
    							<?php } ?>
    							<div class="card" >
    							  <div class="card-body">
    							    <p class="card-text text-purple"><div class="form-check"><strong>Product Categories:&nbsp;&nbsp;&nbsp; </strong>
    							    <?php
    							    ?>
            							    <div style="display:inline-block;padding-left: 1rem;">&nbsp;&nbsp;&nbsp;  <input type="checkbox" class="form-check-input category-check" value="0" checked name="category-check" id="allChecked">
                                                        <label class="form-check-label" for="exampleCheck1"> All</label>&nbsp;&nbsp;&nbsp; 
            							   
                                                 
            							    <?php
            							   
            							    foreach($product_categories as $key => $category ){
            							  
            							        echo '
                                                        &nbsp;&nbsp;&nbsp;<input type="checkbox" class="form-check-input category-check" value="'.$category->term_id.'" name="category-check" >
                                                        <label class="form-check-label" for="exampleCheck1">'.$category->name.'</label>
                                                        &nbsp;&nbsp;&nbsp&nbsp;&nbsp;
                                                ';
            							      
            							    }
        							  
        							  
    							    ?>
    							    </div>
    							    </div>
    							    </p>
    							    
    							  </div>
    							</div>
    								<div class="card" >
    							  <div class="card-body">
    							   <label for="">Products per page</label>
    							   <div class="form-group">
    							       <select id="productsPerPage" style="width:100%">
    							           <option value="">Select products per page</option>
    							           <!--<option value="4">4</option>-->
    							           <option value="16">16</option>
    							           <option value="32">32</option>
    							           <option value="64">64</option>
    							       </select>
    							       <input type="hidden" value="<?php echo $registry_id ?>" id="registry_id">
    							   </div>
    							   
    							  </div>
    							</div
    						</div>
    						</div>
    						<div class="col-md-12 mb-5 products_box">
    						<?php
    							$limit = 16;
    							$products = loadProducts($limit);
    							$total_product_count = countAllProducts();
    							$tbl = 'posts';
    							
    							$extra_q = "post_type = 'product' AND post_status='publish'";
    							$pageno = (get_query_var('nextpage') )?get_query_var('nextpage'):1;
    							$products = dbt_initialize_pagination($tbl, $pageno, $extra_q, $limit, $products);
    							$curr_products = '';
    							foreach($products as $product ){ 
    							   
    								$product_data = wc_get_product($product->ID);
    								$image = $product_data->get_image();
    								$product_details = $product_data->get_data();
    								if ( 'crowding' == $product_data->get_type() ) {      
                                        $price  = get_post_meta( $product->ID, 'crowding_product_info', true);
                                        
                                        ?>
                                            <div class="card shadow-sm ml-3 mr-3 mb-3 d-inline-block" style="width:26rem;height:auto;">
            								  <!--<img class="card-img-top" src="<?php //echo $image[0] ?>" alt="Card image cap">-->
            								  <?php printf($image); ?>
            								  <div class="card-body">
            								    <h5 class="card-title" data-toggle="modal" data-target="#productModal<?php echo $product->ID ?>" style="cursor: pointer"><?php echo substr($product->post_title, 0, 25); ?></h5>
            								    <h6 class="card-text font-red"><?php echo '₦'.number_format($price,2) ?></h6>
            								    <?php if( check_if_product_exists_in_registry($product->ID, $registry_id) != true ){ ?>
            								    <p><select style="width: 100%" value="1" id="priority<?php echo $product->ID ?>">
            								    	<option value="">Select priority</option>
            								    	<option value="3">High</option>
            								    	<option value="2">Medium</option>
            								    	<option value="1">Low</option>
            								    	</select></p>
            								    	<p><small class="text-muted" id="priorityErrorMessage<?php echo $product->ID ?>"></small></p>
            								    <p><input type="number" style="width: 11.1rem" value="1" id="qty<?php echo $product->ID ?>"><a class="button addProductToRegistry" data-id="<?php echo $product->ID ?>" data-registry="<?php echo $registry_id ?>" id="addProductToRegistry<?php echo $product->ID ?>">Add to Registry</a></p>
            								    
            								    <p><small class="text-muted" id="AddErrorSuccessMessage<?php echo $product->ID ?>"></small></p>
            								    <?php }else{ ?>
            								    		
            								    	<p><select style="width: 100%" value="1" id="priority<?php echo $product->ID ?>" disabled>
            								    	<option value="">Select priority</option>
            								    	<option value="3">High</option>
            								    	<option value="2">Medium</option>
            								    	<option value="1">Low</option>
            								    	</select></p>
            								    	<p><small class="text-muted" id="priorityErrorMessage<?php echo $product->ID ?>"></small></p>
            								    <p><input type="number" style="width: 11.1rem" value="1" id="qty<?php echo $product->ID ?>" disabled><a class="button " data-id="<?php echo $product->ID ?>" data-registry="<?php echo $registry_id ?>" id="addProductToRegistry<?php echo $product->ID ?>" disabled>Add to Registry</a></p>
            								    
            								    <p style="margin: 5px;"><a class="button-solid button-gifting" data-toggle="tooltip" data-placement="top" title="Group gifting, this feature allows your guests make partial contribution towards your desired gift items." data-id="<?php echo $product->ID ?>" data-toggle="tooltip" data-placement="top" title="Group gifting, this feature allows your guests make partial contribution towards your desired gift items." data-registry="<?php echo $registry_id ?>" id="addProductToRegistry<?php echo $product->ID ?>">Make Group Gifting</a></p>
            								    <?php }
            								    
            								     ?>
            								  </div>
            								</div>
                                        
                                        <?php
    								}else{ 
    								
    								?>
    								<div class="card shadow-sm ml-3 mr-3 mb-3 d-inline-block" style="width:26rem;height:inherit;">
    								  <!--<img class="card-img-top" src="<?php //echo $image[0] ?>" alt="Card image cap">-->
    								  <?php printf($image); ?>
    								  <div class="card-body">
    								    <h5 class="card-title" data-toggle="modal" data-target="#productModal<?php echo $product->ID ?>" style="cursor: pointer"><?php echo substr($product->post_title, 0, 25); ?></h5>
    								    <h6 class="card-text font-red"><?php echo $product_data->get_price_html(); ?></h6>
    								    <?php if( check_if_product_exists_in_registry($product->ID, $registry_id) != true ){ ?>
    								    <p><select style="width: 100%" value="1" id="priority<?php echo $product->ID ?>">
    								    	<option value="">Select priority</option>
    								    	<option value="3">High</option>
    								    	<option value="2">Medium</option>
    								    	<option value="1">Low</option>
    								    	</select></p>
    								    	<p><small class="text-muted" id="priorityErrorMessage<?php echo $product->ID ?>"></small></p>
    								    <p><input type="number" style="width: 11.1rem" value="1" id="qty<?php echo $product->ID ?>"><a style="" class="button addProductToRegistry" data-id="<?php echo $product->ID ?>" data-registry="<?php echo $registry_id ?>" id="addProductToRegistry<?php echo $product->ID ?>">Add to Registry</a></p>
    								    
    								    <p><small class="text-muted" id="AddErrorSuccessMessage<?php echo $product->ID ?>"></small></p>
    								    <?php }else{ ?>
    								            <p><select style="width: 100%" value="1" id="priority<?php echo $product->ID ?>" disabled>
    								    	<option value="">Select priority</option>
    								    	<option value="3">High</option>
    								    	<option value="2">Medium</option>
    								    	<option value="1">Low</option>
    								    	</select></p>
    								    	<p><small class="text-muted" id="priorityErrorMessage<?php echo $product->ID ?>"></small></p>
    								    <p><input type="number" style="width: 11.1rem" value="1" id="qty<?php echo $product->ID ?>" disabled><a class="button-disabled" data-id="<?php echo $product->ID ?>" data-registry="<?php echo $registry_id ?>" id="addProductToRegistry<?php echo $product->ID ?>" disabled>Already Added</a></p>
    								    <p style="margin: 5px;"><a class="button-solid button-gifting" data-id="<?php echo $product->ID ?>" data-toggle="tooltip" data-placement="top" title="Group gifting, this feature allows your guests make partial contribution towards your desired gift items." data-registry="<?php echo $registry_id ?>" id="addProductToRegistry<?php echo $product->ID ?>">Make Group Gifting</a></p>
    								    
    								    		
    								    	
    								    <?php }
    								    
    								     ?>
    								  </div>
    								</div>
    								<?php } ?>			<!-- Modal -->
    								<div class="modal fade" id="productModal<?php echo $product->ID ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    								  <div class="modal-dialog modal-dialog-centered" role="document">
    								    <div class="modal-content">
    								      
    								      <div class="modal-body">
    								        <div class="card mb-3 ml-2 mr-2" >
    										  <div class="row">
    										    <div class="col-md-5">
    										       <?php printf($image); ?>
    										    </div>
    										    <div class="col-md-7">
    										      <div class="card-body">
    										        <h5 class="card-title"><?php echo $product->post_title ?></h5>
    										        <p class="card-text"><?php echo $product_data->get_price_html(); ?></p>
    										        <p class="card-text text-justify"><?php echo $product_details['short_description']; ?></p>
    										      </div>
    										    </div>
    										  </div>
    										</div>
    								      </div>
    								    </div>
    								  </div>
    								</div>
    					<?php	} ?>
    						</div>
    						<?php if(dbtCheckPublishStatus($registry_id) == 'publish'){ ?>
    							<div class="card mt-5 mb-5" >
    							  <div class="card-body">
    							      <input type="hidden" value="<?php echo $registry_id ?>" id="registry_id">
    							    <p class="card-text text-purple">You are adding Products to <strong><?php echo get_the_title($registry_id) ?> registry.</strong><span class="float-right"></span><a href="<?php echo home_url() ?>/gift_registry/<?php echo sanitize_title(get_the_title($registry_id)); ?>" >&nbsp;View My Gift Registry</a></span></p>
    							    <p>Share: <a  href="https://www.facebook.com/sharer/sharer.php?u=<?php echo home_url() ?>/gift_registry/<?php echo sanitize_title(get_the_title($registry_id)) ?>"  target='_blank'><img src="https://silvercastle.co/wp-content/uploads/2019/05/fb.png" style="width:55px; height:45px"></a>
    								      <a href="https://twitter.com/share?text=<?php echo get_the_title($registry_id) ?>&url=<?php echo home_url() ?>/gift_registry/<?php echo sanitize_title(get_the_title($registry_id)) ?>"  target='_blank'><img src="https://silvercastle.co/wp-content/uploads/2019/05/twitter2.png" style="width:55px; height:45px"></a>
    								      <a href="https://wa.me/?text=<?php echo get_the_title($registry_id) ?> - Our Registry: <?php echo home_url() ?>/gift_registry/<?php echo sanitize_title(get_the_title($registry_id)) ?>" target="_blank"><img src="https://silvercastle.co/wp-content/uploads/2019/05/whatsapp.png" style="width:55px; height:45px"></a></p>
    							 
    							    <button class="btn btn-alternative" disabled>Published</button>
    							   </div>
    							  </div>
    							 <?php }else{ ?>
    							 <div class="card mt-5 mb-5" >
    							      <div class="card-body">
    							      <input type="hidden" value="<?php echo $registry_id ?>" id="registry_id">
    							  <button class="btn btn-alternative"  id="publishRegistry" data-slider="0">Publish Registry</button>
        							  </div>
        							</div>
    							  <?php } 
    							    $personalMssg = empty( get_option('sirl_personal_message') )?'I’m so glad you’re part of my special event.':get_option('sirl_personal_message') ;
    							  ?>
    							  
    							<!-- Modal -->
                                    <div class="modal fade" id="publishRegistryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Publish <?php echo get_the_title($registry_id) ?> Registry.</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>
                                          <div class="modal-body">
                                            <h5>Thank You!</h5>
                                            <p>Note: You can still edit your registry even after it has been published.</p>
                                           
                                            <section id="shareToFriends">
                                                <p>Share via Social Media:   <a  href="https://www.facebook.com/sharer/sharer.php?u=<?php echo home_url() ?>/gift_registry/<?php echo sanitize_title(get_the_title($registry_id)) ?>"  target='_blank'>><img src="https://silvercastle.co/wp-content/uploads/2019/05/fb.png" style="width:55px; height:45px"></a>
    								                        <a href="https://twitter.com/share?text=<?php echo get_the_title($registry_id) ?>&url=<?php echo home_url() ?>/gift_registry/<?php echo sanitize_title(get_the_title($registry_id)) ?>"  target='_blank'><img src="https://silvercastle.co/wp-content/uploads/2019/05/twitter2.png" style="width:55px; height:45px"></a>
    								                        <a href="https://wa.me/?text=<?php echo get_the_title($registry_id) ?> - Our Registry: <?php echo home_url() ?>/gift_registry/<?php echo sanitize_title(get_the_title($registry_id)) ?>" target="_blank"><img src="https://silvercastle.co/wp-content/uploads/2019/05/whatsapp.png" style="width:55px; height:45px"></a></p>
    								            <p>Share via Email: </p>
    								            
    								          <section class="referral<?php echo $registry->ID ?>" style="margin-top: 4rem">
                                                
                                                
                                                <div class='friendsGroup form<?php echo $registry->ID ?>'>
                                                    <div class="form-group col-md-6">
                                                        <label for="fullname">Fullname</label>
                                                        <input type="text" class="fullname" name="fullname[]" style="width:100%">
                                                        
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="phone">Email Address</label>  
                                                        <input type="phone" class="email" name="email[]" style="width:100%">
                                                    </div>
                                                     <div class="form-group col-md-12">
                                                        <label for="message">Your Message</label>  
                                                        <textarea class="message" name="message[]" style="width:100%" rows="3"><?php echo $personalMssg  ?></textarea>
                                                    </div>
                                                   
                                                </div>
                                                
                                            </section>
                                            <div class="form-group col-md-6">
                                                <button data-id="<?php echo $registry->ID ?>" class="btn btn-alternative AddMoreEmailInvitees">+ Add Friends</button>
                                            </div>
                                              <div class="col-md-12 tbl_resp">
                                                
                                            </div>
                                           <p class="ResponseReferralField"></p>
                                            <!--<button type="button" class="btn btn-alternative sendInvitees" data-id="<?php echo $registry->ID ?>">Send Email</button>  -->
                                            </section>
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-alternative" data-dismiss="modal">Close</button>
                                            <!--<button type="button" class="btn btn-alternative" id="publishRegistry" data-registry="<?php echo $registry_id ?>">Publish now</button>-->
                                            <button type="button" class="btn btn-alternative sendInvitees"  data-id="<?php echo $registry_id ?>">Send Mail</button>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
    					</div>
    			</div>
                <div class="row">
                    <?php 
                    
                        
                        $total_rows = count(loadProducts('all'));
                        $no_of_records_per_page = $limit;
                        $total_pages = ceil($total_rows / $no_of_records_per_page);
                        $page_no = $pageno;
                    ?>
                        
        			    <div class="pagination_field col-md-4 offset-md-4">
        					<ul class="pagination">
                        	    <li class="page-item"><a class="page-link" data-registry_id="<?php echo $registry_id ?>" id="firstPage" style="cursor:pointer">First</a></li>
                        	    <li class="page-item">
                        	        <a  class="page-link" style="cursor:pointer" data-registry_id="<?php echo $registry_id ?>" id="prevPage">Prev</a>
                        	    </li>
                        	    <li class="page-item">
                        	        <a class="page-link" id="nextPage" data-registry_id="<?php echo $registry_id ?>" style="cursor:pointer">Next</a>
                        	    </li>
                        	    <li class="page-item"><a class="page-link" data-registry_id="<?php echo $registry_id ?>" style="cursor:pointer" id="lastPage">Last</a></li>
                        	</ul>
                    	</div>
                    	<div class="spinner" style="position:fixed;top:40%;left:50%; background-color: #333; border-radius: 30px; padding: 10px; color:#fff; z-index: 1054;">Please Wait....</div>
                </div>
            
		<?php }
		} else if($mypage == 'manage-shop'){ 
			$registry_id = get_query_var('npage');
			//echo get_the_title($registry_id);
			?>
			<div class="row ">
					<div class="container">
						<div class="col-md-12 mb-3 ml-3 mr-3">
						<div class="spinner" style="position:fixed;top:40%;left:50%; background-color: #333; border-radius: 30px; padding: 10px; color:#fff; z-index: 1054;">Please Wait....</div>
						<p>&laquo;&nbsp;<a  href="<?php echo home_url() ?>/registry/manage-registry">Back to Manage Registry</a></p>
							<div class="card" >
							  <div class="card-body">
							    <p class="card-text text-purple">You are editing Products in <strong><?php echo get_the_title($registry_id) ?> registry.</strong><span class="float-right"></span><a href="<?php echo home_url() ?>/gift_registry/<?php echo sanitize_title(get_the_title($registry_id)); ?>">&nbsp;View My Gift Registry</a></span></p>
							    <p><a  href="https://www.facebook.com/sharer/sharer.php?u=<?php echo home_url() ?>/gift_registry/<?php echo sanitize_title($registry->post_title) ?>"  target='_blank'><img src="https://silvercastle.co/wp-content/uploads/2019/05/fb.png" style="width:55px; height:45px"></a>
								      <a href="https://twitter.com/share?text=<?php echo get_the_title($registry_id) ?>&url=<?php echo home_url() ?>/gift_registry/<?php echo sanitize_title(get_the_title($registry_id)) ?>"  target='_blank'><img src="https://silvercastle.co/wp-content/uploads/2019/05/twitter2.png" style="width:55px; height:45px"></a>
								      <a href="https://wa.me/?text=<?php echo get_the_title($registry_id) ?> - Our Registry: <?php echo home_url() ?>/gift_registry/<?php echo sanitize_title(get_the_title($registry_id)) ?>" target="_blank"><img src="https://silvercastle.co/wp-content/uploads/2019/05/whatsapp.png" style="width:55px; height:45px"></a></p>
							  </div>
							</div>
						</div>
						<div class="col-md-12">
						<?php
							//$products = loadProducts(); 
							$products = loadProductsByRegistryID($registry_id);
						
							if(count($products) > 0 ){
							foreach($products as $product ){ 
								$product_data = wc_get_product($product->ID);
								$image = $product_data->get_image();
								$product_details = $product_data->get_data();
							    
							    ?>
								<div class="card shadow-sm ml-3 mr-3 mb-3 py-5 d-inline-block" style="width:26rem">
								 
								  <?php printf($image); ?>
								  <div class="card-body p-3">
								    <h5 class="card-title" data-toggle="modal" data-target="#productModal<?php echo $product->ID ?>" style="cursor: pointer"><?php echo ( strlen($product->post_title) > 21?substr($product->post_title, 0, 21).'...':$product->post_title ); ?></h5>
								    <h6 class="card-text font-red"><?php echo $product_data->get_price_html(); ?></h6>
								    <?php //if( check_if_product_exists_in_registry($product->ID, $registry_id) != true ){ ?>
								    <p><select style="width: 100%" value="1" id="priority<?php echo $product->ID ?>">
								    	<option value="">Select priority</option>
								    	<?php $priority = fetch_giftregistry_data($registry_id, $product->ID, 'priority'); 
								    	if( $priority == 3 ) { ?>
								    	<option value="3" selected>High</option>
								    	<option value="2">Medium</option>
								    	<option value="1">Low</option>
								    	<?php }else if($priority == 2 ){ ?>
								    		<option value="3" >High</option>
								    	    <option value="2" selected>Medium</option>
								    	    <option value="1">Low</option>
								    	<?php }else if($priority == 1 ){ ?>
								    	    <option value="3" >High</option>
								    	    <option value="2" >Medium</option>
								    	    <option value="1" selected>Low</option>
								    	<?php }else{ ?>
								    	    <option value="3" >High</option>
								    	    <option value="2" >Medium</option>
								    	    <option value="1" >Low</option>
								    	<?php } ?>
								    	</select></p>
								    	<p><small class="text-muted" id="priorityErrorMessage<?php echo $product->ID ?>"></small></p>
								    	<?php $qty =  fetch_giftregistry_data($registry_id, $product->ID, 'qty'); ?>
								    <p><input type="number" style="width: 11.1rem" value="<?php echo $qty ?>" id="qty<?php echo $product->ID ?>"><a class="button updateProductRegistry" data-id="<?php echo $product->ID ?>" data-registry="<?php echo $registry_id ?>" id="updateProductRegistry<?php echo $product->ID ?>">Update Product</a></p>
								    <p><small class="text-muted" id="AddErrorSuccessMessage<?php echo $product->ID ?>"></small></p>
								    <?php if( is_group_gift($registry_id, $product->ID) == false ){ ?>
								        <p><a class="button-solid button-gifting" data-id="<?php echo $product->ID ?>" data-registry="<?php echo $registry_id ?>" data-toggle="tooltip" data-placement="top" title="Group gifting, this feature allows your guests make partial contribution towards your desired gift items." id="groupGifting<?php echo $product->ID ?>">Make Group Gifting</a></p>
								    <?php }else{ ?>
								        <p><a class="button-solid-remove-gifting button-remove-gifting" data-id="<?php echo $product->ID ?>" data-registry="<?php echo $registry_id ?>" id="groupGifting<?php echo $product->ID ?>">Remove Group Gifting</a></p>
								    <?php } ?>
								    <p ><a class="button-remove removeProductRegistry" data-id="<?php echo $product->ID ?>" data-registry="<?php echo $registry_id ?>" >Remove Product</a></p>

								  </div>
								</div>
											<!-- Modal -->
								<div class="modal fade" id="productModal<?php echo $product->ID ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								  <div class="modal-dialog modal-dialog-centered" role="document">
								    <div class="modal-content">
								      
								      <div class="modal-body">
								        <div class="card mb-3 ml-2 mr-2" >
										  <div class="row">
										    <div class="col-md-5">
										       <?php printf($image); ?>
										    </div>
										    <div class="col-md-7">
										      <div class="card-body">
										        <h5 class="card-title"><?php echo $product->post_title ?></h5>
										        <p class="card-text"><?php echo $product_data->get_price_html(); ?></p>
										        <p class="card-text text-justify"><?php echo $product_details['short_description']; ?></p>
										      </div>
										    </div>
										  </div>
										</div>
								      </div>
								    </div>
								  </div>
								</div>
					
					 <?php  } }else{
					            $current_user = wp_get_current_user();
            			 		$username = $current_user->user_login;
            			 		$user_id = $current_user->ID;
            			 		$user_email = $current_user->user_email;
            			 		$billing_last_name = get_user_meta($user_id, 'billing_last_name', true);
            			 		$billing_first_name = get_user_meta($user_id, 'billing_first_name', true);
            			 		$billing_phone = get_user_meta($user_id, '$billing_phone', true);
            			 		
					            echo '<div class="col-md-12"><h5>Hello '.$billing_first_name.', you currently do not have any gifts in your registry. Kindly <a href="'.home_url().'/registry/shop/'.$registry_id.'">click here </h5></div>';
					            $cashgift = fetch_cashgift_by_registry($registry_id);
					        } ?>
					        	<div class="card shadow-sm ml-3 mr-3 mb-3 py-5 d-inline-block" style="width:26rem">
								   <img class="card-img-top" src="https://silvercastle.co/wp-content/uploads/2019/07/gift_inside_cash-512.png" alt="Card image cap">
								  <div class="card-body p-3">
								    <h5 class="card-title" >Cash Gift</h5>
								    <h6 class="card-text font-red d-block mb-5"><?php echo empty($cashgift['cashgift'])?'0':$cashgift['cashgift']; ?></h6>
						
								    <?php if( get_post_meta($registry_id, 'cash_gift_yes_or_no', true) == 'no' ){ ?>
							                <p><a class="button-solid" data-registry="<?php echo $registry_id ?>" id="enable_cashgift">Enable Cash Gift</a></p>
								    	<?php }else if( get_post_meta($registry_id, 'cash_gift_yes_or_no', true) == 'yes' ){ ?>
								    	    <p><a class="button-solid" data-registry="<?php echo $registry_id ?>" id="disable_cashgift">Disable Cash Gift</a></p>
								    <?php	}else{ ?>
								        <p><a class="button-solid" data-registry="<?php echo $registry_id ?>" id="enable_cashgift">Enable Cash Gift</a></p>
								        <?php
								    }
								     ?>
								  </div>
								</div>
						</div>
							<div class="col-md-12 mb-3 ml-3 mr-3">
						
							<div class="card" >
							  <div class="card-body">
							    <p class="card-text text-purple">You are editing Products in <strong><?php echo get_the_title($registry_id) ?> registry.</strong><span class="float-right"></span><a href="<?php echo home_url() ?>/gift_registry/<?php echo sanitize_title(get_the_title($registry_id)); ?>">&nbsp;View My Gift Registry</a></span></p>
							    <p><a  href="https://www.facebook.com/sharer/sharer.php?u=<?php echo home_url() ?>/gift_registry/<?php echo sanitize_title($registry->post_title) ?>"  target='_blank'><img src="https://silvercastle.co/wp-content/uploads/2019/05/fb.png" style="width:55px; height:45px"></a>
								      <a href="https://twitter.com/share?text=<?php echo $registry->post_title; ?> &url=<?php echo home_url() ?>/gift_registry/<?php echo sanitize_title($registry->post_title) ?>"  target='_blank'><img src="https://silvercastle.co/wp-content/uploads/2019/05/twitter2.png" style="width:55px; height:45px"></a>
								      <a href="https://wa.me/?text=<?php echo $registry->post_title; ?> - Our Registry: <?php echo home_url() ?>/gift_registry/<?php echo sanitize_title($registry->post_title) ?>" target="_blank"><img src="https://silvercastle.co/wp-content/uploads/2019/05/whatsapp.png" style="width:55px; height:45px"></a></p>
							  </div>
							</div>
						</div>
					</div>
			</div>


		<?php }else{
		echo '<script>jQuery(".anchor1").addClass("active");</script>';
		?>
			<div class="row ">
					<div class="container">
					    
					   
						<div class="col-md-9 px-3">
						    <h6 class="alert text-white" style="background:#800080">We currently deliver only in Lagos. <a href="<?php echo home_url() ?>/delivery" style="color: #D89D23">Learn more</a></h6>
						    <div class="row">
							<?php $my_registries = fetchAllRegistriesByAuthor($user_id);
						
							if(count($my_registries) > 0 ){
    							foreach($my_registries as $registry ){
    							    $registry_id = $registry->ID;
    								$image = wp_get_attachment_image_src( get_post_thumbnail_id( $registry->ID ) );
    								?>
    							
    							<div class="card mb-3 ml-2 mr-2 col-md-5" >
    							  <div class="row no-gutters">
    							    <div class="col-md-4">
    							      <img src="<?php echo $image[0] ?>" class="card-img" alt="...">
    							    </div>
    							    <div class="col-md-8">
    							      <div class="card-body">
    							        <a href="<?php echo get_permalink($registry->ID) ?>"><h5 class="card-title"><?php echo $registry->post_title; ?></h5></a>
    							        <p class="card-text"><?php echo substr($registry->post_content, 0, 26); ?>..</p>
    							        <p class="card-text"><small class="text-muted"> <strong>Gifts:</strong> <?php echo count_my_registry_gifts($registry->ID) ?>  | <strong>Privacy Setting: </strong><?php echo ucfirst(get_post_meta($registry->ID, 'registry_privacy', true) ) ?></small> <br> <a href="<?php echo home_url() ?>/registry/shop/<?php echo $registry->ID; ?>"><i data-feather="plus-square" class="small-icon"></i> Add More Products</a> &nbsp;&nbsp;|
    							        <a class="text-purple" href="<?php echo home_url() ?>/registry/manage-shop/<?php echo $registry->ID ?>">Manage Products</a> |&nbsp;&nbsp;
    							       	<?php if(dbtCheckPublishStatus($registry_id) == 'publish'){ ?> <a href="<?php echo get_permalink($registry->ID) ?>" style="color:blue;">View Registry</a></p> <?php } ?>
    							      </div>
    							    </div>
    							  </div>
    							</div>
    							
    							<?php } ?>
						
							
							
							<?php
							
							}else{ ?>
							
							    <div class="col-md-12">
								    <h4>You don't have any registry yet. <br><br><a class="btn btn-alternative" href="<?php echo home_url() ?>/create-gift-registry">Click here to create one</a></h4>
							    </div>
							
						
                            <?php	} ?>
					
        				
							</div>
						</div>
						<div class="col-md-3">
							<div class="card" >
    						  <div class="card-body">
    						    <h5 class="card-title hint-title" style="background:#800080"><i data-feather="feather"></i> Hint</h5>
    						    <p class="card-text">Hello <?php echo get_user_meta($user_id, 'billing_first_name', true) ?>,<br>
    						    Do you know you can have multiple registries?<br> You can have a registry for any event you want ... in case your event type is not listed simply select <strong>other</strong> as your event type.</p>
    						    You want to manage your Registry? Please <a href="<?php echo home_url() ?>/registry/manage-registry" class="card-link" style="color:#D89D23">Click here.</a>
    						  </div>
						    </div>
						</div>
					</div>
				</div>
				
		<?php }
		}else{
		    if ( is_user_logged_in() ){
		        $url = home_url().'/create-gift-registry';
			    echo '<script>window.location.href="'.$url.'"</script>';
		    }else{
		        $url = home_url().'/my-account';
			    echo '<script>window.location.href="'.$url.'"</script>';    
		    }
		}
        
	}
	add_shortcode('dbt_registry', 'dbt_registry');

	function dbt_giftregistry(){
		$registry_id =  get_the_ID(); 
		 if ( is_user_logged_in() ) {
				
				$current_user = wp_get_current_user();
		 		$user_id = $current_user->ID;
		 }else{
		     $user_id = 0;
		 }
		$registry_privacy = get_post_meta($registry_id,'registry_privacy', true);
		$registry_status = get_post_meta($registry_id, 'registry_status', true);
		$author_id = get_post_field( 'post_author', $registry_id );
		if($registry_status == 'closed'){ 
		    if( $user_id == $author_id ){
		            echo '<div class="row mb-5"><div class="container">';
		        	$products = loadProductsByRegistryID($registry_id);
		        	foreach($products as $product ){ 
								$product_data = wc_get_product($product->ID);
								$image = $product_data->get_image();
								$product_details = $product_data->get_data();
							
									if ( ('crowding' == $product_data->get_type() ) || (is_group_gift($registry_id, $product->ID) == true ) ) {  
								
								    $crowding_flag = 1;
                                    $price  = get_post_meta( $product->ID, 'crowding_product_info', true);
                                    $curr_price = fetch_crowdsourcing_curr_price($registry_id, $product->ID);
                                    
                                    $price = $price - $curr_price;
                                    
                                    if( is_group_gift($registry_id, $product->ID) == true  ){
                                        $price  = $product_data->get_price();
                                        $curr_price = fetch_crowdsourcing_curr_price($registry_id, $product->ID);
                                        
                                        $price = $price - $curr_price;
                                        $group_gift_flag = 1;
                                    }
                                    ?>
                                        <div class="card shadow-sm ml-3 mr-3 mb-3 d-inline-block" style="width:26rem">
        								
        								  <?php printf($image); ?>
        								  <div class="card-body">
        								    <h5 class="card-title" data-toggle="modal" data-target="#productModal<?php echo $product->ID ?>" style="cursor: pointer"><?php echo $product->post_title; ?></h5>
        								    <h6 class="card-text font-red">Target: <?php echo '₦'.number_format($price,2) ?></h6>
        								  
            								    <p class="priority-stars"><?php if( fetch_giftregistry_data($registry_id, $product->ID, 'priority') == 3 ){ ?>
            								    <i data-feather="star"></i><i data-feather="star"></i><i data-feather="star"></i><i data-feather="star"></i><i data-feather="star"></i>
            								    	<?php }else if( fetch_giftregistry_data($registry_id, $product->ID, 'priority') == 2 ){ ?>
            								    	<i data-feather="star"></i><i data-feather="star"></i><i data-feather="star"></i>
            								    	<?php }else{ ?>
            								    		<i data-feather="star"></i>
            								    		<?php } ?>
            								    	</p>
            								    	<?php  if( is_group_gift($registry_id, $product->ID) == true  ){ ?>
            								    	    <p class="text-muted">This is a group gift...please enter the amount you want to contribute.</p>
            								    	<?php } ?>
            								    
            								    <p><span class="text-purple">Paid:</span> <?php echo '₦'. number_format(fetch_crowdsourcing_curr_price($registry_id, $product->ID), 2 ) ?>&nbsp;&nbsp; | &nbsp;&nbsp;<span class="text-primary">Left: </span><?php echo '₦'. number_format($price, 2) ?></p>
            
            								    <p><small class="text-muted" id="AddErrorSuccessMessage<?php echo $product->ID ?>"></small></p>
        								    <?php 
        								    
        								     ?>
        								  </div>
        								</div>
                                    
                                    <?php
								}else{ 
								$price = $product_data->get_price();
								$crowding_flag = 0;
								echo '<script>var crowdingFlag = 0; </script>';
								?>
								<div class="card shadow-sm ml-3 mr-3 mb-3 d-inline-block bought" style="width:26rem">
								  <?php printf($image); ?>
								  <div class="card-body">
								    <h5 class="card-title" data-toggle="modal" data-target="#productModal<?php echo $product->ID ?>" style="cursor: pointer"><?php echo $product->post_title; ?></h5>
								    <h6 class="card-text font-red"><?php echo $product_data->get_price_html(); ?></h6>
								    
								    <p class="priority-stars"><?php if( fetch_giftregistry_data($registry_id, $product->ID, 'priority') == 3 ){ ?>
								    <i data-feather="star"></i><i data-feather="star"></i><i data-feather="star"></i><i data-feather="star"></i><i data-feather="star"></i>
								    	<?php }else if( fetch_giftregistry_data($registry_id, $product->ID, 'priority') == 2 ){ ?>
								    	<i data-feather="star"></i><i data-feather="star"></i><i data-feather="star"></i>
								    	<?php }else{ ?>
								    		<i data-feather="star"></i>
								    		<?php } ?>
								    	</p>
								   
								    <p><span class="text-purple">Desired Quantity:</span> <?php echo fetch_giftregistry_data($registry_id, $product->ID, 'qty') ?> &nbsp;&nbsp;|&nbsp;&nbsp; <span class="text-danger">Purchased: </span><?php echo fetch_product_status($registry_id, $product->ID) ?></p>

								    <p><small class="text-muted" id="AddErrorSuccessMessage<?php echo $product->ID ?>"></small></p>
								     
								  </div>
								</div>
						    <?php }
						    
		        	}
		        	if( get_post_meta($registry_id, 'cash_gift_yes_or_no', true) == 'yes' ){ 
					            $amt_paid = fetch_cash_gift_amt_paid($registry_id);
					        $pkey = get_option('sirl_pkey');
                            $pkey_test = get_option('sirl_test_pkey');
                            $pkey = (get_option('sirl_activate_live_keys') == 'on' )?$pkey:$pkey_test;
					        ?>
						        
						         <div class="card shadow-sm ml-3 mr-3 mb-3 d-inline-block" style="width:26rem">
        								  <img class="card-img-top" src="https://silvercastle.co/wp-content/uploads/2019/07/gift_inside_cash-512.png" alt="Card image cap">
        								  <?php //printf($image); ?>
        								  <div class="card-body">
        								    <h5 class="card-title" >Cash Gift</h5>
        								    <h6 class="card-text font-red">&nbsp;</h6>
            								
            								<p class="text-muted">This is a cash gift...please enter the amount you want to contribute.</p>
            								
            								  
            								<p><span class="text-purple">Paid:</span> <?php echo '₦'. number_format($amt_paid, 2 ) ?>&nbsp;&nbsp; </p>
            
            								    <p><small class="text-muted" id="CashGiftErrorSuccessMessage>"></small></p>
        								    <?php 
        								    
        								     ?>
        								  </div>
        								</div>
        					<?php } 
		        	echo '</div></div></div>';
									
		    }else{
		?>
		
		    <div class="row ">
					<div class="container">
						<div class="col-md-12 mb-3 ml-3 mr-3 mt-4 mb-5">
    							<h4 class="text-center">This Registry has been closed.</h4>
    					</div>
    				</div>
    		</div>
    		
					
		
		<?php    }
		}else{
		    if($registry_privacy != 'passworded'){
		
		    ?>
				<div class="row ">
					<div class="container">
						<div class="col-md-12 mb-3 ml-3 mr-3 mt-4 mb-5">
						<div class="spinner" style="position:fixed;top:40%;left:50%; background-color: #333; border-radius: 30px; padding: 10px; color:#fff; z-index: 1054;">Please Wait....</div>
							<h4 style="padding-left: 10px; padding-right: 10px;" class="text-center">"<?php echo get_the_content($registry_id) ?>"</h4>
							<div class="card" >
							  <div class="card-body">
							    <p class="card-text text-purple">You are viewing <strong><?php echo get_the_title($registry_id) ?> </strong></p>
							     <p class="card-text text-green">Please Note:<br> Items with <b>Five Stars</b> are High priority items to the celebrant.<br> Items with <b>Three Stars</b> are average priority items. <br>Items with <b>One Star</b> are Low priority items.</p>
							  </div>
							</div>
						</div>
						<div class="col-md-12">
						<?php
						
						
							$products = loadProductsByRegistryID($registry_id); 
							
							if( !empty($products) ){
							 
							
                            $pkey = get_option('sirl_pkey');
                            $pkey_test = get_option('sirl_test_pkey');
                            $pkey = (get_option('sirl_activate_live_keys') == 'on' )?$pkey:$pkey_test;
                            $index = 0;
							foreach($products as $product ){ 
								$product_data = wc_get_product($product->ID);
								$image = $product_data->get_image();
								$product_details = $product_data->get_data();
								
								
								
								
								if ( ('crowding' == $product_data->get_type() ) || (is_group_gift($registry_id, $product->ID) == true ) ) {  
								
								    $crowding_flag = 1;
                                    $price  = get_post_meta( $product->ID, 'crowding_product_info', true);
                                    $curr_price = fetch_crowdsourcing_curr_price($registry_id, $product->ID);
                                    
                                    $price = $price - $curr_price;
                                    
                                    if( is_group_gift($registry_id, $product->ID) == true  ){
                                        $price  = $product_data->get_price();
                                        $curr_price = fetch_crowdsourcing_curr_price($registry_id, $product->ID);
                                    
                                        $price = $price - $curr_price;
                                        $group_gift_flag = 1;
                                    }
                                    ?>
                                        <div class="card shadow-sm ml-3 mr-3 mb-3 d-inline-block" style="width:26rem">
        								  <!--<img class="card-img-top" src="<?php //echo $image[0] ?>" alt="Card image cap">-->
        								  <?php printf($image); ?>
        								  <div class="card-body">
        								    <h5 class="card-title" data-toggle="modal" data-target="#productModal<?php echo $product->ID ?>" style="cursor: pointer"><?php echo $product->post_title; ?></h5>
        								    <h6 class="card-text font-red">Target: <?php echo '₦'.number_format($price,2) ?></h6>
        								  
            								    <p class="priority-stars"><?php if( fetch_giftregistry_data($registry_id, $product->ID, 'priority') == 3 ){ ?>
            								    <i data-feather="star"></i><i data-feather="star"></i><i data-feather="star"></i><i data-feather="star"></i><i data-feather="star"></i>
            								    	<?php }else if( fetch_giftregistry_data($registry_id, $product->ID, 'priority') == 2 ){ ?>
            								    	<i data-feather="star"></i><i data-feather="star"></i><i data-feather="star"></i>
            								    	<?php }else{ ?>
            								    		<i data-feather="star"></i>
            								    		<?php } ?>
            								    	</p>
            								    	<?php  if( is_group_gift($registry_id, $product->ID) == true  ){ ?>
            								    	    <p class="text-muted">This is a group gift...please enter the amount you want to contribute.</p>
            								    	<?php } ?>
            								    <?php if(fetch_giftregistry_data($registry_id, $product->ID, 'qty') == fetch_product_status($registry_id, $product->ID) ) { ?>
            								    		<p><input type="number" style="width: 11.1rem" value="1" id="qty<?php echo $product->ID ?>" min='1000' max="<?php echo fetch_giftregistry_data($registry_id, $product->ID, 'qty') ?>" disabled ><a title="All done"  class="button bought">Contribute</a></p>
            								    	<?php }else{ ?>
            								     <p><input type="number" style="width: 11.1rem" value="1000" step="1000" id="amtDonated<?php echo $product->ID ?>" min='1000'><a class="button "  data-toggle="modal" data-target="#modalBeforePaymentModal<?php echo $product->ID ?>" data-crowding='1'>Contribute</a></p>
            								     <?php } ?>
            								    <p><span class="text-purple">Paid:</span> <?php echo '₦'. number_format(fetch_crowdsourcing_curr_price($registry_id, $product->ID), 2 ) ?>&nbsp;&nbsp; | &nbsp;&nbsp;<span class="text-primary">Left: </span><?php echo '₦'. number_format($price, 2) ?></p>
            
            								    <p><small class="text-muted" id="AddErrorSuccessMessage<?php echo $product->ID ?>"></small></p>
        								    <?php 
        								    
        								     ?>
        								  </div>
        								</div>
                                    
                                    <?php
								}else{ 
								$price = $product_data->get_price();
								$crowding_flag = 0;
								echo '<script>var crowdingFlag = 0; </script>';
								?>
								<div class="card shadow-sm ml-3 mr-3 mb-3 d-inline-block bought" style="width:26rem">
								  <!--<img class="card-img-top" src="<?php //echo $image[0] ?>" alt="Card image cap">-->
								  <?php printf($image); ?>
								  <div class="card-body">
								    <h5 class="card-title" data-toggle="modal" data-target="#productModal<?php echo $product->ID ?>" style="cursor: pointer"><?php echo $product->post_title; ?></h5>
								    <h6 class="card-text font-red"><?php echo $product_data->get_price_html(); ?></h6>
								    
								    <p class="priority-stars"><?php if( fetch_giftregistry_data($registry_id, $product->ID, 'priority') == 3 ){ ?>
								    <i data-feather="star"></i><i data-feather="star"></i><i data-feather="star"></i><i data-feather="star"></i><i data-feather="star"></i>
								    	<?php }else if( fetch_giftregistry_data($registry_id, $product->ID, 'priority') == 2 ){ ?>
								    	<i data-feather="star"></i><i data-feather="star"></i><i data-feather="star"></i>
								    	<?php }else{ ?>
								    		<i data-feather="star"></i>
								    		<?php } ?>
								    	</p>
								    <?php if(fetch_giftregistry_data($registry_id, $product->ID, 'qty') == fetch_product_status($registry_id, $product->ID) ) { ?>
								    		<p><input type="number" style="width: 11.1rem" value="1" id="qty<?php echo $product->ID ?>" min='1' max="<?php echo fetch_giftregistry_data($registry_id, $product->ID, 'qty') ?>" disabled ><a title="Already Bought"  class="button bought">Buy Gift</a></p>
								    	<?php }else{ ?>
								     <p><input type="number" style="width: 11.1rem" value="1" id="qty<?php echo $product->ID ?>"  min='1' max="<?php echo fetch_giftregistry_data($registry_id, $product->ID, 'qty') ?>" ><a class="button " data-crowding='0'  data-toggle="modal" data-target="#modalBeforePaymentModal<?php echo $product->ID ?>">Buy Gift</a></p>
								     <?php } ?>
								    <p><span class="text-purple">Desired Quantity:</span> <?php echo fetch_giftregistry_data($registry_id, $product->ID, 'qty') ?> &nbsp;&nbsp;|&nbsp;&nbsp; <span class="text-danger">Purchased: </span><?php echo !empty(fetch_product_status($registry_id, $product->ID) )?fetch_product_status($registry_id, $product->ID):0; ?></p>

								    <p><small class="text-muted" id="AddErrorSuccessMessage<?php echo $product->ID ?>"></small></p>
								     
								  </div>
								</div>
						    <? } 
						        
						    
						    ?>					<!-- Modal -->
								<div class="modal fade" id="productModal<?php echo $product->ID ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								  <div class="modal-dialog modal-dialog-centered" role="document">
								    <div class="modal-content">
								      
								      <div class="modal-body">
								        <div class="card mb-3 ml-2 mr-2" >
										  <div class="row">
										    <div class="col-md-5">
										       <?php printf($image); ?>
										    </div>
										    <div class="col-md-7">
										      <div class="card-body">
										        <h5 class="card-title"><?php echo $product->post_title ?></h5>
										        <p class="card-text"><?php echo $product_data->get_price_html(); ?></p>
										        <p class="card-text text-justify"><?php echo $product_details['short_description']; ?></p>
										      </div>
										    </div>
										  </div>
										</div>
								      </div>
								    </div>
								  </div>
								</div>
								
												<!-- Modal -->
								
    							<div class="modal" tabindex="-1" role="dialog" id="modalBeforePaymentModal<?php echo $product->ID ?>">
                                      <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title">Pay for <?php echo get_the_title($product->ID) ?></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>
                                          <div class="modal-body">
										  
										        <h6>Hello, thank you for making this purchase. <br>Please, fill in your details below to complete this transaction</h6>
										        <div class="form-group">
										            <label for="firstname">First Name <span style="color:red">*</span></label>
										            <input type ="text" class="form-control bigheight" id="firstname<?php echo $product->ID ?>" placeholder="Please enter first name">
										             <span id="firstnameErrorMessage<?php echo $product->ID ?>"></span>
										        </div>
										        <div class="form-group">
										            <label for="lastname">Last Name <span style="color:red">*</span></label>
										            <input type="text" class="form-control bigheight" id="lastname<?php echo $product->ID ?>" placeholder="Please enter last name">
										             <span id="lastnameErrorMessage<?php echo $product->ID ?>"></span>
										        </div>
										        <div class="form-group">
										            <label for="email">Email Address <span style="color:red">*</span></label>
										            <input type="email" class="form-control bigheight" id="email<?php echo $product->ID ?>" placeholder="Please enter Email Address">
										            <span id="emailErrorMessage<?php echo $product->ID ?>"></span>
										        </div>
										        <div class="form-group">
										            <label for="phone">Phone Number <span style="color:red">*</span></label>
										            <input type="phone" class="form-control bigheight" id="phone<?php echo $product->ID ?>" placeholder="Please enter Phone Number">
										             <span id="phoneErrorMessage<?php echo $product->ID ?>"></span>
										        </div>
										        <div class="form-group">
										            <label for="message">Message for the celebrant</label>
										            <textarea class="form-control bigheightBigText" rows="5" id="message<?php echo $product->ID ?>" placeholder="You can leave a message here for the Celebrant."></textarea>
										        </div>
										        <div class="form-group">
										          <div class="form-check">
                                                      <input class="form-check-input" type="checkbox" value="" id="annonymousCheck<?php echo $product->ID ?>">
                                                      <label class="form-check-label" for="defaultCheck1">
                                                        &nbsp; Make me Anonymous
                                                    </div>
										        </div>
										  </div>
										  
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-alternative" data-dismiss="modal">Close</button>
                                        <button type="button" data-group_gift_flag="<?php echo isset($group_gift_flag)?$group_gift_flag:0 ?>" class="btn btn-alternative buyProductForRegistry" data-id="<?php echo $product->ID ?>" data-registry="<?php echo $registry_id ?>" id="buyProductForRegistry<?php echo $product->ID ?>" data-paystack="<?php echo $pkey ?>" data-price="<?php echo $price ?>" data-crowding="<?php echo $crowding_flag ?>">Make Payment</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                
					<?php	}
						}else{
						    
						}
				
					if( get_post_meta($registry_id, 'cash_gift_yes_or_no', true) == 'yes' ){ 
					    $amt_paid = fetch_cash_gift_amt_paid($registry_id);
					     $pkey = get_option('sirl_pkey');
                        $pkey_test = get_option('sirl_test_pkey');
                        $pkey = (get_option('sirl_activate_live_keys') == 'on' )?$pkey:$pkey_test;
					?>
						        
						         <div class="card shadow-sm ml-3 mr-3 mb-3 d-inline-block" style="width:26rem">
        								  <img class="card-img-top" src="https://silvercastle.co/wp-content/uploads/2019/07/gift_inside_cash-512.png" alt="Card image cap">
        								  <?php //printf($image); ?>
        								  <div class="card-body">
        								    <h5 class="card-title" >Cash Gift</h5>
        								    <h6 class="card-text font-red">&nbsp;</h6>
            								
            								<p class="text-muted">This is a cash gift...please enter the amount you want to contribute.</p>
            								
            								<p><input type="number" style="width: 11.1rem" value="1000" step="1000" id="amtDonatedCashgift" min='1000'><a class="button "  data-toggle="modal" data-target="#modalBeforePaymentModalCashgift" data-crowding='1'>Contribute</a></p>
            								  
            								<p><span class="text-purple">Paid:</span> <?php echo '₦'. number_format($amt_paid, 2 ) ?>&nbsp;&nbsp; </p>
            
            								    <p><small class="text-muted" id="CashGiftErrorSuccessMessage>"></small></p>
        								    <?php 
        								    
        								     ?>
        								  </div>
        								</div>
        								<div class="modal" tabindex="-1" role="dialog" id="modalBeforePaymentModalCashgift">
                                      <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title">Cash Gift</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>
                                          <div class="modal-body">
										  
										        <h6>Hello, thank you for making this purchase. <br>Please, fill in your details below to complete this transaction</h6>
										        <div class="form-group">
										            <label for="firstname">First Name <span style="color:red">*</span></label>
										            <input type ="text" class="form-control bigheight" id="firstname_cashgift" placeholder="Please enter first name">
										             <span id="firstnameErrorMessage_cashgift"></span>
										        </div>
										        <div class="form-group">
										            <label for="lastname">Last Name <span style="color:red">*</span></label>
										            <input type="text" class="form-control bigheight" id="lastname_cashgift" placeholder="Please enter last name">
										             <span id="lastnameErrorMessage_cashgift"></span>
										        </div>
										        <div class="form-group">
										            <label for="email">Email Address <span style="color:red">*</span></label>
										            <input type="email" class="form-control bigheight" id="email_cashgift" placeholder="Please enter Email Address">
										            <span id="emailErrorMessage_cashgift"></span>
										        </div>
										        <div class="form-group">
										            <label for="phone">Phone Number <span style="color:red">*</span></label>
										            <input type="phone" class="form-control bigheight" id="phone_cashgift" placeholder="Please enter Phone Number">
										             <span id="phoneErrorMessage_cashgift"></span>
										        </div>
										        <div class="form-group">
										            <label for="message">Message for the celebrant</label>
										            <textarea class="form-control bigheightBigText" rows="5" id="message_cashgift" placeholder="You can leave a message here for the Celebrant."></textarea>
										        </div>
										        <div class="form-group">
										          <div class="form-check">
                                                      <input class="form-check-input" type="checkbox" value="" id="annonymousCheck_cashgift">
                                                      <label class="form-check-label" for="defaultCheck1">
                                                        &nbsp; Make me Anonymous
                                                    </div>
										        </div>
										  </div>
										  
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-alternative" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-alternative cashGiftForRegistry" data-registry="<?php echo $registry_id ?>"  data-paystack="<?php echo $pkey ?>">Make Payment</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
        								<?php }
					
					?>
						</div>
						
					</div>
			</div>
						<?php
						}else{
						$pkey_test = get_option('sirl_test_pkey');
						$pkey = (get_option('sirl_activate_live_keys') == 'on' )?$pkey:$pkey_test;    
						echo '<div class="spinner" style="position:fixed;top:40%;left:50%; background-color: #333; border-radius: 30px; padding: 10px; color:#fff; z-index: 1054;">Please Wait....</div>';
						echo '<div class="row " id="password_area">
                					<div class="container">
                						<div class="col-md-12 mb-3 ml-3 mr-3 mt-4 mb-5">
                						<h4>This Registry is Password-protected.</h4><h6> Kindly use the password given by the Registry owner.</h6>';
    					    echo '<div class="form-group">
										            <label for="password">Password</label>
										            <input type="password" class="form-control bigheight" id="password" >
										            <small id="passwordErrorField"></small>
										        </div>
										        
								    <div class="form-group">
								        <input type="button" class="btn btn-alternative" value="Submit" id="btnCheckPassword" data-registry="'.$registry_id.'">
								    </div>
							    ';
							    echo '</div></div></div>';
							    
							    ?>
							    	<div class="row d-none" id="registry_box">
					<div class="container">
						<div class="col-md-12 mb-3 ml-3 mr-3 mt-4 mb-5">
						<div class="spinner" style="position:fixed;top:40%;left:50%; background-color: #333; border-radius: 30px; padding: 10px; color:#fff; z-index: 1054;">Please Wait....</div>
							<h4 style="padding-left: 10px; padding-right: 10px;" class="text-center">"<?php echo get_the_content($registry_id) ?>"</h4>
							<div class="card" >
							  <div class="card-body">
							    <p class="card-text text-purple">You are viewing <strong><?php echo get_the_title($registry_id) ?> </strong></p>
							     <p class="card-text text-green">Please Note:<br> Items with <b>Five Stars</b> are high priority items to the celebrant.<br> Items with <b>Three Stars</b> are average priority items. <br>Items with <b>One Star</b> are low priority items.</p>
							  </div>
							</div>
						</div>
						<div class="col-md-12">
						    <?php
						    		if( get_post_meta($registry_id, 'cash_gift_yes_or_no', true) == 'yes' ){ 
					                $amt_paid = fetch_cash_gift_amt_paid($registry_id);
					                $pkey = get_option('sirl_pkey');
                                    $pkey_test = get_option('sirl_test_pkey');
                                    $pkey = (get_option('sirl_activate_live_keys') == 'on' )?$pkey:$pkey_test;
                                    ?>
                            <div class="card shadow-sm ml-3 mr-3 mb-3 d-inline-block" style="width:26rem">
        								  <img class="card-img-top" src="https://silvercastle.co/wp-content/uploads/2019/07/gift_inside_cash-512.png" alt="Card image cap">
        								  <?php //printf($image); ?>
        								  <div class="card-body">
        								    <h5 class="card-title" >Cash Gift</h5>
        								    <h6 class="card-text font-red">&nbsp;</h6>
            								
            								<p class="text-muted">This is a cash gift...please enter the amount you want to contribute.</p>
            								
            								<p><input type="number" style="width: 11.1rem" value="1000" step="1000" id="amtDonatedCashgift" min='1000'><a class="button "  data-toggle="modal" data-target="#modalBeforePaymentModalCashgift" data-crowding='1'>Contribute</a></p>
            								  
            								<p><span class="text-purple">Paid:</span> <?php echo '₦'. number_format($amt_paid, 2 ) ?>&nbsp;&nbsp; </p>
            
            								    <p><small class="text-muted" id="CashGiftErrorSuccessMessage>"></small></p>
        								    <?php 
        								    
        								     ?>
        								  </div>
        								</div>
        								<div class="modal" tabindex="-1" role="dialog" id="modalBeforePaymentModalCashgift">
                                      <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title">Cash Gift</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>
                                          <div class="modal-body">
										  
										        <h6>Hello, thank you for making this purchase. <br>Please, fill in your details below to complete this transaction</h6>
										        <div class="form-group">
										            <label for="firstname">First Name <span style="color:red">*</span></label>
										            <input type ="text" class="form-control bigheight" id="firstname_cashgift" placeholder="Please enter first name">
										             <span id="firstnameErrorMessage_cashgift"></span>
										        </div>
										        <div class="form-group">
										            <label for="lastname">Last Name <span style="color:red">*</span></label>
										            <input type="text" class="form-control bigheight" id="lastname_cashgift" placeholder="Please enter last name">
										             <span id="lastnameErrorMessage_cashgift"></span>
										        </div>
										        <div class="form-group">
										            <label for="email">Email Address <span style="color:red">*</span></label>
										            <input type="email" class="form-control bigheight" id="email_cashgift" placeholder="Please enter Email Address">
										            <span id="emailErrorMessage_cashgift"></span>
										        </div>
										        <div class="form-group">
										            <label for="phone">Phone Number <span style="color:red">*</span></label>
										            <input type="phone" class="form-control bigheight" id="phone_cashgift" placeholder="Please enter Phone Number">
										             <span id="phoneErrorMessage_cashgift"></span>
										        </div>
										        <div class="form-group">
										            <label for="message">Message for the celebrant</label>
										            <textarea class="form-control bigheightBigText" rows="5" id="message_cashgift" placeholder="You can leave a message here for the Celebrant."></textarea>
										        </div>
										        <div class="form-group">
										          <div class="form-check">
                                                      <input class="form-check-input" type="checkbox" value="" id="annonymousCheck_cashgift">
                                                      <label class="form-check-label" for="defaultCheck1">
                                                        &nbsp; Make me Anonymous
                                                    </div>
										        </div>
										  </div>
										  
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-alternative" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-alternative cashGiftForRegistry" data-registry="<?php echo $registry_id ?>"  data-paystack="<?php echo $pkey ?>">Make Payment</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                
						<?php }
						
						
							$products = loadProductsByRegistryID($registry_id); 
                            
							foreach($products as $product ){ 
								$product_data = wc_get_product($product->ID);
								$image = $product_data->get_image();
								$product_details = $product_data->get_data();
							
									if ( ('crowding' == $product_data->get_type() ) || (is_group_gift($registry_id, $product->ID) == true ) ) {  
								
								    $crowding_flag = 1;
                                    $price  = get_post_meta( $product->ID, 'crowding_product_info', true);
                                    $curr_price = fetch_crowdsourcing_curr_price($registry_id, $product->ID);
                                    //print_r($curr_price);
                                    $price = $price - $curr_price;
                                    //echo '<script>var crowdingFlag = 1; </script>';
                                    if( is_group_gift($registry_id, $product->ID) == true  ){
                                        $price  = $product_data->get_price();
                                        $curr_price = fetch_crowdsourcing_curr_price($registry_id, $product->ID);
                                        //print_r($curr_price);
                                        $price = $price - $curr_price;
                                        $group_gift_flag = 1;
                                    }
                                    ?>
                                        <div class="card shadow-sm ml-3 mr-3 mb-3 d-inline-block" style="width:26rem">
        								  <!--<img class="card-img-top" src="<?php //echo $image[0] ?>" alt="Card image cap">-->
        								  <?php printf($image); ?>
        								  <div class="card-body">
        								    <h5 class="card-title" data-toggle="modal" data-target="#productModal<?php echo $product->ID ?>" style="cursor: pointer"><?php echo $product->post_title; ?></h5>
        								    <h6 class="card-text font-red">Target: <?php echo '₦'.number_format($price,2) ?></h6>
        								  
            								    <p class="priority-stars"><?php if( fetch_giftregistry_data($registry_id, $product->ID, 'priority') == 3 ){ ?>
            								    <i data-feather="star"></i><i data-feather="star"></i><i data-feather="star"></i><i data-feather="star"></i><i data-feather="star"></i>
            								    	<?php }else if( fetch_giftregistry_data($registry_id, $product->ID, 'priority') == 2 ){ ?>
            								    	<i data-feather="star"></i><i data-feather="star"></i><i data-feather="star"></i>
            								    	<?php }else{ ?>
            								    		<i data-feather="star"></i>
            								    		<?php } ?>
            								    	</p>
            								    	<?php  if( is_group_gift($registry_id, $product->ID) == true  ){ ?>
            								    	    <p class="text-muted">This is a group gift...please enter the amount you want to contribute.</p>
            								    	<?php } ?>
            								    <?php if(fetch_giftregistry_data($registry_id, $product->ID, 'qty') == fetch_product_status($registry_id, $product->ID) ) { ?>
            								    		<p><input type="number" style="width: 11.1rem" value="1" id="qty<?php echo $product->ID ?>" min='1000' max="<?php echo fetch_giftregistry_data($registry_id, $product->ID, 'qty') ?>" disabled ><a title="All done"  class="button bought">Contribute</a></p>
            								    	<?php }else{ ?>
            								     <p><input type="number" style="width: 11.1rem" value="1000" step="1000" id="amtDonated<?php echo $product->ID ?>" min='1000'><a class="button "  data-toggle="modal" data-target="#modalBeforePaymentModal<?php echo $product->ID ?>" data-crowding='1'>Contribute</a></p>
            								     <?php } ?>
            								    <p><span class="text-purple">Paid:</span> <?php echo '₦'. number_format(fetch_crowdsourcing_curr_price($registry_id, $product->ID), 2 ) ?>&nbsp;&nbsp; | &nbsp;&nbsp;<span class="text-primary">Left: </span><?php echo '₦'. number_format($price, 2) ?></p>
            
            								    <p><small class="text-muted" id="AddErrorSuccessMessage<?php echo $product->ID ?>"></small></p>
        								    <?php 
        								    
        								     ?>
        								  </div>
        								</div>
                                    
                                    <?php
								}else{ 
								$price = $product_data->get_price();
								$crowding_flag = 0;
								echo '<script>var crowdingFlag = 0; </script>';
								?>
								<div class="card shadow-sm ml-3 mr-3 mb-3 d-inline-block bought" style="width:26rem">
								  <!--<img class="card-img-top" src="<?php //echo $image[0] ?>" alt="Card image cap">-->
								  <?php printf($image); ?>
								  <div class="card-body">
								    <h5 class="card-title" data-toggle="modal" data-target="#productModal<?php echo $product->ID ?>" style="cursor: pointer"><?php echo $product->post_title; ?></h5>
								    <h6 class="card-text font-red"><?php echo $product_data->get_price_html(); ?></h6>
								    
								    <p class="priority-stars"><?php if( fetch_giftregistry_data($registry_id, $product->ID, 'priority') == 3 ){ ?>
								    <i data-feather="star"></i><i data-feather="star"></i><i data-feather="star"></i><i data-feather="star"></i><i data-feather="star"></i>
								    	<?php }else if( fetch_giftregistry_data($registry_id, $product->ID, 'priority') == 2 ){ ?>
								    	<i data-feather="star"></i><i data-feather="star"></i><i data-feather="star"></i>
								    	<?php }else{ ?>
								    		<i data-feather="star"></i>
								    		<?php } ?>
								    	</p>
								    <?php if(fetch_giftregistry_data($registry_id, $product->ID, 'qty') == fetch_product_status($registry_id, $product->ID) ) { ?>
								    		<p><input type="number" style="width: 11.1rem" value="1" id="qty<?php echo $product->ID ?>" min='1' max="<?php echo fetch_giftregistry_data($registry_id, $product->ID, 'qty') ?>" disabled ><a title="Already Bought"  class="button bought">Buy Gift</a></p>
								    	<?php }else{ ?>
								     <p><input type="number" style="width: 11.1rem" value="1" id="qty<?php echo $product->ID ?>"  min='1' max="<?php echo fetch_giftregistry_data($registry_id, $product->ID, 'qty') ?>" ><a class="button " data-crowding='0'  data-toggle="modal" data-target="#modalBeforePaymentModal<?php echo $product->ID ?>">Buy Gift</a></p>
								     <?php } ?>
								    <p><span class="text-purple">Desired Quantity:</span> <?php echo fetch_giftregistry_data($registry_id, $product->ID, 'qty') ?> &nbsp;&nbsp;|&nbsp;&nbsp; <span class="text-danger">Purchased: </span><?php echo fetch_product_status($registry_id, $product->ID) ?></p>

								    <p><small class="text-muted" id="AddErrorSuccessMessage<?php echo $product->ID ?>"></small></p>
								     
								  </div>
								</div>
						    <?php } ?>
												<!-- Modal -->
								
    							<div class="modal" tabindex="-1" role="dialog" id="modalBeforePaymentModal<?php echo $product->ID ?>">
                                      <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title">Pay for <?php echo get_the_title($product->ID) ?></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>
                                          <div class="modal-body">
										  
										        <h6>Hello, thank you for making this purchase. <br>Please, fill in your details below to complete this transaction</h6>
										        <div class="form-group">
										            <label for="firstname">First Name <span style="color:red">*</span></label>
										            <input type ="text" class="form-control bigheight" id="firstname<?php echo $product->ID ?>" placeholder="Please enter first name">
										             <span id="firstnameErrorMessage<?php echo $product->ID ?>"></span>
										        </div>
										        <div class="form-group">
										            <label for="lastname">Last Name <span style="color:red">*</span></label>
										            <input type="text" class="form-control bigheight" id="lastname<?php echo $product->ID ?>" placeholder="Please enter last name">
										             <span id="lastnameErrorMessage<?php echo $product->ID ?>"></span>
										        </div>
										        <div class="form-group">
										            <label for="email">Email Address <span style="color:red">*</span></label>
										            <input type="email" class="form-control bigheight" id="email<?php echo $product->ID ?>" placeholder="Please enter Email Address">
										            <span id="emailErrorMessage<?php echo $product->ID ?>"></span>
										        </div>
										        <div class="form-group">
										            <label for="phone">Phone Number <span style="color:red">*</span></label>
										            <input type="phone" class="form-control bigheight" id="phone<?php echo $product->ID ?>" placeholder="Please enter Phone Number">
										             <span id="phoneErrorMessage<?php echo $product->ID ?>"></span>
										        </div>
										        <div class="form-group">
										            <label for="message">Message for the celebrant</label>
										            <textarea class="form-control bigheightBigText" rows="5" id="message<?php echo $product->ID ?>" placeholder="You can leave a message here for the Celebrant."></textarea>
										        </div>
										        <div class="form-group">
										          <div class="form-check">
                                                      <input class="form-check-input" type="checkbox" value="" id="annonymousCheck<?php echo $product->ID ?>">
                                                      <label class="form-check-label" for="defaultCheck1">
                                                        &nbsp; Make me Anonymous
                                                    </div>
										        </div>
										  </div>
										  
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-alternative" data-dismiss="modal">Close</button>
                                        <button type="button" data-group_gift_flag="<?php echo isset($group_gift_flag)?$group_gift_flag:0 ?>" class="btn btn-alternative buyProductForRegistry" data-id="<?php echo $product->ID ?>" data-registry="<?php echo $registry_id ?>" id="buyProductForRegistry<?php echo $product->ID ?>" data-paystack="<?php echo $pkey ?>" data-price="<?php echo $price ?>" data-crowding="<?php echo $crowding_flag ?>">Make Payment</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
							    
							    <?php
							}
							echo '</div></div></div>';
						}
		}
	}
	add_shortcode('dbt_giftregistry', 'dbt_giftregistry');

	function find_registry_widget(){
		?>
			<!--<h5>Find Using Registry Title</h5>-->
			<div class="row mb-5">
	       <div class="col-md-12 text-center" style="font-size:13px">
	            <p>Hey there, looking for a Registry?<br>
	            Start by entering the <strong>Registry Title</strong> given to you by the Registry owner in the field below</p>
		    </div>
            </div>
			<div class="row">
				<div class="form-group d-inline-block col-12">
					<label class="col-form-label col-md-3 col-lg-3 col-sm-12 d-inline-block" style="font-size: 1.5em;text-align:center" for="registry_title">Registry Title</label>
                    <div class="col-lg-6 col-md-6 col-sm-12 d-inline-block">
					<input type="text" id="registry_title" class="bigheight form-control" style="height:55px">
					<small id="registry_titleErrorMessage"></small>
                    </div>
                     <div class="col-lg-3 col-md-3 col-sm-12 d-inline-block">
                        <input type="button" class="btn btn-alternative find_a_coupleBtn border-0 form-control" style="height:5.5rem" id="" value="Find A Registry">
                    </div>
				</div>
			  
			</div>
			
			
		<?php
	}
	add_shortcode('find_registry_widget', 'find_registry_widget');
	
	function widget_find_a_couple(){
	    $couple = get_query_var('mypage');
	    ?>
	    <div class="row mb-5">
	       <div class="col-md-12 text-center" style="font-size:13px">
	            <p>Hey there, looking for a Registry?<br>
	            Start by entering the <strong>Registry Title</strong> given to you by the Registry owner in the field below</p>
		    </div>
        </div>
        <!--<h5>Find Using Registry Title</h5>-->
		<div class="row mb-5">
			<div class="col-md-9">
				
				<input type="text" id="registry_title" style="height:55px;width:100%" placeholder="Enter Registry Title">
				<small id="registry_titleErrorMessage"></small>
			</div>
			<!--<h5>Or Registrant Full Name</h5>
			<div class="form-group d-inline-block col-6">
				<label for="registrant_fullname" class="col-12">Or Registrant's Fullname</label>
				<input type="text" id="registrant_fullname" class="form-group col-12">
				<small id="registry_fullnameErrorMessage"></small>
			</div>-->
		
			<div class="col-md-3" >
			    
				<input type="button" class="btn btn-alternative find_a_coupleBtn" id="" value="Find A Registry" style="width:100%">
			</div>
		</div>
	    <?php
	    if(!empty($couple) ){
	        $search_term  = str_replace('-', ' ',  $couple);
	        echo '<h3>You searched for '.ucfirst($search_term).'</h3>';
	        $registries = findCoupleRegistryUsingRegistryTitle($search_term);
	        echo '<p class="text-muted">Search results: ('.count($registries).')</p>';
	        
	        foreach($registries as $registry ){ 
	            	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $registry->ID ) );
	            	//echo 'privacy'. get_post_meta($registry->id, 'registry_privacy',true);
	            	if(get_post_meta($registry->ID, 'registry_privacy',true) == 'private' ){
	            	    echo '<h5>This Registry is Private.</h5>';
	            	}else{
	        ?>
	            <div class="card mb-3 ml-2 mr-2 col-md-5" >
							  <div class="row no-gutters">
							    <div class="col-md-4">
							      <img src="<?php echo $image[0] ?>" class="card-img" alt="...">
							    </div>
							    <div class="col-md-8">
							      <div class="card-body">
							        <a href="<?php echo get_permalink($registry->ID) ?>"><h5 class="card-title"><?php echo $registry->post_title; ?></h5></a>
							        <p class="card-text"><?php echo substr($registry->post_content, 0, 26); ?>..</p>
							        <p class="card-text"><small class="text-muted"> Gifts: <?php echo count_my_registry_gifts($registry->ID) ?>  <br> Setting: <?php echo ucfirst(get_post_meta($registry->ID, 'registry_privacy', true) ) ?></small></p>
							      </div>
							    </div>
							  </div>
							</div>
	        <?php } }
	    }
	    
	}
	add_shortcode('widget_find_a_couple', 'widget_find_a_couple');
	
	function sirl_congratulations_page(){
	    if ( is_user_logged_in() ) {
				
				$current_user = wp_get_current_user();
		 		$username = $current_user->user_login;
		 		$user_id = $current_user->ID;
		 		$firstname = $current_user->first_name;
		 		$lastname = $current_user->last_name;
		 		
		 		?>
		 		<div class="col-md-4 offset-md-4">
		 		<h2 style="text-align:center;color:#800080">Hello <?php echo get_user_meta($user_id, 'billing_first_name', true) ?>,</h2>
		 		<h5 style="text-align:center">You've signed up successfully and we're so excited to have you on board. </h5>

                <h5 style="text-align:center">Here's to a most delightful experience...</h5>
                
                <div class="text-center"><a  href="<?php echo home_url() ?>/registry/new-registry" class="btn btn-alternative">Click here to start your registry</a></div>
		 		</div>
		 		<?php
			 	
		}	
	}
	add_shortcode('sirl_congratulations_page', 'sirl_congratulations_page');
	
	
	function sirl_feedback_form_widget($admin_email){
	    ?>
	        <div class="row">
	            <div class="col-md-12">
	                <label for="feedback_type">Feedback Type <span class="text-danger">*</span></label>
	                <select id="feedback_type" class="form-control bigPadding">
	                    <option value="">Select a feedback type</option>
	                    <option value="bugs">Bug Reports</option>
	                    <option value="comments">Comments</option>
	                    <option value="questions">Questions</option>
	                </select>
	                <small class="text-mute feedback_typeErr"></small>
	            </div>
	            <div class="col-md-12">
	               <label for="feedback_type">Describe Feedback <span class="text-danger">*</span></label>
	               <textarea class="form-control bigheight" id="feedback" rows="5"></textarea>
	               <small class="text-mute describefeedbackErr"></small>
	            </div>
	            <div class="col-md-6">
	                <label for="feedback_firstname">First Name</label>
	                <input type="text" class="form-control bigheight" id="firstname" placeholder="Enter Firstname">
	                <small class="text-mute firstnameErr"></small>
	            </div>
	            <div class="col-md-6">
	                <label for="feedback_lastname">Last Name</label>
	                <input type="text" class="form-control bigheight" id="lastname" placeholder="Enter Lastname">
	                <small class="text-mute lastnameErr"></small>
	            </div>
	            <div class="col-md-12">
	                <label for="feedback_email">Email <span class="text-danger">*</span></label>
	                <input type="text" class="form-control bigheight" id="email" placeholder="Enter Email">
	                <small class="text-mute emailErr"></small>
	            </div>
	            <div class="col-md-12 mt-3">
	                <input type="button" class="btn btn-alternative submit-feedback" value="Submit">
	                <span id="feebackRes"></span>
	            </div>
	            <div class="spinner" style="position:fixed;top:40%;left:50%; background-color: #333; border-radius: 30px; padding: 10px; color:#fff; z-index: 1054;">Please Wait....</div>
	        </div>
	    
	    <?php
	}
    add_shortcode('sirl_feedback_form_widget','sirl_feedback_form_widget');	

    function sirl_admin_manager(){
         if( current_user_can('administrator') ){
            
        }else{
            
        }
        
    }
?>