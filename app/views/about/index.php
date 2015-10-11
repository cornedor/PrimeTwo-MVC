<section class="about">

	<div class="container">
		<div class="row">
			<h2>The people behind PrimeTwo</h2>
			<?php foreach ($team as $member): ?>
				<div class="col-lg-6">
					<h3><?php echo $member->fullName; ?></h3>
					<img class="img-circle" src="<?php echo $appConfig['url'].$member->picture; ?>" alt="<?php echo $member->fullName; ?>'s picture.">
				</div>
			<?php endforeach; ?>
		</div>
	</div>
	
</section>