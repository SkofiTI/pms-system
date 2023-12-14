<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
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
        
        $reservationData = Reservation::query()
            ->select('date_in', 'date_out', 'status')
            ->where('room_id', $roomId)
            ->get();
        
        $bookingDates = [];

        foreach ($reservationData as $bookingDate) {
            $dateIn = strtotime($bookingDate['date_in']);
            $dateOut = strtotime($bookingDate['date_out']);
        
            $bookingDates[] = [
                'date_in' => [
                    'day' => date('d', $dateIn),
                    'month' => date('m', $dateIn),
                    'year' => date('Y', $dateIn),
                    'time' => date('H:i', $dateIn),
                ],
                'date_out' => [
                    'day' => date('d', $dateOut),
                    'month' => date('m', $dateOut),
                    'year' => date('Y', $dateOut),
                    'time' => date('H:i', $dateOut),
                ]
            ];
        }

        return inertia('Room', [
            'room' => $roomData,
            'bookingDates' => $bookingDates,
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
