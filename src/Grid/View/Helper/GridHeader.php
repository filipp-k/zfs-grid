<?php

namespace ZFS\Grid\View\Helper;

use Zend\View\Helper\AbstractHelper;
use ZFS\Grid\View\Model\GridModel;

/**
 * Class GridHeader
 * @package ZFS\Grid\View\Helper
 */
class GridHeader extends AbstractHelper
{
    /**
     * @param GridModel $grid
     *
     * @return string
     */
    public function __invoke(GridModel $grid)
    {
        $output = '<thead>';
        $output .= $this->getView()->gridHeaderRow($grid->getColumns());
        $output .= '</thead>';

        return $output;
    }
}
