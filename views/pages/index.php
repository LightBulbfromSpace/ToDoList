<?php
/**
 * @var array $todos
 */
?>

<main>
	<?php foreach ($todos as $todo): ?>
		<article class="todo">
			<label>
				<input type="checkbox" <?= ($todo['completed']) ? 'checked' : '' ;?>>
				<?= $todo['title'] ?>
			</label>
		</article>
	<?php endforeach; ?>

	<form action="/" method="post">
		<label>
			<input type="text" class="add-todo" placeholder="New task">
			<button type="submit">Save</button>
		</label>
	</form>
</main>
