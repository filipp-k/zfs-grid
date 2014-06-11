<?php

namespace ZFS\Grid\View\Helper;

use Zend\View\Helper\AbstractHelper;
use ZFS\Grid\View\Model\ColumnModel;

/**
 * Class GridHeaderRow
 * @package ZFS\Grid\View\Helper
 */
class GridHeaderRow extends AbstractHelper
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
            $output .= $this->getView()->gridHeaderCell($column);
        }
        $output .= '</tr>';

        return $output;
    }
}
