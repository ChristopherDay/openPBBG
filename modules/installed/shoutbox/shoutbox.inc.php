<?php
    class shoutbox extends module {
        
        public $allowedMethods = array(
        	"text" => array( "type" => "POST" )
        );

        public function method_reply() {
            if (isset($this->methodData->text)) {
                $chat = $this->db->insert("
                    INSERT INTO `chat` (CH_user, CH_time, CH_text) VALUES (:u, :t, :txt)
                ", array(
                    ":u" => $this->user->id, 
                    ":t" => time(), 
                    ":txt" => $this->methodData->text
                ));

                $rm = $this->db->delete("
                    DELETE FROM chat WHERE CH_id < :id
                ", array(
                    ":id" => $chat - 10
                ));
            }
        }

        public function getHistory() {
            $history = $this->db->selectAll("
                SELECT
                    CH_text as 'text', 
                    CH_user as 'user', 
                    CH_time as 'time'
                FROM chat
                ORDER BY CH_id ASC
            ");

            foreach ($history as $key => $value) {
                $u = new User($value["user"]);
                $value["user"] = $u->user;
                $value["date"] = date("H:i:s", $value["time"]);
                $history[$key] = $value;
            }

            return $history;

        }

        public function constructModule() {
            $this->html .= $this->page->buildElement("shoutbox", array(
                "history" => $this->getHistory()
            ));
        }

        public function method_sidebar() {
            $this->html .= $this->page->buildElement("chatSidebar", array(
                "history" => $this->getHistory()
            ));
            $this->construct = false;
        }

        public function method_history() {
            $this->html .= $this->page->buildElement("chatHistory", array(
                "history" => $this->getHistory()
            ));
            $this->construct = false;
        }

    }