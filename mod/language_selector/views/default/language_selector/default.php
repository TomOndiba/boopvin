<?php 
	global $CONFIG;
	
	$allowed = language_selector_get_allowed_translations();
	$current_lang_id = get_current_language();
	
	if(count($allowed) > 1){
		// show text or flags
		$show_flags = false;
		if(elgg_get_plugin_setting("show_images", "language_selector") != "no"){
			$show_flags = true;
		}
		foreach($allowed as $lang_id){
			$lang_name = elgg_echo($lang_id);
			$text = "";
			$action = "";
			
			if(!empty($result)){
				$result .= " | ";
			}
			 
			if($current_lang_id != $lang_id){
				if(elgg_is_logged_in()){
					$action = elgg_add_action_tokens_to_url($vars['url'] . "action/language_selector/change?lang_id=" . $lang_id);
				} else {
					
					$action = "javascript:setLanguage(\"" . $lang_id . "\");";
				}				
			} 
			
			if($show_flags){
				
				$flag_file = "mod/language_selector/_graphics/flags/" . $lang_id . ".gif";
				
				if(file_exists($CONFIG->path . $flag_file)){
					//$text = "<img src='" . $vars["url"] . $flag_file . "' alt='" . $lang_name . "' title='" . $lang_name . "'>";
                                        $text = "<img src='" .  elgg_normalize_url($flag_file) . "' alt='" . $lang_name . "' title='" . $lang_name . "'>";
				}
			}
                        
			
			if(empty($text)){
				$text = $lang_id;
			}
			
			if(!empty($action)){
				$result .= "<a href='" . $action . "' title='" . $lang_name . "'>" . $text . "</a>";
			} else {
				$result .= $text;	
			}				
		}
		
                // on place le sélecteur dans la liste des menus elgg-menu-topbar-alt
		$result = "<ul class='language_selector_top elgg-menu elgg-menu-topbar elgg-menu-topbar-alt'>" . $result . "</ul>";

		if(!elgg_is_logged_in()){
                    $result = "<div class='language_selector elgg-menu elgg-menu-topbar elgg-menu-topbar-alt'>" . $result . "</div>";
?>              
		<script type="text/javascript">
			function setLanguage(lang_id){
				setCookie("client_language", lang_id, 30);
				document.location.href = document.location.href;			
			}
			function setCookie(c_name,value,expiredays){
				var exdate = new Date();
				exdate.setDate(exdate.getDate() + expiredays);
				document.cookie = c_name + "=" + escape(value) + ";Path=/" + ((expiredays == null) ? "" : ";expires=" + exdate.toGMTString());
			}
		</script>
<?php 	
		}
	}
	
	echo $result;
	