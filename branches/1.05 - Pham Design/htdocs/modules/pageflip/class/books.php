<?php

if (!defined('XOOPS_ROOT_PATH')) {
	exit();
}
/**
 * Class for Blue Room Xcenter
 * @author Simon Roberts <simon@xoops.org>
 * @copyright copyright (c) 2009-2003 XOOPS.org
 * @package kernel
 */
class PageflipBooks extends XoopsObject
{

	var $_cHandler = NULL;
	var $_cssHandler = NULL;
	var $_pHandler = NULL;
	var $_ModConfig = NULL;
	var $_Mod = NULL;
	
	// Fields that are a setting
	var $_settingfields = array('stageWidth', 'stageHeight', 'bookWidth', 'bookHeight', 'scaleContent', 'centerContent',
								'preserveProportions', 'hardcover', 'hardcoverThickness', 'hardcoverEdgeColor', 'highlightHardcover',
								'frameWidth', 'frameColor', 'frameAlpha', 'firstPageNumber', 'autoFlipSize',
								'navigationFlipOffset', 'flipOnClick', 'handOverCorner', 'handOverPage', 'alwaysOpened',
								'staticShadowsType', 'staticShadowsDepth', 'staticShadowsDarkColor', 'staticShadowsLightColor', 'dynamicShadowsDepth',
								'dynamicShadowsDarkColor', 'dynamicShadowsLightColor', 'moveSpeed', 'gotoSpeed', 'rigidPageSpeed',
								'flipSound', 'hardcoverSound', 'preloaderType', 'pageBackgroundColor', 'loadOnDemand',
								'allowPagesUnload', 'showUnderlyingPages', 'playOnDemand', 'freezeOnFlip', 'darkPages',
								'smoothPages', 'rigidPages', 'flipCornerStyle', 'flipCornerPosition', 'flipCornerAmount',
								'flipCornerAngle', 'flipCornerRelease', 'flipCornerVibrate', 'flipCornerPlaySound', 'zoomEnabled',
								'zoomImageWidth', 'zoomImageHeight', 'zoomOnClick', 'zoomUIColor', 'zoomHint',
								'centerBook', 'useCustomCursors', 'dropShadowsEnabled', 'dropShadowsHideWhenFlipping', 'backgroundImage',
								'backgroundImagePlacement', 'printEnabled', 'printTitle', 'downloadURL', 'downloadTitle',
								'downloadSize', 'downloadComplete', 'backgroundColor', 'closeSpeed', 'zoomHintEnabled');
	
    function PageflipBooks($id = null)
    {
    	$config_handler = xoops_gethandler('config');
		$module_handler = xoops_gethandler('module');
		$this->_Mod = $module_handler->getByDirname('pageflip');
		$this->_ModConfig = $config_handler->getConfigList($this->_Mod->getVar('mid'));
		
		$this->_cHandler = xoops_getmodulehandler('chapters', 'pageflip');
		$this->_cssHandler = xoops_getmodulehandler('css', 'pageflip');
		$this->_pHandler = xoops_getmodulehandler('pages', 'pageflip');
		
        $this->initVar('bid', XOBJ_DTYPE_INT, null, false);
        $this->initVar('cids', XOBJ_DTYPE_ARRAY, array(), false);
        $this->initVar('pids', XOBJ_DTYPE_ARRAY, array(), false);
		$this->initVar('name', XOBJ_DTYPE_TXTBOX, null, false, 128);
		$this->initVar('reference', XOBJ_DTYPE_TXTBOX, 'fb_%id%_', false, 128);
		$this->initVar('description', XOBJ_DTYPE_TXTBOX, null, false, 500);
		$this->initVar('language', XOBJ_DTYPE_TXTBOX, $GLOBALS['xoopsConfig']['language'], false, 64);
		$this->initVar('default', XOBJ_DTYPE_INT, 0, false);
		$this->initVar('pages', XOBJ_DTYPE_INT, 0, false);
		$this->initVar('chapters', XOBJ_DTYPE_INT, 0, false);
		$this->initVar('stageWidth', XOBJ_DTYPE_INT, 100, false);
		$this->initVar('stageHeight', XOBJ_DTYPE_INT, 100, false);
		$this->initVar('bookWidth', XOBJ_DTYPE_INT, 640, false);
		$this->initVar('bookHeight', XOBJ_DTYPE_INT, 640, false);
        $this->initVar('scaleContent', XOBJ_DTYPE_ENUM, '_MI_PAGEFLIP_TRUE', false, false, false, array('_MI_PAGEFLIP_TRUE','_MI_PAGEFLIP_FALSE'));
        $this->initVar('centerContent', XOBJ_DTYPE_ENUM, '_MI_PAGEFLIP_TRUE', false, false, false, array('_MI_PAGEFLIP_TRUE','_MI_PAGEFLIP_FALSE'));
        $this->initVar('preserveProportions', XOBJ_DTYPE_ENUM, '_MI_PAGEFLIP_TRUE', false, false, false, array('_MI_PAGEFLIP_TRUE','_MI_PAGEFLIP_FALSE'));
        $this->initVar('hardcover', XOBJ_DTYPE_ENUM, '_MI_PAGEFLIP_FALSE', false, false, false, array('_MI_PAGEFLIP_TRUE','_MI_PAGEFLIP_FALSE'));
        $this->initVar('hardcoverThickness', XOBJ_DTYPE_INT, 3, false);
        $this->initVar('hardcoverEdgeColor', XOBJ_DTYPE_TXTBOX, 'FFFFFF', false, 6);
        $this->initVar('highlightHardcover', XOBJ_DTYPE_ENUM, '_MI_PAGEFLIP_TRUE', false, false, false, array('_MI_PAGEFLIP_TRUE','_MI_PAGEFLIP_FALSE'));
        $this->initVar('frameWidth', XOBJ_DTYPE_INT, 0, false);
        $this->initVar('frameColor', XOBJ_DTYPE_TXTBOX, 'FFFFFF', false, 6);
        $this->initVar('frameAlpha', XOBJ_DTYPE_INT, 100, false);
        $this->initVar('firstPageNumber', XOBJ_DTYPE_INT, 1, false);
        $this->initVar('autoFlipSize', XOBJ_DTYPE_INT, 50, false);
        $this->initVar('navigationFlipOffset', XOBJ_DTYPE_INT, 30, false);
        $this->initVar('flipOnClick', XOBJ_DTYPE_ENUM, '_MI_PAGEFLIP_TRUE', false, false, false, array('_MI_PAGEFLIP_TRUE','_MI_PAGEFLIP_FALSE'));
        $this->initVar('handOverCorner', XOBJ_DTYPE_ENUM, '_MI_PAGEFLIP_TRUE', false, false, false, array('_MI_PAGEFLIP_TRUE','_MI_PAGEFLIP_FALSE'));
        $this->initVar('handOverPage', XOBJ_DTYPE_ENUM, '_MI_PAGEFLIP_TRUE', false, false, false, array('_MI_PAGEFLIP_TRUE','_MI_PAGEFLIP_FALSE'));
        $this->initVar('alwaysOpened', XOBJ_DTYPE_ENUM, '_MI_PAGEFLIP_FALSE', false, false, false, array('_MI_PAGEFLIP_TRUE','_MI_PAGEFLIP_FALSE'));
        $this->initVar('staticShadowsType', XOBJ_DTYPE_ENUM, '_MI_PAGEFLIP_ASYMMETRIC', false, false, false, array('_MI_PAGEFLIP_ASYMMETRIC','_MI_PAGEFLIP_SYMMETRIC','_MI_PAGEFLIP_DEFAULT'));
        $this->initVar('staticShadowsDepth', XOBJ_DTYPE_INT, 1, false);
        $this->initVar('staticShadowsDarkColor', XOBJ_DTYPE_TXTBOX, '000000', false, 6);
        $this->initVar('staticShadowsLightColor', XOBJ_DTYPE_TXTBOX, 'FFFFFF', false, 6);
        $this->initVar('dynamicShadowsDepth', XOBJ_DTYPE_INT, 1, false);
        $this->initVar('dynamicShadowsDarkColor', XOBJ_DTYPE_TXTBOX, '000000', false, 6);
        $this->initVar('dynamicShadowsLightColor', XOBJ_DTYPE_TXTBOX, 'FFFFFF', false, 6);
        $this->initVar('moveSpeed', XOBJ_DTYPE_INT, 2, false);
        $this->initVar('gotoSpeed', XOBJ_DTYPE_INT, 3, false);
        $this->initVar('closeSpeed', XOBJ_DTYPE_INT, 3, false);
        $this->initVar('rigidPageSpeed', XOBJ_DTYPE_INT, 5, false);
        $this->initVar('flipSound', XOBJ_DTYPE_TXTBOX, '', false, 255);
        $this->initVar('hardcoverSound', XOBJ_DTYPE_TXTBOX, '', false, 255);
        $this->initVar('preloaderType', XOBJ_DTYPE_ENUM, '_MI_PAGEFLIP_THIN', false, false, false, array('_MI_PAGEFLIP_PROGESSBAR','_MI_PAGEFLIP_ROUND','_MI_PAGEFLIP_THIN','_MI_PAGEFLIP_DOTS','_MI_PAGEFLIP_GRADIENTWHEEL','_MI_PAGEFLIP_GEARWHEEL','_MI_PAGEFLIP_LINE','_MI_PAGEFLIP_ANIMATEDBOOK','_MI_PAGEFLIP_NONE'));
		$this->initVar('pageBackgroundColor', XOBJ_DTYPE_TXTBOX, '99CCFF', false, 6);
		$this->initVar('loadOnDemand', XOBJ_DTYPE_ENUM, '_MI_PAGEFLIP_TRUE', false, false, false, array('_MI_PAGEFLIP_TRUE','_MI_PAGEFLIP_FALSE'));
		$this->initVar('allowPagesUnload', XOBJ_DTYPE_ENUM, '_MI_PAGEFLIP_TRUE', false, false, false, array('_MI_PAGEFLIP_TRUE','_MI_PAGEFLIP_FALSE'));
		$this->initVar('showUnderlyingPages', XOBJ_DTYPE_ENUM, '_MI_PAGEFLIP_FALSE', false, false, false, array('_MI_PAGEFLIP_TRUE','_MI_PAGEFLIP_FALSE'));
		$this->initVar('playOnDemand', XOBJ_DTYPE_ENUM, '_MI_PAGEFLIP_FALSE', false, false, false, array('_MI_PAGEFLIP_TRUE','_MI_PAGEFLIP_FALSE'));
		$this->initVar('freezeOnFlip', XOBJ_DTYPE_ENUM, '_MI_PAGEFLIP_FALSE', false, false, false, array('_MI_PAGEFLIP_TRUE','_MI_PAGEFLIP_FALSE'));
		$this->initVar('darkPages', XOBJ_DTYPE_ENUM, '_MI_PAGEFLIP_FALSE', false, false, false, array('_MI_PAGEFLIP_TRUE','_MI_PAGEFLIP_FALSE'));
		$this->initVar('smoothPages', XOBJ_DTYPE_ENUM, '_MI_PAGEFLIP_FALSE', false, false, false, array('_MI_PAGEFLIP_TRUE','_MI_PAGEFLIP_FALSE'));
		$this->initVar('rigidPages', XOBJ_DTYPE_ENUM, '_MI_PAGEFLIP_FALSE', false, false, false, array('_MI_PAGEFLIP_TRUE','_MI_PAGEFLIP_FALSE'));
		$this->initVar('flipCornerStyle', XOBJ_DTYPE_ENUM, '_MI_PAGEFLIP_MANUALLY', false, false, false, array('_MI_PAGEFLIP_FIRSTPAGEONLY','_MI_PAGEFLIP_EACHPAGE','_MI_PAGEFLIP_MANUALLY'));
		$this->initVar('flipCornerPosition', XOBJ_DTYPE_ENUM, '_MI_PAGEFLIP_BOTTOMRIGHT', false, false, false, array('_MI_PAGEFLIP_BOTTOMRIGHT','_MI_PAGEFLIP_TOPRIGHT','_MI_PAGEFLIP_BOTTOMLEFT','_MI_PAGEFLIP_TOPLEFT'));
        $this->initVar('flipCornerAmount', XOBJ_DTYPE_INT, 50, false); 
		$this->initVar('flipCornerAngle', XOBJ_DTYPE_INT, 20, false); 
		$this->initVar('flipCornerRelease', XOBJ_DTYPE_ENUM, '_MI_PAGEFLIP_TRUE', false, false, false, array('_MI_PAGEFLIP_TRUE','_MI_PAGEFLIP_FALSE'));
		$this->initVar('flipCornerVibrate', XOBJ_DTYPE_ENUM, '_MI_PAGEFLIP_TRUE', false, false, false, array('_MI_PAGEFLIP_TRUE','_MI_PAGEFLIP_FALSE'));
		$this->initVar('flipCornerPlaySound', XOBJ_DTYPE_ENUM, '_MI_PAGEFLIP_FALSE', false, false, false, array('_MI_PAGEFLIP_TRUE','_MI_PAGEFLIP_FALSE'));
		$this->initVar('zoomEnabled', XOBJ_DTYPE_ENUM, '_MI_PAGEFLIP_TRUE', false, false, false, array('_MI_PAGEFLIP_TRUE','_MI_PAGEFLIP_FALSE'));
		$this->initVar('zoomImageWidth', XOBJ_DTYPE_INT, 900, false);
		$this->initVar('zoomImageHeight', XOBJ_DTYPE_INT, 1125, false);
		$this->initVar('zoomOnClick', XOBJ_DTYPE_ENUM, '_MI_PAGEFLIP_TRUE', false, false, false, array('_MI_PAGEFLIP_TRUE','_MI_PAGEFLIP_FALSE'));
		$this->initVar('zoomUIColor', XOBJ_DTYPE_TXTBOX, '8F9EA6', false, 6);
		$this->initVar('zoomHint', XOBJ_DTYPE_TXTBOX, 'Use double click for zooming in!', false, 255);
		$this->initVar('zoomHintEnabled', XOBJ_DTYPE_ENUM, '_MI_PAGEFLIP_TRUE', false, false, false, array('_MI_PAGEFLIP_TRUE','_MI_PAGEFLIP_FALSE'));
		$this->initVar('centerBook', XOBJ_DTYPE_ENUM, '_MI_PAGEFLIP_TRUE', false, false, false, array('_MI_PAGEFLIP_TRUE','_MI_PAGEFLIP_FALSE'));
		$this->initVar('useCustomCursors', XOBJ_DTYPE_ENUM, '_MI_PAGEFLIP_FALSE', false, false, false, array('_MI_PAGEFLIP_TRUE','_MI_PAGEFLIP_FALSE'));
		$this->initVar('dropShadowsEnabled', XOBJ_DTYPE_ENUM, '_MI_PAGEFLIP_TRUE', false, false, false, array('_MI_PAGEFLIP_TRUE','_MI_PAGEFLIP_FALSE'));
		$this->initVar('dropShadowsHideWhenFlipping', XOBJ_DTYPE_ENUM, '_MI_PAGEFLIP_TRUE', false, false, false, array('_MI_PAGEFLIP_TRUE','_MI_PAGEFLIP_FALSE'));
		$this->initVar('backgroundColor', XOBJ_DTYPE_TXTBOX, 'FFFFFF', false, 6);
		$this->initVar('backgroundImage', XOBJ_DTYPE_TXTBOX, '', false, 255);
		$this->initVar('backgroundImagePlacement', XOBJ_DTYPE_ENUM, '_MI_PAGEFLIP_FIT', false, false, false, array('_MI_PAGEFLIP_TOP_LEFT','_MI_PAGEFLIP_CENTER','_MI_PAGEFLIP_FIT'));
		$this->initVar('printEnabled', XOBJ_DTYPE_ENUM, '_MI_PAGEFLIP_TRUE', false, false, false, array('_MI_PAGEFLIP_TRUE','_MI_PAGEFLIP_FALSE'));
		$this->initVar('printTitle', XOBJ_DTYPE_TXTBOX, '', false, 255);
		$this->initVar('downloadURL', XOBJ_DTYPE_TXTBOX, '', false, 500);
		$this->initVar('downloadTitle', XOBJ_DTYPE_TXTBOX, '', false, 128);
		$this->initVar('downloadSize', XOBJ_DTYPE_TXTBOX, '', false, 128);
		$this->initVar('downloadComplete', XOBJ_DTYPE_TXTBOX, '', false, 128);
		$this->initVar('uid', XOBJ_DTYPE_INT, 0, false);
		$this->initVar('created', XOBJ_DTYPE_INT, 0, false);
		$this->initVar('updated', XOBJ_DTYPE_INT, 0, false);
		$this->initVar('actioned', XOBJ_DTYPE_INT, 0, false);
    }
    
    function setCids() {
    	$criteria = new Criteria('bid', $this->getVar('bid'));
    	$cids = array();
    	foreach($this->_cHandler->getObjects($criteria, true) as $cid => $obj)
    		$cids[$cid] = $cid;
    	$this->setVar('cids', $cids);
    	$this->setVar('chapters', count($cids));
    }
    
	function setPids() {
    	$criteria = new Criteria('bid', $this->getVar('bid'));
    	$pids = array();
    	foreach($this->_pHandler->getObjects($criteria, true) as $pid => $obj)
    		$pids[$pid] = $pid;
    	$this->setVar('pids', $pids);
    	$this->setVar('pages', count($pids));
    }
    
    function getCSS() {
    	$criteria = new CriteriaCompo(new Criteria('bid', $this->getVar('bid')));
    	$cssarr = array();
    	foreach($this->_cssHandler->getObjects($criteria, true) as $cssid => $css) {
    		$cssarr[$cssid] = $css->toSmarty();
    	}
    	return (!empty($cssarr)?$cssarr:false);
    }
    
	function getPages() {
    	$criteria = new CriteriaCompo(new Criteria('bid', $this->getVar('bid')));
    	$criteria->setSort('`page`, `created`');
    	$criteria->setOrder('ASC');
    	$pages = array();
    	$total = $this->_pHandler->getCount($criteria);
    	$i=0;
    	foreach($this->_pHandler->getObjects($criteria, true) as $pid => $page) {
    		$i++;
    		$pages[$pid]['url'] = $page->getImageURL();
    		$pages[$pid]['last'] = ($total==$i?true:false);
    	}
    	return (count($pages)>0?$pages:false);
    }
    
	function getPrintingPages() {
    	$criteria = new CriteriaCompo(new Criteria('bid', $this->getVar('bid')));
    	$criteria->setSort('`page`, `created`');
    	$criteria->setOrder('ASC');
    	$pages = array();
    	$total = $this->_pHandler->getCount($criteria);
    	$i=0;
    	foreach($this->_pHandler->getObjects($criteria, true) as $pid => $page) {
    		$i++;
    		$pages[$pid]['url'] = $page->getPrintURL();
    		$pages[$pid]['last'] = ($total==$i?true:false);
    	}
    	return (count($pages)>0?$pages:false);
    }
    
	function getZoomPages() {
    	$criteria = new CriteriaCompo(new Criteria('bid', $this->getVar('bid')));
    	$criteria->setSort('`page`, `created`');
    	$criteria->setOrder('ASC');
    	$pages = array();
    	$total = $this->_pHandler->getCount($criteria);
    	$i=0;
    	foreach($this->_pHandler->getObjects($criteria, true) as $pid => $page) {
    		$i++;
    		$pages[$pid]['url'] = $page->getZoomURL();
    		$pages[$pid]['last'] = ($total==$i?true:false);
    	}
    	return (count($pages)>0?$pages:false);
    }

	function getPDFPages() {
    	$criteria = new CriteriaCompo(new Criteria('bid', $this->getVar('bid')));
    	$criteria->setSort('`page`, `created`');
    	$criteria->setOrder('ASC');
    	$pages = array();
    	$total = $this->_pHandler->getCount($criteria);
    	$i=0;
    	foreach($this->_pHandler->getObjects($criteria, true) as $pid => $page) {
    		$i++;
    		$pages[$pid]['url'] = $page->getPDFURL();
    		$pages[$pid]['last'] = ($total==$i?true:false);
    	}
    	return (count($pages)>0?$pages:false);
    }
    
	function getChapters() {
    	$criteria = new CriteriaCompo(new Criteria('bid', $this->getVar('bid')));
    	$criteria->setSort('`page`, `created`');
    	$criteria->setOrder('ASC');
    	$chapters = array();
    	$total = $this->_cHandler->getCount($criteria);
    	$i=0;
    	foreach($this->_cHandler->getObjects($criteria, true) as $cid => $chapter) {
    		$i++;
    		$chapters[$cid]['name'] = $chapter->getVar('name');
    		$chapters[$cid]['page'] = $chapter->getVar('page');
    		$chapters[$cid]['last'] = ($total==$i?true:false);
    	}
    	return (count($chapters)>0?$chapters:false);
    }
    
    function getSettings($block=false) {
    	$setting = array();
    	foreach(parent::toArray() as $field => $value) {
    		if (in_array($field, $this->_settingfields)) {
	    		if (defined($value.'_VALUE')) {
	    			$setting[$field] = constant($value.'_VALUE');
	    		} else {
	    			switch ($field) {
	    				case 'backgroundImage':
	    					if (file_exists(XOOPS_UPLOAD_PATH.$GLOBALS['xoopsModuleConfig']['uploaddir'].DS.'backgrounds'.DS.$value))
	    						$setting[$field] = XOOPS_UPLOAD_URL.$GLOBALS['xoopsModuleConfig']['uploaddir'].DS.'backgrounds'.DS.$value;
	    					break;
	    				case 'downloadURL':
	    					if (empty($value)&&$GLOBALS['xoopsModuleConfig']['auto_generate']==true) {
	    						$setting[$field] = $this->getPDFURL();
	    					} else {
	    						$setting[$field] = $value;
	    					}
	    					break;
	    				default:
	    					$setting[$field] = $value;
	    					break;
	    			}
	    		}
    		}
    	}
    	return $setting;
    }
    
    function getURL()
    {
    	return XOOPS_URL.'/modules/'._MI_PAGEFLIP_DIRNAME.'/?bid='.$this->getVar('bid');
    }
    
    function getPDFURL()
    {
    	return XOOPS_URL.'/modules/'._MI_PAGEFLIP_DIRNAME.'/pdf.php?bid='.$this->getVar('bid');
    }
    
    function getForm() {
    	return pageflip_books_get_form($this, false);
    }
    
    function toArray() {
    	$ret = parent::toArray();
    	foreach($ret as $field => $value) {
    		if (defined($value))
    			$ret[$field] = constant($value);
    	}
    	$ele = pageflip_books_get_form($this, true);
    	foreach($ele as $key => $field)
    		$ret['form'][$key] = $field->render();
    	$ret['url'] = $this->getURL();
    	$ret['pdf_url'] = $this->getPDFURL();
    	return $ret;
    }
     
    
    function getJS($block=false) {
    	static $_loadedJS = array();
    	static $_loadedCSS = array();
    	
    	xoops_loadLanguage('modinfo', 'pageflip');
    	
		if (is_object($GLOBALS['xoTheme'])&&$_loadedJS[$this->getVar('bid')]==false) {
			
			if ($_loadedJS[0]==false) {
				$GLOBALS['xoTheme']->addScript(XOOPS_URL._MI_PAGEFLIP_JS_SWFOBJECT, array('type'=>'text/javascript'));
				$GLOBALS['xoTheme']->addScript(XOOPS_URL._MI_PAGEFLIP_JS_WHEEL, array('type'=>'text/javascript'));
				$_loadedJS[0] = true;
			}
			
			$GLOBALS['xoTheme']->addScript(sprintf(XOOPS_URL._MI_PAGEFLIP_JS_FLIPPINGBOOK, $this->getVar('bid'), $block), array('type'=>'text/javascript'));
			$GLOBALS['xoTheme']->addScript(sprintf(XOOPS_URL._MI_PAGEFLIP_JS_LIQUID, $this->getVar('bid'), $block), array('type'=>'text/javascript'));
			$_loadedJS[$this->getVar('bid')] = true;
			
			if (!isset($_loadedCSS[$this->getVar('bid')])||$_loadedCSS[$this->getVar('bid')]==false) {
				$GLOBALS['xoTheme']->addStylesheet(XOOPS_URL.sprintf(_MI_PAGEFLIP_CSS_LIQUID, $this->getVar('bid'), $block), array('type'=>'text/css'));
				$_loadedCSS[$this->getVar('bid')] = true;
			}
		}
    	return $this->getReference($block)."flippingBook.create();";
    }
    
    function getReference($block=false) {
    	if ($block==true)
    		return str_replace('%id%', $this->getVar('bid'), 'block_'.$this->getVar('reference'));
    	else
    		return str_replace('%id%', $this->getVar('bid'), $this->getVar('reference'));
    }

	function runInsertPlugin() {
		
		xoops_loadLanguage('plugins', 'pageflip');
		
		include_once($GLOBALS['xoops']->path('/modules/pageflip/plugins/'.constant('_MI_PAGEFLIP_BOOKS_PLUGINFILE').'.php'));

 		switch ('_MI_PAGEFLIP_BOOKS_PLUGIN') {
			case '_MI_PAGEFLIP_BOOKS_PLUGIN':
				$func = ucfirst(constant('_MI_PAGEFLIP_BOOKS_PLUGIN')).'InsertHook';
				break;
			default:
				return $this->getVar('bid');
				break;
		}
		
		if (function_exists($func))  {
			return @$func($this);
		}
		return $this->getVar('bid');
	}
	
	function runGetPlugin() {
				
		xoops_loadLanguage('plugins', 'pageflip');
		
		include_once($GLOBALS['xoops']->path('/modules/pageflip/plugins/'.constant('_MI_PAGEFLIP_BOOKS_PLUGINFILE').'.php'));

 		switch ('_MI_PAGEFLIP_BOOKS_PLUGIN') {
			case '_MI_PAGEFLIP_BOOKS_PLUGIN':
				$func = ucfirst(constant('_MI_PAGEFLIP_BOOKS_PLUGIN')).'GetHook';
				break;
			default:
				return $this;
				break;
		}
				
		if (function_exists($func))  {
			return @$func($this);
		}
		return $this;
	}
}


/**
* XOOPS policies handler class.
* This class is responsible for providing data access mechanisms to the data source
* of XOOPS user class objects.
*
* @author  Simon Roberts <simon@chronolabs.coop>
* @package kernel
*/
class PageflipBooksHandler extends XoopsPersistableObjectHandler
{

	var $_ModConfig = NULL;
	var $_Mod = NULL;

	var $_cHandler = NULL;
	var $_cssHandler = NULL;
	var $_pHandler = NULL;
	
	function __construct(&$db) 
    {
    	
		$config_handler = xoops_gethandler('config');
		$module_handler = xoops_gethandler('module');
		$this->_Mod = $module_handler->getByDirname('pageflip');
		$this->_ModConfig = $config_handler->getConfigList($this->_Mod->getVar('mid'));
	
    	$this->db = $db;
        parent::__construct($db, 'pageflip_books', 'PageflipBooks', "bid", "name");
    }
 	
    private function runGetArrayPlugin($row) {
		
		xoops_loadLanguage('plugins', 'pageflip');
		
		include_once($GLOBALS['xoops']->path('/modules/pageflip/plugins/'.constant('_MI_PAGEFLIP_BOOKS_PLUGINFILE').'.php'));

 		switch ('_MI_PAGEFLIP_BOOKS_PLUGIN') {
			case '_MI_PAGEFLIP_BOOKS_PLUGIN':
				$func = ucfirst(constant('_MI_PAGEFLIP_BOOKS_PLUGIN')).'GetArrayHook';
				break;
			default:
				return $row;
				break;
		}		
		if (function_exists($func))  {
			return @$func($row);
		}
		return $row;
	}
		
	private function resetDefault($object) {
		$sql = "UPDATE " . $GLOBALS['xoopsDB']->prefix('pageflip_books') . ' SET `default` = 0 WHERE `language` = "'.$object->getVar('language').'"';
		return $GLOBALS['xoopsDB']->queryF($sql);
	}
    
    function insert($obj, $force=true, $run_plugin = false) {
    	
    	$this->_cHandler = xoops_getmodulehandler('chapters', 'pageflip');
		$this->_cssHandler = xoops_getmodulehandler('css', 'pageflip');
		$this->_pHandler = xoops_getmodulehandler('pages', 'pageflip');
    	
       	if ($obj->isNew()) {
    		$obj->setVar('created', time());
    		if (is_object($GLOBALS['xoopsUser']))
    			$obj->setVar('uid', $GLOBALS['xoopsUser']->getVar('uid'));
    		$run_plugin = true;
    	} else {
    		$obj->setVar('updated', time());
    	}
    	if ($obj->vars['default']['changed']==true&&$obj->getVar('default')==true) {
    		$this->resetDefault($obj);
    	}
    	$obj->setCids();
    	$obj->setPids();
   		if ($run_plugin == true) {
    		$id = parent::insert($obj, $force);
    		$obj = parent::get($id);
    		if (is_object($obj)) {
	    		$ret = $obj->runInsertPlugin();
	    		return ($ret!=0)?$ret:$id;
    		} else {
    			return $id;
    		}
    	} else {
    		return parent::insert($obj, $force);
    	}
    }

    function delete($object, $force=true) {
		$this->_cHandler = xoops_getmodulehandler('chapters', 'pageflip');
		$this->_cssHandler = xoops_getmodulehandler('css', 'pageflip');
		$this->_pHandler = xoops_getmodulehandler('pages', 'pageflip');
    	$criteria = new Criteria('bid', $object->getVar('bid'));
    	foreach($this->_cHandler->getObjects($criteria, true) as $id => $obj)
    		$this->_cHandler->delete($obj);
    	foreach($this->_cssHandler->getObjects($criteria, true) as $id => $obj)
    		$this->_cssHandler->delete($obj);
    	foreach($this->_pHandler->getObjects($criteria, true) as $id => $obj)
    		$this->_pHandler->delete($obj);
    	return parent::delete($object, $force);
    }
    
    function get($id, $fields = '*', $run_plugin = true) {
    	$obj = parent::get($id, $fields);
    	$obj->setCids();
	    $obj->setPids();
    	if (is_object($obj)&&$run_plugin==true) {
    		return @$obj->runGetPlugin(false);
    	} elseif (is_array($obj)&&$run_plugin==true)
    		return $this->runGetArrayPlugin($obj);
    	else
    		return $obj;
    }
    
    function getObjects($criteria, $id_as_key=false, $as_object=true, $run_plugin = true) {
       	$objs = parent::getObjects($criteria, $id_as_key, $as_object);
    	foreach($objs as $id => $obj) {
    		$objs[$id]->setCids();
	    	$objs[$id]->setPids();
    		if (is_object($obj)&&$run_plugin==true) {
    			$objs[$id] = @$obj->runGetPlugin();   			
    		} elseif (is_array($obj)&&$run_plugin==true)
    			$objs[$id] = @$this->runGetArrayPlugin($obj);
    		if (empty($objs[$id])||($as_object==true&&!is_object($objs[$id])))
    			unset($objs[$id]);
    	}
    	return $objs;
    }
    
       
    function getFilterCriteria($filter) {
    	$parts = explode('|', $filter);
    	$criteria = new CriteriaCompo();
    	foreach($parts as $part) {
    		$var = explode(',', $part);
    		if (!empty($var[1])&&!is_numeric($var[0])) {
    			$object = $this->create();
    			if (		$object->vars[$var[0]]['data_type']==XOBJ_DTYPE_TXTBOX || 
    						$object->vars[$var[0]]['data_type']==XOBJ_DTYPE_TXTAREA) 	{
    				$criteria->add(new Criteria('`'.$var[0].'`', '%'.$var[1].'%', (isset($var[2])?$var[2]:'LIKE')));
    			} elseif (	$object->vars[$var[0]]['data_type']==XOBJ_DTYPE_INT || 
    						$object->vars[$var[0]]['data_type']==XOBJ_DTYPE_DECIMAL || 
    						$object->vars[$var[0]]['data_type']==XOBJ_DTYPE_FLOAT ) 	{
    				$criteria->add(new Criteria('`'.$var[0].'`', $var[1], (isset($var[2])?$var[2]:'=')));			
				} elseif (	$object->vars[$var[0]]['data_type']==XOBJ_DTYPE_ENUM ) 	{
    				$criteria->add(new Criteria('`'.$var[0].'`', $var[1], (isset($var[2])?$var[2]:'=')));    				
				} elseif (	$object->vars[$var[0]]['data_type']==XOBJ_DTYPE_ARRAY ) 	{
    				$criteria->add(new Criteria('`'.$var[0].'`', '%"'.$var[1].'";%', (isset($var[2])?$var[2]:'LIKE')));    				
				}
    		} elseif (!empty($var[1])&&is_numeric($var[0])) {
    			$criteria->add(new Criteria("'".$var[0]."'", $var[1]));
    		}
    	}
    	return $criteria;
    }
        
	function getFilterForm($filter, $field, $sort='created', $op = '', $fct = '') {
    	$ele = pageflip_getFilterElement($filter, $field, $sort, $op, $fct);
    	if (is_object($ele))
    		return $ele->render();
    	else 
    		return '&nbsp;';
    }
}

?>