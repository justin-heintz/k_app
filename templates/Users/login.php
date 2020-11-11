<fieldset>
	<form method="post" action="">
		<input type="email" name="email" value="test@test.com">
		<input type="password" name="password" value="abc123">
		<input type="hidden" name="_csrfToken" value="<?= $this->request->getAttribute('csrfToken') ?>">
		<input type="submit">
	</form>
</fieldset>