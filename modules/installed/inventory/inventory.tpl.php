<?php

	function _qty($qty) {
		if ($qty > 1) return "x" . number_format($qty); 
		return "";
	}

    class inventoryTemplate extends template {

		public $information = '
            <div class="card">
                <div class="card-header">
                    {name}
                </div>
                <div class="card-body">
                    <p>
                        [{description}]
                    </p>
                </div>  
            </div>
            <div class="row text-start">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            Information
                        </div>
                        <div class="card-body">
                            {#each information}
                                {#if label}<strong>{label}:</strong>{/if} <{value}><br />
                            {/each}
                        </div>  
                    </div>
                </div>
                <div class="col-md-6">

                    <div class="card">
                        <div class="card-header">
                            Effects
                        </div>
                        <div class="card-body">
                            <ul>
                                {#each effects}
                                    <li>[{desc}]</li>
                                {/each}
                            </ul>
                        </div>  
                    </div>
                </div>
            </div>
        ';

        public $inventory = '
			<div class="row">
				<div class="col-md-7">
					<div class="card">
						<div class="card-header">
							Inventory
						</div>
						<div class="card-body">
							{#unless inventory}
								<p class="text-center">
									<em>You don\'t have any items!</em>
								</p>
							{/unless}
							{#each inventory}
								{>inventoryItem}
							{/each}
						</div>
					</div>
				</div>
				<div class="col-md-5">
					<div class="card">
						<div class="card-header">
							Equiped
						</div>
						<div class="card-body">
							{#each equipSlots}
								{>equipSlot}
							{/each}
						</div>
					</div>
				</div>
			</div>
		';

		public $equipSlot = '
			<strong>{name}</strong>
			{>equipedItem}
		';

		public $equipedItem = '
    		<div class="crime-holder">
                <p>
                    <span class="action">
                    	{item.name}
                		{#unless item}
                			Not equiped
                		{/unless}
                    </span> 
            		{#unless item}
                    	<span class="cooldown">&nbsp;</span>
            		{/unless}
                    {#if item}
	                    <a href="?page=inventory&action=remove&slot={name}&_CSFR={_CSFRToken}" class="commit">
	                    	Remove
	                    </a>
                    {/if}
                </p>
            </div>
		';

		public $inventoryItem = '
            <div class="crime-holder inventory-item">
                <p data-toggle="dropdown">
                    <span class="action">
                    	{name}
                    </span> 
                    <span class="cooldown">
                    	{_qty qty}
                    </span> 
                    <a href="#" class="commit show-options">
                    	Actions
                    </a>
                </p>
				<ul class="list-group inventory-actions">
					{#each links}
						<a href="{link}&_CSFR={_CSFRToken}" class="list-group-item">
							{name}
						</a>
					{/each}
				</ul>
            </div>
		';

        public $itemList = '
        <div class="card mb-3">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th width="100px">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        {#each items}
                            <tr>
                                <td>{name}</td>
                                <td>
                                    [<a href="?page=admin&module=inventory&action=edit&id={id}">Edit</a>] 
                                    [<a href="?page=admin&module=inventory&action=delete&id={id}">Delete</a>]
                                </td>
                            </tr>
                        {/each}
                    </tbody>
                </table>
            </div>
        </div>
        ';

        public $itemDelete = '
            <form method="post" action="?page=admin&module=inventory&action=delete&id={id}&commit=1">
                <div class="text-center">
                    <p> Are you sure you want to delete this item?</p>

                    <p><em>"{name}"</em></p>

                    <button class="btn btn-danger" name="submit" type="submit" value="1">Yes delete this item</button>
                </div>
            </form>
        
        ';
        public $calculator = '

            <h2>Using a {weapon} (x{damage})</h2>

            <div style="width: 100%; overflow-x: auto">
                <table class="table table-striped no-dt table-bordered table-condensed text-center">
                    <thead>
                        <tr>
                            <th class="text-center" colspan="2">
                                Rank
                            </th>
                            <th class="text-center" colspan="{colCount}">
                                Bullets needed to kill
                            </th>
                        </tr>
                        <tr>
                            <th class="text-center">Name</th>
                            <th class="text-center">Base Health</th>
                            {#each cols}
                                <th class="text-center">{name} (x{damage})</th>
                            {/each}
                        </tr>
                    </thead>
                    <tbody>
                        {#each rows}
                            <tr>
                                {#each cols}
                                    <td>
                                        {#if header}<strong>{/if}
                                        {data}
                                        {#if header}</strong>{/if}
                                    </td>
                                {/each}
                            </tr>
                        {/each}
                </table>
            </div>
        ';
        public $weaponSelect = '
            <form method="post" action="?page=admin&module=inventory&action=calculator">
                <div class="form-group mb-3">
                    <label class="fw-bold mb-1">What weapon is the user shooting with</label>
                    <select class="form-control" name="weapon">
                        <option disabled selected value="0">Select a weapon</option>
                        {#each weapons}
                            <option value="{id}">{name}</option>
                        {/each}
                    </select>
                </div>
                <div class="text-end">
                    <button class="btn btn-primary" name="submit" type="submit" value="1">View</button>
                </div>
            </form>
        ';
            
        public $formSelect = '
            <div class="col-md-{width}">
                <div class="form-group mb-3">
                    <label class="fw-bold mb-1">{label}</label>
                    <select class="form-control" name="meta[ {id} ]" data-value="{value}">
                        {#each options}
                            <option value="{id}">{name}</option>
                        {/each}
                    </select>
                </div>
            </div>
        ';
            
        public $formText = '
            <div class="col-md-{width}">
                <div class="form-group mb-3">
                    <label class="fw-bold mb-1">{label}</label>
                    <input type="text" class="form-control" name="meta[ {id} ]" value="{value}">
                </div>
            </div>
        ';
            
        public $formNumber = '
            <div class="col-md-{width}">
                <div class="form-group mb-3">
                    <label class="fw-bold mb-1">{label}</label>
                    <input type="number" class="form-control" name="meta[ {id} ]" value="{value}">
                </div>
            </div>
        ';
            
        public $formTextarea = '
            <div class="col-md-{width}">
                <div class="form-group mb-3">
                    <label class="fw-bold mb-1">{label}</label>
                    <textarea class="form-control" name="meta[ {id} ]">{value}</textarea>
                </div>
            </div>
        ';

        public $itemForm = '
        <form method="post" action="?page=admin&module=inventory&action={editType}&id={id}">
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h4 class="card-title">Item Information</h4>
                            <div class="form-group mb-3">
                                <label class="fw-bold mb-1">Item Name</label>
                                <input type="text" class="form-control" name="name" value="{name}">
                            </div>
                            <div class="form-group mb-3">
                                <label class="fw-bold mb-1">
                                    Item Type
                                </label>
                                <select class="form-control" name="type" data-value="{type}">
                                    {#each itemTypes}
                                        <option value="{id}" data-item-type="{type}">{name}</option>
                                    {/each}
                                </select>
                            </div>
                            <div class="row">
                                {{inputs}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">
                                Effects
                                <a href="#" class="btn btn-success btn-xs float-end new-effect">
                                    New Effect
                                </a>
                            </h5>
                            <div class="effect-data" style="display: none;">
                                {#each effectTypes}{name}.--.{type}.-.{/each}
                            </div>
                            <div class="item-effects" style="display: none;">
                                {#each effect}
                                    <div class="item-effect">
                                        <div class="effect">{id} </div>
                                        <div class="value">{value}</div>
                                        <div class="desc">{desc}</div>
                                    </div>

                                {/each}
                            </div>
                            <div class="effects"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-end">
                <button class="btn btn-primary" name="submit" type="submit" value="1">Save</button>
            </div>
        </form>

        ';

	}