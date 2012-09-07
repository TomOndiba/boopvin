<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Wines Theme plugin
 *
 */

elgg_register_event_handler('init', 'system', 'winetheme_init');





/**
 * Initialize the wine plugin.
 */
function winetheme_init() {
    

	//extend some views
	//elgg_extend_view('css/elgg', 'winetheme/css');
    //$winetheme_jq = elgg_get_simplecache_url('css', 'vendors/jquery/ui/theme');
    
    
    elgg_unregister_page_handler('activity');
    elgg_register_page_handler ('activity','winetheme_river_page_handler');

        $url = 'mod/winetheme/vendors/winetheme/winetheme.js';
        elgg_register_js('jquery.winetheme', $url,'footer');
        elgg_load_js('jquery.winetheme');
    
    
    elgg_unregister_css('hj.framework.jquitheme');
    
    // pouvoir réecrire ds le plugin la fonction friends_page_handler sans toucher au core Elgg 
    elgg_unregister_page_handler('friends') ;
    elgg_register_page_handler('friends','friends_winetheme_page_handler') ;
    
    //elgg_register_css('winetheme.jquitheme', $winetheme_jq);
    
    $jquery_UI_css = elgg_get_simplecache_url('css', 'winetheme/JqueryUI_css');
    elgg_register_css('winetheme.jqueryUI_css', $jquery_UI_css,'head',1000);
    elgg_load_css('winetheme.jqueryUI_css');
    
    $googlemap_url="http://maps.google.com/maps/api/js?sensor=true";
    elgg_register_js('elgg.googlemap',$googlemap_url);

    // Now, override some default

    // override some default
    //$winetheme_css = elgg_get_simplecache_url('css', 'winetheme/winetheme_css');
    //elgg_register_css('winetheme.winetheme_css', $winetheme_css,'head',1000);
    //elgg_load_css('winetheme.winetheme_css');
    elgg_extend_view('css/elgg', 'winetheme_css/winetheme_css');
    elgg_register_plugin_hook_handler('index', 'system', 'custom_index');

    elgg_register_plugin_hook_handler('index', 'system', 'custom_index');

}

function custom_index($hook, $type, $return, $params) {
	if ($return == true) {
		// another hook has already replaced the front page
		return $return;
	}

	if (!include_once(dirname(__FILE__) . "/index.php")) {
		return false;
	}

	// return true to signify that we have handled the front page
	return true;
}

function winetheme_river_page_handler() {
	
	require_once (dirname(__FILE__) . "/pages/river.php");
			
	return true;
}

function friends_winetheme_page_handler($page_elements, $handler) {
	elgg_set_context('friends');
	
	if (isset($page_elements[0]) && $user = get_user_by_username($page_elements[0])) {
		elgg_set_page_owner_guid($user->getGUID());
	}
	if (elgg_get_logged_in_user_guid() == elgg_get_page_owner_guid()) {
		collections_submenu_items();
	}

	switch ($handler) {
		case 'friends':
			require_once (dirname(__FILE__) . "/pages/friends/index.php");
			break;
		case 'friendsof':
			require_once(dirname(dirname(dirname(__FILE__))) . "/pages/friends/of.php");
			break;
		default:
			return false;
	}
	return true;
}



