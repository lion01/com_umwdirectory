<?php

/**
 * @version     1.0.0
 * @package     com_umwdirectory
 * @copyright   Copyright (C) 2014. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Cory Creighton <webmaster@umwestern.edu> - http://www.umwestern.edu
 */
defined('_JEXEC') or die;

jimport('joomla.application.component.modellist');

/**
 * Methods supporting a list of Umwdirectory records.
 */
class UmwdirectoryModelEmployees extends JModelList {

    /**
     * Constructor.
     *
     * @param    array    An optional associative array of configuration settings.
     * @see        JController
     * @since    1.6
     */
    public function __construct($config = array()) {
        parent::__construct($config);
    }

    /**
     * Method to auto-populate the model state.
     *
     * Note. Calling getState in this method will result in recursion.
     *
     * @since	1.6
     */
    protected function populateState($ordering = null, $direction = null) {

        // Initialise variables.
        $app = JFactory::getApplication();

        // List state information
        $limit = $app->getUserStateFromRequest('global.list.limit', 'limit', $app->getCfg('list_limit'));
        $this->setState('list.limit', $limit);

        $limitstart = JFactory::getApplication()->input->getInt('limitstart', 0);
        $this->setState('list.start', $limitstart);

        
		if(empty($ordering)) {
			$ordering = 'a.ordering';
		}

        // List state information.
        parent::populateState($ordering, $direction);
    }

    /**
     * Build an SQL query to load the list data.
     *
     * @return	JDatabaseQuery
     * @since	1.6
     */
    protected function getListQuery() {
        // Create a new query object.
        $db = $this->getDbo();
        $query = $db->getQuery(true);

        // Select the required fields from the table.
        $query->select(
                $this->getState(
                        'list.select', 'a.*'
                )
        );

        $query->from('`#__umwdirectory_employee` AS a');

        
    // Join over the users for the checked out user.
    $query->select('uc.name AS editor');
    $query->join('LEFT', '#__users AS uc ON uc.id=a.checked_out');
    
		// Join over the foreign key 'department'
		$query->select('#__umwdirectory_department_1016480.department AS departments_department_1016480');
		$query->join('LEFT', '#__umwdirectory_department AS #__umwdirectory_department_1016480 ON #__umwdirectory_department_1016480.id = a.department');
		// Join over the created by field 'created_by'
		$query->select('created_by.name AS created_by');
		$query->join('LEFT', '#__users AS created_by ON created_by.id = a.created_by');
        

        // Filter by search in title
        $search = $this->getState('filter.search');
        if (!empty($search)) {
            if (stripos($search, 'id:') === 0) {
                $query->where('a.id = ' . (int) substr($search, 3));
            } else {
                $search = $db->Quote('%' . $db->escape($search, true) . '%');
                $query->where('( a.fname LIKE '.$search.'  OR  a.lname LIKE '.$search.'  OR  a.pname LIKE '.$search.'  OR  a.title LIKE '.$search.' )');
            }
        }

        

		//Filtering department
		$filter_department = $this->state->get("filter.department");
		if ($filter_department) {
			$query->where("a.department = '".$filter_department."'");
		}

		//Filtering created_date
		$filter_created_date_from = $this->state->get("filter.created_date.from");
		if ($filter_created_date_from) {
			$query->where("a.created_date >= '".$filter_created_date_from."'");
		}
		$filter_created_date_to = $this->state->get("filter.created_date.to");
		if ($filter_created_date_to) {
			$query->where("a.created_date <= '".$filter_created_date_to."'");
		}

        return $query;
    }

    public function getItems() {
        return parent::getItems();
    }

}
