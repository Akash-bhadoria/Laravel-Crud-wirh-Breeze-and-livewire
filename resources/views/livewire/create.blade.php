<form >
    <div class="mb-3 mt-3">
      <label for="name" class="form-label">Name:</label>
      <input type="text" class="form-control" id="email" placeholder="Enter name" wire:model="name">
      @error('name') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <div class="mb-3">
      <label for="email" class="form-label">Email adrress:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email address" wire:model="email">
      @error('email') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <button wire:click.prevent="store" class="btn btn-success">Submit</button>
  </form>