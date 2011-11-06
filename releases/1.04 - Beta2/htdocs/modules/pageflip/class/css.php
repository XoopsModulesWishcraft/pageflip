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
class PageflipCss extends XoopsObject
{

	var $_ModConfig = NULL;
	var $_Mod = NULL;
	
    function PageflipCss($id = null)
    {
    	$config_handler = xoops_gethandler('config');
		$module_handler = xoops_gethandler('module');
		$this->_Mod = $module_handler->getByDirname('pageflip');
		$this->_ModConfig = $config_handler->getConfigList($this->_Mod->getVar('mid'));
		
        $this->initVar('cssid', XOBJ_DTYPE_INT, null, false);
        $this->initVar('bid', XOBJ_DTYPE_INT, false, false);
        $this->initVar('mode', XOBJ_DTYPE_ENUM, '_MI_PAGEFLIP_CSS_EXTRA', false, false, false, array('_MI_PAGEFLIP_CSS_FOOTER','_MI_PAGEFLIP_CSS_PAGINATION','_MI_PAGEFLIP_CSS_CONTENTS','_MI_PAGEFLIP_CSS_MENU','_MI_PAGEFLIP_CSS_ALTMSG','_MI_PAGEFLIP_CSS_ALTLINK','_MI_PAGEFLIP_CSS_EXTRA'));
        $this->initVar('css', XOBJ_DTYPE_TXTBOX, '', false, 2000);
		$this->initVar('hover', XOBJ_DTYPE_TXTBOX, '', false, 2000);
		$this->initVar('visited', XOBJ_DTYPE_TXTBOX, '', false, 2000);
		$this->initVar('reference', XOBJ_DTYPE_TXTBOX, '', false, 64);
        $this->initVar('uid', XOBJ_DTYPE_INT, 0, false);
		$this->initVar('created', XOBJ_DTYPE_INT, 0, false);
		$this->initVar('updated', XOBJ_DTYPE_INT, 0, false);
    }
    
    function getForm() {
    	return pageflip_css_get_form($this, false);
    }
    
    function toArray() {
    	$ret = parent::toArray();
    	foreach($ret as $field => $value) {
    		if (defined($value.'_VALUE'))
    			$ret[$field] = constant($value.'_VALUE');
    	}
    	$ele = pageflip_css_get_form($this, true);
    	foreach($ele as $key => $field)
    		$ret['form'][$key] = $field->render();
    	return $ret;
    }

    function runInsertPlugin() {
		
		xoops_loadLanguage('plugins', 'pageflip');
		
		include_once($GLOBALS['xoops']->path('/modules/pageflip/plugins/'.constant($this->getVar('mode').'_PLUGINFILE').'.php'));

		switch ($this->getVar('mode')) {
			case '_MI_PAGEFLIP_CSS_FOOTER':
			case '_MI_PAGEFLIP_CSS_PAGINATION':
			case '_MI_PAGEFLIP_CSS_CONTENTS':
			case '_MI_PAGEFLIP_CSS_MENU':
			case '_MI_PAGEFLIP_CSS_ALTMSG':
			case '_MI_PAGEFLIP_CSS_ALTLINK':
			case '_MI_PAGEFLIP_CSS_EXTRA':
				$func = ucfirst(constant($this->getVar('mode').'_PLUGIN')).'InsertHook';
				break;
			default:
				return $this->getVar('cssid');
				break;
		}
		
		if (function_exists($func))  {
			return @$func($this);
		}
		return $this->getVar('cssid');
	}
	
	function runGetPlugin() {
				
		xoops_loadLanguage('plugins', 'pageflip');
		
		include_once($GLOBALS['xoops']->path('/modules/pageflip/plugins/'.constant($this->getVar('mode').'_PLUGINFILE').'.php'));

		switch ($this->getVar('mode')) {
			case '_MI_PAGEFLIP_CSS_FOOTER':
			case '_MI_PAGEFLIP_CSS_PAGINATION':
			case '_MI_PAGEFLIP_CSS_CONTENTS':
			case '_MI_PAGEFLIP_CSS_MENU':
			case '_MI_PAGEFLIP_CSS_ALTMSG':
			case '_MI_PAGEFLIP_CSS_ALTLINK':
			case '_MI_PAGEFLIP_CSS_EXTRA':
				$func = ucfirst(constant($this->getVar('mode').'_PLUGIN')).'GetHook';
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
class PageflipCssHandler extends XoopsPersistableObjectHandler
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
        parent::__construct($db, 'pageflip_css', 'PageflipCss', "cssid", "reference");
    }
    
 	private function runGetArrayPlugin($row) {
		
		xoops_loadLanguage('plugins', 'pageflip');
		
		include_once($GLOBALS['xoops']->path('/modules/pageflip/plugins/'.constant($row['mode'].'_PLUGINFILE').'.php'));

 		switch ($row['mode']) {
			case '_MI_PAGEFLIP_CSS_FOOTER':
			case '_MI_PAGEFLIP_CSS_PAGINATION':
			case '_MI_PAGEFLIP_CSS_CONTENTS':
			case '_MI_PAGEFLIP_CSS_MENU':
			case '_MI_PAGEFLIP_CSS_ALTMSG':
			case '_MI_PAGEFLIP_CSS_ALTLINK':
			case '_MI_PAGEFLIP_CSS_EXTRA':
				$func = ucfirst(constant($row['mode'].'_PLUGIN')).'GetArrayHook';
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
    	if ($obj->vars['mode']['changed']==true) {
    		if ($obj->getVar('mode')!='_MI_PAGEFLIP_CSS_EXTRA') {
				xoops_loadLanguage('modinfo', 'pageflip');
    			$obj->setVar('reference', constant($obj->getVar('mode').'_VALUE'));
    		}
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