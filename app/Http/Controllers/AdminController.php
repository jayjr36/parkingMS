<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\StaffCar;
use App\Models\ParkingPayment;


class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function manageUsers()
    {
        $users = User::all(); 
        return view('admin.users', ['users' => $users]);
    }

    public function deleteUser(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users')
                         ->with('success', 'User deleted successfully');
    }

    public function registerStaffCarForm()
    {
        return view('admin.staffregistration');
    }

    public function registerStaffCar(Request $request)
    {
        $request->validate([
            'staff_name' => 'required|string|max:255',
            'car_plate_number' => 'required|string|max:20|unique:staff_cars,car_plate_number',
            'card_number' => 'required|string|max:50|unique:staff_cars,card_number',
        ]);

        StaffCar::create([
            'staff_name' => $request->input('staff_name'),
            'car_plate_number' => $request->input('car_plate_number'),
            'card_number' => $request->input('card_number'),
        ]);

        return redirect()->route('admin.dashboard')
                         ->with('success', 'Staff car registered successfully');
    }

    public function viewStaffDetails($id)
    {
        $staffCar = StaffCar::findOrFail($id);

        return view('admin.staff.view', ['staffCar' => $staffCar]);
    }

    public function allStaffDetails()
    {
        $staffCars = StaffCar::all();

        return view('admin.staff', ['staffCars' => $staffCars]);
    }

    public function allPayments()
    {
        $payments = ParkingPayment::all();

        return view('admin.payments', ['payments' => $payments]);
    }
}
