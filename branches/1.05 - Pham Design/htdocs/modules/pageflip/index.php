<?php
	ob_start();
		
	require_once('header.php');
	
	$bid = (isset($_REQUEST['bid'])?intval($_REQUEST['bid']):0);
	$start = (isset($_REQUEST['start'])?intval($_REQUEST['start']):0);
	$limit = (isset($_REQUEST['limit'])?intval($_REQUEST['limit']):15);
	
	
	$books_handler = xoops_getmodulehandler('books', 'pageflip');
	
	
	if ($bid<>0)
		$book = $books_handler->get($bid);
	
	if (!is_object($book)) {
		$criteria = new CriteriaCompo(new Criteria('`default`', true));
		$criteria->add(new Criteria('language', $GLOBALS['xoopsConfig']['language']));
		$books = $books_handler->getObjects($criteria, false);
	}
	
	$criteria = new Criteria('language', $GLOBALS['xoopsConfig']['language']);
	$ttl = $books_handler->getCount($criteria);
	
	include_once $GLOBALS['xoops']->path( "/class/pagenav.php" );
	
	$pagenav = new XoopsPageNav($ttl, $limit, $start, 'start', 'limit='.$limit);
	$criteria->setStart($start);
	$criteria->setLimit($limit);
	
	$booksb = $books_handler->getObjects($criteria, true);
	

	include_once $GLOBALS['xoops']->path( "/class/template.php" );
	$GLOBALS['pfTpl'] = new XoopsTpl();
	$GLOBALS['pfTpl']->assign('php_self', $_SERVER['PHP_SELF']);
	
	if (count($booksb)>1) {
		$GLOBALS['pfTpl']->assign('pagenav', $pagenav->renderNav());
		foreach($booksb as $bid => $bk) {
			$GLOBALS['pfTpl']->assign('books', $bk->toArray());
		}
	}
	
	if (is_object($books[0])) {
		$GLOBALS['pfTpl']->assign('reference', $books[0]->getReference('0'));
		$GLOBALS['pfTpl']->assign('book', $books[0]->toArray());
		$GLOBALS['pfTpl']->display('db:pageflip_index.html');
		$content = ob_get_clean();
		ob_end_clean();
		include($GLOBALS['xoops']->path('header.php'));
		$GLOBALS['xoTheme']->addScript('', array('type'=>'text/javascript'), $books[0]->getJS('0'));
	} elseif (is_object($book)) {
		$GLOBALS['pfTpl']->assign('reference', $book->getReference('0'));
		$GLOBALS['pfTpl']->assign('book', $book->toArray());
		$GLOBALS['pfTpl']->display('db:pageflip_index.html');
		$content = ob_get_clean();
		ob_end_clean();
		include($GLOBALS['xoops']->path('header.php'));
		$GLOBALS['xoTheme']->addScript('', array('type'=>'text/javascript'), $book->getJS('0'));
	} 
	echo $content;	
	include($GLOBALS['xoops']->path('footer.php'));
	
?>