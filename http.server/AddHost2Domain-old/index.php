<?
#
# Hay que meter alguna funcion que valida si ya esta dada de alta
#
function is_valid_ip_addr6($ip_addr6)
{
    return (preg_match("/^([a-z\d](-*[a-z\d])*)(\.([a-z\d](-*[a-z\d])*))*$/i", $ip_addr6) //valid chars check
            && preg_match("/^.{1,253}$/", $ip_addr6) //overall length check
            && preg_match("/^[^\.]{1,63}(\.[^\.]{1,63})*$/", $ip_addr6)   ); //length of each label
}
function is_valid_domain_name($domain_name)
{
    return (preg_match("/^([a-z\d](-*[a-z\d])*)(\.([a-z\d](-*[a-z\d])*))*$/i", $domain_name) //valid chars check
            && preg_match("/^.{1,253}$/", $domain_name) //overall length check
            && preg_match("/^[^\.]{1,63}(\.[^\.]{1,63})*$/", $domain_name)   ); //length of each label
}
error_reporting(E_ALL);
ini_set("display_errors", 1);
$num=0;
foreach($_REQUEST as $key => $val){
	$num++;
}
if ( $num != 1 ) { 
		echo "Cantidad total de Argumentos (debe ser 1): ".$num;
		exit;
		 }
if ( $val != "" )
	{
	echo "El valor debe ser null (es decir ?Hostt= ó simplemente ?Hostt): -->".$val."<--";
	exit;
	}
if ( ! is_valid_domain_name($key) ) {
		echo "Invalid HostName";
		exit;
	}
if (preg_match("/ns[0-9]/", $key)) {
				echo "Nooo-Nooo-puede-usarse-un-ns1-9";
				exit;
				}
date_default_timezone_set('UTC');
#echo "Uso: wget -O /dev/null http://AddHost2Domain.brin.pc2linux.com/?`hostname`";
#
#  El tema del $hoy es el Serial, si lo pones con minutos y segundos, se va de rango
#	PEro asi como esta queda como una vez por hora
#	Hay que validar que el $key NO tenga cosas raras solo validas para un hostname
#
$hoy = date("YmdH"); 
$ip_del_host = gethostbyaddr($_SERVER['REMOTE_ADDR']);
if (! filter_var($ip_del_host, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
    echo("$ip_del_host is not a valid IPv6 address");
	exit;
}
$porciones = explode(":", $ip_del_host);
$file="brin.pc2linux.com.zone";
$data=file_get_contents($file);
$data_array=explode("\n\r", $data);
$rest=substr($data,-6);
if (strcmp($rest, "Serial") !== 0) {
print_r($data);
}
$registro = $hoy."\t".$key."\tIN\tAAAA\t".$ip_del_host."\n";
$tempfile = 'brin.pc2linux.com.zone.temp';
file_put_contents($tempfile, $registro, FILE_APPEND | LOCK_EX);
ec
