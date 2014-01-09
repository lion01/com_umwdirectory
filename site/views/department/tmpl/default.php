<?php
/**
 * @version     1.0.0
 * @package     com_umwdirectory
 * @copyright   Copyright (C) 2014. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Cory Creighton <webmaster@umwestern.edu> - http://www.umwestern.edu
 */
// no direct access
defined('_JEXEC') or die;

//Load admin language file
$lang = JFactory::getLanguage();
$lang->load('com_umwdirectory', JPATH_ADMINISTRATOR);

?>
<?php if ($this->item) : ?>

    <div class="item_fields">

        <ul class="fields_list">

            			<li><?php echo JText::_('COM_UMWDIRECTORY_FORM_LBL_DEPARTMENT_ID'); ?>:
			<?php echo $this->item->id; ?></li>
			<li><?php echo JText::_('COM_UMWDIRECTORY_FORM_LBL_DEPARTMENT_ORDERING'); ?>:
			<?php echo $this->item->ordering; ?></li>
			<li><?php echo JText::_('COM_UMWDIRECTORY_FORM_LBL_DEPARTMENT_STATE'); ?>:
			<?php echo $this->item->state; ?></li>
			<li><?php echo JText::_('COM_UMWDIRECTORY_FORM_LBL_DEPARTMENT_CHECKED_OUT'); ?>:
			<?php echo $this->item->checked_out; ?></li>
			<li><?php echo JText::_('COM_UMWDIRECTORY_FORM_LBL_DEPARTMENT_CHECKED_OUT_TIME'); ?>:
			<?php echo $this->item->checked_out_time; ?></li>
			<li><?php echo JText::_('COM_UMWDIRECTORY_FORM_LBL_DEPARTMENT_CREATED_BY'); ?>:
			<?php echo $this->item->created_by; ?></li>
			<li><?php echo JText::_('COM_UMWDIRECTORY_FORM_LBL_DEPARTMENT_DEPARTMENT'); ?>:
			<?php echo $this->item->department_title; ?></li>


        </ul>

    </div>
    
<?php
else:
    echo JText::_('COM_UMWDIRECTORY_ITEM_NOT_LOADED');
endif;
?>
