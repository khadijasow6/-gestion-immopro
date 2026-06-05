<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inscription - Gestion ImmoPro</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased bg-gradient-to-br from-indigo-100 via-purple-100 to-pink-100">

    <div class="min-h-screen flex items-center justify-center px-6 py-10">

        <div class="w-full max-w-6xl bg-white rounded-3xl shadow-2xl overflow-hidden grid grid-cols-1 lg:grid-cols-2 border border-purple-100">

            <!-- Partie gauche -->
            <div class="hidden lg:flex flex-col justify-between bg-gradient-to-br from-indigo-700 via-purple-700 to-pink-600 p-12 text-white">

                <div>
                    <a href="{{ route('home') }}" class="text-4xl font-extrabold block mb-6">
                        Gestion ImmoPro
                    </a>

                    <p class="text-purple-100 text-lg leading-relaxed max-w-md">
                        Créez votre compte client pour consulter les biens disponibles,
                        planifier des visites et suivre vos demandes immobilières.
                    </p>
                </div>

                <div class="bg-white/15 backdrop-blur rounded-3xl p-8 border border-white/20 shadow-lg">
                    <div class="text-6xl mb-5">🏘️</div>

                    <h2 class="text-3xl font-extrabold mb-3">
                        Rejoignez notre espace immobilier
                    </h2>

                    <p class="text-purple-100 leading-relaxed">
                        Une inscription rapide pour accéder aux services de l’agence
                        et découvrir les biens disponibles.
                    </p>
                </div>

                <p class="text-sm text-purple-100">
                    © {{ date('Y') }} Gestion ImmoPro
                </p>
            </div>

            <!-- Partie droite -->
            <div class="p-8 sm:p-12 lg:p-16 flex items-center">

                <div class="w-full max-w-md mx-auto">

                    <div class="text-center mb-8">
                        <div class="mx-auto w-20 h-20 rounded-3xl bg-gradient-to-r from-purple-600 to-pink-600 flex items-center justify-center text-white text-4xl shadow-lg mb-5">
                            📝
                        </div>

                        <h1 class="text-4xl font-extrabold text-gray-900">
                            Inscription
                        </h1>

                        <p class="text-gray-500 mt-3">
                            Créez votre compte client.
                        </p>
                    </div>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Name -->
                        <div>
                            <label for="name" class="block font-bold text-gray-700 mb-2">
                                Nom complet
                            </label>

                            <input id="name"
                                   type="text"
                                   name="name"
                                   value="{{ old('name') }}"
                                   required
                                   autofocus
                                   autocomplete="name"
                                   placeholder="Votre nom complet"
                                   class="w-full rounded-2xl border-gray-300 px-5 py-4 focus:border-purple-500 focus:ring-purple-500">

                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Email -->
                        <div class="mt-5">
                            <label for="email" class="block font-bold text-gray-700 mb-2">
                                Adresse email
                            </label>

                            <input id="email"
                                   type="email"
                                   name="email"
                                   value="{{ old('email') }}"
                                   required
                                   autocomplete="username"
                                   placeholder="exemple@gmail.com"
                                   class="w-full rounded-2xl border-gray-300 px-5 py-4 focus:border-purple-500 focus:ring-purple-500">

                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div class="mt-5">
                            <label for="password" class="block font-bold text-gray-700 mb-2">
                                Mot de passe
                            </label>

                            <input id="password"
                                   type="password"
                                   name="password"
                                   required
                                   autocomplete="new-password"
                                   placeholder="Créer un mot de passe"
                                   class="w-full rounded-2xl border-gray-300 px-5 py-4 focus:border-purple-500 focus:ring-purple-500">

                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Confirm Password -->
                        <div class="mt-5">
                            <label for="password_confirmation" class="block font-bold text-gray-700 mb-2">
                                Confirmer le mot de passe
                            </label>

                            <input id="password_confirmation"
                                   type="password"
                                   name="password_confirmation"
                                   required
                                   autocomplete="new-password"
                                   placeholder="Confirmer votre mot de passe"
                                   class="w-full rounded-2xl border-gray-300 px-5 py-4 focus:border-purple-500 focus:ring-purple-500">

                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        <button type="submit"
                                class="mt-8 w-full py-4 rounded-2xl bg-gradient-to-r from-purple-600 via-pink-600 to-orange-500 text-white font-extrabold shadow-lg hover:scale-[1.02] transition">
                            Créer mon compte
                        </button>

                        <div class="mt-6 text-center">
                            <p class="text-sm text-gray-600">
                                Vous avez déjà un compte ?
                                <a href="{{ route('login') }}"
                                   class="text-purple-700 hover:text-purple-900 font-bold">
                                    Se connecter
                                </a>
                            </p>
                        </div>
                    </form>

                    <div class="mt-8 text-center">
                        <a href="{{ route('home') }}"
                           class="text-sm text-gray-500 hover:text-purple-700 font-bold">
                            ← Retour à l’accueil
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>

</body>
</html>