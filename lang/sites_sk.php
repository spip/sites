<?php
// This is a SPIP language file  --  Ceci est un fichier langue de SPIP
// extrait automatiquement de http://www.spip.net/trad-lang/
// ** ne pas modifier le fichier **

if (!defined('_ECRIRE_INC_VERSION')) return;

$GLOBALS[$GLOBALS['idx_lang']] = array(

	// A
	'articles_dispo' => 'En attente', # NEW
	'articles_meme_auteur' => 'Tous les articles de cet auteur', # NEW
	'articles_off' => 'Bloqués', # NEW
	'articles_publie' => 'Publiés', # NEW
	'articles_refuse' => 'Supprimés', # NEW
	'articles_tous' => 'Tous', # NEW
	'aucun_article_syndic' => 'Aucun article syndiqué', # NEW
	'avis_echec_syndication_01' => 'Syndication failed: either the selected backend is unreadable or it does not offer any article.',
	'avis_echec_syndication_02' => 'Syndication failed: could not reach the backend of this site.',
	'avis_site_introuvable' => 'Site not found', # MODIF
	'avis_site_syndique_probleme' => 'Attention : la syndication de ce site a rencontré un problème ; le système est donc temporairement interrompu pour l\'instant. Vérifiez l\'adresse du fichier de syndication de ce site (<b>@url_syndic@</b>), et tentez une nouvelle récupération des informations.', # MODIF
	'avis_sites_probleme_syndication' => 'These sites encountered a syndication problem',
	'avis_sites_syndiques_probleme' => 'These syndicated sites generated a problem',

	// B
	'bouton_radio_modere_posteriori' => 'post-moderation', # MODIF
	'bouton_radio_modere_priori' => 'pre-moderation', # MODIF
	'bouton_radio_non_syndication' => 'No syndication', # MODIF
	'bouton_radio_syndication' => 'Syndication:', # MODIF

	// C
	'confirmer_purger_syndication' => 'Êtes-vous certain de vouloir supprimer tous les articles syndiqués de ce site ?', # NEW

	// E
	'entree_adresse_fichier_syndication' => 'Address of file for syndication:', # MODIF
	'entree_adresse_site' => '<b>Site URL</b> [Required]', # MODIF
	'entree_description_site' => 'Site description', # MODIF

	// F
	'form_prop_nom_site' => 'Název webu', # NEW

	// I
	'icone_article_syndic' => 'Article syndiqué', # NEW
	'icone_articles_syndic' => 'Articles syndiqués', # NEW
	'icone_controler_syndication' => 'Publication des articles syndiqués', # NEW
	'icone_modifier_site' => 'Upraviť tieto stránky',
	'icone_referencer_nouveau_site' => 'Odkázať sa na novú stránku',
	'icone_site_reference' => 'Sites référencés', # NEW
	'icone_supprimer_article' => 'Supprimer cet article', # NEW
	'icone_supprimer_articles' => 'Supprimer ces articles', # NEW
	'icone_valider_article' => 'Valider cet article', # NEW
	'icone_valider_articles' => 'Valider ces articles', # NEW
	'icone_voir_sites_references' => 'Zobraziť linky',
	'info_a_valider' => '[na schválenie]',
	'info_bloquer' => 'block', # MODIF
	'info_bloquer_lien' => 'block this link', # MODIF
	'info_derniere_syndication' => 'The last syndication of this site was carried out on',
	'info_liens_syndiques_1' => 'syndicated links',
	'info_liens_syndiques_2' => 'pending validation.', # MODIF
	'info_nom_site_2' => '<b>Site name</b> [Required]', # MODIF
	'info_panne_site_syndique' => 'Syndicated site out of order',
	'info_probleme_grave' => 'chyba',
	'info_question_proposer_site' => 'Who can propose referenced sites?',
	'info_retablir_lien' => 'restore this link',
	'info_site_attente' => 'Web site pending validation', # MODIF
	'info_site_propose' => 'Site submitted on:',
	'info_site_reference' => 'Referenced sites online',
	'info_site_refuse' => 'Web site rejected',
	'info_site_syndique' => 'This site is syndicated...',
	'info_site_valider' => 'Sites to be validated',
	'info_sites_referencer' => 'Reference a site',
	'info_sites_refuses' => 'Rejected sites',
	'info_statut_site_1' => 'This site is:',
	'info_statut_site_2' => 'Published',
	'info_statut_site_3' => 'Submitted',
	'info_statut_site_4' => 'In the dustbin', # MODIF
	'info_syndication' => 'syndication:', # MODIF
	'info_syndication_articles' => 'article(s)', # MODIF
	'item_bloquer_liens_syndiques' => 'Block syndicated links for validation',
	'item_gerer_annuaire_site_web' => 'Manage Web sites directory',
	'item_non_bloquer_liens_syndiques' => 'Do not block the links emanating from syndication', # MODIF
	'item_non_gerer_annuaire_site_web' => 'Disable Web sites directory',
	'item_non_utiliser_syndication' => 'Do not use automated syndication', # MODIF
	'item_utiliser_syndication' => 'Use automated syndication', # MODIF

	// L
	'lien_mise_a_jour_syndication' => 'Update now',
	'lien_nouvelle_recuperation' => 'Try to perform a new retrieval of data',
	'lien_purger_syndication' => 'Effacer tous les articles syndiqués', # NEW

	// N
	'nombre_articles_syndic' => '@nb@ articles syndiqués', # NEW

	// S
	'statut_off' => 'Supprimé', # NEW
	'statut_prop' => 'En attente', # NEW
	'statut_publie' => 'Publié', # NEW
	'syndic_choix_moderation' => 'What should be done with the next links from this site?',
	'syndic_choix_oublier' => 'What should be done with links which are no longer present in the syndication file?',
	'syndic_choix_resume' => 'Some sites offer the full text of their articles. When the full text is available, do you wish to syndicate:',
	'syndic_lien_obsolete' => 'obsolete link',
	'syndic_option_miroir' => 'block them automatically', # MODIF
	'syndic_option_oubli' => 'delete them (after @mois@ months)',
	'syndic_option_resume_non' => 'the full content of the articles (HTML format)', # MODIF
	'syndic_option_resume_oui' => 'just a summary (text format)',
	'syndic_options' => 'Syndication options:',

	// T
	'texte_liens_sites_syndiques' => 'Links emanating from syndicated sites could
			be blocked beforehand; the following
			setting show the default setting of
			syndicated sites after their creation. It
			is, then, possible anyway to
			block each link individually, or to
			choose, for each site, to block the links coming
			from any particular site.',
	'texte_messages_publics' => 'Public Messages of the article:', # MODIF
	'texte_non_fonction_referencement' => 'You can choose not to use this automated feature, and enter the elements concerning that site manually...',
	'texte_referencement_automatique' => '<b>Automated site referencing</b><br />You can reference a Web site quickly by indicating below the desired URL, or the address of its syndication file. SPIP will automatically retrieve the site\'s information (title, description...).', # MODIF
	'texte_referencement_automatique_verifier' => 'Please, verify the information provided by <tt>@url@</tt> before saving.',
	'texte_syndication' => 'Il est possible de récupérer automatiquement, lorsqu\'un site Web le permet, 
		la liste de ses nouveautés. Pour cela, vous devez activer la syndication. 
		<blockquote><i>Certains hébergeurs désactivent cette fonctionnalité ; 
		dans ce cas, vous ne pourrez pas utiliser la syndication de contenu
		depuis votre site.</i></blockquote>', # MODIF
	'titre_articles_syndiques' => 'Syndicated articles pulled out from this site',
	'titre_dernier_article_syndique' => 'Latest syndicated articles',
	'titre_page_sites_tous' => 'Referenced sites',
	'titre_referencement_sites' => 'Sites referencing and syndication',
	'titre_site_numero' => 'ČÍSLO STRÁNKY:',
	'titre_sites_proposes' => 'Submitted sites',
	'titre_sites_references_rubrique' => 'Referenced sites in this section',
	'titre_sites_syndiques' => 'Syndicated sites',
	'titre_sites_tous' => 'Referenced sites',
	'titre_syndication' => 'Sites syndication', # MODIF
	'tout_voir' => 'Voir tous les articles syndiqués', # NEW

	// U
	'un_article_syndic' => '1 article syndiqué' # NEW
);

?>
