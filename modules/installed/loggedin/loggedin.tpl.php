<?php
class loggedinTemplate extends template {
    public $newsArticle = '
        <div class="card">
            <div class="card-header">Game News</div>
            <div class="card-body text-start">
                {#each news}
                    <strong>{title}</strong>
                    <small class="float-end news-info">
                        By {>userName} {date}
                    </small>
                    <div class="well well-sm">
                        [{text}]
                    </div>
                {/each}
            </div>
        </div>
    ';

    public $loggedinList = '
    <div class="card mb-3">
        <div class="card-body">
            <table class="table">
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
                            <td>
                                [<a href="?page=admin&module=loggedin&action=edit&id={id}">Edit</a>] 
                                [<a href="?page=admin&module=loggedin&action=delete&id={id}">Delete</a>]
                            </td>
                        </tr>
                    {/each}
                </tbody>
            </table>
        </div>
    </div>
    ';

    public $loggedinDelete = '
        <form method="post" action="?page=admin&module=loggedin&action=delete&id={id}&commit=1">
            <div class="text-center">
                <p> Are you sure you want to delete this news post?</p>
                <p><em>"{gntitle}"</em></p>
                <button class="btn btn-danger" name="submit" type="submit" value="1">Yes delete this news post</button>
            </div>
        </form>
    ';

    public $loggedinNewForm = '
        <form method="post" action="?page=admin&module=loggedin&action={editType}&id={id}">
            <div class="card mb-3">
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
