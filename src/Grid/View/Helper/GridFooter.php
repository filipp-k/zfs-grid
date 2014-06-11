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

class GridFooter extends AbstractHelper
{
    public function __invoke(GridModel $grid)
    {
        $output = '<tfoot>';
        $output .= $this->getView()->gridFooterRow($grid->getColumns());
        $output .= '</tfoot>';

        return $output;
    }
}
