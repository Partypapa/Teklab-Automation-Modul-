#!/bin/sh
# Daemon codet by Steekarlkani

clear
echo Downloade-Daemon
wget http://tekbase.gti7.de/admin/ownmodules/teamspeakinstaller/daemon
sleep 5
echo Daemon wurde gedownloadet, setze Rechte...
chmod 0755 daemon
sleep 5
echo Daemon Rechte wurden gesetzt, verschiebe Daemon
sleep 5
mv daemon /home/skripte
echo Daemon wurde verschoben, delete Installer.
rm -r installer.sh