<?php
namespace ZFS\Grid\View\Helper;

use Zend\View\Helper\AbstractHelper;
use ZFS\Grid\View\Model;

/**
 * Class GridFooter
 * @package ZFS\Grid\View\Helper
 */
class GridFooter extends AbstractHelper
{
    /**
     * @param Model\Grid $grid
     *
     * @return string
     */
    public function __invoke(Model\Grid $grid)
    {
        $grid->format();

        $row = $this->getView()->gridFooterRow($grid->columns);

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

        $output = '<tfoot';
        foreach ($grid->tfoot as $key => $value) {
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
        return '</tfoot>';
    }
}
