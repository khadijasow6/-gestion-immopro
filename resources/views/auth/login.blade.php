<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Connexion - Gestion ImmoPro</title>

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
                        Connectez-vous pour gérer vos biens immobiliers, vos visites,
                        vos transactions et vos statistiques depuis un espace moderne.
                    </p>
                </div>

                <div class="bg-white/15 backdrop-blur rounded-3xl p-8 border border-white/20 shadow-lg">
                    <div class="text-6xl mb-5">🏡</div>

                    <h2 class="text-3xl font-extrabold mb-3">
                        Votre espace immobilier
                    </h2>

                    <p class="text-purple-100 leading-relaxed">
                        Une plateforme simple, professionnelle et complète pour suivre toute l’activité de votre agence.
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
                            🔐
                        </div>

                        <h1 class="text-4xl font-extrabold text-gray-900">
                            Connexion
                        </h1>

                        <p class="text-gray-500 mt-3">
                            Accédez à votre tableau de bord.
                        </p>
                    </div>

                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email -->
                        <div>
                            <label for="email" class="block font-bold text-gray-700 mb-2">
                                Adresse email
                            </label>

                            <input id="email"
                                   type="email"
                                   name="email"
                                   value="{{ old('email') }}"
                                   required
                                   autofocus
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
                                   autocomplete="current-password"
                                   placeholder="Votre mot de passe"
                                   class="w-full rounded-2xl border-gray-300 px-5 py-4 focus:border-purple-500 focus:ring-purple-500">

                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Remember -->
                        <div class="mt-5 flex items-center justify-between">
                            <label for="remember_me" class="inline-flex items-center">
                                <input id="remember_me"
                                       type="checkbox"
                                       name="remember"
                                       class="rounded border-gray-300 text-purple-600 shadow-sm focus:ring-purple-500">

                                <span class="ml-2 text-sm text-gray-600">
                                    Se souvenir de moi
                                </span>
                            </label>

                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}"
                                   class="text-sm text-purple-700 hover:text-purple-900 font-bold">
                                    Mot de passe oublié ?
                                </a>
                            @endif
                        </div>

                        <button type="submit"
                                class="mt-8 w-full py-4 rounded-2xl bg-gradient-to-r from-purple-600 via-pink-600 to-orange-500 text-white font-extrabold shadow-lg hover:scale-[1.02] transition">
                            Se connecter
                        </button>

                        <div class="mt-6 text-center">
                            <p class="text-sm text-gray-600">
                                Vous n’avez pas de compte ?
                                <a href="{{ route('register') }}"
                                   class="text-purple-700 hover:text-purple-900 font-bold">
                                    Créer un compte
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