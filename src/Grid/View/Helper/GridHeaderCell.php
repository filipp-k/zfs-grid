<?php
/**
 * Created by PhpStorm.
 * User: Qoma
 * Date: 10/06/14
 * Time: 20:53
 */

namespace ZFS\Grid\View\Helper;

use Zend\View\Helper\AbstractHelper;
use ZFS\Grid\View\Model\ColumnModel;

class GridHeaderCell extends AbstractHelper
{
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

        $output .= '>' . $column->getTitle() . '</th>';

        return $output;
    }
}
