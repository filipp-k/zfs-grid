<?php
namespace ZFS\Grid\View\Helper;

use Zend\View\Helper\AbstractHelper;
use ZFS\Grid\View\Model;

/**
 * Class GridBodyCell
 * @package ZFS\Grid\View\Helper
 */
class GridBodyCell extends AbstractHelper
{
    /**
     * @param Model\Cell $cell
     *
     * @return string
     */
    public function __invoke(Model\Cell $cell)
    {
        return $this->openTag($cell) . $cell->value . $this->closeTag();
    }

    /**
     * @param Model\Cell $cell
     *
     * @return string
     */
    public function openTag(Model\Cell $cell)
    {
        $cell->format();

        $output = '<td';
        foreach ($cell->getAttributes() as $key => $value) {
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
