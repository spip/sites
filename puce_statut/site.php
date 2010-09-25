<?php

/***************************************************************************\
 *  SPIP, Systeme de publication pour l'internet                           *
 *                                                                         *
 *  Copyright (c) 2001-200                                                 *
 *  Arnaud Martin, Antoine Pitrou, Philippe Riviere, Emmanuel Saint-James  *
 *                                                                         *
 *  Ce programme est un logiciel libre distribue sous licence GNU/GPL.     *
 *  Pour plus de details voir le fichier COPYING.txt ou l'aide en ligne.   *
\***************************************************************************/

if (!defined("_ECRIRE_INC_VERSION")) return;


// http://doc.spip.org/@puce_statut_site_dist
function puce_statut_site_dist($id, $statut, $id_rubrique, $type, $ajax=''){
	static $coord = array('publie' => 1,
			      'prop' => 0,
			      'refuse' => 2,
			      'poubelle' => 3);
	$type='site';

	$lang = isset($GLOBALS['lang_objet'])	? $GLOBALS['lang_objet']: $GLOBALS['spip_lang'];
	$lang_dir = lang_dir($lang);
	$puces = array(
		       0 => 'puce-proposer-8.png',
		       1 => 'puce-publier-8.png',
		       2 => 'puce-refuser-8.png',
		       3 => 'puce-supprimer-8.png');

	$t = sql_getfetsel("syndication", "spip_syndic", "id_syndic=".sql_quote($id));

	if ($t == 'off' OR $t == 'sus')
		$anim = 'anim';
	else
		$anim = 'breve';

	switch ($statut) {
		case 'publie':
			$puce = 'puce-verte-' . $anim .'.gif';
			$title = _T('info_site_reference');
			break;
		case 'prop':
			$puce = 'puce-orange-' . $anim .'.gif';
			$title = _T('info_site_attente');
			break;
		case 'refuse':
		default:
			$puce = 'puce-poubelle-' . $anim .'.gif';
			$title = _T('info_site_refuse');
			break;
	}
	$type1 = "statut$type$id";
	$inser_puce = http_img_pack($puce, $title, "id='img$type1' style='margin: 1px;'");

	if ($anim!='breve' OR !autoriser('publierdans','rubrique',$id_rubrique)
	OR !_ACTIVER_PUCE_RAPIDE)
		return $inser_puce;

	// c'est comme les breves :

	$titles = array(
			  "blanche" => _T('texte_statut_en_cours_redaction'),
			  "orange" => _T('texte_statut_propose_evaluation'),
			  "verte" => _T('texte_statut_publie'),
			  "rouge" => _T('texte_statut_refuse'),
			  "poubelle" => _T('texte_statut_poubelle'));

	$clip = 1+ (11*$coord[$statut]);

	if ($ajax){
		return 	"<span class='puce_site_fixe'>"
		. $inser_puce
		. "</span>"
		. "<span class='puce_site_popup' id='statutdecal$type$id' style='margin-left: -$clip"."px;'>"
		. afficher_script_statut($id, $type, -1, $puces[0], 'prop', $titles['orange'])
		. afficher_script_statut($id, $type, -10, $puces[1], 'publie', $titles['verte'])
	  	. afficher_script_statut($id, $type, -19, $puces[2], 'refuse', $titles['rouge'])
		  . "</span>";
	}

	$nom = "puce_statut_";

	if ((! _SPIP_AJAX))
	  $over ='';
	else {
	  $action = generer_url_ecrire('puce_statut',"",true);
	  $action = "if (!this.puce_loaded) { this.puce_loaded = true; prepare_selec_statut('$nom', '$type', '$id', '$action'); }";
	  $over = "\nonmouseover=\"$action\"";
	}

	return 	"<span class='puce_$type' id='$nom$type$id' dir='$lang_dir'$over>"
	. $inser_puce
	. '</span>';
}


?>