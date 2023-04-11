<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\File;
use Illuminate\Support\Facades\Auth;

class UploadPhoto extends Component
{
    use WithFileUploads;

    public $fileTitle;
    public $fileName;

    public function save()
    {

        $data_validated = $this->validate([
            'fileName' => 'required|image|max:2048',
            'fileTitle' => 'required'
        ]);

        $data_validated['fileName'] = $this->fileName->store('photos', 'public');
        $data_validated['user_id'] = Auth::user()->id;
        // dd($data_validated); 
        if (File::where('user_id', '=', Auth::user()->id)->exists()) {
            File::where('user_id', '=', Auth::user()->id)->update($data_validated);
        } else {
            File::create($data_validated);
        }

        session()->flash('message', 'Profile photo has succesfully changed');
    }


    public function render()
    {
        return view('livewire.upload-photo');
    }
}
