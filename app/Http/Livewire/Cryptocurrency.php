<?php

namespace App\Http\Livewire;

use App\Services\KucoinService;
use Livewire\Component;

class Cryptocurrency extends Component
{
    public $prices = [];

    public function render(KucoinService $service)
    {
        $this->prices = $service->prices();
        return view('livewire.cryptocurrency');
    }
}
