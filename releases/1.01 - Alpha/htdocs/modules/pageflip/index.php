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
		$books = $book_handler->getObjects($criteria, false);
	}
	
	$criteria = new Criteria('language', $GLOBALS['xoopsConfig']['language']);
	$ttl = $book_handler->getCount($criteria);
	$pagenav = new PageNav($ttl, $limit, $start, 'start', 'limit='.$limit);
	$criteria->setStart($start);
	$criteria->setLimit($limit);
	
	$booksb = $book_handler->getObjects($criteria, true);
	
	$xoopsOption['template_main'] = 'book_index.html';
	include($GLOBALS['xoops']->path('/header.php'));
	$GLOBALS['xoopsTpl']->assign('php_self', $_SERVER['PHP_SELF']);
	
	if (count($booksb)>1) {
		$GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav());
		foreach($booksb as $bid => $bk) {
			$GLOBAL['xoopsTpl']->assign('books', $bk->toArray());
		}
	}
	
	if (is_object($books[0])) {
		$GLOBAL['xoopsTpl']->assign('reference', $books[0]->getReference(false));
		$GLOBAL['xoopsTpl']->assign('book', $books[0]->toArray());
		$GLOBALS['xoTheme']->addScript('', array('type'=>'text/javascript'), $books[0]->getJS(false));
	} elseif (is_object($book)) {
		$GLOBAL['xoopsTpl']->assign('reference', $book->getReference(false));
		$GLOBAL['xoopsTpl']->assign('book', $book->toArray());
		$GLOBALS['xoTheme']->addScript('', array('type'=>'text/javascript'), $book->getJS(false));
	} 
	
	include($GLOBALS['xoops']->path('/footer.php'));
?>