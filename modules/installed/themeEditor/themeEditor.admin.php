<?php

/**
* This module allows you to edit the Gangster Legends default template
*
* @package Theme Editor
* @author Chris Day
* @version 1.0.0
*/


class adminModule {

	public function getSettings($settingToGet) {
        $settings = new settings();
        $themeSettings = $settings->loadSetting($settingToGet, 1, array());
        if (isset($this->methodData->submit)) {
        	foreach ($this->methodData as $key => $val) {
        		if (in_array($key, array("submit", "page", "module", "action"))) continue;
        		$themeSettings[$key] = $val;
        	}	
        	$settings->update($settingToGet, $themeSettings);
            $this->html .= $this->page->buildElement("success", array(
                "text" => "Theme settings updated."
            ));
        }
        return $themeSettings;
	}

    public function method_layout() {
        $this->html .= $this->page->buildElement("layout", $this->getSettings("themeSettings"));
    }

    public function method_login() {
        $this->html .= $this->page->buildElement("login", $this->getSettings("loginSettings"));
    }


}
