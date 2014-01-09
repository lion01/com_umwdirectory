<?php
/**
 * @version     1.0.0
 * @package     com_umwdirectory
 * @copyright   Copyright (C) 2014. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Cory Creighton <webmaster@umwestern.edu> - http://www.umwestern.edu
 */

// No direct access
defined('_JEXEC') or die;

/**
 * Umwdirectory helper.
 */
class UmwdirectoryHelper
{
	/**
	 * Configure the Linkbar.
	 */
	public static function addSubmenu($vName = '')
	{
		JHtmlSidebar::addEntry(
			JText::_('COM_UMWDIRECTORY_TITLE_EMPLOYEES'),
			'index.php?option=com_umwdirectory&view=employees',
			$vName == 'employees'
		);
		JHtmlSidebar::addEntry(
			JText::_('COM_UMWDIRECTORY_TITLE_DEPARTMENTS'),
			'index.php?option=com_umwdirectory&view=departments',
			$vName == 'departments'
		);
		JHtmlSidebar::addEntry(
			'Categories (Departments)',
			"index.php?option=com_categories&extension=com_umwdirectory.departments",
			$vName == 'categories.departments'
		);
		
if ($vName=='categories.departments.department') {			
JToolBarHelper::title('UMW Directory: Categories (Departments)');		
}
	}

	/**
	 * Gets a list of the actions that can be performed.
	 *
	 * @return	JObject
	 * @since	1.6
	 */
	public static function getActions()
	{
		$user	= JFactory::getUser();
		$result	= new JObject;

		$assetName = 'com_umwdirectory';

		$actions = array(
			'core.admin', 'core.manage', 'core.create', 'core.edit', 'core.edit.own', 'core.edit.state', 'core.delete'
		);

		foreach ($actions as $action) {
			$result->set($action, $user->authorise($action, $assetName));
		}

		return $result;
	}
}
