<?php
class registerTemplate extends template {
    public $registerForm = '
        <div class="card">
            <div class="card-header">
                Register
            </div>
            <div class="card-body">
                <div class="row">
                    {#if desc}
                        <div class="col-sm-8">
                            {{desc}}
                        </div>
                    {else}
                        <div class="col-sm-4"></div>
                    {/if}
                    <div class="col-sm-4">
                        <div class="bg-body-tertiary rounded border p-3">
                            <form action="?page=register&action=register{#if ref}&ref={ref}{/if}" method="post">
                                <input type="hidden" name="_CSFR" value="{_CSFRToken}" />
                                <p>
                                    <input class="form-control" type="text" name="username" placeholder="Username" />
                                </p> 
                                <p>
                                    <input class="form-control" type="text" autocomplete="off" name="email" placeholder="EMail" />
                                </p>
                                <p>
                                    <input class="form-control" type="password" name="password" placeholder="Password" />
                                </p>
                                <p>
                                    <input class="form-control" type="password" name="cpassword" placeholder="Confirm Password" />
                                </p>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">Register</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                {#if info}
                    <hr />
                    {{info}}
                {/if}

            </div>
        </div>
        {{text}}
    ';

    public $registerOptions = '
        <form method="post" action="?page=admin&module=register&action=settings">
            <div class="card mb-3">
                <div class="card-header">
                    Registration Settings
                </div>
                <div class="list-group list-group-flush">
                    <div class="list-group-item p-2 bg-light">
                        Registration controls
                    </div>
                    <label class="list-group-item d-flex align-items-center justify-content-between">
                        Enable Registration
                        <input class="form-check-input float-end" type="checkbox" name="enableRegistration" value="1" {#if enableRegistration}checked{/if} /> 
                    </label>
                    <label class="list-group-item d-flex align-items-center justify-content-between">
                        Require email verification
                        <input class="form-check-input float-end" type="checkbox" name="validateUserEmail" value="1" {#if validateUserEmail}checked{/if} /> 
                    </label>
                    <div class="list-group-item p-2 bg-light">
                        Password Policy
                    </div>
                    <label class="list-group-item d-flex align-items-center justify-content-between">
                        Minimum password length
                        <input class="form-control d-inline float-end w-auto" type="number" name="minPasswordLength" value="{minPasswordLength}" />     
                    </label>
                    <label class="list-group-item d-flex align-items-center justify-content-between">
                        Require at least one number in password
                        <input class="form-check-input float-end" type="checkbox" name="requireNumber" value="1" {#if requireNumber}checked{/if} />
                    </label>
                    <label class="list-group-item d-flex align-items-center justify-content-between">
                        Require at least one special character in password
                        <input class="form-check-input float-end" type="checkbox" name="requireSpecialChar" value="1" {#if requireSpecialChar}checked{/if} />
                    </label>
                </div>
            </div>
            <div class="text-end">
                <button class="btn btn-primary" name="submit" type="submit" value="1">Save</button>
            </div>
        </form>
    ';

    public $pageText = '
        <form method="post" action="?page=admin&module=register&action=settings">
            <div class="card mb-0">
                <div class="card-header">
                    Register Page Text
                </div>
            </div>
            <textarea type="text" class="form-control" name="registerSuffix" data-editor="html" rows="5">{registerSuffix}</textarea>    
            <div class="text-end">
                <button class="btn btn-primary" name="submit" type="submit" value="1">Save</button>
            </div>
        </form>
    ';

    public $footerText = '
        <form method="post" action="?page=admin&module=register&action=settings">
            <div class="card mb-0">
                <div class="card-header">
                    Register Footer Text
                </div>
            </div>
            <textarea type="text" class="form-control mb-0" name="registerSuffix" data-editor="html" rows="5">{registerSuffix}</textarea>    
            <div class="text-end">
                <button class="btn btn-primary" name="submit" type="submit" value="1">Save</button>
            </div>
        </form>
    ';
}
