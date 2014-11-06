<?php
namespace ZFS\Grid\View\Helper;

use Zend\View\Helper\AbstractHelper;
use ZFS\Grid\View\Model;

/**
 * Class GridHeaderCell
 * @package ZFS\Grid\View\Helper
 */
class GridHeaderCell extends AbstractHelper
{
    /**
     * @param Model\Column $column
     *
     * @return string
     */
    public function __invoke(Model\Column $column)
    {
        $columnAttributes = $column->getAttributes();

        $output = '<th';
        foreach ($columnAttributes as $key => $value) {
            $output .= sprintf(' %s="%s" ', $key, $value);
        }
        $output .= '>' . $column->title . '</th>';

        return $output;
    }
}
