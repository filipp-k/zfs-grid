<?php
namespace ZFS\Grid\View\Helper;

use Zend\View\Helper\AbstractHelper;
use ZFS\Grid\View\Model;

/**
 * Class GridBodyRow
 * @package ZFS\Grid\View\Helper
 */
class GridBodyRow extends AbstractHelper
{
    /**
     * @param Model\Row $row
     *
     * @return string
     */
    public function __invoke(Model\Row $row)
    {
        $row->format();

        $cells = '';
        foreach ($row->cells as $cell) {
            $cells .= $this->getView()->gridBodyCell($cell);
        }

        return $this->openTag($row) . $cells . $this->closeTag();
    }

    /**
     * @param Model\Row $row
     *
     * @return string
     */
    public function openTag(Model\Row $row)
    {
        $row->format();

        $output = '<tr';
        foreach ($row->getAttributes() as $key => $value) {
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
