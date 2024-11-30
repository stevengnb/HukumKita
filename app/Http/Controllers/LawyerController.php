<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Lawyer;
use Illuminate\Http\Request;

class LawyerController extends Controller
{
    //
    public function getLawyers(){
        $lawyers = Lawyer::paginate(10);

        foreach ($lawyers as $lawyer) {
            $averageRating = $lawyer->appointments->avg('rating');

            $lawyer->appointments_avg_rating = $averageRating ?: 0;
        }


        return view('lawyers', compact('lawyers'));
    }
}
