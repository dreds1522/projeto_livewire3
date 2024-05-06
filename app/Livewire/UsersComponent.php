<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Rule;
use Livewire\WithPagination;
use Livewire\WithFileUploads;


class UsersComponent extends Component
{

    use WithPagination;
    use WithFileUploads;
    

    public $title;
    public $search='';
    public $numberRows=5;

    #[Rule('required|min:5|max:255')]
    public $name;

    #[Rule('required|email|unique:users,email')]
    public $email;

    #[Rule('required|min:5')]
    public $password;
    
    #[Rule('required|image|min:1024')] #- Validação/ Inserção da imagem não funciona!
    public $image;

    public function createUser() {

        $this->validate();

        if($this->image){
            $customName = 'users/'.uniqid().'.'.$this->image->extension();
            $this->image->storeAs('public', $customName);

        }else{
            $customName=null;
        }

        User::create([
            'name'=> $this->name,
            'email'=> $this->email,
            'password'=> $this->password,
            'image'=> $customName
        ]);

        session()->flash('msg', 'Usuário criado com sucesso');
    }

    public function render()
    {
        $this->title = "Usuarios";
        $usersCount = User::count();
        $users = User::where('name','like','%'.$this->search.'%')
            ->paginate($this->numberRows);

        return view('livewire.users-component', [
            'title'=>$this->title,
            'usersCount'=>$usersCount,
            'users'=>$users
        ]);

    }
}
