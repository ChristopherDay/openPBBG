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
                        <div class="bg-light rounded border p-3">
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
                <div class="card-body">
                    <div class="form-group mb-3">
                        <input type="checkbox" name="validateUserEmail" value="1" {#if validateUserEmail}checked{/if} /> 
                        <label class="">Validate User Email</label><br />
                    </div>
                    <div class="form-group mb-3">
                        <label class="">Register Suffix</label>
                        <textarea type="text" class="form-control" name="registerSuffix" data-editor="html" rows="5">{registerSuffix}</textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label class="">Register Postfix</label>
                        <textarea type="text" class="form-control" name="registerPostfix" data-editor="html" rows="5">{registerPostfix}</textarea>
                    </div>
                </div>
            </div>
            <div class="text-end">
                <button class="btn btn-primary" name="submit" type="submit" value="1">Save</button>
            </div>
        </form>
    ';
}
