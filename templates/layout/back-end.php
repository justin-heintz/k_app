<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
       Front-End: <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <?= $this->Html->css(['front-end','style-guide']) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
	<?= $this->Html->script('tinymce/tinymce.min.js'); ?>
    <?= $this->fetch('script') ?>
</head>
<body>
	<div class="container">
		<nav>
			<a class="<?= $action =="view" ? "active" : "" ?>" title="Tasks Create" href="<?= $this->Url->build(["controller" => "tasks", "action" => "view"]); ?>">View Tasks</a> |
			<a class="<?= $action =="create" ? "active" : "" ?>" title="Tasks Create" href="<?= $this->Url->build(["controller" => "tasks", "action" => "create"]); ?>">Create Tasks</a> |
			<a class="" title="Sign Out" href="<?= $this->Url->build(["controller" => "Users", "action" => "logout"]); ?>">Sign Out</a>
		</nav>
	</div>	
    <main class="main">
	<?= $this->Flash->render() ?>
	<?= $this->fetch('content') ?>
    <footer></footer>
</body>
</html>
