<?php 
    include_once("./dep/CONFIG.php");?><?php
	$lienCourant="crunchy";
	include_once("./dep/head.php");
	include_once("./dep/navbar.php"); 
	$monfichier = file('crunch.conf');
	?>
<br>
    <div class="container " role="main">
		<h2  style="margin-top : 70px;text-align:center">Type de connexion</h2>
</div >		
<center>
<form action="updatetxt.php" method="POST" name="form2">
	<?php 
 $typeconnec = trim ($monfichier[5]);
 ?>
<input type="radio" id="choix1" name="TypeUser" value="0" onclick="document.getElementById('formulary1').style.display='block'; document.getElementById('formulary2').style.display='none';" 
<?php if ( $typeconnec == "typeconnec=id" ) { 
 echo checked;
}
?> 
> Identifiants<br>

<input type="radio" id="choix2" name="TypeUser" value="1" onclick="document.getElementById('formulary1').style.display='none'; document.getElementById('formulary2').style.display='block';" 
<?php
if ( $typeconnec == "typeconnec=cookie" ) { 
 echo checked;
}?> 
> Cookies<br>
</form>




<DIV id="formulary1" style="display:none">
<form action="updatetxt.php" method="post">
<table width="460" border="1" bordercolor="#FFFFFF">
 <label for="icone">Vos Identifiants :</label><br />
<tr>
<td width="186"><center>Identifiants</center></td>
<td width="258"><label><input name="id" type="text" id="id" value="<?php 
 $mdp = trim ($monfichier[6]); 
echo substr($mdp, 12)
?>" >
</label></td></tr>
<br />
<tr>
<td width="186"><center>Mot de Passe</center></td>
<td width="258"><label><input name="pass" type="password" id="pass" value="<?php 
 $mdp = trim ($monfichier[7]); 
echo substr($mdp, 11)
?>" >
</label></td>
</tr>

</table>
<p>
	 <br />
<label>
<input type="submit" name="register" value="Valider" />
</label>
</p>
</form></DIV>

<DIV id="formulary2" style="display:none">
<form method="post" action="updatetxt.php" enctype="multipart/form-data">
     <label for="icone">Fichier Cookies :<br /> </label><br />
	 <br />
     <input type="file" name="cookies" /> <input type="submit" name="envoicookies" value="Envoyer" />
</form>
</DIV>


</center>

    <div class="container " role="main">
		<h2  style="margin-top : 70px;text-align:center">Garder les fichiers MP4?</h2>

<center>
<form action="updatetxt.php" method="POST" name="save">
<input type="radio" id="choix3" name="save" value="saveit" <?php 
 $mdp = trim ($monfichier[2]);
if ( $mdp == "savemp4=1" ) { 
 echo checked;
}
?> > Les Garder<br>

<input type="radio" id="choix4" name="save" value="deleteit" <?php 
 $mdp = trim ($monfichier[2]);
if ( $mdp == "savemp4=0" ) { 
 echo checked;
}
?> >Les Effacer sans remord<br><br>
<input type="submit" value="Valider">
</form>
</center>
 <center> 
 
 <form action="updatetxt.php" method="POST" name="commande">
 	<h2  style="margin-top : 70px;text-align:center">Commandes</h2>
<table width="1130" border="2" bordercolor="#FFFFFF">
	
		<tr>
			<td width="300"><center>Commande Générale :</center></td>
			<td width="700"><label><input type="text" size="100" name="commandes" value="<?php 
				$mdp = trim ($monfichier[4]); 
				echo substr($mdp, 11)
				?>" ></label></td>		
		</tr>
		<tr>

			<td width="300"><center>Suffixe noms de fichiers 720p :</center></td>
			<td width="700"><label><input type="text" size="10" name="commandes720" value="<?php 
				$mdp = trim ($monfichier[8]); 
				echo substr($mdp, 12)
				?>" ></label>
			</td>

		</tr>
		<tr>
			<td width="300"><center>Suffixe noms de fichiers 1080p :</center></td>		
			<td width="700"><label><input type="text" size="10" name="commandes1080" value="<?php 
				$mdp = trim ($monfichier[9]); 
				echo substr($mdp, 13)
				?>" ></label>
			</td>
		</tr>
		<tr>
			<td width="300"><center>Suffixe noms de fichiers Sous-Titres :</center></td>		
			<td width="700"><label><input type="text" size="10" name="commandessoustitre" value="<?php 
				$mdp = trim ($monfichier[10]); 
				echo substr($mdp, 12)
				?>" ></label>
			</td>
		</tr>
		<tr>
			<td width="300"><center>Emplacement fichiers mkv :</center></td>		
			<td width="700"><label><input type="text" size="30" name="emplacementmkv" value="<?php 
				$mdp = trim ($monfichier[0]); 
				echo substr($mdp, 9)
				?>" ></label>
			</td>
		</tr>
		<tr>
			<td width="300"><center>Emplacement fichiers mp4 et Sous-Titres:</center></td>		
			<td width="700"><label><input type="text" size="30" name="emplacementmp4" value="<?php 
				$mdp = trim ($monfichier[1]); 
				echo substr($mdp, 9)
				?>" ></label>
			</td>
		</tr>
</table>
  <input type="submit" value="Valider" name="validercommande">
</form>
</center>



<br/><br/><br/>

<div class="row"  style="margin-top:1rem">
	<div class="col-sm-4 col-sm-offset-4" style="padding:0.1rem">
		<input type="button" name="accueil" value="Page d'accueil" 
			class=" btn btn-success" style="width:100%" onclick="location.href='./index.php';" >	
	</div>
</div>

<br><br>
 <form action="updatetxt.php" method="POST" name="fonctionreset">
<div class="row"  style="margin-top:1rem">
	<div class="col-sm-4 col-sm-offset-4" style="padding:0.1rem">
		<input type="submit" name="reset" value="Réinitialisation des paramètres" 
			class=" btn btn-danger" style="width:100%">	
	</div>
</div>
</form>


<script>
	if('<?= $typeconnec?>'=="typeconnec=cookie"){
		document.getElementById('formulary1').style.display='none'; 
		document.getElementById('formulary2').style.display='block';
	}
	if('<?= $typeconnec?>'=="typeconnec=id"){
		document.getElementById('formulary1').style.display='block'; 
		document.getElementById('formulary2').style.display='none';
	}
	
</script>

<?php
	include_once("/dep/foot.php");
?>
