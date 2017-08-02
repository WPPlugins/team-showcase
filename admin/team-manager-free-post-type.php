<?php

	/*
	* @Author 		Themepoints
	* Copyright: 	2016 Themepoints
	*/
	
if ( ! defined( 'ABSPATH' ) )

	die("Can't load this file directly");	

	/*===================================================================
		Register Custom Post Function
	=====================================================================*/

	function team_manager_free_custom_post_type(){
			$labels = array(
				'name'                  => _x( 'Team Manager', 'Post Type General Name', 'team-manager-free' ),
				'singular_name'         => _x( 'Team Manager', 'Post Type Singular Name', 'team-manager-free' ),
				'menu_name'             => __( 'Team Manager', 'team-manager-free' ),
				'name_admin_bar'        => __( 'Team Manager', 'team-manager-free' ),
				'parent_item_colon'     => __( 'Parent Item:', 'team-manager-free' ),
				'all_items'             => __( 'All Group', 'team-manager-free' ),
				'add_new_item'          => __( 'Add New Group', 'team-manager-free' ),
				'add_new'               => __( 'Add New Group', 'team-manager-free' ),
				'new_item'              => __( 'New Group', 'team-manager-free' ),
				'edit_item'             => __( 'Edit Group', 'team-manager-free' ),
				'update_item'           => __( 'Update Group', 'team-manager-free' ),
				'view_item'             => __( 'View Group', 'team-manager-free' ),
				'search_items'          => __( 'Search Group', 'team-manager-free' ),
				'not_found'             => __( 'Not found', 'team-manager-free' ),
				'not_found_in_trash'    => __( 'Not found in Trash', 'team-manager-free' ),
				'items_list'            => __( 'Items list', 'team-manager-free' ),
				'items_list_navigation' => __( 'Items list navigation', 'team-manager-free' ),
				'filter_items_list'     => __( 'Filter items list', 'team-manager-free' ),
			);
			$args = array(
				'label'                 => __( 'Post Type', 'team-manager-free' ),
				'description'           => __( 'Post Type Description', 'team-manager-free' ),
				'labels'                => $labels,
				'supports'              => array('title'),
				'hierarchical'          => false,
				'public'                => true,
				'menu_icon' 			=> 'dashicons-admin-users',
				'show_ui'               => true,
				'show_in_menu'          => true,
				'menu_position'         => 5,
				'show_in_admin_bar'     => true,
				'show_in_nav_menus'     => true,
				'can_export'            => true,
				'has_archive'           => true,		
				'exclude_from_search'   => false,
				'publicly_queryable'    => true,
				'capability_type'       => 'page',
			);
			register_post_type( 'team_mf', $args );

		}
		// end custom post type
	add_action('init', 'team_manager_free_custom_post_type');
	
	
	
	/*=====================================================================
		Register Post Meta Boxes
	=======================================================================*/
	function team_manager_free_add_metabox() {
		
		$screens = array('team_mf');
		foreach ($screens as $screen) {
			add_meta_box('team_manager_free_sectionid', __('Team Options', 'team-manager-free'),'single_team_manager_free_display', $screen,'normal','high');
		}

	} // end metabox boxes

	add_action('add_meta_boxes', 'team_manager_free_add_metabox');
		
		
	/*=====================================================================
	 * Renders the nonce and the textarea for the notice.
	 =======================================================================*/
	function single_team_manager_free_display( $post ) {
	global $post;
    // Use nonce for verification
    wp_nonce_field( plugin_basename( __FILE__ ), 'dynamicMeta_noncename' );
    ?>
	
	<div id="tabs-container">
		<ul class="tabs-menu">
			<li class="current"><a href="#tab-1"><i class="fa fa-user"></i><?php _e('Team Member', 'team-manager-free')?></a></li>
			<li><a href="#tab-2"><i class="fa fa-gear"></i><?php _e('Team Settings', 'team-manager-free')?></a></li>
			<li><a href="#tab-3"><i class="fa fa-cogs"></i><?php _e('Color Settings', 'team-manager-free')?></a></li>
		</ul>
		<div class="tab">
		<div id="tab-1" class="tab-content">	
		<div id="meta_inner">
		<?php

		//get the saved meta as an arry
		$ourwork = get_post_meta($post->ID,'ourwork',true);
		$team_manager_free_post_themes = get_post_meta( $post->ID, 'team_manager_free_post_themes', true );
		$team_manager_free_post_column = get_post_meta( $post->ID, 'team_manager_free_post_column', true );
		$team_manager_free_social_target = get_post_meta( $post->ID, 'team_manager_free_social_target', true );
		$team_manager_free_text_alignment = get_post_meta( $post->ID, 'team_manager_free_text_alignment', true );
		$team_manager_free_biography_option = get_post_meta( $post->ID, 'team_manager_free_biography_option', true );
		$team_manager_free_header_font_size = get_post_meta( $post->ID, 'team_manager_free_header_font_size', true );
		$team_manager_free_header_font_color = get_post_meta( $post->ID, 'team_manager_free_header_font_color', true );
		$team_manager_free_header_font_hover_color = get_post_meta( $post->ID, 'team_manager_free_header_font_hover_color', true );
		$team_manager_free_biography_font_size = get_post_meta( $post->ID, 'team_manager_free_biography_font_size', true );
		$team_manager_free_biography_font_color = get_post_meta( $post->ID, 'team_manager_free_biography_font_color', true );
		?>

		<div id="sortable">
		<?php
		$c = 0;
		if ( is_array( $ourwork ) ) {
			foreach( $ourwork as  $track ) {
				if ( isset( $track['client-link1'] ) || isset( $track['client-desc'] ) || isset( $track['client-images'] ) || isset( $track['client-fa'] ) || isset( $track['client-tw'] ) || isset( $track['client-dw'] ) || isset( $track['client-designation'] )) {
					printf( '<div class="team_manager_fr" id="">
						<div class="left_side">
							<div class="single_items">Name<br/><input type="text" name="ourwork[%1$s][client-link1]" value="%2$s" size="31" /></div>
							<div class="single_items">Job Title<br/><input type="text" name="ourwork[%1$s][client-designation]" value="%4$s" size="31" />
							</div>
							<div class="single_items">Member Picture Url<br/><input type="text" required name="ourwork[%1$s][client-images]" value="%3$s" size="31" /></div>
							<div class="single_description">Description<br/><textarea id="elm1" class="tinymce_data" name="ourwork[%1$s][client-desc]" cols="51" rows="5" >%5$s</textarea></div>
							<div class="social_single_items"><i class="fa fa-facebook"></i><input type="text" name="ourwork[%1$s][client-fa]" value="%6$s" size="7" /></div>
							<div class="social_single_items"><i class="fa fa-twitter"></i><input type="text" name="ourwork[%1$s][client-tw]" value="%7$s" size="7" /></div>
							<div class="social_single_items"><i class="fa fa-dribbble"></i><input type="text" name="ourwork[%1$s][client-dw]" value="%8$s" size="7" /></div>
							</div>
							<div class="right_side">
							<div class="client_thumb"><img src="'.$track['client-images'].'" alt="" /></div>
							<div class="client_name"><span>'.$track['client-link1'].'</span><br/><span>'.$track['client-designation'].'</span></div>
							</div><span class="remove">%9$s</span></div>', $c, $track['client-link1'], $track['client-images'], $track['client-designation'], $track['client-desc'], $track['client-fa'], $track['client-tw'], $track['client-dw'], __( '<span class="button"><i class="fa fa-trash"></i></span>' ) );
					$c = $c +1;
				}
			}
		}
		?>
		</div>
		<?php
		?>
		<span id="here"></span>
		<span class="add"><?php _e('<span class="button">Add Member</span>'); ?></span>
		<script>
		jQuery(document).ready(function($) {
			var count = <?php echo $c; ?>;	
			
			$('.add').click(function() {
				count = count + 1;
					$('#here').append('<div class="team_manager_fr" id="sortable"><div class="left_side_input"><div class="single_items_inp">Name<br><input required type="text" name="ourwork['+count+'][client-link1]" value="" size="31"/></div><div class="single_items_inp">Job Title<br/><input required type="text" name="ourwork['+count+'][client-designation]" value="" size="31"/></div><div class="single_items_inp">Member Picture Url<br/><input required type="text" name="ourwork['+count+'][client-images]" value="" size="31"/></div></div><div class="single_description">Description<br/><textarea id="elm1" name="ourwork['+count+'][client-desc]" cols="77" rows="4"></textarea></div><br/><div class="social_single_items"><i class="fa fa-facebook"></i><input type="text" name="ourwork['+count+'][client-fa]" value="" size="14"/></div><div class="social_single_items"><i class="fa fa-twitter"></i><input type="text" name="ourwork['+count+'][client-tw]" value="" size="14"/></div><div class="social_single_items"><i class="fa fa-dribbble"></i><input type="text" name="ourwork['+count+'][client-dw]" value="" size="14"/></div>          <br/><span class="remove"><span class="button"><i class="fa fa-trash"></i></span></span></div>').slideDown('slow');
				return false;
			});
		});
		
		</script>
		<div class="team-manager-free-shortcodes">
			<h2><?php _e('Shortcodes', 'team-manager-free');?></h2>
			<p><?php _e('Use following shortcode to display the Team Manager anywhere:', 'team-manager-free');?></p>
			<textarea cols="30" rows="1" onClick="this.select();">[tmfshortcode <?php echo 'id="'.$post->ID.'"';?>]</textarea>
			
			<p><?php _e('If you need to put the shortcode in theme file use this:', 'team-manager-free');?></p>            
			<textarea cols="54" rows="1" onClick="this.select();"><?php echo '<?php echo do_shortcode("[tmfshortcode id='; echo "'".$post->ID."']"; echo '");?>';?></textarea>
		
		</div>
		
		</div>
		</div>
		<div id="tab-2" class="tab-content">
			<div class="wrap">
				<table class="form-table">
				<tr valign="top">
					<th scope="row"><label style="padding-left:10px;" for="team_manager_free_post_themes"><?php echo __('Themes:', 'team-manager-free'); ?></label></th>
					<td style="vertical-align:middle;">
						<select class="timezone_string" name="team_manager_free_post_themes">
							<option value="theme1" <?php if($team_manager_free_post_themes=='theme1') echo "selected"; ?> ><?php _e('Default', 'team-manager-free')?></option>
							<option value="theme2" <?php if($team_manager_free_post_themes=='theme2') echo "selected"; ?> ><?php _e('Theme 2', 'team-manager-free')?></option>
							<option value="theme3" <?php if($team_manager_free_post_themes=='theme3') echo "selected"; ?> ><?php _e('Theme 3', 'team-manager-free')?></option>
							<option value="theme4" <?php if($team_manager_free_post_themes=='theme4') echo "selected"; ?> ><?php _e('Theme 4', 'team-manager-free')?></option>
						</select><br/>
					<span class="team_manager_hint"><?php echo __('Select Team Manager Themes.', 'team-manager-free'); ?></span>	
					</td>
				</tr> 
				<tr valign="top">
					<th scope="row"><label style="padding-left:10px;" for="team_manager_free_post_column"><?php echo __('Team Column:', 'team-manager-free'); ?></label></th>
					<td style="vertical-align:middle;">
					<select class="timezone_string" name="team_manager_free_post_column">
						<option value="two_column" <?php if($team_manager_free_post_column=='two_column') echo "selected"; ?> ><?php _e('2 Column', 'team-manager-free')?></option>
						<option value="three_column" <?php if($team_manager_free_post_column=='three_column') echo "selected"; ?> ><?php _e('3 Column', 'team-manager-free')?></option>			
					</select>
					<span class="team_manager_hint"><?php echo __('Select Team Manager Column.', 'team-manager-free'); ?></span>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label style="padding-left:10px;" for="team_manager_free_header_font_size"><?php echo __('Name Font Size:', 'team-manager-free'); ?></label></th>
					<td style="vertical-align:middle;">
					<select class="timezone_string" name="team_manager_free_header_font_size">
						<option value="12" <?php if($team_manager_free_header_font_size=='12') echo "selected"; ?> ><?php _e('12px', 'team-manager-free')?></option>
						<option value="13" <?php if($team_manager_free_header_font_size=='13') echo "selected"; ?> ><?php _e('13px', 'team-manager-free')?></option>
						<option value="14" <?php if($team_manager_free_header_font_size=='14') echo "selected"; ?> ><?php _e('14px', 'team-manager-free')?></option>			
						<option value="15" <?php if($team_manager_free_header_font_size=='15') echo "selected"; ?> ><?php _e('15px', 'team-manager-free')?></option>	
						<option value="16" <?php if($team_manager_free_header_font_size=='16') echo "selected"; ?> ><?php _e('16px', 'team-manager-free')?></option>
						<option value="17" <?php if($team_manager_free_header_font_size=='17') echo "selected"; ?> ><?php _e('17px', 'team-manager-free')?></option>
						<option value="18" <?php if($team_manager_free_header_font_size=='18') echo "selected"; ?> ><?php _e('18px', 'team-manager-free')?></option>			
						<option value="19" <?php if($team_manager_free_header_font_size=='19') echo "selected"; ?> ><?php _e('19px', 'team-manager-free')?></option>			
						<option value="20" <?php if($team_manager_free_header_font_size=='20') echo "selected"; ?> ><?php _e('20px', 'team-manager-free')?></option>			
						<option value="21" <?php if($team_manager_free_header_font_size=='21') echo "selected"; ?> ><?php _e('21px', 'team-manager-free')?></option>			
						<option value="22" <?php if($team_manager_free_header_font_size=='22') echo "selected"; ?> ><?php _e('22px', 'team-manager-free')?></option>			
					</select>
					<span class="team_manager_hint"><?php echo __('Select Team Manager Name Font Size.', 'team-manager-free'); ?></span>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label style="padding-left:10px;" for="team_manager_free_biography_option"><?php echo __('Biography:', 'team-manager-free'); ?></label></th>
					<td style="vertical-align:middle;">
					<select class="timezone_string" name="team_manager_free_biography_option">
						<option value="block" <?php if($team_manager_free_biography_option=='block') echo "selected"; ?> ><?php _e('Show', 'team-manager-free')?></option>
						<option value="none" <?php if($team_manager_free_biography_option=='none') echo "selected"; ?> ><?php _e('Hide', 'team-manager-free')?></option>		
					</select>
					<span class="team_manager_hint"><?php echo __('Show/Hide Team Member Biography.', 'team-manager-free'); ?></span>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label style="padding-left:10px;" for="team_manager_free_biography_font_size"><?php echo __('Biography Font Size:', 'team-manager-free'); ?></label></th>
					<td style="vertical-align:middle;">
					<select class="timezone_string" name="team_manager_free_biography_font_size">
						<option value="12" <?php if($team_manager_free_biography_font_size=='12') echo "selected"; ?> ><?php _e('12px', 'team-manager-free')?></option>
						<option value="13" <?php if($team_manager_free_biography_font_size=='13') echo "selected"; ?> ><?php _e('13px', 'team-manager-free')?></option>
						<option value="14" <?php if($team_manager_free_biography_font_size=='14') echo "selected"; ?> ><?php _e('14px', 'team-manager-free')?></option>			
						<option value="15" <?php if($team_manager_free_biography_font_size=='15') echo "selected"; ?> ><?php _e('15px', 'team-manager-free')?></option>	
						<option value="16" <?php if($team_manager_free_biography_font_size=='16') echo "selected"; ?> ><?php _e('16px', 'team-manager-free')?></option>
						<option value="17" <?php if($team_manager_free_biography_font_size=='17') echo "selected"; ?> ><?php _e('17px', 'team-manager-free')?></option>
						<option value="18" <?php if($team_manager_free_biography_font_size=='18') echo "selected"; ?> ><?php _e('18px', 'team-manager-free')?></option>			
						<option value="19" <?php if($team_manager_free_biography_font_size=='19') echo "selected"; ?> ><?php _e('19px', 'team-manager-free')?></option>			
						<option value="20" <?php if($team_manager_free_biography_font_size=='20') echo "selected"; ?> ><?php _e('20px', 'team-manager-free')?></option>			
						<option value="21" <?php if($team_manager_free_biography_font_size=='21') echo "selected"; ?> ><?php _e('21px', 'team-manager-free')?></option>			
						<option value="22" <?php if($team_manager_free_biography_font_size=='22') echo "selected"; ?> ><?php _e('22px', 'team-manager-free')?></option>			
					</select>
					<span class="team_manager_hint"><?php echo __('Select Team Manager Biography Font Size.', 'team-manager-free'); ?></span>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label style="padding-left:10px;" for="team_manager_free_text_alignment"><?php echo __('Biography Text Alignment:', 'team-manager-free'); ?></label></th>
					<td style="vertical-align:middle;">
					<select class="timezone_string" name="team_manager_free_text_alignment">
						<option value="left" <?php if($team_manager_free_text_alignment=='left') echo "selected"; ?> ><?php _e('Left', 'team-manager-free')?></option>
						<option value="center" <?php if($team_manager_free_text_alignment=='center') echo "selected"; ?> ><?php _e('Center', 'team-manager-free')?></option>			
						<option value="right" <?php if($team_manager_free_text_alignment=='right') echo "selected"; ?> ><?php _e('Right', 'team-manager-free')?></option>			
					</select>
					<span class="team_manager_hint"><?php echo __('Text Alignment.', 'team-manager-free'); ?></span>					
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label style="padding-left:10px;" for="team_manager_free_social_target"><?php echo __('Open Social Media Link:', 'team-manager-free'); ?></label></th>
					<td style="vertical-align:middle;">
					<select class="timezone_string" name="team_manager_free_social_target">
						<option value="_self" <?php if($team_manager_free_social_target=='_self') echo "selected"; ?> ><?php _e('_Self', 'team-manager-free')?></option>
						<option value="_blank" <?php if($team_manager_free_social_target=='_blank') echo "selected"; ?> ><?php _e('_Blank', 'team-manager-free')?></option>			
					</select>
					<span class="team_manager_hint"><?php echo __('Open Social Media Target Link.', 'team-manager-free'); ?></span>					
					</td>
				</tr>
				
				</table>		
			</div>
		
		</div>
		<div id="tab-3" class="tab-content">
			<div class="wrap">
				<table class="form-table">
				<tr valign="top">
					<th scope="row"><label style="padding-left:10px;" for="team_manager_free_header_font_color"><?php echo __('Name Font Color:', 'team-manager-free'); ?></label></th>
					<td style="vertical-align:middle;">
						<input  size='10' name='team_manager_free_header_font_color' class='team-manager-free-header-font-color' type='text' id="team_manager_free_header_font_color" value='<?php echo $team_manager_free_header_font_color; ?>' /><br>
						<span class="team_manager_hint"><?php echo __('Select Team Manager Name Font Color.', 'team-manager-free'); ?></span>
					</td>
				</tr>			
				<tr valign="top">
					<th scope="row"><label style="padding-left:10px;" for="team_manager_free_biography_font_color"><?php echo __('Biography Font Color:', 'team-manager-free'); ?></label></th>
					<td style="vertical-align:middle;">
						<input  size='10' name='team_manager_free_biography_font_color' class='team_manager_free_biography-font-color' type='text' id="team_manager_free_biography_font_color" value='<?php echo $team_manager_free_biography_font_color; ?>' /><br>
						<span class="team_manager_hint"><?php echo __('Select Team Manager Biography Font Color.', 'team-manager-free'); ?></span>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label style="padding-left:10px;" for="team_manager_free_header_font_hover_color"><?php echo __('Hover BG Color:', 'team-manager-free'); ?></label></th>
					<td style="vertical-align:middle;">
						<input  size='10' name='team_manager_free_header_font_hover_color' class='team_manager-free_header-font-hover-color' type='text' id="team_manager_free_header_font_hover_color" value='<?php echo $team_manager_free_header_font_hover_color; ?>' /><br>
						<span class="team_manager_hint"><?php echo __('Select Team Manager Background Hover Color.', 'team-manager-free'); ?></span>
					</td>
				</tr>	
				</table>
			</div>
		</div>
		
		<script type="text/javascript">
		jQuery(document).ready(function(jQuery)
			{	
			jQuery('#team_manager_free_header_font_color,#team_manager_free_header_font_hover_color,#team_manager_free_biography_font_color').wpColorPicker();
			});
		</script> 			
		
	</div>
	</div>
	<?php
	}		
		
		
	/**
	 * Saves the notice for the given post.
	 *
	 * @params	$post_id	The ID of the post that we're serializing
	 */
	function save_notice( $post_id ) {

    // verify if this is an auto save routine. 
    // If it is our form has not been submitted, so we dont want to do anything
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
        return $post_id;

    // verify this came from the our screen and with proper authorization,
    // because save_post can be triggered at other times
    if ( !isset( $_POST['dynamicMeta_noncename'] ) )
        return;

    if ( !wp_verify_nonce( $_POST['dynamicMeta_noncename'], plugin_basename( __FILE__ ) ) )
        return;

    // OK, we're authenticated: we need to find and save the data
	$team_manager_free_post_themes = sanitize_text_field( $_POST['team_manager_free_post_themes'] );
	$team_manager_free_post_column = sanitize_text_field( $_POST['team_manager_free_post_column'] );
	$team_manager_free_social_target = sanitize_text_field( $_POST['team_manager_free_social_target'] );
	$team_manager_free_text_alignment = sanitize_text_field( $_POST['team_manager_free_text_alignment'] );
	$team_manager_free_biography_option = sanitize_text_field( $_POST['team_manager_free_biography_option'] );
	$team_manager_free_header_font_size = sanitize_text_field( $_POST['team_manager_free_header_font_size'] );
	$team_manager_free_header_font_color = sanitize_text_field( $_POST['team_manager_free_header_font_color'] );
	$team_manager_free_header_font_hover_color = sanitize_text_field( $_POST['team_manager_free_header_font_hover_color'] );
	$team_manager_free_biography_font_size = sanitize_text_field( $_POST['team_manager_free_biography_font_size'] );
	$team_manager_free_biography_font_color = sanitize_text_field( $_POST['team_manager_free_biography_font_color'] );
 
	
    $ourwork = stripslashes_deep($_POST['ourwork']);

    update_post_meta($post_id,'ourwork',$ourwork);
	update_post_meta( $post_id, 'team_manager_free_post_themes', $team_manager_free_post_themes );
	update_post_meta( $post_id, 'team_manager_free_post_column', $team_manager_free_post_column );
	update_post_meta( $post_id, 'team_manager_free_social_target', $team_manager_free_social_target );
	update_post_meta( $post_id, 'team_manager_free_text_alignment', $team_manager_free_text_alignment );
	update_post_meta( $post_id, 'team_manager_free_biography_option', $team_manager_free_biography_option );
	update_post_meta( $post_id, 'team_manager_free_header_font_size', $team_manager_free_header_font_size );
	update_post_meta( $post_id, 'team_manager_free_header_font_color', $team_manager_free_header_font_color );
	update_post_meta( $post_id, 'team_manager_free_header_font_hover_color', $team_manager_free_header_font_hover_color );
	update_post_meta( $post_id, 'team_manager_free_biography_font_size', $team_manager_free_biography_font_size );
	update_post_meta( $post_id, 'team_manager_free_biography_font_color', $team_manager_free_biography_font_color );

	} // end save_notice		
		
	add_action('save_post', 'save_notice');
	
























	
	/**
	 * Register admin menu page.
	 *
	 * @since    1.0.0
	 */	
	function team_manager_free_submenu_pages() {
		
		add_submenu_page( 'edit.php?post_type=team_mf', __('Support', 'team-manager-free'), __('Support', 'team-manager-free'), 'manage_options', 'support', 'team_manager_free_support_callback' );		
	}	 

	

	function team_manager_free_support_callback() { 
		require_once(plugin_dir_path(__FILE__).'team-manager-free-support.php');
	}			
		
add_action('admin_menu', 'team_manager_free_submenu_pages');

?>