<?php
namespace ZFS\Grid\View\Collection;

use ZFS\Grid\View\Model;

/**
 * Class Cells
 *
 * @property Model\Row row
 * @property mixed     source
 *
 * @package ZFS\Grid\View\Collection
 */
class Cells extends AbstractCollection
{
    /**
     * @throws \Exception
     * @return Model\Cell
     */
    public function current()
    {
        $cell = parent::current();

        if (is_array($cell)) {
            $cell = new Model\Cell($cell);
        }

        if (!$cell instanceof Model\Cell) {
            throw new \Exception('Item is not an instance of Cell class');
        }

        $cell->cells = $this;

        return $cell;
    }

    /**
     * @param Model\Row $row
     */
    protected function setRow($row)
    {
        if (!$row instanceof Model\Row) {
            throw new \InvalidArgumentException('Row must be an instance of Row class');
        }

        $this->data('row', $row);
    }

    /**
     * @return mixed
     */
    protected function getSource()
    {
        $source = $this->data('source');

        if (!$source && $this->row) {
            $source = $this->row->source;
        }

        return $source;
    }

    /**
     * @return array
     */
    public function getAttributes()
    {
        $attributes = parent::getAttributes();
        unset (
            $attributes['row'],
            $attributes['source']
        );

        return $attributes;
    }
}
