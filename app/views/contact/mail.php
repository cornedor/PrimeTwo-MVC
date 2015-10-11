<div class="contactFormMail">
	<h2>Contact form send on <?php echo date('d-m-Y'); ?></h2>
	<table>
		<tr>
			<td>
				<strong>Name: </strong>
			</td>
			<td>
				<?php echo $inputs['name']; ?>
			</td>
		</tr>
		<tr>
			<td>
				<strong>Email Address: </strong>
			</td>
			<td>
				<?php echo $inputs['email']; ?>
			</td>
		</tr>
		<tr>
			<td>
				<strong>Phone Number: </strong>
			</td>
			<td>
				<?php echo $inputs['phone']; ?>
			</td>
		</tr>
		<tr>
			<td>
				<strong>Message: </strong>
			</td>
			<td>
				<p><?php echo $inputs['message']; ?></p>
			</td>
		</tr>
	</table>
</div>