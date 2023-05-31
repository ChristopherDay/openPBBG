<?php
class userRolesTemplate extends template {
    public $validateAccount = '
        <div class="text-center">
            <p class="text-center">
                Before you can play you need to activate your account. 
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
    ';

    public $roleHolder = '
    {#each users}
    <div class="user-holder">
        <p>{name} ({cooldown}) <span class="commit"><a href="?page=userRoles&action=commit&user={id}">Commit</a></span></p>
        <div class="user-perc">
            <div class="perc" style="width:{percent}%;"></div>
        </div>
    </div>
    {/each}
    {#unless users}
        <div class="text-center"><em>There are no users</em></div>
    {/unless}';

    public $roleList = '
    <div class="card">
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th width="50px">ID</th>
                        <th>Role</th>
                        <th width="100px">Color</th>
                        <th width="100px">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    {#each userRoles}
                        <tr>
                            <td>{id}</td>
                            <td>{name}</td>
                            <td>{color}</td>
                            <td>
                                [<a href="?page=admin&module=userRoles&action=edit&id={id}">Edit</a>] 
                                [<a href="?page=admin&module=userRoles&action=delete&id={id}">Delete</a>]
                            </td>
                        </tr>
                    {/each}
                </tbody>
            </table>
        </div>
    </div>
    ';

    public $roleDelete = '
        <form method="post" action="?page=admin&module=userRoles&action=delete&id={id}&commit=1">
            <div class="text-center">
                <p> Are you sure you want to delete this user role?</p>
                <p><em>"{name}"</em></p>
                <button class="btn btn-danger" name="submit" type="submit" value="1">
                    Yes delete this user role
                </button>
            </div>
        </form>
    ';

<<<<<<< HEAD
    public $roleForm = '
        <form method="post" action="?page=admin&module=userRoles&action={editType}&id={id}">
            <div class="row g-3">
                <div class="col-md-6 col-xl-7">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h3 class="card-title">Main</h3>
                            <div class="form-group mb-3">
                                <label class="fw-bold mb-1">Name</label>
                                <input type="text" class="form-control" name="name" value="{name}">
                            </div>
                            <div class="form-group mb-3">
                                <label class="fw-bold mb-1">Color</label> 
                                <input type="color" name="color" value="{color}" class="form-control form-control-color">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-5">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h3 class="card-title">Admin Modules</h3>
                            <div class="row flex-row">
                                {#each modules}
                                    <div class="col-lg-6 col-xl-6">
                                    <div class="form-group mb-3 py-1">
                                        <input class="form-check-input me-1" type="checkbox" name="access[]" value="{id}" {#if selected}checked{/if} id="mod_{id}"/>
                                        <label class="form-check-label fw-bold" for="mod_{id}">{pageName}</label>
                                    </div>
                                    </div>
                                {/each}
                            </div>
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
=======
        public $roleForm = '
            <form method="post" action="?page=admin&module=userRoles&action={editType}&id={id}">
                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group">
                            <label class="fw-bold mb-1">Name</label>
                            <input type="text" class="form-control" name="name" value="{name}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="fw-bold mb-1">
                                Color <br />
                                <input type="color" name="color" value="{color}">
                            </label> 
                        </div>
                    </div>
                </div>

                <h3>Admin Modules</h3>
                <ul class="list-group">
                    {#each modules}
                        <li class="list-group-item col-md-4">
                            <input type="checkbox" name="access[]" value="{id}" {#if selected} checked {/if} /> {pageName}
                        </li>
                    {/each}
                </ul>
                <div class="clearfix"></div>

                <div class="text-end">
                    <button class="btn btn-default" name="submit" type="submit" value="1">
                        Save
                    </button>
                </div>
            </form>
        ';
    }
>>>>>>> 6f4c9c97c9b74bec1896842bec19ed9d865a1afd
