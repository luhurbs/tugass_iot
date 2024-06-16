<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Led;

class LedController extends Controller
{
    public function index()
    {
        $leds = Led::orderBy('name', 'ASC')
            ->get();
        $data['leds'] = $leds;


        $data ['title'] = 'LED Control';
        $data ['breadcrumbs'][]= [
            'title' => 'Dashboard',
            'url' => route('dashboard')
        ];
        $data ['breadcrumbs'][]= [
            'title' => 'Led Control',
            'url' => 'leds.index'
        ];

        return view('pages.led', $data);
    }

    function store(Request $request)
    {
        $validated = $request ->validate([
            'name' => [
                'required',
                'max:255',
                'min:3'
            ],
            'pin' => [
                'required',
                'numeric'
            ],
        ]);

        $led = Led::create($validated);

        return redirect()
        ->route('leds.index')
        ->with('success', 'Data Berhasil Ditambahakan');
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'status' => 'required|boolean', // Validasi bahwa status harus berupa boolean
        ]);

        // Temukan LED berdasarkan ID
        $led = Led::find($id);

        if ($led) {
            // Update status LED
            $led->status = $validated['status'];
            $led->save();

            return response()->json(['message' => 'LED status updated successfully']);
        }

        return response()->json(['message' => 'LED not found'], 404);
    }


}
