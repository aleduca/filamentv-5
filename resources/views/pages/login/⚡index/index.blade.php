<div class="min-h-screen flex items-center justify-center bg-gray-950 px-4">

  <div class="w-full max-w-md bg-gray-900 border border-gray-800 shadow-2xl rounded-2xl p-8">

    <div class="text-center mb-8">
      <h2 class="text-3xl font-bold text-white">Bem-vindo</h2>
      <p class="text-gray-400 text-sm mt-2">
        Entre com seu email e senha
      </p>
    </div>

    <div class="text-red-500 italic text-xl text-center mb-3">{{ $this->error }}</div>

    <form wire:submit="login" class="space-y-6">

      <!-- Email -->
      <div>
        <label class="block text-sm font-medium text-gray-300 mb-2">
          Email
        </label>
        <input wire:model="email" type="text" name="email" class="w-full px-4 py-3 bg-gray-800 border border-gray-700 text-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition" placeholder="seu@email.com">
        @error('email')
        <span class="text-red-500 italic text-sm">{{ $message }}</span>
        @enderror
      </div>

      <!-- Senha -->
      <div>
        <label class="block text-sm font-medium text-gray-300 mb-2">
          Senha
        </label>
        <input wire:model="password" type="password" name="password" class="w-full px-4 py-3 bg-gray-800 border border-gray-700 text-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition" placeholder="********">
        @error('password')
        <span class="text-red-500 italic text-sm">{{ $message }}</span>
        @enderror
      </div>

      <!-- Botão -->
      <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-3 rounded-lg font-medium transition duration-200 shadow-lg shadow-indigo-600/30 cursor-pointer">
        <span wire:loading.remove wire:target="login">Login</span>
        <span wire:loading wire:target="login">
          <x-loading />
        </span>
      </button>

    </form>

  </div>

</div>
