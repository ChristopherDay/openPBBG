<?php
class gameSettingsTemplate extends template {

    public $rankList = '
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-3">
                <h4 class="card-header bg-dark text-white">View Ranks</h4>
                <div class="card-body">
                    <table class="table table-bordered table-xs" data-sort-col="1">
                        <thead>
                            <tr>
                                <th>Rank</th>
                                <th width="100px">EXP Needed</th>
                                <th width="80px">Max Health</th>
                                <th width="80px">Limit</th>
                                <th width="170px">Reward</th>
                                <th width="100px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            {#each ranks}
                                <tr>
                                    <td>{name}</td>
                                    <td>{exp}</td>
                                    <td>{health}</td>
                                    <td>{#if limit} {limit} {/if} {#unless limit}none{/unless}</td>
                                    <td>${cash}</td>
                                    <td class="text-end">
                                        <a href="?page=admin&module=gameSettings&action=editRank&id={id}" class="btn btn-table btn-success">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <a href="?page=admin&module=gameSettings&action=deleteRank&id={id}" class="btn btn-table btn-danger">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </a>
                                    </td>
                                </tr>
                            {/each}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            {>rankForm}
        </div>
    </div>
    ';

    public $rankDelete = '
        <div class="card">
            <div class="card-header bg-dark text-white">
                Delete Rank
            </div>
            <div class="card-body">
                <form method="post" action="?page=admin&module=gameSettings&action=deleteRank&id={id}&commit=1">
                    <div class="text-center">
                        <p> Are you sure you want to delete this rank?</p>
                        <p><em>"{name}"</em></p>
                        <button class="btn btn-danger" name="submit" type="submit" value="1">Yes delete this rank</button>
                    </div>
                </form>
            </div>
        </div>
    ';
    public $rankForm = '
        <form method="post" action="?page=admin&module=gameSettings&action={editType}Rank&id={id}">
            <div class="card mb-3">
                <h4 class="card-header bg-dark text-white">{ucfirst editType} Rank</h4>
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label class="fw-bold mb-1">Rank Name</label>
                        <input type="text" class="form-control" name="name" value="{name}">
                    </div>
                    <div class="form-group mb-3">
                        <label class="fw-bold mb-1">Limit how many users can be at this rank</label>
                        <input type="number" class="form-control" name="limit" value="{limit}" placeholder="if there us no limit put 0">
                    </div>
                    <div class="form-group mb-3">
                        <label class="fw-bold mb-1">EXP needed to get this rank</label>
                        <input type="number" class="form-control" name="exp" value="{exp}">
                    </div>
                    <div class="form-group mb-3">
                        <label class="fw-bold mb-1">Money reward for reaching this rank</label>
                        <input type="number" class="form-control" name="cash" value="{cash}">
                    </div>
                    <div class="form-group mb-3">
                        <label class="fw-bold mb-1">Max Health</label>
                        <input type="number" class="form-control" name="health" value="{health}">
                    </div>
                </div>
            </div>
            <div class="text-end">
                <button class="btn btn-primary" name="submit" type="submit" value="1">Save</button>
            </div>
        </form>
    ';

    public $moneyRankList = '

        <div class="row">
            <div class="col-md-8">
                <div class="card mb-3">
                    <h4 class="card-header bg-dark text-white">Money Ranks</h4>
                    <div class="card-body">
                        <table class="table table-bordered table-xs" data-sort-col="1">
                            <thead>
                                <tr>
                                    <th>Rank</th>
                                    <th width="100px">Money Needed</th>
                                    <th width="100px">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                {#each moneyRanks}
                                    <tr>
                                        <td>{name}</td>
                                        <td>{#money money}</td>
                                        <td class="text-end">
                                            <a href="?page=admin&module=gameSettings&action=editMoneyRank&id={id}" class="btn btn-table btn-success">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <a href="?page=admin&module=gameSettings&action=deleteMoneyRank&id={id}" class="btn btn-table btn-danger">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </a
                                        </td>
                                    </tr>
                                {/each}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                {>moneyRankForm}
            </div>
        </div>


    ';

    public $moneyRankDelete = '
        <div class="card">
            <div class="card-header bg-dark text-white">
                Delete Money Rank
            </div>
            <div class="card-body">
                <form method="post" action="?page=admin&module=gameSettings&action=deleteMoneyRank&id={id}&commit=1">
                    <div class="text-center">
                        <p> Are you sure you want to delete this money rank?</p>
                        <p><em>"{name}"</em></p>
                        <button class="btn btn-danger" name="submit" type="submit" value="1">Yes delete this money rank</button>
                    </div>
                </form>
            </div>
        </div>
    ';
    public $moneyRankForm = '

            <form method="post" action="?page=admin&module=gameSettings&action={editType}MoneyRank&id={id}">
                <div class="card mb-3">
                    <h4 class="card-header bg-dark text-white">{ucfirst editType} Rank</h4>
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label class="fw-bold mb-1">Rank Name</label>
                            <input type="text" class="form-control" name="name" value="{name}">
                        </div>
                        <div class="form-group mb-3">
                            <label class="fw-bold mb-1">Money needed to get this rank</label>
                            <input type="number" class="form-control" name="money" value="{money}">
                        </div>
                    </div>
                </div>
                <div class="text-end">
                    <button class="btn btn-primary" name="submit" type="submit" value="1">Save</button>
                </div>
            </form>
    ';
}
