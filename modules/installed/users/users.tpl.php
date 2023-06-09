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

            <div class="card mb-3">
                <h4 class="card-header bg-dark text-white">Current Users</h4>
                <div class="card-body">
                    <table class="table table-bordered table-xs">
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
                                    <td class="text-end">
                                        <a href="?page=admin&module=users&action=edit&id={id}" class="btn btn-table btn-success">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a> 
                                        <a href="?page=admin&module=users&action=delete&id={id}" class="btn btn-table btn-danger">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </a>
                                    </td>
                                </tr>
                            {/each}
                        </tbody>
                    </table>
                </div>
            </div>
        ';

        public $userDelete = '
        <div class="card">
            <div class="card-header bg-dark text-white">
                Delete User
            </div>
            <div class="card-body">

                <form method="post" action="?page=admin&module=users&action=delete&id={id}&commit=1">
                    <div class="text-center">
                        <p> Are you sure you want to delete this user?</p>

                        <p><em>"{name}"</em></p>

                        <button class="btn btn-danger" name="submit" type="submit" value="1">Yes delete this user</button>

                    </div>
                </form>
            </div>
        </div>
        
        ';
        public $userForm = '

            <div class="card">
                <div class="card-header bg-dark text-white">
                    Edit User
                </div>
                <div class="card-body">
                    <form method="post" action="?page=admin&module=users&action={editType}&id={id}">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label class="fw-bold mb-1">User Name</label>
                                    <input type="text" class="form-control" name="name" value="{name}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label class="fw-bold mb-1">User Status</label>
                                    <select class="form-control" name="userStatus" data-value="{userStatus}">
                                        <option {#if isDead}selected{/if} value="0">Dead</option>
                                        <option {#if isValidated}selected{/if} value="1">Alive</option>
                                        <option {#if isAwaitingValidation}selected{/if} value="2">Awaiting Email Verification</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
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
                                <div class="form-group mb-3">
                                    <label class="fw-bold mb-1">Email</label>
                                    <input type="text" class="form-control" name="email" value="{email}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="fw-bold mb-1">Cash</label>
                                    <input type="number" class="form-control" name="money" value="{money}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="fw-bold mb-1">Bank</label>
                                    <input type="number" class="form-control" name="bank" value="{bank}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="fw-bold mb-1">EXP</label>
                                    <input type="number" class="form-control" name="exp" value="{exp}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="fw-bold mb-1">Points</label>
                                    <input type="number" class="form-control" name="points" value="{points}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="fw-bold mb-1">Profile Picture</label>
                                    <input type="text" class="form-control" name="pic" value="{pic}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label class="fw-bold mb-1">Bio</label>
                            <textarea rows="8" class="form-control" name="bio">{bio}</textarea>
                        </div>
                        <div class="text-end">
                            <button class="btn btn-primary" name="submit" type="submit" value="1">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        ';
    }
