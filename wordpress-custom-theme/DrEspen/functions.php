<?php

/**

 * Sage includes

 *

 * The $sage_includes array determines the code library included in your theme.

 * Add or remove files to the array as needed. Supports child theme overrides.

 *

 * Please note that missing files will produce a fatal error.

 *

 * @link https://github.com/roots/sage/pull/1042

 */
 
@ini_set( 'upload_max_size' , '64M' );
@ini_set( 'post_max_size', '64M');
@ini_set( 'max_execution_time', '300' );

$sage_includes = [

  'lib/assets.php',    // Scripts and stylesheets

  'lib/extras.php',    // Custom functions

  'lib/setup.php',     // Theme setup

  'lib/titles.php',    // Page titles

  'lib/wrapper.php',   // Theme wrapper class

  'lib/customizer.php' // Theme customizer

];



foreach ($sage_includes as $file) {

  if (!$filepath = locate_template($file)) {

    trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);

  }



  require_once $filepath;

}

unset($file, $filepath);



remove_action( 'storefront_sidebar', 'storefront_get_sidebar' );







function custom_menu_page_removing() {

remove_menu_page( 'edit.php' );

}

add_action( 'admin_menu', 'custom_menu_page_removing' );









// Register Custom Post Type

function articles_post_type() {



  $labels = array(

    'name'                  => _x( 'Articles', 'Post Type General Name', 'text_domain' ),

    'singular_name'         => _x( 'Article', 'Post Type Singular Name', 'text_domain' ),

    'menu_name'             => __( 'Articles', 'text_domain' ),

    'name_admin_bar'        => __( 'Post Type', 'text_domain' ),

    'archives'              => __( 'Item Archives', 'text_domain' ),

    'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),

    'all_items'             => __( 'All Items', 'text_domain' ),

    'add_new_item'          => __( 'Add New Item', 'text_domain' ),

    'add_new'               => __( 'Add New Article', 'text_domain' ),

    'new_item'              => __( 'New Item', 'text_domain' ),

    'edit_item'             => __( 'Edit Item', 'text_domain' ),

    'update_item'           => __( 'Update Item', 'text_domain' ),

    'view_item'             => __( 'View Item', 'text_domain' ),

    'search_items'          => __( 'Search Item', 'text_domain' ),

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

    'label'                 => __( 'Article', 'text_domain' ),

    'description'           => __( 'Articles', 'text_domain' ),

    'labels'                => $labels,

    'supports'              => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', ),

    'taxonomies'            => array( 'category', 'post_tag' ),

    'hierarchical'          => false,

    'public'                => true,

    'show_ui'               => true,

    'show_in_menu'          => true,

    'menu_position'         => 5,

    'show_in_admin_bar'     => true,

    'show_in_nav_menus'     => true,

    'can_export'            => true,

    'has_archive'           => true,    

    'exclude_from_search'   => false,

    'publicly_queryable'    => true,

    'rewrite'               => true,

    'capability_type'       => 'page',

  );

  register_post_type( 'articles', $args );



}

add_action( 'init', 'articles_post_type', 0 );



function coachings_post_type() {



  $labels = array(

    'name'                  => _x( 'Coachings', 'Post Type General Name', 'text_domain' ),

    'singular_name'         => _x( 'Coaching', 'Post Type Singular Name', 'text_domain' ),

    'menu_name'             => __( 'Coachings', 'text_domain' ),

    'name_admin_bar'        => __( 'Post Type', 'text_domain' ),

    'archives'              => __( 'Item Archives', 'text_domain' ),

    'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),

    'all_items'             => __( 'All Items', 'text_domain' ),

    'add_new_item'          => __( 'Add New Item', 'text_domain' ),

    'add_new'               => __( 'Add New Article', 'text_domain' ),

    'new_item'              => __( 'New Item', 'text_domain' ),

    'edit_item'             => __( 'Edit Item', 'text_domain' ),

    'update_item'           => __( 'Update Item', 'text_domain' ),

    'view_item'             => __( 'View Item', 'text_domain' ),

    'search_items'          => __( 'Search Item', 'text_domain' ),

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

    'label'                 => __( 'Coaching', 'text_domain' ),

    'description'           => __( 'Coachings', 'text_domain' ),

    'labels'                => $labels,

    'supports'              => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', ),

    'taxonomies'            => array( 'category', 'post_tag' ),

    'hierarchical'          => false,

    'public'                => true,

    'show_ui'               => true,

    'show_in_menu'          => true,

    'menu_position'         => 5,

    'show_in_admin_bar'     => true,

    'show_in_nav_menus'     => true,

    'can_export'            => true,

    'has_archive'           => true,    

    'exclude_from_search'   => false,

    'publicly_queryable'    => true,

    'rewrite'               => true,

    'capability_type'       => 'page',

  );

  register_post_type( 'coachings', $args );



}

add_action( 'init', 'coachings_post_type', 0 );



// Register Custom Post Type

function events_post_type() {



  $labels = array(

    'name'                  => _x( 'Events', 'Post Type General Name', 'text_domain' ),

    'singular_name'         => _x( 'Event', 'Post Type Singular Name', 'text_domain' ),

    'menu_name'             => __( 'Events', 'text_domain' ),

    'name_admin_bar'        => __( 'Post Type', 'text_domain' ),

    'archives'              => __( 'Item Archives', 'text_domain' ),

    'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),

    'all_items'             => __( 'All Items', 'text_domain' ),

    'add_new_item'          => __( 'Add New Item', 'text_domain' ),

    'add_new'               => __( 'Add New Event', 'text_domain' ),

    'new_item'              => __( 'New Item', 'text_domain' ),

    'edit_item'             => __( 'Edit Item', 'text_domain' ),

    'update_item'           => __( 'Update Item', 'text_domain' ),

    'view_item'             => __( 'View Item', 'text_domain' ),

    'search_items'          => __( 'Search Item', 'text_domain' ),

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

    'label'                 => __( 'Event', 'text_domain' ),

    'description'           => __( 'Events', 'text_domain' ),

    'labels'                => $labels,

    'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions', ),

    'hierarchical'          => false,

    'public'                => true,

    'show_ui'               => true,

    'show_in_menu'          => true,

    'menu_position'         => 5,

    'show_in_admin_bar'     => true,

    'show_in_nav_menus'     => true,

    'can_export'            => true,

    'has_archive'           => true,    

    'exclude_from_search'   => false,

    'publicly_queryable'    => true,

    'rewrite'               => array('slug' => 'events', 'with_front' => FALSE),

    'capability_type'       => 'page',

  );

  register_post_type( 'events', $args );



}

add_action( 'init', 'events_post_type', 0 );



//add_filter('script_loader_tag', 'add_defer_attribute', 10, 2);
add_action( 'wp_ajax_save_wheel_of_life_survey', 'save_wheel_of_life_survey' );
add_action( 'wp_ajax_nopriv_save_wheel_of_life_survey', 'save_wheel_of_life_survey' );
function save_wheel_of_life_survey(){
	global $wpdb;
	if(isset($_POST["submit"])){
		 $inf_field_FirstName = $_POST["inf_field_FirstName"];
		 $inf_field_LastName = $_POST["inf_field_LastName"];
		 $inf_field_Phone1 = $_POST["inf_field_Phone1"];
		 $inf_field_Email = $_POST["inf_field_Email"];
		 $inf_custom_WLSFacebook = $_POST["inf_custom_WLSFacebook"];
		 $inf_custom_MentalAndEmotionalState = $_POST["inf_custom_MentalAndEmotionalState"];
		 $inf_custom_Family = $_POST["inf_custom_Family"];
		 $inf_custom_Time = $_POST["inf_custom_Time"];
		 $inf_custom_Financial = $_POST["inf_custom_Financial"];
		 $inf_custom_PhysicalHealth = $_POST["inf_custom_PhysicalHealth"];
		 $inf_custom_CareerMission = $_POST["inf_custom_CareerMission"];
		 $inf_custom_SpiritualFulfillment = $_POST["inf_custom_SpiritualFulfillment"];
		 $inf_custom_PersonalDevelopment = $_POST["inf_custom_PersonalDevelopment"];
		 $inf_custom_WLSMein12months = $_POST["inf_custom_WLSMein12months"];
		 $inf_custom_WLSMein10Years = $_POST["inf_custom_WLSMein10Years"];
		 $inf_custom_WLSRoadBlocks = $_POST["inf_custom_WLSRoadBlocks"];
		 $inf_custom_WLSpersonalorprofessionalvision = $_POST["inf_custom_WLSpersonalorprofessionalvision"];
 		 $inf_custom_Thankforreferringyou = $_POST["inf_custom_Thankforreferringyou"];
		 $inf_custom_WLSGrossAnnualIncome = $_POST["inf_custom_WLSGrossAnnualIncome"];
		 $inf_option_WLSPlannedInvestmentinSelfDevelopment = $_POST["inf_option_WLSPlannedInvestmentinSelfDevelopment"];
		 $inf_custom_questions_comments = $_POST['inf_custom_questions_comments'];
		 $MentalAndEmotionalState_feel = $_POST['MentalAndEmotionalState_feel'];
		 $CareerMission_feel = $_POST['CareerMission_feel'];
		 $Family_feel = $_POST['Family_feel'];
		 $Time_feel = $_POST['Time_feel'];
		 $Financial_feel = $_POST['Financial_feel'];
		 $PhysicalHealth_feel = $_POST['PhysicalHealth_feel'];
		 $SpiritualFulfillment_feel = $_POST['SpiritualFulfillment_feel'];
		 $PersonalDevelopment_feel = $_POST['PersonalDevelopment_feel'];
		 $wol_status = $_POST['status'];
		$wolData = array(
						'inf_field_FirstName'    								=> $inf_field_FirstName,
						'inf_field_LastName'    								=> $inf_field_LastName,
						'inf_field_Phone1'    									=> $inf_field_Phone1,
						'inf_field_Email'    									=> $inf_field_Email,
						'inf_custom_WLSFacebook'    							=> $inf_custom_WLSFacebook,
						'inf_custom_MentalAndEmotionalState'    				=> $inf_custom_MentalAndEmotionalState,
						'MentalAndEmotionalState_feel'    						=> $MentalAndEmotionalState_feel,
						'inf_custom_Family'    									=> $inf_custom_Family,
						'Family_feel'    										=> $Family_feel,
						'inf_custom_Time'    									=> $inf_custom_Time,
						'Time_feel'    											=> $Time_feel,
						'inf_custom_Financial'    								=> $inf_custom_Financial,
						'Financial_feel'    									=> $Financial_feel,
						'inf_custom_PhysicalHealth'    							=> $inf_custom_PhysicalHealth,
						'PhysicalHealth_feel'    								=> $PhysicalHealth_feel,
						'inf_custom_CareerMission'    							=> $inf_custom_CareerMission,
						'CareerMission_feel'    								=> $CareerMission_feel,
						'inf_custom_SpiritualFulfillment'    					=> $inf_custom_SpiritualFulfillment,
						'SpiritualFulfillment_feel'    							=> $SpiritualFulfillment_feel,
						'inf_custom_PersonalDevelopment'    					=> $inf_custom_PersonalDevelopment,
						'PersonalDevelopment_feel'    							=> $PersonalDevelopment_feel,
						'inf_custom_WLSMein12months'    						=> $inf_custom_WLSMein12months,
						'inf_custom_WLSMein10Years'    							=> $inf_custom_WLSMein10Years,
						'inf_custom_WLSRoadBlocks'    							=> $inf_custom_WLSRoadBlocks,
						'inf_custom_WLSpersonalorprofessionalvision'    		=> $inf_custom_WLSpersonalorprofessionalvision,
 						'inf_custom_Thankforreferringyou'  						=> $inf_custom_Thankforreferringyou,
						'inf_custom_WLSGrossAnnualIncome'    					=> $inf_custom_WLSGrossAnnualIncome,
						'inf_option_WLSPlannedInvestmentinSelfDevelopment'    	=> $inf_option_WLSPlannedInvestmentinSelfDevelopment,
						'inf_custom_questions_comments'                         => $inf_custom_questions_comments,
						'status'                                                =>$wol_status						 
					);
			$wpdb->insert(
				$wpdb->prefix . 'wol',
				$wolData
			);
		    $lastid = $wpdb->insert_id;
   	        if($lastid){
				$message = "<table style='width:70%;margin:0 auto;text-transform: capitalize;'><tr><td style='color: #C94429;font-size: 2.827em;font-weight: 700;'>Thank you for participating!</td></tr><tr><td style:'width:60%; margin-top: 20px;'>By Taking The Wheel Of Life Assessment You Have Completed The First Step To Personal Mastery - Self-Discovery!</td></tr><tr><td  id='chart_div' style='margin-top: 20px;'></td></tr>\r\n";
				$message .= "<tr><td>First Name: ".$inf_field_FirstName."</td></tr>";
				$message .= "<tr><td>Last Name: ".$inf_field_LastName."</td></tr>";
				$message .= "<tr><td>Best Number: ".$inf_field_Phone1."</td></tr>";
				$message .= "<tr><td>Email Address: ".$inf_field_Email."</td></tr>";
				$message .= "<tr><td>Facebook Username: ".$inf_custom_WLSFacebook."</td></tr>";
				$message .= "<tr><td height='20'></td></tr>";
				if(!empty($inf_custom_MentalAndEmotionalState )){
				$message .= "<tr><td>Mental and Emotional State: ".$inf_custom_MentalAndEmotionalState."</td></tr>";	
				}
				if(!empty($MentalAndEmotionalState_feel )){
				$message .= "<tr><td>How does your score above make you feel: ".$MentalAndEmotionalState_feel."</td></tr>";	
				}
				$message .= "<tr><td height='20'></td></tr>";
				$message .= "<tr><td>Career/Vocation/Purpose: ".$inf_custom_CareerMission."</td></tr>";
				if(!empty($CareerMission_feel )){
				$message .= "<tr><td>How does your score above make you feel: ".$CareerMission_feel."</td></tr>";	
				}
				$message .= "<tr><td height='20'></td></tr>";
				$message .= "<tr><td>Relationships: ".$inf_custom_Family."</td></tr>";
				if(!empty($Family_feel )){
				$message .= "<tr><td>How does your score above make you feel: ".$Family_feel."</td></tr>";	
				}
				$message .= "<tr><td height='20'></td></tr>";
				$message .= "<tr><td>Time: ".$inf_custom_Time."</td></tr>";
				if(!empty($Time_feel )){
				$message .= "<tr><td>How does your score above make you feel: ".$Time_feel."</td></tr>";	
				}
				$message .= "<tr><td height='20'></td></tr>";
				$message .= "<tr><td>Financial: ".$inf_custom_Financial."</td></tr>";
				if(!empty($Financial_feel )){
				$message .= "<tr><td>How does your score above make you feel: ".$Financial_feel."</td></tr>";	
				}
				$message .= "<tr><td height='20'></td></tr>";
				$message .= "<tr><td>Physical Health: ".$inf_custom_PhysicalHealth."</td></tr>";
				if(!empty($PhysicalHealth_feel )){
				$message .= "<tr><td>How does your score above make you feel: ".$PhysicalHealth_feel."</td></tr>";	
				}
				$message .= "<tr><td height='20'></td></tr>";
				$message .= "<tr><td>Spiritual Fulfillment: ".$inf_custom_SpiritualFulfillment."</td></tr>";
				if(!empty($SpiritualFulfillment_feel )){
				$message .= "<tr><td>How does your score above make you feel: ".$SpiritualFulfillment_feel."</td></tr>";	
				}
				$message .= "<tr><td height='20'></td></tr>";
				$message .= "<tr><td>Personal Development: ".$inf_custom_PersonalDevelopment."</td></tr>";
				if(!empty($PersonalDevelopment_feel )){
				$message .= "<tr><td>How does your score above make you feel: ".$PersonalDevelopment_feel."</td></tr>";	
				}
				$message .= "<tr><td height='20'></td></tr>";
				if(!empty($inf_custom_Thankforreferringyou )){
				$message .= "<tr><td>Who Can We Thank For Referring You To The Dr Espen Coaching Team: ".$inf_custom_Thankforreferringyou."</td></tr>";	
				}
				if(!empty($inf_custom_WLSMein12months )){
				$message .= "<tr><td>Where Do You Want To Be In 10 Years From Today: ".$inf_custom_WLSMein12months."</td></tr>";	
				}
				if(!empty($inf_custom_WLSRoadBlocks)){
				$message .= "<tr><td>What Are The 3 Biggest Road Blocks In Your Life Right Now: ".$inf_custom_WLSRoadBlocks."</td></tr>";	
				}
				if(!empty($inf_custom_WLSpersonalorprofessionalvision )){
				$message .= "<tr><td>Professional Vision: ".$inf_custom_WLSpersonalorprofessionalvision ."</td></tr>";	
				}
				if(!empty($inf_custom_WLSGrossAnnualIncome )){
				$message .= "<tr><td>Gross Annual Income: ".$inf_custom_WLSGrossAnnualIncome ."</td></tr>";	
				}
				if(!empty($inf_option_WLSPlannedInvestmentinSelfDevelopment )){
				$message .= "<tr><td>Self-Development Per Annum: ".$inf_option_WLSPlannedInvestmentinSelfDevelopment ."</td></tr>";	
				}
				if(!empty($inf_custom_questions_comments)){
				$message .= "<tr><td>If You Have Any Additional Questions Or Comments For Our Coaching Team: ".$inf_custom_questions_comments."</td></tr>";	
				}
				$message .= "<tr><td style:'width:60%'><br>Our Team Is Looking Forward To Guiding You On Your Journey To Fulfilment And Peak Performance In Every Area Of The Life.<br><br> Dr. Espen Team</td></tr><tr><td  id='chart_div' style='margin-top: 20px;'></td></tr></table>";
				
				$to = 'admin@drespen.com,iam@drespen.com,jasmine@drespen.com,drespenjasmine@gmail.com';
				//$to = 'dixitsoni2017@gmail.com,iam@drespen.com';
				$subject = $inf_field_FirstName."'s WOL survey responses";
				$headers = "From: info@drespen.com \r\n";
				$headers .= "Reply-To: info@drespen.com \r\n"; 
				$headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
				$headers .= "Bcc: macrew.business@gmail.com \r\n";
				mail( $to, $subject, $message, $headers );
				
				
					
				/* Client email */
				$message2 = "<table style='width:70%;margin:0 auto;text-transform: capitalize;'><tr><td style='color: #C94429;font-size: 2.827em;font-weight: 700;'>Thank you for participating!</td></tr><tr><td style:'width:60%; margin-top: 30px;'>By Taking The Wheel Of Life Assessment You Have Completed The First Step To Personal Mastery - Self-Discovery!<br></td></tr><tr><td  id='chart_div' style='margin-top: 30px;'></td></tr>\r\n";
				if(!empty($inf_custom_Thankforreferringyou )){
				$message2 .= "<tr><td>Who Can We Thank For Referring You To The Dr Espen Coaching Team: ".$inf_custom_Thankforreferringyou."</td></tr>";	
				}
				if(!empty($inf_custom_WLSMein12months )){
				$message2 .= "<tr><td>Where Do You Want To Be In 10 Years From Today: ".$inf_custom_WLSMein12months."</td></tr>";	
				}
				if(!empty($inf_custom_WLSRoadBlocks)){
				$message2 .= "<tr><td>What Are The 3 Biggest Road Blocks In Your Life Right Now: ".$inf_custom_WLSRoadBlocks."</td></tr>";	
				}
				if(!empty($inf_custom_WLSpersonalorprofessionalvision )){
				$message2 .= "<tr><td>Professional Vision: ".$inf_custom_WLSpersonalorprofessionalvision ."</td></tr>";	
				}
				if(!empty($inf_custom_WLSGrossAnnualIncome )){
				$message2 .= "<tr><td>Gross Annual Income: ".$inf_custom_WLSGrossAnnualIncome ."</td></tr>";	
				}
				if(!empty($inf_option_WLSPlannedInvestmentinSelfDevelopment )){
				$message2 .= "<tr><td>Self-Development Per Annum: ".$inf_option_WLSPlannedInvestmentinSelfDevelopment ."</td></tr>";	
				}
				if(!empty($inf_custom_questions_comments)){
				$message2 .= "<tr><td>If You Have Any Additional Questions Or Comments For Our Coaching Team: ".$inf_custom_questions_comments."</td></tr>";	
				}
				$message2 .= "<tr><td style:'width:60%'><br>Our Team Is Looking Forward To Guiding You On Your Journey To Fulfilment And Peak Performance In Every Area Of The Life.<br><br> Dr. Espen Team</td></tr><tr><td  id='chart_div' style='margin-top: 20px;'></td></tr></table>";
				
				
				
				$to2 = $inf_field_Email;
				$subject2 = $inf_field_FirstName."'s WOL survey responses";
				$headers2 = "From: info@drespen.com \r\n";
				$headers2 .= "Reply-To: info@drespen.com \r\n"; 
				$headers2 .= "MIME-Version: 1.0\r\n";
                $headers2 .= "Content-Type: text/html; charset=UTF-8\r\n";
				 mail( $to2, $subject2, $message2, $headers2 );
			}
			
	}
	die();
}

// Register Custom Post Type

function programs_post_type() {



  $labels = array(

    'name'                  => _x( 'Programs', 'Post Type General Name', 'text_domain' ),

    'singular_name'         => _x( 'Program', 'Post Type Singular Name', 'text_domain' ),

    'menu_name'             => __( 'Programs', 'text_domain' ),

    'name_admin_bar'        => __( 'Post Type', 'text_domain' ),

    'archives'              => __( 'Item Archives', 'text_domain' ),

    'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),

    'all_items'             => __( 'All Items', 'text_domain' ),

    'add_new_item'          => __( 'Add New Item', 'text_domain' ),

    'add_new'               => __( 'Add New Program', 'text_domain' ),

    'new_item'              => __( 'New Item', 'text_domain' ),

    'edit_item'             => __( 'Edit Item', 'text_domain' ),

    'update_item'           => __( 'Update Item', 'text_domain' ),

    'view_item'             => __( 'View Item', 'text_domain' ),

    'search_items'          => __( 'Search Item', 'text_domain' ),

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

    'label'                 => __( 'Program', 'text_domain' ),

    'description'           => __( 'Programs', 'text_domain' ),

    'labels'                => $labels,

    'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions', ),

    'hierarchical'          => false,

    'public'                => true,

    'show_ui'               => true,

    'show_in_menu'          => true,

    'menu_position'         => 5,

    'show_in_admin_bar'     => true,

    'show_in_nav_menus'     => true,

    'can_export'            => true,

    'has_archive'           => true,    

    'exclude_from_search'   => false,

    'publicly_queryable'    => true,

    'rewrite'               => array('slug' => 'programs', 'with_front' => FALSE),

    'capability_type'       => 'page',

  );

  register_post_type( 'programs', $args );



}

add_action( 'init', 'programs_post_type', 0 );







/**

 * Register our sidebars and widgetized areas.

 *

 */

function arphabet_widgets_init() {



  register_sidebar( array(

    'name'          => 'sidebar-widget',

    'id'            => 'sidebar-widget-1',

    'before_widget' => '<div>',

    'after_widget'  => '</div>',

    'before_title'  => '<h2 class="rounded">',

    'after_title'   => '</h2>',

  ) );



}

add_action( 'widgets_init', 'arphabet_widgets_init' );









add_action( 'after_setup_theme', 'woocommerce_support' );

function woocommerce_support() {

    add_theme_support( 'woocommerce' );

}



// adds visabiltiy field to gravity forms

add_filter( 'gform_enable_field_label_visibility_settings', '__return_true' );



// Quote Shortcode

function quote() {

    return '<div class="quote-container">

<div id="john-quote" class="quotes quotes-one col-lg-12 col-md-12 col-sm-12 col-xs-12">

                <div class="quote-border-one">

                        <div class="quote-image">

                                <img class="hidden-xs" src="/wp-content/themes/DrEspen/dist/images/john-quote.png" alt="John Demartini Picture">

                        </div>

                <h4>"Dr Espen&#39;s teachings could take your life and health to a whole new level."</h4>

                <p class="quote-name-bottom"><strong>Dr. John Demartini</strong><br><span class="quote-small">International best-selling author of Count Your Blessings</span></p>

            

                </div>

            </div>

            </div>



    ';

}

add_shortcode( 'quote', 'quote' );



// Quote Shortcode

function quote_mail() {

    return '



        <div class="quote-container">



            <div id="john-quote" class="quotes quotes-one col-lg-12 col-md-12 col-sm-12 col-xs-12">

                <div class="quote-border-one">

                        <div class="quote-image">

                        </div>

                <h4>�Dr. Espen�s passion is not only to build wellness centres, but to educate clients to reach their Peak Performance.�</h4>

                <p class="quote-name-bottom"><strong>The Courier Mail</strong><br><span class="quote-small">Breaking News Headlines for Brisbane, Australia and the World.</span></p>

            

                </div>

            </div>

            </div>



    ';

}

add_shortcode( 'quote_mail', 'quote_mail' );



// Quote Shortcode

function quote_espen() {

    return '



        <div class="quote-container">



            <div id="john-quote" class="quotes quotes-one col-lg-12 col-md-12 col-sm-12 col-xs-12">

                <div class="quote-border-one">

                        <div class="quote-image">

                        </div>

                <h4>�The question is not just �how�, but �why�. If you find the answer to your �why�, then the �hows� take care of themselves�.</h4>

                <p class="quote-name-bottom"><strong>Dr. Espen</strong><br><span class="quote-small">International Speaker | Lifetime Wellness and Peak Performance Coach | Business Strategist</span></p>

            

                </div>

            </div>

            </div>



    ';

}

add_shortcode( 'quote_espen', 'quote_espen' );



function custom_pagination($numpages = '', $pagerange = '', $paged='') {



  if (empty($pagerange)) {

    $pagerange = 2;

  }



  /**

   * This first part of our function is a fallback

   * for custom pagination inside a regular loop that

   * uses the global $paged and global $wp_query variables.

   * 

   * It's good because we can now override default pagination

   * in our theme, and use this function in default quries

   * and custom queries.

   */

  global $paged;

  if (empty($paged)) {

    $paged = 1;

  }

  if ($numpages == '') {

    global $wp_query;

    $numpages = $wp_query->max_num_pages;

    if(!$numpages) {

        $numpages = 1;

    }

  }



  /** 

   * We construct the pagination arguments to enter into our paginate_links

   * function. 

   */

  $pagination_args = array(

    'base'            => get_pagenum_link(1) . '%_%',

    'format'          => 'page/%#%',

    'total'           => $numpages,

    'current'         => $paged,

    'show_all'        => False,

    'end_size'        => 1,

    'mid_size'        => $pagerange,

    'prev_next'       => True,

    'prev_text'       => __('&laquo;'),

    'next_text'       => __('&raquo;'),

    'type'            => 'plain',

    'add_args'        => false,

    'add_fragment'    => ''

  );



  $paginate_links = paginate_links($pagination_args);



  if ($paginate_links) {

    echo "<nav class='custom-pagination'>";

      echo $paginate_links;

    echo "</nav>";

  }



}





set_post_thumbnail_size( 150, 150 );

add_image_size('article-cards', 454, 227, true);



/**

 * Plugin Name: WooCommerce Display Currency Code in Currency Symbol

 * Plugin URI: https://gist.github.com/BFTrick/10681832

 * Description: Add the currency code to the currency symbol in WooCommerce. Ex. USD $.

 * Author: Patrick Rauland

 * Author URI: http://patrickrauland.com/

 * Version: 1.0

 *

 * This program is free software: you can redistribute it and/or modify

 * it under the terms of the GNU General Public License as published by

 * the Free Software Foundation, either version 3 of the License, or

 * (at your option) any later version.

 *

 * This program is distributed in the hope that it will be useful,

 * but WITHOUT ANY WARRANTY; without even the implied warranty of

 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the

 * GNU General Public License for more details.

 *

 * You should have received a copy of the GNU General Public License

 * along with this program. If not, see <http://www.gnu.org/licenses/>.

 *

 */

function patricks_currency_symbol( $currency_symbol, $currency ) {

    switch( $currency ) {

        case 'USD':

            $currency_symbol = 'USD $';

            break;

        case 'NZD':

            $currency_symbol = 'NZD $';

            break;

        case 'AUD':

            $currency_symbol = 'AUD $';

            break;

    }

    return $currency_symbol;

}

add_filter('woocommerce_currency_symbol', 'patricks_currency_symbol', 30, 2);





function get_custom_cat_template($single_template) {

     global $post;

 

       if ( in_category( 'videos' )) {

          $single_template = dirname( __FILE__ ) . '/single-videos.php';

     }

     return $single_template;

}

 

add_filter( "single_template", "get_custom_cat_template" ) ;





add_filter( 'woocommerce_breadcrumb_defaults', 'my_change_breadcrumb_delimiter' );

function my_change_breadcrumb_delimiter( $defaults ) {

 // Change the breadcrumb delimiter from '/' to '>'

 $defaults['delimiter'] = ' ' ;

 return $defaults;

}



function remove_head_scripts() {

   remove_action('wp_head', 'wp_print_scripts');

   remove_action('wp_head', 'wp_print_head_scripts', 9);

   remove_action('wp_head', 'wp_enqueue_scripts', 1);

 

   add_action('wp_footer', 'wp_print_scripts', 5);

   add_action('wp_footer', 'wp_print_head_scripts', 5);

   add_action('wp_footer', 'wp_enqueue_scripts', 5);

}

//add_action( 'wp_enqueue_scripts', 'remove_head_scripts' );



if( file_exists( get_template_directory() . '/functions-wheel-of-life-survey.php' ) )

    require_once( get_template_directory() . '/functions-wheel-of-life-survey.php' );





// Redirect to special thank you page after TFT is sold

add_action( 'woocommerce_thankyou', 'jc_ftf_redirectcustom');

function jc_ftf_redirectcustom( $order_id ) {

    $order = new WC_Order( $order_id );

    $items = $order->get_items();

    foreach ( $items as $item ) {

        $product_id = $item['product_id'];



        if( $product_id == 2549 ) {

            wp_redirect('https://www.drespen.com/fast-track-formula-purchase-thank/');

            exit;

        }

    }

}

function add_defer_attribute($tag, $handle) {
   // add script handles to the array below
   $scripts_to_defer = array('my-js-handle', 'another-handle');
   
   foreach($scripts_to_defer as $defer_script) {
      if ($defer_script === $handle) {
         return str_replace(' src', ' defer="defer" src', $tag);
      }
   }
   return $tag;
}
//add_filter('script_loader_tag', 'add_defer_attribute', 10, 2);
add_action( 'template_redirect', 'wc_custom_redirect_after_purchase' );
function wc_custom_redirect_after_purchase() {
    if ( ! is_wc_endpoint_url( 'order-received' ) ) return;

    // Define the product IDs in this array
    $product_ids = array(4019); // or an empty array if not used
    // Define the product categories (can be IDs, slugs or names)
    $product_categories = array( 'clothing' ); // or an empty array if not used
    $redirection = false;

    global $wp;
    $order_id =  intval( str_replace( 'checkout/order-received/', '', $wp->request ) ); // Order ID
    $order = wc_get_order( $order_id ); // Get an instance of the WC_Order Object

    // Iterating through order items and finding targeted products
    foreach( $order->get_items() as $item ){
        if( in_array( $item->get_product_id(), $product_ids ) || has_term( $product_categories, 'product_cat', $item->get_product_id() ) ) {
            $redirection = true;
            break;
        }
    }

    // Make the custom redirection when a targeted product has been found in the order
    if( $redirection ){
        wp_redirect( home_url( '/thank-you-2/' ) );
        exit;
    }
}

function your_prefix_get_meta_box( $meta_boxes ) {
	$prefix = 'prefix-';

	$meta_boxes[] = array(
		'id' => 'untitled',
		'title' => esc_html__( 'Untitled Metabox', 'metabox-online-generator' ),
		'post_types' => array('events'),
		'context' => 'advanced',
		'priority' => 'default',
		'autosave' => 'false',
		'fields' => array(
			array(
				'id' => $prefix . 'datetime_start_date',
				'type' => 'datetime',
				'name' => esc_html__( 'Start Date', 'metabox-online-generator' ),
				'desc' => esc_html__( 'Event Start Date', 'metabox-online-generator' ),
			),
			array(
				'id' => $prefix . 'datetime_end_date',
				'type' => 'datetime',
				'name' => esc_html__( 'End Date', 'metabox-online-generator' ),
				'desc' => esc_html__( 'Event End Date', 'metabox-online-generator' ),
			)
		),
		'validation' => array(
		'rules'  => array(
			$prefix . 'datetime_start_date' => array(
				'required'  => true,
				// More rules here
			),
			$prefix . 'datetime_end_date' => array(
				'required'  => true,
				// More rules here
			),
			// Rules for other fields
		),
		),

	);

	return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'your_prefix_get_meta_box' );



function new_excerpt_more($more) {
    return '';
}
add_filter('excerpt_more', 'new_excerpt_more', 21 );

function custom_excerpt_length( $length ) {
	return 10;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
