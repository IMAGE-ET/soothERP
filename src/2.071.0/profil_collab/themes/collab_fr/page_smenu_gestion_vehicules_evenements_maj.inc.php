<?php

// *************************************************************************************************************
// Modification d'un �v�nement pour un v�hicule
// *************************************************************************************************************

// Variables n�cessaires � l'affichage
$page_variables = array ();
check_page_variables ($page_variables);


//******************************************************************
// Variables communes d'affichage
//******************************************************************


// *************************************************************************************************************
// AFFICHAGE
// *************************************************************************************************************

?>
<script type="text/javascript">

window.parent.page.traitecontent('smenu_gestion_vehicules_histo','smenu_gestion_vehicules_histo.php?id_vehicule=<?php echo $id_vehicule;?>','true','sub_content');

</script>