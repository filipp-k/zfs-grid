<?php
namespace ZFS\Grid\View\Source;

/**
 * Class Factory
 * @package ZFS\Grid\View\Source
 */
class Factory
{
    /**
     * @param array $options
     *
     * @return AbstractSourceAdapter
     */
    public static function createSourceAdapter($options)
    {
        if (!isset($options['name'])) {
            $options['name'] = 'ArrayAccess';
        }

        if (isset($options['name'])) {
            switch (strtolower($options['name'])) {
                case 'arrayaccess':
                    $sourceAdapter = new ArrayAccessSourceAdapter();
                    break;
                case 'callback':
                    $sourceAdapter = new CallbackSourceAdapter();
                    break;
                case 'methodaccess':
                    $sourceAdapter = new MethodAccessSourceAdapter();
                    break;
                case 'propertyaccess':
                    $sourceAdapter = new PropertyAccessSourceAdapter();
                    break;
                case 'rowaccess':
                    $sourceAdapter = new RowAccessSourceAdapter();
                    break;
                default:
                    throw new \InvalidArgumentException('Unknown source adapter name');
            }

            $sourceAdapter->setOptions($options);

            return $sourceAdapter;
        }

        return $options;
    }
}