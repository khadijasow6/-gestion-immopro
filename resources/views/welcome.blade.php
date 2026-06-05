<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestion ImmoPro - Agence immobilière</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased bg-gray-50">

    <!-- Navbar -->
    <header class="fixed top-0 left-0 right-0 z-50 bg-white/90 backdrop-blur shadow-sm">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <a href="{{ route('home') }}" class="text-2xl font-extrabold text-purple-700">
                Gestion ImmoPro
            </a>

            <nav class="hidden md:flex items-center gap-8 text-sm font-bold text-gray-600">
                <a href="#accueil" class="hover:text-purple-700">Accueil</a>
                <a href="#services" class="hover:text-purple-700">Services</a>
                <a href="#biens" class="hover:text-purple-700">Biens</a>
                <a href="#contact" class="hover:text-purple-700">Contact</a>
            </nav>

            <div class="flex items-center gap-3">
                @auth
                    <a href="{{ route('dashboard') }}"
                       class="px-5 py-2 rounded-xl bg-purple-700 text-white font-bold hover:bg-purple-800">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}"
                       class="px-5 py-2 rounded-xl text-purple-700 font-bold hover:bg-purple-50">
                        Connexion
                    </a>

                    <a href="{{ route('register') }}"
                       class="px-5 py-2 rounded-xl bg-gradient-to-r from-purple-600 to-pink-600 text-white font-bold shadow hover:scale-105 transition">
                        Inscription
                    </a>
                @endauth
            </div>
        </div>
    </header>

    <!-- Hero -->
    <section id="accueil" class="pt-32 pb-20 bg-gradient-to-br from-indigo-100 via-purple-100 to-pink-100">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

            <div>
                <span class="inline-block px-5 py-2 rounded-full bg-white text-purple-700 font-bold shadow mb-6">
                    Votre solution immobilière moderne
                </span>

                <h1 class="text-5xl md:text-6xl font-extrabold text-gray-900 leading-tight">
                    Trouvez, gérez et suivez vos biens immobiliers facilement.
                </h1>

                <p class="mt-6 text-lg text-gray-600 leading-relaxed">
                    Gestion ImmoPro est une application complète pour les agences immobilières :
                    gestion des biens, visites, transactions, clients, documents et statistiques.
                </p>

                <div class="mt-8 flex flex-wrap gap-4">
                    @auth
                        <a href="{{ route('dashboard') }}"
                           class="px-8 py-4 rounded-2xl bg-gradient-to-r from-purple-600 via-pink-600 to-orange-500 text-white font-extrabold shadow-lg hover:scale-105 transition">
                            Accéder au dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                           class="px-8 py-4 rounded-2xl bg-gradient-to-r from-purple-600 via-pink-600 to-orange-500 text-white font-extrabold shadow-lg hover:scale-105 transition">
                            Se connecter
                        </a>

                        <a href="{{ route('register') }}"
                           class="px-8 py-4 rounded-2xl bg-white text-purple-700 font-extrabold shadow-lg hover:bg-purple-50">
                            Créer un compte
                        </a>
                    @endauth
                </div>
            </div>

            <div class="relative">
                <div class="absolute -top-6 -left-6 w-32 h-32 bg-pink-300 rounded-full blur-3xl opacity-60"></div>
                <div class="absolute -bottom-6 -right-6 w-32 h-32 bg-purple-400 rounded-full blur-3xl opacity-60"></div>

                <div class="relative bg-white rounded-3xl shadow-2xl overflow-hidden border border-purple-100">
                    <img src="https://images.unsplash.com/photo-1560518883-ce09059eeffa?auto=format&fit=crop&w=1200&q=80"
                         alt="Maison moderne"
                         class="w-full h-[420px] object-cover">

                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-2xl font-extrabold text-gray-900">
                                    Villa moderne
                                </h3>
                                <p class="text-gray-500 mt-1">
                                    Dakar, Sénégal
                                </p>
                            </div>

                            <div class="text-right">
                                <p class="text-sm text-gray-500">À partir de</p>
                                <p class="text-xl font-extrabold text-purple-700">
                                    45 000 000 FCFA
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- Services -->
    <section id="services" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-14">
                <h2 class="text-4xl font-extrabold text-gray-900">
                    Nos services
                </h2>
                <p class="text-gray-500 mt-3">
                    Une plateforme complète pour gérer une agence immobilière.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="p-8 rounded-3xl bg-purple-50 border border-purple-100 shadow-sm">
                    <div class="text-4xl mb-4">🏡</div>
                    <h3 class="text-xl font-extrabold text-gray-900 mb-3">
                        Gestion des biens
                    </h3>
                    <p class="text-gray-600">
                        Ajoutez, modifiez et suivez les appartements, villas, bureaux, terrains et commerces.
                    </p>
                </div>

                <div class="p-8 rounded-3xl bg-pink-50 border border-pink-100 shadow-sm">
                    <div class="text-4xl mb-4">📅</div>
                    <h3 class="text-xl font-extrabold text-gray-900 mb-3">
                        Visites clients
                    </h3>
                    <p class="text-gray-600">
                        Planifiez les visites, suivez leur statut et ajoutez des comptes rendus.
                    </p>
                </div>

                <div class="p-8 rounded-3xl bg-indigo-50 border border-indigo-100 shadow-sm">
                    <div class="text-4xl mb-4">📊</div>
                    <h3 class="text-xl font-extrabold text-gray-900 mb-3">
                        Reporting
                    </h3>
                    <p class="text-gray-600">
                        Analysez les transactions, commissions, performances des agents et biens disponibles.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Biens -->
    <section id="biens" class="py-20 bg-gradient-to-br from-purple-50 to-pink-50">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-14">
                <h2 class="text-4xl font-extrabold text-gray-900">
                    Exemples de biens
                </h2>
                <p class="text-gray-500 mt-3">
                    Vente, location, gestion et suivi des biens immobiliers.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                <div class="bg-white rounded-3xl overflow-hidden shadow-xl border border-purple-100">
                    <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=900&q=80"
                         class="w-full h-56 object-cover"
                         alt="Villa">
                    <div class="p-6">
                        <h3 class="text-xl font-extrabold text-gray-900">Villa familiale</h3>
                        <p class="text-gray-500 mt-1">Almadies, Dakar</p>
                        <p class="text-purple-700 font-extrabold mt-4">85 000 000 FCFA</p>
                    </div>
                </div>

                <div class="bg-white rounded-3xl overflow-hidden shadow-xl border border-purple-100">
                    <img src="https://images.unsplash.com/photo-1494526585095-c41746248156?auto=format&fit=crop&w=900&q=80"
                         class="w-full h-56 object-cover"
                         alt="Appartement">
                    <div class="p-6">
                        <h3 class="text-xl font-extrabold text-gray-900">Appartement moderne</h3>
                        <p class="text-gray-500 mt-1">Plateau, Dakar</p>
                        <p class="text-purple-700 font-extrabold mt-4">350 000 FCFA / mois</p>
                    </div>
                </div>

                <div class="bg-white rounded-3xl overflow-hidden shadow-xl border border-purple-100">
                    <img src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=900&q=80"
                         class="w-full h-56 object-cover"
                         alt="Bureau">
                    <div class="p-6">
                        <h3 class="text-xl font-extrabold text-gray-900">Bureau professionnel</h3>
                        <p class="text-gray-500 mt-1">Mermoz, Dakar</p>
                        <p class="text-purple-700 font-extrabold mt-4">1 200 000 FCFA / mois</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Contact -->
    <section id="contact" class="py-20 bg-white">
        <div class="max-w-5xl mx-auto px-6 text-center">
            <h2 class="text-4xl font-extrabold text-gray-900">
                Prêt à gérer votre agence ?
            </h2>

            <p class="text-gray-500 mt-4">
                Connectez-vous pour accéder au tableau de bord et gérer vos biens immobiliers.
            </p>

            <div class="mt-8">
                @auth
                    <a href="{{ route('dashboard') }}"
                       class="inline-block px-8 py-4 rounded-2xl bg-gradient-to-r from-purple-600 to-pink-600 text-white font-extrabold shadow-lg hover:scale-105 transition">
                        Aller au dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}"
                       class="inline-block px-8 py-4 rounded-2xl bg-gradient-to-r from-purple-600 to-pink-600 text-white font-extrabold shadow-lg hover:scale-105 transition">
                        Se connecter
                    </a>
                @endauth
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-950 text-white py-8">
        <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row items-center justify-between gap-4">
            <p class="font-bold">
                Gestion ImmoPro
            </p>

            <p class="text-gray-400 text-sm">
                © {{ date('Y') }} - Application de gestion immobilière
            </p>
        </div>
    </footer>

</body>
</html>