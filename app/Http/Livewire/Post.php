<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Post extends Component
{
    public function calculate($title) {
        //$title = DB::table('courses')->select('type_of_course')->distinct()->get();
        $this->title = $title;
    }

    // public function boot() {
    //     $this->title = DB::table('courses')->select('type_of_course')->distinct()->get();
    // }
    public function render()
    {
        return view('livewire.post');
    }
}
