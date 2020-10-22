<!-- SET PERSONNAGE NAME-->
<div class='personnage--container'>
	<div class='personnage--image'><img src="
		<?php if($details->image() !== null) : ?>
			<?= $details->image() ?>
		<?php else : ?>
			<?= $personnage->image() ?>	
		<?php endif ?>	
		">
	
	</div>
	<div class="personnage--title">
		<div class="personnage--title--container">
			<h2> <?= $personnage->name() ?></h2>
		</div>
		<div class="info--items--container">
			<?php if($details->comics() !== null && $details->series() !== null && $details->stories() !== null) : ?>
			<h3>
				Comics:<?= count($details->comics()).' '?>| 
				Series:<?= count($details->series()).' '?>|
				Stories: <?= count($details->stories())?>
			</h3>
			<?php else : ?>
			<h3>
				Comics: 0 | 
				Series:0 |
				Stories: 0
			</h3>
			<?php endif ?>
		</div>	
		<div class="personnage--description--container">
			<?php if($details->description()) : ?>
			<p class="personnage--description">"<?= $details->description()?>"</p>
			<?php else : ?>
			<p>...</p>
			<?php endif ?>
		</div>
		<?php if($details->link() !== null) : ?>
			<div class="personnage--link--container">
				<a href="<?= $details->link() ?>" target="_blank">Description complete sur Marvel.com</a>	
			</div>
		<?php endif ?>	

	</div>	
</div>