<?php
	
	
	include('header.php');
	
	
	xoops_loadLanguage('admin', 'pageflip');
	
	
	xoops_cp_header();
	
	$op = isset($_REQUEST['op'])?$_REQUEST['op']:"campaign";
	$fct = isset($_REQUEST['fct'])?$_REQUEST['fct']:"list";
	$limit = !empty($_REQUEST['limit'])?intval($_REQUEST['limit']):30;
	$start = !empty($_REQUEST['start'])?intval($_REQUEST['start']):0;
	$order = !empty($_REQUEST['order'])?$_REQUEST['order']:'DESC';
	$sort = !empty($_REQUEST['sort'])?''.$_REQUEST['sort'].'':'created';
	$filter = !empty($_REQUEST['filter'])?''.$_REQUEST['filter'].'':'1,1';
	
	switch($op) {
		default:
		case "books":	
			switch ($fct)
			{
				default:
				case "list":				
					pageflip_adminMenu(1);
					
					include_once $GLOBALS['xoops']->path( "/class/pagenav.php" );
					include_once $GLOBALS['xoops']->path( "/class/template.php" );
					$GLOBALS['pfTpl'] = new XoopsTpl();
					
					
					$books_handler =& xoops_getmodulehandler('books', 'pageflip');
					
					
					$criteria = $books_handler->getFilterCriteria($filter);
					$ttl = $books_handler->getCount($criteria);
					$sort = !empty($_REQUEST['sort'])?''.$_REQUEST['sort'].'':'created';
					
					
					$pagenav = new XoopsPageNav($ttl, $limit, $start, 'start', 'limit='.$limit.'&sort='.$sort.'&order='.$order.'&op='.$op.'&fct='.$fct.'&filter='.$filter.'&fct='.$fct.'&filter='.$filter);
					$GLOBALS['pfTpl']->assign('pagenav', $pagenav->renderNav());
					
					foreach (array(	'bid','name','description','reference','language','default','pages','chapter','bookWidth','bookHeight','created','updated','actioned') as $id => $key) {
						$GLOBALS['pfTpl']->assign(strtolower(str_replace('-','_',$key).'_th'), '<a href="'.$_SERVER['PHP_SELF'].'?start='.$start.'&limit='.$limit.'&sort='.str_replace('_','-',$key).'&order='.((str_replace('_','-',$key)==$sort)?($order=='DESC'?'ASC':'DESC'):$order).'&op='.$op.'&filter='.$filter.'">'.(defined('_AM_PAGEFLIP_TH_'.strtoupper(str_replace('-','_',$key)))?constant('_AM_PAGEFLIP_TH_'.strtoupper(str_replace('-','_',$key))):'_AM_PAGEFLIP_TH_'.strtoupper(str_replace('-','_',$key))).'</a>');
						$GLOBALS['pfTpl']->assign('filter_'.strtolower(str_replace('-','_',$key)).'_th', $books_handler->getFilterForm($filter, $key, $sort, $op, $fct));
					}
					
					$GLOBALS['pfTpl']->assign('limit', $limit);
					$GLOBALS['pfTpl']->assign('start', $start);
					$GLOBALS['pfTpl']->assign('order', $order);
					$GLOBALS['pfTpl']->assign('sort', $sort);
					$GLOBALS['pfTpl']->assign('filter', $filter);
					$GLOBALS['pfTpl']->assign('xoConfig', $GLOBALS['xoopsModuleConfig']);
					
					$criteria->setStart($start);
					$criteria->setLimit($limit);
					$criteria->setSort('`'.$sort.'`');
					$criteria->setOrder($order);
					
					$books = $books_handler->getObjects($criteria, true);
					foreach($books as $bid => $book) {
						$GLOBALS['pfTpl']->append('books', $book->toArray());
					}
					$GLOBALS['pfTpl']->assign('form', pageflip_books_get_form(false));
					$GLOBALS['pfTpl']->assign('php_self', $_SERVER['PHP_SELF']);
					$GLOBALS['pfTpl']->display('db:pageflip_cpanel_books_list.html');
					break;		
					
				case "new":
				case "edit":
					
					pageflip_adminMenu(1);
					
					include_once $GLOBALS['xoops']->path( "/class/pagenav.php" );
					include_once $GLOBALS['xoops']->path( "/class/template.php" );
					$GLOBALS['pfTpl'] = new XoopsTpl();
					
					$books_handler =& xoops_getmodulehandler('books', 'pageflip');
					if (isset($_REQUEST['id'])) {
						$books = $books_handler->get(intval($_REQUEST['id']));
					} else {
						$books = $books_handler->create();
					}
					
					$GLOBALS['pfTpl']->assign('form', $books->getForm());
					$GLOBALS['pfTpl']->assign('php_self', $_SERVER['PHP_SELF']);
					$GLOBALS['pfTpl']->display('db:pageflip_cpanel_books_edit.html');
					break;
				case "save":
					
					$books_handler =& xoops_getmodulehandler('books', 'pageflip');
					$id=0;
					if ($id=intval($_REQUEST['id'])) {
						$books = $books_handler->get($id);
					} else {
						$books = $books_handler->create();
					}
					$books->setVars($_POST[$id]);
					if ($_POST[$id]['default']==true)
						$books->setVar('default', true);
					else 
						$books->setVar('default', false);
						
					if ($_POST[$id]['backgroundImageDelete']==true) {
						unlink(XOOPS_UPLOAD_PATH.DS.$GLOBALS['xoopsModuleConfig']['uploaddir'].DS.'backgrounds'.DS.$books->getVar('backgroundImage'));
						$books->setVar('backgroundImage', '');
					}
					
					$uploader = new PageflipXoopsMediaUploader(XOOPS_UPLOAD_PATH.DS.$GLOBALS['xoopsModuleConfig']['uploaddir'].DS.'backgrounds'.DS, explode('|', $GLOBALS['xoopsModuleConfig']['allowed_mimetypes']), $GLOBALS['xoopsModuleConfig']['maximum_filesize'], 0, 0, explode('|', $GLOBALS['xoopsModuleConfig']['allowed_file_extensions']));
					$uploader->setPrefix(substr(md5(microtime(true), mt_rand(0,20), 11)));
					  
					if ($uploader->fetchMedia($id.'_backgroundImage')) {
					  	if (!$uploader->upload()) {
					    	if ($books->isNew()) {	
					    		pageflip_adminMenu(1);
					       		echo $uploader->getErrors();
								pageflip_footer_adminMenu();
								xoops_cp_footer();
								exit(0);
					  		}     
					    } else {
					      	if (!$books->isNew())
					      		unlink(XOOPS_UPLOAD_PATH.DS.$GLOBALS['xoopsModuleConfig']['uploaddir'].DS.'backgrounds'.DS.$books->getVar('backgroundImage'));

					      	$books->setVar('backgroundImage', $uploader->getSavedFileName());
					    }      	
				  	}
					if (!$id=$books_handler->insert($books)) {
						redirect_header('index.php?op='.$op.'&fct=list&limit='.$limit.'&start='.$start.'&order='.$order.'&sort='.$sort.'&filter='.$filter, 10, _AM_MSG_BOOKS_FAILEDTOSAVE);
						exit(0);
					} else {
						switch($_REQUEST['mode']) {
							case 'new':
								redirect_header('index.php?op='.$op.'&fct=edit&id='.$id, 10, _AM_MSG_BOOKS_SAVEDOKEY);
								break;
							default:
							case 'edit':
								redirect_header('index.php?op='.$op.'&fct=list&limit='.$limit.'&start='.$start.'&order='.$order.'&sort='.$sort.'&filter='.$filter, 10, _AM_MSG_BOOKS_SAVEDOKEY);
								break;
						}
						exit(0);
					}
					break;
				case "savelist":
					
					$books_handler =& xoops_getmodulehandler('books', 'pageflip');
					foreach($_REQUEST['id'] as $id) {
						$books = $books_handler->get($id);
						$books->setVars($_POST[$id]);
						if ($_POST[$id]['default']==true)
							$books->setVar('default', true);
						else 
							$books->setVar('default', false);
						if (!$books_handler->insert($books)) {
							redirect_header('index.php?op='.$op.'&fct=list&limit='.$limit.'&start='.$start.'&order='.$order.'&sort='.$sort.'&filter='.$filter, 10, _AM_MSG_BOOKS_FAILEDTOSAVE);
							exit(0);
						} 
					}
					redirect_header('index.php?op='.$op.'&fct=list&limit='.$limit.'&start='.$start.'&order='.$order.'&sort='.$sort.'&filter='.$filter, 10, _AM_MSG_BOOKS_SAVEDOKEY);
					exit(0);
					break;				
				case "delete":	
								
					$books_handler =& xoops_getmodulehandler('books', 'pageflip');
					$id=0;
					if (isset($_POST['id'])&&$id=intval($_POST['id'])) {
						$books = $books_handler->get($id);
						if (!$books_handler->delete($books)) {
							redirect_header('index.php?op='.$op.'&fct=list&limit='.$limit.'&start='.$start.'&order='.$order.'&sort='.$sort.'&filter='.$filter, 10, _AM_MSG_BOOKS_FAILEDTODELETE);
							exit(0);
						} else {
							redirect_header('index.php?op='.$op.'&fct=list&limit='.$limit.'&start='.$start.'&order='.$order.'&sort='.$sort.'&filter='.$filter, 10, _AM_MSG_BOOKS_DELETED);
							exit(0);
						}
					} else {
						$books = $books_handler->get(intval($_REQUEST['id']));
						xoops_confirm(array('id'=>$_REQUEST['id'], 'op'=>$_REQUEST['op'], 'fct'=>$_REQUEST['fct'], 'limit'=>$_REQUEST['limit'], 'start'=>$_REQUEST['start'], 'order'=>$_REQUEST['order'], 'sort'=>$_REQUEST['sort'], 'filter'=>$_REQUEST['filter']), 'index.php', sprintf(_AM_MSG_BOOKS_DELETE, $books->getVar('name')));
					}
					break;
			}
			break;
		case "pages":	
			switch ($fct)
			{
				default:
				case "list":				
					pageflip_adminMenu(2);
					
					include_once $GLOBALS['xoops']->path( "/class/pagenav.php" );
					include_once $GLOBALS['xoops']->path( "/class/template.php" );
					$GLOBALS['pfTpl'] = new XoopsTpl();
					
					$pages_handler =& xoops_getmodulehandler('pages', 'pageflip');
						
					$criteria = $pages_handler->getFilterCriteria($filter);
					$ttl = $pages_handler->getCount($criteria);
					$sort = !empty($_REQUEST['sort'])?''.$_REQUEST['sort'].'':'created';
										
					$pagenav = new XoopsPageNav($ttl, $limit, $start, 'start', 'limit='.$limit.'&sort='.$sort.'&order='.$order.'&op='.$op.'&fct='.$fct.'&filter='.$filter.'&fct='.$fct.'&filter='.$filter);
					$GLOBALS['pfTpl']->assign('pagenav', $pagenav->renderNav());
			
					foreach (array(	'pid','bid','cid','page','mode','path','filename','width','height','extension','filetype','created','updated','actioned') as $id => $key) {
						$GLOBALS['pfTpl']->assign(strtolower(str_replace('-','_',$key).'_th'), '<a href="'.$_SERVER['PHP_SELF'].'?start='.$start.'&limit='.$limit.'&sort='.str_replace('_','-',$key).'&order='.((str_replace('_','-',$key)==$sort)?($order=='DESC'?'ASC':'DESC'):$order).'&op='.$op.'&filter='.$filter.'">'.(defined('_AM_PAGEFLIP_TH_'.strtoupper(str_replace('-','_',$key)))?constant('_AM_PAGEFLIP_TH_'.strtoupper(str_replace('-','_',$key))):'_AM_PAGEFLIP_TH_'.strtoupper(str_replace('-','_',$key))).'</a>');
						$GLOBALS['pfTpl']->assign('filter_'.strtolower(str_replace('-','_',$key)).'_th', $pages_handler->getFilterForm($filter, $key, $sort, $op, $fct));
					}
					
					$GLOBALS['pfTpl']->assign('limit', $limit);
					$GLOBALS['pfTpl']->assign('start', $start);
					$GLOBALS['pfTpl']->assign('order', $order);
					$GLOBALS['pfTpl']->assign('sort', $sort);
					$GLOBALS['pfTpl']->assign('filter', $filter);
					$GLOBALS['pfTpl']->assign('xoConfig', $GLOBALS['xoopsModuleConfig']);
										
					$criteria->setStart($start);
					$criteria->setLimit($limit);
					$criteria->setSort('`'.$sort.'`');
					$criteria->setOrder($order);
						
					$pagess = $pages_handler->getObjects($criteria, true);
					foreach($pagess as $gid => $pages) {
						if (is_object($pages))					
							$GLOBALS['pfTpl']->append('galleries', $pages->toArray());
					}
					$GLOBALS['pfTpl']->assign('form', pageflip_pages_get_form(false));
					$GLOBALS['pfTpl']->assign('php_self', $_SERVER['PHP_SELF']);
					$GLOBALS['pfTpl']->display('db:pageflip_cpanel_pages_list.html');
					break;		
					
				case "new":
				case "edit":
					
					pageflip_adminMenu(2);
					
					include_once $GLOBALS['xoops']->path( "/class/pagenav.php" );
					include_once $GLOBALS['xoops']->path( "/class/template.php" );
					$GLOBALS['pfTpl'] = new XoopsTpl();
					
					$pages_handler =& xoops_getmodulehandler('pages', 'pageflip');
					if (isset($_REQUEST['id'])) {
						$pages = $pages_handler->get(intval($_REQUEST['id']));
					} else {
						$pages = $pages_handler->create();
					}
					
					$GLOBALS['pfTpl']->assign('form', $pages->getForm());
					$GLOBALS['pfTpl']->assign('php_self', $_SERVER['PHP_SELF']);
					$GLOBALS['pfTpl']->display('db:pageflip_cpanel_pages_edit.html');
					break;
				case "save":
					
					$pages_handler =& xoops_getmodulehandler('pages', 'pageflip');
					if ($id=intval($_REQUEST['id'])) {
						$pages = $pages_handler->get($id);
					} else {
						$pages = $pages_handler->create();
					}
					$pages->setVars($_POST[$id]);

					if (!empty($_POST[$id]['newChapter'])) {
						$chapters_handler =& xoops_getmodulehandler('chapters', 'pageflip');
						$chapter = $chapters_handler->create();
						$chapter->setVars($_POST[$id]);
						$chapter->setVar('name', $_POST[$id]['newChapter']);
						$chapter = $chapters_handler->get($cid = $chapters_handler->insert($chapter));
						$pages->setVar('cid', $cid);
					}
					$uploader = new PageflipXoopsMediaUploader($GLOBALS['xoopsModuleConfig']['uploaddirtype'].DS.$GLOBALS['xoopsModuleConfig']['uploaddir'], explode('|', $GLOBALS['xoopsModuleConfig']['allowed_mimetypes']), $GLOBALS['xoopsModuleConfig']['maximum_filesize'], 0, 0, explode('|', $GLOBALS['xoopsModuleConfig']['allowed_file_extensions']));
					$uploader->setPrefix(substr(md5(microtime(true)), mt_rand(0,20), 11));
					  
					if ($uploader->fetchMedia('imagefile')) {
					  	if (!$uploader->upload()) {
					    	if ($pages->isNew()) {	
					    		pageflip_adminMenu(2);
					       		echo $uploader->getErrors();
								pageflip_footer_adminMenu();
								xoops_cp_footer();
								exit(0);
					  		}     
					    } else {
					      	if (!$pages->isNew())
					      		unlink(constant($pages->getVar('location').'_VALUE').$pages->getVar('path').(substr($pages->getVar('path'), strlen($pages->getVar('path'))-1, 1)!=DIRECTORY_SEPARATOR?DIRECTORY_SEPARATOR:'').$pages->getVar('filename'));
					      	
					      	$pages->setVar('path', $GLOBALS['xoopsModuleConfig']['uploaddirtype'].DS.$GLOBALS['xoopsModuleConfig']['uploaddir']);
					      	$pages->setVar('filename', $uploader->getSavedFileName());
					      	
					      	$filename = explode('.', $uploader->getSavedFileName());
					      	$pages->setVar('extension', $filename[sizeof($filename)]);
					      	
					      	if ($dimension = getimagesize($pages->getVar('path').(substr($pages->getVar('path'), strlen($pages->getVar('path'))-1, 1)!=DIRECTORY_SEPARATOR?DIRECTORY_SEPARATOR:'').$pages->getVar('filename'))) {
					      		$pages->setVar('width', $dimension[0]);
					      		$pages->setVar('height', $dimension[1]);
					      	} else {
					      		$pages->setVar('width', 0);
					      		$pages->setVar('height', 0);
					      	}
					    }      	
				  	} else {
				  		if ($pages->isNew()) {	
				    		pageflip_adminMenu(2);
				       		echo $uploader->getErrors();
							pageflip_footer_adminMenu();
							xoops_cp_footer();
							exit(0);
				  		}
				  	}
					
				  	$pages = $pages_handler->get($id=$pages_handler->insert($pages));
				  						
				  	if (!is_object($pages)) {
						redirect_header('index.php?op='.$op.'&fct=list&limit='.$limit.'&start='.$start.'&order='.$order.'&sort='.$sort.'&filter='.$filter, 10, _AM_MSG_PAGES_FAILEDTOSAVE);
						exit(0);
					} else {
						if (is_object($chapter)) {
							$chapter = $chapters_handler->get($cid);
							$chapter->setVar('page', $pages->getVar('page'));
							$chapter->setVar('pid', $pages->getVar('pid'));
							$chapters_handler->insert($chapter, true);
						}
						switch($_REQUEST['mode']) {
							case 'new':
								redirect_header('index.php?op='.$op.'&fct=edit&id='.$id, 10, _AM_MSG_PAGES_SAVEDOKEY);
								break;
							default:
							case 'edit':
								redirect_header('index.php?op='.$op.'&fct=list&limit='.$limit.'&start='.$start.'&order='.$order.'&sort='.$sort.'&filter='.$filter, 10, _AM_MSG_PAGES_SAVEDOKEY);
								break;
						}
						exit(0);
					}
					break;
				case "savelist":
					
					$pages_handler =& xoops_getmodulehandler('pages', 'pageflip');
					foreach($_REQUEST['id'] as $id) {
						$pages = $pages_handler->get($id);
						$pages->setVars($_POST[$id]);
						if (!$pages_handler->insert($pages)) {
							redirect_header('index.php?op='.$op.'&fct=list&limit='.$limit.'&start='.$start.'&order='.$order.'&sort='.$sort.'&filter='.$filter, 10, _AM_MSG_PAGES_FAILEDTOSAVE);
							exit(0);
						} 
					}
					redirect_header('index.php?op='.$op.'&fct=list&limit='.$limit.'&start='.$start.'&order='.$order.'&sort='.$sort.'&filter='.$filter, 10, _AM_MSG_PAGES_SAVEDOKEY);
					exit(0);
					break;				
				case "delete":	
								
					$pages_handler =& xoops_getmodulehandler('pages', 'pageflip');
					$id=0;
					if (isset($_POST['id'])&&$id=intval($_POST['id'])) {
						$pages = $pages_handler->get($id);
						if (!$pages_handler->delete($pages)) {
							redirect_header('index.php?op='.$op.'&fct=list&limit='.$limit.'&start='.$start.'&order='.$order.'&sort='.$sort.'&filter='.$filter, 10, _AM_MSG_PAGES_FAILEDTODELETE);
							exit(0);
						} else {
							redirect_header('index.php?op='.$op.'&fct=list&limit='.$limit.'&start='.$start.'&order='.$order.'&sort='.$sort.'&filter='.$filter, 10, _AM_MSG_PAGES_DELETED);
							exit(0);
						}
					} else {
						$pages = $pages_handler->get(intval($_REQUEST['id']));
						xoops_confirm(array('id'=>$_REQUEST['id'], 'op'=>$_REQUEST['op'], 'fct'=>$_REQUEST['fct'], 'limit'=>$_REQUEST['limit'], 'start'=>$_REQUEST['start'], 'order'=>$_REQUEST['order'], 'sort'=>$_REQUEST['sort'], 'filter'=>$_REQUEST['filter']), 'index.php', sprintf(_AM_MSG_PAGES_DELETE, $pages->getVar('filename')));
					}
					break;
			}
			break;
		case "chapters":	
			switch ($fct)
			{
				default:
				case "list":				
					pageflip_adminMenu(3);

					include_once $GLOBALS['xoops']->path( "/class/pagenav.php" );
					include_once $GLOBALS['xoops']->path( "/class/template.php" );
					
					$GLOBALS['pfTpl'] = new XoopsTpl();
					
					$chapters_handler =& xoops_getmodulehandler('chapters', 'pageflip');
					$criteria = $chapters_handler->getFilterCriteria($filter);
					$ttl = $chapters_handler->getCount($criteria);
					$sort = !empty($_REQUEST['sort'])?''.$_REQUEST['sort'].'':'created';
					
					$pagenav = new XoopsPageNav($ttl, $limit, $start, 'start', 'limit='.$limit.'&sort='.$sort.'&order='.$order.'&op='.$op.'&fct='.$fct.'&filter='.$filter.'&fct='.$fct.'&filter='.$filter);
					$GLOBALS['pfTpl']->assign('pagenav', $pagenav->renderNav());
					
					foreach (array(	'cid','bid','page','name','created','updated') as $id => $key) {
						$GLOBALS['pfTpl']->assign(strtolower(str_replace('-','_',$key).'_th'), '<a href="'.$_SERVER['PHP_SELF'].'?start='.$start.'&limit='.$limit.'&sort='.str_replace('_','-',$key).'&order='.((str_replace('_','-',$key)==$sort)?($order=='DESC'?'ASC':'DESC'):$order).'&op='.$op.'&filter='.$filter.'">'.(defined('_AM_PAGEFLIP_TH_'.strtoupper(str_replace('-','_',$key)))?constant('_AM_PAGEFLIP_TH_'.strtoupper(str_replace('-','_',$key))):'_AM_PAGEFLIP_TH_'.strtoupper(str_replace('-','_',$key))).'</a>');
						$GLOBALS['pfTpl']->assign('filter_'.strtolower(str_replace('-','_',$key)).'_th', $chapters_handler->getFilterForm($filter, $key, $sort, $op, $fct));
					}
					
					$GLOBALS['pfTpl']->assign('limit', $limit);
					$GLOBALS['pfTpl']->assign('start', $start);
					$GLOBALS['pfTpl']->assign('order', $order);
					$GLOBALS['pfTpl']->assign('sort', $sort);
					$GLOBALS['pfTpl']->assign('filter', $filter);
					$GLOBALS['pfTpl']->assign('xoConfig', $GLOBALS['xoopsModuleConfig']);
					
					$criteria->setStart($start);
					$criteria->setLimit($limit);
					$criteria->setSort('`'.$sort.'`');
					$criteria->setOrder($order);
					
					$chapterss = $chapters_handler->getObjects($criteria, true);
					foreach($chapterss as $cid => $chapters) {
						if (is_object($chapters))
							$GLOBALS['pfTpl']->append('chapters', $chapters->toArray());
					}
					
					$GLOBALS['pfTpl']->assign('form', pageflip_chapters_get_form(false));
					$GLOBALS['pfTpl']->assign('php_self', $_SERVER['PHP_SELF']);
					$GLOBALS['pfTpl']->display('db:pageflip_cpanel_chapters_list.html');
					break;		
					
				case "new":
				case "edit":
					
					pageflip_adminMenu(3);
					
					include_once $GLOBALS['xoops']->path( "/class/pagenav.php" );
					include_once $GLOBALS['xoops']->path( "/class/template.php" );
					$GLOBALS['pfTpl'] = new XoopsTpl();
					
					$chapters_handler =& xoops_getmodulehandler('chapters', 'pageflip');
					if (isset($_REQUEST['id'])) {
						$chapters = $chapters_handler->get(intval($_REQUEST['id']));
					} else {
						$chapters = $chapters_handler->create();
					}
					
					$GLOBALS['pfTpl']->assign('form', $chapters->getForm());
					$GLOBALS['pfTpl']->assign('php_self', $_SERVER['PHP_SELF']);
					$GLOBALS['pfTpl']->display('db:pageflip_cpanel_chapters_edit.html');
					break;
				case "save":
					
					$chapters_handler =& xoops_getmodulehandler('chapters', 'pageflip');
					$id=0;
					if ($id=intval($_REQUEST['id'])) {
						$chapters = $chapters_handler->get($id);
					} else {
						$chapters = $chapters_handler->create();
					}
					$chapters->setVars($_POST[$id]);
					if (!$id=$chapters_handler->insert($chapters)) {
						redirect_header('index.php?op='.$op.'&fct=list&limit='.$limit.'&start='.$start.'&order='.$order.'&sort='.$sort.'&filter='.$filter, 10, _AM_MSG_CHAPTERS_FAILEDTOSAVE);
						exit(0);
					} else {
						switch($_REQUEST['mode']) {
							case 'new':
								redirect_header('index.php?op='.$op.'&fct=edit&id='.$id, 10, _AM_MSG_CHAPTERS_SAVEDOKEY);
								break;
							default:
							case 'edit':
								redirect_header('index.php?op='.$op.'&fct=list&limit='.$limit.'&start='.$start.'&order='.$order.'&sort='.$sort.'&filter='.$filter, 10, _AM_MSG_CHAPTERS_SAVEDOKEY);
								break;
						}
						exit(0);					
					}
					break;
				case "savelist":
					
					$chapters_handler =& xoops_getmodulehandler('chapters', 'pageflip');
					foreach($_REQUEST['id'] as $id) {
						$chapters = $chapters_handler->get($id);
						$chapters->setVars($_POST[$id]);
						if (!$chapters_handler->insert($chapters)) {
							redirect_header('index.php?op='.$op.'&fct=list&limit='.$limit.'&start='.$start.'&order='.$order.'&sort='.$sort.'&filter='.$filter, 10, _AM_MSG_CHAPTERS_FAILEDTOSAVE);
							exit(0);
						} 
					}
					redirect_header('index.php?op='.$op.'&fct=list&limit='.$limit.'&start='.$start.'&order='.$order.'&sort='.$sort.'&filter='.$filter, 10, _AM_MSG_CHAPTERS_SAVEDOKEY);
					exit(0);
					break;				
				case "delete":	
								
					$chapters_handler =& xoops_getmodulehandler('chapters', 'pageflip');
					$id=0;
					if (isset($_POST['id'])&&$id=intval($_POST['id'])) {
						$chapters = $chapters_handler->get($id);
						if (!$chapters_handler->delete($chapters)) {
							redirect_header('index.php?op='.$op.'&fct=list&limit='.$limit.'&start='.$start.'&order='.$order.'&sort='.$sort.'&filter='.$filter, 10, _AM_MSG_CHAPTERS_FAILEDTODELETE);
							exit(0);
						} else {
							redirect_header('index.php?op='.$op.'&fct=list&limit='.$limit.'&start='.$start.'&order='.$order.'&sort='.$sort.'&filter='.$filter, 10, _AM_MSG_CHAPTERS_DELETED);
							exit(0);
						}
					} else {
						$chapters = $chapters_handler->get(intval($_REQUEST['id']));
						xoops_confirm(array('id'=>$_REQUEST['id'], 'op'=>$_REQUEST['op'], 'fct'=>$_REQUEST['fct'], 'limit'=>$_REQUEST['limit'], 'start'=>$_REQUEST['start'], 'order'=>$_REQUEST['order'], 'sort'=>$_REQUEST['sort'], 'filter'=>$_REQUEST['filter']), 'index.php', sprintf(_AM_MSG_CHAPTERS_DELETE, $chapters->getVar('title')));
					}
					break;
			}
			break;
		case "css":	
			switch ($fct)
			{
				default:
				case "list":				
					pageflip_adminMenu(4);

					include_once $GLOBALS['xoops']->path( "/class/pagenav.php" );
					include_once $GLOBALS['xoops']->path( "/class/template.php" );
					
					$GLOBALS['pfTpl'] = new XoopsTpl();
					
					$css_handler =& xoops_getmodulehandler('css', 'pageflip');
					$criteria = $css_handler->getFilterCriteria($filter);
					$ttl = $css_handler->getCount($criteria);
					$sort = !empty($_REQUEST['sort'])?''.$_REQUEST['sort'].'':'created';
					
					$pagenav = new XoopsPageNav($ttl, $limit, $start, 'start', 'limit='.$limit.'&sort='.$sort.'&order='.$order.'&op='.$op.'&fct='.$fct.'&filter='.$filter.'&fct='.$fct.'&filter='.$filter);
					$GLOBALS['pfTpl']->assign('pagenav', $pagenav->renderNav());
					
					foreach (array(	'cssid','bid','mode','css','hover','visited','reference','created','updated') as $id => $key) {
						$GLOBALS['pfTpl']->assign(strtolower(str_replace('-','_',$key).'_th'), '<a href="'.$_SERVER['PHP_SELF'].'?start='.$start.'&limit='.$limit.'&sort='.str_replace('_','-',$key).'&order='.((str_replace('_','-',$key)==$sort)?($order=='DESC'?'ASC':'DESC'):$order).'&op='.$op.'&filter='.$filter.'">'.(defined('_AM_PAGEFLIP_TH_'.strtoupper(str_replace('-','_',$key)))?constant('_AM_PAGEFLIP_TH_'.strtoupper(str_replace('-','_',$key))):'_AM_PAGEFLIP_TH_'.strtoupper(str_replace('-','_',$key))).'</a>');
						$GLOBALS['pfTpl']->assign('filter_'.strtolower(str_replace('-','_',$key)).'_th', $css_handler->getFilterForm($filter, $key, $sort, $op, $fct));
					}
					
					$GLOBALS['pfTpl']->assign('limit', $limit);
					$GLOBALS['pfTpl']->assign('start', $start);
					$GLOBALS['pfTpl']->assign('order', $order);
					$GLOBALS['pfTpl']->assign('sort', $sort);
					$GLOBALS['pfTpl']->assign('filter', $filter);
					$GLOBALS['pfTpl']->assign('xoConfig', $GLOBALS['xoopsModuleConfig']);
					
					$criteria->setStart($start);
					$criteria->setLimit($limit);
					$criteria->setSort('`'.$sort.'`');
					$criteria->setOrder($order);
					
					$csss = $css_handler->getObjects($criteria, true);
					foreach($csss as $cid => $css) {
						if (is_object($css))
							$GLOBALS['pfTpl']->append('css', $css->toArray());
					}
					
					$GLOBALS['pfTpl']->assign('form', pageflip_css_get_form(false));
					$GLOBALS['pfTpl']->assign('php_self', $_SERVER['PHP_SELF']);
					$GLOBALS['pfTpl']->display('db:pageflip_cpanel_css_list.html');
					break;		
					
				case "new":
				case "edit":
					
					pageflip_adminMenu(4);
					
					include_once $GLOBALS['xoops']->path( "/class/pagenav.php" );
					include_once $GLOBALS['xoops']->path( "/class/template.php" );
					$GLOBALS['pfTpl'] = new XoopsTpl();
					
					$css_handler =& xoops_getmodulehandler('css', 'pageflip');
					if (isset($_REQUEST['id'])) {
						$css = $css_handler->get(intval($_REQUEST['id']));
					} else {
						$css = $css_handler->create();
					}
					
					$GLOBALS['pfTpl']->assign('form', $css->getForm());
					$GLOBALS['pfTpl']->assign('php_self', $_SERVER['PHP_SELF']);
					$GLOBALS['pfTpl']->display('db:pageflip_cpanel_css_edit.html');
					break;
				case "save":
					
					$css_handler =& xoops_getmodulehandler('css', 'pageflip');
					$id=0;
					if ($id=intval($_REQUEST['id'])) {
						$css = $css_handler->get($id);
					} else {
						$css = $css_handler->create();
					}
					$css->setVars($_POST[$id]);
					if (!$id=$css_handler->insert($css)) {
						redirect_header('index.php?op='.$op.'&fct=list&limit='.$limit.'&start='.$start.'&order='.$order.'&sort='.$sort.'&filter='.$filter, 10, _AM_MSG_CSS_FAILEDTOSAVE);
						exit(0);
					} else {
						switch($_REQUEST['mode']) {
							case 'new':
								redirect_header('index.php?op='.$op.'&fct=edit&id='.$id, 10, _AM_MSG_CSS_SAVEDOKEY);
								break;
							default:
							case 'edit':
								redirect_header('index.php?op='.$op.'&fct=list&limit='.$limit.'&start='.$start.'&order='.$order.'&sort='.$sort.'&filter='.$filter, 10, _AM_MSG_CSS_SAVEDOKEY);
								break;
						}
						exit(0);					
					}
					break;
				case "savelist":
					
					$css_handler =& xoops_getmodulehandler('css', 'pageflip');
					foreach($_REQUEST['id'] as $id) {
						$css = $css_handler->get($id);
						$css->setVars($_POST[$id]);
						if (!$css_handler->insert($css)) {
							redirect_header('index.php?op='.$op.'&fct=list&limit='.$limit.'&start='.$start.'&order='.$order.'&sort='.$sort.'&filter='.$filter, 10, _AM_MSG_CSS_FAILEDTOSAVE);
							exit(0);
						} 
					}
					redirect_header('index.php?op='.$op.'&fct=list&limit='.$limit.'&start='.$start.'&order='.$order.'&sort='.$sort.'&filter='.$filter, 10, _AM_MSG_CSS_SAVEDOKEY);
					exit(0);
					break;				
				case "delete":	
								
					$css_handler =& xoops_getmodulehandler('css', 'pageflip');
					$id=0;
					if (isset($_POST['id'])&&$id=intval($_POST['id'])) {
						$css = $css_handler->get($id);
						if (!$css_handler->delete($css)) {
							redirect_header('index.php?op='.$op.'&fct=list&limit='.$limit.'&start='.$start.'&order='.$order.'&sort='.$sort.'&filter='.$filter, 10, _AM_MSG_CSS_FAILEDTODELETE);
							exit(0);
						} else {
							redirect_header('index.php?op='.$op.'&fct=list&limit='.$limit.'&start='.$start.'&order='.$order.'&sort='.$sort.'&filter='.$filter, 10, _AM_MSG_CSS_DELETED);
							exit(0);
						}
					} else {
						$css = $css_handler->get(intval($_REQUEST['id']));
						xoops_confirm(array('id'=>$_REQUEST['id'], 'op'=>$_REQUEST['op'], 'fct'=>$_REQUEST['fct'], 'limit'=>$_REQUEST['limit'], 'start'=>$_REQUEST['start'], 'order'=>$_REQUEST['order'], 'sort'=>$_REQUEST['sort'], 'filter'=>$_REQUEST['filter']), 'index.php', sprintf(_AM_MSG_CSS_DELETE, $css->getVar('title')));
					}
					break;
			}
			break;			
	}
	
	pageflip_footer_adminMenu();
	xoops_cp_footer();
?>