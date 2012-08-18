<?php
// This is a SPIP language file  --  Ceci est un fichier langue de SPIP
// extrait automatiquement de http://trad.spip.net/tradlang_module/sites?lang_cible=ru
// ** ne pas modifier le fichier **

if (!defined('_ECRIRE_INC_VERSION')) return;

$GLOBALS[$GLOBALS['idx_lang']] = array(

	// A
	'articles_dispo' => 'Ожидание', # MODIF
	'articles_meme_auteur' => 'Все статьи этого автора',
	'articles_off' => 'Bloqués', # NEW
	'articles_publie' => 'Publiés', # NEW
	'articles_refuse' => 'Supprimés', # NEW
	'articles_tous' => 'Все',
	'aucun_article_syndic' => 'Нет ни одной импортированной статьи',
	'avis_echec_syndication_01' => 'Синдикация прошла неудачно: данные нечитабельны или отсутствует статья', # MODIF
	'avis_echec_syndication_02' => 'Синдикация прошла неудачно: нет доступа к базе данных этого сайта.', # MODIF
	'avis_site_introuvable' => 'Не удалось найти сайт',
	'avis_site_syndique_probleme' => 'Предупреждение: получение статей и новостей с других сайтов на этот сайт столкнулось с проблемой; следовательно работа системы временно прервана. Пожалуйста, проверьте адрес другого сайта (<b> @url_syndic@ </b>), и попробуйте еще раз восстановить информацию.', # MODIF
	'avis_sites_probleme_syndication' => 'Эти сайты столкнулись с проблемой обмена новостями и статьями', # MODIF
	'avis_sites_syndiques_probleme' => 'Эти объединенные сайты вызвали проблему', # MODIF

	// B
	'bouton_exporter' => 'Экспорт',
	'bouton_importer' => 'Импорт',
	'bouton_radio_modere_posteriori' => 'пост-модерация', # MODIF
	'bouton_radio_modere_priori' => 'пре-модерация', # MODIF
	'bouton_radio_non_syndication' => 'Не импортировать статьи на сайт',
	'bouton_radio_syndication' => 'Импортировать материалы',

	// C
	'confirmer_purger_syndication' => 'Êtes-vous certain de vouloir supprimer tous les articles syndiqués de ce site ?', # NEW

	// E
	'entree_adresse_fichier_syndication' => 'RSS лента(ы):',
	'entree_adresse_site' => '<b>URL сайта</b> [обязательно]',
	'entree_description_site' => 'Описание сайта',
	'erreur_fichier_format_inconnu' => 'Формат файла @fichier@ не поддерживается системой.',
	'erreur_fichier_incorrect' => 'Невозможно прочитать файл.',

	// F
	'form_prop_nom_site' => 'Название сайта',

	// I
	'icone_article_syndic' => 'Импортированная статья',
	'icone_articles_syndic' => 'Импортированные статьи',
	'icone_controler_syndication' => 'Publication des articles syndiqués', # NEW
	'icone_modifier_site' => 'Редактировать сайт',
	'icone_referencer_nouveau_site' => 'Добавить сайт',
	'icone_site_reference' => 'Sites référencés', # NEW
	'icone_supprimer_article' => 'Удалить статью',
	'icone_supprimer_articles' => 'Удалить статьи',
	'icone_valider_article' => 'Valider cet article', # NEW
	'icone_valider_articles' => 'Valider ces articles', # NEW
	'icone_voir_sites_references' => 'Каталог сайтов',
	'info_1_site_importe' => '1 site a été importé', # NEW
	'info_a_valider' => '[проверяется]',
	'info_aucun_site_importe' => 'Aucun site n\'a pu être importé', # NEW
	'info_bloquer' => 'блок',
	'info_bloquer_lien' => 'блокировать эту ссылку', # MODIF
	'info_derniere_syndication' => 'Последний обмен этого сайта был проведен на', # MODIF
	'info_liens_syndiques_1' => 'объединенные ссылки', # MODIF
	'info_liens_syndiques_2' => 'ожидание утверждения.', # MODIF
	'info_nb_sites_importes' => '@nb@ sites ont été importés', # NEW
	'info_nom_site_2' => '<b>Название сайта</b> [обязательно]', # MODIF
	'info_panne_site_syndique' => 'Синдикация сайта недоступна', # MODIF
	'info_probleme_grave' => 'ошибка',
	'info_question_proposer_site' => 'Кому разрешено предлагать ссылки на другие сайты?',
	'info_retablir_lien' => 'восстановить эту ссылку', # MODIF
	'info_site_attente' => 'Вебсайт, ожидающий проверки', # MODIF
	'info_site_propose' => 'Добавлен для проверки:',
	'info_site_reference' => 'Сайты, на которые ведут ссылки, онлайн', # MODIF
	'info_site_refuse' => 'Вебсайт отклонен', # MODIF
	'info_site_syndique' => 'Можно импортировать статьи с этого сайта',
	'info_site_valider' => 'Сайты, которые будут утверждены', # MODIF
	'info_sites_referencer' => 'Ссылка на сайт', # MODIF
	'info_sites_refuses' => 'Отключить сайты', # MODIF
	'info_statut_site_1' => 'Этот сайт:',
	'info_statut_site_2' => 'Опубликованный', # MODIF
	'info_statut_site_3' => 'Отправленный', # MODIF
	'info_statut_site_4' => 'В корзину', # MODIF
	'info_syndication' => 'RSS:',
	'info_syndication_articles' => 'статья(и)',
	'item_bloquer_liens_syndiques' => 'Все сайты требуют проверки перед добавлением',
	'item_gerer_annuaire_site_web' => 'Включить каталог сайтов и импорт статей по RSS',
	'item_non_bloquer_liens_syndiques' => 'По умолчанию разрешать добавлять материалы',
	'item_non_gerer_annuaire_site_web' => 'Отключить  каталог сайтов и импорт статей по RSS',
	'item_non_utiliser_syndication' => 'Выключить функцию импорта статей по RSS',
	'item_utiliser_syndication' => 'Включить функцию импорта статей по RSS',

	// L
	'label_exporter_avec_mots_cles_1' => 'Exporter les mots-clés sous forme de tags', # NEW
	'label_exporter_id_parent' => 'Exporter les sites de la rubrique', # NEW
	'label_exporter_publie_seulement_1' => 'Exporter uniquement les sites publiés', # NEW
	'label_fichier_import' => 'HTML файл',
	'label_importer_les_tags_1' => 'Importer les tags sous forme de mot-clé', # NEW
	'label_importer_statut_publie_1' => 'Publier automatiquement les sites', # NEW
	'lien_mise_a_jour_syndication' => 'Обновить сейчас',
	'lien_nouvelle_recuperation' => 'Попробывать выполнить новый поиск данных', # MODIF
	'lien_purger_syndication' => 'Удалить все импортированные статьи',

	// N
	'nombre_articles_syndic' => '@nb@ статей импортировано',

	// S
	'statut_off' => 'Удаленные', # MODIF
	'statut_prop' => 'Ожидающие', # MODIF
	'statut_publie' => 'Опубликованные', # MODIF
	'syndic_choix_moderation' => 'Что должно быть сделано со следующими ссылками с этого сайта?', # MODIF
	'syndic_choix_oublier' => 'Что должно быть сделано с ссылками, которые больше не присутствуют при получении статей и новостей с других сайтов по RSS?', # MODIF
	'syndic_choix_resume' => 'Некоторые сайты предлагают целые тексты своих статей. Когда целый текст доступен, хотите ли Вы объединить его:', # MODIF
	'syndic_lien_obsolete' => 'устаревшая ссылка',
	'syndic_option_miroir' => 'блокировать их автоматически', # MODIF
	'syndic_option_oubli' => 'удалить тему(после @mois@ months)', # MODIF
	'syndic_option_resume_non' => 'полное содержание статей(HTML формат)', # MODIF
	'syndic_option_resume_oui' => 'только краткое изложение (тестовый формат)', # MODIF
	'syndic_options' => 'Опции объединения в синдикаты:', # MODIF

	// T
	'texte_expliquer_export_bookmarks' => 'Vous pouvez exporter une liste de sites au format Marque-page HTML,
	pour vous permettre ensuite de l\'importer dans votre navigateur ou dans un service en ligne', # NEW
	'texte_expliquer_import_bookmarks' => 'Vous pouvez importer une liste de sites au format Marque-page HTML,
	en provenance de votre navigateur ou d\'un service en ligne de gestion des Marques-pages.', # NEW
	'texte_liens_sites_syndiques' => 'Вы можете модерировать все материалы, импортированные с других сайтов. Эта настройка устанавливает правило по умолчанию для вновь добавленных сайтов. В любом случае вы можете задавать правила отдельно для каждого сайта.',
	'texte_messages_publics' => 'Основные сообщения статьи:', # MODIF
	'texte_non_fonction_referencement' => 'Вы можете не использовать автоматические функции, и ввести элементы касающиеся этого сайта вручную...', # MODIF
	'texte_referencement_automatique' => 'Автоматизированные ссылки сайта </b> <br /> Вы можете быстро сослаться на вебсайт, указывая ниже требуемый адрес, или адрес сайта, с которого Вы получаете статьи и файлы по RSS. SPIP автоматически соберет информацию о сайте (название, описание ...).', # MODIF
	'texte_referencement_automatique_verifier' => 'Информация о сайте <tt>@url@</tt> была импортирована автоматически. Проверьте её перед добавлением сайта.',
	'texte_syndication' => 'Если на другом сайте есть экспорт материалов через RSS, вы можете автоматически импортировать последние статьи на ваш сайт. Для этого необходимо активировать импорт статей на вашем сайте. 
  <blockquote> <i> Необходимо отметить, что на части сайтов нет автоматического экспорта материалов через RSS ленту. В таком случае вы не сможете получать информацию с таких сайтов в автоматическом режиме. </i> </blockquote>',
	'titre_articles_syndiques' => 'Статьи, импортированные с этого сайта',
	'titre_dernier_article_syndique' => 'Последний обмен статей по RSS.', # MODIF
	'titre_exporter_bookmarks' => 'Экспортировать Закладки',
	'titre_importer_bookmarks' => 'Импортировать Закладки',
	'titre_importer_exporter_bookmarks' => 'Импортировать и экспортировать закладки',
	'titre_page_sites_tous' => 'Каталог сайтов',
	'titre_referencement_sites' => 'Каталог сайтов, импорт статей по RSS',
	'titre_site_numero' => 'НОМЕР САЙТА:',
	'titre_sites_proposes' => 'Представленные сайты', # MODIF
	'titre_sites_references_rubrique' => 'Каталог сайтов в текущем разделе', # MODIF
	'titre_sites_syndiques' => 'Объединенные сайты', # MODIF
	'titre_sites_tous' => 'Каталог сайтов', # MODIF
	'titre_syndication' => 'Импорт статей с другого сайта по RSS',
	'tout_voir' => 'Показать все импортированные статьи',

	// U
	'un_article_syndic' => '1 импортированная статья'
);

?>
