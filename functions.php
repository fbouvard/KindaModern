<?php

// functions file
// "KM" stands for kindaModern != Wordpress native stuff


// disable admin bar
add_filter('show_admin_bar', '__return_false');


// add support for formats
add_theme_support('post-formats', array('aside', 'link'));


// customize the navigation
if(!function_exists('theme_pagination')) {
	
    function theme_pagination() {
	
	global $wp_query, $wp_rewrite;
	$wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
	
	if ($wp_query->max_num_pages < 8) {

		$pagination = array(
			'base' => @add_query_arg('page','%#%'),
			'format' => '',
			'total' => $wp_query->max_num_pages,
			'current' => $current,
		    'show_all' => false,
		    'end_size' => 1,
		    'mid_size' => 8,
			'type' => 'list',
			'next_text' => 'Suiv.',
			'prev_text' => 'Prec.'
		);
	}
	
	else {
		
		$pagination = array(
			'base' => @add_query_arg('page','%#%'),
			'format' => '',
			'total' => $wp_query->max_num_pages,
			'current' => $current,
		    'show_all' => false,
		    'end_size' => 1,
		    'mid_size' => 1,
			'type' => 'list',
			'next_text' => 'Suiv.',
			'prev_text' => 'Prec.'
		);
	}
	
	if($wp_rewrite->using_permalinks())
		$pagination['base'] = user_trailingslashit(trailingslashit(remove_query_arg('s', get_pagenum_link(1))) . 'page/%#%/', 'paged' );
	
	if(!empty($wp_query->query_vars['s']))
		$pagination['add_args'] = array('s' => str_replace(' ' , '+', get_query_var('s')));
		
	echo str_replace('page/1/','', paginate_links($pagination));
    }	
}


// add a class to nav buttons
add_filter('next_posts_link_attributes', 'km_next_posts_link_attributes');
add_filter('previous_posts_link_attributes', 'km_previous_posts_link_attributes');

function km_next_posts_link_attributes() {
    return 'class="next"';
}

function km_previous_posts_link_attributes() {
    return 'class="previous"';
}


// redirects permalinks to external url from [url] custom fields
function km_external_permalink($permalink) {

	global $post;
	
	$thePostID = $post->ID;
	$post_id = get_post($thePostID);
	$title = $post_id->post_title;
	
	$post_keys = array(); $post_val  = array();
	$post_keys = get_post_custom_keys($thePostID);

	if (!empty($post_keys)) {
		foreach ($post_keys as $pkey) {
			if ($pkey=='url')
				$post_val = get_post_custom_values($pkey);
    	}
    	if (empty($post_val))
    		$link = $permalink;
    	else
    		$link = $post_val[0];
	}
	
	else {
  	  $link = $permalink;
	}
	
	return $link;
}


// redirects permalinks
add_filter('the_permalink','km_external_permalink');
add_filter('the_permalink_rss','km_external_permalink');


// avoid single word line break
// returns the string with correct linebreak
function km_prevent_widow($string = '') {

	$string = rtrim($string);
	$space = strrpos($string, ' ');
	
	if ($space !== false) {
		$string = substr($string, 0, $space).'&nbsp;'.substr($string, $space + 1);
	}
	
	return $string;
}


// get the root url of links
// returns the real root url
function km_get_root_url($url = '') {
	
	$url = str_replace('http://', '', $url);
	$url = str_replace('www.', '', $url);
	
	if (strpos($url, '/') !== false)
		$url = substr($url, 0, strpos($url, '/'));
	
	if ($url == 'youtu.be') $url = 'youtube.com';
	if ($url == 'flic.kr') $url = 'flickr.com';
	if ($url == 'macrumo.rs') $url = 'macrumors.com';
	if ($url == 'cl.ly') $url = 'cloudapp.com';
	if ($url == 'instagr.am') $url = 'instagram.com';
	if ($url == 'd.pr') $url = 'droplr.com';
	if ($url == 'drbl.in') $url = 'dribbble.com';
	if ($url == 'fb.me') $url = 'facebook.com';
	if ($url == 'df4.us ') $url = 'daringfireball.com';
	
	return $url;
}


// generates the copyright info
// returns the author name linking to his url/meail/nothing and the current year
function km_get_copyright() {

	$user_url = get_the_author_meta('user_url');
	$user_email = get_the_author_meta('user_email');
	$user_name = get_the_author_meta('display_name');
	$year = date('Y');
	
	if($user_url)
		$copyright = '<p>Écrit par <a href="'.$user_url.'">'.$user_name.'</a> ©&nbsp;'.$year.'</p>';

	else if ($user_email)
		$copyright = '<p>Écrit par <a href="mailto:'.$user_email.'">'.$user_name.'</a> ©&nbsp;'.$year.'</p>';

	else if ($user_name)
		$copyright = '<p>Écrit par '.$user_name.' ©&nbsp;'.$year.'</p>';

	else
		$copyright = '<p>Tout droits réservés ©&nbsp;'.$year.'</p>';
	
	return $copyright;
}


// builds the metas of each post
// returns the right meta depending of the category and the custom fields
function km_get_meta(){
	
	global $post;
	
	if (has_post_format('aside') && is_user_logged_in())
		$meta = '<span class="meta">Édition spéciale<span class="star">&nbsp;★</span> <a href="'.get_edit_post_link().'">edit</a></span>';

	else if (has_post_format('aside'))
		$meta = '<span class="meta">Édition spéciale<span class="star">&nbsp;★</span></span>';

	else {
		$external_url = get_post_meta($post->ID, 'url', true);
		$content_type = get_post_meta($post->ID, 'type', true);
		
		if (is_user_logged_in() && $external_url)
			$meta = '<span class="meta">'.km_get_root_url($external_url).' <a rel="bookmark" href="'.get_permalink().'">perma</a> <a href="'.get_edit_post_link().'">edit</a></span>';
			
		else if ($external_url)
			$meta = '<span class="meta">'.km_get_root_url($external_url).' <a rel="bookmark" href="'.get_permalink().'">perma</a></span>';
		else if (is_user_logged_in())
			$meta = '<span class="meta"><a href="'.get_edit_post_link().'">edit</a></span>';
	}
	
	return $meta;
}

?>