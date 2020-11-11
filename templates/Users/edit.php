<?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id), 'class' => 'side-nav-item']) ?>
<?= $this->Html->link(__('List Users'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
<form method="post" action="" >
	<fieldset>
		<legend><?= __('Add User') ?></legend>
		<label for="">Email</label>
		<input type="email" name="email" value="<?= $user->email ?>">
		
		<label for="">Password</label>
		<input type="password" name="password">
		
		<label for="">Type</label>
		<select name="type">
			<option value="0" <?= ($user->type == 0 ? "selected" : "") ?>>Users</option>
			<option value="1" <?= ($user->type == 1 ? "selected" : "") ?>>Customers </option>
			<option value="2" <?= ($user->type == 2 ? "selected" : "") ?>>Partners </option>
			<option value="3" <?= ($user->type == 3 ? "selected" : "") ?>>Affiliates </option>
		</select>
		
		<input type="hidden" name="_csrfToken" value="<?= $this->request->getAttribute('csrfToken') ?>">
		
		<input type="submit">
	</fieldset>
</form>