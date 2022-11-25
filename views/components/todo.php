<?php
/**
 * @var array $todo
 * @var bool $isHistory
 */

?>

<article class="todo">
	<label>
		<input
			type="checkbox" <?= ($todo['completed']) ? 'checked' : '' ?>
			type="checkbox" <?= ($isHistory) ? 'disabled' : '' ?>
		>
		<?= truncate(shielding($todo['title']), getConfigOption('MAX_TITLE_LEN', 200)) ?>
	</label>
</article>