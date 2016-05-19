<?php
?>

<div ng-app="wp_mapify_app" ng-controller="adminCtrl" class="wrap">
	<nav class="navbar navbar-default">
		<div>
			<div class="navbar-header navbar-brand">
				Mapify Control Panel
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li ng-class="{ active: isActive('/map')}" ><a href="#/map">Manage Map</a></li>
					<li ng-class="{ active: isActive('/activities')}" ><a href="#/activities">Manage Activities</a></li>
					<li ng-class="{ active: isActive('/categories')}" ><a href="#/categories">Manage Categories</a></li>
				</ul>
			</div>
		</div>
	</nav>
	<ng-view class="partial-view"></ng-view>
</div>