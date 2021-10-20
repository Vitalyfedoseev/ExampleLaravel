<?php

namespace App\Http\Traits;

use Illuminate\Http\Request;

trait RequestHandlers
{
    /**
     * Validation and sanitise Request params
     *
     * @param array $params
     * @return array
     */
    public static function sanitiseRequest(array $params): array
    {
        $result = [];
        foreach ($params as $param) {
            if (is_null(Request($param[0]))) {
                continue;
            } 
            switch ($param[1]){
                case 'int':
                    $result[$param[0]] = (int) Request($param[0]);
                    break;
                case 'float':
                    $result[$param[0]] = (float) Request($param[0]);
                    break;
                case 'string':
                    $result[$param[0]] = (string) Request($param[0]);
                    break;
                case 'array':
                    $result[$param[0]] = (array) Request($param[0]);
                    break;
                case 'bool':
                    $result[$param[0]] = (bool) Request($param[0]);
                    break;
            }
            if (!empty($param[2]) && !in_array($result[$param[0]], $param[2])) {
                unset($result[$param[0]]);
            }
        }
        return $result;
    }
}