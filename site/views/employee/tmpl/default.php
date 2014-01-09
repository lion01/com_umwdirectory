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
$canEdit = JFactory::getUser()->authorise('core.edit', 'com_umwdirectory.' . $this->item->id);
if (!$canEdit && JFactory::getUser()->authorise('core.edit.own', 'com_umwdirectory' . $this->item->id)) {
	$canEdit = JFactory::getUser()->id == $this->item->created_by;
}
?>
<?php if ($this->item) : ?>

    <div class="item_fields">

        <ul class="fields_list">

            			<li><?php echo JText::_('COM_UMWDIRECTORY_FORM_LBL_EMPLOYEE_ID'); ?>:
			<?php echo $this->item->id; ?></li>
			<li><?php echo JText::_('COM_UMWDIRECTORY_FORM_LBL_EMPLOYEE_PIDM'); ?>:
			<?php echo $this->item->pidm; ?></li>
			<li><?php echo JText::_('COM_UMWDIRECTORY_FORM_LBL_EMPLOYEE_ORDERING'); ?>:
			<?php echo $this->item->ordering; ?></li>
			<li><?php echo JText::_('COM_UMWDIRECTORY_FORM_LBL_EMPLOYEE_STATE'); ?>:
			<?php echo $this->item->state; ?></li>
			<li><?php echo JText::_('COM_UMWDIRECTORY_FORM_LBL_EMPLOYEE_FNAME'); ?>:
			<?php echo $this->item->fname; ?></li>
			<li><?php echo JText::_('COM_UMWDIRECTORY_FORM_LBL_EMPLOYEE_LNAME'); ?>:
			<?php echo $this->item->lname; ?></li>
			<li><?php echo JText::_('COM_UMWDIRECTORY_FORM_LBL_EMPLOYEE_PNAME'); ?>:
			<?php echo $this->item->pname; ?></li>
			<li><?php echo JText::_('COM_UMWDIRECTORY_FORM_LBL_EMPLOYEE_BIOGRAPHY'); ?>:
			<?php echo $this->item->biography; ?></li>
			<li><?php echo JText::_('COM_UMWDIRECTORY_FORM_LBL_EMPLOYEE_TITLE'); ?>:
			<?php echo $this->item->title; ?></li>
			<li><?php echo JText::_('COM_UMWDIRECTORY_FORM_LBL_EMPLOYEE_DEPARTMENT'); ?>:
			<?php echo $this->item->department; ?></li>
			<li><?php echo JText::_('COM_UMWDIRECTORY_FORM_LBL_EMPLOYEE_PHONE'); ?>:
			<?php echo $this->item->phone; ?></li>
			<li><?php echo JText::_('COM_UMWDIRECTORY_FORM_LBL_EMPLOYEE_EMAIL'); ?>:
			<?php echo $this->item->email; ?></li>
			<li><?php echo JText::_('COM_UMWDIRECTORY_FORM_LBL_EMPLOYEE_FAX'); ?>:
			<?php echo $this->item->fax; ?></li>
			<li><?php echo JText::_('COM_UMWDIRECTORY_FORM_LBL_EMPLOYEE_ADDRESS'); ?>:
			<?php echo $this->item->address; ?></li>
			<li><?php echo JText::_('COM_UMWDIRECTORY_FORM_LBL_EMPLOYEE_MAILBOX'); ?>:
			<?php echo $this->item->mailbox; ?></li>
			<li><?php echo JText::_('COM_UMWDIRECTORY_FORM_LBL_EMPLOYEE_CITY'); ?>:
			<?php echo $this->item->city; ?></li>
			<li><?php echo JText::_('COM_UMWDIRECTORY_FORM_LBL_EMPLOYEE_ZIPCODE'); ?>:
			<?php echo $this->item->zipcode; ?></li>
			<li><?php echo JText::_('COM_UMWDIRECTORY_FORM_LBL_EMPLOYEE_STATE_PROVINCE_REGION'); ?>:
			<?php echo $this->item->state_province_region; ?></li>
			<li><?php echo JText::_('COM_UMWDIRECTORY_FORM_LBL_EMPLOYEE_USER_ACCOUNT'); ?>:
			<?php echo $this->item->user_account; ?></li>
			<li><?php echo JText::_('COM_UMWDIRECTORY_FORM_LBL_EMPLOYEE_CHECKED_OUT'); ?>:
			<?php echo $this->item->checked_out; ?></li>
			<li><?php echo JText::_('COM_UMWDIRECTORY_FORM_LBL_EMPLOYEE_CHECKED_OUT_TIME'); ?>:
			<?php echo $this->item->checked_out_time; ?></li>
			<li><?php echo JText::_('COM_UMWDIRECTORY_FORM_LBL_EMPLOYEE_CREATED_BY'); ?>:
			<?php echo $this->item->created_by; ?></li>
			<li><?php echo JText::_('COM_UMWDIRECTORY_FORM_LBL_EMPLOYEE_CREATED_DATE'); ?>:
			<?php echo $this->item->created_date; ?></li>
			<li><?php echo JText::_('COM_UMWDIRECTORY_FORM_LBL_EMPLOYEE_MODIFIED_BY'); ?>:
			<?php echo $this->item->modified_by; ?></li>
			<li><?php echo JText::_('COM_UMWDIRECTORY_FORM_LBL_EMPLOYEE_MODIFIED_DATE'); ?>:
			<?php echo $this->item->modified_date; ?></li>
			<li><?php echo JText::_('COM_UMWDIRECTORY_FORM_LBL_EMPLOYEE_IMAGE'); ?>:
			<?php echo $this->item->image; ?></li>
			<li><?php echo JText::_('COM_UMWDIRECTORY_FORM_LBL_EMPLOYEE_IMAGE_ALT_TEXT'); ?>:
			<?php echo $this->item->image_alt_text; ?></li>
			<li><?php echo JText::_('COM_UMWDIRECTORY_FORM_LBL_EMPLOYEE_IMAGE_CAPTION'); ?>:
			<?php echo $this->item->image_caption; ?></li>


        </ul>

    </div>
    <?php if($canEdit): ?>
		<a href="<?php echo JRoute::_('index.php?option=com_umwdirectory&task=employee.edit&id='.$this->item->id); ?>"><?php echo JText::_("COM_UMWDIRECTORY_EDIT_ITEM"); ?></a>
	<?php endif; ?>
								<?php if(JFactory::getUser()->authorise('core.delete','com_umwdirectory.employee.'.$this->item->id)):
								?>
									<a href="javascript:document.getElementById('form-employee-delete-<?php echo $this->item->id ?>').submit()"><?php echo JText::_("COM_UMWDIRECTORY_DELETE_ITEM"); ?></a>
									<form id="form-employee-delete-<?php echo $this->item->id; ?>" style="display:inline" action="<?php echo JRoute::_('index.php?option=com_umwdirectory&task=employee.remove'); ?>" method="post" class="form-validate" enctype="multipart/form-data">
										<input type="hidden" name="jform[id]" value="<?php echo $this->item->id; ?>" />
										<input type="hidden" name="jform[pidm]" value="<?php echo $this->item->pidm; ?>" />
										<input type="hidden" name="jform[ordering]" value="<?php echo $this->item->ordering; ?>" />
										<input type="hidden" name="jform[state]" value="<?php echo $this->item->state; ?>" />
										<input type="hidden" name="jform[fname]" value="<?php echo $this->item->fname; ?>" />
										<input type="hidden" name="jform[lname]" value="<?php echo $this->item->lname; ?>" />
										<input type="hidden" name="jform[pname]" value="<?php echo $this->item->pname; ?>" />
										<input type="hidden" name="jform[biography]" value="<?php echo $this->item->biography; ?>" />
										<input type="hidden" name="jform[title]" value="<?php echo $this->item->title; ?>" />
										<input type="hidden" name="jform[department]" value="<?php echo $this->item->department; ?>" />
										<input type="hidden" name="jform[phone]" value="<?php echo $this->item->phone; ?>" />
										<input type="hidden" name="jform[email]" value="<?php echo $this->item->email; ?>" />
										<input type="hidden" name="jform[fax]" value="<?php echo $this->item->fax; ?>" />
										<input type="hidden" name="jform[address]" value="<?php echo $this->item->address; ?>" />
										<input type="hidden" name="jform[mailbox]" value="<?php echo $this->item->mailbox; ?>" />
										<input type="hidden" name="jform[city]" value="<?php echo $this->item->city; ?>" />
										<input type="hidden" name="jform[zipcode]" value="<?php echo $this->item->zipcode; ?>" />
										<input type="hidden" name="jform[state_province_region]" value="<?php echo $this->item->state_province_region; ?>" />
										<input type="hidden" name="jform[user_account]" value="<?php echo $this->item->user_account; ?>" />
										<input type="hidden" name="jform[checked_out]" value="<?php echo $this->item->checked_out; ?>" />
										<input type="hidden" name="jform[checked_out_time]" value="<?php echo $this->item->checked_out_time; ?>" />
										<input type="hidden" name="jform[created_by]" value="<?php echo $this->item->created_by; ?>" />
										<input type="hidden" name="jform[created_date]" value="<?php echo $this->item->created_date; ?>" />
										<input type="hidden" name="jform[modified_by]" value="<?php echo $this->item->modified_by; ?>" />
										<input type="hidden" name="jform[modified_date]" value="<?php echo $this->item->modified_date; ?>" />
										<input type="hidden" name="jform[image]" value="<?php echo $this->item->image; ?>" />
										<input type="hidden" name="jform[image_alt_text]" value="<?php echo $this->item->image_alt_text; ?>" />
										<input type="hidden" name="jform[image_caption]" value="<?php echo $this->item->image_caption; ?>" />
										<input type="hidden" name="option" value="com_umwdirectory" />
										<input type="hidden" name="task" value="employee.remove" />
										<?php echo JHtml::_('form.token'); ?>
									</form>
								<?php
								endif;
							?>
<?php
else:
    echo JText::_('COM_UMWDIRECTORY_ITEM_NOT_LOADED');
endif;
?>
