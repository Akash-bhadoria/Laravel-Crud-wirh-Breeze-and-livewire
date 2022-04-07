<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\CrudUser;


class Counter extends Component
{
    public $count = 5;
    public $users, $name, $email, $user_id;
    public $updateMode = false;

    public function increment()
    {
        $this->count++;
    }

    public function decrement()
    {
        $this->count--;
    }

    public function render()
    {
        $this->users = CrudUser::all();
        return view('livewire.counter');
    }

    private function resetValue()
    {
        $this->name = '';
        $this->email = '';
    }

    public function store()
    {
        $validated = $this->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        CrudUser::create($validated);
        session()->flash('message', 'User Created succesfully.');
        $this->resetValue();
    }

    public function edit($id)
    {
        $this->updateMode = true;
        $user = CrudUser::where('id', $id)->first();
        $this->user_id = $id;
        $this->name = $user->name;
        $this->email = $user->email;
    }
 
    public function cancel()
    {
     $this->updateMode = false;
     $this->resetValue();
    }   

    public function update()
    {
        $validated = $this->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        if($this->user_id){
            $user = CrudUser::find($this->user_id);
            $user->update([
                'name' => $this->name,
                'email' => $this->email,
            ]);
            $this->updateMode = false;
            session()->flash('message' ,'User Updated Succesfully.');
            $this->resetValue();
        }
        
    }

    public function delete($id){
        if($id){
            CrudUser::where('id', $id)->delete();
            session()->flash('message' ,'User Deleted Succesfully.');
        }

    }
}
