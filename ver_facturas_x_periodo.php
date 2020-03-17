<?
include 'Conectar.inc';

header("Content-type: text/html;charset=uft-8");
mysql_query("SET NAMES 'uft8'")

?>

<html>
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		
		<!-- Jquery -->
		<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
		
		<!-- Bootstrap -->
		<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
		
		<!-- Iconos -->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
		
		<!-- Databatables -->
		<link href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
		<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
		
		<!-- Estilos propios -->
		<link href="http://93.188.164.97/framework/bootstrap/css/estilo_estandar.css" rel="stylesheet">
		<script src="http://93.188.164.97/framework/bootstrap/css/estilo_estandar.js"></script>
	</head>
	<body>
		<div class="container-fluid">
			
			<div class="col-md-12">
				<div class="col-md-12">
					<div class="x_panel">
						<div class="tituloDiv">
							Facturas del periodo <b> <?=$periodo;?></b>
						</div>
						<div class="row">							
							<table id="tabListado" class="table" style="width: 90%;">
								<thead>
									<tr>
										<th>#</th>
										<th></th>
										<th>Clave rendicion</th>
										<th>Tipo archivo</th>
										<th>Periodo prestacion</th>
										<th>CUIL</th>
										<th>Practica</th>
										<th style='text-align: right;'>Importe solicitado</th>
										<th style='text-align: right;'>Importe subsidiado</th>
										<th>CUIT</th>
										<th>Factura</th>										
									</tr>
								</thead>
								<tbody>
									<?
										/*
										$sql="SELECT 	c.id as id_cap,
														p.cuil,
														pr.nom,
														pr.cuit,
														c.nrofac,
														p.monto1 imp_solicitado,
														p.monto2 AS imp_pagado,
														p.periodo2 AS per_prestacion,
														CONCAT(nn.codigo,' - ',nn.modulo) AS practica
														
														FROM prepaga.`pagos_subsidios` p
														JOIN prepaga.`sd_sss_devolucion` d ON p.cuil=d.cuil AND p.cod=d.practica AND p.periodo2=d.periodo 
														JOIN prepaga.nn_sd nn ON LPAD(d.practica,3,'000')=nn.codigo 
														JOIN prepaga.prestadores pr ON d.cuit=REPLACE(pr.cuit,'-','')
														JOIN prepaga.cap c ON c.pre=pr.cod 
																	AND ( CONCAT(LPAD(d.fct_sucursal,4,'0000'),'-',LPAD(d.fct_numero,8,'00000000'))=c.nrofac 
																		OR CONCAT(LPAD(d.fct_sucursal,5,'0000'),'-',LPAD(d.fct_numero,8,'00000000'))=c.nrofac )
																		
														JOIN prepaga.`subsidio_discapacidad` sd ON c.id=sd.id_cap
																	
														WHERE p.periodo=$periodo ";
										*/
										
										$sql="SELECT clave_rendicion,rnos,tipo_archivo,periodo_presentacion,periodo_prestacion,
														cuil,practica,imp_subsidiado,imp_solicitado,
														cuit,
														CONCAT(punto_venta,'-',n_comprobante) AS factura
														
													FROM prepaga.`sd_dr_envio` 
													WHERE id_lote=$id_lote ";
												
										$result = mysql_query($sql);
										$n=1 ;
										
										while($d=mysql_fetch_object($result)){
												
											echo "<tr>
													<td>$n</td>
													<td>
														<div class='btn-group btn-group-default' >						                    
															<button style='margin-left: 20%; margin-right: auto;' data-toggle='dropdown' class='btn btn-default dropdown-toggle' style='height: 34px;' type='button'>
																<i class='fa fa-ellipsis-v' aria-hidden='true'></i>
															</button>
															<ul class='dropdown-menu'>
																 <li>
																	<a href='form_periodo_rendicion.php?clave_rendicion=$d->clave_rendicion' target='_blank'>						                     		
																		Completar formulario de rendicion
																	</a>						                     	
																 </li>													                     		 
															</ul>
														</div>
													</td>
													<td>$d->clave_rendicion</td>
													<td>$d->tipo_archivo</td>
													<td>$d->periodo_prestacion</td>
													<td>$d->cuil</td>
													<td>$d->practica</td>																
													<td style='text-align: right;'>$d->imp_solicitado</td>
													<td style='text-align: right;'>$d->imp_subsidiado</td>
													<td style='text-align: center;'>$d->cuit</td>
													<td>$d->factura</td>
												  </tr>";	
											
											$n++;
											
										}
									
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>				
			</div>
		</div>
		<script>
			$(function(){
				$("#tabListado").dataTable({			    	
						"bPaginate": false,
						
						"bLengthChange": false,
						"bFilter": true,
						"bSort": true,
						"bInfo": false,
						
						"bAutoWidth": false,
						"language": {				    
						    "search": "Buscar",
						    "paginate": {
							      "previous": "Anterior",
							      "next": "Proximo"
							}
					    }
				});
			})
		</script>
	</body>
</html>