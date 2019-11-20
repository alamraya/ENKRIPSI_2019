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
						<!-- <i class="material-icons">vpn_key</i> APLIKASI ENKRIPSI VERNAM -->
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
						<div class="col s12 m3 l3" align="center">
							<a href="#" id="key_generator" class="btn waves-effect waves-light">Generate Key</a>
							<div id="key_info" style="margin-top:20px;border:1px solid #bdbdbd;padding:10px;">
								<b>Kunci:</b><br/>
								<div id="key"></div><br/>
							</div>
						</div>
						<div class="col s12 m9 l9">
							<a href="index.php"><b><u>Enkripsi</u></b></a> | <a href="dekripsi_page.php">Dekripsi</a>
							<form action="#" method="post" id="encrypt">
								<div class="row">
									<div class="col s12 m6">
										<div class="input-field col s12">
											<b>Plain Teks</b>
							          		<textarea id="textarea1" style="height:150px" placeholder="Masukan Plain Teks" required></textarea>
							        	</div>
									</div>
									<div class="col s12 m6">
										<div class="input-field col s12">
											<b>Chiper Teks</b>
							          		<textarea id="textarea2" style="height:150px" placeholder="Hasil Enkripsi"></textarea>
							        	</div>
									</div>
								</div>
								<center><button type="submit" style="margin-top:10px;" class="btn waves-effect waves-light">ENKRIPSI</button></center>
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
				$("#key_info").hide();
				var key = "";
				$("#key_generator").click(function(){
					var plainText = $("#textarea1").val();
					if(plainText!=""){
						$.ajax({
							url:'get_key.php',
							data:{plain_text:plainText},
							method:'post',
							success:function(data){
								key = data;
								$("#key").text(data);
								$("#key_info").slideDown();
							}
						});
					}else{
						alert('Isi Plain Teks terlebih dahulu');
					}
				});
				$("#encrypt").submit(function(e){
					var plainText = $("#textarea1").val();
					if(key==""){
						alert('Kunci belum di generate');
					}else{
						$.ajax({
							url:'enkripsi.php',
							data:{plain_text:plainText, key:key},
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
						alert("belum ada chiper yang akan disimpan")
					}else{
					var hasilchiper = $("#textarea2").val();
					$.ajax({
						url:'simpan_enkrip.php',
						data:{chiper_hasil:hasilchiper},
						method:'post',
						success: function(data) { 
            				alert("hasil chiper tersimpan");
        				}
					});
					return false;
					}
				});
			});
		</script>
	</body>
</html>