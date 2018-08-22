<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Want;

class RankingController extends Controller
{
    public function want()
    {
        $items = \DB::table('item_user')
                    ->join('items', 'item_user.item_id', '=', 'items.id')
                    ->select('items.*', \DB::raw('COUNT(*) as count'))
                    ->whereRaw('type = "want"')
                    ->groupBy('items.id', 'items.code', 'items.name', 'items.url', 'items.image_url','items.created_at', 'items.updated_at')
                    ->orderBy('count', 'DESC')
                    ->take(10)
                    ->get();

        $status = 'Wants';

        return view('ranking.want', compact('items', 'status'));
    }
    
    public function have()
    {
        $items = \DB::table('item_user')
                    ->join('items', 'item_user.item_id', '=', 'items.id')
                    ->select('items.*', \DB::raw('COUNT(*) as count'))
                    ->whereRaw('type = "have"')
                    ->groupBy('items.id', 'items.code', 'items.name', 'items.url', 'items.image_url','items.created_at', 'items.updated_at')
                    ->orderBy('count', 'DESC')
                    ->take(10)
                    ->get();

        $status = 'Has';

        return view('ranking.have', compact('items', 'status'));
    }
}