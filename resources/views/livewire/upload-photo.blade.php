<div class="wrapper">
    @if(session()->has('message'))
    <div class="alert alert-success" style="text-align: center;">
        {{ session()->get('message') }}
    </div>
    @endif
    <center>
        <h1 class="s-title"> Photo de profile</h1>
    </center>
    <div class="tableau">
        <form class="form-edit email" wire:submit.prevent="save">
            @csrf
            <div class="form-group">
                <label class="form-label">Donner un nom a votre photo</label>
                <input class="form-control" type="text" wire:model="fileTitle">
                <div>
                    @error('fileTitle')
                    <span class="text-danger"> {{ $message }} </span>
                    @enderror
                </div>
            </div>
            <div>
                @if($fileName)
                Photo Preview:
                <img src=" {{ $fileName->temporaryUrl() }}" alt="photo-pv">
                @endif
            </div>
            <div class="form-group">
                <label class="form-label"> Veuillez choisir votre photo</label>
                <input class="form-control" type="file" wire:model="fileName">
                <div wire:loading wire:target="fileName">
                    Chargement .....
                </div>
                <div>
                    @error('fileName')
                    <span class="text-danger"> {{ $message }} </span>
                    @enderror
                </div>
            </div>
            <center><button class="mon-bouton" type="submit">Enregistrer la Photo</button></center>
        </form>
    </div>
</div>