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

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');
JHtml::_('behavior.keepalive');

// Import CSS
$document = JFactory::getDocument();
$document->addStyleSheet('components/com_umwdirectory/assets/css/umwdirectory.css');
?>
<script type="text/javascript">
    js = jQuery.noConflict();
    js(document).ready(function(){
        
	js('input:hidden.department').each(function(){
		var name = js(this).attr('name');
		if(name.indexOf('departmenthidden')){
			js('#jform_department option[value="'+js(this).val()+'"]').attr('selected',true);
		}
	});
	js("#jform_department").trigger("liszt:updated");
    });
    
    Joomla.submitbutton = function(task)
    {
        if(task == 'employee.cancel'){
            Joomla.submitform(task, document.getElementById('employee-form'));
        }
        else{
            
            if (task != 'employee.cancel' && document.formvalidator.isValid(document.id('employee-form'))) {
                
	if(js('#jform_department option:selected').length == 0){
		js("#jform_department option[value=0]").attr('selected','selected');
	}
                Joomla.submitform(task, document.getElementById('employee-form'));
            }
            else {
                alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED')); ?>');
            }
        }
    }
</script>

<form action="<?php echo JRoute::_('index.php?option=com_umwdirectory&layout=edit&id=' . (int) $this->item->id); ?>" method="post" enctype="multipart/form-data" name="adminForm" id="employee-form" class="form-validate">
    <div class="row-fluid">
        <div class="span10 form-horizontal">
            <fieldset class="adminform">

                			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('id'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('id'); ?></div>
			</div>
				<input type="hidden" name="jform[pidm]" value="<?php echo $this->item->pidm; ?>" />
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('state'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('state'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('fname'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('fname'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('lname'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('lname'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('pname'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('pname'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('biography'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('biography'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('title'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('title'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('department'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('department'); ?></div>
			</div>

			<?php
				foreach((array)$this->item->department as $value): 
					if(!is_array($value)):
						echo '<input type="hidden" class="department" name="jform[departmenthidden]['.$value.']" value="'.$value.'" />';
					endif;
				endforeach;
			?>			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('phone'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('phone'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('email'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('email'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('fax'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('fax'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('address'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('address'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('mailbox'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('mailbox'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('city'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('city'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('zipcode'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('zipcode'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('state_province_region'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('state_province_region'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('user_account'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('user_account'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('created_by'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('created_by'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('created_date'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('created_date'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('modified_by'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('modified_by'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('modified_date'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('modified_date'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('image'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('image'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('image_alt_text'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('image_alt_text'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('image_caption'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('image_caption'); ?></div>
			</div>


            </fieldset>
        </div>

        <div class="clr"></div>

<?php if (JFactory::getUser()->authorise('core.admin','umwdirectory')): ?>
	<div class="fltlft" style="width:86%;">
		<fieldset class="panelform">
			<?php echo JHtml::_('sliders.start', 'permissions-sliders-'.$this->item->id, array('useCookie'=>1)); ?>
			<?php echo JHtml::_('sliders.panel', JText::_('ACL Configuration'), 'access-rules'); ?>
			<?php echo $this->form->getInput('rules'); ?>
			<?php echo JHtml::_('sliders.end'); ?>
		</fieldset>
	</div>
<?php endif; ?>

        <input type="hidden" name="task" value="" />
        <?php echo JHtml::_('form.token'); ?>

    </div>
</form>