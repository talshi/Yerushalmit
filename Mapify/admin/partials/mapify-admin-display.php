
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
          <span id="mapify-caption" class="navbar-brand">Mapify Control Panel</span>
        </div>
        <div id="navbar" class="navbar-collapse collapse" ng-controller="adminCtrl">
          <ul class="nav navbar-nav">
            <li ng-class="{ active: isActive('/map')}"><a href="#/map">Manage Map</a></li>
            <li ng-class="{ active: isActive('/activities')}"><a href="#/activities">Manage Activities</a></li>
            <li ng-class="{ active: isActive('/categories')}"><a href="#/categories">Manage Categories</a></li>
            <li ng-class="{ active: isActive('/preview')}"><a href="#/preview">Preview</a></li>
            <li ng-class="{ active: isActive('/publish')}"><a href="#/publish">Publish</a></li>
          </ul>
        </div>
      </div>
    </nav>
    <ng-view class="partial-view"></ng-view>
</div>

