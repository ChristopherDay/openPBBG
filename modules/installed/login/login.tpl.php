<?php
<<<<<<< HEAD
class loginTemplate extends template {
    public $loginForm = '
        {{text}}
        <form action="?page=login&action=login" method="post">
            <input type="hidden" name="_CSFR" value="{_CSFRToken}" />
            <input autocomplete="new-password" type="input" class="form-control" name="email" placeholder="Email" /><br />
            <input autocomplete="new-password" type="password" class="form-control" name="password" placeholder="Password" /><br />
            <div class="row">
                <div class="col-xs-8 text-start">
                    <a href="?page=forgotPassword">Forgot Password?</a>
                </div>
                <div class="col-xs-4">
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Login</button>
=======

    class loginTemplate extends template {

        public $loginForm = '
                <{text}>
                <form action="?page=login&action=login" method="post">
                    <input type="hidden" name="_CSFR" value="{_CSFRToken}" />
                    <input autocomplete="new-password" type="input" class="form-control" name="email" placeholder="Email" /><br />
                    <input autocomplete="new-password" type="password" class="form-control" name="password" placeholder="Password" /><br />

                    <div class="row">
                        <div class="col-xs-8 text-start">
                            <a href="?page=forgotPassword">Forgot Password?</a>
                        </div>
                        <div class="col-xs-4">
                            <div class="text-end">
                                <button type="submit" class="btn btn-default">Login</button>
                            </div>
                        </div>
>>>>>>> 6f4c9c97c9b74bec1896842bec19ed9d865a1afd
                    </div>
                </div>
            </div>
        </form>
    ';

    public $loginOptions = '
        <form method="post" action="?page=admin&module=login&action=settings">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label class="">Login Suffix</label>
                        <textarea type="text" class="form-control" data-editor="html" name="loginSuffix" rows="5">{loginSuffix}</textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label class="">Login Postfix</label>
                        <textarea type="text" class="form-control" data-editor="html" name="loginPostfix" rows="5">{loginPostfix}</textarea>
                    </div>
                </div>
<<<<<<< HEAD
            </div>
            <div class="text-end">
                <button class="btn btn-primary" name="submit" type="submit" value="1">Save</button>
            </div>
        </form>
    ';
}
=======

                <div class="text-end">
                    <button class="btn btn-default" name="submit" type="submit" value="1">Save</button>
                </div>
            </form>
        ';

    }

>>>>>>> 6f4c9c97c9b74bec1896842bec19ed9d865a1afd
