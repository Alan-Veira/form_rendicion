<?
include 'Conectar.inc';

if(isset($_POST['submit'])){
	
	switch ($accion) {
		
		case 'insertar':
				
				$insert = "INSERT INTO prepaga.sd_rendicion_devolucion ( clave_rendicion, ord_pago_1, ord_pago_2, fec_trans_1, fec_trans_2, cheque, 
																	importe_transferido, ret_ganancias, ret_iibb, otras_retenciones, 
																	imp_aplicado_sss, imp_propios_ing, imp_propios_otra_cuenta,
																	nro_recibo, imp_trasladado, imp_devuelto_cuenta_sss, saldo_no_aplicado, 
																	observaciones )
								
							VALUES ($clave_rendicion, '$ord_pago_1', '$ord_pago_2', '$fec_trans_1', '$fec_trans_2', '$cheque', 
												'$importe_transferido', '$ret_ganancias', '$ret_iibb', '$otras_retenciones', 
												'$imp_aplicado_sss', '$imp_propios_ing', '$imp_propios_otra_cuenta',
												'$nro_recibo', '$imp_trasladado', '$imp_devuelto_cuenta_sss', '$saldo_no_aplicado', 
												'$observaciones' )";
												
				//echo $insert; exit();
				mysql_query($insert) or die(mysql_error().$insert);
				
			break;
		
		case 'modificar':
				
				$update = "UPDATE sd_rendicion_devolucion
		
								SET ord_pago_1='$ord_pago_1', ord_pago_2='$ord_pago_2', 
									fec_trans_1='$fec_trans_1', fec_trans_2='$fec_trans_2', 
									cheque='$cheque', importe_transferido='$importe_transferido', 
									ret_ganancias='$ret_ganancias', ret_iibb='$ret_iibb', otras_retenciones='$otras_retenciones', 
									imp_aplicado_sss='$imp_aplicado_sss', imp_propios_ing='$imp_propios_ing', imp_propios_otra_cuenta='$imp_propios_otra_cuenta',
									nro_recibo='$nro_recibo', 
									imp_trasladado='$imp_trasladado', imp_devuelto_cuenta_sss='$imp_devuelto_cuenta_sss', 
									saldo_no_aplicado='$saldo_no_aplicado', 
									observaciones='$observaciones'
									
								WHERE clave_rendicion = $clave_rendicion";
								
								
				//echo $update; exit();				
				mysql_query($update) or die(mysql_error().$update);
				
				
			break;
		
		default:
			
			break;
	}
		
}


?>

<html>
	<head>
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
			<!-- -->
			<div class="col-md-12">
				<div class="col-md-12">
					<div class="x_panel">
						<div class="tituloDiv">
							Formulario de carga de rendicion para facturas subsidiadas por la SSS
						</div>
						<div class="row">
							<div style="margin: 15px;">
								<form method="post">
									
																		
									<?
									
										$query = "SELECT ren.*, dre.`imp_solicitado`,dre.`imp_subsidiado`
													FROM prepaga.`sd_rendicion_devolucion` ren
													JOIN sd_dr_envio dre ON ren.`clave_rendicion`= dre.`clave_rendicion`
													WHERE ren.clave_rendicion=$clave_rendicion";
										//echo "$query";
										$result = mysql_query($query) or die(mysql_error().$query);
										
										$existe = mysql_num_rows($result);
										
										if($existe==0){
											
											$accion = "insertar";
											
											$v_imp_subsidiado=0;
											$v_imp_solicitado=0;
											$v_ord_pago_1=0 ;
											$v_ord_pago_2=0 ;
											$v_fec_trans_1="";
											$v_fec_trans_2="";
											$v_cheque=0; 
											$v_importe_transferido=0; 
											$v_ret_ganancias=0; 
											$v_ret_iibb=0; 
											$v_otras_retenciones=0; 
											$v_imp_aplicado_sss=0; 
											$v_imp_propios_ing=0; 
											$v_imp_propios_otra_cuenta=0;
											$v_nro_recibo=0; 
											$v_imp_trasladado=0;
											$v_imp_devuelto_cuenta_sss=0; 
											$v_saldo_no_aplicado=0; 
											$v_observaciones="";
										}
										else{
												
											$accion = "modificar";
											
											$d = mysql_fetch_object($result);
											
											$v_ord_pago_1 = $d->ord_pago_1 ;
											$v_ord_pago_2 = $d->ord_pago_2 ;
											$v_fec_trans_1 = $d->fec_trans_1 ;
											$v_fec_trans_2 = $d->fec_trans_2 ;
											$v_cheque = $d->cheque ; 
											$v_importe_transferido = $d->importe_transferido ; 
											$v_ret_ganancias = $d->ret_ganancias ; 
											$v_ret_iibb = $d->ret_iibb ; 
											$v_otras_retenciones = $d->otras_retenciones ; 
											$v_imp_aplicado_sss = $d->imp_aplicado_sss ; 
											$v_imp_propios_ing = $d->imp_propios_ing ; 
											$v_imp_propios_otra_cuenta = $d->imp_propios_otra_cuenta ;
											$v_nro_recibo = $d->nro_recibo ; 
											$v_imp_trasladado = $d->imp_trasladado ;
											$v_imp_devuelto_cuenta_sss = $d->imp_devuelto_cuenta_sss ; 
											$v_saldo_no_aplicado = $d->saldo_no_aplicado ; 
											$v_observaciones = $d->observaciones ;
											$v_imp_solicitado = $d->imp_solicitado;
											$v_imp_subsidiado = $d->imp_subsidiado;
										}
									?>									
									<!-- -->
									<input type="hidden" name="clave_rendicion" id="clave_rendicion" value="<?=$clave_rendicion;?>" />
									<input type="hidden" name="accion" value="<?=$accion;?>" />
									<!-- -->
									<table class="table" style="max-width: 1100px;">
										<tr>
											<th>Importe Solicitado</th>
											<td>
												<input readonly name="importe_solicitado" id="importe_solicitado" type="number" step="0.01" value="<?=$v_imp_solicitado;?>" />
											</td>
											<th>Importe Subsidiado</th>
											<td>
												<input readonly name="importe_subsidiado" id="importe_subsidiado" type="number" step="0.01" value="<?=$v_imp_subsidiado;?>" />
											</td>
										</tr>
										<tr>
											<th>Orden de pago 1</th>
											<td>
												<input name="ord_pago_1" type="text" value="<?=$v_ord_pago_1;?>" />
											</td>
											<th>Orden de pago 2</th>
											<td>
												<input name="ord_pago_2" type="text" value="<?=$v_ord_pago_2;?>" />
											</td>
										</tr>
										
										<tr>
											<th>Fecha transferencia 1</th>
											<td>
												<input name="fec_trans_1" type="date" value="<?=$v_fec_trans_1;?>" />
											</td>
											<th>Fecha transferencia 2</th>
											<td>
												<input name="fec_trans_2" type="date" value="<?=$v_fec_trans_2;?>" />
											</td>
										</tr>
										
										<tr>
											<th>Cheque</th>
											<td>
												<input name="cheque" type="number" value="<?=$v_cheque;?>" />
											</td>
											<th>Importe transferido</th>
											<td>
												<div class='aplicado'>
												<input name="importe_transferido" id="importe_transferido" type="number" step="0.01" value="<?=$v_importe_transferido;?>" />
												</div>
											</td>
										</tr>
										
										<tr>
											<th>Retencion Ganancias</th>
											<td>
												<div class='aplicado'>     
													<input name="ret_ganancias" id="ret_ganancias" type="number" step="0.01" value="<?=$v_ret_ganancias;?>" />
												</div>
												
											</td>
											<th>Retencion IIBB</th>
											<td>
												<div class='aplicado'>
												<input name="ret_iibb" id="ret_iibb" type="number" step="0.01" value="<?=$v_ret_iibb;?>" />
												</div>
											</td>
										</tr>
										<tr>
											<th>Otras retenciones</th>
											<td>
												<div class='aplicado'>
												<input name="otras_retenciones" id="otras_retenciones" type="number" step="0.01" value="<?=$v_otras_retenciones;?>" />
												</div>
											</td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<th>Importe aplicado SSS</th>
											<td>
												<div class='imp_sss'>
													<input name="imp_aplicado_sss" id="imp_aplicado_sss" type="number" step="0.01" value="<?=$v_imp_aplicado_sss;?>" />
												</div>								
											</td>
											<th>Importe propio OS</th>
											<td>
												<input name="imp_propios_ing" type="number" step="0.01" value="<?=$v_imp_propios_ing;?>" />
											</td>
										</tr>
										<tr>
											<th>Importe propio otra cuenta </th>
											<td>
												<input name="imp_propios_otra_cuenta" id="imp_propios_otra_cuenta" type="number" step="0.01" value="<?=$v_imp_propios_otra_cuenta;?>" />
											</td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<th>Recibo</th>
											<td>
												<input name="nro_recibo" type="number" value="<?=$v_nro_recibo;?>" />
											</td>
										</tr>
										<tr>
											<th>Importe trasladado</th>
											<td>
												<input name="imp_trasladado" type="number" id="imp_trasladado" step="0.01" value="<?=$v_imp_trasladado;?>" />
											</td>
											<th>Importe devuelto cuenta SSS</th>
											<td>
												<input name="imp_devuelto_cuenta_sss" type="number" id="imp_devuelto_cuenta_sss" step="0.01" value="<?=$v_imp_devuelto_cuenta_sss;?>" />
											</td>
										</tr>
										<tr>
											<th>Saldo no aplicado</th>
											<td>
												<input name="saldo_no_aplicado" type="number" id="saldo_no_aplicado" step="0.01" value="<?=$v_saldo_no_aplicado;?>" />
											</td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<th>Observaciones</th>
											<td>
												<textarea name="observaciones" class="form-control"><?=$v_observaciones;?></textarea>
											</td>
										</tr>
										
									</table>
									
									<input type="submit" name="submit" value = "Procesar" style="display: none;">
									<?
										if($accion=="insert"){
											$btn_class="btn-success";
										}
										else{
											$btn_class="btn-danger";
										}
									?>
									<a id="btnEnviar" class="btn <?=$btn_class;?>"  onclick="javascript:return confirm('¿Confirma?')">
										<span id="spanEnviar"></span> Grabar 
									</a>
								
								</form>
							</div>							
						</div>
					</div>
				</div>				
			</div>
		</div>
		<script>
			$(function(){
				
				$('#btnEnviar').on('click',function(){
					
					var total2 = $('#imp_aplicado_sss').val()*1 + $("#imp_propios_otra_cuenta").val()*1 + $("#imp_trasladado").val()*1 + $("#imp_devuelto_cuenta_sss").val()*1 + $("#saldo_no_aplicado").val()*1;
					console.log(total2);
					if (total2!= $("#importe_solicitado").val()*1) {
						
						alert("El importe solicitado " +$('#imp_aplicado_sss').val()*1 + "es diferente a la suma de "+total2 )
						return false;						
						 
					}else{
						
						 alert("El importe solicitado es IGUAL")
						 $(this).attr('disabled','disabled');
							$('#btnEnviar').html('');					
							$('#btnEnviar').html('<i class="fas fa-sync-alt fa-spin"></i> Procesando');
							$('input[name=submit]').click();
							
					}
					/*
					var imp_sss = 0;
					$(".imp_sss input").each(function(){
						imp_sss += parseFloat($(this).val());
					});
				    var a = 0;
				    $(".aplicado input").each(function() {
				        a += parseFloat($(this).val());
				        
				    });
				    console.log(a);
				    console.log(imp_sss);
				    
					if (a==imp_sss){
						$(this).attr('disabled','disabled');
						$('#btnEnviar').html('');					
						$('#btnEnviar').html('<i class="fas fa-sync-alt fa-spin"></i> Procesando');
						$('input[name=submit]').click();						
					}else{
						alert("El Importe aplicado de SSS debe ser igual a la suma de Importe Transferido, Ret. Ganancias, Ret. IIBB, Otras Retenciones")
					}
              		*/
              		
					
				})
				
				$('#imp_aplicado_sss').on('blur',function(){

				var total = $('#importe_transferido').val()*1 + $('#ret_ganancias').val()*1 + $('#ret_iibb').val()*1 + $('#otras_retenciones').val()*1 ;				
				console.log(total);				
				if(total!=$('#imp_aplicado_sss').val()*1){				
				console.log("es diferente total:"+total+" imp_aplicado_sss "+$('#imp_aplicado_sss').val()*1)
				}
				else{				
				console.log("es IGUAL")
				}				
				})  
				
				
				
				
				
			})
		</script>
	</body>
</html>