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
                </div>
                <div class="text-end">
                    <button class="btn btn-default" name="submit" type="submit" value="1">Save</button>
                </div>
            </form>
        ';

        public $themeHolder = '
        {#each themes}
        <div class="theme-holder">
            <p>{name} ({cooldown}) <span class="commit"><a href="?page=themes&action=commit&theme={id}">Commit</a></span></p>
            <div class="theme-perc">
                <div class="perc" style="width:{percent}%;"></div>
            </div>
        </div>
        <div class="text-end">
            <button class="btn btn-primary" name="submit" type="submit" value="1">Save</button>
        </div>
    </form>
    ';

    public $themeList = '

        <div class="row">
            {#each themes}
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header text-center {#if active}bg-success{else}bg-dark{/if} text-white">
                            {name}
                        </div>
                        <div class="text-center card-feature" style="background-image: url(\'themes/{id}/preview.png\')">
                            <span class="float-end bg-dark text-white p-1 m-3 rounded">{ucfirst themeType}</span>
                        </div>
                        <div class="card-body">
                            <p>
                                <a href="{author.url}" target="_blank">{author.name}</a>
                                <span class="float-end bg-gray-300 p-1 rounded">{version}</span>
                            </p>
                            {#if active}
                                <a href="" class="btn btn-link text d-block disabled">
                                    Currently used as {themeType} theme
                                </a>
                            {else}
                                <a href="?page=admin&module=themeManager&action=activate&type={themeType}&id={id}" class="btn btn-success d-block">
                                    Activate
                                </a>
                            {/if}
                        </div>
                    </div>
                </div>
            {/each}
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

