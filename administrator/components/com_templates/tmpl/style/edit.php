<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_templates
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');

JHtml::_('behavior.formvalidator');
JHtml::_('behavior.keepalive');
JHtml::_('behavior.tabstate');

$user = JFactory::getUser();
?>

<form action="<?php echo JRoute::_('index.php?option=com_templates&layout=edit&id=' . (int) $this->item->id); ?>" method="post" name="adminForm" id="style-form" class="form-validate">

	<?php echo JLayoutHelper::render('joomla.edit.title_alias', $this); ?>

	<div>
		<?php echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'details')); ?>

		<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'details', JText::_('JDETAILS')); ?>

		<div class="row">
			<div class="col-md-9">
				<h3>
					<?php echo JText::_($this->item->template); ?>
				</h3>
				<div class="info-labels">
					<span class="badge badge-secondary hasTooltip" title="<?php echo JHtml::_('tooltipText', 'COM_TEMPLATES_FIELD_CLIENT_LABEL'); ?>">
						<?php echo $this->item->client_id == 0 ? JText::_('JSITE') : JText::_('JADMINISTRATOR'); ?>
					</span>
				</div>
				<div>
					<p><?php echo JText::_($this->item->xml->description); ?></p>
					<?php
					$this->fieldset = 'description';
					$description = JLayoutHelper::render('joomla.edit.fieldset', $this);
					?>
					<?php if ($description) : ?>
						<p class="readmore">
							<a href="#" onclick="jQuery('.nav-tabs a[href=\'#description\']').tab('show');">
								<?php echo JText::_('JGLOBAL_SHOW_FULL_DESCRIPTION'); ?>
							</a>
						</p>
					<?php endif; ?>
				</div>
				<?php
				$this->fieldset = 'basic';
				$html = JLayoutHelper::render('joomla.edit.fieldset', $this);
				echo $html ? '<hr>' . $html : '';
				?>
			</div>
			<div class="col-md-3">
				<div class="card card-light">
					<div class="card-body">
						<?php
						// Set main fields.
						$this->fields = array(
							'home',
							'client_id',
							'template'
						);
						?>
						<?php echo JLayoutHelper::render('joomla.edit.global', $this); ?>
					</div>
				</div>
			</div>
		</div>
		<?php echo JHtml::_('bootstrap.endTab'); ?>

		<?php if ($description) : ?>
			<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'description', JText::_('JGLOBAL_FIELDSET_DESCRIPTION')); ?>
			<?php echo $description; ?>
			<?php echo JHtml::_('bootstrap.endTab'); ?>
		<?php endif; ?>

		<?php
		$this->fieldsets = array();
		$this->ignore_fieldsets = array('basic', 'description');
		echo JLayoutHelper::render('joomla.edit.params', $this);
		?>

		<?php if ($user->authorise('core.edit', 'com_menus') && $this->item->client_id == 0 && $this->canDo->get('core.edit.state')) : ?>
			<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'assignment', JText::_('COM_TEMPLATES_MENUS_ASSIGNMENT')); ?>
			<?php echo $this->loadTemplate('assignment'); ?>
			<?php echo JHtml::_('bootstrap.endTab'); ?>
		<?php endif; ?>

		<?php echo JHtml::_('bootstrap.endTabSet'); ?>

		<input type="hidden" name="task" value="">
		<?php echo JHtml::_('form.token'); ?>
	</div>
</form>
