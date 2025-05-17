<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\BrochureRepository;

class BrochureService
{
     public function __construct(protected BrochureRepository $brochureRepository){}
}