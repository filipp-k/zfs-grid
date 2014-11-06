<?php
namespace ZFS\Grid\View\Helper;

use Zend\View\Helper\AbstractHelper;
use ZFS\Grid\View\Model;

/**
 * Class GridFooterCell
 * @package ZFS\Grid\View\Helper
 */
class GridFooterCell extends AbstractHelper
{
    /**
     * @param Model\Column $column
     *
     * @return string
     */
    public function __invoke(Model\Column $column)
    {
        return $this->openTag($column) . $column->title . $this->closeTag();
    }

    /**
     * @param Model\Column $column
     *
     * @return string
     */
    public function openTag(Model\Column $column)
    {
        $output = '<th';
        foreach ($column->getAttributes() as $key => $value) {
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
        return '</th>';
    }
}
