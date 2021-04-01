<div class="container">
	<div class="jumbotron mt-4">
		<h1 class="display-4">home</h1>
		<?php foreach ($data['nama'] as $home) : ?>
			<p class="lead">Halo,nama saya <?= $home['username']; ?></p>
			<hr class="my-4">
      		<p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
      		<a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
		<?php endforeach ?>
	</div>
</div>