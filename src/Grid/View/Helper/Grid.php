<?php
/**
 * Created by PhpStorm.
 * User: Qoma
 * Date: 10/06/14
 * Time: 13:56
 */

namespace ZFS\Grid\View\Helper;

use Zend\View\Helper\AbstractHelper;
use ZFS\Grid\View\Model\GridModel;

/**
 * Class Grid
 * @package ZFS\Grid\View\Helper
 */
class Grid extends AbstractHelper
{
    public function __invoke(GridModel $grid = null)
    {
        if ($grid) {
            return $this->render($grid);
        } else {
            return $this;
        }
    }

    public function render(GridModel $grid)
    {
        $output = $this->openTag($grid);
        $output .= $this->getView()->gridHeader($grid);
        $output .= $this->getView()->gridBody($grid);
        $output .= $this->getView()->gridFooter($grid);
        $output .= $this->closeTag();

        return $output;
    }

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

    public function closeTag()
    {
        return '</table>';
    }
}
