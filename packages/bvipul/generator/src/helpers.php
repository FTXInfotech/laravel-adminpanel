<?php

if (!function_exists('insert_into_array')) {
    function insert_into_array(&$array, array $keys, $value)
    {
        $last = array_pop($keys);
        foreach ($keys as $key) {
            if (!array_key_exists($key, $array) ||
                  array_key_exists($key, $array) && !is_array($array[$key])) {
                $array[$key] = [];
            }
            $array = &$array[$key];
        }
        if (is_array($array[$last])) {
            $array[$last] = array_merge($array[$last], $value);
        } else {
            $array[$last] = $value;
        }
    }
}

if (!function_exists('add_key_value_in_file')) {
    function add_key_value_in_file($file_name, $new_key_value, $parent_keys = null)
    {
        $file_array = eval(str_replace('<?php', '', str_replace('?>', '', file_get_contents($file_name))));
        if (!empty($parent_keys)) {
            $parents = explode('.', $parent_keys);
            insert_into_array($file_array, $parents, $new_key_value);
        } else {
            foreach ($new_key_value as $key => $value) {
                $file_array[$key] = $value;
            }
        }

        $file_contents_new = "<?php\nreturn [\n";
        $file_contents_new .= get_array_contents($file_array);
        $file_contents_new .= '];';

        file_put_contents($file_name, $file_contents_new);
    }
}


if (!function_exists('get_array_contents')) {
    function get_array_contents($arr)
    {
        $contents = '';
        foreach ($arr as $key => $value) {
            if (is_array($value)) {
                $contents .= "\t\"$key\" => [\n";
                $contents .= get_array_contents($value);
                $contents .= "\t],\n";
            } else {
                $contents .= "\t\"$key\" => \"$value\",\n";
            }
        }

        return $contents;
    }
}