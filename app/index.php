<?php
    include_once("./dep/CONFIG.php");
	$lienCourant="index";
	include_once("./dep/head.php");
	include_once("./dep/navbar.php");

//variable générale
$monfichier = file('crunch.conf');

//définition variable emplacement mkv
$mkvlongnom = trim ($monfichier[0]);
$mkv = substr($mkvlongnom, 8);
//définition variable emplacement mp4
$mp4longnom = trim ($monfichier[1]);
$mp4 = substr($mp4longnom, 8);
?>

<div class="container " role="main">
	<h2  style="margin-top : 70px;text-align:center">Téléchargement des animés sur le site de Crunchyroll v2.0</h2>

		<form id="form1" name="form1" method="post" action='updatetxt.php' enctype='multipart/form-data'>
			<div class="form-group" >
				<center><textarea name='textarea' cols="100" rows="10"><?php $file='lien.txt';
				$contenu=file_get_contents($file);
				echo $contenu; ?></textarea></center>
				<pre id="progress" style="overflow-y:scroll;min-height:10em;max-height:10em;overflow-x:hidden"></pre>
					<div class="row">
					<div class="col-sm-2">
						  <div class="form-group">
						    <div class="custom-control custom-radio">
							  <input type="checkbox" id="autoscroll" name="autoscroll" value="true"  class="custom-control-input"  checked >
						      <label class="custom-control-label" for="customRadio1">Auto Scroll</label>
						    </div>
					    </div>
					</div>
					<div class="col-sm-8">
						<center><input type="submit" name="vidercache" value="Vider le Cache"></center>
					</div>
				</div>
			</div>
			<div style="text-align:center">
				<?php
					$df = disk_free_space('/');
					$dt = disk_total_space('/');
					$du = $dt - $df;
					$bytes = disk_free_space(".");
					$si_prefix = array( 'B', 'KB', 'MB', 'GB', 'TB', 'EB', 'ZB', 'YB' );
					$base = 1024;
					$class = min((int)log($bytes , $base) , count($si_prefix) - 1);
					echo sprintf('Espace Libre %1.2f' , $bytes / pow($base,$class)) . ' ' . $si_prefix[$class] . '';
					echo sprintf(' sur %1.2f' , $dt / pow($base,$class)) . ' ' . $si_prefix[$class] . '<br /><br /> ';
				?>
			</div>
			<div class="row"  style="margin-top:1rem">
				<div class="col-sm-4 col-sm-offset-2" style="padding:0.1rem">
					<input type="submit" name="DL_720p" value="Télécharger en 720p"
					class=" btn btn-primary" style="width:100%" />
				</div>
				<div class="col-sm-4" style="padding:0.1rem">
					<input type="submit" name="DL_1080p" value="Télécharger en 1080p"
					class=" btn btn-primary" style="width:100%"/>
				</div>
			</div>
			<div class="row"  style="margin-top:1rem">
				<div class="col-sm-4 col-sm-offset-4" style="padding:0.1rem">
					<input type="submit" name="DL_720p_1080p" value="Télécharger en 720p et 1080p"
					class=" btn btn-warning" style="width:100%" />
				</div>
			</div>

			<div class="row"  style="margin-top:1rem">
				<div class="col-sm-4 col-sm-offset-4" style="padding:0.1rem">
					<input type="submit" name="soustitreonly" value="Télécharger les sous-titres"
					class=" btn btn-success" style="width:100%" />
				</div>
			</div>
			<div class="row" style="margin-top:1rem">
					<div class="col-sm-4 col-sm-offset-2"  style="padding:0.1rem">
						<input type="button" name="voirmkv" value="Voir les MKV"
						class=" btn btn-info" style="width:100%" onclick=location.href=<?=$mkv?>; >
					</div>
					<div class="col-sm-4"  style="padding:0.1rem">
						<input type="button" name="voirmp4" value="Voir les MP4 et sous-titres"
						class=" btn btn-info" style="width:100%" onclick=location.href=<?=$mp4?>; >
					</div>
			</div>
			<div class="row" style="margin-top:1rem">
				<div class="col-sm-4 col-sm-offset-4">
					<input type="submit" name="majYoutubeDL" value="Mise à jour de Youtube-DL"
					class=" btn btn-warning" style="width:100%" />
				</div>
			</div>
			<div class="row"  style="margin-top:1rem">
				<div class="col-sm-4 col-sm-offset-2"  style="padding:0.1rem">
					<input type="submit" name="Supprimerfichiermkv" value="Supprimer les Fichiers MKV"
					class=" btn btn-danger" style="width:100%"/>
				</div>
				<div class="col-sm-4" style="padding:0.1rem">
					<input type="submit" name="Supprimerfichiermp4"value="Supprimer les Fichiers MP4 et ASS"
					class=" btn btn-danger" style="width:100%"/>
				</div>
			</div>
			<div class="row"  style="margin-top:1rem">
				<div class="col-sm-4 col-sm-offset-4" style="padding:0.1rem">
					<input type="submit" name="Kill" value="Arrêter le téléchargement en cours"
					class=" btn" style="width:100%"/>
				</div>
			</div>

			<div class="row"  style="margin-top:1rem">
				<form method="POST" action="./config.php">
					<div class="col-sm-4 col-sm-offset-4" style="padding:0.1rem">
						<input type="submit" name="config" value="Configuration"
						class=" btn btn-success" style="width:100%" />
					</div>
				</form>
			</div>

		</form>
</div> <!-- /container -->

<script>
	autoscrollMode=true;
	// rafraixhissement de la progression toutes les secondes
	setInterval(()=>{
			  		$.get("progress.php",(data)=>{
		  			var domProgress = $("#progress").get(0)
			  		$("#progress").html(data)
				  		if(autoscrollMode){
				  			domProgress.scrollTop=domProgress.scrollHeight
				  		}
			  		})
			  	},1000)


				$('#autoscroll').change(function() {
				   autoscrollMode = $(this).is(":checked")
				});

</script>

<?php
	include_once("./dep/foot.php");
?>
