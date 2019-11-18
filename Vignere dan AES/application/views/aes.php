<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>AES</title>
	<link rel="stylesheet" href="<?php echo base_url('vendor/bootstrap/dist/css/bootstrap.min.css') ?>">
</head>
<body>
	<div class="container -4">
		<div class="row">
			<div class="col-lg-4">
				<form action="javascript:void(0)" method="POST" id="fr">
					<table class="table table-responsive">
						<tr>
							<td>Plain Text</td>
							<td>:</td>
							<td><textarea name="text" cols="30" rows="10"></textarea></td>
						</tr>
						<tr>
							<td><input type="radio" class="radio" name="op" value="en">Enkripsi</td>
							<td>|</td>
							<td><input type="radio" class="radio" name="op" value="de">Dekripsi</td>
						</tr>
						<tr align="center">
							<td colspan="3"><button type="submit">Proses</button></td>
						</tr>
					</table>				
				</form>
			</div>
			<div class="col-lg-4">
			<textarea name="hasil" id="hasil" cols="30" rows="10">hasil disini</textarea>					
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
	<script src="<?php echo base_url('vendor/jquery.min.js') ?>"></script>
	<script src="<?php echo base_url('vendor/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
	<script>
		$(document).ready(function() {
			$('#fr').submit(function(e) {
				e.preventDefault();
				$.ajax({
					'url': "<?php echo base_url('aes/index') ?>",
					'method': 'POST',
					'data': $('#fr').serialize(),
					'success': function(data) {
						$('#hasil').html(data);
					}
				});
			});
		});
	</script>
</body>
</html>