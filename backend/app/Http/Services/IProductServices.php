<?php

namespace App\Http\Services;

use Illuminate\Support\Collection;

interface IProductService
{
    public function index(): Collection;
}
