<form method="post">
	<fieldset>
		<legend>Register</legend>
		<label for="">Email</label>
		<input type="email" name="email" placeholder="t@t.com">
		
		<label for="">Password</label>
		<input type="password" name="password">
		
		<label for="">Type</label>
		<select name="type">
			<option value="0">Users</option>
			<option value="1">Customers </option>
			<option value="2">Partners </option>
			<option value="3">Affiliates </option>
		</select>
		
		<input type="hidden" name="_csrfToken" value="<?= $this->request->getAttribute('csrfToken') ?>">
		
		<input type="submit">
	</fieldset>
</form>
