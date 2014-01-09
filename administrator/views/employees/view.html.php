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

jimport('joomla.application.component.view');

/**
 * View class for a list of Umwdirectory.
 */
class UmwdirectoryViewEmployees extends JViewLegacy
{
	protected $items;
	protected $pagination;
	protected $state;

	/**
	 * Display the view
	 */
	public function display($tpl = null)
	{
		$this->state		= $this->get('State');
		$this->items		= $this->get('Items');
		$this->pagination	= $this->get('Pagination');

		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			throw new Exception(implode("\n", $errors));
		}
        
		UmwdirectoryHelper::addSubmenu('employees');
        
		$this->addToolbar();
        
        $this->sidebar = JHtmlSidebar::render();
		parent::display($tpl);
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @since	1.6
	 */
	protected function addToolbar()
	{
		require_once JPATH_COMPONENT.'/helpers/umwdirectory.php';

		$state	= $this->get('State');
		$canDo	= UmwdirectoryHelper::getActions($state->get('filter.category_id'));

		JToolBarHelper::title(JText::_('COM_UMWDIRECTORY_TITLE_EMPLOYEES'), 'employees.png');

        //Check if the form exists before showing the add/edit buttons
        $formPath = JPATH_COMPONENT_ADMINISTRATOR.'/views/employee';
        if (file_exists($formPath)) {

            if ($canDo->get('core.create')) {
			    JToolBarHelper::addNew('employee.add','JTOOLBAR_NEW');
		    }

		    if ($canDo->get('core.edit') && isset($this->items[0])) {
			    JToolBarHelper::editList('employee.edit','JTOOLBAR_EDIT');
		    }

        }

		if ($canDo->get('core.edit.state')) {

            if (isset($this->items[0]->state)) {
			    JToolBarHelper::divider();
			    JToolBarHelper::custom('employees.publish', 'publish.png', 'publish_f2.png','JTOOLBAR_PUBLISH', true);
			    JToolBarHelper::custom('employees.unpublish', 'unpublish.png', 'unpublish_f2.png', 'JTOOLBAR_UNPUBLISH', true);
            } else if (isset($this->items[0])) {
                //If this component does not use state then show a direct delete button as we can not trash
                JToolBarHelper::deleteList('', 'employees.delete','JTOOLBAR_DELETE');
            }

            if (isset($this->items[0]->state)) {
			    JToolBarHelper::divider();
			    JToolBarHelper::archiveList('employees.archive','JTOOLBAR_ARCHIVE');
            }
            if (isset($this->items[0]->checked_out)) {
            	JToolBarHelper::custom('employees.checkin', 'checkin.png', 'checkin_f2.png', 'JTOOLBAR_CHECKIN', true);
            }
		}
        
        //Show trash and delete for components that uses the state field
        if (isset($this->items[0]->state)) {
		    if ($state->get('filter.state') == -2 && $canDo->get('core.delete')) {
			    JToolBarHelper::deleteList('', 'employees.delete','JTOOLBAR_EMPTY_TRASH');
			    JToolBarHelper::divider();
		    } else if ($canDo->get('core.edit.state')) {
			    JToolBarHelper::trash('employees.trash','JTOOLBAR_TRASH');
			    JToolBarHelper::divider();
		    }
        }

		if ($canDo->get('core.admin')) {
			JToolBarHelper::preferences('com_umwdirectory');
		}
        
        //Set sidebar action - New in 3.0
		JHtmlSidebar::setAction('index.php?option=com_umwdirectory&view=employees');
        
        $this->extra_sidebar = '';
        
		JHtmlSidebar::addFilter(

			JText::_('JOPTION_SELECT_PUBLISHED'),

			'filter_published',

			JHtml::_('select.options', JHtml::_('jgrid.publishedOptions'), "value", "text", $this->state->get('filter.state'), true)

		);
        //Filter for the field ".department;
        jimport('joomla.form.form');
        $options = array();
        JForm::addFormPath(JPATH_COMPONENT . '/models/forms');
        $form = JForm::getInstance('com_umwdirectory.employee', 'employee');

        $field = $form->getField('department');

        $query = $form->getFieldAttribute('department','query');
        $translate = $form->getFieldAttribute('department','translate');
        $key = $form->getFieldAttribute('department','key_field');
        $value = $form->getFieldAttribute('department','value_field');

        // Get the database object.
        $db = JFactory::getDBO();

        // Set the query and get the result list.
        $db->setQuery($query);
        $items = $db->loadObjectlist();

        // Build the field options.
        if (!empty($items))
        {
            foreach ($items as $item)
            {
                if ($translate == true)
                {
                    $options[] = JHtml::_('select.option', $item->$key, JText::_($item->$value));
                }
                else
                {
                    $options[] = JHtml::_('select.option', $item->$key, $item->$value);
                }
            }
        }

        JHtmlSidebar::addFilter(
            'Department',
            'filter_department',
            JHtml::_('select.options', $options, "value", "text", $this->state->get('filter.department')),
            true
        );
			//Filter for the field created_date
			$this->extra_sidebar .= '<small><label for="filter_from_created_date">From Created Date</label></small>';
			$this->extra_sidebar .= JHtml::_('calendar', $this->state->get('filter.created_date.from'), 'filter_from_created_date', 'filter_from_created_date', '%Y-%m-%d', 'style="width:142px;" onchange="this.form.submit();"');
			$this->extra_sidebar .= '<small><label for="filter_to_created_date">To Created Date</label></small>';
			$this->extra_sidebar .= JHtml::_('calendar', $this->state->get('filter.created_date.to'), 'filter_to_created_date', 'filter_to_created_date', '%Y-%m-%d', 'style="width:142px;" onchange="this.form.submit();"');
			$this->extra_sidebar .= '<hr class="hr-condensed">';

        
	}
    
	protected function getSortFields()
	{
		return array(
		'a.id' => JText::_('JGRID_HEADING_ID'),
		'a.ordering' => JText::_('JGRID_HEADING_ORDERING'),
		'a.state' => JText::_('JSTATUS'),
		'a.fname' => JText::_('COM_UMWDIRECTORY_EMPLOYEES_FNAME'),
		'a.lname' => JText::_('COM_UMWDIRECTORY_EMPLOYEES_LNAME'),
		'a.department' => JText::_('COM_UMWDIRECTORY_EMPLOYEES_DEPARTMENT'),
		'a.checked_out' => JText::_('COM_UMWDIRECTORY_EMPLOYEES_CHECKED_OUT'),
		'a.checked_out_time' => JText::_('COM_UMWDIRECTORY_EMPLOYEES_CHECKED_OUT_TIME'),
		'a.created_by' => JText::_('COM_UMWDIRECTORY_EMPLOYEES_CREATED_BY'),
		'a.created_date' => JText::_('COM_UMWDIRECTORY_EMPLOYEES_CREATED_DATE'),
		'a.modified_by' => JText::_('COM_UMWDIRECTORY_EMPLOYEES_MODIFIED_BY'),
		'a.modified_date' => JText::_('COM_UMWDIRECTORY_EMPLOYEES_MODIFIED_DATE'),
		);
	}

    
}
