<?php
   
?>

<div ng-app="wp_mapify_app" class="wrap">
    <nav class="navbar navbar-default">
      <div>
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#/">Mapify Control Panel</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="#/map">Manage Map</a></li>
            <li><a href="#/activities">Manage Activities</a></li>
            <li><a href="#/categories">Manage Categories</a></li>
          </ul>
        </div>
      </div>
    </nav>
    <ng-view class="partial-view"></ng-view>
</div>

