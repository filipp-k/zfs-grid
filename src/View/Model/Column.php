<?php
namespace ZFS\Grid\View\Model;

use ZFS\Grid\View\Model;
use ZFS\Grid\View\Source;

/**
 * Class Column
 *
 * @property string   title
 * @property boolean  sorted
 * @property string   sortOrder
 * @property Cell     cell
 *
 * @package ZFS\Grid\View\Model
 */
class Column extends AbstractModel
{
    const SORTED_NONE = '';
    const SORTED_ASC = 'asc';
    const SORTED_DESC = 'desc';

    protected $defaultOptions = array(
        'sorted'     => self::SORTED_NONE,
        'sortOrder' => 0,
        'cell'       => array()
    );

    /**
     * @param array $options
     */
    public function __construct($options = array())
    {
        $options = array_merge($this->defaultOptions, $options);
        parent::__construct($options);
    }

    /**
     * @param boolean $sorted
     */
    protected function setSorted($sorted)
    {
        $this->data('sorted', (bool)$sorted);
    }

    /**
     * @param array|Cell $value
     *
     * @throws \InvalidArgumentException
     */
    protected function setCell($value)
    {
        if (is_array($value)) {
            $cellPrototype = new Cell($value);
        } else {
            $cellPrototype = $value;
        }

        if (!$cellPrototype instanceof Cell) {
            throw new \InvalidArgumentException('Cell prototype must be an array or instance of Cell class');
        }

        $this->data('cell', $cellPrototype);
    }

    /**
     * @return array
     */
    public function getAttributes()
    {
        $attributes = parent::getAttributes();
        unset (
            $attributes['cell'],
            $attributes['sortOrder'],
            $attributes['sorted'],
            $attributes['title']
        );

        return $attributes;
    }
}
