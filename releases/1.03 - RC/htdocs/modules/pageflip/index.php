<?php
	
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
	
	xoops_load('pagenav');
	
	
	$pagenav = new XoopsPageNav($ttl, $limit, $start, 'start', 'limit='.$limit);
	$criteria->setStart($start);
	$criteria->setLimit($limit);
	
	$booksb = $books_handler->getObjects($criteria, true);
	
		
	$xoopsOption['template_main'] = 'pageflip_index.html';
	require_once($GLOBALS['xoops']->path('header.php'));
	$GLOBALS['xoopsTpl']->assign('php_self', $_SERVER['PHP_SELF']);
	
	
	if (count($booksb)>1) {
		$GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav());
		foreach($booksb as $bid => $bk) {
			$GLOBAL['xoopsTpl']->assign('books', $bk->toArray());
		}
	}
	
	
	if (is_object($books[0])) {
		$GLOBALS['xoopsTpl']->assign('reference', $books[0]->getReference(false));
		$GLOBALS['xoopsTpl']->assign('book', $books[0]->toArray());
		$GLOBALS['xoTheme']->addScript('', array('type'=>'text/javascript'), $books[0]->getJS(false));
	} elseif (is_object($book)) {
		$GLOBALS['xoopsTpl']->assign('reference', $book->getReference(false));
		$GLOBALS['xoopsTpl']->assign('book', $book->toArray());
		$GLOBALS['xoTheme']->addScript('', array('type'=>'text/javascript'), $book->getJS(false));
	} 
	
	
	require_once($GLOBALS['xoops']->path('footer.php'));
?>