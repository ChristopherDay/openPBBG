<?php
class newsTemplate extends template {
    public $newsArticle = '

        {#each news}            
            <div class="card mb-3">
                <div class="card-header text-start">
                    {title} 
                    <small class="float-end tiny">
                        By {>userName} {date}
                    </small>
                </div>
                <div class="card-body text-start">
                    [{text}]
                </div>
            </div>
        {/each}
    ';
}