<x-auth-layout title="Inscription - Mini-CMS">
    <div class="anim-scale-in rounded-2xl border border-gray-100 bg-white p-8 shadow-xl" style="animation-delay: 100ms">
        <span class="grid size-12 place-items-center rounded-xl bg-violet-50 text-violet-600 ring-1 ring-violet-100">
            <i class="fa-solid fa-user-plus text-xl" aria-hidden="true"></i>
        </span>
        <h1 class="mt-5 text-2xl font-bold tracking-tight text-gray-900">Créer un compte</h1>
        <p class="mt-2 text-sm leading-relaxed text-gray-600">Un compte auteur permet d'écrire et de modifier ses propres articles.</p>

        <form method="POST" action="{{ route('register.store') }}" class="mt-8 space-y-5">
            @csrf

            <div>
                <label for="name" class="mb-1.5 block text-sm font-medium text-gray-700">Nom</label>
                <div class="relative">
                    <i class="fa-solid fa-user pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-sm text-gray-400" aria-hidden="true"></i>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" autocomplete="name" placeholder="Votre nom complet" aria-invalid="{{ $errors->has('name') ? 'true' : 'false' }}" class="w-full rounded-xl border bg-white py-3 pl-11 pr-4 text-sm text-gray-900 shadow-xs outline-none transition-all duration-300 placeholder:text-gray-400 focus:ring-3 @error('name') border-red-300 focus:border-red-400 focus:ring-red-100 @else border-gray-300 focus:border-indigo-400 focus:ring-indigo-100 @enderror">
                </div>
                @error('name')
                    <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="mb-1.5 block text-sm font-medium text-gray-700">Adresse e-mail</label>
                <div class="relative">
                    <i class="fa-solid fa-envelope pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-sm text-gray-400" aria-hidden="true"></i>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" autocomplete="email" placeholder="vous@exemple.com" aria-invalid="{{ $errors->has('email') ? 'true' : 'false' }}" class="w-full rounded-xl border bg-white py-3 pl-11 pr-4 text-sm text-gray-900 shadow-xs outline-none transition-all duration-300 placeholder:text-gray-400 focus:ring-3 @error('email') border-red-300 focus:border-red-400 focus:ring-red-100 @else border-gray-300 focus:border-indigo-400 focus:ring-indigo-100 @enderror">
                </div>
                @error('email')
                    <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="mb-1.5 block text-sm font-medium text-gray-700">Mot de passe (8 caractères au moins)</label>
                <div class="relative">
                    <i class="fa-solid fa-lock pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-sm text-gray-400" aria-hidden="true"></i>
                    <input type="password" id="password" name="password" autocomplete="new-password" placeholder="Au moins 8 caractères" aria-invalid="{{ $errors->has('password') ? 'true' : 'false' }}" class="w-full rounded-xl border bg-white py-3 pl-11 pr-4 text-sm text-gray-900 shadow-xs outline-none transition-all duration-300 placeholder:text-gray-400 focus:ring-3 @error('password') border-red-300 focus:border-red-400 focus:ring-red-100 @else border-gray-300 focus:border-indigo-400 focus:ring-indigo-100 @enderror">
                </div>
                @error('password')
                    <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="mb-1.5 block text-sm font-medium text-gray-700">Confirmer le mot de passe</label>
                <div class="relative">
                    <i class="fa-solid fa-check-double pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-sm text-gray-400" aria-hidden="true"></i>
                    <input type="password" id="password_confirmation" name="password_confirmation" autocomplete="new-password" placeholder="Répétez le mot de passe" class="w-full rounded-xl border border-gray-300 bg-white py-3 pl-11 pr-4 text-sm text-gray-900 shadow-xs outline-none transition-all duration-300 placeholder:text-gray-400 focus:border-indigo-400 focus:ring-3 focus:ring-indigo-100">
                </div>
            </div>

            <button type="submit" class="shine flex w-full items-center justify-center gap-2 rounded-xl bg-linear-to-r from-indigo-500 to-purple-600 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-indigo-200 transition-all duration-300 hover:scale-[1.02] hover:shadow-xl focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                <i class="fa-solid fa-user-plus" aria-hidden="true"></i>
                Créer mon compte
            </button>
        </form>

        <p class="mt-6 border-t border-gray-100 pt-6 text-center text-sm text-gray-600">
            Déjà un compte ?
            <a href="{{ route('login') }}" class="font-semibold text-indigo-600 transition-colors duration-300 hover:text-indigo-800 hover:underline">Se connecter</a>
        </p>
    </div>
</x-auth-layout>
