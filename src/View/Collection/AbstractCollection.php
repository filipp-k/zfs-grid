<?php
namespace ZFS\Grid\View\Collection;

use ZFS\Grid\View\Model\AbstractModel;

/**
 * Class AbstractCollection
 * @package ZFS\Grid\View\Collection
 */
abstract class AbstractCollection extends AbstractModel implements \Iterator
{
    /**
     * @var \Iterator
     */
    protected $iterator;

    /**
     * @param array|\Iterator $collection
     * @param array $options
     */
    public function __construct($collection = array(), $options = array())
    {
        if (is_array($collection)) {
            $collection = new \ArrayIterator($collection);
        }

        if (!$collection instanceof \Iterator) {
            throw new \InvalidArgumentException('Collection must be an array or an instance of \Iterator class');
        }

        $this->iterator = $collection;
        $this->setOptions($options);
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the current element
     * @link http://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     */
    public function current()
    {
        return $this->iterator->current();
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the key of the current element
     * @link http://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     */
    public function key()
    {
        return $this->iterator->key();
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Move forward to next element
     * @link http://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     */
    public function next()
    {
        $this->iterator->next();
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Rewind the Iterator to the first element
     * @link http://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     */
    public function rewind()
    {
        $this->iterator->rewind();
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Checks if current position is valid
     * @link http://php.net/manual/en/iterator.valid.php
     * @return boolean The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     */
    public function valid()
    {
        return $this->iterator->valid();
    }
}
