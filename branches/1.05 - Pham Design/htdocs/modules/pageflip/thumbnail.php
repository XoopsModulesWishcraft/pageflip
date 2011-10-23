<?php
	ob_start();
	require_once('header.php');
	$GLOBALS['xoopsLogger']->activated = false;
	//header('Content-type: image/jpeg');
	
	$bid = (isset($_GET['bid'])?intval($_GET['bid']):0);
	$pid = (isset($_GET['pid'])?intval($_GET['pid']):0);
	$op = (isset($_GET['op'])?$_GET['op']:'thumbnail');
	
	if ($pid>0) {
		$pages_handler = xoops_getmodulehandler('pages', 'pageflip');
		$pages = $pages_handler->get($pid);
		switch($pages->getVar('location')) {
			case '_MI_PAGEFLIP_PATH_XOOPS_UPLOAD_PATH':
				$path = XOOPS_UPLOAD_PATH;
				break;
			case '_MI_PAGEFLIP_PATH_XOOPS_VAR_PATH':
				$path = XOOPS_VAR_PATH;
				break;
			case '_MI_PAGEFLIP_PATH_OTHER':
				$path = '';
				break;
		}
		
		$path .= (substr($pages->getVar('path'), 0, 1)!=DIRECTORY_SEPARATOR?DIRECTORY_SEPARATOR:'').$pages->getVar('path');
		$path .= (substr($path, strlen($path)-1, 1)!=DIRECTORY_SEPARATOR?DIRECTORY_SEPARATOR:'');
		$image = $path.$pages->getVar('filename');
		
	} elseif ($bid>0) {
		$pages_handler = xoops_getmodulehandler('pages', 'pageflip');
		$criteria = new CriteriaCompo(new Criteria('bid', $bid));
		$criteria->add(new Criteria('filetype', "('_MI_PAGEFLIP_FILETYPE_JPG','_MI_PAGEFLIP_FILETYPE_PNG','_MI_PAGEFLIP_FILETYPE_GIF')", 'IN'));
		$criteria->setSort(`page`, `created`);
		$criteria->setOrder('ASC');
		$criteria->setStart(0);
		$criteria->setLimit(1);
		$pages = $pages_handler->getObjects($criteria, false);
		if (is_object($pages[0])) {
			switch($pages[0]->getVar('location')) {
				case '_MI_PAGEFLIP_PATH_XOOPS_UPLOAD_PATH':
					$path = XOOPS_UPLOAD_PATH;
					break;
				case '_MI_PAGEFLIP_PATH_XOOPS_VAR_PATH':
					$path = XOOPS_VAR_PATH;
					break;
				case '_MI_PAGEFLIP_PATH_OTHER':
					$path = '';
					break;
			}
			
			$path .= (substr($pages[0]->getVar('path'), 0, 1)!=DIRECTORY_SEPARATOR?DIRECTORY_SEPARATOR:'').$pages[0]->getVar('path');
			$path .= (substr($path, strlen($path)-1, 1)!=DIRECTORY_SEPARATOR?DIRECTORY_SEPARATOR:'');
			$image = $path.$pages[0]->getVar('filename');
		}
	}

	$image = str_replace(array('/','\\'), DIRECTORY_SEPARATOR, $image);
	
	if (file_exists($image)) {
		require_once($GLOBALS['xoops']->path(_MI_PAGEFLIP_FRAMEWORK_WIDEIMAGE));
	
		if (file_exists($image)) {
			$img = WideImage::load($image);
			$newImage = $img->resize($GLOBALS['xoopsModuleConfig']['thumbnail_width'], $GLOBALS['xoopsModuleConfig']['thumbnail_height']);
			ob_end_clean();
			$newImage->output('jpg', 45);
			exit(0);
		}
	}	
?>