<?php
	class membershipTemplate extends template {

		public $memberships = '
			<div class="row">
				<div class="col-md-7">
					<div class="card">
						<div class="card-header">
							{_setting "membershipLinkName"} Benefits
						</div>
						<div class="card-body">
							<p>
								By becoming a {_setting "membershipName"} you get the following benefits:
							</p>

							<hr />
							{#each benefits}
								<p class="text-start">
									<strong>{title}</strong><br />
									{description}
								</p>
							{/each}
						</div>
					</div>

				</div>
				<div class="col-md-5">
					<div class="card">
						<div class="card-header">
							Packages
						</div>
						<div class="card-body">

		                    {#unless packages}
		                        <div class="text-center">
		                            <em>There are no memberships available</em>
		                        </div>
		                    {/unless}
		                    {#each packages}
		                        <div class="crime-holder"> 
	                                <p> 
	                                    <span class="action"> 
	                                        {desc}
	                                    </span>  
	                                    <span class="cooldown"> 
                                            {number_format cost} {_setting "pointsName"}
	                                    </span>  
                                        <a class="commit" href="?page=membership&action=buy&id={id}">
                                            Buy
                                        </a> 
	                                </p> 
		                        </div> 
		                    {/each}
						</div>
					</div>
				</div>
			</div>
		';        

        public $premiumMembershipList = '
            <table class="table table-condensed table-striped table-bordered table-responsive">
                <thead>
                    <tr>
                        <th>Package</th>
                        <th width="120px">Cost ({_setting "pointsName"})</th>
                        <th width="120px">Time</th>
                        <th width="100px">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    {#each premiumMembership}
                        <tr>
                            <td>{desc}</td>
                            <td>{cost}</td>
                            <td>{number_format seconds}</td>
                            <td>
                                [<a href="?page=admin&module=membership&action=edit&id={id}">Edit</a>] 
                                [<a href="?page=admin&module=membership&action=delete&id={id}">Delete</a>]
                            </td>
                        </tr>
                    {/each}
                </tbody>
            </table>
        ';

        public $premiumMembershipDelete = '
            <form method="post" action="?page=admin&module=membership&action=delete&id={id}&commit=1">
                <div class="text-center">
                    <p> Are you sure you want to delete this package?</p>

                    <p><em>"{desc}"</em></p>

                    <button class="btn btn-danger" name="submit" type="submit" value="1">Yes delete this package</button>
                </div>
            </form>
        
        ';
        public $premiumMembershipForm = '
            <form method="post" action="?page=admin&module=membership&action={editType}&id={id}">
                <div class="form-group">
                    <label class="fw-bold mb-1">Package Description</label>
                    <input type="text" class="form-control" name="desc" value="{desc}">
                </div>
                <div class="form-group">
                    <label class="fw-bold mb-1">Cost Of Package ({_setting "pointsName"})</label>
                    <input type="text" class="form-control" name="cost" value="{cost}">
                </div>
                <div class="form-group">
                    <label class="fw-bold mb-1">Membership time (seconds)</label>
                    <input type="number" class="form-control" name="seconds" value="{seconds}">
                </div>
                
                <div class="text-end">
                    <button class="btn btn-default" name="submit" type="submit" value="1">Save</button>
                </div>
            </form>
        ';

        public $settings = '

            <form method="post" action="?page=admin&module=membership&action=settings">

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="fw-bold mb-1">PayPal Email address</label>
                            <input type="text" class="form-control" name="membershipLinkName" value="{membershipLinkName}" />
                        </div>
                        <div class="form-group">
                            <label class="fw-bold mb-1">Currency Code (e.g. GBP or USD)</label>
                            <input type="text" class="form-control" name="membershipName" value="{membershipName}" />
                        </div>
                    </div>
                </div>
                <div class="text-end">
                    <button class="btn btn-default" name="submit" type="submit" value="1">Save</button>
                </div>
            </form>
        ';

	}

