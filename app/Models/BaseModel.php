<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    /**
     * Generate drop-down select data with basic IDs.
     *
     * @param string $field_name
     *
     * @return array
     */
    public static function getSelectData($field_name = 'name')
    {
        $collection = parent::all();

        return self::getItems($collection, $field_name);
    }

    /**
     * Generate items for drop-down select data with basic IDs.
     *
     * @param $collection
     * @param string $field_name
     *
     * @return array
     */
    public static function getItems($collection, $field_name)
    {
        $items = [];

        foreach ($collection as $model) {
            $items[$model->id] = [
                'id' => $model->id,
                'name' => $model->$field_name,
                'model' => $model,
            ];
        }

        foreach ($items as $id => $item) {
            $items[$item['id']] = $item['name'];
        }

        return $items;
    }
}
