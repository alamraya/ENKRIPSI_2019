<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="assets/materialize/css/materialize.min.css" rel="stylesheet" type="text/css" media="screen,projection">
		<link href="assets/materialize/css/googlefont.css" rel="stylesheet" type="text/css" media="screen,projection">
		<link href="assets/css/style.css" rel="stylesheet" type="text/css" media="screen,projection">
	</head>
	<body>	
		<div class="container">
			<div class="row">
				<div class="col s12 m12 l12 box-t">
					<div class="title-t">
					<BR>
					<center> <img alt="gambarunsil" src="Logo-Universitas-Siliwangi.png" height="150" width="150" />
					<BR>
						<!-- <!-- <i class="material-icons">vpn_key</i>  -->
						<center> <b>APLIKASI ENKRIPSI VERNAM</b> </center>
						<h3> <font size="3px"> ASEP NURUL HUDA - DZULFAHMI - RAUFI - RIDWAN</H3>
					</div>
					<br/>
					<div class="divider"></div>
					<br/>
					<div class="row">
						<div class="col s12 m3 l3">
							<div class="input-field col s12">
								<i class="material-icons prefix">vpn_key</i>
				          		<input id="key" name="key" type="text" class="validate" required>
				          		<label for="key">Masukan kunci</label>
				        	</div>
						</div>
						<div class="col s12 m9 l9">
							<a href="index.php">Enkripsi</a> | <a href="dekripsi_page.php"><b><u>Dekripsi</u></b></a>
							<form action="#" method="post" id="decrypt">
								<div class="row">
									<div class="col s12 m6">
										<div class="input-field col s12">
											<b>Chiper Teks</b>
							          		<textarea id="textarea1" style="height:150px" placeholder="Masukan Chiper Teks" required></textarea>
							        	</div>
									</div>
									<div class="col s12 m6">
										<div class="input-field col s12">
											<b>Plain Teks</b>
							          		<textarea id="textarea2" style="height:150px" placeholder="Hasil Dekripsi"></textarea>
							        	</div>
									</div>
								</div>
								<center><button type="submit" style="margin-top:10px;" class="btn waves-effect waves-light">DEKRIPSI</button></center>
							</form>
							<br/>
							<form action="#" id="addtext" method="post" enctype="multipart/form-data">
				        		<input type="file" name="filetxt">
				        		<button type="submit" class="btn waves-effect waves-light red">unggah</button>
				        	</form>
				        	<form action="#" id="simpan" method="post" align="right">
				        			<button align="right" style="margin-left:675px;" type="submit" class="btn waves-effect waves-light red">simpan</button>
				        	</form>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- javascript -->
		<script src="assets/js/jquery.js" type="text/javascript"></script>
		<script src="assets/materialize/js/materialize.min.js" type="text/javascript"></script>
		<script>
			$(document).ready(function(){
				$("#decrypt").submit(function(e){
					var chiperText = $("#textarea1").val();
					var key = $("#key").val();
					if(key==""){
						alert('Key tidak boleh kosong');
					}else{
						$.ajax({
							url:'dekripsi.php',
							data:{chiper_text:chiperText, key:key},
							method:'post',
							success:function(data){
								$("#textarea2").text(data);
							}
						});
					}
					return false;
				});
				$("#addtext").submit(function(){
					var formData = new FormData($(this)[0]);
					$.ajax({
						url:'readfile.php',
						data:formData,
						type:'POST',
						contentType: false,
						processData: false,
						success:function(data){
							$("#textarea1").val(data);
						}
					});
					return false;
				});
				$("#simpan").submit(function(e){
					if($("#textarea2").val()==""){
						alert("belum ada plaintext yang akan disimpan")
					}else{
					var hasilplain = $("#textarea2").val();
					$.ajax({
						url:'simpan_dekrip.php',
						data:{plain_hasil:hasilplain},
						method:'post',
						success: function(data) { 
            				alert("hasil plaintext tersimpan");
        				}
					});
					return false;
					}
				});
			});
		</script>
	</body>
</html>