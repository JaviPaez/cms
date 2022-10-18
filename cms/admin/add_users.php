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
	header("location: default.php");
}

$user->id = (isset($_GET['id']) && $_GET['id']) ? $_GET['id'] : '0';
$saveMessage = '';
if (!empty($_POST["saveUser"]) && $_POST["email"] != '') {

	$user->first_name = $_POST["first_name"];
	$user->last_name = $_POST["last_name"];
	$user->email = $_POST["email"];
	$user->type = $_POST["user_type"];
	$user->deleted = $_POST["user_status"];
	if ($user->id) {
		$user->updated = date('Y-m-d H:i:s');
		if ($user->update()) {
			$saveMessage = "Usuario actualizado exitosamente!";
		}
	} else {
		$user->password = $_POST["password"];
		$lastInserId = $user->insert();
		if ($lastInserId) {
			$user->id = $lastInserId;
			$saveMessage = "Usuario guardado exitosamente!";
		}
	}
}

$userDetails = $user->getUser();

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
							<h3 class="panel-title">Nuevo Usuario</h3>
						</div>
						<div class="panel-body">

							<form method="post" id="postForm">
								<?php if ($saveMessage != '') { ?>
									<div id="login-alert" class="alert alert-success col-sm-12"><?php echo $saveMessage; ?></div>
								<?php } ?>
								<div class="form-group">
									<label for="title" class="control-label">Nombre</label>
									<input type="text" class="form-control" id="first_name" name="first_name" value="" placeholder="Nombre...">
								</div>

								<div class="form-group">
									<label for="title" class="control-label">Apellido</label>
									<input type="text" class="form-control" id="last_name" name="last_name" value="" placeholder="Apellido...">
								</div>

								<div class="form-group">
									<label for="title" class="control-label">E-mail</label>
									<input type="email" class="form-control" id="email" name="email" value="" placeholder="e-mail...">
								</div>
								<?php
								if (!$user->id) {
								?>
									<div class="form-group">
										<label for="title" class="control-label">Contraseña</label>
										<input type="password" class="form-control" id="password" name="password" value="" placeholder="Contraseña...">
									</div>
								<?php } ?>

								<div class="form-group">
									<label for="status" class="control-label">Tipo de usuario</label>
									<label class="radio-inline">
										<input type="radio" name="user_type" id="admin" value="1">Administrador
									</label>
									<label class="radio-inline">
										<input type="radio" name="user_type" id="author" value="2">Autor
									</label>
								</div>

								<div class="form-group">
									<label for="status" class="control-label">Estado</label>
									<label class="radio-inline">
										<input type="radio" name="user_status" id="active" value="0">Activo
									</label>
									<label class="radio-inline">
										<input type="radio" name="user_status" id="inactive" value="1">Inactivo
									</label>
								</div>

								<input type="submit" name="saveUser" id="saveUser" class="btn btn-info" value="Guardar" />
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php include('inc/footer.php'); ?>