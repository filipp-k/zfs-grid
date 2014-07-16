<?php

namespace ZFS\Grid\View\Helper;

use Zend\View\Helper\AbstractHelper;
use ZFS\Grid\View\Model\ColumnModel;

/**
 * Class GridFooterCell
 * @package ZFS\Grid\View\Helper
 */
class GridFooterCell extends AbstractHelper
{
    /**
     * @param ColumnModel $column
     *
     * @return string
     */
    public function __invoke(ColumnModel $column)
    {
        $output = '<th';

        if ($column->getId()) {
            $output .= ' id="' . $column->getId() . '"';
        }

        if ($column->getCss()) {
            $output .= ' class="' . $column->getCss() . '"';
        }

        if ($column->getStyle()) {
            $output .= ' style="' . $column->getStyle() . '"';
        }

        $output .= '>' . $this->getView()->gridFooterCellValue($column) . '</th>';

        return $output;
    }
}
