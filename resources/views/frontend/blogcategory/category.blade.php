<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<div class="container">
		<div class="panel panel-primary">
			<div class="panel-body">
				<div class="row">
					<div class="col-md-6">
						<h3>Category List</h3>
							<ul id="">
								@foreach($blog_categories as $category)
								<li>
									{{ 	$category->name }}
									
								</li>
									}
							</ul>
						
					</div>
					
				</div>
				
			</div>
			
		</div>
		
	</div>

</body>
</html>