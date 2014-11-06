<?php
namespace ZFS\Grid\View\Helper;

use Zend\View\Helper\AbstractHelper;
use ZFS\Grid\View\Collection;

/**
 * Class GridHeaderRow
 * @package ZFS\Grid\View\Helper
 */
class GridHeaderRow extends AbstractHelper
{
    /**
     * @param Collection\Columns $columns
     *
     * @return string
     */
    public function __invoke(Collection\Columns $columns)
    {
        $columns->format();

        $cells = '';
        foreach ($columns as $column) {
            $cells .= $this->getView()->gridHeaderCell($column);
        }

        return $this->openTag($columns) . $cells . $this->closeTag();
    }

    /**
     * @param Collection\Columns $columns
     *
     * @return string
     */
    public function openTag(Collection\Columns $columns)
    {
        $output = '<tr';
        foreach ($columns->getAttributes() as $key => $value) {
            $output .= sprintf(' %s="%s" ', $key, $value);
        }
        $output .= '>';

        return $output;
    }

    /**
     * @return string
     */
    public function closeTag()
    {
        return '</tr>';
    }
}
