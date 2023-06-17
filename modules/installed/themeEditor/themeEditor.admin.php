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
        		if (in_array($key, array("submit", "page", "module", "action", "_sidebars"))) continue;
        		$themeSettings[$key] = $val;
        	}	
        	$settings->update($settingToGet, $themeSettings);
            $this->html .= $this->page->buildElement("success", array(
                "text" => "Theme settings updated."
            ));
        }

        $themeSettings["_sidebars"] = $this->page->menus;

        return $themeSettings;
	}

    public function method_export() {

        if (isset($this->methodData->settings)) {

            $settings = new settings();
            $json = json_decode(file_get_contents($this->methodData->settings["tmp_name"]), true);

            if (json_last_error() === JSON_ERROR_NONE) {

                if (isset($json["themeSettings"])) {
                    $settings->update("themeSettings", $json["themeSettings"]);
                }
                if (isset($json["loginSettings"])) {
                    $settings->update("loginSettings", $json["loginSettings"]);
                }

                $this->page->alert("Settings updated!", "success");
            } else {
                $this->page->alert("Invalid JSON file uploaded!");
            }

        }

        if (isset($this->methodData->get)) {
            $data = array(
                "themeSettings" => $this->getSettings("themeSettings"),
                "loginSettings" => $this->getSettings("loginSettings")
            );

            header('Content-disposition: attachment; filename=themeExport.json');
            header('Content-type: application/json');
            echo json_encode($data, JSON_PRETTY_PRINT);
            exit;
        }

        $this->html .= $this->page->buildElement("export");
    }

    public function method_layout() {
        $this->html .= $this->page->buildElement("layout", $this->getSettings("themeSettings"));
    }

    public function method_login() {
        $this->html .= $this->page->buildElement("login", $this->getSettings("loginSettings"));
    }


}
