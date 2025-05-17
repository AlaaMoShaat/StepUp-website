<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\OfferRepository;

class OfferService
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected OfferRepository $offerRepository)
    {
        //
    }

     public function getoffers()
    {
        $offers = $this->offerRepository->getOffers();
        if (!$offers) {
            return abort(404);
        }
        return $offers;
    }
}
