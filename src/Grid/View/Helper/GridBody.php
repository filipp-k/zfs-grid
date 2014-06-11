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

class GridBody extends AbstractHelper
{
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
