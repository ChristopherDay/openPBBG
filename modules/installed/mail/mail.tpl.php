<?php

    class mailTemplate extends template {
        
        public $mail = '
            <div class="card">
                <div class="card-header">Mail</div>
                <div class="card-body">
                    <div class="well well-sm read-mail">
                        <h4>
                            {subject} 
                            <small class="float-end tiny">
                                By {>userName} {date}
                            </small>
                        </h4>
                        <hr />
                        <p>[{text}]</p>
                    </div>
                    <h4 class="text-start">Reply to {>userName}</h4>
                    {>mailForm}
                </div>
            </div>
        ';

        public $newMail = '
            <div class="card">
                <div class="card-header">New Mail</div>
                <div class="card-body">
                    <h4 class="text-start">Message {>userName}</h4>
                    {>mailForm}
                </div>
            </div>
        ';
        public $mailForm = '
            <form method="post" action="?page=mail&action={action}&id={id}{#if name}&name={name}{/if}">
                {#if showUser}
                    <input name="name" class="form-control" placeholder="User" value="{#if name}{name}{/if}" / >
                    <br />
                {/if}
                <input name="subject" class="form-control" placeholder="Subject" value="{#if subject}RE: {subject}{/if}" / >
                <br />
                <textarea rows="6" name="message" class="form-control" placeholder="Your reply ..."></textarea>
                <br />
                <div class="text-end">
                    <button class="btn btn-primary">
                        Send
                    </button>
                </div>
            </form>
        ';

        public $mailTable = '
            <table class="table table-condensed table-responsive table-bordered table-striped mail-table">
                <thead>
                    <tr>
                        <th style="width:60px">
                            <span class="visible-xs">Mail</span>
                        </th>
                        <th style="width:130px">Date</th>
                        <th style="width:150px">
                            {#if inbox}
                                From
                            {/if}
                            {#unless inbox}
                                To
                            {/unless}
                        </th>
                        <th>Subject</th>
                        <th style="width:120px" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    {#unless mail}
                        <tr>
                            <td colspan="5">
                                <div class="text-center">
                                    <em> You have no mail</em>
                                </div>
                            </td>
                        </tr>
                    {/unless}
                    {#each mail}
                        <tr>
                            <td class="text-center">{#unless read}<span class="new">*NEW*</span>{/unless}</td>
                            <td>{date}</td>
                            <td>
                                {>userName}
                            </td>
                            <td>
                                {#unless read}<span class="new visible-xs">*</span>{/unless}
                                {subject}
                            </td>
                            <td class="text-center">
                                <a class="btn btn-xs btn-success" href="?page=mail&action=read&id={id}">Read</a>
                                <a class="btn btn-xs btn-danger" href="?page=mail&action=delete&id={id}">Delete</a>
                            </td>
                        </tr>
                    {/each}
                </tbody>
            </table>
        ';

        public $mailInbox = '

            <div class="card">
                <div class="card-header">
                    Inbox
                    <span class="small float-start">
                        &nbsp;&nbsp;<a class="btn btn-info btn-xs" href="?page=mail&action=outbox">Outbox</a>
                    </span>
                    <span class="small float-end">
                        <a class="btn btn-success btn-xs" href="?page=mail&action=new">New Mail</a>&nbsp;&nbsp;
                    </span> 
                </div>
                <div class="card-body">
                    {>mailTable}
                </div>
            </div>

        ';

        public $mailOutbox = '

            <div class="card">
                <div class="card-header">
                    Outbox
                    <span class="small float-start">
                        &nbsp;&nbsp;<a class="btn btn-info btn-xs" href="?page=mail">Inbox</a>
                    </span>
                    <span class="small float-end">
                        <a class="btn btn-success btn-xs" href="?page=mail&action=new">New Mail</a>&nbsp;&nbsp;
                    </span> 
                </div>
                <div class="card-body">
                    {>mailTable}
                </div>
            </div>
        ';
        
    }

