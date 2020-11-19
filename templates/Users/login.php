<div class="container">
	<div class="row">
		<div class="col">
			<form method="post" action="">
				<h2>Login</h2>
				<label>Email <br> <input type="email" name="email" value="test@test.com"></label>
				<label>Password <br> <input type="password" name="password" value="abc123"></label>
				<input type="hidden" name="_csrfToken" value="<?= $this->request->getAttribute('csrfToken') ?>">
				<input type="submit" value="Login">
			</form>
		</div>	
	</div>	
	<div class="row">
		<div class="col">
			<!-- <a href="<?= $this->Url->build(["controller" => "Users", "action" => "register"]); ?>">Register</a> -->
		</div>	
	</div>			
</div>