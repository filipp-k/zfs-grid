<?php

namespace ZFS\Grid\View\Helper;

use Zend\View\Helper\AbstractHelper;
use ZFS\Grid\View\Model\GridModel;

/**
 * Class GridFooter
 * @package ZFS\Grid\View\Helper
 */
class GridFooter extends AbstractHelper
{
    /**
     * @param GridModel $grid
     *
     * @return string
     */
    public function __invoke(GridModel $grid)
    {
        $output = '<tfoot>';
        $output .= $this->getView()->gridFooterRow($grid->getColumns());
        $output .= '</tfoot>';

        return $output;
    }
}
