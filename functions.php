// functions.php in your current theme 
// add this code there

//Register Custom Post Type
  
function experts() {

	$labels = array(
		'name'                  => _x( 'Experts', 'Post Type General Name' ),
		'singular_name'         => _x( 'Expert', 'Post Type Singular Name' ),
		'menu_name'             => __( 'Experts' ),
		'name_admin_bar'        => __( 'Experts' ),
		'archives'              => __( 'Expert Archives' ),
		'parent_item_colon'     => __( 'Parent Expert:' ),
		'all_items'             => __( 'All Experts' ),
		'add_new_item'          => __( 'Add New Expert' ),
		'add_new'               => __( 'Add New' ),
		'new_item'              => __( 'New Expert' ),
		'edit_item'             => __( 'Edit Expert' ),
		'update_item'           => __( 'Update Expert' ),
		'view_item'             => __( 'View Expert' ),
		'search_items'          => __( 'Search Expert' ),
		'not_found'             => __( 'Not found' ),
		'not_found_in_trash'    => __( 'Not found in Trash' ),
		'featured_image'        => __( 'Experts Image' ),
		'set_featured_image'    => __( 'Set experts image' ),
		'remove_featured_image' => __( 'Remove experts image' ),
		'use_featured_image'    => __( 'Use as experts image' ),
		'insert_into_item'      => __( 'Insert into expert' ),
		'uploaded_to_this_item' => __( 'Uploaded to this expert' ),
		'items_list'            => __( 'Experts list' ),
		'items_list_navigation' => __( 'Experts list navigation' ),
		'filter_items_list'     => __( 'Filter experts list' ),
	);
	$args = array(
		'label'                 => __( 'Expert' ),
		'description'           => __( 'Experts' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail', ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 25,
		'menu_icon'             => 'dashicons-businessman',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
	);
	register_post_type( 'experts', $args );
    
}
add_action( 'init', 'experts', 0 );
function my_acf_init() {
    acf_update_setting('google_api_key', 'AIzaSyAxhrKP2nTR9aE-FRMMQ-GQ-03FthtEcaI');
}
add_action('acf/init', 'my_acf_init');

function google_maps_scripts() {
    if (!is_admin()) {
        wp_register_script('googlemapsapi', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyAxhrKP2nTR9aE-FRMMQ-GQ-03FthtEcaI&callback', array(), '', false);
        wp_enqueue_script('googlemapsapi');
        
        wp_register_script('gmaps-init', get_stylesheet_directory_uri().'/js/gmaps.js', array(), '', false);
        wp_enqueue_script('gmaps-init');
    } 
  }
  
  add_action('wp_enqueue_scripts', 'google_maps_scripts', 100);

function expertsMapKey($api) 
{
    $api['key'] = 'AIzaSyAxhrKP2nTR9aE-FRMMQ-GQ-03FthtEcaI';
    return $api;
}

add_filter('acf/fields/google_map/api', 'expertsMapKey');
