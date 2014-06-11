<?php

namespace ZFS\Grid\View\Helper;

use Zend\View\Helper\AbstractHelper;
use ZFS\Grid\View\Model\GridModel;

/**
 * Class GridBody
 * @package ZFS\Grid\View\Helper
 */
class GridBody extends AbstractHelper
{
    /**
     * @param GridModel $grid
     *
     * @return string
     */
    public function __invoke(GridModel $grid)
    {
        $output = '<tbody>';
        foreach ($grid->getRows() as $row) {
            $output .= $this->getView()->gridBodyRow($row, $grid->getColumns());
        }
        $output .= '</tbody>';

        return $output;
    }
}
