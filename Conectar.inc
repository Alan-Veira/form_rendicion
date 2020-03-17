<?
//echo "hola mmmmmm"; exit();
session_start();
//echo "hola"; exit();
//$usu=$_SESSION["usu"];

$base_padron="osemm_padron";
$base_ppdev="osemm_ppdev";
$base_smadm="osemm_smadm";
$base_imagenes="osemm_imagenes";
$base_usuarios="osemm_usuarios";
$base_logs="osemm_logs";

/* Conexion a la base de datos */
$conexion = mysql_connect("localhost", "root", "");
mysql_select_db('prepaga', $conexion);

if (!$conexion) {
	echo "<CENTER>
			Problemas de conexion con la base de datosssssss.
		</CENTER>";
	exit();
}
   
error_reporting(0);   
   
foreach($_REQUEST as $var=>$value){
 $_GLOABLS[$var] = $value;
  $$var = $value;
  //echo "$var ----->  $value[0] **** $value[1] **** $value[2] *** $value[3]</br>";

}    
   
