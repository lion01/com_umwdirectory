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
?>
<script type="text/javascript">
    function deleteItem(item_id){
        if(confirm("<?php echo JText::_('COM_UMWDIRECTORY_DELETE_MESSAGE'); ?>")){
            document.getElementById('form-employee-delete-' + item_id).submit();
        }
    }
</script>

<div class="items">
    <ul class="items_list">
<?php $show = false; ?>
        <?php foreach ($this->items as $item) : ?>

            
				<?php
					if($item->state == 1 || ($item->state == 0 && JFactory::getUser()->authorise('core.edit.own',' com_umwdirectory.employee.'.$item->id))):
						$show = true;
						?>
							<li>
								<a href="<?php echo JRoute::_('index.php?option=com_umwdirectory&view=employee&id=' . (int)$item->id); ?>"><?php echo $item->fname; ?></a>
								<?php
									if(JFactory::getUser()->authorise('core.edit.state','com_umwdirectory.employee.'.$item->id)):
									?>
										<a href="javascript:document.getElementById('form-employee-state-<?php echo $item->id; ?>').submit()"><?php if($item->state == 1): echo JText::_("COM_UMWDIRECTORY_UNPUBLISH_ITEM"); else: echo JText::_("COM_UMWDIRECTORY_PUBLISH_ITEM"); endif; ?></a>
										<form id="form-employee-state-<?php echo $item->id ?>" style="display:inline" action="<?php echo JRoute::_('index.php?option=com_umwdirectory&task=employee.save'); ?>" method="post" class="form-validate" enctype="multipart/form-data">
											<input type="hidden" name="jform[id]" value="<?php echo $item->id; ?>" />
											<input type="hidden" name="jform[pidm]" value="<?php echo $item->pidm; ?>" />
											<input type="hidden" name="jform[ordering]" value="<?php echo $item->ordering; ?>" />
											<input type="hidden" name="jform[state]" value="<?php echo (int)!((int)$item->state); ?>" />
											<input type="hidden" name="jform[fname]" value="<?php echo $item->fname; ?>" />
											<input type="hidden" name="jform[lname]" value="<?php echo $item->lname; ?>" />
											<input type="hidden" name="jform[pname]" value="<?php echo $item->pname; ?>" />
											<input type="hidden" name="jform[biography]" value="<?php echo $item->biography; ?>" />
											<input type="hidden" name="jform[title]" value="<?php echo $item->title; ?>" />
											<input type="hidden" name="jform[department]" value="<?php echo $item->department; ?>" />
											<input type="hidden" name="jform[phone]" value="<?php echo $item->phone; ?>" />
											<input type="hidden" name="jform[email]" value="<?php echo $item->email; ?>" />
											<input type="hidden" name="jform[fax]" value="<?php echo $item->fax; ?>" />
											<input type="hidden" name="jform[address]" value="<?php echo $item->address; ?>" />
											<input type="hidden" name="jform[mailbox]" value="<?php echo $item->mailbox; ?>" />
											<input type="hidden" name="jform[city]" value="<?php echo $item->city; ?>" />
											<input type="hidden" name="jform[zipcode]" value="<?php echo $item->zipcode; ?>" />
											<input type="hidden" name="jform[state_province_region]" value="<?php echo $item->state_province_region; ?>" />
											<input type="hidden" name="jform[user_account]" value="<?php echo $item->user_account; ?>" />
											<input type="hidden" name="jform[checked_out]" value="<?php echo $item->checked_out; ?>" />
											<input type="hidden" name="jform[checked_out_time]" value="<?php echo $item->checked_out_time; ?>" />
											<input type="hidden" name="jform[created_date]" value="<?php echo $item->created_date; ?>" />
											<input type="hidden" name="jform[modified_by]" value="<?php echo $item->modified_by; ?>" />
											<input type="hidden" name="jform[modified_date]" value="<?php echo $item->modified_date; ?>" />
											<input type="hidden" name="jform[image]" value="<?php echo $item->image; ?>" />
											<input type="hidden" name="jform[image_alt_text]" value="<?php echo $item->image_alt_text; ?>" />
											<input type="hidden" name="jform[image_caption]" value="<?php echo $item->image_caption; ?>" />
											<input type="hidden" name="option" value="com_umwdirectory" />
											<input type="hidden" name="task" value="employee.save" />
											<?php echo JHtml::_('form.token'); ?>
										</form>
									<?php
									endif;
									if(JFactory::getUser()->authorise('core.delete','com_umwdirectory.employee.'.$item->id)):
									?>
										<a href="javascript:deleteItem(<?php echo $item->id; ?>);"><?php echo JText::_("COM_UMWDIRECTORY_DELETE_ITEM"); ?></a>
										<form id="form-employee-delete-<?php echo $item->id; ?>" style="display:inline" action="<?php echo JRoute::_('index.php?option=com_umwdirectory&task=employee.remove'); ?>" method="post" class="form-validate" enctype="multipart/form-data">
											<input type="hidden" name="jform[id]" value="<?php echo $item->id; ?>" />
											<input type="hidden" name="jform[pidm]" value="<?php echo $item->pidm; ?>" />
											<input type="hidden" name="jform[ordering]" value="<?php echo $item->ordering; ?>" />
											<input type="hidden" name="jform[state]" value="<?php echo $item->state; ?>" />
											<input type="hidden" name="jform[fname]" value="<?php echo $item->fname; ?>" />
											<input type="hidden" name="jform[lname]" value="<?php echo $item->lname; ?>" />
											<input type="hidden" name="jform[pname]" value="<?php echo $item->pname; ?>" />
											<input type="hidden" name="jform[biography]" value="<?php echo $item->biography; ?>" />
											<input type="hidden" name="jform[title]" value="<?php echo $item->title; ?>" />
											<input type="hidden" name="jform[department]" value="<?php echo $item->department; ?>" />
											<input type="hidden" name="jform[phone]" value="<?php echo $item->phone; ?>" />
											<input type="hidden" name="jform[email]" value="<?php echo $item->email; ?>" />
											<input type="hidden" name="jform[fax]" value="<?php echo $item->fax; ?>" />
											<input type="hidden" name="jform[address]" value="<?php echo $item->address; ?>" />
											<input type="hidden" name="jform[mailbox]" value="<?php echo $item->mailbox; ?>" />
											<input type="hidden" name="jform[city]" value="<?php echo $item->city; ?>" />
											<input type="hidden" name="jform[zipcode]" value="<?php echo $item->zipcode; ?>" />
											<input type="hidden" name="jform[state_province_region]" value="<?php echo $item->state_province_region; ?>" />
											<input type="hidden" name="jform[user_account]" value="<?php echo $item->user_account; ?>" />
											<input type="hidden" name="jform[checked_out]" value="<?php echo $item->checked_out; ?>" />
											<input type="hidden" name="jform[checked_out_time]" value="<?php echo $item->checked_out_time; ?>" />
											<input type="hidden" name="jform[created_by]" value="<?php echo $item->created_by; ?>" />
											<input type="hidden" name="jform[created_date]" value="<?php echo $item->created_date; ?>" />
											<input type="hidden" name="jform[modified_by]" value="<?php echo $item->modified_by; ?>" />
											<input type="hidden" name="jform[modified_date]" value="<?php echo $item->modified_date; ?>" />
											<input type="hidden" name="jform[image]" value="<?php echo $item->image; ?>" />
											<input type="hidden" name="jform[image_alt_text]" value="<?php echo $item->image_alt_text; ?>" />
											<input type="hidden" name="jform[image_caption]" value="<?php echo $item->image_caption; ?>" />
											<input type="hidden" name="option" value="com_umwdirectory" />
											<input type="hidden" name="task" value="employee.remove" />
											<?php echo JHtml::_('form.token'); ?>
										</form>
									<?php
									endif;
								?>
							</li>
						<?php endif; ?>

<?php endforeach; ?>
        <?php
        if (!$show):
            echo JText::_('COM_UMWDIRECTORY_NO_ITEMS');
        endif;
        ?>
    </ul>
</div>
<?php if ($show): ?>
    <div class="pagination">
        <p class="counter">
            <?php echo $this->pagination->getPagesCounter(); ?>
        </p>
        <?php echo $this->pagination->getPagesLinks(); ?>
    </div>
<?php endif; ?>


									<?php if(JFactory::getUser()->authorise('core.create','com_umwdirectory')): ?><a href="<?php echo JRoute::_('index.php?option=com_umwdirectory&task=employee.edit&id=0'); ?>"><?php echo JText::_("COM_UMWDIRECTORY_ADD_ITEM"); ?></a>
	<?php endif; ?>