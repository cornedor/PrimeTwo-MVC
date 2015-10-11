<section class="contactForm">
<div class="container">

	<?php if(!empty($alert['status'])): ?>
		<div class="alert alert-<?php echo $alert['status']; ?>">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<strong><?php echo ucfirst($alert['status']); ?>!</strong>
            <?php if(is_array($alert['message'])): ?>
                <?php foreach($alert['message'] as $message): ?>
                    <?php echo $message; ?><br/>
                <?php endforeach; ?>
            <?php else: ?>
                <?php echo $alert['message']; ?>
            <?php endif; ?>
		</div>
	<?php endif; ?>


	<div class="well bs-component">
		<form class="form-horizontal" action="/sendContactMail" method="POST" role="form">
			<fieldset>
				<legend class="">Contact us</legend>
				<div class="form-group">
					<label for="name" class="col-lg-2 control-label">Name</label>
					<div class="col-lg-10">
						<input required name="name" type="text" class="form-control" id="name" placeholder="Name" pattern="<?php echo PrimeTwo\Framework\FormValidation::getPattern('name', true); ?>">
					</div>
				</div>
				<div class="form-group">
					<label for="email" class="col-lg-2 control-label">Email Adress</label>
					<div class="col-lg-10">
						<input required name="email" type="email" class="form-control" id="email" placeholder="Email Adress" pattern="<?php echo PrimeTwo\Framework\FormValidation::getPattern('email', true); ?>">
					</div>
				</div>
				<div class="form-group">
					<label for="phone" class="col-lg-2 control-label">Phone Number</label>
					<div class="col-lg-10">
						<input required name="phone" type="tel" class="form-control" id="phone" placeholder="Phone Number" pattern="<?php echo PrimeTwo\Framework\FormValidation::getPattern('tel', true); ?>">
					</div>
				</div>
				<div class="form-group">
					<label for="textArea" class="col-lg-2 control-label">Message</label>
					<div class="col-lg-10">
						<textarea required name="message" class="form-control" rows="3" id="textArea"></textarea>
						<span class="help-block">Please keep your message short. We prefer to be informal.</span>
					</div>
				</div>
				<div class="form-group">
					<div class="col-lg-10 col-lg-offset-2">
						<button type="submit" class="btn btn-primary">Submit</button>
					</div>
				</div>
			</fieldset>
		</form>
	</div>

</div>
</section>