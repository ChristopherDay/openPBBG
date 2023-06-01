<?php


<<<<<<< HEAD
class bankTemplate extends template {
    public $options = '
        <form method="post" action="#">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label class="fw-bold mb-1">Tax (%)</label>
                        <input type="text" class="form-control" name="bankTax" value="{bankTax}" />
=======

         public $options = '

            <form method="post" action="#">

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="fw-bold mb-1">Tax (%)</label>
                            <input type="text" class="form-control" name="bankTax" value="{bankTax}" />
                        </div>
>>>>>>> 6f4c9c97c9b74bec1896842bec19ed9d865a1afd
                    </div>
                </div>
            </div>
            <div class="text-end">
                <button class="btn btn-primary" name="submit" type="submit" value="1">Save</button>
            </div>
        </form>
    ';

<<<<<<< HEAD

    public $bank = '
        <div class="row">
            <div class="col-md-6">
                <form action="?page=bank&action=process" method="post">
                    <div class="card">
                        <div class="card-header">Deposit</div>
                        <div class="card-body">
                            <p style="height:54px; line-height:18px;">
                                To launder your money so it is safe to deposit in your bank account will cost you {tax}% of the amount you are going to deposit!
                            </p>
                            <p>
                                <input type="text" class="form-control" value="{deposit}" name="deposit" />
                            </p>
                            <p class="text-end">
                                <button type="submit" class="btn btn-primary" name="bank" value="deposit">Deposit</button>
                            </p>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                <form action="?page=bank&action=process" method="post">
                    <div class="card">
                        <div class="card-header"> Withdraw </div>
                        <div class="card-body">
                            <p style="height:54px; line-height:18px;">
                                There is no cost to withdraw your money!<br />
                            </p>
                            <p>
                                <input type="text" class="form-control" value="{withdraw}" name="withdraw" />
                            </p>
                            <p class="text-end">
                                <button type="submit" class="btn btn-primary" name="bank" value="withdraw">Withdraw</button>
                            </p>
=======
                <div class="text-end">
                    <button class="btn btn-default" name="submit" type="submit" value="1">Save</button>
                </div>

            </form>
        ';

        
        public $bank = '
            <div class="row">
                <div class="col-md-6">
                    <form action="?page=bank&action=process" method="post">
                        <div class="card">
                            <div class="card-header">Deposit</div>
                            <div class="card-body">
                                <p style="height:54px; line-height:18px;">
                                    To launder your money so it is safe to deposit in your bank account will cost you {tax}% of the amount you are going to deposit!
                                </p>
                                <p>
                                    <input type="text" class="form-control" value="{deposit}" name="deposit" />
                                </p>
                                <p class="text-end">
                                    <button type="submit" class="btn btn-default" name="bank" value="deposit">Deposit</button>
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <form action="?page=bank&action=process" method="post">
                        <div class="card">
                            <div class="card-header"> Withdraw </div>
                            <div class="card-body">
                                <p style="height:54px; line-height:18px;">
                                    There is no cost to withdraw your money!<br />
                                </p>
                                <p>
                                    <input type="text" class="form-control" value="{withdraw}" name="withdraw" />
                                </p>
                                <p class="text-end">
                                    <button type="submit" class="btn btn-default" name="bank" value="withdraw">Withdraw</button>
                                </p>
                            </div>
>>>>>>> 6f4c9c97c9b74bec1896842bec19ed9d865a1afd
                        </div>
                    </div>
                </form>
            </div>
        </div>

<<<<<<< HEAD
        <div class="row">
            <div class="col-md-6">
                <form method="post" action="?page=bank&action=transfer">
                    <div class="card">
                        <div class="card-header">Transfer Money</div>
                        <div class="card-body">
                            <p>
                                <input type="text" class="form-control" name="user" placeholder="Username" />
                            </p>
                            <p>
                                <input type="number" class="form-control" name="money" placeholder="Money to transfer" />
                            </p>
                            <p class="text-end">
                                <button type="submit" class="btn btn-primary" name="submit" value="1">Transfer</button>
                            </p>
=======
            <div class="row">
                <div class="col-md-6">
                    <form method="post" action="?page=bank&action=transfer">
                        <div class="card">
                            <div class="card-header">Transfer Money</div>
                            <div class="card-body">
                                <p>
                                    <input type="text" class="form-control" name="user" placeholder="Username" />
                                </p>
                                <p>
                                    <input type="number" class="form-control" name="money" placeholder="Money to transfer" />
                                </p>
                                <p class="text-end">
                                    <button type="submit" class="btn btn-default" name="submit" value="1">Transfer</button>
                                </p>
                            </div>
>>>>>>> 6f4c9c97c9b74bec1896842bec19ed9d865a1afd
                        </div>
                    </div>
                </form>
            </div>
        </div>    
    ';

}