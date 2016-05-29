
<h1>Manage Categories</h1>
<div class="note">Organize your categories.</div>
<br>

<label for="search">Search: </label>
<input name="search" type="text" ng-model="query" />
<!-- search bar -->

<div class="activities-table" ng-controller="activitiesCtrl">

	<table>
		<tr>
			<th>#</th>
			<th id="IDcategory-name" ng-model="name"
				ng-click="sortBy='name'; reverseSort=!reverseSort">Category Name</th>
			<th>Description</th>
		</tr>
		<tr
			ng-repeat="category in categories_list | filter: query | orderBy:sortBy:reverseSort"
			id="table">
			<td><input type="checkbox" /></td>
			<td>{{ category.name }}</td>
			<td>{{ category.description }}</td>
		</tr>
	</table>
	<div>
		<input type="button" value="Add new Category" id="IDnewCategory"data-toggle='modal' data-target="#myModal" /> 
		<input type="button"value="remove selected" id="IDdeleteSelectedCategory" /> 
		<input	type="button" value="Delete All" id="IDdeleteAllCategory" />
	</div>


	<div id="myModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Add New Catergory</h4>
				</div>
			</div>
		</div>
	</div>
	
</div>