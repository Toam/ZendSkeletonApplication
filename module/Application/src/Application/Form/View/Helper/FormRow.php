<?php
namespace Application\Form\View\Helper;

use Zend\Form\ElementInterface;
use Zend\Form\Exception;
use Zend\Form\View\Helper\AbstractHelper;
use Zend\Form\View\Helper\FormRow as ZendFormRow;

class FormRow extends ZendFormRow
{
	public function render(ElementInterface $element)
	{
		return '<div class="control-group">
					<label class="control-label" for="input">Text input</label>
					<div class="controls">
						<input id="input" class="input-xlarge" type="text">
						<p class="help-block">Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
					</div>
				</div>';
	}
}