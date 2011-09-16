<?php
	require_once('header.php');
	
	$gid = (isset($_GET['gid'])?intval($_GET['gid']):exit(0));
	
	$gallery_handler = xoops_getmodulehandler('gallery', 'maquee');

	$gallery = $gallery_handler->get($gid);
	
	require_once($GLOBALS['xoops']->path(_MI_FRAMEWORK_WIDEIMAGE));

	if (file_exists($gallery->getVar('path').(substr($gallery->getVar('path'), strlen($gallery->getVar('path'))-1, 1)!=DIRECTORY_SEPARATOR?DIRECTORY_SEPARATOR:'').$gallery->getVar('filename'))) {
		$img = WideImage::load($gallery->getVar('path').(substr($gallery->getVar('path'), strlen($gallery->getVar('path'))-1, 1)!=DIRECTORY_SEPARATOR?DIRECTORY_SEPARATOR:'').$gallery->getVar('filename'));
		$newImage = $img->resize($GLOBALS['xoopsModuleConfig']['thumbnail_width'], $GLOBALS['xoopsModuleConfig']['thumbnail_height']);
		$newImage->output('jpg', 45);
		exit(0);
	}
	
?>