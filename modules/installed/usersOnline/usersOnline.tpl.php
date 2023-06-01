<?php

    class usersOnlineTemplate extends template {
    
        public $usersOnline = '
            <div class="row">
                {#each durations}
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">{title}</div>
                            <div class="card-body">
                                {#each users}
                                    <div class="crime-holder">
                                        <p>
                                            <span class="action">
                                                {>userName} 
                                            </span> 
                                            <span class="cooldown">
                                                {date}
                                            </span> 
                                        </p>
                                    </div>
                                {/each}
                            </div>
                        </div>
                    </div>
                {/each}
            </div>
        ';
        
    }
