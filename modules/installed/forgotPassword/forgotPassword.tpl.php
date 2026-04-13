<?php
class forgotPasswordTemplate extends template {

    public $resetPasswordEmail = '
        <div class="card">
            <div class="card-header">
                Reset Password
            </div>
            <div class="card-body">
                <div class="rounded border p-3 bg-body-tertiary">
                    <p>
                        Please enter your email address and we will send you a password reset link!
                    </p>
                    <form action="?page=forgotPassword&action=reset" method="post">
                        <p>
                            <input class="form-control" type="email" name="email" placeholder="Email Address" />
                        </p>
                        <p class="text-end">
                            <button type="submit" class="btn btn-primary">Reset Password</button>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    ';

    public $resetPassword = '
        <div class="card">
            <div class="card-header">
                Reset Password
            </div>
            <div class="card-body">
                <div class="rounded border p-3 bg-body-tertiary">

                    <form action="?page=forgotPassword&action=resetPassword&auth={auth}&id={id}" method="post">
                        <p>
                            <input class="form-control" type="password" name="password" placeholder="Password" />
                        </p>
                        <p>
                            <input class="form-control" type="password" name="cpassword" placeholder="Confirm Password" />
                        </p>
                        <p class="text-end">
                            <button type="submit" class="btn btn-primary">Reset Password</button>
                        </p>
                    </form>
                </div>
            </div>
        </div>  
    ';
    
}