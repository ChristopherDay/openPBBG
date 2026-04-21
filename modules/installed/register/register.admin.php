<?php

    class adminModule {

        public function method_settings() {
            $settings = new settings();

            if (isset($this->methodData->submit)) {

                /* validate inputs */
                $validateEmail = isset($this->methodData->validateUserEmail) ? 1 : 0;
                $enableRegistration = isset($this->methodData->enableRegistration) ? 1 : 0;
                $minPasswordLength = isset($this->methodData->minPasswordLength) ? (int)$this->methodData->minPasswordLength : 6;
                $passwordRequireNumber = isset($this->methodData->passwordRequireNumber) ? 1 : 0;
                $passwordRequireSpecialChar = isset($this->methodData->passwordRequireSpecialChar) ? 1 : 0;

                $settings->update("validateUserEmail", $validateEmail);
                $settings->update("enableRegistration", $enableRegistration);
                $settings->update("minPasswordLength", $minPasswordLength);
                $settings->update("passwordRequireNumber", $passwordRequireNumber);
                $settings->update("passwordRequireSpecialChar", $passwordRequireSpecialChar);
                $this->html .= $this->page->buildElement("success", array(
                    "text" => "Theme options updated."
                ));
            }
            $output = array(
                "validateUserEmail" => $settings->loadSetting("validateUserEmail", true, 0),
                "enableRegistration" => $settings->loadSetting("enableRegistration", true, 1),
                "minPasswordLength" => $settings->loadSetting("minPasswordLength", true, 6),
                "passwordRequireNumber" => $settings->loadSetting("passwordRequireNumber", true, 0),
                "passwordRequireSpecialChar" => $settings->loadSetting("passwordRequireSpecialChar", true, 0)
            );
            $this->html .= $this->page->buildElement("registerOptions", $output);
        }

        public function method_page() {
            $settings = new settings();
            if (isset($this->methodData->submit)) {
                $settings->update("registerSuffix", $this->methodData->registerSuffix);
                $this->html .= $this->page->buildElement("success", array(
                    "text" => "Theme options updated."
                ));
            }
            $output = array(
                "registerSuffix" => $settings->loadSetting("registerSuffix")
            );
            $this->html .= $this->page->buildElement("pageText", $output);
        }

        public function method_footer() {
            $settings = new settings();
            if (isset($this->methodData->submit)) {
                $settings->update("registerPostfix", $this->methodData->registerPostfix);
                $this->html .= $this->page->buildElement("success", array(
                    "text" => "Theme options updated."
                ));
            }


            $output = array(
                "registerPostfix" => $settings->loadSetting("registerPostfix")
            );

            $this->html .= $this->page->buildElement("footerText", $output);

        }

    }