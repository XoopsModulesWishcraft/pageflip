<?php 
	
	$bid = (isset($_REQUEST['bid'])?intval($_REQUEST['bid']):exit(0));
	$block = (isset($_REQUEST['block'])?intval($_REQUEST['block']):0);
	
	require_once('../header.php');
	
	$books_handler =& xoops_getmodulehandler('books', 'pageflip');
	$book = $books_handler->get($bid);
	require_once($GLOBALS['xoops']->path('class/template.php'));
	$GLOBAL['xoopsTpl'] = new xoopsTpl();
		
	$GLOBAL['xoopsTpl']->assign('reference', $books->getReference($block));
	$GLOBAL['xoopsTpl']->assign('settings', $books->getSettings($block));
	$GLOBAL['xoopsTpl']->assign('css', $books->getCSS());
	$GLOBAL['xoopsTpl']->assign('pages', $books->getPages());
	$GLOBAL['xoopsTpl']->assign('chapters', $books->getChapters());
	$GLOBAL['xoopsTpl']->assign('printing', $books->getPrintingPages());
	$GLOBAL['xoopsTpl']->assign('zooms', $books->getZoomPages());
		
	header('Content-type: text/javascript');
	$GLOBAL['xoopsTpl']->display('db:pageflip_liquid_js.html');
?>
