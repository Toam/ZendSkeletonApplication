<?php
namespace Application\Form\View\Helper;

use Zend\Form\ElementInterface;
use Zend\View\Helper\AbstractHelper;

class FormRowContent extends AbstractHelper
{
	public function __invoke(ElementInterface $elementQuantity, ElementInterface $elementLabel, ElementInterface $elementSize, ElementInterface $elementPrice)
	{
		return '<tr>
					<td><input id="input" type="text" name="'.$elementQuantity->getName().'" value="'.$elementQuantity->getValue().'" style="width:50px"></td>
					<td><input id="input" type="text" name="'.$elementLabel->getName().'" value="'.$elementLabel->getValue().'" style="width:600px"></td>
					<td><input id="input" type="text" name="'.$elementSize->getName().'" value="'.$elementSize->getValue().'" style="width:80px"></td>
					<td><input id="input" type="text" name="'.$elementPrice->getName().'" value="'.$elementPrice->getValue().'" style="width:50px"></td>
				</tr>';
	}
}