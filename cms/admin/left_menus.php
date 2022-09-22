<div class="col-md-3">
	<div class="list-group">
		<a href="dashboard.php" class="list-group-item active main-color-bg"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
			Panel de administración <span class="badge"><?php echo $post->totalPost() + $category->totalCategory() + $user->totalUser(); ?></span>
		</a>
		<a href="posts.php" class="list-group-item"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Publicaciones<span class="badge"><?php echo $post->totalPost(); ?></span></a>
		<a href="categories.php" class="list-group-item"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Categorías<span class="badge"><?php echo $category->totalCategory(); ?></span></a>
		<a href="users.php" class="list-group-item"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Usuarios <span class="badge"><?php echo $user->totalUser(); ?></span></a>
	</div>
</div>