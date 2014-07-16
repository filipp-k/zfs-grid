<?php

namespace ZFS\Grid\View\Helper;

use Zend\View\Helper\AbstractHelper;
use ZFS\Grid\View\Model\ColumnModel;

/**
 * Class GridHeaderCell
 * @package ZFS\Grid\View\Helper
 */
class GridHeaderCell extends AbstractHelper
{
    /**
     * @param ColumnModel $column
     *
     * @return string
     */
    public function __invoke(ColumnModel $column)
    {
        $value = $this->getView()->gridHeaderCellValue($column);

        $output = '<th';

        if ($column->getId()) {
            $output .= ' id="' . $column->getId() . '"';
        }

        if ($column->getTitleCss()) {
            $output .= ' class="' . $column->getTitleCss() . '"';
        }

        if ($column->getTitleStyle()) {
            $output .= ' style="' . $column->getTitleStyle() . '"';
        }

        $output .= '>' . $value . '</th>';

        return $output;
    }
}
