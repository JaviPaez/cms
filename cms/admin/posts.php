<?php
include_once 'config/Database.php';
include_once 'class/User.php';
include_once 'class/Post.php';
include_once 'class/Category.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);
$post = new Post($db);
$category = new Category($db);

if (!$user->loggedIn()) {
	header("location: index.php");
}
include('inc/header.php');
?>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap.min.js"></script>
<link rel="stylesheet" href="css/dataTables.bootstrap.min.css" />
<script src="js/posts.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
	<?php include "menus.php"; ?>
	<header id="header">
		<div class="container">
			<div class="row">
				<div class="col-md-10">
					<h1><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Panel de administración <small>Gestor de Datos</small></h1>
				</div>
				<br>
			</div>
		</div>
	</header>
	<br>
	<section id="main">
		<div class="container">
			<div class="row">
				<?php include "left_menus.php"; ?>
				<div class="col-md-9">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">Listado de Publicaciones</h3>
						</div>
						<div class="panel-body">
							<div class="panel-heading">
								<div class="row">
									<div class="col-md-10">
										<h3 class="panel-title"></h3>
									</div>
									<div class="col-md-2" align="right">
										<a href="add_post.php" class="btn btn-default btn-xs">Nuevo</a>
									</div>
								</div>
							</div>
							<table id="postsList" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>Título</th>
										<th>Categoría</th>
										<th>Usuario</th>
										<th>Estado</th>
										<th>Creada</th>
										<th>Actualizada</th>
										<th></th>
										<th></th>
									</tr>
								</thead>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php include('inc/footer.php'); ?>