<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use App\ClassItem;

class ItemController extends BaseController
{


    public function ItemsFromClass($classid)
    {
        return ClassItem::get($classid);
    }



    public function ClassOfItem($itemid)
    {
        return ClassItem::findOrFail($itemid);
    }
}