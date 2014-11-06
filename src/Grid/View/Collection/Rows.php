<?php
namespace ZFS\Grid\View\Collection;

use ZFS\Grid\View\Model;

/**
 * Class Collection
 *
 * @property Model\Grid         grid Grid
 * @property array|\Iterator    source Rows source
 * @property Cells|Model\Cell[] cells Rows cells
 *
 * @package ZFS\Grid\View\Collection
 */
class Rows extends AbstractCollection
{
    /**
     * @return Model\Row
     */
    public function current()
    {
        $item = parent::current();

        if (!$item instanceof Model\Row) {
            $row = new Model\Row();
            $row->source = $item;
        } else {
            $row = $item;
        }

        $row->rows = $this;

        return $row;
    }

    /**
     * @param Model\Grid $grid
     */
    protected function setGrid($grid)
    {
        if (!$grid instanceof Model\Grid) {
            throw new \InvalidArgumentException('Grid must be an instance of Grid class');
        }

        $this->data('grid', $grid);
    }

    /**
     * @return mixed|null
     */
    protected function getSource()
    {
        $source = $this->data('source');

        if (!$source && $this->grid) {
            $source = $this->grid->source;
        }

        return $source;
    }

    /**
     * @param array|\Iterator $value
     */
    protected function setSource($value)
    {
        if (!is_array($value) && !$value instanceof \Iterator) {
            throw new \InvalidArgumentException('Source must be an array or an instance of \Iterator class');
        }

        $this->data('source', $value);
    }

    /**
     * @return Cells|Model\Cell[]
     */
    protected function getCells()
    {
        $cells = $this->data('cells');

        if (!$cells && $this->grid) {
            $cells = $this->grid->columns->cells;
        }

        return $cells;
    }

    /**
     * @param array|Cells $cells
     */
    protected function setCells($cells)
    {
        if (is_array($cells)) {
            $cells = new Cells($cells);
        }

        if (!$cells instanceof Cells) {
            throw new \InvalidArgumentException('Cells must be an array or an instance of Cells class');
        }

        $this->data('cells', $cells);
    }

    /**
     * @return array
     */
    public function getAttributes()
    {
        $attributes = parent::getAttributes();
        unset (
            $attributes['cells'],
            $attributes['source'],
            $attributes['grid']
        );

        return $attributes;
    }
}
