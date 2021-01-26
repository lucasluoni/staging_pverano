<?php
/****************************************************************************
1.Theme setup
****************************************************************************/

function mikka_theme_setup() {
	
	// 1.1.Make theme available for translation.*/
	// load_theme_textdomain( 'mikka', get_stylesheet_directory() . '/languages' );
	
	
	// 1.2.post formats
	add_theme_support( 'post_formats' );
	
	// 1.3.Enable support for Post Thumbnails on posts and pages
	add_theme_support( 
		'post-thumbnails', 
			array( 
				'post', 
				'page' 
	));
	
	// 1.4.add_image_size( 'rosane_franco-featured-image', 2000, 1200, true );
	add_image_size( 'mikka-thumbnail-avatar', 100, 100, true );

	
	// 1.5.Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );
	
	// 1.6.title tags
	add_theme_support( 'title-tag' );
	
	// 1.7.This theme uses wp_nav_menu() in two locations
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'mikka' ),
		'social' => __( 'Social Links Menu', 'mikka' ),
		
	) );
	
	// 1.8.Switch default core markup for search form, comment form, and comments to output valid HTML5.
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		)
	);

	// 1.9.Enable support for Post Formats.
	// See: https://codex.wordpress.org/Post_Formats
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'audio',
	) );
	
	// 1.10.Default to a static front page and assign the front and posts pages.
	$starter_content = array(
		'options' => array(
			'show_on_front' => 'page',
			'page_on_front' => '{{home}}',
			'page_for_posts' => '{{blog}}',
				),


	// 1.11.Assign a menu to the "social" location.
	'social' => array(
		'name' => __( 'Social Links Menu', 'twentyseventeen' ),
		'items' => array(
			'link_facebook',
			'link_twitter',
			'link_instagram',
			'link_vimeo',
			'link_linkedin'
		),
	),
	
	);	
		

}

add_action( 'after_setup_theme', 'mikka_theme_setup' );

require get_template_directory() . '/bootstrap-navwalker-master/bootstrap-navwalker.php';


/****************************************************************************
2.Filtra o comprimento to the_exercpt para 13 palavras (aprox. 2 linhas)
****************************************************************************/

/**
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function wpdocs_custom_excerpt_length( $length ) {
    return 12;
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 9 );


/****************************************************************************
3. Adiciona as open graph tags no Header
****************************************************************************/

function add_opengraph_doctype( $output ) {
        return $output . ' xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml"';
    }
add_filter('language_attributes', 'add_opengraph_doctype');
 
//Lets add Open Graph Meta Info
 
function insert_fb_in_head() {
    global $post;
    if ( !is_singular()) //if it is not a post or a page
        return;
        echo '<meta property="fb:admins" content="paulaveranoarquitetura"/>';
        echo '<meta property="og:title" content="' . get_the_title() . '"/>';
        echo '<meta property="og:type" content="article"/>';
        echo '<meta property="og:url" content="' . get_permalink() . '"/>';
        echo '<meta property="og:site_name" content="Portfolio da Paula Verano"/>';
    if(!has_post_thumbnail( $post->ID )) { //the post does not have featured image, use a default image
        $default_image = get_template_directory_uri() . '/images/marca-paula-verano.png'; //replace this with a default image on your server or an image in your media library
        echo '<meta property="og:image" content="' . $default_image . '"/>';
    }
    else{
        $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
        echo '<meta property="og:image" content="' . esc_attr( $thumbnail_src[0] ) . '"/>';
    }
    echo "
";
}
add_action( 'wp_head', 'insert_fb_in_head', 5 );

// function add_twitter_cards() {
//     global $post;
//     if ( !is_singular()) //if it is not a post or a page
//         return;
//         echo '<meta name="twitter:card" value="summary" />';
//         echo '<meta name="twitter:site" value="@rosane_franco" />';
//         echo '<meta name="twitter:title" value="' . get_the_title() . '"/>';
//         // echo '<meta name="twitter:description" value="' . bloginfo('description') . '"/>';
//         echo '<meta name="twitter:description" value="Portfolio de Rosane Franco" />';
//         echo '<meta name="twitter:url" value="' . get_permalink() . '"/>';
//     if(!has_post_thumbnail( $post->ID )) { //the post does not have featured image, use a default image
//         $tc_image=get_template_directory_uri() . '/images/logo_header.png'; //replace this with a default image on your server or an image in your media library
//         echo '<meta name="twitter:image" value="' . $tc_image . '"/>';
//     }
//     else{
//         $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
//         echo '<meta property="og:image" content="' . esc_attr( $thumbnail[0] ) . '"/>';
//     }
//     echo "
// ";
// }
// add_action( 'wp_head', 'add_twitter_cards', 5 );


/****************************************************************************
4.Registra: Popper; Bootstrap CSS; JQuery; Font-Awesome; JSocials; 
Estilos do site (style.css); Image-Grid (CSS); Google Fonts; Bootstrap JS
****************************************************************************/

function wpt_register_popper() {
    wp_register_script('popper.min.js', get_template_directory_uri() . '/js/popper.min.js', 'jquery', 'false', true);
    wp_enqueue_script('popper.min.js');
}
add_action('wp_enqueue_scripts', 'wpt_register_popper');

function wpt_register_bootstrap_css() {
    wp_register_style('bootstrap.min', get_template_directory_uri() . '/bootstrap-4.1.3-dist/css/bootstrap.min.css');
    wp_enqueue_style('bootstrap.min');
}
add_action( 'wp_enqueue_scripts', 'wpt_register_bootstrap_css' );

//include jquery to load more in loop-blog.php (blog/novidades) 
function register_rosane_franco_jquery() {
    wp_register_script('jquery-3.4.1.min', get_template_directory_uri() . '/js/jquery-3.4.1.min.js', 'jquery', 'false', true);
    wp_enqueue_script('jquery-3.4.1.min');
}
add_action('wp_enqueue_scripts', 'register_rosane_franco_jquery');

function register_css() {
	wp_register_style('style', get_template_directory_uri() . '/style.css');
	wp_enqueue_style('style');
}
add_action('wp_enqueue_scripts', 'register_css');	

function wpt_register_js() {
    wp_register_script('jquery.bootstrap.min', get_template_directory_uri() . '/bootstrap-4.1.3-dist/js/bootstrap.min.js', 'jquery', 'false', true);
    wp_enqueue_script('jquery.bootstrap.min');
}
add_action( 'wp_enqueue_scripts', 'wpt_register_js' );

function register_numscroller() {
    wp_register_script('numscroller-1.0', get_template_directory_uri() . '/js/numscroller-1.0.js', 'jquery', 'false', true);
    wp_enqueue_script('numscroller-1.0');
}
add_action( 'wp_enqueue_scripts', 'register_numscroller' );

function font_awesome_styles() {
    wp_register_style('font-awesome.min', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('font-awesome.min');
}
add_action( 'wp_enqueue_scripts', 'font_awesome_styles' );

function register_sharethis_scripts() {
    // wp_register_script( 'sharethis', 'https://platform-api.sharethis.com/js/sharethis.js#property=5eb417c2b892d40012e34568&product=inline-share-buttons async="async"', 'jquery', 'false', true);
    wp_register_script( 'sharethis', 'https://platform-api.sharethis.com/js/sharethis.js#property=5eb417c2b892d40012e34568&product=inline-share-buttons async="async"', 'jquery', 'false', true);
    wp_enqueue_script( 'sharethis');
}
add_action( 'wp_enqueue_scripts', 'register_sharethis_scripts' );

https://platform-api.sharethis.com/js/sharethis.js?ver=5.4.2#property=580918c33fb8410011bc7250&product=unknown-buttons

/****************************************************************************
5.Botão Load More Posts na Home (loop-front-page.php)
****************************************************************************/
//USe wp_ajax & wp_ajax_nopriv to enable ajax action "load_posts_by_ajax"
//With this defined, we can request on the javascript side the action "load_posts_by_ajax"

add_action('wp_ajax_load_posts_home_by_ajax', 'load_posts_home_by_ajax_callback');
add_action('wp_ajax_nopriv_load_posts_home_by_ajax', 'load_posts_home_by_ajax_callback');

function load_posts_home_by_ajax_callback() {

    check_ajax_referer('load_more_posts', 'security');
    $paged = $_POST['page'];
    $args = array(
        'post_type' => 'post',
        // 'cat' => -38,
        'post_status' => 'publish',
        'posts_per_page' => '3',
        'order' => 'DESC',
        'paged' => $paged,
    );
    $my_post
	?>

	<?php
	    $my_posts = new WP_Query( $args );
	    if ( $my_posts->have_posts() ) : 
	    while ( $my_posts->have_posts() ) : $my_posts->the_post()               
	?>

    <?php $post_meta_data = get_post_custom($post->ID); ?>

    <div id="post-<?php the_ID(); ?>" <?php post_class('d-inline-flex card border-0 rounded-0'); ?>>
        <img class="card-img img-fluid border-0 rounded-0" alt="..."  src="<?php the_post_thumbnail( array(360) ); ?>
        <div class="card-img-overlay">
            <div class="containertext text-left">
                <a href="<?php the_permalink(); ?>">
                    <h5 class="card-title cyan mb-1"><?php the_title(); ?></h5>
                    <p class="card-text">
                    <?php $date = get_post_meta($post->ID, 'custom_subtitulo', true); if($date != ''){echo $date;} ?>
                </p>
                </a>
            </div>
        </div>
    </div>
                           
        <?php endwhile; 
        wp_reset_postdata(); 

    endif; 
    wp_die(); 

}


// metaboxes directory constant
define( 'CUSTOM_METABOXES_DIR', get_template_directory_uri() . '/metaboxes' );

/**
 * recives data about a form field and spits out the proper html
 *
 * @param   array                   $field          array with various bits of information about the field
 * @param   string|int|bool|array   $meta           the saved data for this field
 * @param   array                   $repeatable     if is this for a repeatable field, contains parant id and the current integar
 *
 * @return  string                                  html for the field
 */
function custom_meta_box_field( $field, $meta = null, $repeatable = null ) {
    if ( ! ( $field || is_array( $field ) ) )
        return;
    
    // get field data
    $type = isset( $field['type'] ) ? $field['type'] : null;
    $label = isset( $field['label'] ) ? $field['label'] : null;
    $desc = isset( $field['desc'] ) ? '<span class="description">' . $field['desc'] . '</span>' : null;
    $place = isset( $field['place'] ) ? $field['place'] : null;
    $size = isset( $field['size'] ) ? $field['size'] : null;
    $post_type = isset( $field['post_type'] ) ? $field['post_type'] : null;
    $options = isset( $field['options'] ) ? $field['options'] : null;
    $settings = isset( $field['settings'] ) ? $field['settings'] : null;
    $repeatable_fields = isset( $field['repeatable_fields'] ) ? $field['repeatable_fields'] : null;
    
    // the id and name for each field
    $id = $name = isset( $field['id'] ) ? $field['id'] : null;
    if ( $repeatable ) {
        $name = $repeatable[0] . '[' . $repeatable[1] . '][' . $id .']';
        $id = $repeatable[0] . '_' . $repeatable[1] . '_' . $id;
    }
    switch( $type ) {
        // basic
        case 'text':
        case 'tel':
        case 'email':
        default:
            echo '<input type="' . $type . '" name="' . esc_attr( $name ) . '" id="' . esc_attr( $id ) . '" value="' . esc_attr( $meta ) . '" class="regular-text" size="30" />
                    <br />' . $desc;
        break;
        case 'url':
            echo '<input type="' . $type . '" name="' . esc_attr( $name ) . '" id="' . esc_attr( $id ) . '" value="' . esc_url( $meta ) . '" class="regular-text" size="30" />
                    <br />' . $desc;
        break;
        case 'number':
            echo '<input type="' . $type . '" name="' . esc_attr( $name ) . '" id="' . esc_attr( $id ) . '" value="' . intval( $meta ) . '" class="regular-text" size="30" />
                    <br />' . $desc;
        break;
        // textarea
        case 'textarea':
            echo '<textarea name="' . esc_attr( $name ) . '" id="' . esc_attr( $id ) . '" cols="60" rows="8">' . esc_textarea( $meta ) . '</textarea>
                    <br />' . $desc;

        // textarea novo
        // case 'textarea':
        //     echo '<textarea name="'.$name.'" id="'.$id.'" cols="60" rows="12">'.$meta.'</textarea>
        //             <br />' . $desc;

        break;
        // editor
        case 'editor':
            echo wp_editor( $meta, $id, $settings ) . '<br />' . $desc;
        break;
        // checkbox
        case 'checkbox':
            echo '<input type="checkbox" name="' . esc_attr( $name ) . '" id="' . esc_attr( $id ) . '" ' . checked( $meta, true, false ) . ' value="1" />
                    <label for="' . esc_attr( $id ) . '">' . $desc . '</label>';
        break;
        // select, chosen
        case 'select':
        case 'chosen':
            echo '<select name="' . esc_attr( $name ) . '" id="' . esc_attr( $id ) . '"' , $type == 'chosen' ? ' class="chosen"' : '' , isset( $multiple ) && $multiple == true ? ' multiple="multiple"' : '' , '>
                    <option value="">Select One</option>'; // Select One
            foreach ( $options as $option )
                echo '<option' . selected( $meta, $option['value'], false ) . ' value="' . $option['value'] . '">' . $option['label'] . '</option>';
            echo '</select><br />' . $desc;
        break;
        // radio
        case 'radio':
            echo '<ul class="meta_box_items">';
            foreach ( $options as $option )
                echo '<li><input type="radio" name="' . esc_attr( $name ) . '" id="' . esc_attr( $id ) . '-' . $option['value'] . '" value="' . $option['value'] . '" ' . checked( $meta, $option['value'], false ) . ' />
                        <label for="' . esc_attr( $id ) . '-' . $option['value'] . '">' . $option['label'] . '</label></li>';
            echo '</ul>' . $desc;
        break;
        // checkbox_group
        case 'checkbox_group':
            echo '<ul class="meta_box_items">';
            foreach ( $options as $option )
                echo '<li><input type="checkbox" value="' . $option['value'] . '" name="' . esc_attr( $name ) . '[]" id="' . esc_attr( $id ) . '-' . $option['value'] . '"' , is_array( $meta ) && in_array( $option['value'], $meta ) ? ' checked="checked"' : '' , ' /> 
                        <label for="' . esc_attr( $id ) . '-' . $option['value'] . '">' . $option['label'] . '</label></li>';
            echo '</ul>' . $desc;
        break;
        // color
        case 'color':
            $meta = $meta ? $meta : '#';
            echo '<input type="text" name="' . esc_attr( $name ) . '" id="' . esc_attr( $id ) . '" value="' . $meta . '" size="10" />
                <br />' . $desc;
            echo '<div id="colorpicker-' . esc_attr( $id ) . '"></div>
                <script type="text/javascript">
                jQuery(function(jQuery) {
                    jQuery("#colorpicker-' . esc_attr( $id ) . '").hide();
                    jQuery("#colorpicker-' . esc_attr( $id ) . '").farbtastic("#' . esc_attr( $id ) . '");
                    jQuery("#' . esc_attr( $id ) . '").bind("blur", function() { jQuery("#colorpicker-' . esc_attr( $id ) . '").slideToggle(); } );
                    jQuery("#' . esc_attr( $id ) . '").bind("focus", function() { jQuery("#colorpicker-' . esc_attr( $id ) . '").slideToggle(); } );
                });
                </script>';
        break;
        // post_select, post_chosen
        case 'post_select':
        case 'post_list':
        case 'post_chosen':
            echo '<select data-placeholder="Select One" name="' . esc_attr( $name ) . '[]" id="' . esc_attr( $id ) . '"' , $type == 'post_chosen' ? ' class="chosen"' : '' , isset( $multiple ) && $multiple == true ? ' multiple="multiple"' : '' , '>
                    <option value=""></option>'; // Select One
            $posts = get_posts( array( 'post_type' => $post_type, 'posts_per_page' => -1, 'orderby' => 'name', 'order' => 'ASC' ) );
            foreach ( $posts as $item )
                echo '<option value="' . $item->ID . '"' . selected( is_array( $meta ) && in_array( $item->ID, $meta ), true, false ) . '>' . $item->post_title . '</option>';
            $post_type_object = get_post_type_object( $post_type );
            echo '</select> &nbsp;<span class="description"><a href="' . admin_url( 'edit.php?post_type=' . $post_type . '">Manage ' . $post_type_object->label ) . '</a></span><br />' . $desc;
        break;
        // post_checkboxes
        case 'post_checkboxes':
            $posts = get_posts( array( 'post_type' => $post_type, 'posts_per_page' => -1 ) );
            echo '<ul class="meta_box_items">';
            foreach ( $posts as $item ) 
                echo '<li><input type="checkbox" value="' . $item->ID . '" name="' . esc_attr( $name ) . '[]" id="' . esc_attr( $id ) . '-' . $item->ID . '"' , is_array( $meta ) && in_array( $item->ID, $meta ) ? ' checked="checked"' : '' , ' />
                        <label for="' . esc_attr( $id ) . '-' . $item->ID . '">' . $item->post_title . '</label></li>';
            $post_type_object = get_post_type_object( $post_type );
            echo '</ul> ' . $desc , ' &nbsp;<span class="description"><a href="' . admin_url( 'edit.php?post_type=' . $post_type . '">Manage ' . $post_type_object->label ) . '</a></span>';
        break;
        // post_drop_sort
        case 'post_drop_sort':
            //areas
            $post_type_object = get_post_type_object( $post_type );
            echo '<p>' . $desc . ' &nbsp;<span class="description"><a href="' . admin_url( 'edit.php?post_type=' . $post_type . '">Manage ' . $post_type_object->label ) . '</a></span></p><div class="post_drop_sort_areas">';
            foreach ( $areas as $area ) {
                echo '<ul id="area-' . $area['id']  . '" class="sort_list">
                        <li class="post_drop_sort_area_name">' . $area['label'] . '</li>';
                        if ( is_array( $meta ) ) {
                            $items = explode( ',', $meta[$area['id']] );
                            foreach ( $items as $item ) {
                                $output = $display == 'thumbnail' ? get_the_post_thumbnail( $item, array( 204, 30 ) ) : get_the_title( $item ); 
                                echo '<li id="' . $item . '">' . $output . '</li>';
                            }
                        }
                echo '</ul>
                    <input type="hidden" name="' . esc_attr( $name ) . '[' . $area['id'] . ']" 
                    class="store-area-' . $area['id'] . '" 
                    value="' , $meta ? $meta[$area['id']] : '' , '" />';
            }
            echo '</div>';
            // source
            $exclude = null;
            if ( !empty( $meta ) ) {
                $exclude = implode( ',', $meta ); // because each ID is in a unique key
                $exclude = explode( ',', $exclude ); // put all the ID's back into a single array
            }
            $posts = get_posts( array( 'post_type' => $post_type, 'posts_per_page' => -1, 'post__not_in' => $exclude ) );
            echo '<ul class="post_drop_sort_source sort_list">
                    <li class="post_drop_sort_area_name">Available ' . $label . '</li>';
            foreach ( $posts as $item ) {
                $output = $display == 'thumbnail' ? get_the_post_thumbnail( $item->ID, array( 204, 30 ) ) : get_the_title( $item->ID ); 
                echo '<li id="' . $item->ID . '">' . $output . '</li>';
            }
            echo '</ul>';
        break;
        // tax_select
        case 'tax_select':
            echo '<select name="' . esc_attr( $name ) . '" id="' . esc_attr( $id ) . '">
                    <option value="">Select One</option>'; // Select One
            $terms = get_terms( $id, 'get=all' );
            $post_terms = wp_get_object_terms( get_the_ID(), $id );
            $taxonomy = get_taxonomy( $id );
            $selected = $post_terms ? $taxonomy->hierarchical ? $post_terms[0]->term_id : $post_terms[0]->slug : null;
            foreach ( $terms as $term ) {
                $term_value = $taxonomy->hierarchical ? $term->term_id : $term->slug;
                echo '<option value="' . $term_value . '"' . selected( $selected, $term_value, false ) . '>' . $term->name . '</option>'; 
            }
            echo '</select> &nbsp;<span class="description"><a href="'.get_bloginfo( 'url' ) . '/wp-admin/edit-tags.php?taxonomy=' . $id . '">Manage ' . $taxonomy->label . '</a></span>
                <br />' . $desc;
        break;
        // tax_checkboxes
        case 'tax_checkboxes':
            $terms = get_terms( $id, 'get=all' );
            $post_terms = wp_get_object_terms( get_the_ID(), $id );
            $taxonomy = get_taxonomy( $id );
            $checked = $post_terms ? $taxonomy->hierarchical ? $post_terms[0]->term_id : $post_terms[0]->slug : null;
            foreach ( $terms as $term ) {
                $term_value = $taxonomy->hierarchical ? $term->term_id : $term->slug;
                echo '<input type="checkbox" value="' . $term_value . '" name="' . $id . '[]" id="term-' . $term_value . '"' . checked( $checked, $term_value, false ) . ' /> <label for="term-' . $term_value . '">' . $term->name . '</label><br />';
            }
            echo '<span class="description">' . $field['desc'] . ' <a href="'.get_bloginfo( 'url' ) . '/wp-admin/edit-tags.php?taxonomy=' . $id . '&post_type=' . $page . '">Manage ' . $taxonomy->label . '</a></span>';
        break;
        // date
        case 'date':
            echo '<input type="text" class="datepicker" name="' . esc_attr( $name ) . '" id="' . esc_attr( $id ) . '" value="' . $meta . '" size="30" />
                    <br />' . $desc;
        break;
        // slider
        case 'slider':
        $value = $meta != '' ? intval( $meta ) : '0';
            echo '<div id="' . esc_attr( $id ) . '-slider"></div>
                    <input type="text" name="' . esc_attr( $name ) . '" id="' . esc_attr( $id ) . '" value="' . $value . '" size="5" />
                    <br />' . $desc;
        break;
        // image
        case 'image':
            $image = CUSTOM_METABOXES_DIR . '/images/image.png';    
            echo '<div class="meta_box_image"><span class="meta_box_default_image" style="display:none">' . $image . '</span>';
            if ( $meta ) {
                $image = wp_get_attachment_image_src( intval( $meta ), 'medium' );
                $image = $image[0];
            }               
            echo    '<input name="' . esc_attr( $name ) . '" type="hidden" class="meta_box_upload_image" value="' . intval( $meta ) . '" />
                        <img src="' . esc_attr( $image ) . '" class="meta_box_preview_image" alt="" />
                            <a href="#" class="meta_box_upload_image_button button" rel="' . get_the_ID() . '">Choose Image</a>
                            <small>&nbsp;<a href="#" class="meta_box_clear_image_button">Remove Image</a></small></div>
                            <br clear="all" />' . $desc;
        break;
        // file
        case 'file':        
            $iconClass = 'meta_box_file';
            if ( $meta ) $iconClass .= ' checked';
            echo    '<div class="meta_box_file_stuff"><input name="' . esc_attr( $name ) . '" type="hidden" class="meta_box_upload_file" value="' . esc_url( $meta ) . '" />
                        <span class="' . $iconClass . '"></span>
                        <span class="meta_box_filename">' . esc_url( $meta ) . '</span>
                            <a href="#" class="meta_box_upload_image_button button" rel="' . get_the_ID() . '">Choose File</a>
                            <small>&nbsp;<a href="#" class="meta_box_clear_file_button">Remove File</a></small></div>
                            <br clear="all" />' . $desc;
        break;
        // repeatable
        case 'repeatable':
            echo '<table id="' . esc_attr( $id ) . '-repeatable" class="meta_box_repeatable" cellspacing="0">
                <thead>
                    <tr>
                        <th><span class="sort_label"></span></th>
                        <th>Campos</th>
                        <th><a class="meta_box_repeatable_add" href="#"></a></th>
                    </tr>
                </thead>
                <tbody>';
            $i = 0;
            // create an empty array
            if ( $meta == '' || $meta == array() ) {
                $keys = wp_list_pluck( $repeatable_fields, 'id' );
                $meta = array ( array_fill_keys( $keys, null ) );
            }
            $meta = array_values( $meta );
            foreach( $meta as $row ) {
                echo '<tr>
                        <td><span class="sort hndle"></span></td><td>';
                foreach ( $repeatable_fields as $repeatable_field ) {
                    if ( ! array_key_exists( $repeatable_field['id'], $meta[$i] ) )
                        $meta[$i][$repeatable_field['id']] = null;
                    echo '<label>' . $repeatable_field['label']  . '</label><p>';
                    echo custom_meta_box_field( $repeatable_field, $meta[$i][$repeatable_field['id']], array( $id, $i ) );
                    echo '</p>';
                } // end each field
                echo '</td><td><a class="meta_box_repeatable_remove" href="#"></a></td></tr>';
                $i++;
            } // end each row
            echo '</tbody>';
            echo '
                <tfoot>
                    <tr>
                        <th><span class="sort_label"></span></th>
                        <th>Campos</th>
                        <th><a class="meta_box_repeatable_add" href="#"></a></th>
                    </tr>
                </tfoot>';
            echo '</table>
                ' . $desc;
        break;
    } //end switch
        
}


/**
 * Finds any item in any level of an array
 *
 * @param   string  $needle     field type to look for
 * @param   array   $haystack   an array to search the type in
 *
 * @return  bool                whether or not the type is in the provided array
 */
function meta_box_find_field_type( $needle, $haystack ) {
    foreach ( $haystack as $h )
        if ( isset( $h['type'] ) && $h['type'] == 'repeatable' )
            return meta_box_find_field_type( $needle, $h['repeatable_fields'] );
        elseif ( ( isset( $h['type'] ) && $h['type'] == $needle ) || ( isset( $h['repeatable_type'] ) && $h['repeatable_type'] == $needle ) )
            return true;
    return false;
}

/**
 * Find repeatable
 *
 * This function does almost the same exact thing that the above function 
 * does, except we're exclusively looking for the repeatable field. The 
 * reason is that we need a way to look for other fields nested within a 
 * repeatable, but also need a way to stop at repeatable being true. 
 * Hopefully I'll find a better way to do this later.
 *
 * @param   string  $needle     field type to look for
 * @param   array   $haystack   an array to search the type in
 *
 * @return  bool                whether or not the type is in the provided array
 */
function meta_box_find_repeatable( $needle = 'repeatable', $haystack ) {
    foreach ( $haystack as $h )
        if ( isset( $h['type'] ) && $h['type'] == $needle )
            return true;
    return false;
}

/**
 * sanitize boolean inputs
 */
function meta_box_santitize_boolean( $string ) {
    if ( ! isset( $string ) || $string != 1 || $string != true )
        return false;
    else
        return true;
}

/**
 * outputs properly sanitized data
 *
 * @param   string  $string     the string to run through a validation function
 * @param   string  $function   the validation function
 *
 * @return                      a validated string
 */
function meta_box_sanitize( $string, $function = 'sanitize_text_field' ) {
    switch ( $function ) {
        case 'intval':
            return intval( $string );
        case 'absint':
            return absint( $string );
        case 'wp_kses_post':
            return wp_kses_post( $string );
        case 'wp_kses_data':
            return wp_kses_data( $string );
        case 'esc_url_raw':
            return esc_url_raw( $string );
        case 'is_email':
            return is_email( $string );
        case 'sanitize_title':
            return sanitize_title( $string );
        case 'santitize_boolean':
            return santitize_boolean( $string );
        case 'sanitize_text_field':
        default:
            return sanitize_text_field( $string );
    }
}

/**
 * Map a multideminsional array
 *
 * @param   string  $func       the function to map
 * @param   array   $meta       a multidimensional array
 * @param   array   $sanitizer  a matching multidimensional array of sanitizers
 *
 * @return  array               new array, fully mapped with the provided arrays
 */
function meta_box_array_map_r( $func, $meta, $sanitizer ) {
        
    $newMeta = array();
    $meta = array_values( $meta );
    
    foreach( $meta as $key => $array ) {
        if ( $array == '' )
            continue;
        /**
         * some values are stored as array, we only want multidimensional ones
         */
        if ( ! is_array( $array ) ) {
            return array_map( $func, $meta, (array)$sanitizer );
            break;
        }
        /**
         * the sanitizer will have all of the fields, but the item may only 
         * have valeus for a few, remove the ones we don't have from the santizer
         */
        $keys = array_keys( $array );
        $newSanitizer = $sanitizer;
        if ( is_array( $sanitizer ) ) {
            foreach( $newSanitizer as $sanitizerKey => $value )
                if ( ! in_array( $sanitizerKey, $keys ) )
                    unset( $newSanitizer[$sanitizerKey] );
        }
        /**
         * run the function as deep as the array goes
         */
        foreach( $array as $arrayKey => $arrayValue )
            if ( is_array( $arrayValue ) )
                $array[$arrayKey] = meta_box_array_map_r( $func, $arrayValue, $newSanitizer[$arrayKey] );
        
        $array = array_map( $func, $array, $newSanitizer );
        $newMeta[$key] = array_combine( $keys, array_values( $array ) );
    }
    return $newMeta;
}

/**
 * takes in a few peices of data and creates a custom meta box
 *
 * @param   string          $id         meta box id
 * @param   string          $title      title
 * @param   array           $fields     array of each field the box should include
 * @param   string|array    $page       post type to add meta box to
 */
class Custom_Add_Meta_Box {
    
    var $id;
    var $title;
    var $fields;
    var $page;
    
    public function __construct( $id, $title, $fields, $page ) {
        $this->id = $id;
        $this->title = $title;
        $this->fields = $fields;
        $this->page = $page;
        
        if( ! is_array( $this->page ) )
            $this->page = array( $this->page );
        
        add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
        add_action( 'admin_head',  array( $this, 'admin_head' ) );
        add_action( 'add_meta_boxes', array( $this, 'add_box' ) );
        add_action( 'save_post',  array( $this, 'save_box' ));
    }
    
    /**
     * enqueue necessary scripts and styles
     */
    function admin_enqueue_scripts() {
        global $pagenow;
        if ( in_array( $pagenow, array( 'post-new.php', 'post.php' ) ) && in_array( get_post_type(), $this->page ) ) {
            // js
            $deps = array( 'jquery' );
            if ( meta_box_find_field_type( 'date', $this->fields ) )
                $deps[] = 'jquery-ui-datepicker';
            if ( meta_box_find_field_type( 'slider', $this->fields ) )
                $deps[] = 'jquery-ui-slider';
            if ( meta_box_find_field_type( 'color', $this->fields ) )
                $deps[] = 'farbtastic';
            if ( in_array( true, array(
                meta_box_find_field_type( 'chosen', $this->fields ),
                meta_box_find_field_type( 'post_chosen', $this->fields )
            ) ) ) {
                wp_register_script( 'chosen', CUSTOM_METABOXES_DIR . '/js/chosen.js', array( 'jquery' ) );
                $deps[] = 'chosen';
                wp_enqueue_style( 'chosen', CUSTOM_METABOXES_DIR . '/css/chosen.css' );
            }
            if ( in_array( true, array( 
                meta_box_find_field_type( 'date', $this->fields ), 
                meta_box_find_field_type( 'slider', $this->fields ),
                meta_box_find_field_type( 'color', $this->fields ),
                meta_box_find_field_type( 'chosen', $this->fields ),
                meta_box_find_field_type( 'post_chosen', $this->fields ),
                meta_box_find_repeatable( 'repeatable', $this->fields ),
                meta_box_find_field_type( 'image', $this->fields ),
                meta_box_find_field_type( 'file', $this->fields )
            ) ) )
                wp_enqueue_script( 'meta_box', CUSTOM_METABOXES_DIR . '/js/scripts.js', $deps );
            
            // css
            $deps = array();
            wp_register_style( 'jqueryui', CUSTOM_METABOXES_DIR . '/css/jqueryui.css' );
            if ( meta_box_find_field_type( 'date', $this->fields ) || meta_box_find_field_type( 'slider', $this->fields ) )
                $deps[] = 'jqueryui';
            if ( meta_box_find_field_type( 'color', $this->fields ) )
                $deps[] = 'farbtastic';
            wp_enqueue_style( 'meta_box', CUSTOM_METABOXES_DIR . '/css/meta_box.css', $deps );
        }
    }
    
    /**
     * adds scripts to the head for special fields with extra js requirements
     */
    function admin_head() {
        if ( in_array( get_post_type(), $this->page ) && ( meta_box_find_field_type( 'date', $this->fields ) || meta_box_find_field_type( 'slider', $this->fields ) ) ) {
        
            echo '<script type="text/javascript">
                        jQuery(function( $) {';
            
            foreach ( $this->fields as $field ) {
                switch( $field['type'] ) {
                    // date
                    case 'date' :
                        echo '$("#' . $field['id'] . '").datepicker({
                                dateFormat: \'yy-mm-dd\'
                            });';
                    break;
                    // slider
                    case 'slider' :
                    $value = get_post_meta( get_the_ID(), $field['id'], true );
                    if ( $value == '' )
                        $value = $field['min'];
                    echo '
                            $( "#' . $field['id'] . '-slider" ).slider({
                                value: ' . $value . ',
                                min: ' . $field['min'] . ',
                                max: ' . $field['max'] . ',
                                step: ' . $field['step'] . ',
                                slide: function( event, ui ) {
                                    $( "#' . $field['id'] . '" ).val( ui.value );
                                }
                            });';
                    break;
                }
            }
            
            echo '});
                </script>';
        
        }
    }
    
    /**
     * adds the meta box for every post type in $page
     */
    function add_box() {
        foreach ( $this->page as $page ) {
            add_meta_box( $this->id, $this->title, array( $this, 'meta_box_callback' ), $page, 'normal', 'high' );
        }
    }
    
    /**
     * outputs the meta box
     */
    function meta_box_callback() {
        // Use nonce for verification
        wp_nonce_field( 'custom_meta_box_nonce_action', 'custom_meta_box_nonce_field' );
        
        // Begin the field table and loop
        echo '<table class="form-table meta_box">';
        foreach ( $this->fields as $field) {
            if ( $field['type'] == 'section' ) {
                echo '<tr>
                        <td colspan="2">
                            <h2>' . $field['label'] . '</h2>
                        </td>
                    </tr>';
            }
            else {
                echo '<tr>
                        <th style="width:20%"><label for="' . $field['id'] . '">' . $field['label'] . '</label></th>
                        <td>';
                        
                        $meta = get_post_meta( get_the_ID(), $field['id'], true);
                        echo custom_meta_box_field( $field, $meta );
                        
                echo     '<td>
                    </tr>';
            }
        } // end foreach
        echo '</table>'; // end table
    }
    
    /**
     * saves the captured data
     */
    function save_box( $post_id ) {
        $post_type = get_post_type();
        
        // verify nonce
        if ( ! isset( $_POST['custom_meta_box_nonce_field'] ) )
            return $post_id;
        if ( ! ( in_array( $post_type, $this->page ) || wp_verify_nonce( $_POST['custom_meta_box_nonce_field'],  'custom_meta_box_nonce_action' ) ) ) 
            return $post_id;
        // check autosave
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
            return $post_id;
        // check permissions
        if ( ! current_user_can( 'edit_page', $post_id ) )
            return $post_id;
        
        // loop through fields and save the data
        foreach ( $this->fields as $field ) {
            if( $field['type'] == 'section' ) {
                $sanitizer = null;
                continue;
            }
            if( in_array( $field['type'], array( 'tax_select', 'tax_checkboxes' ) ) ) {
                // save taxonomies
                if ( isset( $_POST[$field['id']] ) ) {
                    $term = $_POST[$field['id']];
                    wp_set_object_terms( $post_id, $term, $field['id'] );
                }
            }
            else {
                // save the rest
                $new = false;
                $old = get_post_meta( $post_id, $field['id'], true );
                if ( isset( $_POST[$field['id']] ) )
                    $new = $_POST[$field['id']];
                if ( isset( $new ) && '' == $new && $old ) {
                    delete_post_meta( $post_id, $field['id'], $old );
                } elseif ( isset( $new ) && $new != $old ) {
                    // $sanitizer = isset( $field['sanitizer'] ) ? $field['sanitizer'] : 'sanitize_text_field';
                    // if ( is_array( $new ) )
                    //     $new = meta_box_array_map_r( 'meta_box_sanitize', $new, $sanitizer );
                    // else
                    //     $new = meta_box_sanitize( $new, $sanitizer );
                    update_post_meta( $post_id, $field['id'], $new );
                }
            }
        } // end foreach
    }
    
}

// Content Views Pro - Add taxonomy term name to post's class
add_filter( 'pt_cv_content_item_class', 'cvp_theme_term_name_as_class', 100, 2 );
function cvp_theme_term_name_as_class( $args, $post_id ) {
    $taxonomies  = get_taxonomies( '', 'names' );
    $terms       = wp_get_object_terms( $post_id, $taxonomies );
    foreach ( $terms as $term ) {
        $args[] = sanitize_html_class( "cvp-term-{$term->taxonomy}-{$term->slug}" );
    }

    return $args;
}