<?php

namespace Rapture\Helper;

/**
 * Class Arrays
 *
 * @package Rapture\Helper
 * @author  Iulian N. <rapture@iuliann.ro>
 * @license LICENSE MIT
 */
class Arrays
{
    /**
     * Proper range with corresponding keys
     *
     * @param int $start First value
     * @param int $end   Last value
     * @param int $step  Step
     *
     * @return array
     */
    public static function range(int $start, int $end, $step = 1):array
    {
        return array_combine(range($start, $end, $step), range($start, $end, $step));
    }

    /**
     * Example:
     *  [
     *      [firstname => 'John', 'lastname' => 'Doe']
     *  ] => ['John' => 'Doe']
     *
     * @param array  $data  Original data
     * @param string $key   Key name
     * @param string $value Value key name
     *
     * @return array
     */
    public static function toKeyValue($data, $key = '', $value = ''):array
    {
        $result = [];
        $index = 0;

        foreach ($data as $item) {
            if (is_array($item)) {
                $result[$item[$key] ?? $index++] = $item[$value] ?? null;
            }
        }

        return $result;
    }

    /**
     * @param array  $data         Collection array|iterator
     * @param string $key          Key name
     * @param string $value        Value key name
     * @param string $methodPrefix Method prefix
     *
     * @return array
     */
    public static function collectionToKeyValue($data, $key = '', $value = '', $methodPrefix = 'get'):array
    {
        $result = [];
        $keyMethod = $methodPrefix . $key;
        $valueMethod = $methodPrefix . $value;

        foreach ($data as $item) {
            $result[$item->{$keyMethod}()] = $item->{$valueMethod}();
        }

        return $result;
    }
}