<?php

	/*
	Plugin Name:  Silvercastle Gift Registry
	Plugin URI:   https://tflux.me/silvercastke/
	Description:  This might be my first suicide mission to crash land a project on Mars. The good news is that I have met the Martian and She is very beautiful. Like all beautiful people I meet, I trust God to keep us together.
	Version:      20190418
	Author:       Tobi Lekan Adeosun
	Author URI:   https://tflux.me/
	License:      GPL2
	License URI:  https://www.gnu.org/licenses/gpl-2.0.html
	Text Domain:  wporg
	Domain Path:  /languages
	*/

	//List of Items Needed.
	//1. Custom Post Type to hold the registry
	//2. Single Page for the Custom post type
	//3. insert_into_post for new registry tree page

	//A young man must seek his own path, away from home he must do this. Away from comfort. Away from friends. 
	//But not away from His God. That is His only guide. If He lose Sight of God, He will never find his own way.
	//Because God is Father of Heavenly Lights. The Life that knows no end. He is The Great King.
	//																			- The King. 18/04/2019. Lagos, Nigeria.

	//The Series of Raphsody written below this line was written unda the inspiration of God, The Great King. 
	//Bugzy, Aunty Banke, Koye, Ifeoluwa (World Renowned Poet), Uncle Wunmi, Ara, Aunty Altine, Prof, Mommy Prof..hehe. 
	//And My Brother Dgr (The Good King...hehe! I can't deny I have found a man with a heart of gold), I love you all. You're all beautiful people with the best of hearts.
	//And to Momma Tobi, Bro Abbey, Funmi and Pman...you guys made it all beautiful living.
	
	//And to Olamide, the weird one I rode with on the way to work, you made this evening a beautiful one and a little bit scary. I hope we can meet in person and have such great time. Cheers!
	//                                                                          - The King. May 24, 2019. Lagos, Nigeria.

	if ( ! function_exists('gift_registry') ) {

		// Register Custom Post Type
		function gift_registry() {

			$labels = array(
				'name'                  => _x( 'Gift Registries', 'Post Type General Name', 'text_domain' ),
				'singular_name'         => _x( 'Gift Registry', 'Post Type Singular Name', 'text_domain' ),
				'menu_name'             => __( 'Gift Registry', 'text_domain' ),
				'name_admin_bar'        => __( 'Gift Registry', 'text_domain' ),
				'archives'              => __( 'Gift Registry Archives', 'text_domain' ),
				'attributes'            => __( 'Gift Registry Attributes', 'text_domain' ),
				'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
				'all_items'             => __( 'All Gift Registries', 'text_domain' ),
				'add_new_item'          => __( 'Add Gift Registry', 'text_domain' ),
				'add_new'               => __( 'Add Gift Registry', 'text_domain' ),
				'new_item'              => __( 'New Gift Registry', 'text_domain' ),
				'edit_item'             => __( 'Edit Gift Registry', 'text_domain' ),
				'update_item'           => __( 'Update Gift Registry', 'text_domain' ),
				'view_item'             => __( 'View Gift Registry', 'text_domain' ),
				'view_items'            => __( 'View Gift Registries', 'text_domain' ),
				'search_items'          => __( 'Search Gift Registry', 'text_domain' ),
				'not_found'             => __( 'Not found', 'text_domain' ),
				'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
				'featured_image'        => __( 'Featured Image', 'text_domain' ),
				'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
				'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
				'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
				'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
				'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
				'items_list'            => __( 'Items list', 'text_domain' ),
				'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
				'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
			);
			$args = array(
				'label'                 => __( 'Gift Registry', 'text_domain' ),
				'description'           => __( 'Gift Registry was built to allow users create gift registry..stop asking me Jamb Question...rada rada', 'text_domain' ),
				'labels'                => $labels,
				'supports'              => array( 'title', 'editor', 'thumbnail', 'comments' ),
				'hierarchical'          => false,
				'public'                => true,
				'show_ui'               => true,
				'show_in_menu'          => true,
				'menu_position'         => 5,
				'menu_icon'             => 'dashicons-star-empty',
				'show_in_admin_bar'     => true,
				'show_in_nav_menus'     => true,
				'can_export'            => true,
				'has_archive'           => true,
				'exclude_from_search'   => false,
				'publicly_queryable'    => true,
				'capability_type'       => 'page',

			);
			register_post_type( 'gift_registry', $args );

		}
		add_action( 'init', 'gift_registry', 0 );

	}

	//Insert the shortcode into the page
	function dbt_create_registry_page(){
   		
		if( check_if_page_exists('registry' ) == false ){
	   		$post_details = array(
			  'post_title'    => 'Registry',
			  'post_content'  => '[dbt_registry]',
			  'post_status'   => 'publish',
			  'post_author'   => 1,
			  'post_type' => 'page'
		   );
	   		wp_insert_post( $post_details );
	   	}

	}
	register_activation_hook(__FILE__, 'dbt_create_registry_page');

	 function dbt_setup_constants() {
		if ( ! defined( 'DBT_VERSION' ) ) {
			define( 'DBT_VERSION', '1.0' );
		}
		if ( ! defined( 'DBT_PLUGIN_DIR' ) ) {
		define( 'DBT_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
		}
		if ( ! defined( 'DBT_PLUGIN_URL' ) ) {
		define( 'DBT_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
		}
	}
	dbt_setup_constants();
	
	
    function dbt_includes() { 
		
		require_once DBT_PLUGIN_DIR . 'functions.php';
		require_once DBT_PLUGIN_DIR . 'shortcodes.php';
		require_once DBT_PLUGIN_DIR . 'emails.php';
	}
	dbt_includes();

	//Rewrite Plugin
	function dbt_plugin_activate() {
        dbt_plugin_rules();
        flush_rewrite_rules();
    }

     function dbt_plugin_deactivate() {
      	flush_rewrite_rules();
     }
    
     function dbt_plugin_rules() {
      add_rewrite_rule('registry/?([^/]*)/?([^/]*)', 'index.php?pagename=registry&mypage=$matches[1]&npage=$matches[2]&nextpage=$matches[3]', 'top');
      add_rewrite_rule('find-a-registry/?([^/]*)/?([^/]*)', 'index.php?pagename=find-a-registry&mypage=$matches[1]&npage=$matches[2]&nextpage=$matches[3]', 'top');
      
     }
     
    //add rewrite rules in case another plugin flushes rules
     add_action('init', 'dbt_plugin_rules');

     function dbt_plugin_query_vars($vars) {
      $vars[] = 'mypage';
      $vars[] = 'npage';
      $vars[] = 'newpage';
      $vars[] = 'nextpage';
      return $vars;
     }
      //add plugin query vars (product_id) to wordpress
     add_filter('query_vars', 'dbt_plugin_query_vars');
     
     //register activation function
     register_activation_hook(__FILE__, 'dbt_plugin_activate');
     //register deactivation function
     register_deactivation_hook(__FILE__, 'dbt_plugin_deactivate');
    
 

     function sirl_smetrac_options_page(){
	    
		?>
	  <div>
	  
	  <h2>Paystack Settings</h2>
	  <form method="post" action="options.php" >
	  <?php settings_fields( 'sirlsmtrac_options_group' ); ?>
	  
	 
	  <table>
	    
	  <tr valign="top">
	  <th scope="row" width="30%"><label for="sirl_test_pkey">Public Key(Test)</label></th>
	  <td width="60%"><input type="text" id="sirl_test_pkey" name="sirl_test_pkey" value="<?php echo get_option('sirl_test_pkey'); ?>" /></td>
	  </tr>
	  <tr valign="top">
	  <th scope="row" width="30%"><label for="sirl_test_skey">Secret Key (Test) </label></th>
	  <td width="60%"><input type="text" id="sirl_test_skey" name="sirl_test_skey" value="<?php echo get_option('sirl_test_skey'); ?>" /></td>
	  </tr>
		<tr valign="top">
	  <th scope="row" width="30%"><label for="sirl_pkey">Public Key</label></th>
	  <td width="60%"><input type="text" id="sirl_pkey" name="sirl_pkey" value="<?php echo get_option('sirl_pkey'); ?>" /></td>
	  </tr>
	  <tr valign="top">
	  <th scope="row" width="30%"><label for="sirl_skey">Secret Key </label></th>
	  <td width="60%"><input type="text" id="sirl_skey" name="sirl_skey" value="<?php echo get_option('sirl_skey'); ?>" /></td>
	  </tr>
	   <tr valign="top">
	  <th scope="row" width="30%"><label for="sirl_test_pkey">Use live keys?</label></th>
	  <td width="60%">
	    <?php $checked =  (get_option('sirl_activate_live_keys') == 'on' )?'checked':''; ?>
	    <input type="checkbox" id="sirl_activate_live_keys" name="sirl_activate_live_keys" <?php echo $checked ?>/></td>
	  </tr>
	   <tr valign="top">
	  <th scope="row" width="30%"><label for="sirl_personal_message">Email Sharing Default Personal Message </label></th>
	  <td width="60%"><input type="text" id="sirl_personal_message" name="sirl_personal_message" value="<?php echo get_option('sirl_personal_message'); ?>" /></td>
	  </tr>
	  </table>
	  <?php  submit_button(); ?>
	  </form>
	  </div>
	<?php
	}
	function sirl_smetrac_register_options_page() {
  		add_options_page('Paystack Settings', 'Paystack Settings', 'manage_options', 'sirl_smetrac', 'sirl_smetrac_options_page');
	}
	add_action('admin_menu', 'sirl_smetrac_register_options_page');
    
    
    function sirl_smetrac_register_settings() {
	   add_option( 'sirl_test_pkey', '');
	   add_option( 'sirl_test_skey', '');
		add_option( 'sirl_pkey');
		add_option( 'sirl_skey', '');
		add_option( 'sirl_activate_live_keys', '' );
		add_option( 'sirl_personal_message', '' );
	   
	   
	       $args = array(
            'type' => 'number', 
            'sanitize_callback' => 'sanitize_text_field',
            'default' => NULL,
            );
           
	   
	   register_setting( 'sirlsmtrac_options_group', 'sirl_test_pkey' );
	   register_setting( 'sirlsmtrac_options_group', 'sirl_test_skey' );
       register_setting( 'sirlsmtrac_options_group', 'sirl_pkey');
	    register_setting( 'sirlsmtrac_options_group', 'sirl_skey');
	    register_setting( 'sirlsmtrac_options_group', 'sirl_activate_live_keys');
	    register_setting( 'sirlsmtrac_options_group', 'sirl_personal_message');
	    
	}
	add_action( 'admin_init', 'sirl_smetrac_register_settings' );
    
    
    add_action( 'woocommerce_loaded ', 'register_crowding_product_type' );
 
	function register_crowding_product_type() {
	 
	  class WC_Product_CROWDING extends WC_Product {
	             
	    public function __construct( $product ) {
	        $this->product_type = 'crowding';
	    parent::__construct( $product );
	    }
	  }
	}

	add_filter( 'product_type_selector', 'add_crowding_product_type' );
 
	function add_crowding_product_type( $types ){
	    $types[ 'crowding' ] = __( 'Crowd Sourcing', 'crowding_product' );
	 
	    return $types;  
	}

	
	add_filter( 'woocommerce_product_data_tabs', 'crowding_product_tab' );
	function crowding_product_tab( $tabs) {
	         
	    $tabs['demo'] = array(
	      'label'    => __( 'Crowd Sourcing', 'dm_product' ),
	      'target' => 'crowding_product_options',
	      'class'  => 'show_if_crowding_product',
	     );
	    return $tabs;
	}


	add_action( 'woocommerce_product_data_panels', 'crowding_product_tab_product_tab_content' );
 
	function crowding_product_tab_product_tab_content() {
	 
	 ?><div id='crowding_product_options' class='panel woocommerce_options_panel'><?php
	 ?><div class='options_group'><?php
	                 
	    woocommerce_wp_text_input(
	    array(
	      'id' => 'crowding_product_info',
	      'label' => __( 'Crowding Product Cost', 'dm_product' ),
	      'placeholder' => '',
	      'desc_tip' => 'true',
	      'description' => __( 'Enter Crowding product Cost.', 'dm_product' ),
	      'type' => 'text'
	    )
	    );
	 ?></div>
	 </div><?php
	}

	add_action( 'woocommerce_process_product_meta', 'save_crowding_product_settings' );
     
	function save_crowding_product_settings( $post_id ){
	         
	    $crowding_product_info = $_POST['crowding_product_info'];
	         
	    if( !empty( $crowding_product_info ) ) {
	 
	    update_post_meta( $post_id, 'crowding_product_info', esc_attr( $crowding_product_info ) );
	    }
	}
	
	
	if ( ! function_exists('feedbacks') ) {

    	// Register Custom Post Type
    	function feedbacks() {
    
    		$labels = array(
    			'name'                  => _x( 'Feedbacks', 'Post Type General Name', 'text_domain' ),
    			'singular_name'         => _x( 'Feedbacks', 'Post Type Singular Name', 'text_domain' ),
    			'menu_name'             => __( 'Feedbacks', 'text_domain' ),
    			'name_admin_bar'        => __( 'Feedbacks', 'text_domain' ),
    			'archives'              => __( 'Feedbacks', 'text_domain' ),
    			'attributes'            => __( 'Feedbacks Attributes', 'text_domain' ),
    			'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
    			'all_items'             => __( 'Feedbacks', 'text_domain' ),
    			'add_new_item'          => __( 'Add Feedback', 'text_domain' ),
    			'add_new'               => __( 'Add Feedback', 'text_domain' ),
    			'new_item'              => __( 'New Feedback', 'text_domain' ),
    			'edit_item'             => __( 'Edit Feedback', 'text_domain' ),
    			'update_item'           => __( 'Update Feedback', 'text_domain' ),
    			'view_item'             => __( 'View Feedback', 'text_domain' ),
    			'view_items'            => __( 'View Feedbacks', 'text_domain' ),
    			'search_items'          => __( 'Search Feedback', 'text_domain' ),
    			'not_found'             => __( 'Not found', 'text_domain' ),
    			'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
    			'featured_image'        => __( 'Featured Image', 'text_domain' ),
    			'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
    			'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
    			'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
    			'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
    			'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
    			'items_list'            => __( 'Items list', 'text_domain' ),
    			'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
    			'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
    		);
    		$args = array(
    			'label'                 => __( 'Feedbacks', 'text_domain' ),
    			'description'           => __( 'This is used to create an demo custom post type', 'text_domain' ),
    			'labels'                => $labels,
    			'supports'              => array( 'title','editor','thumbnail' ),
    			'hierarchical'          => false,
    			'public'                => true,
    			'show_ui'               => true,
    			'show_in_menu'          => true,
    			'menu_position'         => 5,
    			'menu_icon'             => 'dashicons-text-page',
    			'show_in_admin_bar'     => true,
    			'show_in_nav_menus'     => true,
    			'can_export'            => true,
    			'has_archive'           => true,
    			'exclude_from_search'   => false,
    			'publicly_queryable'    => true,
    			'capability_type'       => 'page',
    			'taxonomies'            => array('post_tag'),
    			'register_meta_box_cb' => 'feedbacks_metabox'
    		);
    		register_post_type( 'feedbacks', $args );
    
    	}
    	add_action( 'init', 'feedbacks', 0 );

    }
    
    function feedbacks_metabox() {
    	add_meta_box(
    		'feedbacks_metabox_id',
    		'Feedback Details',
    		'feedbacks_metabox_options'
    	);
    }

   	function feedbacks_metabox_options() {
	    global $post;
	    // Nonce field to validate form request came from current site
	    wp_nonce_field( basename( __FILE__ ), 'sirl_feedback_options_field' );
	    
	    // Get the location data if it's already been entered
	    $sirl_feedback_desc = get_post_meta( $post->ID, 'sirl_feedback_desc', true );
	    $sirl_feedback_firstname = get_post_meta( $post->ID, 'sirl_feedback_firstname', true );
	    $sirl_feedback_lastname = get_post_meta( $post->ID, 'sirl_feedback_lastname', true );
	    $sirl_feedback_email = get_post_meta( $post->ID, 'sirl_feedback_email', true );
	

	    // Output the field
	    echo '<label for="option_one">Description:</label><textarea name="sirl_demo_url" class="widefat" rows="2">' . esc_textarea( $sirl_feedback_desc )  . '</textarea>';
	    echo '<label for="option_one">Feedback Sender Firstname</label><textarea name="sirl_feedback_firstname" class="widefat" rows="1">' . esc_textarea( $sirl_feedback_firstname )  . '</textarea>';
	    echo '<label for="option_one">Feedback Sender Lastname</label><textarea name="sirl_feedback_lastname" class="widefat" rows="1">' . esc_textarea( $sirl_feedback_lastname )  . '</textarea>';
	    echo '<label for="option_one">Feedback Sender Email</label><textarea name="sirl_feedback_email" class="widefat" rows="1">' . esc_textarea( $sirl_feedback_email )  . '</textarea>';
	
	   
    }

     /**
 		* Save the metabox data
 	*/
	function feedbacks_save_meta( $post_id, $post ) {
		// Return if the user doesn't have edit permissions.
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}
		// Verify this came from the our screen and with proper authorization,
		// because save_post can be triggered at other times.

		if ( ! isset( $_POST['sirl_feedback_desc'] ) || !isset( $_POST['sirl_feedback_firstname'] ) || !isset( $_POST['sirl_feedback_lastname'] ) || !isset( $_POST['sirl_feedback_email'] ) ||  ! wp_verify_nonce( $_POST['sirl_feedback_options_field'], basename(__FILE__) ) ) {
			return $post_id;
		}
		// Now that we're authenticated, time to save the data.
		// This sanitizes the data from the field and saves it into an array $events_meta.

		$sirl_feedback_desc = esc_textarea( $_POST['sirl_feedback_desc'] );
		$sirl_feedback_firstname = esc_textarea($_POST['sirl_feedback_firstname']);
		$sirl_feedback_lastname = esc_textarea($_POST['sirl_feedback_lastname']);
		$sirl_feedback_email = esc_textarea($_POST['sirl_feedback_email']);
		
	    
	    if ( get_post_meta( $post_id, 'sirl_feedback_email', false ) ) {
			// If the custom field already has a value, update it.
			update_post_meta( $post_id, 'sirl_feedback_email', $sirl_feedback_email );
		}else {
			// If the custom field doesn't have a value, add it.
			add_post_meta( $post_id, 'sirl_feedback_email', $sirl_feedback_email);
		}
	    
	    if ( get_post_meta( $post_id, 'sirl_feedback_lastname', false ) ) {
			// If the custom field already has a value, update it.
			update_post_meta( $post_id, 'sirl_feedback_lastname', $sirl_feedback_lastname );
		}else {
			// If the custom field doesn't have a value, add it.
			add_post_meta( $post_id, 'sirl_feedback_lastname', $sirl_feedback_lastname);
		}
		

		if ( get_post_meta( $post_id, 'sirl_feedback_desc', false ) ) {
			// If the custom field already has a value, update it.
			update_post_meta( $post_id, 'sirl_feedback_desc', $sirl_feedback_desc );
		}else {
			// If the custom field doesn't have a value, add it.
			add_post_meta( $post_id, 'sirl_feedback_desc', $sirl_feedback_desc);
		}
		
		if ( get_post_meta( $post_id, 'sirl_feedback_firstname', false ) ) {
			// If the custom field already has a value, update it.
			update_post_meta( $post_id, 'sirl_feedback_firstname', $sirl_feedback_firstname );
		}else {
			// If the custom field doesn't have a value, add it.
			add_post_meta( $post_id, 'sirl_feedback_firstname', $sirl_feedback_firstname);
		}
		
	}
	add_action( 'save_post', 'feedbacks_save_meta', 1, 2 );
    
    









