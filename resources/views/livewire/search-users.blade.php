<div class="position-relative">
    <!-- Lazy Updating <input wire:model.lazy="search" type="text" placeholder="Search Users...." > -->
    <i style="margin-left:40px ;" class="fas fa-search"></i>
    <input class="search-bar" wire:model="query" type="text" placeholder="Search Users....." wire:keydown.arrow-down.prevent="incrementIndex" wire:keydown.arrow-up.prevent="decrementIndex" wire:keydown.enter.prevent="showUser" wire:keydown.backspace="resetIndex">

    <div>
        @if( (strlen($query)) >= 2)
        <div class=" position-absolute search">
            @if ( (count($users)) > 0 )

            @foreach( $users as $index => $user )
            <a href=" {{ route('user.show',$user->id) }}">
                <p style="margin-bottom:0px;" class=" {{ $index === $selectedIndex ? 'text-blue' : '' }}"> {{ $user->name }} </p>
            </a>
            @endforeach
            @else
            <p> 0 resultats pour {{ $query }} </p>
            @endif
        </div>
        @endif
    </div>
</div>