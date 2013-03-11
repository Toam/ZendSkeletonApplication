<?php
namespace Application\Form\View\Helper;

use Zend\Form\ElementInterface;
use Zend\View\Helper\AbstractHelper;

class FormRow extends AbstractHelper
{
	public function __invoke(ElementInterface $element)
	{
		return '<div class="control-group">
					<label class="control-label" for="input">' . $element->getLabel() . '</label>
					<div class="controls">
						<input id="input" class="input-xlarge" type="text" name="'.$element->getName().'" value="'.$element->getValue().'">
					</div>
				</div>';
	}
}