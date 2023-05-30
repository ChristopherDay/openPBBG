<?php

    class shoutboxTemplate extends template {

        public $chatLine = '
        	<div class="crime-holder">
                <p>
                    <span class="cooldown pull-left">
                        {>userName} 
                    </span>
                    <span class="action">
                    	[{text}]
                    </span>
                    <span class="cooldown spacer">
                    	{date}
                    </span>
                </p>
            </div>
        ';

        public $chatSidebar = '
        	{#each history}
                <div class="list-group-item">
                    <h5 class="list-group-item-heading">
                        {>userName} <small class="pull-right">{_ago time} ago</small>
                    </h5>
                    <p>[{text}]</p>
                </div>
        	{/each}
        	{#unless history}
        		<p class="text-center">
        			<em>Shoutbox is empty!</em>
        		</p>
        	{/unless}
        ';

        public $chatHistory = '
            {#each history}
                {>chatLine}
            {/each}
            {#unless history}
                <p class="text-center">
                    <em>Shoutbox is empty!</em>
                </p>
            {/unless}
        ';

        public $form = '
        	<form action="?page=shoutbox&action=reply" method="POST">
	        	<div class="row">
	        		<div class="col-md-10">
	        			<p>
	        				<input type="text" name="text" class="form-control" maxlength="120" placeholder="Message ..." />
	        			</p>
	        		</div>
	        		<div class="col-md-2">
	        			<p>
		        			<button class="btn btn-default text-center">
		        				Reply
	        				</button>
	        			</p>
	        		</div>
	        	</div>
        	</form>
        ';

        public $shoutbox = '

        	<div class="panel panel-default">
        		<div class="panel-heading">
        			Shoutbox
        		</div>
        		<div class="panel-body history">
        			{>chatHistory}
        		</div>
        		<div class="panel-body">
        			{>form}
        		</div>
        	</div>



        ';

    }