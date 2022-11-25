<?php
/**
 * @var array $todos
 * @var bool $isHistory
 * @var array $errors
 * @var array $menu
 */
?>

<main>
	<?= view('components/menu', ['items' => $menu]) ?>
	<div class="wrapper">
	<?php if(!empty($errors)):?>
		<div class="alert danger">
			<?= implode('<br>', $errors) ?>
		</div>
	<?php endif; ?>
			<?php if (empty($todos)):?>
				<div class="alert">No tasks.</div>
			<?php else: ?>
		<div class="scroll">
				<?php foreach ($todos as $todo): ?>
					<?= view('components/todo', [
						'todo' => $todo,
						'isHistory' => $isHistory,
						]) ?>
				<?php endforeach; ?>
		</div>
			<?php endif;?>


	<?php if(!$isHistory): ?>
	<form action="/" method="post">
		<label>
			<input type="text" name="newTitle" class="add-todo" required placeholder="New task">
			<button type="submit">Save</button>
		</label>
	</form>
	</div>
	<?php endif; ?>
</main>
