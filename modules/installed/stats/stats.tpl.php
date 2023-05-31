<?php
class statsTemplate extends template {
    public $stats = '
        <div class="row">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">New Players</div>
                    <div class="card-body">
                        <table class="table table-condensed table-responsive table-bordered table-striped stats-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th style="width:220px">Date</th>
                                </tr>
                            </thead>
                        </table>
                        <div class="overflow">
                            <table class="table table-condensed table-responsive table-bordered table-striped stats-table">
                                {#unless newUsers}
                                    <tr>
                                        <td colspan="2" class="text-center">
                                            <em>There are no new users</em>
                                        </td>
                                    </tr>
                                {/unless}
                                {#each newUsers}
                                    <tr>
                                        <td>{>userName}</td>
                                        <td style="width:220px">{date}</td>
                                    </tr>
                                {/each}
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">Recently Killed</div>
                    <div class="card-body">
                        <table class="table table-condensed table-responsive table-bordered table-striped stats-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th style="width:220px">Date</th>
                                </tr>
                            </thead>
                        </table>
                        <div class="overflow">
                            <table class="table table-condensed table-responsive table-bordered table-striped stats-table">
                                {#unless deadUsers}
                                    <tr>
                                        <td colspan="2" class="text-center">
                                            <em>There are no dead users</em>
                                        </td>
                                    </tr>
                                {/unless}
                                {#each deadUsers}
                                    <tr>
                                        <td>{>userName}</td>
                                        <td style="width:220px">{date}</td>
                                    </tr>
                                {/each}
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">Game Stats</div>
                    <div class="card-body">
                        <ul class="list-group text-start">
                            <li class="list-group-item">
                                Players Alive
                                <span class="badge">{alive}</span>
                            </li>
                            <li class="list-group-item">
                                Dead Players
                                <span class="badge">{dead}</span>
                            </li>
                            <li class="list-group-item">
                                Cash
                                <span class="badge">{#money cash}</span>
                            </li>
                            <li class="list-group-item">
                                Bullets
                                <span class="badge">{number_format bullets}</span>
                            </li>
                            <li class="list-group-item">
                                {_setting "pointsName"}
                                <span class="badge">{number_format points}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    ';
}