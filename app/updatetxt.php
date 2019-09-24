<?php

$locale='fr_FR.UTF-8';
setlocale(LC_ALL,$locale);
putenv('LC_ALL='.$locale);

//variable générale
$monfichier = file('crunch.conf');

//définition variable emplacement mkv
$mkvlongnom = trim ($monfichier[0]);
$mkv = substr($mkvlongnom, 8);

//définition variable emplacement mp4
$mp4longnom = trim ($monfichier[1]);
$mp4 = substr($mp4longnom, 8);

//définition variable suffixe 720p
$suff720plong = trim ($monfichier[8]);
$suff720p = substr($suff720plong, 11);

//définition variable suffixe 1080p

$suff1080plongnom = trim ($monfichier[9]);
$suff1080p = substr($suff1080plongnom, 12);

//définition variable suffixe sous titre

$suffsublongnom = trim ($monfichier[10]);
$suffsub = substr($suffsublongnom, 11);

//Telechargement 720p
if (isset($_POST['DL_720p']))
{
//remplacement du choix de la qualité dans le fichier .conf
$data = file('crunch.conf');

function replace_a_line($data) {
   if (stristr($data, 'qualite=')) {
   return $qualite="qualite=720p\n";
   }
   return $data;
}

$data = array_map('replace_a_line',$data);
file_put_contents('crunch.conf', implode('', $data));


$contenu = stripslashes(htmlentities($_POST['textarea']));
$fichierouvert = fopen ("lien.txt", "w+");
if ( !fwrite($fichierouvert, $contenu)) {
  echo "Impossible d'écrire dans le fichier ($filename)";
  exit;
}
fclose ($fichierouvert);
exec(__DIR__ ."/DL.sh 2>&1 >progress.txt &");
header('Location:'."index.php");

} elseif (isset($_POST['DL_1080p'])) { //Telechargement 1080p
   //remplacement du choix de la qualité dans le fichier .conf
   $data = file('crunch.conf');

   function replace_a_line($data) {
      if (stristr($data, 'qualite=')) {
         return $qualite="qualite=1080p\n";
      }

      return $data;
   }

   $data = array_map('replace_a_line',$data);
   file_put_contents('crunch.conf', implode('', $data));
   $contenu = stripslashes(htmlentities($_POST['textarea']));
   $fichierouvert = fopen ("lien.txt", "w+");

   if ( !fwrite($fichierouvert, $contenu)) {
      echo "Impossible d'écrire dans le fichier ($filename)";
      exit;
   }

   fclose ($fichierouvert);
   exec(__DIR__ ."/DL.sh 2>&1 >progress.txt &");
   header('Location:'."index.php");
} elseif (isset($_POST['DL_720p_1080p'])) { //Telechargement 720p et 1080p
   //remplacement du choix de la qualité dans le fichier .conf
   $data = file('crunch.conf');

   function replace_a_line($data) {
      if (stristr($data, 'qualite=')) {
      return $qualite="qualite=720p_1080p\n";
      }
      return $data;
   }

   $data = array_map('replace_a_line',$data);
   file_put_contents('crunch.conf', implode('', $data));
   $contenu = stripslashes(htmlentities($_POST['textarea']));
   $fichierouvert = fopen ("lien.txt", "w+");

   if ( !fwrite($fichierouvert, $contenu)) {
      echo "Impossible d'écrire dans le fichier ($filename)";
      exit;
   }

   fclose ($fichierouvert);
   exec(__DIR__ ."/DL.sh 2>&1 >progress.txt &");
   header('Location:'."index.php");
} elseif (isset($_POST['soustitreonly'])) { //Telechargement des sous-titres
   //remplacement du choix de la qualité dans le fichier .conf
   $data = file('crunch.conf');

   function replace_a_line($data) {
      if (stristr($data, 'qualite=')) {
         return $qualite="qualite=soustitre\n";
      }

      return $data;
   }

   $data = array_map('replace_a_line',$data);
   file_put_contents('crunch.conf', implode('', $data));
   $contenu = stripslashes(htmlentities($_POST['textarea']));
   $fichierouvert = fopen ("lien.txt", "w+");

   if ( !fwrite($fichierouvert, $contenu)) {
      echo "Impossible d'écrire dans le fichier ($filename)";
      exit;
   }

   fclose ($fichierouvert);
   exec(__DIR__ ."/DL.sh 2>&1 >progress.txt &");
   header('Location:'."index.php");
} elseif (isset($_POST['majYoutubeDL'])) { // Mise à jour de Youtube-dl
   echo exec("pip install --upgrade youtube_dl 2>&1 >progress.txt &");
   header('Location:'."index.php");
} elseif (isset($_POST['Supprimerfichiermkv'])) { //Supprimer les fichiers MKV
   echo exec("rm -r $mkv/*.mkv 2>&1",$output);
   header('Location:'."index.php");
} elseif (isset($_POST['Supprimerfichiermp4'])) { //Supprimer les fichiers mp4
   echo exec("rm -r $mp4/*.mp4 2>&1", $output);
   echo exec("rm -r $mp4/*.part 2>&1", $output);
   echo exec("rm -r $mp4/*.ass 2>&1", $output);
   header('Location:'."index.php");
} elseif (isset($_POST['Kill'])) { //Forcer la fermeture des processus
   shell_exec("ps -ef | grep DL | grep -v grep | awk '{print $1}' | xargs kill");
   shell_exec("ps -ef | grep youtube-dl | grep -v grep | awk '{print $1}' | xargs kill");
   shell_exec("ps -ef | grep ffmpeg | grep -v grep | awk '{print $1}' | xargs kill");
   shell_exec("ps -ef | grep mkvmerge | grep -v grep | awk '{print $1}' | xargs kill");

   header('Location:'."index.php");
} elseif (isset($_POST['save'])) {
   if ($_POST['save']=="saveit") {
      $data = file('crunch.conf'); // reads an array of lines

      function replace_a_line($data) {
         if (stristr($data, 'savemp4=')) {
            return "savemp4=1\n";
         }

         return $data;
      }

      $data = array_map('replace_a_line',$data);
      file_put_contents('crunch.conf', implode('', $data));
      header('Location:'."config.php");
   } else {
      $data = file('crunch.conf'); // reads an array of lines

      function replace_a_line($data) {
         if (stristr($data, 'savemp4=')) {
            return "savemp4=0\n";
         }

         return $data;
      }

      $data = array_map('replace_a_line',$data);
      file_put_contents('crunch.conf', implode('', $data));
      header('Location:'."config.php");
   }
} elseif (isset($_POST['config'])) {
   header('Location:'."config.php");
} elseif (isset($_POST['register'])) {
   $data = file('crunch.conf'); // reads an array of lines

   function replace_a_line($data) {
      if (stristr($data, 'typeconnec=')) {
         return "typeconnec=id\n";
      }

      return $data;
   }

   $data = array_map('replace_a_line',$data);
   file_put_contents('crunch.conf', implode('', $data));
   $data = file('crunch.conf'); // reads an array of lines

   function replace_a_line2($data) {
      if (stristr($data, 'identifiant=')) {
         return "identifiant=" . $_POST['id'] . "\n";
      }

      return $data;
   }

   $data = array_map('replace_a_line2',$data);
   file_put_contents('crunch.conf', implode('', $data));
   $data = file('crunch.conf'); // reads an array of lines

   function replace_a_line3($data) {
      if (stristr($data, 'motdepasse=')) {
         return "motdepasse=" . $_POST['pass'] . "\n";
      }

      return $data;
   }

   $data = array_map('replace_a_line3',$data);
   file_put_contents('crunch.conf', implode('', $data));
   header('Location:'."config.php");
} elseif (isset($_POST['envoicookies'])) {
   $data = file('crunch.conf'); // reads an array of lines

   function replace_a_line($data) {
      if (stristr($data, 'typeconnec=')) {
         return "typeconnec=cookie\n";
      }

      return $data;
   }

   $data = array_map('replace_a_line',$data);
   file_put_contents('crunch.conf', implode('', $data));
   header('Location:'."config.php");
} elseif (isset($_POST['accueil'])) {
   header('Location:'."/index.php");
} elseif (isset($_POST['validercommande'])) {
   // on est ici
   $data = file('crunch.conf'); // reads an array of lines

   function replace_a_line6($data) {
      if (stristr($data, 'commande=')) {
         return 'commande=" '.$_POST["commandes"]."\"\n" ;
      }

      return $data;
   }

   $data = array_map('replace_a_line6',$data);
   file_put_contents('crunch.conf', implode('', $data));

   // on est ici
   $data = file('crunch.conf'); // reads an array of lines

   function replace_a_line7($data) {
      if (stristr($data, 'suffixe720=')) {
         return 'suffixe720="'.$_POST["commandes720"]."\"\n" ;
      }

      return $data;
   }

   $data = array_map('replace_a_line7',$data);
   file_put_contents('crunch.conf', implode('', $data));

   // on est ici
   $data = file('crunch.conf'); // reads an array of lines

   function replace_a_line8($data) {
      if (stristr($data, 'suffixe1080=')) {
         return 'suffixe1080="'.$_POST["commandes1080"]."\"\n" ;
      }

      return $data;
   }

   $data = array_map('replace_a_line8',$data);
   file_put_contents('crunch.conf', implode('', $data));

   // on est ici
   $data = file('crunch.conf'); // reads an array of lines

   function replace_a_line9($data) {
      if (stristr($data, 'suffixesub=')) {
         return 'suffixesub="'.$_POST["commandessoustitre"]."\"\n" ;
      }

      return $data;
   }

   $data = array_map('replace_a_line9',$data);
   file_put_contents('crunch.conf', implode('', $data));

   // on est ici
   $data = file('crunch.conf'); // reads an array of lines

   function replace_a_line10($data) {
      if (stristr($data, 'MKV_DIR=')) {
         return 'MKV_DIR="'.$_POST["emplacementmkv"]."\"\n" ;
      }

      return $data;
   }

   $data = array_map('replace_a_line10',$data);
   file_put_contents('crunch.conf', implode('', $data));

   // on est ici
   $data = file('crunch.conf'); // reads an array of lines

   function replace_a_line11($data) {
      if (stristr($data, 'MP4_DIR=')) {
         return 'MP4_DIR="'.$_POST["emplacementmp4"]."\"\n" ;
      }

      return $data;
   }

   $data = array_map('replace_a_line11',$data);
   file_put_contents('crunch.conf', implode('', $data));

   header('Location:'."config.php");
} elseif (isset($_POST['vidercache'])) {
   fclose(ftruncate(fopen('progress.txt', 'r+'), 0));
   header('Location:'."index.php");
} elseif (isset($_POST['reset'])) {
   exec("cp ". __DIR__ . "/crunchbackup.conf " . __DIR__ . "/crunch.conf");
   header('Location:'."config.php");
}


function upload($index,$destination,$maxsize=FALSE,$extensions=FALSE)
{
   //Test1: fichier correctement uploadé
     if (!isset($_FILES[$index]) OR $_FILES[$index]['error'] > 0) return FALSE;
   //Test2: taille limite
     if ($maxsize !== FALSE AND $_FILES[$index]['size'] > $maxsize) return FALSE;
   //Test3: extension
     $ext = substr(strrchr($_FILES[$index]['name'],'.'),1);
     if ($extensions !== FALSE AND !in_array($ext,$extensions)) return FALSE;
   //Déplacement
     return move_uploaded_file($_FILES[$index]['tmp_name'],$destination);
}

//EXEMPLES
$upload1 = upload('cookies','cookies.txt',FALSE, FALSE );

if ($upload1) "Upload de l'icone réussi!<br />";
