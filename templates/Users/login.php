<div class="container">
	<div class="row">
		<div class="col">
			<?PHP if(isset($errorMsg)){?> <div class="alert alert-danger"><?= $errorMsg ?></div><?PHP } ?>
			<?PHP if(isset($activate) && $activate){?> <div class="alert alert-info">Your account was registered successfully. <br> Check your email to activate your account. </div> <?PHP } ?>
			<form method="post" action="">
				<h2>Login</h2>
				<label>Email <br> <input type="email" name="email" value="test@test.com"></label>
				<label>Password <br> <input type="password" name="password" value="abc123"></label>
				<input type="hidden" name="_csrfToken" value="<?= $this->request->getAttribute('csrfToken') ?>">
				<input type="submit" value="Login">
			</form>
		</div>	
	</div>	
</div>