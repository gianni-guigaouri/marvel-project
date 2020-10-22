<!-- IF LIST EXIST THEN SHOW LIST -->
<?php if($listPersonnages) : ?>
	<?php foreach($listPersonnages as $personnage) : ?>
		<!-- SET CONTENT PERSONNAGE-->
		<div class='content'>
			<div class="content--image">
				<a href="personnage-<?= $personnage->id() ?>"><img src="<?= $personnage->image() ?>"></a>
			</div>
			<div class="content--title">
				<h1> <?= $personnage->name() ?></h1>
			</div>
		</div>		
	<?php endforeach ?>
<?php else : ?>
	<!-- IF LIST DON'T EXIST THEN SHOW SKELETON -->
	<?php include ('skeleton.php')?>
<?php endif ?>	

<!-- PAGINATION -->
<div class="pagination--container">
	<ul class="pagination--nav">

	<!-- SET PREVIOUS CALL -->
	<?php if($prev < $start - 1) :?>
		<li class="pagination--item">
			<div class="pagination--link--container">
				<a class="pagination--link pagination--link--arrow" onclick="page.pageChange(<?= $prev ?>)">
					<i class="fas fa-arrow-circle-left"></i>
				</a>
			</div>	
		</li>
	<?php endif ?>
	<!-- SET PAGE 1 VISIBLE IF CURRENT PAGE SUPERIOR OR EGAL TO 4 -->
	<?php if($currentPage >= 4) : ?>
		<li class="pagination--item">
			<div class="pagination--link--container">
				<a class="pagination--link" onclick="page.pageChange(1)">1</a>
			</div>	
		</li>
	<?php endif ?>
	<?php for($b = max(1, $currentPage - 2); $b <= min($currentPage + 2, $nbPage); $b++) : ?>	
		<?php if($b == $currentPage) : ?>
			<li class="pagination--item">
				<div class="pagination--link--container pagination--link--container--active">
					<a class="pagination--link"><p><?= $b . " ";?></p></a>
				</div>	
			</li>
		<?php else : ?>
			<li class="pagination--item">
				<div class="pagination--link--container">
					<a class="pagination--link" onclick="page.pageChange(<?= $b ?>)"><p><?= $b . " ";?></p></a>
				</div>
			</li>
		<?php endif ?>
		
	<?php endfor ?>
	<!-- SET NEXT CALL -->
	<?php if($next < $nbPage +1) :?>
		<li class="pagination--item">
			<div class="pagination--link--container">
				<a class="pagination--link pagination--link--arrow" onclick="page.pageChange(<?= $next ?>)">
					<i class="fas fa-arrow-circle-right"></i>
				</a>
			</div>
		</li>
	<?php endif ?> 
	</ul>
</div>  

<script>
	var page = new Pagination();
</script>