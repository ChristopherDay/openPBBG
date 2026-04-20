<?php
    class pluginManagerTemplate extends template {

        public $continueWithError = '
            <div class="alert alert-danger">
                {error.text}
            </div>
            <h3>Error Output</h3>
            {error.output}
            <a href="?page=admin&module=pluginManager&action=install&view={id}" class="btn btn-primary">
                Go back to plugin overview
            </a>
            <div class="float-end">
                <em>This may cause other issues </em>
                <a href="?page=admin&module=pluginManager&action=install&installModule={id}&force=true" class="btn btn-danger">
                    Continue with install
                </a>
            </div>
        ';
        public $moduleHolder = '
        {#each modules}
        <div class="module-holder">
            <p>{name} ({cooldown}) <span class="commit"><a href="?page=modules&action=commit&module={id}">Commit</a></span></p>
            <div class="module-perc">
                <div class="perc" style="width:{percent}%;"></div>
            </div>
        </div>
        {/each}
        {#unless modules}
            <div class="text-center"><em>There are no plugins</em></div>
        {/unless}';

        public $moduleOverview = '
        
        <div class="card mb-3">
            <div class="card-header">
                {name}
                <div class="float-end">
                    
                    {#if _activated}
                        <a href="?page=admin&module=pluginManager&action=deactivate&moduleName={id}" class="text-danger bg-light-danger rounded border border-danger p-1">
                            <i class="fas fa-ban"></i> Deactivate Plugin
                        </a>
                    {else}
                        {#if canInstall}
                            {#if _installing}
                                <a href="?page=admin&module=pluginManager&action=install&installModule={id}" class="text-primary bg-light-primary rounded border border-primary p-1">
                                    <i class="fas fa-download"></i> Install Plugin
                                </a>
                            {/if}
                            {#if _deactivated}
                                <a href="?page=admin&module=pluginManager&action=reactivate&moduleName={id}" class="text-success bg-light-success rounded border border-success p-1">
                                    <i class="fas fa-check"></i> Reactivate Plugin
                                </a>
                            {/if}
                        {else}
                            <span class="text-muted bg-light rounded border border-muted p-1">
                                <i class="fas fa-ban"></i> Dependencies not met
                            </span>
                        {/if}
                    {/if}
                </div>
            </div>
            <div class="card-body">

                
                <div class="rounded p-3 bg-light border mb-3">
                    {description}
                </div>

                <div class="row">
                    <div class="col-md-6">

                        {#if bundle}
                            <table class="table no-dt">
                                <thead>
                                    <tr>
                                        <th>Plugin</th>
                                        <th class="text-center" width="100px">Extracted</th>
                                        <th class="text-center" width="100px">Installed</th>
                                        <th class="text-center" width="100px">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <tr>
                                            <td></td>
                                            <td>
                                                <a href="?page=admin&module=pluginManager&action=install&view={id}&extract=*" class="btn btn-xs btn-block btn-success">
                                                    Extract All
                                                </a>
                                            </td>
                                            <td>
                                                <a href="?page=admin&module=pluginManager&action=install&view={id}&installBundleModule=*" class="btn btn-xs btn-block btn-warning">
                                                    Install All
                                                </a>
                                            </td>
                                            <td></td>
                                        </tr>

                                        <{bundleInfo}>
                                </tbody>
                            </table>
                        {/if}
                        {#unless bundle}

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card mb-3">
                                        <div class="card-body text-center">
                                            <h5 class="card-title mb-3">Access In Jail</h5>
                                            {#if allowedInJail}
                                                <i class="fa fa-check fs-1 text-success"></i>
                                            {/if}
                                            {#unless allowedInJail}
                                                <i class="fa fa-times fs-1 text-danger"></i>
                                            {/unless}   
                                        </div>
                                    </div>      
                                </div>
                                <div class="col-md-4">
                                    <div class="card mb-3">
                                        <div class="card-body text-center">
                                            <h5 class="card-title mb-3">Requires Login</h5>
                                            {#if requireLogin}
                                                <i class="fa fa-check fs-1 text-success"></i>
                                            {/if}
                                            {#unless requireLogin}
                                                <i class="fa fa-times fs-1 text-danger"></i>
                                            {/unless}
                                        </div>
                                    </div>  
                                </div>
                                <div class="col-md-4">
                                    <div class="card mb-3">
                                        <div class="card-body text-center">
                                            <h5 class="card-title mb-3">Has ACP</h5>
                                            {#if admin}
                                                <i class="fa fa-check fs-1 text-success"></i>
                                            {/if}
                                            {#unless admin}
                                                <i class="fa fa-times fs-1 text-danger"></i>
                                            {/unless}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {#if admin}
                                <h4>Admin Panel Options</h4>
                                <ul class="list-group">
                                    {#each admin}
                                        {#if ../_activated}
                                            <li class="list-group-item p-2">
                                            {text}
                                                <a href="?page=admin&module={../id}&action={method}" class="float-end">
                                                    View
                                                </a>
                                            </li>
                                        {else}
                                            <li class="list-group-item p-2">{text}</li>
                                        {/if}
                                    {/each}
                                </ul>
                            {/if}
                        {/unless}
                    </div>
                    <div class="col-md-6">
                        <h4>Plugin Dependencies</h4>
                        {#if dependencies}
                            <ul class="list-group">
                                {#each dependencies}
                                    <li class="list-group-item p-2">
                                        <span class="badge bg-light-{#if has}success{else}danger{/if} border me-2">
                                            {#if has}
                                                <i class="fa fa-check"></i>
                                            {else}
                                                <i class="fa fa-times"></i>
                                            {/if}
                                        </span>
                                        {#if link}
                                            <a href="?page=admin&module={module}">{moduleName}</a>
                                        {else}
                                            {moduleName}
                                        {/if}
                                        <span class="float-end">
                                            {#each version}
                                                <span class="badge bg-secondary ms-1">{.}</span>
                                            {/each}
                                        </span>
                                    </li>

                                {/each}
                            </ul>
                        {/if}
                    </div>
                </div>


                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-6"> 
                            {#if author.name}
                                <strong>Author:</strong> <a href="{author.url}" target="_blank">{author.name}</a>
                                {#if notes} <small> - <{notes}></small>{/if}
                            {else}
                                <p>
                                    <strong>Developed by:</strong> 
                                </p>
                                <ul>
                                    {#each author}
                                        <li>
                                            <a href="{url}" target="_blank">{name}</a>
                                            {#if notes} <small> - <{notes}></small>{/if}
                                        </li>
                                    {/each}
                                </ul>
                            {/if}
                        </div>
                        <div class="col-md-6 text-end">
                            <strong>Version:</strong> {version}
                        </div>
                    </div>
                </a>
            </div>
        ';

        public $mInfo = '
            <tr>
                <td>{name}</td>
                <td class="text-center">
                    {>mInfoExtractedIcon}
                </td>
                <td class="text-center">
                    {>mInfoInstalledIcon}
                </td>
                <td class="text-center">
                    {>mInfoActions}
                </td>
            </tr>
        ';

        public $mInfoActions = '
            {#unless installed}
                {#unless extracted}
                    <a href="?page=admin&module=pluginManager&action=install&view={id}&extract={name}">
                        Extract
                    </a>
                {/unless}
            {/unless}
            {#if extracted}
                {#unless installed}
                    <a href="?page=admin&module=pluginManager&action=install&view={id}&installBundleModule={name}">
                        Install
                    </a>
                {/unless}
            {/if}
            {#if installed}
                <a href="?page=admin&module=pluginManager&action=install&view={id}&deactivateBundleModule={name}">
                    De-Activate
                </a>
            {/if}
        ';

        public $mInfoInstalledIcon = '
            {#if installed}
                <i class="glyphicon text-success glyphicon-ok"></i>
            {/if}
            {#unless installed}
                <i class="glyphicon text-danger glyphicon-remove"></i>
            {/unless}
        ';

        public $mInfoExtractedIcon = '
            {#unless installed}
                {#if extracted}
                    <i class="glyphicon text-success glyphicon-ok"></i>
                {/if}
                {#unless extracted}
                    <i class="glyphicon text-danger glyphicon-remove"></i>
                {/unless}
            {/unless}
        ';

        public $moduleList = '
        <div class="card mb-3">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Version</th>
                            <th>Author</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        {#each modules}
                            <tr>
                                <td>
                                    {name}
                                </td>
                                <td>{description}</td>
                                <td>{version}</td>
                                <td><a href="{author.url}" target="_blank">{author.name}</a></td>
                                <td>
                                    <a href="?page=admin&module=pluginManager&action=view&moduleName={id}">View</a>
                                </td>
                            </tr>
                        {/each}
                    </tbody>
                </table>
            </div>
        </div>
        '
;
        public $deactivatedModuleList = '
        <div class="card mb-3">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th width="90px">Name</th>
                            <th>Description</th>
                            <th width="70px">Version</th>
                            <th width="90px">Author</th>
                            <th width="100px">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        {#each modules}
                            <tr>
                                <td>{name}</td>
                                <td>{description}</td>
                                <td>{version}</td>
                                <td><a href="{author.url}" target="_blank">{author.name}</a></td>
                                <td>
                                    <a href="?page=admin&module=pluginManager&action=deactivated&moduleName={id}">View</a>
                                </td>
                            </tr>
                        {/each}
                    </tbody>
                </table>
            </div>
        </div>
        ';

        public $alterModuleConfirm = '
            <div class="card mb-3">
                <div class="card-header">Please Confirm</div>
                <div class="card-body">
                    <div class="text-center">
                        <p> 
                            Please confirm that you want to {type} this plugin?
                        </p>
                        <p> 
                            <em>"{module.name}"</em>
                        </p>
                        <a href="?page=admin&module=pluginManager&action={type}&moduleName={module.id}&do=true" class="btn btn-danger">
                            I confirm that i want to {type} this module 
                        </a>
                    </div>
                </div>
            </div>


        ';

        public $moduleForm = '
            <form method="post" action="?page=admin&module=pluginManager&action=install" enctype="multipart/form-data">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label class="fw-bold mb-1">Plugin File (Zipped)</label>
                            <input type="file" class="form-control" name="file" />
                        </div>
                    </div>
                </div>
                <div class="text-end">
                    <button class="btn btn-primary" name="submit" type="submit" value="1">Upload</button>
                </div>
            </form>

            {#if modules}
            <div class="card mb-3">
                <div class="card-body">
                    <h4 class="card-title">Continue Installation</h4>
                    <table class="table">
                        <thead>
                            <th width="90px">Name</th>
                            <th>Description</th>
                            <th width="70px">Version</th>
                            <th width="90px">Author</th>
                            <th width="115px">Actions</th>
                        </thead>
                        <tbody>
                            {#each modules}
                                <tr>
                                    <td>{name}</td>
                                    <td>{description}</td>
                                    <td>{version}</td>
                                    <td><a href="{author.url}" target="_blank">{author.name}</a></td>
                                    <td>
                                        [<a href="?page=admin&module=pluginManager&action=install&view={id}">Continue</a>] 
                                        [<a href="?page=admin&module=pluginManager&action=install&remove={id}">Remove</a>] 
                                    </td>
                                </tr>
                            {/each}
                        </tbody>
                    </table>
                </div>
            </div>
            {/if}
        ';
    }

