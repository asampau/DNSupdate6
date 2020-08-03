<?
#
# Hay que meter alguna funcion que valida si ya esta dada de alta
#
function is_valid_domain_name($domain_name)
{
    return (preg_match("/^([a-z\d](-*[a-z\d])*)(\.([a-z\d](-*[a-z\d])*))*$/i", $domain_name) //valid chars check
            && preg_match("/^.{1,253}$/", $domain_name) //overall length check
            && preg_match("/^[^\.]{1,63}(\.[^\.]{1,63})*$/", $domain_name)   ); //length of each label
}
$num=0;
echo '<pre>';
print_r($_REQUEST);
foreach($_REQUEST as $key => $val){
        echo $key."\t".$num."<br>";
	$num++;
}
echo '</pre>';
if ( $num != 1 ) { 
		echo "Cantidad total de Argumentos (debe ser 1): ".$num;
		exit;
		 }
echo "Continuando...<br>".count_chars($val);
if ( $val != "" )
	{
	echo "El valor debe ser null (es decir ?Hostt= ó simplemente ?Hostt): -->".$val."<--";
	exit;
	}
echo "Continuando...<br>";
echo "<br>";
if ( is_valid_domain_name($key) ) {
				echo "Ok---".$key."----Ko";
				} else 
		{
		echo "Invalid HostName";
		exit;
	}
error_reporting(E_ALL);
ini_set("display_errors", 1);
if (preg_match("/ns[0-9]/", $key)) {
				echo "Nooo-Nooo-puede-usarse-un-ns1-9";
				exit;
				}
date_default_timezone_set('UTC');
echo '<pre>';
#echo "Uso: wget -O /dev/null http://tektonic-cloud6.pc2linux.com/DNSupdate/update.php?`hostname`";
#echo "Uso: wget -O /dev/null http://dnsupdate6.pc2linux.com/?`hostname`";
echo "Uso: wget -O /dev/null http://AddHost2Domain.brin.pc2linux.com/?`hostname`";
echo '</pre>';
#
#  El tema del $hoy es el Serial, si lo pones con minutos y segundos, se va de rango
#	PEro asi como esta queda como una vez por hora
#	Hay que validar que el $key NO tenga cosas raras solo validas para un hostname
#
$hoy = date("YmdH"); 
$ip_del_host = gethostbyaddr($_SERVER['REMOTE_ADDR']);

# fopen recorrer linea x linea ...
echo $ip_del_host;
$porciones = explode(":", $ip_del_host);
#echo $porciones[0]; // porción1
echo $porciones[1]; // porción2
echo '<pre>';
echo "\t".$hoy."\t;Serial";
echo '</pre>';
# DNS zone File = /var/named/brin.pc2linux.com.zone
$file="brin.pc2linux.com.zone";
$data=file_get_contents($file);
$data_array=explode("\n\r", $data);
echo '<pre>';
$rest=substr($data,-6);
echo $rest;
if (strcmp($rest, "Serial") !== 0) {
print_r($data);
}
echo $key."\tIN\tAAAA\t".$ip_del_host;
echo '</pre>';
$registro = $hoy."\t".$key."\tIN\tAAAA\t".$ip_del_host."\n";
$tempfile = 'brin.pc2linux.com.zone.temp';
file_put_contents($tempfile, $registro, FILE_APPEND | LOCK_EX);
echo "Listo el hostname es ".$key.".brin.pc2linux.com"
?>

