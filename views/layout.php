<?php
/**
 * @var string $title
 * @var string $content
 */
?>
<!doctype html>
<html lang="<?= getConfigOption('APP_LANG', 'en') ?>">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" type="text/css" href="style.css">
	<title><?= $title ?></title>
</head>
<body>
<section class="content">
	<header>
		<a href="/" class="title"><span class="icon">✨✨✨</span></a>
		<a href="/" class="title"><h1><?= $title ?></h1></a>
	</header>
		<?= $content ?>
	<footer><p class="sign">(c)  <?= date('Y') ?>  Created by Ehehe Corporation</p></footer>
</section>
</body>
</html>
