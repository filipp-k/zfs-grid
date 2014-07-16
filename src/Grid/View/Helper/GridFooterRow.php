<?php

namespace ZFS\Grid\View\Helper;

use Zend\View\Helper\AbstractHelper;
use ZFS\Grid\View\Model\ColumnModel;

/**
 * Class GridFooterRow
 * @package ZFS\Grid\View\Helper
 */
class GridFooterRow extends AbstractHelper
{
    /**
     * @param ColumnModel[] $columns
     *
     * @return string
     */
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
