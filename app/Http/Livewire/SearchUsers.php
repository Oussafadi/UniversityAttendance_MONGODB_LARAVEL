<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;

class SearchUsers extends Component
{
    public $query = '';
    public $users = [];
    public int $selectedIndex = 0;

    public function incrementIndex()
    {
        if ($this->selectedIndex === count($this->users) - 1) {
            $this->selectedIndex = 0;
            return;
        }

        $this->selectedIndex++;
    }

    public function decrementIndex()
    {
        if ($this->selectedIndex === 0) {
            $this->selectedIndex = count($this->users) - 1;
            return;
        }
        $this->selectedIndex--;
    }
    public function resetIndex()
    {
        $this->selectedIndex = 0;
    }

    public function showUser()
    {
        if ($this->users) {
            return redirect()->route('user.show', [$this->users[$this->selectedIndex]['id']]);
        }
    }

    public function updatedQuery()
    {
        $words = '%' . $this->query . '%';
        if (strlen(($this->query) >= 2)) {
            $this->users = User::where('name', 'like', $words)->get();
        }
    }

    public function render()
    {

        return view('livewire.search-users');
    }
}
