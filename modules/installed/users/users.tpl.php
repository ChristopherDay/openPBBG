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

        public $userHolder = '
        {#each users}
        <div class="user-holder">
            <p>{name} ({cooldown}) <span class="commit"><a href="?page=users&action=commit&user={id}">Commit</a></span></p>
            <div class="user-perc">
                <div class="perc" style="width:{percent}%;"></div>
            </div>
        </div>
        {/each}
        {#unless users}
            <div class="text-center"><em>There are no users</em></div>
        {/unless}';

        public $userList = '

            <form method="post" action="?page=admin&module=users&action=view">

                <div class="row">
                    <div class="col-md-8">
<<<<<<< HEAD
                        <div class="form-group mb-3">
=======
                        <div class="form-group">
>>>>>>> 6f4c9c97c9b74bec1896842bec19ed9d865a1afd
                            <label class="fw-bold mb-1">Username, ID or Email</label>
                            <input type="text" class="form-control" name="user" value="{user}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="fw-bold mb-1">&nbsp;</label>
<<<<<<< HEAD
                        <button class="btn btn-primary" type="submit">
=======
                        <button class="btn btn-default" type="submit">
>>>>>>> 6f4c9c97c9b74bec1896842bec19ed9d865a1afd
                            Search for users
                        </button>
                    </div>
                </div>

            </form>

            <hr />
            <table class="table table-condensed table-responsive table-striped table-bordered">
                <thead>
                    <tr>
                        <th width="50px">ID</th>
                        <th>User</th>
                        <th width="150px">Round</th>
                        <th width="100px">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    {#each users}
                        <tr>
                            <td>{id}</td>
                            <td>{name}</td>
                            <td>
                                {#if round}
                                    {round}
                                {else}
                                    <strong>Unknown</strong>
                                {/if}
                            </td>
                            <td>
                                [<a href="?page=admin&module=users&action=edit&id={id}">Edit</a>] 
                                [<a href="?page=admin&module=users&action=delete&id={id}">Delete</a>]
                            </td>
                        </tr>
                    {/each}
                </tbody>
            </table>
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
            <form method="post" action="?page=admin&module=users&action={editType}&id={id}">
                <div class="row">
                    <div class="col-md-4">
<<<<<<< HEAD
                        <div class="form-group mb-3">
=======
                        <div class="form-group">
>>>>>>> 6f4c9c97c9b74bec1896842bec19ed9d865a1afd
                            <label class="fw-bold mb-1">User Name</label>
                            <input type="text" class="form-control" name="name" value="{name}">
                        </div>
                    </div>
                    <div class="col-md-4">
<<<<<<< HEAD
                        <div class="form-group mb-3">
=======
                        <div class="form-group">
>>>>>>> 6f4c9c97c9b74bec1896842bec19ed9d865a1afd
                            <label class="fw-bold mb-1">User Status</label>
                            <select class="form-control" name="userStatus" data-value="{userStatus}">
                                <option {#if isDead}selected{/if} value="0">Dead</option>
                                <option {#if isValidated}selected{/if} value="1">Alive</option>
                                <option {#if isAwaitingValidation}selected{/if} value="2">Awaiting Email Verification</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
<<<<<<< HEAD
                        <div class="form-group mb-3">
=======
                        <div class="form-group">
>>>>>>> 6f4c9c97c9b74bec1896842bec19ed9d865a1afd
                            <label class="fw-bold mb-1">User Level</label>
                            <select class="form-control" name="userLevel" data-value="{userLevel}">
                                {#each userRoles}
                                    <option value="{id}">{name}</option>
                                {/each}
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
<<<<<<< HEAD
                        <div class="form-group mb-3">
=======
                        <div class="form-group">
>>>>>>> 6f4c9c97c9b74bec1896842bec19ed9d865a1afd
                            <label class="fw-bold mb-1">Email</label>
                            <input type="text" class="form-control" name="email" value="{email}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
<<<<<<< HEAD
                        <div class="form-group mb-3">
=======
                        <div class="form-group">
>>>>>>> 6f4c9c97c9b74bec1896842bec19ed9d865a1afd
                            <label class="fw-bold mb-1">Cash</label>
                            <input type="number" class="form-control" name="money" value="{money}">
                        </div>
                    </div>
                    <div class="col-md-6">
<<<<<<< HEAD
                        <div class="form-group mb-3">
=======
                        <div class="form-group">
>>>>>>> 6f4c9c97c9b74bec1896842bec19ed9d865a1afd
                            <label class="fw-bold mb-1">Bank</label>
                            <input type="number" class="form-control" name="bank" value="{bank}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
<<<<<<< HEAD
                        <div class="form-group mb-3">
=======
                        <div class="form-group">
>>>>>>> 6f4c9c97c9b74bec1896842bec19ed9d865a1afd
                            <label class="fw-bold mb-1">EXP</label>
                            <input type="number" class="form-control" name="exp" value="{exp}">
                        </div>
                    </div>
                    <div class="col-md-6">
<<<<<<< HEAD
                        <div class="form-group mb-3">
=======
                        <div class="form-group">
>>>>>>> 6f4c9c97c9b74bec1896842bec19ed9d865a1afd
                            <label class="fw-bold mb-1">Points</label>
                            <input type="number" class="form-control" name="points" value="{points}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
<<<<<<< HEAD
                        <div class="form-group mb-3">
=======
                        <div class="form-group">
>>>>>>> 6f4c9c97c9b74bec1896842bec19ed9d865a1afd
                            <label class="fw-bold mb-1">Bullets</label>
                            <input type="text" class="form-control" name="bullets" value="{bullets}">
                        </div>
                    </div>
                    <div class="col-md-6">
<<<<<<< HEAD
                        <div class="form-group mb-3">
=======
                        <div class="form-group">
>>>>>>> 6f4c9c97c9b74bec1896842bec19ed9d865a1afd
                            <label class="fw-bold mb-1">Profile Picture</label>
                            <input type="text" class="form-control" name="pic" value="{pic}">
                        </div>
                    </div>
                </div>
<<<<<<< HEAD
                <div class="form-group mb-3">
=======
                <div class="form-group">
>>>>>>> 6f4c9c97c9b74bec1896842bec19ed9d865a1afd
                    <label class="fw-bold mb-1">Bio</label>
                    <textarea rows="8" class="form-control" name="bio">{bio}</textarea>
                </div>
                <div class="text-end">
<<<<<<< HEAD
                    <button class="btn btn-primary" name="submit" type="submit" value="1">Save</button>
=======
                    <button class="btn btn-default" name="submit" type="submit" value="1">Save</button>
>>>>>>> 6f4c9c97c9b74bec1896842bec19ed9d865a1afd
                </div>
            </form>
        ';
    }
