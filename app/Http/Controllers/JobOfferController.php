<?php

namespace App\Http\Controllers;

use App\Models\JobOffer;
use Illuminate\Http\Request;

class JobOfferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobsOffers = JobOffer::orderBy('created_at', 'desc')->take(6)->get();

        return view('welcome', compact('jobsOffers'));
    }

    public function indexGuest()
    {
        // $jobsOffers = JobOffer::all();

        $jobsOffers = ['jobTitle' => 'prueba', 'company_id' => '1'];

        return view('job-offers.index-guest', ['jobsOffers' => $jobsOffers]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(JobOffer $offer)
    {
        return view('job-offers.show', compact('offer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JobOffer $jobOffer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JobOffer $jobOffer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobOffer $jobOffer)
    {
        //
    }
}
