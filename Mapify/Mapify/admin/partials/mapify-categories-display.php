<?php

?>

<h1>Manage Categories</h1>
<div class="note">Organize your categories.</div><br>
<div class="activities-table" ng-controller="activitiesCtrl">
		<table>
			<tr>
				<th>#</th>
				<th>Activity Name</th>
				<th>Date</th>
				<th>Description</th>
			</tr>
			<tr ng-repeat="category in categories_list">
				<td><input type="checkbox" /></td>
				<td>{{ category.name }}</td>
				<td>{{ category.description }}</td>
				<td>{{ category.tag }}</td>
			</tr>
		</table>
		
	</div>
