<?php 
	
	$bid = (isset($_REQUEST['bid'])?intval($_REQUEST['bid']):exit(0));
	$block = (isset($_REQUEST['block'])?intval($_REQUEST['block']):0);
	
	require_once('../header.php');
	$GLOBALS['xoopsLogger']->activated = false;
	
	$books_handler =& xoops_getmodulehandler('books', 'pageflip');
	$book = $books_handler->get($bid);
	require_once($GLOBALS['xoops']->path('class/template.php'));
	$GLOBAL['xoopsTpl'] = new xoopsTpl();
		
	$GLOBAL['xoopsTpl']->assign('reference', $book->getReference($block));
	$GLOBAL['xoopsTpl']->assign('settings', $book->getSettings($block));
	$GLOBAL['xoopsTpl']->assign('css', $book->getCSS());
	$GLOBAL['xoopsTpl']->assign('pages', $book->getPages());
	$GLOBAL['xoopsTpl']->assign('chapters', $book->getChapters());
	$GLOBAL['xoopsTpl']->assign('printing', $book->getPrintingPages());
	$GLOBAL['xoopsTpl']->assign('zooms', $book->getZoomPages());
		
	header('Content-type: text/javascript');
	$GLOBAL['xoopsTpl']->display('db:pageflip_liquid_js.html');
?>
