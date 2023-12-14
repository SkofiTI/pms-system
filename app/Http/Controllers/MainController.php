<?php

namespace App\Http\Controllers;

use App\Models\Room;

class MainController extends Controller
{
    public function index()
    {
        $rooms = Room::query()
            ->join('categories', 'rooms.category_id', '=', 'categories.category_id')
            ->select($this->getRoomFields())
            ->get();

        return inertia('Home', [
            'rooms' => $rooms,
        ]);
    }

    public function show($roomId)
    {
        $roomData = Room::query()
            ->join('categories', 'rooms.category_id', '=', 'categories.category_id')
            ->select($this->getRoomFields())
            ->where('room_id', $roomId)
            ->first();

        return inertia('Room', [
            'room' => $roomData,
        ]);
    }

    private function getRoomFields()
    {
        return [
            'room_id',
            'floor',
            'square',
            'categories.name',
            'categories.price',
            'categories.count_room',
            'categories.max_capacity',
            'categories.conditioner',
            'categories.tv',
            'categories.smoke',
            'categories.balcony',
        ];
    }
}
