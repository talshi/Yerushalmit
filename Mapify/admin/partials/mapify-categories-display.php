<?php

?>

<h1>Manage Categories</h1>
<div class="note">Organize your categories.</div><br>
<div class="activities-table" ng-controller="activitiesCtrl">
		<table>
			<tr>
				<th>#</th>
				<th>Category Name</th>
				<th>Category Description</th>
				<th>Tag</th>
				<th></th>
			</tr>
			<tr ng-repeat="category in categories_list">
				<td><input type="checkbox" /></td>
				<td>{{ category.name }}</td>
				<td>{{ category.description }}</td>
				<td>{{ category.tag }}</td>
				<td><input type="button" value="Delete"></td>
			</tr>
		</table>
		<input type="button" value="Delete Selected">
		
	</div>
