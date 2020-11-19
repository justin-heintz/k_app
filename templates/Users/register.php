<?= $this->Html->script('users/register.js') ?>
<div class="container-xl">
	<div class="row">
		<div class="col">
			<form method="post">
				<h2>Register User</h2>
				<label for="">Email <br> <input type="email" name="email" placeholder="a@t.com"> </label>
				<label for="">Password <br> <input type="password" name="password"> </label>
				<label for="">Confirm Password <br> <input type="password" name="password"> </label>
				
				<div class="sm-logos">
					<div>
						<?= $this->Html->image('/img/logos/facebook.png') ?> 
						<input name="checked" type="hidden">
					</div>
					<div>
						<?= $this->Html->image('/img/logos/gab.png') ?>
						<input name="checked" type="hidden">
					</div>
					<div>
						<?= $this->Html->image('/img/logos/Instagram.png') ?>
						<input name="checked" type="hidden">
					</div>
					<div>
						<?= $this->Html->image('/img/logos/linkedin.png') ?>
						<input name="checked" type="hidden">
					</div>
				</div>
				
				<div class="sm-logos">	
					<div>
						<?= $this->Html->image('/img/logos/reddit.png') ?>
						<input name="checked" type="hidden">
					</div>
					<div>
						<?= $this->Html->image('/img/logos/medium.png') ?>
						<input name="checked" type="hidden">
					</div>
					<div>
						<?= $this->Html->image('/img/logos/pinterest.png') ?>
						<input name="checked" type="hidden">
					</div>
					<div>
						<?= $this->Html->image('/img/logos/vk.png') ?>
						<input name="checked" type="hidden">
					</div>
				</div>
				
				<div class="sm-logos">	
					<div>
						<?= $this->Html->image('/img/logos/twitter.png') ?>
						<input name="checked" type="hidden">
						</div>
					<div>
						<?= $this->Html->image('/img/logos/tiktok.png') ?>
						<input name="checked" type="hidden">
					</div>
					<div>
						<?= $this->Html->image('/img/logos/tumblr.png') ?>
						<input name="checked" type="hidden">
					</div>
					<div>
						<?= $this->Html->image('/img/logos/youtube.png') ?>
						<input name="checked" type="hidden">
					</div>
				</div>

				<input type="hidden" value="0" name="type">
				<input type="hidden" name="_csrfToken" value="<?= $this->request->getAttribute('csrfToken') ?>">
				<input type="submit" value="Register">
			</form>
		</div>

	</div>
</div>