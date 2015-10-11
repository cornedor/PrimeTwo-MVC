<section class="docsIndex">

<div class="container">
<?php foreach($docs as $doc): ?>
	<div class="row">
		<div class="col-lg-12">
			<h2><?php echo $doc->title; ?></h2>
			<p><?php echo $doc->text; ?></p>
			<small>Last updated: <?php echo $doc->updated_at; ?></small>
		</div>
	</div>		
<?php endforeach; ?>
</div>

</section>