<?php
namespace App\Livewire\Login;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class LoginComponent extends Component
{
    use LivewireAlert;
    public $email ,$password , $credentials = [];

    public function render()
    {
        return view('livewire.login.login-component')->layout("layouts.login.app");
    }

    public function authentication (){
        $this->validate([
            "email" => "required",
            "password" => "required"
        ],[
            "email.required" => "O campo email é obrigatório",
            "password.required" => "O campo senha é obrigatório"
        ]);
        try {

            $this->credentials = ['email' => $this->email,'password' => $this->password];
            if (Auth::attempt($this->credentials)){
                return redirect()->to("/admin");
            }else{
                $this->alert('warning', 'Aviso',[
                    "text" => "Credenciais inválidas!",
                    'showConfirmButton' => true,
                ]);
            }
        } catch (\Throwable $th) {
            $this->alert('error', 'Erro!',[
             "text" => $th->getMessage(),
             "toast" => false,
             'position' => 'center',
             "timer" => 300000,
             'showConfirmButton' => true,
            ]);

        }
    }


}
