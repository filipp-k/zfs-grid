<?php
/**
 * Created by PhpStorm.
 * User: Qoma
 * Date: 10/06/14
 * Time: 13:56
 */

namespace ZFS\Grid\View\Helper;

use Zend\View\Helper\AbstractHelper;
use ZFS\Grid\View\Model\GridModel;

class GridHeader extends AbstractHelper
{
    public function __invoke(GridModel $grid)
    {
        $output = '<thead>';
        $output .= $this->getView()->gridHeaderRow($grid->getColumns());
        $output .= '</thead>';

        return $output;
    }
}
