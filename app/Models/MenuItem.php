<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{

    public static function getNestedMenu($items, $parentId = null, $level = 0)
    {
        $data = collect();

        foreach ($items->where('parent_id', $parentId) as $k => $item) {
            if ($item->parent_id == $parentId) {
                $level++;
                $children = self::getNestedMenu($items, $item->id, $level);
                if ($children->isNotEmpty()) {
                    $item->children = $children;
                }
                 
            }
            $data->push($item);
        }
        return $data;
    }

}
