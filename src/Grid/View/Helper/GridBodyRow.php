<?php

namespace ZFS\Grid\View\Helper;

use Zend\View\Helper\AbstractHelper;

/**
 * Class GridBodyRow
 * @package ZFS\Grid\View\Helper
 */
class GridBodyRow extends AbstractHelper
{
    /**
     * @param       $row
     * @param array $columns
     *
     * @return string
     */
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
