<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use App\ClassItem;

class ItemController extends BaseController
{
    /**
     * @SWG\Get(
     *   path="/classitems/{id}",
     *   tags={"Items"},
     *   summary="Get all allowed items for a class.",
     *   @SWG\Parameter(
     *       name="classid",
     *       in="path",
     *       required=true,
     *       type="integer",
     *       description="Class id"
     *   ),
     *   @SWG\Response(
     *     response=200,
     *     description="A list of items",
     *     @SWG\Schema(ref="#/definitions/classItems")
     *   ),
     *   @SWG\Response(
     *     response=404,
     *     description="No class w/ id found in tables, or error."
     *   )
     * )
     */
    public function ItemsFromClass($classid)
    {
        return ClassItem::get($classid);
    }

    /**
     * @SWG\Get(
     *   path="/itemclass/{id}",
     *   tags={"Items"},
     *   summary="Get the class of an item.",
     *   @SWG\Parameter(
     *       name="itemid",
     *       in="path",
     *       required=true,
     *       type="integer",
     *       description="Item id"
     *   ),
     *   @SWG\Response(
     *     response=200,
     *     description="Character class",
     *     @SWG\Schema(ref="#/definitions/CharacterClass")
     *   ),
     *   @SWG\Response(
     *     response=404,
     *     description="No item w/ id found in tables, or error."
     *   )
     * )
     */
    public function ClassOfItem($itemid)
    {
        return ClassItem::findOrFail($itemid);
    }
}