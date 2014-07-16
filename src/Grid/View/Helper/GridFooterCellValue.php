<?php

namespace ZFS\Grid\View\Helper;

use Zend\View\Helper\AbstractHelper;
use ZFS\Grid\View\Model\ColumnModel;

/**
 * Class GridFooterCellValue
 * @package ZFS\Grid\View\Helper
 */
class GridFooterCellValue extends AbstractHelper
{
    /**
     * @param ColumnModel $column
     *
     * @return mixed|null
     */
    public function __invoke(ColumnModel $column)
    {
        $callable = $column->getTitleFormatter();
        if (is_callable($callable)) {
            $value = call_user_func($callable, $column);
        } else {
            $value = $column->getTitle();
        }

        return $value;
    }
}
