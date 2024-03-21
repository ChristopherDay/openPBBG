<?php
class usersTemplate extends template {
	public $validateAccount = '
		<div class="card">
			<div class="card-header">Account Activation</div>
			<div class="card-body">
				<div class="text-center">
					<p class="text-center">
						Before you can play you need to activate your account. Please check your email for your validation code. This may be in your spam folder.
					</p>
					<form method="post" action="?page=users">
						<input type="text" name="code" class="form-control activation-code" value="{code}" /> 
						<button type="submit" class="btn btn-primary">
							Activate
						</button>
					</form>
					<p>
						<a href="?page=users&action=resend">Resend activation code</a>
					</p>
				</div>
			</div>
		</div>
	';

	// * ACP
	public $userList = '
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Search</h4>
			</div>
			<div class="card-body">
				<form method="post" action="?page=admin&module=users&action=view">
					<div class="input-group">
						<label class="fw-bold input-group-text">Username or ID</label>
						<input type="text" class="form-control" name="user" value="{user}">
						<button class="btn btn-primary" type="submit">Search for users</button>
					</div>
				</form>
			</div>
		</div>
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Users</h4>
			</div>
			<div class="card-body">
				<table class="table table-striped align-middle">
					<thead>
						<tr>
							<th width="50">ID</th>
							<th>User</th>
							<th width="120">Email</th>
							<th width="120">Round</th>
							<th width="60">Actions</th>
						</tr>
					</thead>
					<tbody>
						{#each users}
							<tr>
								<td>{id}</td>
								<td>{name}</td>
								<td>{email}</td>
								<td>{#if round}{round}{else}<strong>Unknown</strong>{/if}</td>
								<td>
									<a href="?page=admin&module=users&action=edit&id={id}" class="btn btn-sm btn-info" title="Edit"><i class="fas fa-edit"></i></a>
									<a href="?page=admin&module=users&action=delete&id={id}" class="btn btn-sm btn-danger" title="Delete"><i class="fa fa-trash"></i></a>
								</td>
							</tr>
						{/each}
					</tbody>
				</table>
			</div>
		</div>
	';

	public $userDelete = '
		<form method="post" action="?page=admin&module=users&action=delete&id={id}&commit=1">
			<div class="text-center">
				<p> Are you sure you want to delete this user?</p>
				<p><em>"{name}"</em></p>
				<button class="btn btn-danger" name="submit" type="submit" value="1">Yes delete this user</button>
			</div>
		</form>	
	';

	public $userForm = '
	<form method="post" action="?page=admin&module=users&action={editType}&id={user.id}">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">User Fields</h4>
			</div>
			<div class="card-body">
				<div class="row g-3">
					{{inputs}}
				</div>
			</div>
		</div>
		<div class="text-end">
			<button class="btn btn-primary" name="submit" type="submit" value="1">Save</button>
		</div>
	</form>
	';

	// * user input types
	public $formSelect = '
	<div class="{#if width_md} col-md-{width_md}{/if}{#if width_lg} col-lg-{width_lg}{/if}{#if width_xl} col-lg-{width_xl}{/if}">
		<div class="form-group mb-3">
			<label class="fw-bold mb-1">{label}:</label>
			<select class="form-control" name="field[{id}]">
				{#each options}
				<option value="{id}" {#if selected}selected{/if}>{name}</option>
				{/each}
			</select>
		</div>
	</div>
	';
	public $formMultiSelect = '
	<div class="{#if width_md} col-md-{width_md}{/if}{#if width_lg} col-lg-{width_lg}{/if}{#if width_xl} col-lg-{width_xl}{/if}">
		<div class="form-group mb-3">
			<label class="pull-left">{label}:</label>
			<select class="form-control" name="field[{id}][]"{#if size} size="{size}"{/if} multiple>
				{#each options}
				<option value="{id}">{name}</option>
				{/each}
			</select>
		</div>
	</div>
	';
	public $formCheckbox = '
	<div class="{#if width_md} col-md-{width_md}{/if}{#if width_lg} col-lg-{width_lg}{/if}{#if width_xl} col-lg-{width_xl}{/if}">
		<div class="form-group mb-3">
			<label class="fw-bold mb-1">{label}:</label>
			<div class="form-group form-switch">
				<input class="form-check-input" type="checkbox" name="field[{id}]" id="field_{id}" value="1" {#if value}checked{/if} /> 
				<label class="form-check-label" for="field_{id}">Yes?</label><br />
			</div>
		</div>
	</div>
	';
	public $formText = '
	<div class="{#if width_md} col-md-{width_md}{/if}{#if width_lg} col-lg-{width_lg}{/if}{#if width_xl} col-lg-{width_xl}{/if}">
		<div class="form-group mb-3">
			<label class="fw-bold mb-1">{label}:</label>
			<input type="text" class="form-control" name="field[{id}]" value="{value}">
		</div>
	</div>
	';
	public $formNumber = '
	<div class="{#if width_md} col-md-{width_md}{/if}{#if width_lg} col-lg-{width_lg}{/if}{#if width_xl} col-lg-{width_xl}{/if}">
		<div class="form-group mb-3">
			<label class="fw-bold mb-1">{label}:</label>
			<input type="number" class="form-control" name="field[{id}]" value="{value}">
		</div>
	</div>
	';
	public $formSep = '
	<div class="{#if width_md} col-md-{width_md}{/if}{#if width_lg} col-lg-{width_lg}{/if}{#if width_xl} col-lg-{width_xl}{/if}">
	<hr class="my-1">
	</div>
	';
	public $formTextarea = '
	<div class="{#if width_md} col-md-{width_md}{/if}{#if width_lg} col-lg-{width_lg}{/if}{#if width_xl} col-lg-{width_xl}{/if}">
		<div class="form-group mb-3">
			<label class="fw-bold mb-1">{label}:</label>
			<textarea name="field[{id}]" class="form-control" rows="10" editor-instance>{value}</textarea>
		</div>
	</div>
	';
}