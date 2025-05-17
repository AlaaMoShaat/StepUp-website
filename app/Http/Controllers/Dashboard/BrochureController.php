<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Dashboard\OfferService;
use App\Services\Dashboard\BrochureService;

class BrochureController extends Controller
{
   public function __construct(protected BrochureService $brochureService, protected OfferService $offerService){}

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $offers = $this->getAllOffers();
        return view('dashboard.brochures.create', compact(['offers']));
    }

    public function store(Request $request) {
        return $request;
    }


    public function getAllOffers()
    {
        $offers = $this->offerService->getOffers();
        return $offers;
    }
}