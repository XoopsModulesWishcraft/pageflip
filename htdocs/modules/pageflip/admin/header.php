<?php
	
	require_once (dirname(dirname(dirname(dirname(__FILE__)))).'/mainfile.php');
	
	require_once('../include/functions.php');
	require_once('../include/formobjects.pageflip.php');
	require_once('../include/forms.pageflip.php');
	require_once('../include/uploader.php');
	
	include('../../../include/cp_header.php');

	$config_handler = xoops_gethandler('config');
	$module_handler = xoops_gethandler('module');
	$GLOBALS['xoopsModule'] = $module_handler->getByDirname('pageflip');
	$GLOBALS['xoopsModuleConfig'] = $config_handler->getConfigList($GLOBALS['xoopsModule']->getVar('mid'));
?>