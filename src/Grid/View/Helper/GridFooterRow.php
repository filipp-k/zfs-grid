<?php
/**
 * Created by PhpStorm.
 * User: Qoma
 * Date: 10/06/14
 * Time: 13:56
 */

namespace ZFS\Grid\View\Helper;

use Zend\View\Helper\AbstractHelper;

class GridFooterRow  extends AbstractHelper
{
    public function __invoke(array $columns)
    {
        $output = '<tr>';
        foreach ($columns as $column) {
            $output .= $this->getView()->gridFooterCell($column);
        }
        $output .= '</tr>';

        return $output;
    }
}
