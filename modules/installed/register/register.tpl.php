<?php
<<<<<<< HEAD
class registerTemplate extends template {
    public $registerForm = '
        {{text}}
        <form action="?page=register&action=register{#if ref}&ref={ref}{/if}" method="post">
            <input type="hidden" name="_CSFR" value="{_CSFRToken}" />
            <input class="form-control" type="text" name="username" placeholder="Username" /><br />
            <input class="form-control" type="text" autocomplete="off" name="email" placeholder="EMail" /><br />
            <div class="row">
                <div class="col-xs-6">
                    <input class="form-control" type="password" name="password" placeholder="Password" />
=======

    class registerTemplate extends template {
    
        public $registerForm = '
            <{text}>
            <form action="?page=register&action=register{#if ref}&ref={ref}{/if}" method="post">
                <input type="hidden" name="_CSFR" value="{_CSFRToken}" />
                <input class="form-control" type="text" name="username" placeholder="Username" /><br />
                <input class="form-control" type="text" autocomplete="off" name="email" placeholder="EMail" /><br />
                <div class="row">
                    <div class="col-xs-6">
                        <input class="form-control" type="password" name="password" placeholder="Password" />
                    </div>
                    <div class="col-xs-6">
                        <input class="form-control" type="password" name="cpassword" placeholder="Confirm Password" />
                    </div>
                </div><br />
                <div class="text-end">
                    <button type="submit" class="btn btn-default">Register</button>
>>>>>>> 6f4c9c97c9b74bec1896842bec19ed9d865a1afd
                </div>
                <div class="col-xs-6">
                    <input class="form-control" type="password" name="cpassword" placeholder="Confirm Password" />
                </div>
            </div><br />
            <div class="text-end">
                <button type="submit" class="btn btn-primary">Register</button>
            </div>
        </form>
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
