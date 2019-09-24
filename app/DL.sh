#!/bin/bash

if [ ! -f crunch.conf ]; then
   cp crunchbackup.conf crunch.conf
fi

. crunch.conf

if [ $typeconnec = "id" ]; then
   AUTH=" -u $identifiant -p $motdepasse"
else
   AUTH=" --cookies cookies.txt"
fi

if [ $qualite = "soustitre" ]; then
   youtube-dl --retries 0 --skip-download --sub-format "ass" --sub-lang "frFR" --write-sub -a lien.txt --no-check-certificate -o "$MP4_DIR/%(title)s"$suffixesub".%(ext)s" $AUTH ;
   exit
fi

if [ $qualite = "720p" ] || [ $qualite = "720p_1080p" ]; then
   youtube-dl -f "[height="720"]" -o "$MP4_DIR/%(title)s"$suffixe720".%(ext)s" $AUTH $commande;
fi

if [ $qualite = "1080p" ] || [ $qualite = "720p_1080p"  ]; then
   youtube-dl -o "$MP4_DIR/%(title)s"$suffixe1080".%(ext)s" $AUTH $commande;
fi

for MP4 in "$MP4_DIR"/*.mp4 ; do
   NAME=$(basename "$MP4" .mp4)

   if [[ -r "$MP4_DIR/$NAME.frFR.ass" ]] ; then
      echo "Nom du sous titre trouvé $NAME (ASS)"
      mkvmerge -o "$MKV_DIR/$NAME.mkv" --language 1:jpn --track-name 1:"Japonais" --default-track 1:yes "$MP4" --language 0:fre --default-track 0:yes --track-name 0:"Français" --sub-charset 0:UTF-8 "$MP4_DIR/$NAME.frFR.ass" --title "[OTF] $NAME"

      if [ $savemp4 = "0" ]; then
         rm -r "$MP4"
         rm -r "$MP4_DIR/$NAME.frFR.ass";
      fi
   fi
done

for FLV in "$MP4_DIR"/*.flv ; do
   NAME=$(basename "$FLV" .flv)

   if [[ -r "$MP4_DIR/$NAME.frFR.ass" ]] ; then
      echo "Nom du sous titre trouvé $NAME (ASS)"
      mkvmerge -o "$MKV_DIR/$NAME.mkv" --language 1:jpn --track-name 1:"Japonais" --default-track 1:yes "$FLV" --language 0:fre --default-track 0:yes --track-name 0:"Français" --sub-charset 0:UTF-8 "$MP4_DIR/$NAME.frFR.ass" --title "[OTF] $NAME"

      if [ $savemp4 = "0" ]; then
         rm -r "$MP4"
         rm -r "$MP4_DIR/$NAME.frFR.ass";
      fi
   fi
done
