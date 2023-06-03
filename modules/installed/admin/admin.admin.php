<?php
    class adminModule {

        public function method_search() {

            $users = $this->db->selectAll("SELECT * FROM users WHERE U_name LIKE :search OR U_email LIKE :search", array(
                ":search" => "%" . $this->methodData->search . "%"
            ));


            $links = array();

            foreach ($this->page->modules as $key => $val) {
                if (isset($val["admin"])) {
                    foreach ($val["admin"] as $k => $link) {
                        if (isset($link["hide"]) && $link["hide"]) continue;

                        $links[] = array(
                            "label" => $val["name"] . ' - ' . $link["text"], 
                            "url" => "/page/admin/" . $link["method"] ."?module=".$val["id"]
                        );

                    }
                }
            }

            $acpOptions = array();
            foreach ($links as $acpOption) {
                if (strpos(strtolower($acpOption["label"]), strtolower($this->methodData->search)) > -1) {
                    $acpOptions[] = $acpOption;
                } 
            }

            echo $this->page->buildElement("searchResults", array(
                "search" => $this->methodData->search, 
                "users" => $users, 
                "acpOptions" => $acpOptions, 
                "userCount" => count($users) > 3
            ));

            exit;

        }

        public function method_view() {

            $widgets = array();

            $charts = new Hook("adminWidget-chart");
            $charts = $charts->run($this->user);

            if ($charts) {
                foreach ($charts as $chart) {
                    $widgets[] = array(
                        "size" => $chart["size"],
                        "sort" => (isset($chart["sort"])?$chart["sort"]:0),
                        "html" => $this->page->buildElement("widgetChart", $chart)
                    );
                }
            }

            $tables = new Hook("adminWidget-table");
            $tables = $tables->run($this->user);

            if ($tables) {
                foreach ($tables as $table) {
                    $widgets[] = array(
                        "size" => $table["size"],
                        "sort" => (isset($table["sort"])?$table["sort"]:0),
                        "html" => $this->page->buildElement("widgetTable", $table)
                    );
                }
            }

            $htmlWidgets = new Hook("adminWidget-html");
            $htmlWidgets = $htmlWidgets->run($this->user);

            if ($htmlWidgets) {
                foreach ($htmlWidgets as $htmlElement) {
                    $widgets[] = array(
                        "size" => $htmlElement["size"],
                        "sort" => (isset($htmlElement["sort"])?$htmlElement["sort"]:0),
                        "html" => $this->page->buildElement("widgetHTML", $htmlElement)
                    );
                }
            }

            $alerts = new Hook("adminWidget-alerts");
            $alerts = $alerts->run($this->user);

            if ($alerts) {
                foreach ($alerts as $alert) {
                    if (isset($alert["text"])) $this->page->alert($alert["text"], $alert["type"]);
                }
            }

            $widgets = array_values($this->page->sortArray($widgets));

            $tmp = array();
            $cols = 0;           
            foreach ($widgets as $key => $widget) {
                $cols += $widget["size"];
                $tmp[] = $widget;

                $nextKey = $key + 1;
                if (isset($widgets[$nextKey])) {
                    if ($cols + $widgets[$nextKey]["size"] > 12) {
                        $tmp[] = array("divider" => 1);
                        $cols = 0;
                    }
                }

            }

            $widgets = $tmp;

            $this->html .= $this->page->buildElement("widgets", array(
                "widgets" => $widgets
            ));

        }

    }
?>