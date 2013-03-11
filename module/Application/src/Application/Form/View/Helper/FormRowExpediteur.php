<?php
namespace Application\Form\View\Helper;

use Zend\Form\ElementInterface;
use Zend\View\Helper\AbstractHelper;

class FormRowExpediteur extends AbstractHelper
{
	public function __invoke(ElementInterface $element)
	{
		return '<div class="control-group">
					<label class="control-label" for="input">' . $element->getLabel() . '</label>
					<div class="controls">
						<select  name="'.$element->getName().'">
						  <option value="1">Alain Dissoir</option>
						  <option value="2">Axel Aire</option>
						  <option value="3">Andy Vojanbon</option>
						  <option value="4">Carl Ajumide</option>
						  <option value="5">Harry Vencouran</option>
						</select> 
					</div>
				</div>';
	}
}