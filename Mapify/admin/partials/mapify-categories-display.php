
<div id="success"></div>
<div class="manage_caption">Manage Categories</div>
<div class="note">Organize your categories.</div>
<br>
<hr>
<div class="categories-control">
	<label for="search">Search: </label> <input name="search" type="text"
		ng-model="query" /> <input type="button" class="buttonDesign" value="Add New Category" data-toggle="modal" data-target="#myModal" />
		 <input type="button" class="buttonDesign" value="Remove Selected" id="IDdeleteSelectedCategory" />
		  <input type="button" class="buttonDesign" value="Remove All" id="IDdeleteAllCategory" />
</div>
<!-- search bar -->

<div class="activities-table">

	<table>
		<tr class = " firstLineTable ">
			<th>#</th>
			<th id="IDcategory-name" ng-model="name"
				ng-click="sortBy='name'; reverseSort=!reverseSort">Category Name</th>
			<th>Description</th>
			<th>Image</th>
		</tr>
		<tr ng-repeat="category in categories_list | filter: query | orderBy:sortBy:reverseSort"
			id="table" class="data_table">
			<td width="10%"><input id="categorychecked{{category.id}}" type="checkbox" /></td>
			<td width="30%">{{ category.name }}</td>
			<td id ="data_table_des">{{ category.description }}</td>
			<td width="7%"><img src="{{category.logoUrl}}"></td>
		</tr>
	</table>

	<div id="myModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					
					<h4 class="modal-title">Add New Catergory</h4>
					<form class="modal-body" role="form">

						<table id="IdInsertTableCategory" class="table table-hover">
							<tr>
								<td><label for="IDDCategoryName">Category Name</label></td>
								<td><input type="text" id="IDDCategoryName"
									placeholder="Category Name" ng-model="CategoryName" ></td>
							</tr>
							<tr>
								<td><label for="IDareaText">Description</label></td>
								<td><textarea type="text" ng-model="CategoryDescription"
										id="IDareaText" placeholder="Description" ng-model="CategoryDescription"> </textarea></td>
							</tr>
						</table>

						<div id="upload_image_admin">
							<div id="upload_note">Upload a category image:</div>
							<div id="upload_image_container">
								<label id="upload_map_label" for="upload_image_category">Upload
									Image</label> <br> <input id="upload_image_category"
									type="text" size="36" name="upload_image_category"
									placeholder="URL" ng-model="CategoryURL" /> <input id="upload_image_button_category"
									type="button" value="Upload Image" />
								</td>
							</div>
						</div>

						<div class="modal-footer">
							<button type="button" class="btn btn-default"
								data-dismiss="modal">Close</button>
							<!-- add item to DB.... -->
							<button id="save-button-category" class="btn btn-default" type="submit"
								data-dismiss="modal" ng-click="addCategory()">Save</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
