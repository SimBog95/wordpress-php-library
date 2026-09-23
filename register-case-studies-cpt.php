/**
 * Case Studies custom post type, with Categories and Tags, Elementor-ready.
 * Add this block to your child theme's functions.php
 */

// Register the Case Studies post type.
function ggc_register_case_study_post_type() {

	$labels = array(
		'name'                  => 'Case Studies',
		'singular_name'         => 'Case Study',
		'menu_name'             => 'Case Studies',
		'name_admin_bar'        => 'Case Study',
		'add_new'               => 'Add New',
		'add_new_item'          => 'Add New Case Study',
		'new_item'              => 'New Case Study',
		'edit_item'             => 'Edit Case Study',
		'view_item'             => 'View Case Study',
		'all_items'             => 'All Case Studies',
		'search_items'          => 'Search Case Studies',
		'not_found'             => 'No case studies found.',
		'not_found_in_trash'    => 'No case studies found in Trash.',
		'featured_image'        => 'Case Study Image',
		'set_featured_image'    => 'Set case study image',
		'remove_featured_image' => 'Remove case study image',
		'use_featured_image'    => 'Use as case study image',
		'archives'              => 'Case Study Archives',
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'show_in_nav_menus'  => true,
		'show_in_admin_bar'  => true,
		'show_in_rest'       => true, // Needed for Elementor / Gutenberg editing.
		'menu_position'      => 5,
		'menu_icon'          => 'dashicons-portfolio',
		'query_var'          => true,
		// Individual case studies still live under /case-studies/your-post-name/
		'rewrite'            => array( 'slug' => 'case-studies', 'with_front' => false ),
		'capability_type'    => 'post',
		// The auto-generated archive (list of all case studies) lives at /our-work/ instead,
		// so your Elementor "Case Studies" Page can own /case-studies/ without a conflict.
		'has_archive'        => 'our-work',
		'hierarchical'       => false,
		'supports'           => array(
			'title',
			'editor',
			'author',
			'thumbnail',
			'excerpt',
			'custom-fields',
			'revisions',
			'page-attributes',
		),
	);

	register_post_type( 'case_study', $args );
}
add_action( 'init', 'ggc_register_case_study_post_type' );

// Register a Categories taxonomy for Case Studies.
function ggc_register_case_study_category_taxonomy() {

	$labels = array(
		'name'              => 'Case Study Categories',
		'singular_name'     => 'Case Study Category',
		'search_items'      => 'Search Categories',
		'all_items'         => 'All Categories',
		'parent_item'       => 'Parent Category',
		'parent_item_colon' => 'Parent Category:',
		'edit_item'         => 'Edit Category',
		'update_item'       => 'Update Category',
		'add_new_item'      => 'Add New Category',
		'new_item_name'     => 'New Category Name',
		'menu_name'         => 'Categories',
	);

	register_taxonomy(
		'case_study_category',
		array( 'case_study' ),
		array(
			'hierarchical'      => true, // Behaves like the standard Category taxonomy.
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_rest'      => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'case-study-category' ),
		)
	);
}
add_action( 'init', 'ggc_register_case_study_category_taxonomy' );

// Register a Tags taxonomy for Case Studies.
function ggc_register_case_study_tag_taxonomy() {

	$labels = array(
		'name'                       => 'Case Study Tags',
		'singular_name'              => 'Case Study Tag',
		'search_items'               => 'Search Tags',
		'popular_items'              => 'Popular Tags',
		'all_items'                  => 'All Tags',
		'edit_item'                  => 'Edit Tag',
		'update_item'                => 'Update Tag',
		'add_new_item'               => 'Add New Tag',
		'new_item_name'              => 'New Tag Name',
		'separate_items_with_commas' => 'Separate tags with commas',
		'choose_from_most_used'      => 'Choose from the most used tags',
		'menu_name'                  => 'Tags',
	);

	register_taxonomy(
		'case_study_tag',
		array( 'case_study' ),
		array(
			'hierarchical'          => false, // Behaves like the standard Post Tag taxonomy.
			'labels'                => $labels,
			'show_ui'               => true,
			'show_admin_column'     => true,
			'show_in_rest'          => true,
			'query_var'             => true,
			'rewrite'               => array( 'slug' => 'case-study-tag' ),
			'update_count_callback' => '_update_post_term_count',
		)
	);
}
add_action( 'init', 'ggc_register_case_study_tag_taxonomy' );

// Tell Elementor to treat Case Studies like a normal editable post type.
function ggc_add_case_study_elementor_support() {
	add_post_type_support( 'case_study', 'elementor' );
}
add_action( 'init', 'ggc_add_case_study_elementor_support', 20 );
