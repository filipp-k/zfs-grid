<?php
namespace ZFS\Grid\View\Model;

use ZFS\Grid\View\Collection\Cells;
use ZFS\Grid\View\Source\AbstractSourceAdapter;
use ZFS\Grid\View\Source;

/**
 * Class Cell
 *
 * @property Cells|Cell[]          cells
 * @property AbstractSourceAdapter sourceAdapter
 * @property string                value
 *
 * @package ZFS\Grid\View\Model
 */
class Cell extends AbstractModel
{
    /**
     * @param Cells $cells
     */
    protected function setCells($cells)
    {
        if (!$cells instanceof Cells) {
            throw new \InvalidArgumentException('Cells must be an instance of Cells class');
        }

        $this->data('cells', $cells);
    }
    /**
     * @param array|Source\AbstractSourceAdapter $value
     */
    protected function setSourceAdapter($value)
    {
        if (is_array($value)) {
            $sourceAdapter = Source\Factory::createSourceAdapter($value);
        } else {
            $sourceAdapter = $value;
        }

        if (!$sourceAdapter instanceof Source\AbstractSourceAdapter) {
            throw new \InvalidArgumentException(
                'SourceAdapter must be an array or instance of AbstractSourceAdapter class'
            );
        }

        $this->data('sourceAdapter', $sourceAdapter);
    }

    /**
     * @return string
     */
    public function getValue()
    {
        $value = $this->data('value');

        if ($value === null && $this->cells && $this->sourceAdapter) {
            $value = $this->sourceAdapter->get($this->cells->source);
        }

        return $value;
    }

    /**
     * @return array
     */
    public function getAttributes()
    {
        $attributes = parent::getAttributes();
        unset (
            $attributes['cells'],
            $attributes['sourceAdapter'],
            $attributes['value']
        );

        return $attributes;
    }
}
