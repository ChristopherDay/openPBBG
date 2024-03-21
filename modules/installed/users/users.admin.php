<?php
class adminModule {
	private function getUser($userID, $search = false) {
		if ($userID === false) {
			return array();
		}
		if ($search) {
			$add = " WHERE `U_id` = :id OR `U_name` LIKE :search OR `U_email` LIKE :search";
		} else {
			$add = " WHERE `U_id` = :id";
		}
		$sql = "SELECT
			`U_id` as 'id',
			`U_name` as 'name',
			`U_email` as 'email',
			`R_name` as 'round'
		FROM `users`
		LEFT OUTER JOIN `rounds` ON (`R_id` = `U_round`)
		" . $add . "
		ORDER BY `U_id`";
		if ($search) {
			$searchTerm = "%".$userID."%";
			return $this->db->selectAll($sql, array(
				":id" => $userID,
				":search" => $searchTerm
			));
		} else {
			return $this->db->select($sql, array(
				":id" => $userID
			));
		}
	}

	private function validateUser($data, $id) {
		$errors = array();
		if (!isset($data)) {
			$errors[] = "Inputs empty";
		}
		if (strlen($data["name"]) < 2) {
			$errors[] = "User name is to short, this must be at least 2 characters";
		}
		if (isset($data["userLevel"]) && $id == 1 && $data["userLevel"] !== 2) {
			$errors[] = "User ID 1 must be an admin";
		}
		return $errors;
	}

	public function method_view () {
		if (!isset($this->methodData->user)) {
			$this->methodData->user = "";
		}
		$this->html .= $this->page->buildElement("userList", array(
			"submit" => true,
			"user" => $this->methodData->user,
			"users" => $this->getUser($this->methodData->user, true),
		));
	}

	public function method_edit () {
		if (!isset($this->methodData->id)) {
			return $this->html = $this->page->buildElement("error", array("text" => "No user ID specified"));
		}
		$this->methodData->id = (int) abs(intval($this->methodData->id));
		$u = new User($this->methodData->id);
		if (!$u->info->US_id){
			return $this->html = $this->page->buildElement("error", array("text" => "No user found"));
		}
		$output = [];
		if (isset($this->methodData->submit)) {
			$inputFields = (array) $this->methodData->field;
			$errors = $this->validateUser($inputFields, $u->info->US_id);
			if (count($errors)) {
				foreach ($errors as $error) {
					$this->page->alert($error);
				}
			} else {
				// Call the editUserInput hook
				$inputsHook = new Hook("editUserInput");
				foreach ($inputsHook->run($u) as $input) {
					if (isset($inputFields) && isset($input['id']) && isset($inputFields[$input['id']])) {
						// Clear user value
						if($input['value_type'] == "integer"){
							$value = abs(intval($inputFields[$input['id']]));
						}
						else{
							$value = $inputFields[$input['id']];
						}
						// Update user fields
						$input['update']($value);
					}
				}
				// Update output
				$u = new User($this->methodData->id);
				$output["inputs"] = $this->getInputs($u);
				$this->page->alert("This user has been updated", "success");
			}
		}
		$output["inputs"] = $this->getInputs($u);
		$output["user"] = $u->user;
		$output["editType"] = "edit";
		$this->html .= $this->page->buildElement("userForm", $output);
	}

	public function method_delete() {
		if (!isset($this->methodData->id)) {
			return $this->html = $this->page->buildElement("error", array("text" => "No user ID specified"));
		}
		$this->methodData->id = (int) abs(intval($this->methodData->id));
		$user = $this->getUser($this->methodData->id);
		if (!isset($user["id"])) {
			return $this->html = $this->page->buildElement("error", array("text" => "This user does not exist"));
		}
		// Check if the user to be deleted is the current user or user with ID 1
		if ($user["id"] == $this->user->info->U_id || $user["id"] == 1) {
			return $this->html = $this->page->buildElement("error", array("text" => "You cannot delete this user"));
		}
		if (isset($this->methodData->commit)) {
			// Call the deleteUserEntries hook
			$hook = new Hook("deleteUserEntries");
			$hook->run($this->methodData->id);
			// Redirect to the admin page after deletion
			$this->page->redirectTo("admin", ['module' => 'users']);
		}
		$this->html .= $this->page->buildElement("userDelete", $user);
	}

	public function getInputs ($user, $fields = []) {
		$hook = new Hook("editUserInput");
		$inputsHook = $this->page->sortArray($hook->run($user));
		$html = "";
		foreach ($inputsHook as $input) {
			switch ($input["type"]) {
				case "text":
					$html .= $this->page->buildElement("formText", $input);
				break;
				case "textarea":
					$html .= $this->page->buildElement("formTextarea", $input);
				break;
				case "number":
					$html .= $this->page->buildElement("formNumber", $input);
				break;
				case "select": 
					$html .= $this->page->buildElement("formSelect", $input);
				break;
				case "checkbox": 
					$html .= $this->page->buildElement("formCheckbox", $input);
				break;
				case "sep": 
					$html .= $this->page->buildElement("formSep", $input);
				break;
				case "multiselect": 
					$html .= $this->page->buildElement("formMultiSelect", $input);
				break;
			}
		}
		return $html;
	}
}