#!/bin/sh
BindFile="/var/named/brin.pc2linux.com.zone"
tempFile="/var/www/html/DNSupdate/temp.txt"
tempAAAAFile="/tmp/AAAA.txt"
tempSerialFile="/tmp/Serial.txt"
SerialActual=$(grep "Serial" $BindFile | awk '{print $1}')
echo "---- Serial Actual -----"
echo $SerialActual
echo "---- Registros para Agregar -----"
wget -O $tempFile addhost2domain.brin.pc2linux.com/brin.pc2linux.com.zone.temp
cat $tempFile | awk '$1>'$SerialActual'{print $2"\t"$3"\t"$4"\t"$5}' | sort | uniq > $tempAAAAFile
cat $tempAAAAFile
echo "---- Serial Nuevo -----"
cat $tempFile | awk '$1>'$SerialActual'{print $1}' | sort | uniq | tail -1 > $tempSerialFile
SerialNuevo=$(cat $tempSerialFile)
echo $SerialNuevo
cat $BindFile | sed "s/$SerialActual/$SerialNuevo/g" | grep -v AAAA > $BindFile.new
cat $BindFile $tempAAAAFile | grep AAAA >> $BindFile.new
echo "---- Si son mas de 4 lineas hay ,as diferenceia que el Serial ----"
diff $BindFile $BindFile.new
if [ $(diff $BindFile $BindFile.new | wc -l) -gt 4 ]; then
echo "Hay mas de 4 lineas - hacer update"
cp -p $BindFile.new $BindFile
/sbin/service named restart
mail -r Tektonic@pc2linux.com -s CambiosEnDNS-`hostname`-brin.pc2linux.com asampau@gmail.com < /var/named/brin.pc2linux.com.zone
else
echo "Es solo el Serial NO se hace update"
fi
