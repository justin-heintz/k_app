<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<?= $this->Html->script('users/register.js') ?>
<div class="container-xl">
	<div class="row">
		<div class="col">
			<form method="post">
				<h2>Register User</h2>
				<div>
					<label for="">First Name<br> <input type="text" name="fname" placeholder="First Name"> </label>
					
					<label for="">Last Name <br> <input type="text" name="lname" placeholder="Last Name"> </label>
					
					<label for="">Gender <br> 
						<select name="gender">
							<option value="male" selected>Male</option>
							<option value="female">Female</option>
							<option value="other">Other</option>
						</select> 
					</label>
				</div>
				<div>
					<label for="">Email <br> <input type="email" name="email" placeholder="a@t.com"> </label>
					
					<label for="">Password <br> <input type="password" name="pass"> </label>
					<label for="">Confirm Password <br> <input type="password" name="cpass"> </label>
				</div>
				<!--
				<div class="sm-logos">
					<div>
						<?= $this->Html->image('/img/logos/facebook.png') ?> 
						<input name="smFb" type="checkbox">
					</div>
					<div>
						<?= $this->Html->image('/img/logos/gab.png') ?>
						<input name="smGa" type="checkbox">
					</div>
					<div>
						<?= $this->Html->image('/img/logos/Instagram.png') ?>
						<input name="smIn" type="checkbox">
					</div>
					<div>
						<?= $this->Html->image('/img/logos/linkedin.png') ?>
						<input name="smLi" type="checkbox">
					</div>
				</div>
				
				<div class="sm-logos">	
					<div>
						<?= $this->Html->image('/img/logos/reddit.png') ?>
						<input name="smRe" type="checkbox">
					</div>
					<div>
						<?= $this->Html->image('/img/logos/medium.png') ?>
						<input name="smMe" type="checkbox">
					</div>
					<div>
						<?= $this->Html->image('/img/logos/pinterest.png') ?>
						<input name="smPi" type="checkbox">
					</div>
					<div>
						<?= $this->Html->image('/img/logos/vk.png') ?>
						<input name="smVk" type="checkbox">
					</div>
				</div>
				
				<div class="sm-logos">	
					<div>
						<?= $this->Html->image('/img/logos/twitter.png') ?>
						<input name="smTw" type="checkbox">
						</div>
					<div>
						<?= $this->Html->image('/img/logos/tiktok.png') ?>
						<input name="smTi" type="checkbox">
					</div>
					<div>
						<?= $this->Html->image('/img/logos/tumblr.png') ?>
						<input name="smTu" type="checkbox">
					</div>
					<div>
						<?= $this->Html->image('/img/logos/youtube.png') ?>
						<input name="smYo" type="checkbox">
					</div>
				</div>
		-->
				<div class="g-recaptcha" data-sitekey="6LenXwwTAAAAANRX7SHyXhx4kQ24X1x_cx7vPCKV"></div>
				<input type="hidden" name="_csrfToken" value="<?= $this->request->getAttribute('csrfToken') ?>">
				<input type="submit" value="Register">
			</form>
		</div>

	</div>
</div>