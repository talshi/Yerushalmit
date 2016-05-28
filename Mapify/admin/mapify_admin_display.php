<?php
   
?>

<div ng-app="wp_mapify_app">
    <nav class="navbar navbar-default">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Mapify Control Panel</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Manage Map</a></li>
            <li><a href="#about">Manage Activities</a></li>
            <li><a href="#contact">Manage Categories</a></li>
          </ul>
        </div>
      </div>
    </nav>
    <div>
        <input type="text" ng-model="map">
        {{ map }}
    </div>
</div>

w