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

	var $_ModConfig = NULL;
	var $_Mod = NULL;
	
	var $_settingsfield = array('scaleContent', 'showStaticShadow', 'rigid', 'wide', 'playOnDemand', 
								'centerContent', 'w', 'h', 'freezeOnFlip', 'smooth',
								'dark');
	
    function PageflipBooks($id = null)
    {
    	$config_handler = xoops_gethandler('config');
		$module_handler = xoops_gethandler('module');
		$this->_Mod = $module_handler->getByDirname('pageflip');
		$this->_ModConfig = $config_handler->getConfigList($this->_Mod->getVar('mid'));
		
        $this->initVar('pid', XOBJ_DTYPE_INT, null, false);
        $this->initVar('bid', XOBJ_DTYPE_INT, null, false);
        $this->initVar('cid', XOBJ_DTYPE_INT, null, false);
        $this->initVar('lid', XOBJ_DTYPE_INT, null, false);
        $this->initVar('page', XOBJ_DTYPE_INT, null, false);
        $this->initVar('mode', XOBJ_DTYPE_ENUM, '_MI_PAGEFLIP_MODE_PORTTRAIT', false, false, false, array('_MI_PAGEFLIP_MODE_LANDSCAPE','_MI_PAGEFLIP_MODE_PORTTRAIT'));
        $this->initVar('location', XOBJ_DTYPE_ENUM, '_MI_PAGEFLIP_PATH_XOOPS_UPLOAD_PATH', false, false, false, array('_MI_PAGEFLIP_PATH_XOOPS_UPLOAD_PATH','_MI_PAGEFLIP_PATH_XOOPS_VAR_PATH','_MI_PAGEFLIP_PATH_OTHER'));        
		$this->initVar('path', XOBJ_DTYPE_TXTBOX, null, false, 128);
		$this->initVar('filename', XOBJ_DTYPE_TXTBOX, '', false, 128);
		$this->initVar('filetype', XOBJ_DTYPE_ENUM, '_MI_PAGEFLIP_FILETYPE_JPG', false, false, false, array('_MI_PAGEFLIP_FILETYPE_JPG','_MI_PAGEFLIP_FILETYPE_PNG','_MI_PAGEFLIP_FILETYPE_GIF','_MI_PAGEFLIP_FILETYPE_SWF'));
		$this->initVar('extension', XOBJ_DTYPE_TXTBOX, 'jpg', false, 5);
		$this->initVar('default', XOBJ_DTYPE_INT, 0, false);
		$this->initVar('width', XOBJ_DTYPE_INT, 0, false);
		$this->initVar('height', XOBJ_DTYPE_INT, 0, false);
		$this->initVar('size', XOBJ_DTYPE_INT, 100, false);
        $this->initVar('scaleContent', XOBJ_DTYPE_ENUM, '_MI_PAGEFLIP_DEFAULT', false, false, false, array('_MI_PAGEFLIP_TRUE','_MI_PAGEFLIP_FALSE','_MI_PAGEFLIP_DEFAULT'));
        $this->initVar('showStaticShadow', XOBJ_DTYPE_ENUM, '_MI_PAGEFLIP_DEFAULT', false, false, false, array('_MI_PAGEFLIP_TRUE','_MI_PAGEFLIP_FALSE','_MI_PAGEFLIP_DEFAULT'));
        $this->initVar('rigid', XOBJ_DTYPE_ENUM, '_MI_PAGEFLIP_DEFAULT', false, false, false, array('_MI_PAGEFLIP_TRUE','_MI_PAGEFLIP_FALSE','_MI_PAGEFLIP_DEFAULT'));
        $this->initVar('wide', XOBJ_DTYPE_ENUM, '_MI_PAGEFLIP_DEFAULT', false, false, false, array('_MI_PAGEFLIP_TRUE','_MI_PAGEFLIP_FALSE','_MI_PAGEFLIP_DEFAULT'));
        $this->initVar('playOnDemand', XOBJ_DTYPE_ENUM, '_MI_PAGEFLIP_DEFAULT', false, false, false, array('_MI_PAGEFLIP_TRUE','_MI_PAGEFLIP_FALSE','_MI_PAGEFLIP_DEFAULT'));
        $this->initVar('centerContent', XOBJ_DTYPE_ENUM, '_MI_PAGEFLIP_DEFAULT', false, false, false, array('_MI_PAGEFLIP_TRUE','_MI_PAGEFLIP_FALSE','_MI_PAGEFLIP_DEFAULT'));
        $this->initVar('w', XOBJ_DTYPE_INT, 0, false);
        $this->initVar('h', XOBJ_DTYPE_INT, 0, false);
        $this->initVar('freezeOnFlip', XOBJ_DTYPE_ENUM, '_MI_PAGEFLIP_DEFAULT', false, false, false, array('_MI_PAGEFLIP_TRUE','_MI_PAGEFLIP_FALSE','_MI_PAGEFLIP_DEFAULT'));
        $this->initVar('smooth', XOBJ_DTYPE_ENUM, '_MI_PAGEFLIP_DEFAULT', false, false, false, array('_MI_PAGEFLIP_TRUE','_MI_PAGEFLIP_FALSE','_MI_PAGEFLIP_DEFAULT'));
        $this->initVar('dark', XOBJ_DTYPE_ENUM, '_MI_PAGEFLIP_DEFAULT', false, false, false, array('_MI_PAGEFLIP_TRUE','_MI_PAGEFLIP_FALSE','_MI_PAGEFLIP_DEFAULT'));
        $this->initVar('uid', XOBJ_DTYPE_INT, 0, false);
		$this->initVar('created', XOBJ_DTYPE_INT, 0, false);
		$this->initVar('updated', XOBJ_DTYPE_INT, 0, false);
		$this->initVar('actioned', XOBJ_DTYPE_INT, 0, false);
    }
    
    function getImageURL() {
    	$url = XOOPS_URL.'/modules/'._MI_PAGEFLIP_DIRNAME.'/pages/page-'.$this->getVar('bid').'-'.$this->getVar('pid').'-'.$this->getVar('page');
    	switch($this->getVar('filetype')) {
    		default:
    		case '_MI_PAGEFLIP_FILETYPE_JPG':
    			$url .= '.jpg';
    			break;
    		case '_MI_PAGEFLIP_FILETYPE_PNG':
    			$url .= '.png';
    			break;
    		case '_MI_PAGEFLIP_FILETYPE_GIF':
    			$url .= '.gif';
    			break;
    		case '_MI_PAGEFLIP_FILETYPE_SWF':
    			$url .= '.swf';
    			break;
    	}	
    	$param = array();
    	foreach(parent::toArray() as $field => $value) {
    		if (in_array($field, $this->_settingsfield)) {
    			if ($value!=0&&$value!='_MI_PAGEFLIP_DEFAULT') {
    				if (defined($value.'_VALUE'))
    					$param[] = "$field=".constant($value.'_VALUE');
    				else 
    					$param[] = "$field=".$value;
    			}
    		}
    	}
    	if (count($param)>0) {
    		$url .= '?'.implode('&', $param);
    	}
    	return $url;
    }
    
	function getPrintURL() {
    	$url = XOOPS_URL.'/modules/'._MI_PAGEFLIP_DIRNAME.'/pages/print/page-'.$this->getVar('bid').'-'.$this->getVar('pid').'-'.$this->getVar('page');
    	switch($this->getVar('filetype')) {
    		default:
    		case '_MI_PAGEFLIP_FILETYPE_JPG':
    			$url .= '.jpg';
    			break;
    		case '_MI_PAGEFLIP_FILETYPE_PNG':
    			$url .= '.png';
    			break;
    		case '_MI_PAGEFLIP_FILETYPE_GIF':
    			$url .= '.gif';
    			break;
    		case '_MI_PAGEFLIP_FILETYPE_SWF':
    			$url .= '.swf';
    			break;
    	}	
    	$param = array();
    	foreach(parent::toArray() as $field => $value) {
    		if (in_array($field, $this->_settingsfield)) {
    			if ($value!=0&&$value!='_MI_PAGEFLIP_DEFAULT') {
    				if (defined($value.'_VALUE'))
    					$param[] = "$field=".constant($value.'_VALUE');
    				else 
    					$param[] = "$field=".$value;
    			}
    		}
    	}
    	if (count($param)>0) {
    		$url .= '?'.implode('&', $param);
    	}
    	return $url;
    }

    function getZoomURL() {
    	$url = XOOPS_URL.'/modules/'._MI_PAGEFLIP_DIRNAME.'/pages/large/page-'.$this->getVar('bid').'-'.$this->getVar('pid').'-'.$this->getVar('page');
    	switch($this->getVar('filetype')) {
    		default:
    		case '_MI_PAGEFLIP_FILETYPE_JPG':
    			$url .= '.jpg';
    			break;
    		case '_MI_PAGEFLIP_FILETYPE_PNG':
    			$url .= '.png';
    			break;
    		case '_MI_PAGEFLIP_FILETYPE_GIF':
    			$url .= '.gif';
    			break;
    		case '_MI_PAGEFLIP_FILETYPE_SWF':
    			$url .= '.swf';
    			break;
    	}	
    	$param = array();
    	foreach(parent::toArray() as $field => $value) {
    		if (in_array($field, $this->_settingsfield)) {
    			if ($value!=0&&$value!='_MI_PAGEFLIP_DEFAULT') {
    				if (defined($value.'_VALUE'))
    					$param[] = "$field=".constant($value.'_VALUE');
    				else 
    					$param[] = "$field=".$value;
    			}
    		}
    	}
    	if (count($param)>0) {
    		$url .= '?'.implode('&', $param);
    	}
    	return $url;
    }

    function getPDFURL() {
    	$url = XOOPS_URL.'/modules/'._MI_PAGEFLIP_DIRNAME.'/pages/pdf/page-'.$this->getVar('bid').'-'.$this->getVar('pid').'-'.$this->getVar('page');
    	switch($this->getVar('filetype')) {
    		default:
    		case '_MI_PAGEFLIP_FILETYPE_JPG':
    			$url .= '.jpg';
    			break;
    		case '_MI_PAGEFLIP_FILETYPE_PNG':
    			$url .= '.png';
    			break;
    		case '_MI_PAGEFLIP_FILETYPE_GIF':
    			$url .= '.gif';
    			break;
    		case '_MI_PAGEFLIP_FILETYPE_SWF':
    			return false;
    			break;
    	}	
    	return $url;
    }
    
    function getForm() {
    	return pageflip_pages_get_form($this, false);
    }
    
    function toArray() {
    	$ret = parent::toArray();
    	foreach($ret as $field => $value) {
    		if (defined($value))
    			$ret[$field] = constant($value);
    	}
    	$ele = pageflip_pages_get_form($this, true);
    	foreach($ele as $key => $field)
    		$ret['form'][$key] = $field->render();
    	
    	switch ($this->getVar('filetype')) {
			case '_MI_PAGEFLIP_FILETYPE_JPG':
			case '_MI_PAGEFLIP_FILETYPE_PNG':
			case '_MI_PAGEFLIP_FILETYPE_GIF':
				$ret['thumbnail'] = XOOPS_URL.'/modules/pageflip/thumbnail.php?pid='.$this->getVar('pid');
				break;	
    	}
    	
    	return $ret;
    }
     
	function runInsertPlugin() {
		
		xoops_loadLanguage('plugins', 'pageflip');
		
		include_once($GLOBALS['xoops']->path('/modules/pageflip/plugins/'.constant($this->getVar('filetype').'_PLUGINFILE').'.php'));

		switch ($this->getVar('filetype')) {
			case '_MI_PAGEFLIP_FILETYPE_JPG':
			case '_MI_PAGEFLIP_FILETYPE_PNG':
			case '_MI_PAGEFLIP_FILETYPE_GIF':
			case '_MI_PAGEFLIP_FILETYPE_SWF':
				$func = ucfirst(constant($this->getVar('filetype').'_PLUGIN')).'InsertHook';
				break;
			default:
				return $this->getVar('pid');
				break;
		}
		
		if (function_exists($func))  {
			return @$func($this);
		}
		return $this->getVar('pid');
	}
	
	function runGetPlugin() {
				
		xoops_loadLanguage('plugins', 'pageflip');
		
		include_once($GLOBALS['xoops']->path('/modules/pageflip/plugins/'.constant($this->getVar('filetype').'_PLUGINFILE').'.php'));

		switch ($this->getVar('filetype')) {
			case '_MI_PAGEFLIP_FILETYPE_JPG':
			case '_MI_PAGEFLIP_FILETYPE_PNG':
			case '_MI_PAGEFLIP_FILETYPE_GIF':
			case '_MI_PAGEFLIP_FILETYPE_SWF':
				$func = ucfirst(constant($this->getVar('filetype').'_PLUGIN')).'GetHook';
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
	
	function __construct(&$db) 
    {
		$config_handler = xoops_gethandler('config');
		$module_handler = xoops_gethandler('module');
		$this->_Mod = $module_handler->getByDirname('pageflip');
		$this->_ModConfig = $config_handler->getConfigList($this->_Mod->getVar('mid'));
    	
    	$this->db = $db;
        parent::__construct($db, 'pageflip_books', 'PageflipBooks', "pid", "filetype");
    }
	
 	private function runGetArrayPlugin($row) {
		
		xoops_loadLanguage('plugins', 'pageflip');
		
		include_once($GLOBALS['xoops']->path('/modules/pageflip/plugins/'.constant($row['filetype'].'_PLUGINFILE').'.php'));

 		switch ($row['filetype']) {
			case '_MI_PAGEFLIP_FILETYPE_JPG':
			case '_MI_PAGEFLIP_FILETYPE_PNG':
			case '_MI_PAGEFLIP_FILETYPE_GIF':
			case '_MI_PAGEFLIP_FILETYPE_SWF':
 				$func = ucfirst(constant($row['filetype'].'_PLUGIN')).'GetArrayHook';
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
    
	function insert($obj, $force=true, $run_plugin = false) {
       	if ($obj->isNew()) {
    		$obj->setVar('created', time());
    		if (is_object($GLOBALS['xoopsUser']))
    			$obj->setVar('uid', $GLOBALS['xoopsUser']->getVar('uid'));    		
    	} else {
    		$obj->setVar('updated', time());
    	}

    	if ($obj->getVar('width')>$obj->getVar('height')) {
    		$obj->setVar('mode', '_MI_PAGEFLIP_MODE_LANDSCAPE');
    		$obj->setVar('wide', '_MI_PAGEFLIP_TRUE');
    	} else {
    		$obj->setVar('mode', '_MI_PAGEFLIP_MODE_PORTRAIT');
    	}
    	
    	switch($obj->getVar('extension')) {
    		case 'swf':
    			$obj->setVar('filetype', '_MI_PAGEFLIP_FILETYPE_SWF');
    			break;
    		case 'gif':
    			$obj->setVar('filetype', '_MI_PAGEFLIP_FILETYPE_GIF');
    			break;
    		case 'png':
    			$obj->setVar('filetype', '_MI_PAGEFLIP_FILETYPE_PNG');
    			break;
    		default:
    		case 'jpg':
    		case 'jpeg':
    			$obj->setVar('filetype', '_MI_PAGEFLIP_FILETYPE_JPG');
    			break;
    	}
    	
    	if(strpos( ' '. $obj->getVar('path'), XOOPS_UPLOAD_PATH)>0) {
    		$obj->setVar('location', '_MI_PAGEFLIP_PATH_XOOPS_UPLOAD_PATH');
    		$obj->setVar('path',  str_replace(XOOPS_UPLOAD_PATH, '',  $obj->getVar('path')));
    	} elseif(strpos( ' '. $obj->getVar('path'), XOOPS_VAR_PATH)>0) {
    		$obj->setVar('location', '_MI_PAGEFLIP_PATH_XOOPS_VAR_PATH');
    		$obj->setVar('path',  str_replace(XOOPS_VAR_PATH, '',  $obj->getVar('path')));
    	} else {
    		$obj->setVar('location', '_MI_PAGEFLIP_PATH_OTHER');
    	}
    	
    	if ($obj->vars['filetype']['changed']==true) {
    		$run_plugin = true;
    	}
    	
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
        
    function get($id, $fields = '*', $run_plugin = true) {
    	$obj = parent::get($id, $fields);
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