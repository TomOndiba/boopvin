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


 
function new_index() {
    if (!include_once(dirname(dirname(__FILE__)) . "/winetheme/views/index.php"))
        return false;
 
    return true;
}


/**
 * Initialize the wine plugin.
 */
function winetheme_init() {
   // Replace the default index page
    //elgg_register_plugin_hook_handler('index', 'system', 'new_index');    

	//extend some views
	//elgg_extend_view('css/elgg', 'winetheme/css');
    //$winetheme_jq = elgg_get_simplecache_url('css', 'vendors/jquery/ui/theme');
    elgg_unregister_menu_item('topbar', 'elgg_logo');
    //elgg_unregister_menu_item('river', 'comment');
    
    
    
    
    elgg_unregister_plugin_hook_handler('output:before', 'layout', 'elgg_views_add_rss_link');
    elgg_unregister_plugin_hook_handler('register', 'menu:river', 'elgg_river_menu_setup');
    elgg_register_plugin_hook_handler('register', 'menu:river', 'winetheme_river_menu_setup');
    
    elgg_unregister_page_handler('activity');
    elgg_register_page_handler ('activity','winetheme_river_page_handler');

     
    
    
    elgg_unregister_css('hj.framework.jquitheme');

    // pouvoir rÃ©ecrire ds le plugin la fonction friends_page_handler sans toucher au core Elgg 
    elgg_unregister_page_handler('friends');
    elgg_register_page_handler('friends', 'friends_winetheme_page_handler');

    
    //unregister and register action core for modif
    $action_base = elgg_get_plugins_path() . 'winetheme/actions';
    
    elgg_unregister_action('avatar/crop');  
    elgg_register_action('avatar/crop',"$action_base/avatar/crop.php");
    
    elgg_unregister_action('avatar/upload');  
    elgg_register_action('avatar/upload',"$action_base/avatar/upload.php");
    
    elgg_unregister_action('friends/add');  
    elgg_register_action('friends/add',"$action_base/friends/add.php");

    //elgg_register_css('winetheme.jquitheme', $winetheme_jq);
    
    $jquery_UI_css = elgg_get_simplecache_url('css', 'winetheme/JqueryUI_css');
    elgg_register_simplecache_view('css/winetheme/JqueryUI_css');
    elgg_register_css('winetheme.jqueryUI_css', $jquery_UI_css,'head',1000);
    elgg_load_css('winetheme.jqueryUI_css');

    $googlemap_url = "http://maps.google.com/maps/api/js?sensor=true";
    elgg_register_js('elgg.googlemap', $googlemap_url);

    //vendors
    $url = 'mod/winetheme/vendors/nyromodal/jquery.nyroModal.custom.min.js';
    elgg_register_js('elgg.modal', $url);
    elgg_load_js('elgg.modal');

    $url = 'mod/winetheme/vendors/validate/jquery.validate.min.js';
    elgg_register_js('elgg.validate', $url);
    
    $url = 'mod/winetheme/vendors/validate/gen_validatorv31.js';
    elgg_register_js('elgg.gen_validatorv31', $url);
    
    /* nivo script and css*/
    //$url = 'mod/winetheme/vendors/nivo-slider/jquery.nivo.slider.js';
    //elgg_register_js('elgg.nivo', $url,'footer');
 
    
    //$nivoslider_css = elgg_get_simplecache_url('css', 'nivoslider/nivoslider');
    //elgg_register_simplecache_view('css/nivoslider/nivoslider');
    //elgg_register_css('nivoslider.nivoslider_css', $nivoslider_css,'head');

    
    
    
    /* coin script and css*/
    $url = 'mod/winetheme/vendors/coinslider/coin-slider.min.js';
    elgg_register_js('elgg.coin', $url,'footer');
 
    
    $coinslider_css = elgg_get_simplecache_url('css', 'coinslider/coinslider');
    elgg_register_simplecache_view('css/coinslider/coinslider');
    elgg_register_css('coinslider.coinslider_css', $coinslider_css,'head');
    
    
    
    
    
    
    $popup_js = elgg_get_simplecache_url('js', 'simple_popup');
    elgg_register_simplecache_view('js/simple_popup');
    elgg_register_js('elgg.popup', $popup_js, 'footer');
    
    $winetheme_js = elgg_get_simplecache_url('js', 'winetheme');
    elgg_register_simplecache_view('js/winetheme');
    elgg_register_js('jquery.winetheme', $winetheme_js,'footer');
    //elgg_load_js('jquery.winetheme');
 
    // Now, override some default

    // override some default
    //$winetheme_css = elgg_get_simplecache_url('css', 'winetheme/winetheme_css');
    //elgg_register_css('winetheme.winetheme_css', $winetheme_css,'head',1000);
    //elgg_load_css('winetheme.winetheme_css');
    //elgg_extend_view('css/elgg', 'winetheme_css/winetheme_css');
    
    elgg_extend_view('css/elgg', 'css/contact/contact');
    elgg_extend_view('css/elgg', 'css/degusts/degusts');
    elgg_extend_view('css/elgg', 'css/overlay/overlay');
    elgg_extend_view('css/elgg', 'css/restobars/restobars');
    elgg_extend_view('css/elgg', 'css/search/search');
    elgg_extend_view('css/elgg', 'css/winetheme/winetheme');
    

     
    elgg_extend_view('css/elgg', 'css/wines/wines');
    
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
                        elgg_unregister_menu_item('page','friends:view:collections');
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

/**
 * Add the comment and like links to river actions menu
 * @access private
 */
function winetheme_river_menu_setup($hook, $type, $return, $params) {
	if (elgg_is_logged_in()) {
		$item = $params['item'];
		$object = $item->getObjectEntity();
		// comments and non-objects cannot be commented on or liked
		
		
		if (elgg_is_admin_logged_in()) {
			$options = array(
				'name' => 'delete',
				'href' => "action/river/delete?id=$item->id",
				'text' => elgg_view_icon('delete'),
				'title' => elgg_echo('delete'),
				'confirm' => elgg_echo('deleteconfirm'),
				'is_action' => true,
				'priority' => 200,
			);
			$return[] = ElggMenuItem::factory($options);
		}
	}

	return $return;
}



