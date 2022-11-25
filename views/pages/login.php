<?php
/** @var array $errors */
?>

<main>
	<div class="wrapper">
		<?php if(!empty($errors)):?>
			<div class="alert danger">
				<?= implode('<br>', $errors) ?>
			</div>
		<?php endif; ?>
		<form action="/login.php" method="post">
			<label class="login-label">
				<input type="text" name="login" class="login-elem" required placeholder="Login">
				<input type="password" name="password" class="login-elem" required placeholder="Password">
				<button type="submit" class="login-elem">Log in</button>
			</label>
		</form>
	</div>
</main>