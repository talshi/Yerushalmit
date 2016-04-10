<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Mapify
 * @subpackage Mapify/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

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

