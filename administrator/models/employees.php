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
        if (empty($config['filter_fields'])) {
            $config['filter_fields'] = array(
                                'id', 'a.id',
                'pidm', 'a.pidm',
                'ordering', 'a.ordering',
                'state', 'a.state',
                'fname', 'a.fname',
                'lname', 'a.lname',
                'pname', 'a.pname',
                'biography', 'a.biography',
                'title', 'a.title',
                'department', 'a.department',
                'phone', 'a.phone',
                'email', 'a.email',
                'fax', 'a.fax',
                'address', 'a.address',
                'mailbox', 'a.mailbox',
                'city', 'a.city',
                'zipcode', 'a.zipcode',
                'state_province_region', 'a.state_province_region',
                'user_account', 'a.user_account',
                'created_by', 'a.created_by',
                'created_date', 'a.created_date',
                'modified_by', 'a.modified_by',
                'modified_date', 'a.modified_date',
                'image', 'a.image',
                'image_alt_text', 'a.image_alt_text',
                'image_caption', 'a.image_caption',

            );
        }

        parent::__construct($config);
    }

    /**
     * Method to auto-populate the model state.
     *
     * Note. Calling getState in this method will result in recursion.
     */
    protected function populateState($ordering = null, $direction = null) {
        // Initialise variables.
        $app = JFactory::getApplication('administrator');

        // Load the filter state.
        $search = $app->getUserStateFromRequest($this->context . '.filter.search', 'filter_search');
        $this->setState('filter.search', $search);

        $published = $app->getUserStateFromRequest($this->context . '.filter.state', 'filter_published', '', 'string');
        $this->setState('filter.state', $published);

        
		//Filtering department
		$this->setState('filter.department', $app->getUserStateFromRequest($this->context.'.filter.department', 'filter_department', '', 'string'));

		//Filtering created_date
		$this->setState('filter.created_date.from', $app->getUserStateFromRequest($this->context.'.filter.created_date.from', 'filter_from_created_date', '', 'string'));
		$this->setState('filter.created_date.to', $app->getUserStateFromRequest($this->context.'.filter.created_date.to', 'filter_to_created_date', '', 'string'));


        // Load the parameters.
        $params = JComponentHelper::getParams('com_umwdirectory');
        $this->setState('params', $params);

        // List state information.
        parent::populateState('a.fname', 'asc');
    }

    /**
     * Method to get a store id based on model configuration state.
     *
     * This is necessary because the model is used by the component and
     * different modules that might need different sets of data or different
     * ordering requirements.
     *
     * @param	string		$id	A prefix for the store id.
     * @return	string		A store id.
     * @since	1.6
     */
    protected function getStoreId($id = '') {
        // Compile the store id.
        $id.= ':' . $this->getState('filter.search');
        $id.= ':' . $this->getState('filter.state');

        return parent::getStoreId($id);
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
		// Join over the user field 'user_account'
		$query->select('user_account.name AS user_account');
		$query->join('LEFT', '#__users AS user_account ON user_account.id = a.user_account');
		// Join over the user field 'created_by'
		$query->select('created_by.name AS created_by');
		$query->join('LEFT', '#__users AS created_by ON created_by.id = a.created_by');
		// Join over the user field 'modified_by'
		$query->select('modified_by.name AS modified_by');
		$query->join('LEFT', '#__users AS modified_by ON modified_by.id = a.modified_by');

        
    // Filter by published state
    $published = $this->getState('filter.state');
    if (is_numeric($published)) {
        $query->where('a.state = '.(int) $published);
    } else if ($published === '') {
        $query->where('(a.state IN (0, 1))');
    }
    

        // Filter by search in title
        $search = $this->getState('filter.search');
        if (!empty($search)) {
            if (stripos($search, 'id:') === 0) {
                $query->where('a.id = ' . (int) substr($search, 3));
            } else {
                $search = $db->Quote('%' . $db->escape($search, true) . '%');
                $query->where('( a.fname LIKE '.$search.'  OR  a.lname LIKE '.$search.'  OR  a.pname LIKE '.$search.'  OR  a.title LIKE '.$search.'  OR  a.department LIKE '.$search.' )');
            }
        }

        

		//Filtering department
		$filter_department = $this->state->get("filter.department");
		if ($filter_department) {
			$query->where("a.department REGEXP ',?".$db->escape($filter_department).",?'");
		}

		//Filtering created_date
		$filter_created_date_from = $this->state->get("filter.created_date.from");
		if ($filter_created_date_from) {
			$query->where("a.created_date >= '".$db->escape($filter_created_date_from)."'");
		}
		$filter_created_date_to = $this->state->get("filter.created_date.to");
		if ($filter_created_date_to) {
			$query->where("a.created_date <= '".$db->escape($filter_created_date_to)."'");
		}


        // Add the list ordering clause.
        $orderCol = $this->state->get('list.ordering');
        $orderDirn = $this->state->get('list.direction');
        if ($orderCol && $orderDirn) {
            $query->order($db->escape($orderCol . ' ' . $orderDirn));
        }

        return $query;
    }

    public function getItems() {
        $items = parent::getItems();
        
		foreach ($items as $oneItem) {

			if (isset($oneItem->department)) {
				$values = explode(',', $oneItem->department);

				$textValue = array();
				foreach ($values as $value){
					$db = JFactory::getDbo();
					$query = $db->getQuery(true);
					$query
							->select('department')
							->from('`#__umwdirectory_department`')
							->where('id = ' . $db->quote($db->escape($value)));
					$db->setQuery($query);
					$results = $db->loadObject();
					if ($results) {
						$textValue[] = $results->department;
					}
				}

			$oneItem->department = !empty($textValue) ? implode(', ', $textValue) : $oneItem->department;

			}
		}
        return $items;
    }

}
