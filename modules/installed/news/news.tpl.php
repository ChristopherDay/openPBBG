<?php
<<<<<<< HEAD
class newsTemplate extends template {
    public $newsArticle = '
        {#each news}
            <div class="well well-sm">
                <h3>
                    {title} 
                    <small class="float-end tiny">
                        By {>userName}<br />
                        {date}
                    </small>
                </h3>
                <hr />
                <p>[{text}]</p>
            </div>
        {/each}
    ';
}
=======

    class newsTemplate extends template {
        
        public $newsArticle = '
            {#each news}
                <div class="well well-sm">
                    <h3>
                        {title} 
                        <small class="float-end tiny">
                            By {>userName}<br />
                            {date}
                        </small>
                    </h3>
                    <hr />
                    <p>[{text}]</p>
                </div>
            {/each}
        ';
    }

>>>>>>> 6f4c9c97c9b74bec1896842bec19ed9d865a1afd
