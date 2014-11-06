<?php
namespace ZFS\Grid\View\Model;

use ZFS\Grid\View\Collection\Columns;
use ZFS\Grid\View\Collection\Rows;

/**
 * Class Grid
 *
 * @property array|\Iterator  source  Grid source
 * @property Rows|Row[]       rows    Collection of grid rows
 * @property Columns|Column[] columns Collection of grid columns
 * @property array            thead
 * @property array            tbody
 * @property array            tfoot
 *
 * @package ZFS\Grid\View\Model
 */
class Grid extends AbstractModel
{
    /** @var array  */
    protected $data = array(
        'thead' => array(),
        'tbody' => array(),
        'tfoot' => array()
    );

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
     * @param array|Columns $value
     */
    protected function setColumns($value)
    {
        if (is_array($value)) {
            $columns = new Columns($value);
        } else {
            $columns = $value;
        }

        if (!$columns instanceof Columns) {
            throw new \InvalidArgumentException('Columns must be an array or an instance of Columns class');
        }

        $this->data('columns', $columns);
    }

    /**
     * @return Rows
     */
    protected function getRows()
    {
        $rows = $this->data('rows');

        if (!$rows and $this->source) {
            $rows = new Rows($this->source);
        }

        $rows->grid = $this;

        return $rows;
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
     * @param array $thead
     */
    protected function setTHead($thead)
    {
        if (!is_array($thead)) {
            throw new \InvalidArgumentException('THead must be an array');
        }

        $this->data('thead', $thead);
    }

    /**
     * @param array $tbody
     */
    protected function setTBody($tbody)
    {
        if (!is_array($tbody)) {
            throw new \InvalidArgumentException('TBody must be an array');
        }

        $this->data('tbody', $tbody);
    }

    /**
     * @param array $tfoot
     */
    protected function setTFoot($tfoot)
    {
        if (!is_array($tfoot)) {
            throw new \InvalidArgumentException('TFoot must be an array');
        }

        $this->data('tfoot', $tfoot);
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
            $attributes['columns'],
            $attributes['thead'],
            $attributes['tbody'],
            $attributes['tfoot']
        );

        return $attributes;
    }
}
