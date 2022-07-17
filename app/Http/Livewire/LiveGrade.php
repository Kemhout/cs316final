<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Course;

class LiveGrade extends Component
{

    public $search;
    public $location;
    public $transmissions;

    public function updatedTransmissions() {
        if(!is_array($this->transmissions)) return;
        $this->transmissions = array_filter($this->transmissions, 
            function ($transmissions) {
                return $transmissions != false;
            }
    );
    }
    public function render()
    {
        return view('livewire.live-grade', [
            'listings' => Course::whereLike('model',)
        ]);
    }
}
