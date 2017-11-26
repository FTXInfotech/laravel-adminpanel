<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    /**
     * Generate drop-down select data with basic IDs
     *
     * @param null $id
     * @param null $val
     * @return array
     */
    public static function getSelectData($id = null, $val = null)
    {

        $collection = parent::all();
        return self::getItems($collection);
    }

    /**
     * Generate items for drop-down select data with basic IDs
     *
     * @param $collection
     * @return array
     */
    public static function getItems($collection)
    {
        $items = array();

        foreach($collection as $model)
        {
            $items[$model->id] = [
                'id'    => $model->id,
                'name'  => $model->name,
                'model' => $model,
            ];
        }

        foreach($items as $id => $item)
        {
            if(isset(static::$selectHTMLFormat) && static::$selectHTMLFormat !== '')
            {
                $items[$item['id']] = static::generateSelectName($item['model'], static::$selectHTMLFormat);
            }
            else
            {
                $items[$item['id']] = $item['name'];
            }
        }

        return $items;
    }
}
