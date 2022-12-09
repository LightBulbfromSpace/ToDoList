<?php
/**
 * @var Todo $todo
 * @var bool $isHistory
 */

?>

<article class="todo">
	<label>
		<input
			type="checkbox" <?= ($todo->isCompleted()) ? 'checked' : '' ?>
			type="checkbox" <?= ($isHistory) ? 'disabled' : '' ?>
		>
		<?= truncate(shielding($todo->getTitle()), getConfigOption('MAX_TITLE_LEN', 200)) ?>
		<time
			datetime="<?= $todo->getCreatedAt()->format(DateTime::ATOM) ?>" class="data">
			<?= $todo->getCreatedAt()->format('M, d') ?>
		</time>
	</label>
</article>