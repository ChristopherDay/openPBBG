<?php
class themeManagerTemplate extends template {
    public $themeOptions = '
        <form method="post" action="?page=admin&module=themeManager&action=options">
        <div class="card mb-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label class="fw-bold mb-1">Game Name</label>
                            <input type="text" class="form-control" name="game_name" value="{game_name}" />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label class="fw-bold mb-1">From Email</label>
                            <input type="text" class="form-control" name="from_email" value="{from_email}" />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label class="fw-bold mb-1">Points Name</label>
                            <input type="text" class="form-control" name="pointsName" value="{pointsName}" />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label class="fw-bold mb-1">Gang Name</label>
                            <input type="text" class="form-control" name="gangName" value="{gangName}" />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label class="fw-bold mb-1">Landing Module</label>
                            <select class="form-control" name="landingPage">
                                {#each modules}
                                    <option value="{id}" {#if selected}selected{/if}>
                                        {name}
                                    </option>
                                {/each}
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label class="fw-bold mb-1">Game Theme</label>
                            <select class="form-control" name="theme">
                                {#each themes}
                                    <option value="{id}" {#if selected}selected{/if}>
                                        {name}
                                    </option>
                                {/each}
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label class="fw-bold mb-1">Admin Theme</label>
                            <select class="form-control" name="adminTheme">
                                {#each adminThemes}
                                    <option value="{id}" {#if selected}selected{/if}>
                                        {name}
                                    </option>
                                {/each}
                            </select>
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

    public $themeList = '
    <div class="card mb-3">
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th width="200px">Name</th>
                        <th>Description</th>
                        <th width="70px">Version</th>
                        <th width="90px">Author</th>
                        <th width="60px">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    {#each themes}
                        <tr>
                            <td>{name}</td>
                            <td>{description}</td>
                            <td>{version}</td>
                            <td><a href="{author.url}" target="_blank">{author.name}</a></td>
                            <td>
                                [<a href="?page=admin&module=themes&action=edit&themeName={id}">View</a>] 
                            </td>
                        </tr>
                    {/each}
                </tbody>
            </table>
        </div>
    </div>
    ';

    public $themeDelete = '
        <form method="post" action="?page=admin&module=themes&action=delete&id={id}&commit=1">
            <div class="text-center">
                <p> Are you sure you want to delete this theme?</p>
                <p><em>"{name}"</em></p>
                <button class="btn btn-danger" name="submit" type="submit" value="1">Yes delete this theme</button>
            </div>
        </form>
    ';

    public $themeForm = '
        <form method="post" action="?page=admin&module=themeManager&action=install" enctype="multipart/form-data">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label class="fw-bold mb-1">Theme File (Zipped)</label>
                                <input type="file" class="form-control" name="file" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-end">
                <button class="btn btn-primary" name="submitInstall" type="submit" value="1">Upload</button>
            </div>
        </form>
    ';
}