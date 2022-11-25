<?php
/**
 * @var string $title
 * @var array $report
 * @var array $menu
 */
?>
<main>
	<?= view('components/menu', ['items' => $menu]) ?>
	<div class="wrapper">
		<?php foreach ($report as $item): ?>
			<p><?= $item ?></p>
		<?php endforeach; ?>
	</div>
</main>
