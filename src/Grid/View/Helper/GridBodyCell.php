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

class GridBodyCell extends AbstractHelper
{
    public function __invoke($row, ColumnModel $column)
    {
        return '<td>' . $this->getView()->gridRowValue($row, $column) . '</td>';
    }
}
