<?php

// *************************************************************************************************************
// Remise en banque d�pot bancaire depuis la caisse
// *************************************************************************************************************

// Variables n�cessaires � l"affichage
$page_variables = array ();
check_page_variables ($page_variables);

// *************************************************************************************************************
// AFFICHAGE
// *************************************************************************************************************

?>
<script type="text/javascript">

array_menu_v_prelev	=	new Array();
array_menu_v_prelev[0] 	=	new Array('depot_banque', 'chemin_etape_0');
array_menu_v_prelev[1] 	=	new Array('depot_cheques', 'chemin_etape_1');
array_menu_v_prelev[2] 	=	new Array('depot_validation', 'chemin_etape_2');

</script>
<div class="emarge"><br />

<iframe frameborder="0" scrolling="no" src="about:_blank" id="edition_reglement_iframe" class="edition_reglement_iframe" style="display:none"></iframe>
<div id="edition_reglement" class="edition_reglement" style="display:none">
</div>

<div class="titre" style="width:60%; padding-left:140px">Mise en banque Traites
</div>


<div class="emarge" style="text-align:right" >
<div  id="corps_gestion_caisses">
<table width="950px" height="350px" border="0" align="right" cellpadding="0" cellspacing="0" >
	<tr>
	<td rowspan="2" style="width:50px; height:50px; background-color:#FFFFFF">
		<div style="position:relative; top:-35px; left:-35px; width:105px; border:1px solid #999999; background-color:#FFFFFF; text-align:center">
		<img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/ico_caisse.jpg" />				</div>
		<span style="width:35px">
		<img src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/blank.gif" width="50px" height="20px" id="imgsizeform"/>				</span>			
	</td>
	<td colspan="2" style="width:85%; background-color:#FFFFFF" >
	
	<br />
	<br />
	<br />
		
	<form action="compta_depot_bancaire_traite_create.php" target="formFrame" method="post" name="depot_create" id="depot_create">
	<div >
		<input id="id_compte_caisse" name="id_compte_caisse"  value="<?php echo $compte_caisse->getId_compte_caisse(); ?>"  type="hidden">
		<input id="type_remise" name="type_remise"  value="Traite"  type="hidden">
		
		<table class="chemin_table" border="0"  cellspacing="0">
			<tr>
				<td style="width:6%">&nbsp;</td>
				<td class="chemin_numero_choisi" style="width:2%" id="chemin_etape_0_2">1</td>
				<td style="width:6%" class="chemin_fleche_grisse">&nbsp;</td>
				<td style="width:6%" class="chemin_fleche_grisse">&nbsp;</td>
				<td class="chemin_numero_gris" style="width:2%" id="chemin_etape_1_2">2</td>
				<td style="width:6%" class="chemin_fleche_grisse" >&nbsp;</td>
				<td style="width:6%" class="chemin_fleche_grisse" >&nbsp;</td>
				<td class="chemin_numero_gris" style="width:2%" id="chemin_etape_2_2">3</td>
				<td style="width:6%"  >&nbsp;</td>
				<td style="width:2%">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="3" class="chemin_texte_choisi" style="width:14%" id="chemin_etape_0_3">Banque</td>
                                <td colspan="3" class="chemin_texte_gris" style="width:14%" id="chemin_etape_1_3">Traites</td>
				<td colspan="3" class="chemin_texte_gris" style="width:14%" id="chemin_etape_2_3">Validation</td>
				<td style="width:2%"></td>
				</tr>
		</table>
		<br />
	</div>
	
	
	
	<div  id="depot_cheques"  style="width:100%; display:none; background-color:#FFFFFF ">
		<table width="100%" cellpadding="0" cellspacing="0" border="0">
		<tr>
			<td style=" font-weight:bolder; color:#97bf0d;">
			</td>
			<td style="text-align:right">
			
			<div id="bt_etape_2" style=" cursor:pointer; font-weight:bolder; color:#97bf0d;" >
				<span style="padding-right:80px">&gt;&gt;&gt; Etape suivante</span> 
			</div>
			</td>
		</tr>
		<tr>
			<td  colspan="2"><br />
			<span class="controle_sub_title">TRAITES </span><br /><br />
			<div style="width:95%;">
			
			Le <?php 
					setlocale(LC_TIME, $INFO_LOCALE);
					echo lmb_strftime("%d %B %Y", $INFO_LOCALE, strtotime(date("d M Y")))." ".date("h:i") ;
				?><br />
			<br />
			<div  class="line_caisse_bottom"></div>
	
	
			
			</div>
			</td>
		</tr>
		<tr >
			<td colspan="2">
			<br />
				<div>
					<span style="width:120px; float:left">Solde Th�orique</span>
					<span style="width:40px; float:left ">&gt;&gt;&gt;</span> 
					<span id="toto_chq_theorique2" style="text-align:right; width:65px; float:left">
					<?php
					$montant_especes = 0;
					if (isset($totaux_theoriques[$LC_E_ID_REGMT_MODE])) {
						echo number_format($totaux_theoriques[$LC_E_ID_REGMT_MODE], $TARIFS_NB_DECIMALES, ".", ""	);
					} else {
						echo "0.00";
					}
					?>
					</span> 
					<?php
						echo "&nbsp;". $MONNAIE[1];
					?> <span style="padding-left:10px">(<?php
					if (isset($count_chq_theoriques)) {
						echo count($count_chq_theoriques);
					} 
					?> traite(s))</span>
				</div>
	
			
		
		
		</td>
		</tr>
		<tr>
		<td colspan="52" style="text-align:left"><br />
			<br />
		<div style=" width:690px;">
			<table width="100%">
				<tr>
				<td style="width:55px">&nbsp;	
				</td>
				<td style="width:75px; text-align:center">Montant
				</td>
				<td style="width:75px; text-align:center">Compte source
				</td>
				<td style="width:75px; text-align:center">Date de traite
				</td>
				</tr>
			</table>
		<?php
		for ($j = 0 ; $j <count($count_chq_theoriques) ; $j++ ) {
			?>
			<div id="ligne_exist_chq_<?php echo $j;?>">
				<table width="100%">
				<td style="width:55px">
				<div ><?php echo $j+1;?>:</div>
				</td>
				<td style="width:75px; text-align:right; padding-right:5px">
				<input name="EXIST_CHQ_<?php echo $j;?>" type="hidden" id="EXIST_CHQ_<?php echo $j;?>" value="<?php echo $count_chq_theoriques[$j]->montant_contenu;?>" />
				<span id="view_info_reg_<?php echo $count_chq_theoriques[$j]->infos_supp;?>" <?php if (trim($count_chq_theoriques[$j]->infos_supp)) {?> style="cursor:pointer"<?php }?>><?php echo number_format($count_chq_theoriques[$j]->montant_contenu, $TARIFS_NB_DECIMALES, ".", ""	)?> </span>
				
				<?php 
				unset ($reglements_infos);
				if (trim($count_chq_theoriques[$j]->infos_supp)) {
						$reglement = new reglement (trim($count_chq_theoriques[$j]->infos_supp));
						if (is_object($reglement) && $reglement->getId_reglement_mode()) {
					?>
					<script type="text/javascript">
							Event.observe("view_info_reg_<?php echo $count_chq_theoriques[$j]->infos_supp;?>", "click",  function(evt){Event.stop(evt);
								page.traitecontent('compta_reglements_edition','compta_reglements_edition.php?ref_reglement=<?php echo $count_chq_theoriques[$j]->infos_supp;?>','true','edition_reglement');
								$("edition_reglement").show();
								$("edition_reglement_iframe").show();
							}, false);
					</script>
					<?php
							$reglements_infos = get_infos_reglement_type ($reglement->getId_reglement_mode(), $reglement->getRef_reglement());
						}
				}
				?>
				<?php echo "&nbsp;". $MONNAIE[1];?> 
				<input name="CHK_EXIST_CHQ_<?php echo $j;?>" type="checkbox" id="CHK_EXIST_CHQ_<?php echo $j;?>" value="<?php echo $count_chq_theoriques[$j]->montant_contenu;?>" />
				<script type="text/javascript">
					Event.observe($("CHK_EXIST_CHQ_<?php echo $j;?>"), "click", function(evt){
						calcul_prelev_banque ();
					}
					);
				</script>
				</td>
				<td style="width:75px">
				<?php
				$compte = new compte_bancaire($reglements_infos->id_compte_bancaire_source);
				$nom = $compte->getLib_compte ();
				echo $nom;
				?>
				</td>		
		
				<input name="REF_EXIST_CHQ_<?php echo $j;?>" type="hidden" id="REF_EXIST_CHQ_<?php echo $j;?>" value="<?php echo trim($count_chq_theoriques[$j]->infos_supp);?>" />
				</td>
				<td style="width:75px; text-align:center">
				<center><?php if (trim($count_chq_theoriques[$j]->infos_supp) && isset($reglement) && is_object($reglement)&& isset($reglements_infos)) { echo date_Us_to_Fr($reglement->getDate_echeance());}?></center>
				</td>
				</tr>
				</table>
				<div style="height:5px"></div>
			</div>
			<?php
		}
		?>
		<span style="float:right">
			<a href="#" id="all_coche_chq" class="doc_link_simple">Cocher</a> / 
			<a href="#" id="all_decoche_chq" class="doc_link_simple">D&eacute;cocher</a> / 
			<a href="#" id="all_inv_coche_chq" class="doc_link_simple">Inverser</a>
			</span><br />

			<script type="text/javascript">
			
			Event.observe("all_coche_chq", "click", function(evt){
				Event.stop(evt); 
				coche_line_gest_caisse ("coche", "CHQ", parseFloat($("indentation_exist_cheques").value));
				calcul_prelev_banque ();
			});
			Event.observe("all_decoche_chq", "click", function(evt){
				Event.stop(evt); 
				coche_line_gest_caisse ("decoche", "CHQ", parseFloat($("indentation_exist_cheques").value));
				calcul_prelev_banque ();
			});
			Event.observe("all_inv_coche_chq", "click", function(evt){
				Event.stop(evt); 
				coche_line_gest_caisse ("inv_coche", "CHQ", parseFloat($("indentation_exist_cheques").value));
				calcul_prelev_banque ();
			});
			</script>
		<?php
		$indentation_controle_cheques = 0; 
		for ($i=0; $i<=$indentation_controle_cheques ; $i++) {
			?>
			<div id="ligne_chq_<?php echo $i;?>">
				<table width="100%">
				<td style="width:55px">
			<div>&nbsp;</div>
				</td>
				</tr>
				</table>
			<div style="height:5px"></div>
			</div>
			<?php
			
		}
		?>
			
		<input name="indentation_exist_cheques" type="hidden" id="indentation_exist_cheques" value="<?php echo (count($count_chq_theoriques) - 1);?>"/>
		<input name="indentation_controle_cheques" type="hidden" id="indentation_controle_cheques" value="<?php echo $indentation_controle_cheques;?>"/>
		
			<div style="width:690px;text-align:left; " class="controle_color_toto">
				<div style="width:40px; float:left; height:25px; line-height:25px; padding-left:5px; font-weight:bolder">Total: </div>
			<div style="  height:25px; line-height:25px; padding-left:155px" class="controle_color_toto"><span id="TT_CHQ">0.00</span> <?php echo "&nbsp;". $MONNAIE[1];?></div>
			</div>
			
			<div style="height:25px">
			</div>
		</div>	
		</td>
		</tr>
		</table>
	</div>
	
	
	<div id="depot_banque"  style=" width:100%; background-color:#FFFFFF">
	
	
		<table width="100%" cellpadding="0" cellspacing="0" border="0">
		<tr>
			<td style=" font-weight:bolder; color:#97bf0d;">
			</td>
			<td style="text-align:right">
			
			<div id="bt_etape_0" style=" cursor:pointer; font-weight:bolder; color:#97bf0d;" >
				<span style="padding-right:80px">&gt;&gt;&gt; Etape suivante</span> 
			</div>
			</td>
		</tr>
		<tr>
			<td colspan="2">
			<br />
			<span class="controle_sub_title">BANQUE </span><br /><br />
			<div style="width:95%;">
			Le <?php 
					setlocale(LC_TIME, $INFO_LOCALE);
					echo lmb_strftime("%d %B %Y", $INFO_LOCALE, strtotime(date("d M Y")))." ".date("h:i") ;
					?><br />
			<br />
			<div  class="line_caisse_bottom"></div>
	
	
			
			</div>
			<br /><br />
					

			<span style="width:250px; float:left">
			Num�ro de remise:</span>
			<input type="text" class="classinput_nsize" value="" id="num_remise" name="num_remise" />
			<br /><br />
					
			<span style="width:250px; float:left">
			Choix du compte bancaire de destination:</span>
			<select id="id_compte_bancaire_destination" name="id_compte_bancaire_destination">
			<?php 
			foreach ($comptes_bancaires as $compte_b) {
				?>
				<option value="<?php echo $compte_b->id_compte_bancaire;?>"><?php echo $compte_b->lib_compte;?></option>
				<?php
			}
			?>
			</select>
			</div>
		
		
		</td>
		</tr>
		</table>
	</div>
	
	<div  id="depot_validation"  style="width:100%; display:none; background-color: #FFFFFF">
	<table width="100%" cellpadding="0" cellspacing="0" border="0">
		<tr>
			<td style=" font-weight:bolder; color:#97bf0d;">
			</td>
			<td style="text-align:right">
			
			</td>
		</tr>
		<tr>
			<td colspan="2">
		<div class="emarge"><br />
			<span class="controle_sub_title">Validation </span><br /><br />
			<div style="width:95%;">
			Le <?php 
					setlocale(LC_TIME, $INFO_LOCALE);
					echo lmb_strftime("%d %B %Y", $INFO_LOCALE, strtotime(date("d M Y")))." ".date("h:i") ;
					?><br />
			<br />
			<div  class="line_caisse_bottom"></div>
	
	
			
			</div>
			<br />
			Traites
			</span>
			<br />
			<br />
			<table width="780" border="0" cellspacing="0" cellpadding="0">

				<tr>
					<td height="35" valign="middle" class="line_compta_bottom_rigth">
                                            <div style="width:235px; height:35px; line-height:35px;">Traite(s) s&eacute;lection&eacute;(s)</div>		</td>
					<td height="35" width="40%" align="right" valign="middle" class="line_compta_bottom">
					<div style="width:75px; height:35px; line-height:35px;" id="line3_esp">
					<span id="toto_prelev_select">0.00</span><?php echo "&nbsp;". $MONNAIE[1];?>		</div>
					<div style="width:75px; height:35px; line-height:35px; display:none;" id="line3_chq">
					<span id="toto_chq_saisie"></span><?php echo "&nbsp;". $MONNAIE[1];?>		</div>				</td>
					<td height="35" valign="middle" class="line_compta_bottom">
					<div style="width:35px;" id="line4_esp"></div>
					<div style="width:35px; height:35px; line-height:35px; display:none;" id="line4_chq">
					<span style="padding-left:10px">(<span id="saisie_op_cheques"></span>)</span></div>		</td>
					<td height="35" valign="middle" class="line_compta_bottom_rigth" style="display:none">&nbsp;</td>
					<td valign="middle" class="line_compta_bottom" align="right" style="display:none">
					<div style="width:75px; height:35px; line-height:35px; padding-right:10px">
					<span id="toto_saisie"></span><?php echo "&nbsp;". $MONNAIE[1];?>		</div>
					
					</td>
				</tr>
			</table>
			<br />
			
			<br />
			<br />
			<span style="font-weight:bolder">Informations:</span>   <span id="commentaire_add" style="color:#FF0000"></span><br />
			
			<textarea name="commentaire" rows="6" class="classinput_xsize" id="commentaire" style=" width:800px"></textarea>

			<div style="text-align:right">
			<img id="bt_etape_3" style=" cursor:pointer; font-weight:bolder; color:#97bf0d; " src="<?php echo $DIR.$_SESSION['theme']->getDir_theme()?>images/bt-valider.gif" />
			</div>
			</div>
			<br />
			<br />
			
			<input type="hidden" value="0" id="montant_depot_esp" name="montant_depot_esp" />
			<input type="hidden" value="0" id="montant_depot_chq" name="montant_depot_chq" />
			<input type="hidden" value="0" id="montant_theorique" name="montant_theorique" />
			<input type="hidden" value="0" id="montant_depot" name="montant_depot" />
		</td>
		</tr>
		</table>
	</div>
</form>


			</td>
		</tr>
</table>
</div>
</div>
</div>
<SCRIPT type="text/javascript">


Event.observe($("chemin_etape_0_2"), "click", function(evt){Event.stop(evt); step_menu_prelev ('depot_banque', 'chemin_etape_0', array_menu_v_prelev);});
Event.observe($("chemin_etape_0_3"), "click", function(evt){Event.stop(evt); step_menu_prelev ('depot_banque', 'chemin_etape_0', array_menu_v_prelev);});

Event.observe($("bt_etape_0"), "click", function(evt){Event.stop(evt); 
    step_menu_prelev ('depot_cheques', 'chemin_etape_1', array_menu_v_prelev);
});

Event.observe($("chemin_etape_1_2"), "click", function(evt){Event.stop(evt); 
    step_menu_prelev ('depot_cheques', 'chemin_etape_1', array_menu_v_prelev);
});

Event.observe($("chemin_etape_1_3"), "click", function(evt){Event.stop(evt);
    step_menu_prelev ('depot_cheques', 'chemin_etape_1', array_menu_v_prelev);
});

Event.observe($("bt_etape_2"), "click", function(evt){ Event.stop(evt); step_menu_prelev ('depot_validation', 'chemin_etape_2', array_menu_v_prelev);});

Event.observe($("chemin_etape_2_2"), "click", function(evt){Event.stop(evt); step_menu_prelev ('depot_validation', 'chemin_etape_2', array_menu_v_prelev);});
Event.observe($("chemin_etape_2_3"), "click", function(evt){Event.stop(evt); step_menu_prelev ('depot_validation', 'chemin_etape_2', array_menu_v_prelev);});

Event.observe($("bt_etape_3"), "click", function(evt){Event.stop(evt); $("depot_create").submit();});


function next_if_Key_RETURN (event) {

	var key = event.which || event.keyCode; 
	switch (key) {   
	case Event.KEY_RETURN:  
		fi_id = false;
		for (i=0; i<array_especes.length; i++) {
			if (fi_id && $("ESP_"+array_especes[i].replace(".", ""))) { $("ESP_"+array_especes[i].replace(".", "")).focus(); break;}
			if (Event.element(event) == $("ESP_"+array_especes[i].replace(".", ""))) {
				fi_id = true;
			}
		}
		Event.stop(event);
	break;   
	}
}
// controle de changement dans les especes 

array_especes = Array(<?php echo '"'.implode("\",\"", $MONNAIE[5]).'"';?>);
	for (i=0; i<array_especes.length; i++) {
		Event.observe($("ESP_"+array_especes[i].replace(".", "")), "blur", function(evt){
			nummask(evt, 0, "X");
			Event.stop(evt); 
			
			calcul_depot_caisse_esp (array_especes);
			step_menu_depot ('depot_especes', 'chemin_etape_1', array_menu_v_depot);
		}
		);
		Event.observe($("ESP_"+array_especes[i].replace(".", "")), "keypress", function(evt){
			nummask(evt, 0, "X");
			
			next_if_Key_RETURN (evt);
			calcul_depot_caisse_esp (array_especes);
			step_menu_depot ('depot_especes', 'chemin_etape_1', array_menu_v_depot);
		}
		);
	}
//calcul_depot_caisse_esp (array_especes);

Event.observe($("id_compte_bancaire_destination"), "change", function(evt){

	calcul_depot_banque ();
});


Event.observe($("type_remise"), "change", function(evt){
if ($("type_remise").value == "ESP") {
$("chemin_etape_2_3").style.display = "none";
$("line0_chq").style.display = "none";
$("line1_chq").style.display = "none";
$("line2_chq").style.display = "none";
$("line3_chq").style.display = "none";
$("line4_chq").style.display = "none";
$("line5_chq").style.display = "none";
$("chemin_etape_1_3").style.display = "";
$("line0_esp").style.display = "";
$("line1_esp").style.display = "";
$("line2_esp").style.display = "";
$("line3_esp").style.display = "";
$("line4_esp").style.display = "";
$("line5_esp").style.display = "";
} else {
$("chemin_etape_2_3").style.display = "";
$("line0_chq").style.display = "";
$("line1_chq").style.display = "";
$("line2_chq").style.display = "";
$("line3_chq").style.display = "";
$("line4_chq").style.display = "";
$("line5_chq").style.display = "";
$("chemin_etape_1_3").style.display = "none";
$("line0_esp").style.display = "none";
$("line1_esp").style.display = "none";
$("line2_esp").style.display = "none";
$("line3_esp").style.display = "none";
$("line4_esp").style.display = "none";
$("line5_esp").style.display = "none";

}
});


$("selected_bancaire_dest").innerHTML = $("id_compte_bancaire_destination").options[$("id_compte_bancaire_destination").selectedIndex].text;

// controle de changement dans les especes 

centrage_element("edition_reglement");
centrage_element("edition_reglement_iframe");

Event.observe(window, "resize", function(evt){
centrage_element("edition_reglement");
centrage_element("edition_reglement_iframe");
});
//on masque le chargement
H_loading();
</SCRIPT>