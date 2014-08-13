#!/bin/sh
# Installer codet by Steekarlkani

if [[ -f $(which figlet 2>/dev/null) ]]; then
   clear
   figlet Installer startet
   sleep 5
   echo -e 'Geben sie denn Download Daemonpfad ein - Beispiel (http://tekbase.gti7.de/admin/ownmodules/teamspeakinstaller/daemon) - bei keiner Eingabe default'
   read a
   
   if [ "$a" = "" ]; then
        echo Downloade Daemon
        wget http://tekbase.gti7.de/admin/ownmodules/teamspeakinstaller/daemon
        sleep 5
        echo Daemon wurde gedownloadet, setze Rechte...
        chmod 0777 daemon
        sleep 5
        echo Daemon Rechte wurden gesetzt, verschiebe Daemon
        sleep 5
        mv daemon /home/skripte
        echo Daemon wurde verschoben, delete Installer.
        rm -r installer.sh
        clear
     else
		 echo Downloade Daemon
		 wget $a
         sleep 5
         echo Daemon wurde gedownloadet, setze Rechte...
         chmod 0777 daemon
         sleep 5
         echo Daemon Rechte wurden gesetzt, verschiebe Daemon
         sleep 5
         mv daemon /home/skripte
         echo Daemon wurde verschoben, delete Installer.
         rm -r installer.sh
         clear
     fi
 else
   clear
   echo Installiere Figlet
   apt-get install figlet -y
   figlet Installer startet
   sleep 5
   clear
   echo -e 'Geben sie denn Download Daemonpfad ein - Beispiel (http://tekbase.gti7.de/admin/ownmodules/teamspeakinstaller/daemon) - bei keiner Eingabe default'
   read a

      if [ "$a" = "" ]; then
        echo Downloade Daemon
        wget http://tekbase.gti7.de/admin/ownmodules/teamspeakinstaller/daemon
        sleep 5
        echo Daemon wurde gedownloadet, setze Rechte...
        chmod 0777 daemon
        sleep 5
        echo Daemon Rechte wurden gesetzt, verschiebe Daemon
        sleep 5
        mv daemon /home/skripte
        echo Daemon wurde verschoben, delete Installer.
        rm -r installer.sh
        clear
     else
		 echo Downloade Daemon
		 wget $a
         sleep 5
         echo Daemon wurde gedownloadet, setze Rechte...
         chmod 0777 daemon
         sleep 5
         echo Daemon Rechte wurden gesetzt, verschiebe Daemon
         sleep 5
         mv daemon /home/skripte
         echo Daemon wurde verschoben, delete Installer.
         rm -r installer.sh
         clear
     fi
fi
