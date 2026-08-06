<x-guest-layout>
     <h3 class="text-lg font-semibold text-slate-800 mb-4">Formulaire d'inscription:</h3>
    <form method="POST" action="{{ route('register') }}">
        @csrf
       

        <!-- Champ Nom -->
        <div>
            <x-input-label for="name" class="text-slate-700 font-sembold text-xs uppercase tracking-wide mb-1"/>
            <x-heroicon-o-user class="w-5 h-5"/>
            <x-text-input id="name" placeholder="Votre nom complet" class="block mt-1 w-full px-4 py-2.5 bg-slate-50 border-slate-300 rounded-lg text-slate-900 focus:bg-write focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-200" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-500 font-medium" />
        </div>

        <!-- Champ Email -->
        <div class="mt-4">
            <x-input-label for="email" class="text-slate-700 font-semibold text-xs uppercase tracking-wide mb-1" />
            <x-heroicon-o-envelope class="w-5 h-5"/>
            <x-text-input id="email" placeholder="aliou@gmail.com" class="block mt-1 w-full px-4 py-2.5 bg-slate-50 border-slate-300 rounded-lg text-slate-900 focus:bg-write focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-200" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 font-medium" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" class="text-slate-700 font-semibold text-xs uppercase tracking-wide mb-1" />
            <x-heroicon-o-lock-closed class="w-5 h-5"/>
            <x-text-input id="password" placeholder="Minimum 8 caractères" class="block mt-1 w-full px-4 py-2.5 bg-slate-50 border-slate-300 rounded-lg text-slate-900 focus:bg-write focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-200"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" class="text-slate-700 font-semibold text-xs uppercase tracking-wide mb-1" />
            <x-heroicon-o-shield-check class="w-5 h-5" />
            <x-text-input id="password_confirmation" placeholder="Confirmer le mot de passe" class="block mt-1 w-full px-4 py-2.5 bg-slate-50 border-slate-300 rounded-lg text-slate-900 focus:bg-write focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-200"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4 gap-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Dejà inscris ?') }}
            </a>

            <x-primary-button class="ms-4 cursor-pointer bg-emerald-500 hover:bg-emerald-600 focus:ring-emerald-500 focus:ring-offset-emerald-200 text-white transition-all duration-200">
                {{ __('Inscrire') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
