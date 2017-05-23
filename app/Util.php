<?php

namespace App;

/**
 * Created by PhpStorm.
 * User: Boys
 * Date: 11/5/2016
 * Time: 7:07 AM
 *
 * @todo explain this module's function - it looks like metachar escaping, but how does it fit into this project?
 */
class Util
{
    /**
     * @param $data
     * @return string
     */
    public static function encodeJSON($data)
    {
        $json = null;
        
        if(!is_null($data) && !empty($data))
        {
            $json =  json_encode($data,
                                 JSON_HEX_APOS |
                                 JSON_HEX_QUOT |
                                 JSON_HEX_AMP |
                                 JSON_UNESCAPED_SLASHES);
        }

        return $json;
    }
}