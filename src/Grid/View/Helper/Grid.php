<?php
namespace ZFS\Grid\View\Helper;

use Zend\View\Helper\AbstractHelper;
use \ZFS\Grid\View\Model;

/**
 * Class Grid
 *
 * @package ZFS\Grid\View\Helper
 */
class Grid extends AbstractHelper
{
    /**
     * @param Model\Grid $grid
     *
     * @return $this|string
     */
    public function __invoke(Model\Grid $grid = null)
    {
        if ($grid) {
            return $this->render($grid);
        } else {
            return $this;
        }
    }

    /**
     * @param Model\Grid $grid
     *
     * @return string
     */
    public function render(Model\Grid $grid)
    {
        $grid->format();

        $body = $this->getView()->gridBody($grid);
        $header = $this->getView()->gridHeader($grid);
        $footer = $this->getView()->gridFooter($grid);


        return $this->openTag($grid) . $header . $body . $footer . $this->closeTag();
    }

    /**
     * @param Model\Grid $grid
     *
     * @return string
     */
    public function openTag(Model\Grid $grid)
    {
        $grid->format();

        $output = '<table';
        foreach ($grid->getAttributes() as $key => $value) {
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
        return '</table>';
    }
}
