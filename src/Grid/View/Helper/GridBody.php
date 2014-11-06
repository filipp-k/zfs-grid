<?php
namespace ZFS\Grid\View\Helper;

use Zend\View\Helper\AbstractHelper;
use ZFS\Grid\View\Model;

/**
 * Class GridBody
 * @package ZFS\Grid\View\Helper
 */
class GridBody extends AbstractHelper
{
    /**
     * @param Model\Grid $grid
     *
     * @return string
     */
    public function __invoke(Model\Grid $grid)
    {
        $grid->format();

        $rows = '';
        foreach ($grid->rows as $row) {
            $rows .= $this->getView()->gridBodyRow($row);
        }

        return $this->openTag($grid) . $rows . $this->closeTag();
    }

    /**
     * @param Model\Grid $grid
     *
     * @return string
     */
    public function openTag(Model\Grid $grid)
    {
        $grid->format();

        $output = '<tbody';
        foreach ($grid->tbody as $key => $value) {
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
        return '</tbody>';
    }
}
