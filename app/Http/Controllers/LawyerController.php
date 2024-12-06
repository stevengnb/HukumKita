<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Expertise;
use App\Models\Lawyer;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class LawyerController extends Controller
{
    //
    public function getLawyers(Request $req) {
        $query = Lawyer::with('expertises');

        // Check if price_range is set and apply the filter
        if ($req->has('price_range') && $req->input('price_range') !== '') {
            if ($req->input('price_range') == '1-3') {
                $query->whereBetween('rate', [1, 3]);
            } elseif ($req->input('price_range') == '4-5') {
                $query->whereBetween('rate', [4, 5]);
            }
        }

        // Check if expertise is set and apply the filter
        if ($req->has('expertise')) {
            if(!($req->input('expertise') == '')){
                $query->whereHas('expertises', function ($q) use ($req) {
                    $q->where('id', $req->input('expertise'));
                });
            }
        }

        // Check if there's a search term and apply it
        if ($req->has('search') && $req->input('search') !== '') {
            $query->where('name', 'like', '%' . $req->input('search') . '%');
        }

        $lawyers = $query->paginate(8);


        foreach ($lawyers as $lawyer) {
            $averageRating = $lawyer->appointments->avg('rating');
            $totalRatings = $lawyer->appointments->count();

            $lawyer->appointments_total_ratings = $totalRatings;
            $lawyer->appointments_avg_rating = $averageRating ?: 0;
            $lawyer->exp_years = number_format(abs(Carbon::now()->diffInYears($lawyer->experience)), 0);
            $lawyer->expertise_names = $lawyer->expertises->pluck('name')->toArray();
        }

        $expertises = Expertise::all();

        return view('lawyers', compact('lawyers', 'expertises'));
    }



    public function getLawyer($id) {
        $lawyer = Lawyer::with(['expertises', 'appointments.user'])->find($id);
        $lawyer->expertise_names = $lawyer->expertises->pluck('name')->toArray();
        $lawyer->exp_years = number_format(abs(Carbon::now()->diffInYears($lawyer->experience)), 0);
        $lawyer->appointments_total_ratings = $lawyer->appointments->count();
        $lawyer->appointments_avg_rating = $lawyer->appointments->avg('rating') ?: 0;

        $lawyer->appointments->each(function($appointment) {
            $appointment->user_name = $appointment->user->name;
            $appointment->user_profile = $appointment->user->profile;
        });

        return view('lawyer-detail', compact('lawyer'));
    }
}
