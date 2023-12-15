<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\Reservation;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;

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

    public function store(Request $request)
    {
        $validated = $request->validate([
            'room_id' => 'required',
            'date_in' => 'required|date',
            'date_out' => 'required|date|after:date_in',
            'name' => 'required',
            'surname' => 'required',
            'patronymic' => 'nullable',
            'address' => 'required',
            'phone' => 'required',
            'passport' => 'required',
        ]);

        $dateIn = Carbon::parse($validated['date_in'])
            ->setTime(now()->hour, now()->minute, now()->second);

        $dateOut = Carbon::parse($validated['date_out'])
            ->setTime(now()->hour, now()->minute, now()->second);

        $reservation = Reservation::createOrFirst([
            'room_id' => $validated['room_id'],
            'date_in' => $dateIn,
            'date_out' => $dateOut,
            'status' => 'booked',
        ]);

        Guest::create([
            'reserv_id' => $reservation->id,
            'name' => $validated['name'],
            'surname' => $validated['surname'],
            'patronymic' => $validated['patronymic'],
            'address' => $validated['address'],
            'number' => $validated['phone'],
            'passport' => $validated['passport'],
        ]);

        return back();
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
