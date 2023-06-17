<?php

    class adminTemplate extends template {
        public $title = '
            {#if title}
            <h4 class="card-title">{title}</h4>
            {/if}
        ';

        public $searchResults = '
            <table class="table table-xs table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    {#each users[0:3]}
                        <tr>    
                            <td>
                                <a href="?page=admin&action=edit&module=users&id={U_id}">{U_name}</a>
                            </td>
                            <td>
                                <small>{U_email}</small>
                            </td>
                        </tr>
                    {else}
                        <tr>    
                            <td colspan="2">
                                <em> No users found!</em>
                            </td>
                        </tr>
                    {/each}

                    {#if userCount}
                        <tr>
                            <td colspan="2">
                                <small><em>{count users} results found, <a href="?page=admin&action=view&module=users&user={search}">view all results ... </a></em></small>
                            </td>
                        </tr>
                    {/if}
                </tbody>
            </table>

            <table class="table table-xs table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Settings</th>
                    </tr>
                </thead>
                <tbody>
                    {#each acpOptions}
                        <tr>    
                            <td>
                                <a href="{url}">{label}</a>
                            </td>
                        </tr>
                    {else}
                        <tr>    
                            <td>
                                <em> No settings found!</em>
                            </td>
                        </tr>
                    {/each}
                </tbody>
            </table>
        ';

        public $widgetTable = '
            <div class="col-md-{size}">
                {>title}
                <div class="card">
                    <div class="card-body p-2">
                        <table class="table table-xs table-striped table-bordered no-dt mb-0">
                            <thead>
                                <tr>
                                    {#each header.columns}
                                        <th>{name}</th>
                                    {/each}
                                </tr>
                            </thead>
                            <tbody>
                                {#each data}
                                    <tr>
                                        {#each columns}
                                            <th>{{value}}</th>
                                        {/each}
                                    </tr>
                                {/each}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        ';

        public $widgetChart = '
            <div class="col-md-{size}">
                {>title}
                <div class="card">
                    <div class="card-body p-2">
                        <div class="admin-chart">
                            {#if data}
                                {json_encode data}
                            {/if}
                        </div>
                    </div>
                </div>
            </div>
        ';

        public $widgetHTML = '
            <div class="col-md-{size}">
                {>title}
                {{html}}
            </div>
        ';

        public $widgets = '
            <div class="row g-3">
                {#each widgets}
                    {#if divider}
            </div>
            <div class="row g-3">
                    {else}
                        {{html}}
                    {/if}
                {/each}
            </div>
        ';

    }

