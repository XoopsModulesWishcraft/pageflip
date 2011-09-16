<?php
	require_once('header.php');
	
	$mid = (isset($_GET['mid'])?intval($_GET['mid']):exit(0));
	$gid = (isset($_GET['gid'])?intval($_GET['gid']):exit(0));
	
	$maquee_handler = xoops_getmodulehandler('maquee', 'maquee');
	$gallery_handler = xoops_getmodulehandler('gallery', 'maquee');

	$maquee = $maquee_handler->get($mid);
	$gallery = $gallery_handler->get($gid);
	
	require_once($GLOBALS['xoops']->path(_MI_FRAMEWORK_WIDEIMAGE));

	$ratio_width = $gallery->getVar('width') / $maquee->getVar('width');
	$ratio_height = $gallery->getVar('height') / $maquee->getVar('height'); 
	
	if ($ratio_width>$ratio_height)
		$scale = $ratio_height/$ratio_width;
	else 
		$scale = $ratio_width/$ratio_height;
	
	if (file_exists($gallery->getVar('path').(substr($gallery->getVar('path'), strlen($gallery->getVar('path'))-1, 1)!=DIRECTORY_SEPARATOR?DIRECTORY_SEPARATOR:'').$gallery->getVar('filename'))) {
		$img = WideImage::load($gallery->getVar('path').(substr($gallery->getVar('path'), strlen($gallery->getVar('path'))-1, 1)!=DIRECTORY_SEPARATOR?DIRECTORY_SEPARATOR:'').$gallery->getVar('filename'));
		if ($GLOBALS['xoopsModuleConfig']['scale_images']&&$GLOBALS['xoopsModuleConfig']['auto_crop_images']) {
			$newImage = $img->resize($maquee->getVar('width')*$scale, $maquee->getVar('height')*$scale)->crop("center", "middle", $maquee->getVar('width'), $maquee->getVar('height'));
			$newImage->output('jpg', 99);
			exit(0);
		} elseif ($GLOBALS['xoopsModuleConfig']['scale_images']&&!$GLOBALS['xoopsModuleConfig']['auto_crop_images']) { 
			$newImage = $img->resize($maquee->getVar('width'), $maquee->getVar('height'));
			$newImage->output('jpg', 99);
			exit(0);
		} else {
			$img->output('jpg', 99);
			exit(0);
		}
	}
	
?>