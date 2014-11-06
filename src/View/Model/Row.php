<?php
namespace ZFS\Grid\View\Model;

use ZFS\Grid\View\Collection\Cells;
use ZFS\Grid\View\Collection\Rows;

/**
 * Class Row
 *
 * @property mixed        source Row source
 * @property Rows|Row[]   rows   Collection of grid rows
 * @property Cells|Cell[] cells  Collection of row cells
 *
 * @package ZFS\Grid\View\Model
 */
class Row extends AbstractModel
{
    /**
     * @return Cells
     */
    protected function getCells()
    {
        $cells = $this->data('cells');

        if (!$cells && $this->rows) {
            $cells = clone $this->rows->cells;
            $cells->row = $this;
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

        $cells->row = $this;

        $this->data('cells', $cells);
    }

    /**
     * @param Rows $rows
     */
    protected function setRows($rows)
    {
        if (!$rows instanceof Rows) {
            throw new \InvalidArgumentException('Rows must be an instance of Rows class');
        }

        $this->data('rows', $rows);
    }

    /**
     * @return array
     */
    public function getAttributes()
    {
        $attributes = parent::getAttributes();
        unset (
            $attributes['source'],
            $attributes['rows'],
            $attributes['cells']
        );

        return $attributes;
    }
}
