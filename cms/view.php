<?php
include_once 'config/Database.php';
include_once 'class/Articles.php';
$database = new Database();
$db = $database->getConnection();

$article = new Articles($db);

$article->id = (isset($_GET['id']) && $_GET['id']) ? $_GET['id'] : '0';

$result = $article->getArticles();

include('inc/header.php');

?>
<title>Sistema gestor de contenido con PHP y MySQL</title>
<link href="css/style.css" rel="stylesheet" id="bootstrap-css">
<?php include('./inc/container.php'); ?>
<div class="container">
	<div id="blog" class="row">
		<div id="blog" class="row">
			<div class="header">
				<a href="#default" class="logo">Mi Blog!</a>
				<div class="header-right">
					<a href="index.php">Inicio</a>
					<a href="#contact">Contacto</a>
					<a href="#about">Acerca de</a>
				</div>
			</div>
			<?php
			while ($post = $result->fetch_assoc()) {
				$date = date_create($post['created']);
				$fecha = date_timestamp_get($date);
				$message = str_replace("\n\r", "<br><br>", $post['message']);
			?>
				<div class="col-md-10 blogShort">
					<h2><?php echo $post['title']; ?></h2>
					<em><strong>Publicado el</strong>: <?php echo utf8_encode(ucfirst(strftime('%A %e de %B de %Y a las %H:%M:%S', $fecha)));	?></em>
					<em><strong>Categoría:</strong> <a href="#" target="_blank"><?php echo $post['category']; ?></a></em>
					<br><br>
					<article>
						<p><?php echo $message; ?> </p>
					</article>
				</div>
			<?php } ?>

			<div class="col-md-12 gap10"></div>

		</div>
	</div>
	<?php include('inc/footer.php'); ?>