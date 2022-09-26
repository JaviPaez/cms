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

$post = new Post($db);

$categories = $post->getCategories();

$post->id = (isset($_GET['id']) && $_GET['id']) ? $_GET['id'] : '0';
$saveMessage = '';
if (!empty($_POST["savePost"]) && $_POST["title"] != '' && $_POST["message"] != '') {

	$post->title = $_POST["title"];
	$post->message = $_POST["message"];
	$post->category = $_POST["category"];
	$post->status = $_POST["status"];
	if ($post->id) {
		$post->updated = date('Y-m-d H:i:s');
		if ($post->update()) {
			$saveMessage = "Publicación actualizada exitosamente!";
		}
	} else {
		$post->userid = $_SESSION["userid"];
		$post->created = date('Y-m-d H:i:s');
		$post->updated = date('Y-m-d H:i:s');
		$lastInserId = $post->insert();
		if ($lastInserId) {
			$post->id = $lastInserId;
			$saveMessage = "Publicación guardada exitosamente!";
		}
	}
}

$postdetails = $post->getPost();

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
							<h3 class="panel-title">Editar publicación</h3>
						</div>
						<div class="panel-body">

							<form method="post" id="postForm">
								<?php if ($saveMessage != '') { ?>
									<div id="login-alert" class="alert alert-success col-sm-12"><?php echo $saveMessage; ?></div>
								<?php } ?>
								<div class="form-group">
									<label for="title" class="control-label">Título</label>
									<input type="text" class="form-control" id="title" name="title" value="<?php echo $postdetails['title']; ?>" placeholder="Título...">
								</div>

								<div class="form-group">
									<label for="lastname" class="control-label">Mensaje</label>
									<textarea class="tinymce" rows="5" id="message" name="message" placeholder="Mensaje..."><?php echo $postdetails['message']; ?></textarea>
								</div>


								<div class="form-group">
									<label for="sel1">Categoría</label>
									<select class="form-control" id="category" name="category">
										<?php
										while ($category = $categories->fetch_assoc()) {
											$selected = '';
											if ($category['name'] == $postdetails['name']) {
												$selected = 'selected=selected';
											}
											echo "<option value='" . $category['id'] . "' $selected>" . $category['name'] . "</option>";
										}
										?>
									</select>
								</div>
								<div class="form-group">
									<label for="status" class="control-label"></label>
									<label class="radio-inline">
										<input type="radio" name="status" id="publish" value="publicada" <?php if ($postdetails['status'] == 'publicada') {
																												echo "checked";
																											} ?>>Publicada
									</label>
									<label class="radio-inline">
										<input type="radio" name="status" id="draft" value="pendiente" <?php if ($postdetails['status'] == 'pendiente') {
																											echo "checked";
																										} ?>>Pendiente
									</label>
									<label class="radio-inline">
										<input type="radio" name="status" id="archived" value="archivada" <?php if ($postdetails['status'] == 'archivada') {
																												echo "checked";
																											} ?>>Archivada
									</label>
								</div>
								<input type="submit" name="savePost" id="savePost" class="btn btn-info" value="Guardar" />
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php include('inc/footer.php'); ?>