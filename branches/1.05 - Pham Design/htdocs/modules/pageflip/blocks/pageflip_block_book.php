<?php

function b_pageflip_block_book_show( $options )
{
	if (empty($options[0])||$options[0]==0)
		return false;
				
	$books_handler =& xoops_getmodulehandler('books', 'pageflip');
	
	$book = $books_handler->get($options[0]);
	
	$GLOBALS['xoTheme']->addScript('', array('type'=>'text/javascript'), $book->getJS(true));
	
	return array('reference'=>$pageflip->getReference(true));

}


function b_pageflip_block_book_edit( $options )
{
	include_once($GLOBALS['xoops']->path('/modules/pageflip/include/formobjects.pageflip.php'));

	$pageflip = new PageflipFormSelectBooks('', 'options[0]', $options[0], 1, false);
	$form = ""._BL_PAGEFLIP_BID."&nbsp;".$pageflip->render();

	return $form ;
}

?>