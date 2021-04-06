<?php

// Two Sisters Bakery Admin Customizations

// Remove Dashboard Widgets
function wporg_remove_all_dashboard_metaboxes() {
    // Remove Welcome panel
    remove_action( 'welcome_panel', 'wp_welcome_panel' );
    // Remove the rest of the dashboard widgets
    remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
    remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
    remove_meta_box( 'health_check_status', 'dashboard', 'normal' );
    remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_activity', 'dashboard', 'normal');
	remove_meta_box( 'dashboard_site_health', 'dashboard', 'normal');
}
add_action( 'wp_dashboard_setup', 'wporg_remove_all_dashboard_metaboxes' );

// Remove Yoast Widget
function remove_wpseo_dashboard_overview() {
  // In some cases, you may need to replace 'side' with 'normal' or 'advanced'.
  remove_meta_box( 'wpseo-dashboard-overview', 'dashboard', 'normal' );
}
add_action('wp_dashboard_setup', 'remove_wpseo_dashboard_overview' );

/**
 * Add a widget to the dashboard.
 *
 * This function is hooked into the 'wp_dashboard_setup' action below.
 */
function wporg_add_dashboard_widgets() {
    wp_add_dashboard_widget(
        'wporg_dashboard_widget',                          // Widget slug.
        esc_html__( 'Welcome to the Two Sisters Bakery Dashboard', 'wporg' ), // Title.
        'wporg_dashboard_widget_render'                    // Display function.
    ); 
    // Globalize the metaboxes array, this holds all the widgets for wp-admin.
    global $wp_meta_boxes;
     
    // Get the regular dashboard widgets array 
    // (which already has our new widget but appended at the end).
    $default_dashboard = $wp_meta_boxes['dashboard']['normal']['core'];
     
    // Backup and delete our new dashboard widget from the end of the array.
    $example_widget_backup = array( 'example_dashboard_widget' => $default_dashboard['example_dashboard_widget'] );
    unset( $default_dashboard['example_dashboard_widget'] );
  
    // Merge the two arrays together so our widget is at the beginning.
    $sorted_dashboard = array_merge( $example_widget_backup, $default_dashboard );
  
    // Save the sorted array back into the original metaboxes. 
    $wp_meta_boxes['dashboard']['normal']['core'] = $sorted_dashboard;
}
add_action( 'wp_dashboard_setup', 'wporg_add_dashboard_widgets' );
 
/**
 * Create the function to output the content of our Dashboard Widget.
 */
//Display the message to go in the welcome dashboard widget

function wporg_dashboard_widget_render() { ?>   
     <h3><strong>View tutorials:</strong></h3>
    <ul> 
        <li><a href="<?php echo get_template_directory_uri() ?>/pdfs/adding-products-to-site.pdf" target="_blank">Add products </a> </li>
        <li><a href="<?php echo get_template_directory_uri() ?>/pdfs/slick-slider.pdf" target="_blank">Edit the slick-slider</a> </li>
        <li><a href="<?php echo get_template_directory_uri() ?>/how-to/how-to-add-media-files.webm" target="_blank">Video: How to add media files</a> </li>
        <li><a href="<?php echo get_template_directory_uri() ?>/how-to/how-to-add-products.webm" target="_blank">Video: How to add products</a> </li>
        <li><a href="<?php echo get_template_directory_uri() ?>/how-to/how-to-add-shipping-zone.webm" target="_blank">Video: How to add shipping zone</a> </li>
        <li><a href="<?php echo get_template_directory_uri() ?>/how-to/how-to-delete-product.webm" target="_blank">Video: How to delete a product</a> </li>    
        <li><a href="<?php echo get_template_directory_uri() ?>/how-to/how-to-log-in.webm" target="_blank">Video: How to log in </a> </li>
        <li><a href="<?php echo get_template_directory_uri() ?>/how-to/how-to-update-page-content.webm" target="_blank">Video: How to update page content</a> </li>    
   
    </ul> 

    <?php 
}

 // Remove admin menu links for non-Administrator accounts
 function twd_remove_admin_links() {
     if ( !current_user_can( 'manage_options' ) ) {
         remove_menu_page( 'edit.php' );           // Remove Posts link
             remove_menu_page( 'edit-comments.php' );   // Remove Comments link
     }
 }
 add_action( 'admin_menu', 'twd_remove_admin_links' ); 

  /**
  * Reorder Menu Items
  */
function custom_menu_order($menu_ord) {
     if( !$menu_ord) return true;
        if ( !current_user_can( 'manage_options' ) ) {
        return array(
            'index.php', // Dashboard link
            'edit.php', // Post admin menu
            'upload.php', // Media
            'themes.php',
            'plugins.php',
            'users.php',
            'tools.php',
            'edit.php?post_type=slick_slider',
        );
    }else{
        return $menu_ord;
    }

 }
add_filter('custom_menu_order', 'custom_menu_order');
add_filter('menu_order', 'custom_menu_order');
