<?= $this->Html->link(__('List Users'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
<form method="post" action="" >
	<fieldset>
		<legend><?= __('Add User') ?></legend>
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
