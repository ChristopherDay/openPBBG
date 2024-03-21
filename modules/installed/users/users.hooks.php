<?php
// Alert to show players they need to activate their account
new Hook("userInformation", function ($user) {
    global $page;
    if (!in_array($_GET['page'], ['users', 'admin']) && $user->info->U_status !== 1) {
        $alertMessage = "Your account is not activated. Please <a href='?page=users'>activate your account</a>.";
        $page->alert($alertMessage, "warning");
    }
});

// * Clear user entries hook
new Hook('deleteUserEntries', function ($userId) {
	global $db;
	$db->delete("DELETE FROM `users` WHERE `U_id` = :id;", [":id" => $userId]);
	$db->delete("DELETE FROM `userStats` WHERE `US_id` = :id;", [":id" => $userId]);
	$db->delete("DELETE FROM `userTimers` WHERE `UT_user` = :id;", [":id" => $userId]);
});


// * Edit users Inputs
new Hook('editUserInput', function ($profile) {
	global $db;
	return array(
		'id' => 'name',
		'label' => 'User Name',
		'sort' => 1,
		'width_md' => 6,
		'width_lg' => 6,
		'width_xl' => 6,
		'type' => 'text',
		'value' => $profile->info->U_name,
		'validate' => function ($value) {
			return true;
		},
		'value_type' => 'string',
		'update' => function ($value) use ($profile) {
			$profile->set('U_name', $value);
		}
	);
});
new Hook('editUserInput', function ($profile) {
	global $db;
	return array(
		'id' => 'email',
		'label' => 'Email',
		'sort' => 2,
		'width_md' => 6,
		'width_lg' => 6,
		'width_xl' => 6,
		'type' => 'text',
		'value' => $profile->info->U_email,
		'validate' => function ($value) {
			return true;
		},
		'value_type' => 'string',
		'update' => function ($value) use ($profile) {
			$profile->set('U_email', $value);
		}
	);
});
new Hook('editUserInput', function ($profile) {
	global $db;
	return array(
		'id' => 'avatar',
		'label' => 'Profile Picture',
		'sort' => 3,
		'width_md' => 12,
		'type' => 'text',
		'value' => $profile->info->US_pic,
		'validate' => function ($value) {
			return true;
		},
		'value_type' => 'string',
		'update' => function ($value) use ($profile) {
			$profile->set('US_pic', $value);
		}
	);
});
new Hook('editUserInput', function ($profile) {
	global $db;
	return array(
		'id' => 'bio',
		'label' => 'User Bio',
		'sort' => 4,
		'width_md' => 12,
		'type' => 'textarea',
		'value' => $profile->info->US_bio,
		'rows' => 12,
		'validate' => function ($value) {
			return true;
		},
		'value_type' => 'string',
		'update' => function ($value) use ($profile) {
			$profile->set('US_bio', $value);
		}
	);
});

new Hook('editUserInput', function ($profile) {
	global $db;
	return array(
		'sort' => 10,
		'width_md' => 12,
		'type' => 'sep',
	);
});
new Hook('editUserInput', function ($profile) {
	global $db;
	$options = [
		['id' => 0, 'name' => 'Dead'],
		['id' => 1, 'name' => 'Alive'],
		['id' => 2, 'name' => 'Awaiting Email Verification'],
	];
	foreach ($options as $k => $value) {
		$options[$k]['selected'] = ($value['id'] == $profile->info->U_status);
	}
	return array(
		'id' => 'userStatus',
		'label' => 'User Alive',
		'sort' => 10,
		'width_md' => 6,
		'width_lg' => 4,
		'width_xl' => 3,
		'type' => 'select',
		'options' => $options,
		'validate' => function ($value) {
			return true;
		},
		'value_type' => 'integer',
		'update' => function ($value) use ($profile) {
			$profile->set('U_status', $value);
		}
	);
});
new Hook('editUserInput', function ($profile) {
	global $db;
	$options = $db->selectAll("SELECT `UR_id` as 'id', `UR_desc` as 'name' FROM `userRoles` ORDER BY `UR_desc`");
	foreach ($options as $k => $value) {
		$options[$k]['selected'] = ($value['id'] == $profile->info->U_userLevel);
	}
	return array(
		'id' => 'userLevel',
		'label' => 'User Role',
		'sort' => 10,
		'width_md' => 6,
		'width_lg' => 4,
		'width_xl' => 3,
		'type' => 'select',
		'options' => $options,
		'validate' => function ($value) {
			return true;
		},
		'value_type' => 'integer',
		'update' => function ($value) use ($profile) {
			$profile->set('U_userLevel', $value);
		}
	);
});
new Hook('editUserInput', function ($profile) {
	global $db;
	return array(
		'sort' => 100,
		'width_md' => 12,
		'type' => 'sep',
	);
});

new Hook('editUserInput', function ($profile) {
	global $db;
	return array(
		'id' => 'exp',
		'label' => 'User Exp',
		'sort' => 100,
		'width_md' => 6,
		'width_lg' => 4,
		'width_xl' => 3,
		'type' => 'number',
		'value' => $profile->info->US_exp,
		'validate' => function ($value) {
			return true;
		},
		'value_type' => 'integer',
		'update' => function ($value) use ($profile) {
			$profile->set('US_exp', $value);
		}
	);
});
new Hook('editUserInput', function ($profile) {
	global $db;
	return array(
		'id' => 'cash',
		'label' => 'User Cash',
		'sort' => 100,
		'width_md' => 6,
		'width_lg' => 4,
		'width_xl' => 3,
		'type' => 'number',
		'value' => $profile->info->US_money,
		'validate' => function ($value) {
			return true;
		},
		'value_type' => 'integer',
		'update' => function ($value) use ($profile) {
			$profile->set('US_money', $value);
		}
	);
});
new Hook('editUserInput', function ($profile) {
	global $db;
	return array(
		'id' => 'bank',
		'label' => 'User Bank',
		'sort' => 100,
		'width_md' => 6,
		'width_lg' => 4,
		'width_xl' => 3,
		'type' => 'number',
		'value' => $profile->info->US_bank,
		'validate' => function ($value) {
			return true;
		},
		'value_type' => 'integer',
		'update' => function ($value) use ($profile) {
			$profile->set('US_bank', $value);
		}
	);
});
new Hook('editUserInput', function ($profile) {
	global $db;
	return array(
		'id' => 'points',
		'label' => 'User Points',
		'sort' => 100,
		'width_md' => 6,
		'width_lg' => 4,
		'width_xl' => 3,
		'type' => 'number',
		'value' => $profile->info->US_points,
		'validate' => function ($value) {
			return true;
		},
		'value_type' => 'integer',
		'update' => function ($value) use ($profile) {
			$profile->set('US_points', $value);
		}
	);
});
new Hook('editUserInput', function ($profile) {
	global $db;
	return array(
		'sort' => 200,
		'width_md' => 12,
		'type' => 'sep',
	);
});