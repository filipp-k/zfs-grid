<?php
namespace ZFS\Grid\View\Helper;

use Zend\View\Helper\AbstractHelper;
use ZFS\Grid\View\Model;

/**
 * Class GridHeader
 * @package ZFS\Grid\View\Helper
 */
class GridHeader extends AbstractHelper
{
    /**
     * @param Model\Grid $grid
     *
     * @return string
     */
    public function __invoke(Model\Grid $grid)
    {
        $grid->format();

        $row = $this->getView()->gridHeaderRow($grid->columns);

        return $this->openTag($grid) . $row . $this->closeTag();
    }

    /**
     * @param Model\Grid $grid
     *
     * @return string
     */
    public function openTag(Model\Grid $grid)
    {
        $grid->format();

        $output = '<thead';
        foreach ($grid->thead as $key => $value) {
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
        return '</thead>';
    }
}
