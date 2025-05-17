<?php

namespace App\Repositories\Dashboard;

use App\Models\Offer;

class OfferRepository
{
    public function getOffers()
    {
        $offers = Offer::all()->map(function ($offer) {
            return [
                'id' => $offer->id,
                'title' => $offer->getTranslations('title'),
                'current_title' => $offer->title,
                'description' => $offer->getTranslations('description'),
                'current_description' => $offer->description,
                'price' => $offer->price,
                'discount_price' => $offer->discount_price,
                'available_for' => $offer->available_for,
                'available_in_stock' => $offer->available_in_stock,
                'status' => $offer->status,
                'category_id' => $offer->category_id,
                'brochure_id' => $offer->brochure_id,
            ];
        });
        return $offers;
    }

}
