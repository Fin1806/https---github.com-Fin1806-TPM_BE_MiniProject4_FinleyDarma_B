<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Price;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class carController extends Controller
{
    // Display the welcome page with all cars
    public function welcome()
    {
        $cars = Car::all();
        return view('welcome', compact('cars'));
    }

    // Store a new car
    public function store(Request $request)
    {
        $request->validate([
            'Cars' => 'required|min:3',
            'Brand' => 'required|max:15',
            'Car_Type' => 'required|min:3',
            'Fuel_Type' => 'required|min:5',
            'image' => 'required|mimes:png,jpg,jpeg',
            'price_num' => 'required|exists:prices,id',
        ]);

        // Handle the file upload
        $fileName = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = $request->Cars . '-' . $request->Brand . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/images', $fileName);
        }

        // Create a new car record
        Car::create([
            'Cars' => $request->Cars,
            'Brand' => $request->Brand,
            'Car_Type' => $request->Car_Type,
            'Fuel_Type' => $request->Fuel_Type,
            'image' => $fileName,
            'price_id' => $request->price_num,
        ]);

        session()->flash('success', $request->Cars . ' has been added!');
        return redirect(route('welcome'));
    }

    // Show the form to create a new car
    public function createCars()
    {
        $prices = Price::all();
        return view('createCars', compact('prices'));
    }

    // Show the form to edit an existing car
    public function editCars($id)
    {
        $prices = Price::all();
        $car = Car::findOrFail($id);
        return view('editCars', compact('car', 'prices'));
    }

    // Update an existing car
    public function updateCar($id, Request $request)
    {
        $request->validate([
            'Cars' => 'required|min:3',
            'Brand' => 'required|max:15',
            'Car_Type' => 'required|min:3',
            'Fuel_Type' => 'required|min:5',
            'image' => 'nullable|mimes:png,jpg,jpeg',
            'price_num' => 'required|exists:prices,id',
        ]);

        $car = Car::findOrFail($id);

        // Handle the file upload if a new image is provided
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($car->image && Storage::exists('public/images/' . $car->image)) {
                Storage::delete('public/images/' . $car->image);
            }

            // Upload the new image
            $file = $request->file('image');
            $fileName = $request->Cars . '-' . $request->Brand . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/images', $fileName);

            $car->image = $fileName; // Update the image field
        }

        // Update the car record
        $car->update([
            'Cars' => $request->Cars,
            'Brand' => $request->Brand,
            'Car_Type' => $request->Car_Type,
            'Fuel_Type' => $request->Fuel_Type,
            'price_id' => $request->price_num,
        ]);

        session()->flash('success', $request->Cars . ' Data has been edited!');
        return redirect(route('welcome'));
    }

    // Delete a car
    public function deleteCar($id)
    {
        $car = Car::findOrFail($id);

        // Delete the image file if it exists
        if ($car->image && Storage::exists('public/images/' . $car->image)) {
            Storage::delete('public/images/' . $car->image);
        }

        // Delete the car record
        $car->delete();

        session()->flash('success', 'Data has been deleted!');
        return redirect(route('welcome'));
    }
}
