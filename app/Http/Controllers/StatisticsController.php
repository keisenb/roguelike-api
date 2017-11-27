<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use App\Level;
use App\User;
use App\Character;
use App\CharacterHistory;
use Illuminate\Http\Request;


class StatisticsController extends BaseController
{

    public function AllScores() {
        return CharacterHistory::with(array('user'=>function($query){
            $query->select('id','display_name');
        }))->select('score', 'user_id')->orderBy('score', 'desc')->get();
    }

    public function AllLevels() {
        return Level::with(array('user'=>function($query){
            $query->select('id', 'display_name');
            }))->select('number', 'user_id')->orderBy('number', 'desc')->get();
    }

    public function UserCount() {
        $count = User::count();
        return response()->json(['count' => $count ], 200);
    }

    public function TotalDeaths() {
        $count = Character::whereNull('killed_by')->count();
        return response()->json(['count' => $count ], 200);
    }

    public function TotalMonsters() {
        $count = Character::whereNotNull('killed_by')->where('class_id', '!=', 1)->where('class_id', '!=', 2)->where('class_id', '!=', 3)->count();
        return response()->json(['count' => $count ], 200);
    }

    public function UserDeaths($id) {
        $user = User::findOrFail($id);
        $count = Character::join('character_history', 'characters.id', '=', 'character_history.character_id')->whereNotNull('killed_by')->where('user_id', $id)->count();
        return response()->json(['count' => $count ], 200);

    }

    public function UserMonsters($id) {
        $user = User::findOrFail($id);
        $characters = Character::join('character_history', 'characters.id', '=', 'character_history.character_id')->where('user_id', $user->id)->select(['character_id'])->distinct()->get();

        $ids = array();

        foreach($characters as $character) {
            array_push($ids, $character->character_id);
        }

        $count = Character::whereIn('killed_by', $ids)->count();
        return response()->json(['count' => $count ], 200);
    }


    public function ClassDistribution() {
        $mages = Character::where('class_id', 3)->count();
        $rangers = Character::where('class_id', 2)->count();
        $knights = Character::where('class_id', 1)->count();

        $response = array(
            'mage' => $mages,
            'archer' => $rangers,
            'knight' => $knights
        );
        return response()->json($response, 200);
    }


    public function AverageLevelAllGames() {
        return "not implemented";
    }


}
