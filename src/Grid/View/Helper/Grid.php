<?php

namespace ZFS\Grid\View\Helper;

use Zend\View\Helper\AbstractHelper;
use ZFS\Grid\View\Model\GridModel;

/**
 * Class Grid
 * @package ZFS\Grid\View\Helper
 */
class Grid extends AbstractHelper
{
    /**
     * @param GridModel $grid
     *
     * @return $this|string
     */
    public function __invoke(GridModel $grid = null)
    {
        if ($grid) {
            return $this->render($grid);
        } else {
            return $this;
        }
    }

    /**
     * @param GridModel $grid
     *
     * @return string
     */
    public function render(GridModel $grid)
    {
        $output = $this->openTag($grid);
        $output .= $this->getView()->gridHeader($grid);
        $output .= $this->getView()->gridBody($grid);
        $output .= $this->getView()->gridFooter($grid);
        $output .= $this->closeTag();

        return $output;
    }

    /**
     * @param GridModel $grid
     *
     * @return string
     */
    public function openTag(GridModel $grid)
    {
        $output = '<table';

        if ($grid->getId()) {
            $output .= ' id="' . $grid->getId() . '"';
        }

        if ($grid->getCss()) {
            $output .= ' class="' . $grid->getCss() . '"';
        }

        if ($grid->getStyle()) {
            $output .= ' style="' . $grid->getStyle() . '"';
        }

        $output .= '>';

        return $output;
    }

    /**
     * @return string
     */
    public function closeTag()
    {
        return '</table>';
    }
}
