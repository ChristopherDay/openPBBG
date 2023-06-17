<?php

    class adminModule {

        public function method_desc() {

            $settings = new settings();

            if (isset($this->methodData->submit)) {
                $settings->update("loginSuffix", $this->methodData->loginSuffix);
                $this->html .= $this->page->buildElement("success", array(
                    "text" => "Game description updated."
                ));
            }


            $output = array(
                "loginSuffix" => $settings->loadSetting("loginSuffix")
            );

            $this->html .= $this->page->buildElement("gameDesc", $output);

        }

        public function method_info() {

            $settings = new settings();

            if (isset($this->methodData->submit)) {
                $settings->update("loginPostfix", $this->methodData->loginPostfix);
                $this->html .= $this->page->buildElement("success", array(
                    "text" => "Game information updated."
                ));
            }


            $output = array(
                "loginPostfix" => $settings->loadSetting("loginPostfix")
            );

            $this->html .= $this->page->buildElement("gameInfo", $output);

        }

    }