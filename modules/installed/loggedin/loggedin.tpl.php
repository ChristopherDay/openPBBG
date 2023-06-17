<?php
class loggedinTemplate extends template {
    public $newsArticle = '
        {#each news}
            <div class="card mb-3">
                <div class="card-header text-center">
                    {title}<br />
                    <small>
                        By {>userName} {date}
                    </small>
                </div>
                <div class="card-body text-start">
                    <div class="well well-sm">
                        [{text}]
                    </div>
                </div>
            </div>
        {/each}
    ';

    public $loggedinList = '
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-3">
                <h4 class="card-header bg-dark text-white">Game News</h4>
                <div class="card-body">
                    <table class="table table-bordered table-xs" data-sort-col="2" data-sort-type="desc">
                        <thead>
                            <tr>
                                <th width="150px">Author</th>
                                <th>Title</th>
                                <th width="160px">Date</th>
                                <th width="120px">Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            {#each loggedin}
                                <tr>
                                    <td>{gnauthor}</td>
                                    <td>{gntitle}</td>
                                    <td>{gndate}</td>
                                    <td class="text-end">
                                        <a href="?page=admin&module=loggedin&action=edit&id={id}" class="btn btn-table btn-success">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a> 
                                        <a href="?page=admin&module=loggedin&action=delete&id={id}" class="btn btn-table btn-danger">
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
            {>loggedinNewForm}
        </div>
    </div>
    ';

    public $loggedinDelete = '
        <div class="card">
            <div class="card-header bg-dark text-white">
                Delete News
            </div>
            <div class="card-body">

                <form method="post" action="?page=admin&module=loggedin&action=delete&id={id}&commit=1">
                    <div class="text-center">
                        <p> Are you sure you want to delete this news post?</p>
                        <p><em>"{gntitle}"</em></p>
                        <button class="btn btn-danger" name="submit" type="submit" value="1">Yes delete this news post</button>
                    </div>
                </form>
            </div>
        </div>
    ';

    public $loggedinNewForm = '
        <form method="post" action="?page=admin&module=loggedin&action={editType}&id={id}">
            <div class="card mb-3">
                <h4 class="card-header bg-dark text-white">
                    {#if gntitle}
                        Edit: {gntitle}
                    {else}
                        New news article
                    {/if}
                </h4>
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label class="fw-bold mb-1">Title</label>
                        <input type="text" class="form-control" name="gntitle" value="{gntitle}">
                    </div>
                    <div class="form-group mb-3">
                        <label class="fw-bold mb-1">Text</label>
                        <textarea rows="8" type="text" class="form-control" name="gntext">{gntext}</textarea>
                    </div>
                </div>
            </div>
            <div class="text-end">
                <button class="btn btn-primary" name="submit" type="submit" value="1">Save</button>
            </div>
        </form>
    ';
}