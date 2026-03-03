<?php

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

new class extends Component {
	#[Validate('required|email')]
	public $email = '';
	#[Validate('required|min:3')]
	public $password = '';
	public $error = '';

	public function login()
	{
		$this->reset('error');

		$validated = $this->validate();

		$isLoggedIn = Auth::attempt($validated);

		if (!$isLoggedIn) {
			$this->error = 'Verifique seu digitou o email e senha corretamete';

			return;
		}

		$this->redirect(route('home.index'), navigate:true);
	}
};
