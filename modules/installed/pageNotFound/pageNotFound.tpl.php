<?php
class pageNotFoundTemplate extends template {
    public $pageNotFound = '
        <div class="card">
            <div class="card-header">Something went wrong</div>
            <div class="card-body">
                <p> We could not find the page you requested!</p>
            </div>
        </div>
    ';
}