<?php
/**
 * @package WordPress
 * @subpackage FAU
 * @since FAU 1.1
 */

load_theme_textdomain( 'fau', get_template_directory() . '/languages' );
require_once( get_template_directory() . '/functions/defaults.php' );
require_once( get_template_directory() . '/functions/constants.php' );
$options = fau_initoptions();
require_once( get_template_directory() . '/functions/helper-functions.php' );
require_once( get_template_directory() . '/functions/template-functions.php' );
require_once( get_template_directory() . '/functions/theme-options.php' );     
require_once( get_template_directory() . '/functions/shortcodes.php');
require_once( get_template_directory() . '/functions/plugin-support.php' );
require_once( get_template_directory() . '/functions/menu.php');
require_once( get_template_directory() . '/functions/custom-fields.php' );
require_once( get_template_directory() . '/functions/posttype_imagelink.php' );
require_once( get_template_directory() . '/functions/posttype_ad.php' );
require_once( get_template_directory() . '/functions/widgets.php' );
require_once( get_template_directory() . '/functions/posttype-synonym.php');
require_once( get_template_directory() . '/functions/posttype-glossary.php');

function fau_setup() {
	global $options;
	

	if ( ! isset( $content_width ) ) $content_width = $options['content-width'];
	add_editor_style( array( 'css/editor-style.css' ) );
	add_theme_support( 'html5');
	add_theme_support('title-tag');

	
	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'meta', __( 'Meta-Navigation oben', 'fau' ) );
	register_nav_menu( 'meta-footer', __( 'Meta-Navigation unten', 'fau' ) );
	register_nav_menu( 'main-menu', __( 'Haupt-Navigation', 'fau' ) );
	
	if ($options['website_type']==-1) {
	    register_nav_menu( 'quicklinks-1', __( 'Startseite FAU Portal: Bühne Spalte 1', 'fau' ) );
	    register_nav_menu( 'quicklinks-2', __( 'Startseite FAU Portal: Bühne Spalte 2', 'fau' ) );
	    register_nav_menu( 'quicklinks-3', __( 'Startseite FAU Portal: Bühne Spalte 3', 'fau' ) );
	    register_nav_menu( 'quicklinks-4', __( 'Startseite FAU Portal: Bühne Spalte 4', 'fau' ) );
	} else {
	    register_nav_menu( 'quicklinks-3', __( 'Startseite Fakultät: Bühne Spalte 1', 'fau' ) );
	    register_nav_menu( 'quicklinks-4', __( 'Startseite Fakultät: Bühne Spalte 2', 'fau' ) );
	}
	register_nav_menu( 'error-1', __( 'Fehler- und Suchseite: Vorschlagmenu Spalte 1', 'fau' ) );
	register_nav_menu( 'error-2', __( 'Fehler- und Suchseite: Vorschlagmenu Spalte 2', 'fau' ) );
	register_nav_menu( 'error-3', __( 'Fehler- und Suchseite: Vorschlagmenu Spalte 3', 'fau' ) );
	register_nav_menu( 'error-4', __( 'Fehler- und Suchseite: Vorschlagmenu Spalte 4', 'fau' ) );
	
	/*
	 * This theme uses a custom image size for featured images, displayed on
	 * "standard" posts and pages.
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( $options['default_thumb_width'], $options['default_thumb_height'], $options['default_thumb_crop'] ); // 300:150:false
	
	/* Image Sizes for Slider, Name: hero */
	add_image_size( 'hero', $options['slider-image-width'], $options['slider-image-height'], $options['slider-image-crop']);	// 1260:350
	
	/* Banner fuer Startseiten */
	add_image_size( 'herobanner', $options['default_startseite-bannerbild-image_width'], $options['default_startseite-bannerbild-image_height'], $options['default_startseite-bannerbild-image_crop']);	// 1260:182
    
	/* Thumb for Posts in Lists - Name: post-thumb */
	add_image_size( 'post-thumb', $options['default_postthumb_width'], $options['default_postthumb_height'], $options['default_postthumb_crop']); // 3:2  220:147, false
	
	/* Thumb of Topevent in Sidebar - Name: topevent-thumb */
	add_image_size( 'topevent-thumb', $options['default_topevent_thumb_width'], $options['default_topevent_thumb_height'], $options['default_topevent_thumb_crop']); // 140:90, true
	
	/* Thumb for Image Menus in Content - Name: page-thumb */
	add_image_size( 'page-thumb', $options['default_submenuthumb_width'], $options['default_submenuthumb_height'],  $options['default_submenuthumb_crop']); // 220:110, true
	
	/* Thumb for Posts, displayed in post/page single display - Name: post */
	add_image_size( 'post', $options['default_post_width'], $options['default_post_height'], $options['default_post_crop']);  // 300:200  false
	
	    
	
	/* Thumb for Logos (used in carousel) - Name: logo-thumb */
	add_image_size( 'logo-thumb', $options['default_logo_carousel_width'], $options['default_logo_carousel_height'], $options['default_logo_carousel_crop']);   // 140:110, true

	/* 
	 * Größen für Bildergalerien: 
	 */
	/* Images for gallerys - Name: gallery-full */
	add_image_size( 'gallery-full', $options['default_gallery_full_width'], $options['default_gallery_full_height'], $options['default_gallery_full_crop']); // 940, 470, false
	//
	// Wird bei Default-Galerien verwendet als ANzeige des großen Bildes.
	add_image_size( 'gallery-thumb', $options['default_gallery_thumb_width'], $options['default_gallery_thumb_height'], $options['default_gallery_thumb_crop']); // 120, 80, true

	/* Grid-Thumbs for gallerys - Name: gallery-grid */
	add_image_size( 'gallery-grid', $options['default_gallery_grid_width'], $options['default_gallery_grid_height'], $options['default_gallery_grid_crop']); // 145, 120, false
	
	/* 2 column Imagelists for gallerys - Name: image-2-col */
	add_image_size( 'image-2-col', $options['default_gallery_grid2col_width'], $options['default_gallery_grid2col_height'], $options['default_gallery_grid2col_crop']); // 300, 200, true
	
	/* 4 column Imagelists for gallerys - Name: image-4-col */
	add_image_size( 'image-4-col', $options['default_gallery_grid4col_width'], $options['default_gallery_grid4col_height'], $options['default_gallery_grid4col_crop']);	// 140, 70, true


	
	
	
	/* Remove something out of the head */
	// remove_action( 'wp_head', 'feed_links_extra', 3 ); // Display the links to the extra feeds such as category feeds
	// remove_action( 'wp_head', 'feed_links', 2 ); // Display the links to the general feeds: Post and Comment Feed	
	remove_action( 'wp_head', 'post_comments_feed_link ', 2 ); // Display the links to the general feeds: Post and Comment Feed
	remove_action( 'wp_head', 'rsd_link' ); // Display the link to the Really Simple Discovery service endpoint, EditURI link
	remove_action( 'wp_head', 'wlwmanifest_link' ); // Display the link to the Windows Live Writer manifest file.
	// remove_action( 'wp_head', 'index_rel_link' ); // index link
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); // prev link
	remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 ); // Display relational links for the posts adjacent to the current post.
	//remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0);

	

}
add_action( 'after_setup_theme', 'fau_setup' );


/*-----------------------------------------------------------------------------------*/
/* Set extra init values
/*-----------------------------------------------------------------------------------*/
function fau_custom_init() {
    /* Keine verwirrende Abfrage nach Kommentaren im Page-Editor */
    remove_post_type_support( 'page', 'comments' );

    /* Disable Emojis */
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    add_filter( 'tiny_mce_plugins', 'fau_disable_emojis_tinymce' );
}
add_action( 'init', 'fau_custom_init' );
/*-----------------------------------------------------------------------------------*/
/* Disable Emojis also in tinyMCE plugin
/*-----------------------------------------------------------------------------------*/
function fau_disable_emojis_tinymce( $plugins ) {
    return array_diff( $plugins, array( 'wpemoji' ) );
}
/*-----------------------------------------------------------------------------------*/
/* Enqueues scripts and styles for front end.
/*-----------------------------------------------------------------------------------*/
function fau_register_scripts() {
    global $defaultoptions;
    global $options;
    
    wp_register_script( 'fau-scripts', $defaultoptions['src-scriptjs'], array('jquery'), $options['version'], true );
    wp_register_script( 'fau-libs-jquery-flexslider', get_fau_template_uri() . '/js/libs/jquery.flexslider.js', array('jquery'), $options['version'], true );
	// Flexslider für Startseite und für Galerien.     
    wp_register_script( 'fau-libs-jquery-caroufredsel', get_fau_template_uri() . '/js/libs/jquery.caroufredsel.js', array('jquery'), $options['version'], true );
    wp_register_script( 'fau-js-caroufredsel', get_fau_template_uri() . '/js/usecaroufredsel.min.js', array('jquery','fau-libs-jquery-caroufredsel'), $options['version'], true );
	// Slidende Logos 
}
add_action('init', 'fau_register_scripts');


/*-----------------------------------------------------------------------------------*/
/* Activate base scripts
/*-----------------------------------------------------------------------------------*/
function fau_basescripts_styles() {
    global $defaultoptions;
    global $usejslibs;
    global $options;
    
    wp_enqueue_style( 'fau-style', get_stylesheet_uri(), array(), $options['version'] );	
    wp_enqueue_script( 'fau-scripts');

}
add_action( 'wp_enqueue_scripts', 'fau_basescripts_styles' );

/*-----------------------------------------------------------------------------------*/
/* Activate scripts depending on use
/*-----------------------------------------------------------------------------------*/
function fau_enqueuefootercripts() {
    global $options;
    global $usejslibs;
   
    
     if ((isset($usejslibs['flexslider']) && ($usejslibs['flexslider'] == true))) {
	 // wird bei Startseite Slider und auch bei gallerien verwendet
	wp_enqueue_script('fau-libs-jquery-flexslider');	     
     }	 

     if ((isset($usejslibs['caroufredsel']) && ($usejslibs['caroufredsel'] == true))) {
	// wird bei Logo-Menus verwendet
	wp_enqueue_script('fau-libs-jquery-caroufredsel');
	wp_enqueue_script('fau-js-caroufredsel');
    }
}

add_action( 'wp_footer', 'fau_enqueuefootercripts' );

/*-----------------------------------------------------------------------------------*/
/* Activate scripts and style for backend use
/*-----------------------------------------------------------------------------------*/
function fau_admin_header_style() {
    wp_register_style( 'themeadminstyle', get_fau_template_uri().'/css/admin.css' );	   
    wp_enqueue_style( 'themeadminstyle' );	
    wp_enqueue_style( 'dashicons' );
    wp_enqueue_media();
    wp_enqueue_script('jquery-ui-datepicker');
    wp_register_script('themeadminscripts', get_fau_template_uri().'/js/admin.min.js', array('jquery'));    
    wp_enqueue_script('themeadminscripts');	   
}
add_action( 'admin_enqueue_scripts', 'fau_admin_header_style' );

/*-----------------------------------------------------------------------------------*/
/* Change default header
/*-----------------------------------------------------------------------------------*/
function fau_addmetatags() {
    global $options;

    $output = "";
    $output .= '<meta http-equiv="Content-Type" content="text/html; charset='.get_bloginfo('charset').'">'."\n";
    $output .= '<meta name="viewport" content="width=device-width, initial-scale=1.0">'."\n";    

    $output .= fau_get_rel_alternate();
            
    if ((isset( $options['google-site-verification'] )) && ( strlen(trim($options['google-site-verification']))>1 )) {
        $output .= '<meta name="google-site-verification" content="'.$options['google-site-verification'].'">'."\n";
    }

    if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) {
	    $output .=  '<link rel="apple-touch-icon" href="'.get_fau_template_uri().'/img/apple-touch-icon.png">'."\n";
	    $output .=  '<link rel="icon" href="'.get_fau_template_uri().'/img/apple-touch-icon.png">'."\n";
	    $output .=  '<link rel="icon" href="'.get_fau_template_uri().'/img/apple-touch-icon-120x120.png" sizes="120x120">'."\n";
	    $output .=  '<link rel="icon" href="'.get_fau_template_uri().'/img/apple-touch-icon-152x152.png" sizes="152x152">'."\n";
	    $output .=  '<link rel="shortcut icon" href="'.get_fau_template_uri().'/img/favicon.ico">'."\n";	
    }
    
    	// Adds RSS feed links to <head> for posts and comments.
	// add_theme_support( 'automatic-feed-links' );
	// Will post both: feed and comment feed; To use only main rss feed, i have to add it manually in head
    
    $title = sanitize_text_field(get_bloginfo( 'name' ));
    $output .= '<link rel="alternate" type="application/rss+xml" title="'.$title.' - RSS 2.0 Feed" href="'.get_bloginfo( 'rss2_url').'">'."\n";
    
    echo $output;
}
add_action('wp_head', 'fau_addmetatags',1);


/*-----------------------------------------------------------------------------------*/
/* Change default DNS prefetch
/*-----------------------------------------------------------------------------------*/
function fau_remove_default_dns_prefetch( $hints, $relation_type ) {
    if ( 'dns-prefetch' === $relation_type ) {
        return array_diff( wp_dependencies_unique_hosts(), $hints );
    }

    return $hints;
}
add_filter( 'wp_resource_hints', 'fau_remove_default_dns_prefetch', 10, 2 );

function fau_dns_prefetch() {
    // List of domains to set prefetching for
    $prefetchDomains = [
        '//www.fau.de',
        '//www.fau.eu',
    ];
 
    $prefetchDomains = array_unique($prefetchDomains);
    $result = '';
 
    foreach ($prefetchDomains as $domain) {
        $domain = esc_url($domain);
        $result .= '<link rel="dns-prefetch" href="' . $domain . '" crossorigin />';
        $result .= '<link rel="preconnect" href="' . $domain . '" crossorigin />';
    }
 
    echo $result;
}
add_action('wp_head', 'fau_dns_prefetch', 0);


/*-----------------------------------------------------------------------------------*/
/* Change default title
/*-----------------------------------------------------------------------------------*/
function fau_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Seite %s', 'fau' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'fau_wp_title', 10, 2 );

/*-----------------------------------------------------------------------------------*/
/* Resets the Excerpt More
/*-----------------------------------------------------------------------------------*/
function fau_excerpt_more( $more ) {
    global $options;
    return $options['default_excerpt_morestring'];
}
add_filter('excerpt_more', 'fau_excerpt_more');


/*-----------------------------------------------------------------------------------*/
/* Changes default length for excerpt
/*-----------------------------------------------------------------------------------*/
function fau_excerpt_length( $length ) {
    global $options;
    return $options['default_excerpt_length'];
}
add_filter( 'excerpt_length', 'fau_excerpt_length' );


/*-----------------------------------------------------------------------------------*/
/* create array with organisation logos
/*-----------------------------------------------------------------------------------*/
function fau_init_header_logos() {
    global $options;
    global $default_fau_orga_data;

    $header_logos = array();
    foreach($default_fau_orga_data as $name=>$value) {

	if (strpos($name, '_') === 0) {
	    if ((strpos($name, '_faculty') === 0) && (!empty($options['website_usefaculty'])) ) {	    
		    $sub = $options['website_usefaculty'];
		    if (isset($default_fau_orga_data[$name][$sub])) {
			$header_logos[$sub]['url'] = $default_fau_orga_data[$name][$sub]['thumbnail'];
			if (isset($default_fau_orga_data[$name][$sub]['url'])) {
			    $header_logos[$sub]['thumbnail_url'] = $default_fau_orga_data[$name][$sub]['thumbnail'];
			} else {
			    $header_logos[$sub]['thumbnail_url'] = $default_fau_orga_data[$name][$sub]['url'];
			}
			$header_logos[$sub]['description'] = $default_fau_orga_data[$name][$sub]['title']; 
		    }
	    
	    } else {
		foreach($value as $sub=>$sval) {
		    $header_logos[$sub]['url'] = $default_fau_orga_data[$name][$sub]['url'];
		    if (isset($default_fau_orga_data[$name][$sub]['thumbnail'])) {
			$header_logos[$sub]['thumbnail_url'] = $default_fau_orga_data[$name][$sub]['thumbnail'];
		    } else {
			$header_logos[$sub]['thumbnail_url'] = $default_fau_orga_data[$name][$sub]['url'];
		    }
		    $header_logos[$sub]['description'] = $default_fau_orga_data[$name][$sub]['title']; 
		}
	    }
	} else {
	    $header_logos[$name]['url'] = $default_fau_orga_data[$name]['url'];
	    if (isset($default_fau_orga_data[$name]['thumbnail'])) {
		$header_logos[$name]['thumbnail_url'] = $default_fau_orga_data[$name]['thumbnail'];
	    } else {
		$header_logos[$name]['thumbnail_url'] = $default_fau_orga_data[$name]['url'];
	    }
	    $header_logos[$name]['description'] = $default_fau_orga_data[$name]['title']; 
	}
     }
     return $header_logos;
} 

/*-----------------------------------------------------------------------------------*/
/* Header setup
/*-----------------------------------------------------------------------------------*/
function fau_custom_header_setup() { 
    global $options;
	$args = array(
//	    'default-image'          => $options['default_logo_src'],
	    'height'			=> $options['default_logo_height'],
	    'width'			=> $options['default_logo_width'],
	    'admin-head-callback'	=> 'fau_admin_header_style',
	    'header-text'		=> false,
	    'flex-width'		=> true,
	    'flex-height'		=> true,
	);
	add_theme_support( 'custom-header', $args );
	$default_header_logos = fau_init_header_logos();
	register_default_headers( $default_header_logos );
}
add_action( 'after_setup_theme', 'fau_custom_header_setup' );


/*-----------------------------------------------------------------------------------*/
/* Change output for gallery
/*-----------------------------------------------------------------------------------*/

add_filter('post_gallery', 'fau_post_gallery', 10, 2);
function fau_post_gallery($output, $attr) {
    global $post;
    global $options;
    global $usejslibs;
    
    if (isset($attr['orderby'])) {
        $attr['orderby'] = sanitize_sql_orderby($attr['orderby']);
        if (!$attr['orderby'])
            unset($attr['orderby']);
    }

    extract(shortcode_atts(array(
        'order' => 'ASC',
        'orderby' => 'menu_order ID',
        'id' => $post->ID,
        'itemtag' => 'dl',
        'icontag' => 'dt',
        'captiontag' => 'dd',
        'columns' => 3,
        'size' => 'thumbnail',
        'include' => '',
        'exclude' => '',
	'type' => NULL,
	'lightbox' => FALSE,
	'captions' => 1,
	'columns'   => 6,
	'link'	=> 'file'

    ), $attr));

    $id = intval($id);
    if ('RAND' == $order) $orderby = 'none';

    if (!empty($include)) {
        $include = preg_replace('/[^0-9,]+/', '', $include);
        $_attachments = get_posts(array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));

        $attachments = array();
        foreach ($_attachments as $key => $val) {
            $attachments[$val->ID] = $_attachments[$key];
        }
    }

    if (empty($attachments)) return '';

	
    $output = '';
    if (!isset($attr['captions'])) {
	$attr['captions'] =1;
    }
     if (!isset($attr['columns'])) {
	$attr['columns'] = 7;
    }
    if (!isset($attr['type'])) {
	$attr['type'] = 'default';
    }
    if (!isset($attr['link'])) {
	$attr['link'] = 'file';
    }
    switch($attr['type'])  {
	    case "grid":
		    {
			$rand = rand();

			$output .= "<div class=\"image-gallery-grid clearfix\">\n";
			$output .= "<ul class=\"grid\">\n";

			    foreach ($attachments as $id => $attachment) {
				    $img = wp_get_attachment_image_src($id, 'gallery-grid');
				    $meta = get_post($id);
				    // $img_full = wp_get_attachment_image_src($id, 'gallery-full');
				    $img_full = wp_get_attachment_image_src($id, 'full');
				    $lightboxattr = '';
				    $lightboxtitle = sanitize_text_field($meta->post_excerpt);
				    if (strlen(trim($lightboxtitle))>1) {
					$lightboxattr = ' title="'.$lightboxtitle.'"';
				    }
				    if(isset( $attr['captions']) && ($attr['captions']==1) && $meta->post_excerpt) {
					    $output .= "<li class=\"has-caption\">\n";
				    } else  {
					    $output .= "<li>\n";
				    }
					$output .= '<a href="'.fau_esc_url($img_full[0]).'" class="lightbox"';
					$output .= ' rel="lightbox-'.$rand.'"'.$lightboxattr.'>';

				    $output .= '<img src="'.fau_esc_url($img[0]).'" width="'.$img[1].'" height="'.$img[2].'" alt="">';
				    $output .= '</a>';
				    if($meta->post_excerpt) {
					    $output .= '<div class="caption">'.$meta->post_excerpt.'</div>';
				    }
			    $output .= "</li>\n";
			}

			    $output .= "</ul>\n";
			$output .= "</div>\n";

			    break;
		    }

	    case "2cols":
		    {
			    $rand = rand();

			    $output .= '<div class="row">'."\n";
			    $i = 0;

			    foreach ($attachments as $id => $attachment) {
				    $img = wp_get_attachment_image_src($id, 'image-2-col');
				    $img_full = wp_get_attachment_image_src($id, 'full');
				    $meta = get_post($id);
				     $lightboxattr = '';
				    $lightboxtitle = sanitize_text_field($meta->post_excerpt);
				    if (strlen(trim($lightboxtitle))>1) {
					$lightboxattr = ' title="'.$lightboxtitle.'"';
				    }
				    $output .= '<div class="span4">';
				    $output .= '<a href="'.fau_esc_url($img_full[0]).'" class="lightbox" rel="lightbox-'.$rand.'"'.$lightboxattr.'>';
				    $output .= '<img class="content-image-cols" src="'.fau_esc_url($img[0]).'" width="'.$img[1].'" height="'.$img[2].'" alt=""></a>';
				    if($attr['captions'] && $meta->post_excerpt) $output .= '<div class="caption">'.$meta->post_excerpt.'</div>';
				    $output .= '</div>'."\n";
				    $i++;

				    if($i % 2 == 0) {
					    $output .= '</div><div class="row">'."\n";
				    }
			    }

			    $output .= '</div>'."\n";

			    break;
		    }

	    case "4cols":
		    {
			    $rand = rand();

			    $output .= '<div class="row">'."\n";
			    $i = 0;

			    foreach ($attachments as $id => $attachment) {
				    $img = wp_get_attachment_image_src($id, 'image-4-col');
				    $img_full = wp_get_attachment_image_src($id, 'full');
				    $meta = get_post($id);
				    $lightboxattr = '';
				    $lightboxtitle = sanitize_text_field($meta->post_excerpt);
				    if (strlen(trim($lightboxtitle))>1) {
					$lightboxattr = ' title="'.$lightboxtitle.'"';
				    }
				    $output .= '<div class="span2">';
				    $output .= '<a href="'.fau_esc_url($img_full[0]).'" class="lightbox" rel="lightbox-'.$rand.'"'.$lightboxattr.'>';
				    $output .= '<img class="content-image-cols" src="'.fau_esc_url($img[0]).'" width="'.$img[1].'" height="'.$img[2].'" alt=""></a>';
				    if($attr['captions'] && $meta->post_excerpt) $output .= '<div class="caption">'.$meta->post_excerpt.'</div>';
				    $output .= '</div>';
				    $i++;

				    if($i % 4 == 0) {
					    $output .= '    </div><div class="row">'."\n";
				    }
			    }

			    $output .= "</div>\n";

			    break;
		    }

	    default:
		    {
			$usejslibs['flexslider'] = true;
			$rand = rand();	    
			$output .= "<div id=\"slider-$rand\" class=\"image-gallery-slider\">\n";
			$output .= "	<ul class=\"slides\">\n";

			foreach ($attachments as $id => $attachment) {
			    $img = wp_get_attachment_image_src($id, 'gallery-full');
			    $meta = get_post($id);
			    $img_full = wp_get_attachment_image_src($id, 'full');

			    $output .= '<li><img src="'.fau_esc_url($img[0]).'" width="'.$img[1].'" height="'.$img[2].'" alt="">';
			    if (($options['galery_link_original']) || ($meta->post_excerpt != '')) {
				$output .= '<div class="gallery-image-caption">';
				$lightboxattr = '';
				if($meta->post_excerpt != '') { 
				    $output .= $meta->post_excerpt; 
				    $lightboxtitle = sanitize_text_field($meta->post_excerpt);
				    if (strlen(trim($lightboxtitle))>1) {
					$lightboxattr = ' title="'.$lightboxtitle.'"';
				    }
				}
				if (($options['galery_link_original']) && ($attr['link'] != 'none')) {
				    if($meta->post_excerpt != '') { $output .= '<br>'; }
				    $output .= '<span class="linkorigin">(<a href="'.fau_esc_url($img_full[0]).'" '.$lightboxattr.' class="lightbox" rel="lightbox-'.$rand.'">'.__('Vergrößern','fau').'</a>)</span>';
				}
				$output .='</div>';
			    }
			    $output .= "</li>\n";
			}

			$output .= "	</ul>\n";
			$output .= "</div>\n";

			
			
			$output .= "<div id=\"carousel-$rand\" class=\"image-gallery-carousel\">";
			$output .= "	<ul class=\"slides\">";

			foreach ($attachments as $id => $attachment) {
			    $img = wp_get_attachment_image_src($id, 'gallery-thumb');
			    $output .= '	<li><img src="'.fau_esc_url($img[0]).'" width="'.$img[1].'" height="'.$img[2].'" alt=""></li>';
			}

			$output .= "	</ul>";
			$output .= "</div>";				
			$output .= "<script type=\"text/javascript\"> jQuery(document).ready(function($) {";			
			$output .= "$('#carousel-$rand').flexslider({maxItems: ".$attr['columns'].",selector: 'ul > li',animation: 'slide',keyboard:true,multipleKeyboard:true,directionNav:true,controlNav: true,pausePlay: false,slideshow: false,asNavFor: '#slider-$rand',itemWidth: 125,itemMargin: 5});";
			$output .= "$('#slider-$rand').flexslider({selector: 'ul > li',animation: 'slide',keyboard:true,multipleKeyboard:true,directionNav: false,controlNav: false,pausePlay: false,slideshow: false,sync: '#carousel-$rand'});";
			$output .= "});</script>";

		    }
    }
    return $output;
}

/*
 * Make URLs relative; Several functions
 */
function fau_relativeurl($content){
        return preg_replace_callback('/<a[^>]+/', 'fau_relativeurl_callback', $content);
}
function fau_relativeurl_callback($matches) {
        $link = $matches[0];
        $site_link =  wp_make_link_relative(home_url());  
        $link = preg_replace("%href=\"$site_link%i", 'href="', $link);                 
        return $link;
    }
 add_filter('the_content', 'fau_relativeurl');
 
 function fau_relativeimgurl($content){
        return preg_replace_callback('/<img[^>]+/', 'fau_relativeimgurl_callback', $content);
}
function fau_relativeimgurl_callback($matches) {
        $link = $matches[0];
        $site_link =  wp_make_link_relative(home_url());  
        $link = preg_replace("%src=\"$site_link%i", 'src="', $link);                 
        return $link;
    }
 add_filter('the_content', 'fau_relativeimgurl');
 
 /*
  * Replaces esc_url, but also makes URL relative
  */
 function fau_esc_url( $url) {
     if (!isset($url)) {
	 $url = home_url("/");
     }
     return fau_make_link_relative(esc_url($url));
 }
 
 function get_fau_template_uri () {
     return get_template_directory_uri();
 }
 function fau_get_template_uri () {
     return get_template_directory_uri();
 } 

 /*
  * Makes absolute URL from relative URL
  */
 function fau_make_absolute_url( $url) {
    if (!isset($url)) {
	$url = home_url("/");
    } else {
	if (substr($url,0,1)=='/') {
	    $base = home_url();
	    return $base.$url;
	} else {
	    return $url;
	}
    }
 }
 
 
add_action('template_redirect', 'rw_relative_urls');
function rw_relative_urls() {
    // Don't do anything if:
    // - In feed
    // - In sitemap by WordPress SEO plugin
    if (is_admin() || is_feed() || get_query_var('sitemap')) {
        return;
    }
    $filters = array(
    //    'post_link',
        'post_type_link',
        'page_link',
        'attachment_link',
        'get_shortlink',
        'post_type_archive_link',
        'get_pagenum_link',
        'get_comments_pagenum_link',
        'term_link',
        'search_link',
        'day_link',
        'month_link',
        'year_link',
        'script_loader_src',
        'style_loader_src',
    );
    foreach ($filters as $filter) {
        add_filter($filter, 'fau_make_link_relative');
    }
}

function fau_make_link_relative($url) {
    $current_site_url = get_site_url();   
	if (!empty($GLOBALS['_wp_switched_stack'])) {
        $switched_stack = $GLOBALS['_wp_switched_stack'];
        $blog_id = end($switched_stack);
        if ($GLOBALS['blog_id'] != $blog_id) {
            $current_site_url = get_site_url($blog_id);
        }
    }
    $current_host = parse_url($current_site_url, PHP_URL_HOST);
    $host = parse_url($url, PHP_URL_HOST);
    if($current_host == $host) {
        $url = wp_make_link_relative($url);
    }
    return $url; 
}

function fau_get_defaultlinks ($list = 'faculty', $ulclass = '', $ulid = '') {
    global $default_link_liste;
    global $options;
    
    if (is_array($default_link_liste[$list])) {
	$uselist =  $default_link_liste[$list];
    } else {
	$uselist =  $default_link_liste['faculty'];
    }
    
    $result = '';
    if (isset($uselist['_title'])) {
	$result .= '<h3>'.$uselist['_title'].'</h3>';	
	$result .= "\n";
    }
    $thislist = '';
    
    foreach($uselist as $key => $entry ) {
	if (substr($key,0,4) != 'link') {
	    continue;
	}
	$thislist .= '<li';
	if (isset($entry['class'])) {
	    $thislist .= ' class="'.$entry['class'].'"';
	}
	$thislist .= '>';
	if (isset($entry['content'])) {
	    $thislist .= '<a data-wpel-link="internal" href="'.$entry['content'].'">';
	}
	$thislist .= $entry['name'];
	if (isset($entry['content'])) {
	    $thislist .= '</a>';
	}
	$thislist .= "</li>\n";
    }    
    if (isset($thislist)) {
	$result .= '<ul';
	if (!empty($ulclass)) {
	    $result .= ' class="'.$ulclass.'"';
	}
	if (!empty($ulid)) {
	    $result .= ' id="'.$ulid.'"';
	}
	$result .= '>';
	$result .= $thislist;
	$result .= '</ul>';	
	$result .= "\n";	
    }
    return $result;
}

/* 
 * Returns language code, without subcode
 */
function fau_get_language_main () {
    $charset = explode('-',get_bloginfo('language'))[0];
    return $charset;
}

/* 
 * Change WordPress default language attributes function to 
 * strip of region code parts
 */
function fau_get_language_attributes ($doctype = 'html' ) {
    $attributes = array();
	
    if ( function_exists( 'is_rtl' ) && is_rtl() )
	    $attributes[] = 'dir="rtl"';
    
    if ( $langcode = fau_get_language_main() ) {
	    if ( get_option('html_type') == 'text/html' || $doctype == 'html' )
		    $attributes[] = "lang=\"$langcode\"";

	    if ( get_option('html_type') != 'text/html' || $doctype == 'xhtml' )
		    $attributes[] = "xml:lang=\"$langcode\"";
    }	
    $output = implode(' ', $attributes);
    return $output;
}




/* 
 * Erstellt Toplinkliste
 */
function fau_get_toplinks() {
    global $options;
    global $defaultoptions;
    global $default_link_liste;
    global $default_fau_orga_data;
    global $default_fau_orga_faculty;
	    
    $uselist =  $default_link_liste['meta'];
    $result = '';
    

    if (isset($uselist['_title'])) {
	$result .= '<h3>'.$uselist['_title'].'</h3>';	
	$result .= "\n";
    }
    

	/* 
	 * website_type: 
	 *  0 = Fakultaetsportal oder zentrale Einrichtung
	 *	=> Nur Link zur FAU, kein Link zur Fakultät
	 *	   Link zur FAU als Text, da FAU-Logo bereits Teil des
	 *         Fakultätslogos
	 *  1 = Lehrstuhl oder eine andere Einrichtung die einer Fakultät zugeordnet ist 
	 *	=> Link zur FAU und Link zur Fakultät, 
	 *         Link zur FAU als Grafik, Link zur Fakultät als Text (lang oder kurz nach Wahl)
	 *  2 = Sonstige Einrichtung, die nicht einer Fakultät zugeordnet sein muss
	 *	=> Nur Link zur FAU, kein Link zur Fakultät
	 *	   Link zur FAU als Grafik (das ist der Unterschied zur Option 0)
	 *  3 = Koopertation mit Externen (neu ab 1.4)
	 *	=> Kein Link zur FAU
	 *  -1 = FAU-Portal (neu ab 1.4, nur für zukunftigen Bedarf)
	 *	=> Kein Link zur FAU, aktiviert 4 Spalten unter HERO
	 * 
	 * 'website_usefaculty' = ( nat | phil | med | tf | rw )
	 *  Wenn gesetzt, wird davon ausgegangen, dass die Seite
	 *  zu einer Fakultät gehört; Daher werden website_type-optionen auf
	 *  0 und 2 reduziert. D.h.: Immer LInk zur FAU, keine Kooperationen.
	 *  
	 */
    
    $options['website_usefaculty'] = $defaultoptions['website_usefaculty'];
    $isfaculty = false;
    if ( (isset($options['website_usefaculty'])) && (in_array($options['website_usefaculty'],$default_fau_orga_faculty))) {
	$isfaculty = true;
    }
    
    $linkhome = true;
    $linkhomeimg = false;
    $linkfaculty = false;

    // Using if-then-else structure, due to better performance as switch 
    if ($options['website_type']==-1) {
	$linkhome = false;
	$linkfaculty = false;
	$linkhomeimg = false;
    } elseif ($isfaculty) {
	if ($options['website_type']==0) {
	    $linkhomeimg = false;
	    $linkfaculty = false;
	} else {
	    $linkhomeimg = true;
	    $linkfaculty = true;
	}
    } else {
	if ($options['website_type']==1) {
	    // Option sollte eigentlich nicht moeglich sein. Aber zur
	    // moglichen zukünftigen Nutzung eingebaut.
	     $linkhomeimg = true;
	} elseif ($options['website_type']==2) {
	     $linkhomeimg = true;
	} elseif ($options['website_type']==3) {
	    $linkhome = false;
       
	}
    }

    $charset = fau_get_language_main();
    
    if (isset($options['default_home_orga'])) {
	$orga = $options['default_home_orga'];
    } else {
	$orga = 'fau';
    }
    $hometitle = $shorttitle = $homeurl = $linkimg = '';
    if ((isset($default_fau_orga_data[$orga])) && is_array($default_fau_orga_data[$orga])) {
	$hometitle = $default_fau_orga_data[$orga]['title'];
	$shorttitle = $default_fau_orga_data[$orga]['shorttitle'];
	if (isset($default_fau_orga_data[$orga]['homeurl_'.$charset])) {
	    $homeurl = $default_fau_orga_data[$orga]['homeurl_'.$charset];
	} else {
	    $homeurl = $default_fau_orga_data[$orga]['homeurl'];
	}
	$linkimg = $default_fau_orga_data[$orga]['home_imgsrc'];
    } else {
	$linkhome = false;
    }
   
    $facultytitle = $facultyshorttitle = $facultyurl = '';
    if (($linkfaculty) && isset($default_fau_orga_data['_faculty'][$options['website_usefaculty']])) {
	$orga =  $options['website_usefaculty'];
	$facultytitle = $default_fau_orga_data['_faculty'][$orga]['title'];
	$facultyshorttitle = $default_fau_orga_data['_faculty'][$orga]['shorttitle'];

	if (isset($default_fau_orga_data['_faculty'][$orga]['homeurl_'.$charset])) {
	    $facultyurl = $default_fau_orga_data['_faculty'][$orga]['homeurl_'.$charset];
	} else {
	    $facultyurl = $default_fau_orga_data['_faculty'][$orga]['homeurl'];
	}
	
	
    } else {
	$linkfaculty = false;
    }

    
    
    $thislist = '';
    
    
    if (($linkhome) && isset($homeurl)) {
	$thislist .= '<li class="fauhome">';
	$thislist .= '<a href="'.$homeurl.'">';
	    			
	if ($linkhomeimg) {
	    $thislist .= '<img src="'.fau_esc_url($linkimg).'" alt="'.esc_attr($hometitle).'">'; 
	} else {
	    $thislist .= __('Zur','fau').' '.$shorttitle; 
	}	
	$thislist .= '</a>';
	$thislist .= '</li>'."\n";	
    }
    

    if (($linkfaculty) && isset($facultyurl)) {
	$thislist .= '<li data-wpel-link="internal" class="facultyhome">';
	$thislist .= '<a href="'.$facultyurl.'">';
	if ($options['default_faculty_useshorttitle']) {
	    $thislist .= $facultyshorttitle; 
	} else {
	    $thislist .= $facultytitle; 
	}
	$thislist .= '</a>';
	$thislist .= '</li>'."\n";	
    }

    
    
    if ( has_nav_menu( 'meta' ) ) {
	// wp_nav_menu( array( 'theme_location' => 'meta', 'container' => false, 'items_wrap' => '<ul id="meta-nav" class="%2$s">%3$s</ul>' ) );
	
	 $menu_name = 'meta';

	    if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
		$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
		$menu_items = wp_get_nav_menu_items($menu->term_id);
		foreach ( (array) $menu_items as $key => $menu_item ) {
		    $title = $menu_item->title;
		    $url = $menu_item->url;
		    $class_names = '';
		    $classes[] = 'menu-item';
		    $classes = empty( $menu_item->classes ) ? array() : (array) $menu_item->classes;
		    $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ) ) ); 
		    $class_names = ' class="' . esc_attr( $class_names ) . '"';
		    $thislist .= '<li'.$class_names.'><a data-wpel-link="internal" href="' . $url . '">' . $title . '</a></li>';
		}
	    } 
	
    } else {
	foreach($uselist as $key => $entry ) {
	   if (substr($key,0,4) != 'link') {
	       continue;
	   }
	   $thislist .= '<li';
	   if (isset($entry['class'])) {
	       $thislist .= ' class="'.$entry['class'].'"';
	   }
	   $thislist .= '>';
	   if (isset($entry['content'])) {
	       $thislist .= '<a data-wpel-link="internal" href="'.$entry['content'].'">';
	   }
	   $thislist .= $entry['name'];
	   if (isset($entry['content'])) {
	       $thislist .= '</a>';
	   }
	   $thislist .= "</li>\n";
       }   
    }
    if (isset($thislist)) {	
	$result .= '<ul id="meta-nav" class="menu">';
	$result .= $thislist;
	$result .= '</ul>';	
	$result .= "\n";	
    }
    return $result;
	     
    
  
}



function fau_main_menu_fallback() {
    global $options;
    $output = '';
    $some_pages = get_pages(array('parent' => 0, 'number' => $options['default_mainmenu_number'], 'hierarchical' => 0));
    if($some_pages) {
        foreach($some_pages as $page) {
            $output .= sprintf('<li class="menu-item level1"><a href="%1$s">%2$s</a></li>', get_permalink($page->ID), $page->post_title);
        }
        
        $output = sprintf('<ul role="navigation" aria-label="%1$s" id="nav">%2$s</ul>', __('Navigation', 'fau'), $output);
    }   
    return $output;
}



function fau_custom_excerpt($id = 0, $length = 0, $withp = true, $class = '', $withmore = false, $morestr = '', $continuenextline=false) {
  global $options;
    
    if ($length==0) {
	$length = $options['default_excerpt_length'];
    }
    
    if (empty($morestr)) {
	$morestr = $options['default_excerpt_morestring'];
    }
    
    $excerpt = get_the_excerpt(); // get_post_field('post_excerpt',$id);
 
    if (mb_strlen(trim($excerpt))<5) {
	$excerpt = get_post_field('post_content',$id);
    }

    $excerpt = preg_replace('/\s+(https?:\/\/www\.youtube[\/a-z0-9\.\-\?&;=_]+)/i','',$excerpt);
    $excerpt = strip_shortcodes($excerpt);
    $excerpt = strip_tags($excerpt, $options['custom_excerpt_allowtags']); 
  
  if (mb_strlen($excerpt)<5) {
      $excerpt = '<!-- '.__( 'Kein Inhalt', 'fau' ).' -->';
  }
    
  $needcontinue =0;
  if (mb_strlen($excerpt) >  $length) {
	$str = mb_substr($excerpt, 0, $length);
	$needcontinue = 1;
  }  else {
	$str = $excerpt;
  }
	    
    $the_str = '';
    if ($withp) {
	$the_str .= '<p';
	if (isset($class)) {
	    $the_str .= ' class="'.$class.'"';
	}
	$the_str .= '>';
    }
    $the_str .= $str;
    
    if (($needcontinue==1) && ($withmore==true)) {
	    if ($continuenextline) {
		  $the_str .= '<br>';
	    }
	    $the_str .= $morestr;
    }
  
    if ($withp) {
	$the_str .= '</p>';
    }
  return $the_str;
}

/**
 * CMS-Workflow Plugin
 */
function is_workflow_translation_active() {
    global $cms_workflow;
    if ((class_exists('Workflow_Translation')) && (isset($cms_workflow->translation) && $cms_workflow->translation->module->options->activated)) {
        return true;
    }
    return false;
}

function fau_get_rel_alternate() {
    if ((class_exists('Workflow_Translation')) && (function_exists('get_rel_alternate')) && (is_workflow_translation_active())) {
        return Workflow_Translation::get_rel_alternate();
    } else {
        return '';
    }
}



/* Refuse spam-comments on media */
function filter_media_comment_status( $open, $post_id ) {
	$post = get_post( $post_id );
	if( $post->post_type == 'attachment' ) {
		return false;
	}
	return $open;
}
add_filter( 'comments_open', 'filter_media_comment_status', 10 , 2 );

/* 
 * Create String for Publisher Info, used by Scema.org Microformat Data
 */

function fau_create_schema_publisher($withrahmen = true) {
    $out = '';
    if ($withrahmen) {
	$out .= '<div itemprop="publisher" itemscope itemtype="https://schema.org/Organization">'."\n";  
    }
    $header_image = get_header_image();
    if ($header_image) {
	$out .= "\t".'<div itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">'."\n";
	$out .= "\t\t".'<meta itemprop="url" content="'.fau_make_absolute_url( $header_image ).'">'."\n";
	$out .= "\t\t".'<meta itemprop="width" content="'.get_custom_header()->width.'">'."\n";
	$out .= "\t\t".'<meta itemprop="height" content="'.get_custom_header()->height.'">'."\n";
	$out .= "\t".'</div>'."\n";
    }
    $out .= "\t".'<meta itemprop="name" content="'.get_bloginfo( 'title' ).'">'."\n";
    $out .= "\t".'<meta itemprop="url" content="'.home_url( '/' ).'">'."\n";
    if ($withrahmen) {
	$out .= '</div>'."\n";
    }
    return $out;
}


/* 
 * Suchergebnisse 
*/

/* 
 * Optionaler Suchfilter
 */
function fau_searchfilter($query) {
    global $options;
    if ($query->is_search && !is_admin() ) {
	if(isset($_GET['post_type'])) {
	    $types = (array) $_GET['post_type'];
	} else {
	    $types = $options['search_post_types'];
	  //  $types = array("person", "post", "page", "attachment");
	  //  $types = array("attachment","person");
	}
	$allowed_types = get_post_types(array('public' => true, 'exclude_from_search' => false));
	foreach($types as $type) {
	    if( in_array( $type, $allowed_types ) ) { $filter_type[] = $type; }
	}
	if(count($filter_type)) {
	    $query->set('post_type',$filter_type);
	}	
        $query->set('post_status', array('publish','inherit'));

    }
}
add_filter("pre_get_posts","fau_searchfilter");

/* 
 * Keine Bilder bei der Suche ausgeben. Attachments und Posts/Pages sonst aber ja
 */
function fau_search_remove_images($where) {
    global $wpdb;
    if (!is_admin() ) {
	$where.=' AND '.$wpdb->posts.'.post_mime_type NOT LIKE \'image/%\'';
    }
    return $where;
}
add_filter( 'posts_where' , 'fau_search_remove_images' );


/*
 * Sortierung
 */
add_filter('posts_orderby','fau_sort_custom',10,2);
function fau_sort_custom( $orderby, $query ){
    global $wpdb;

    if(!is_admin() && is_search())
    //    $orderby =  $wpdb->prefix."posts.post_type ASC, {$wpdb->prefix}posts.post_date DESC";
	 $orderby =  $wpdb->prefix."posts.post_modified DESC";

    return  $orderby;
}




function fau_wp_link_query_args( $query ) {
     // check to make sure we are not in the admin
   //  if ( !is_admin() ) {
          $query['post_type'] = array( 'post', 'page', 'person'  ); // show only posts and pages
   //  }
     return $query;
}
add_filter( 'wp_link_query_args', 'fau_wp_link_query_args' ); 



if ( ! function_exists( 'fau_comment' ) ) :
/**
 * Template for comments and pingbacks.
 */
function fau_comment( $comment, $args, $depth ) {
        $GLOBALS['comment'] = $comment;
        global $options;         
        
        switch ( $comment->comment_type ) :
                case '' :
        ?>
        <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
          <div id="comment-<?php comment_ID(); ?>">
            <article itemprop="comment" itemscope itemtype="http://schema.org/UserComments">
              <header>  
                <div class="comment-details">
                    
                <span class="comment-author vcard" itemprop="creator" itemscope itemtype="http://schema.org/Person">
                    <?php if ($options['advanced_comments_avatar']) {
                        echo '<div class="avatar" itemprop="image">';
                        echo get_avatar( $comment, 48); 
                        echo '</div>';   
                    } 
                    printf( __( '%s <span class="says">schrieb am</span>', 'fau' ), sprintf( '<cite class="fn" itemprop="name">%s</cite>', get_comment_author_link() ) ); 
                    ?>
                </span><!-- .comment-author .vcard -->
              

                <span class="comment-meta commentmetadata"><a itemprop="url" href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time itemprop="commentTime" datetime="<?php comment_time('c'); ?>">
                    <?php
                          /* translators: 1: date, 2: time */
                       printf( __( '%1$s um %2$s Uhr', 'fau' ), get_comment_date(),  get_comment_time() ); ?></time></a> <?php echo __('folgendes','fau');?>:
                  
                </span><!-- .comment-meta .commentmetadata -->
                </div>
              </header>
		     <?php if ( $comment->comment_approved == '0' ) : ?>
                        <em><?php _e( 'Kommentar wartet auf Freischaltung.', 'fau' ); ?></em>
                        <br />
                <?php endif; ?>
                <div class="comment-body" itemprop="commentText"><?php comment_text(); ?></div>
		 <?php edit_comment_link( __( '(Bearbeiten)', 'fau' ), ' ' ); ?>
            </article>
          </div><!-- #comment-##  -->

        <?php
                        break;
                case 'pingback'  :
                case 'trackback' :
        ?>
        <li class="post pingback">
                <p><?php _e( 'Pingback:', 'fau' ); ?> <?php comment_author_link(); edit_comment_link( __('Bearbeiten', 'fau'), ' ' ); ?></p>
        <?php
                        break;
        endswitch;
}
endif;



function revealid_add_id_column( $columns ) {
   $columns['revealid_id'] = 'ID';
   return $columns;
}

function revealid_id_column_content( $column, $id ) {
  if( 'revealid_id' == $column ) {
    echo $id;
  }
}

if ($options['advanced_reveal_pages_id']) {
    add_filter( 'manage_pages_columns', 'revealid_add_id_column', 5 );
    add_action( 'manage_pages_custom_column', 'revealid_id_column_content', 5, 2 );
}

function fau_get_image_attributs($id=0) {
    global $options;

        $precopyright = ''; // __('Bild:','fau').' ';
        if ($id==0) return;
        
        $meta = get_post_meta( $id );
        if (!isset($meta)) {
         return;
        }
    
        $result = array();
	if (isset($meta['_wp_attachment_image_alt'][0])) {
	    $result['alt'] = trim(strip_tags($meta['_wp_attachment_image_alt'][0]));
	} else {
	    $result['alt'] = "";
	}   

        if (isset($meta['_wp_attachment_metadata']) && is_array($meta['_wp_attachment_metadata'])) {        
	    $data = unserialize($meta['_wp_attachment_metadata'][0]);
	    if (isset($data['image_meta']) && is_array($data['image_meta'])) {
		if (isset($data['image_meta']['copyright'])) {
		       $result['copyright'] = trim(strip_tags($data['image_meta']['copyright']));
		}
		if (isset($data['image_meta']['author'])) {
		       $result['author'] = trim(strip_tags($data['image_meta']['author']));
		} elseif (isset($data['image_meta']['credit'])) {
		       $result['credit'] = trim(strip_tags($data['image_meta']['credit']));
		}
		if (isset($data['image_meta']['title'])) {
		     $result['title'] = $data['image_meta']['title'];
		}
		if (isset($data['image_meta']['caption'])) {
		     $result['caption'] = $data['image_meta']['caption'];
		}
	    }
	    $result['orig_width'] = $data['width'];
	    $result['orig_height'] = $data['height'];
	    $result['orig_file'] = $data['file'];
	    
        }
	
        $attachment = get_post($id);
	$result['excerpt'] = $result['credits'] = $result['description']= $result['title'] = '';
        if (isset($attachment) ) {
	   
	    if (isset($attachment->post_excerpt)) {
		$result['excerpt'] = trim(strip_tags( $attachment->post_excerpt ));
	    }
	    if (isset($attachment->post_content)) {
		$result['description'] = trim(strip_tags( $attachment->post_content ));
	    }        
	    if (isset($attachment->post_title) && (empty( $result['title']))) {
		 $result['title'] = trim(strip_tags( $attachment->post_title )); 
	    }   
        }      
	
	if ($options['advanced_images_info_credits'] == 1) {
	    
	    if (!empty($result['description'])) {
		$result['credits'] = $result['description'];
	    } elseif (!empty($result['copyright'])) {
		$result['credits'] = $precopyright.' '.$result['copyright'];	
	    } elseif (!empty($result['author'])) {
		$result['credits'] = $precopyright.' '.$result['author'];
	    } elseif (!empty($result['credit'])) {
		$result['credits'] = $precopyright.' '.$result['credit'];	
   	    } else {
		if (!empty($result['caption'])) {
		    $result['credits'] = $result['caption'];
		} elseif (!empty($result['excerpt'])) {
		    $result['credits'] = $result['excerpt'];
		} 
	    } 
	} else {
	
	    if (!empty($result['copyright'])) {
		$result['credits'] = $precopyright.' '.$result['copyright'];		
	    } elseif (!empty($result['author'])) {
		$result['credits'] = $precopyright.' '.$result['author'];
	    } elseif (!empty($result['credit'])) {
		$result['credits'] = $precopyright.' '.$result['credit'];		
		} else {
		if (!empty($result['description'])) {
		    $result['credits'] = $result['description'];
		} elseif (!empty($result['caption'])) {
		    $result['credits'] = $result['caption'];
		} elseif (!empty($result['excerpt'])) {
		    $result['credits'] = $result['excerpt'];
		} 
	    }   
	}
        return $result;
                
}


function fau_array2table($array, $table = true) {
    $out = '';
    $tableHeader = '';
    foreach ($array as $key => $value) {
	 $out .= '<tr>';
	 $out .= "<th>$key</th>";
        if (is_array($value)) {   
            if (!isset($tableHeader)) {
                $tableHeader =
                    '<th>' .
                    implode('</th><th>', array_keys($value)) .
                    '</th>';
            }
            array_keys($value);
	    $out .= "<td>";
            $out .= fau_array2table($value, true);     
	    $out .= "</td>";
        } else {
            $out .= "<td>$value</td>";
        }
	$out .= '</tr>';
    }

    if ($table) {
        return '<table>' . $tableHeader . $out . '</table>';
    } else {
        return $out;
    }
}


add_filter('the_content', 'remove_empty_p', 20, 1);
function remove_empty_p($content){
    $content = force_balance_tags($content);
    return preg_replace('#<p>\s*+(<br\s*/*>)?\s*</p>#i', '', $content);
}

add_filter('the_content', 'remove_accordion_bad_br', 20, 1);
function remove_accordion_bad_br($content){
   // $content = force_balance_tags($content);
    return preg_replace('#<br\s*/*>\s*<div class="accordion#i', '<div class="accordion', $content);
}

add_filter('the_content', 'remove_bad_p', 20, 1);
function remove_bad_p($content){
   // $content = force_balance_tags($content);
    $content = preg_replace('#<p><div #i', '<div ', $content);
    return preg_replace('#</div></p>#i', '</div>', $content);
}

add_filter('wp_list_categories','categories_postcount_filter');
function categories_postcount_filter ($variable) {
   $variable = str_replace('(', '<span class="post_count">(', $variable);
   $variable = str_replace(')', ')</span>', $variable);
   return $variable;
}






/* 
 * Get category links for front page
 */

function fau_get_category_links($cateid = 0) {
    global $options;
    
    if ($cateid==0) {
	$cateid = $options['start_link_news_cat'];
    }
    $link = get_category_link($cateid);
    if (empty($link)){
	 $cat = get_categories(); 
	 $cateid = $cat[0]->cat_ID;
     }
    $res = '';
    if ($cateid) {
	$res .= '<div class="news-more-links">'."\n";
	$res .= "\t".'<a class="news-more" href="'.get_category_link($cateid).'">'.$options['start_link_news_linktitle'].'</a>';
	$res .= '<a class="news-rss" href="'.get_category_feed_link($cateid).'">'.__('RSS','fau').'</a>';
	$res .= "</div>\n";	
    }
    return $res;
}



/**
 * Force srcset urls to be relative
 */
add_filter( 'wp_calculate_image_srcset', function( $sources )
{
    if(	! is_array( $sources ) )
       	return $sources;

    foreach( $sources as &$source )
    {
        if( isset( $source['url'] ) )
            $source['url'] = fau_esc_url( $source['url']);
    }
    return $sources;

}, PHP_INT_MAX );

