<?php $this->_t = 'Accueil'; ?>

<div id="content--container">
	<?php include ('skeleton.php')?>
	<!-- SET PERSONNAGES CONTENT-->
</div>
<!-- FORM -->
<div class="form--container">
	<h2>Nouveau personnage</h2>
	<form id="form" method="post" enctype="multipart/form-data">
		<input type="text" placeholder="entrer un nom" id="input--name" name="name"/>
		<p id="input--helper--name"></p>
		<div class="input--image--container"> 
			<input class="input--picture" name="picture" placeholder="choisir une image" readonly/>
			<label class="label--image--block">
				<i class="fas fa-camera account-fa-camera"></i>
				<input type="file" size="60" class="fas" id="input--image" name="image" style="display: none">
			</label>	
			<p id="input--helper--image"></p>
		</div>
		<button type='submit'>Enregister</button>
	</form>
</div>
<!-- SCRIPT FOR PUT VIEW CONTENT IN CONTAINER -->
<script>	
	var pagination = new Pagination();
	pagination.loadContent(
	<?php if (isset($_SESSION['currentPage'])) : ?>
	<?= $_SESSION['currentPage'] ?>
	<?php else : ?>
	<?= $currentPage ?>
	<?php endif ?>);

</script>