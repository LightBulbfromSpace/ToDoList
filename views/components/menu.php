<?php
/**
 * @var array $items
 */

$currentURL = trim($_SERVER['REQUEST_URI']);
?>


<nav class="menu">
	<?php foreach ($items as $item): ?>
		<a href= "<?=$item['url']?>" class="button <?= ($currentURL === $item['url']) ? 'is-active' : '' ?>"><?= $item['text'] ?></a>
	<?php endforeach; ?>
</nav>