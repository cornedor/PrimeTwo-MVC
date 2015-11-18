<section class="about">

	<div class="container">
		<h2 class="text-center"><?php echo $title; ?></h2>
            <div class="row">
                <?php foreach ($team as $member): ?>
                    <div class="col-lg-6 ta-center">
                        <h3><?php echo $member->fullname; ?></h3>
                        <img class="team-member-picture img-circle" src="<?php echo $appConfig['url'].$member->picture; ?>" alt="<?php echo $member->fullName; ?>'s picture.">
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
	
</section>