<?php
/**
 * Created by PhpStorm.
 * User: Qoma
 * Date: 10/06/14
 * Time: 13:56
 */

namespace ZFS\Grid\View\Helper;

use Zend\View\Helper\AbstractHelper;

class GridBodyRow extends AbstractHelper
{
    public function __invoke($row, array $columns)
    {
        $output = '<tr>';
        foreach ($columns as $column) {
            $output .= $this->getView()->gridBodyCell($row, $column);
        }
        $output .= '</tr>';

        return $output;
    }
}
