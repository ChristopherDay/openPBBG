<?php
class loginTemplate extends template {
    public $loginForm = '
        
        {{text}}

        <div class="card">
            <div class="card-header">
                Login
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-md-8">
                        {{desc}}
                    </div>
                    <div class="col-md-4">
                        <form action="?page=login&action=login" method="post" class="bg-light rounded border p-3">
                            <input type="hidden" name="_CSFR" value="{_CSFRToken}" />
                            <input autocomplete="new-password" type="input" class="form-control" name="email" placeholder="Email" /><br />
                            <input autocomplete="new-password" type="password" class="form-control" name="password" placeholder="Password" /><br />

                            <div class="row">
                                <div class="col-sm-8 text-start">
                                    <a href="?page=forgotPassword" class="btn btn-link">Forgot Password?</a>
                                </div>
                                <div class="col-sm-4">
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary">Login</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                {#if info}
                    <hr />
                    {{info}}
                {/if}

            </div>
        </div>
    ';

    public $gameDesc = '
        <form method="post" action="?page=admin&module=login&action=desc">
            <div class="card mb-3 code-editor-flush">
                <div class="card-header bg-dark text-white">Game Description</div>
                <textarea type="text" class="form-control" data-editor="html" name="loginSuffix" rows="5">{loginSuffix}</textarea>
            </div>
            <div class="text-end">
                <button class="btn btn-primary" name="submit" type="submit" value="1">Save</button>
            </div>
        </form>
    ';

    public $gameInfo = '
        <form method="post" action="?page=admin&module=login&action=info">
            <div class="card mb-3 code-editor-flush">
                <div class="card-header bg-dark text-white">Game Information</div>
                <textarea type="text" class="form-control" data-editor="html" name="loginPostfix" rows="5">{loginPostfix}</textarea>
            </div>
            <div class="text-end">
                <button class="btn btn-primary" name="submit" type="submit" value="1">Save</button>
            </div>
        </form>
    ';
}

