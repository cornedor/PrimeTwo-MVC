<section class="about">

	<div class="container">
		<h2 class="">The people behind PrimeTwo</h2>
		<div class="row">
			<?php foreach ($team as $member): ?>
				<div class="col-lg-4 ta-center">
					<h3><?php echo $member->fullName; ?></h3>
					<img class="team-member-picture img-circle" src="<?php echo $appConfig['url'].$member->picture; ?>" alt="<?php echo $member->fullName; ?>'s picture.">
				</div>
			<?php endforeach; ?>
		</div>
	</div>
	
</section>