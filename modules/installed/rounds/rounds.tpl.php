<?php
class roundsTemplate extends template {
		public $clearData = '
			<p class="text-center">
				Press the button below to clear the round data, this will not clear down users but will reset certain aspects og the game ready for the next round.
			</p>
			<p class="text-center">
				<a href="?page=admin&module=rounds&action=clear&do=true" class="btn btn-danger">
					Clear Round Data
				</a>
			</p>
		';

		public $roundsList = '
		<div class="card mb-3">
			<div class="card-body">
				<table class="table">
					<thead>
						<tr>
							<th>Name</th>
							<th width="200">Start</th>
							<th width="200">End</th>
							<th width="100">Actions</th>
						</tr>
					</thead>
					<tbody>
						{#each rounds}
							<tr>
								<td>{name}</td>
								<td>{startDate}</td>
								<td>{endDate}</td>
								<td>
									[<a href="?page=admin&module=rounds&action=edit&id={id}">Edit</a>] 
									[<a href="?page=admin&module=rounds&action=delete&id={id}">Delete</a>]
								</td>
							</tr>
						{/each}
					</tbody>
				</table>
			</div>
		</div>
		';

		public $roundsDelete = '
			<form method="post" action="?page=admin&module=rounds&action=delete&id={id}&commit=1">
				<div class="text-center">
					<p> Are you sure you want to delete this round?</p>
					<p><em>"{name}"</em></p>
					<button class="btn btn-danger" name="submit" type="submit" value="1">Yes delete this round</button>
				</div>
			</form>
		';
		public $roundsForm = '
			<form method="post" action="?page=admin&module=rounds&action={editType}&id={id}">
				<div class="card mb-3">
					<div class="card-body">
						<div class="form-group mb-3">
							<label class="fw-bold mb-1">Round Name</label>
							<input type="text" class="form-control" name="name" value="{name}">
						</div>
						<div class="form-group mb-3">
							<label class="fw-bold mb-1">Start Date</label>
							<input type="datetime-local" class="form-control" name="start" value="{start}">
						</div>
						<div class="form-group mb-3">
							<label class="fw-bold mb-1">Value ($)</label>
							<input type="datetime-local" class="form-control" name="end" value="{end}">
						</div>
					</div>
				</div>
				<div class="text-end">
					<button class="btn btn-primary" name="submit" type="submit" value="1">Save</button>
				</div>
			</form>
		';
	}

