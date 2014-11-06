<?php
namespace ZFS\Grid\View\Collection;

use ZFS\Grid\View\Model;

/**
 * Class Columns
 *
 * @property Cells|Model\Cell[] cells Collection of cell prototypes
 *
 * @package ZFS\Grid\View\Collection
 */
class Columns extends AbstractCollection
{
    /**
     * @return Model\Column
     */
    public function current()
    {
        $item = parent::current();

        if (!$item instanceof Model\Column) {
            $column = new Model\Column($item);
        } else {
            $column = $item;
        }

        return $column;
    }

    /**
     * @return Cells
     */
    protected function getCells()
    {
        $cells = array();
        foreach ($this as $column) {
            $cells[] = $column->cell;
        }

        return new Cells($cells);
    }

    protected function setCells()
    {
        throw new \Exception('Cells property have only getter');
    }

//    /**
//     *
//     */
//    public function sort()
//    {
//        uasort($this->iterator, function ($a, $b) {
//            /** @var Model\Column $a */
//            /** @var Model\Column $b */
//
//            if ($a->sortOrder == $b->sortOrder) {
//                return 0;
//            } elseif ($a->sortOrder > $b->sortOrder) {
//                return 1;
//            } else {
//                return -1;
//            }
//        });
//    }

    /**
     * @return array
     */
    public function getAttributes()
    {
        $attributes = parent::getAttributes();
        unset (
            $attributes['cells']
        );

        return $attributes;
    }
}
