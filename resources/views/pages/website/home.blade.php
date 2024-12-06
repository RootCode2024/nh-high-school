@extends('layouts.app')

@section('title', 'Accueil')

@section('content')
<!-- Section Héro -->
<section class="text-white relative">
    <div class="flex flex-col md:flex-row items-center justify-between h-screen max-w-7xl mx-auto px-6 md:px-12">
        <!-- Contenu à gauche -->
        <div class="md:w-1/2">
            <h1 class="text-5xl font-bold leading-tight">
                <span class="text-[#2272FF]">UN AVENIR</span> MEILLEUR<br>
                <span class="text-[#2272FF]">POUR VOS</span> ENFANTS
            </h1>
            <p class="mt-6 text-gray-400 text-lg">
                Imaginez un monde où vos enfants prospèrent grâce à une éducation moderne et inspirante. Chez <span class="text-[#2272FF] underline">{{$schoolInfo->name ?? 'NH High School'}}</span>, nous sommes déterminés à transformer leur potentiel en réussite. Rejoignez-nous et offrez-leur un avenir rempli d'opportunités, de compétences, et de valeurs durables.
            </p>
            <div class="mt-8 flex space-x-4">
                <button class="bg-[#2272FF] text-white px-6 py-3 rounded-full font-medium shadow-lg hover:bg-white hover:text-[#2272FF]">
                    Commencer
                </button>
                <button class="flex items-center text-[#2272FF] hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-4.596 2.665c-.97.562-2.156-.136-2.156-1.264V7.431c0-1.128 1.185-1.826 2.156-1.264l4.596 2.665a1.5 1.5 0 010 2.528z" />
                    </svg>
                    Voir la vidéo
                </button>
            </div>
        </div>

        <!-- Image à droite -->
        <div class="md:w-1/2 flex justify-center">
            <img src="{{ asset('assets/hero.png') }}" alt="Image Héro" class="w-4/5 md:w-full">
        </div>
    </div>

    <!-- Cercles décoratifs -->
    <div class="absolute inset-0 flex justify-center items-center pointer-events-none">
        <div class="space-y-4">
            <div class="w-10 h-10 bg-[#2272FF] rounded-full opacity-30"></div>
            <div class="w-6 h-6 bg-[#2272FF] rounded-full opacity-50"></div>
            <div class="w-12 h-12 bg-[#2272FF] rounded-full opacity-20"></div>
        </div>
    </div>
</section>

<!-- Section À propos -->
<section class="bg-[#2272FF] text-white py-16">
    <div class="max-w-7xl mx-auto px-6 md:px-12 text-center">
        <h2 class="text-4xl font-bold">À propos de nous</h2>
        <p class="mt-4 text-gray-300">
            NH High School est plus qu'une école : c'est une communauté dédiée à l'excellence. Nous croyons en la puissance de l'éducation pour façonner non seulement des carrières mais aussi des vies. Notre approche combine un apprentissage rigoureux avec des expériences pratiques, des activités innovantes et un encadrement attentif. Nous voulons non seulement éduquer vos enfants, mais aussi les inspirer à devenir des leaders responsables et ambitieux dans un monde en constante évolution.
        </p>
        <p class="mt-6 text-gray-300">
            Depuis plusieurs années, nous avons aidé des milliers d'étudiants à découvrir leur passion, à exceller dans leurs domaines et à atteindre leurs objectifs personnels et professionnels. Nous croyons qu'avec un encadrement adéquat, chaque étudiant peut libérer tout son potentiel.
        </p>
    </div>
</section>

<!-- Section Services -->
<section class="bg-[#1D1D1D] text-white py-16">
    <div class="max-w-7xl mx-auto px-6 md:px-12">
        <h2 class="text-4xl font-bold text-center">Nos services</h2>
        <p class="text-center text-gray-400 mt-4">
            Nous offrons une gamme complète de services pour répondre aux besoins diversifiés de nos étudiants. Nos programmes sont conçus pour non seulement transmettre des connaissances, mais aussi développer des compétences essentielles pour la vie.
        </p>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-12">
            <!-- Service 1 -->
            <div class="bg-[#2272FF] rounded-lg p-6 shadow-lg hover:bg-[#1D1D1D] hover:shadow-xl">
                <h3 class="text-2xl font-semibold">Excellence académique</h3>
                <p class="mt-4 text-gray-300">
                    Nos cours suivent les standards éducatifs les plus élevés, intégrant des méthodologies modernes qui permettent aux étudiants de comprendre et d'exceller. Que ce soit en sciences, en arts ou en mathématiques, nous garantissons une éducation de qualité supérieure.
                </p>
            </div>
            <!-- Service 2 -->
            <div class="bg-[#2272FF] rounded-lg p-6 shadow-lg hover:bg-[#1D1D1D] hover:shadow-xl">
                <h3 class="text-2xl font-semibold">Activités extrascolaires</h3>
                <p class="mt-4 text-gray-300">
                    Nous proposons des clubs variés (robotique, théâtre, musique, sport, etc.) pour développer les talents de nos étudiants en dehors de la salle de classe. Ces activités permettent aussi de renforcer leur confiance en eux et leur esprit d'équipe.
                </p>
            </div>
            <!-- Service 3 -->
            <div class="bg-[#2272FF] rounded-lg p-6 shadow-lg hover:bg-[#1D1D1D] hover:shadow-xl">
                <h3 class="text-2xl font-semibold">Orientation professionnelle</h3>
                <p class="mt-4 text-gray-300">
                    Grâce à des séances de conseil, des ateliers et des partenariats avec des universités de renom, nous guidons nos étudiants dans leur choix de carrière. Chaque élève reçoit un plan personnalisé pour atteindre ses objectifs professionnels.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Section Contact -->
<section class="bg-[#2272FF] text-white py-16">
    <div class="max-w-7xl mx-auto px-6 md:px-12 text-center">
        <h2 class="text-4xl font-bold">Contactez-nous</h2>
        <p class="mt-4 text-gray-300">
            Vous souhaitez en savoir plus ? Notre équipe est à votre disposition pour répondre à toutes vos questions. Nous serions ravis de discuter de vos attentes et des besoins de vos enfants.
        </p>
        <p class="mt-6 text-gray-300">
            Appelez-nous, envoyez un e-mail ou remplissez le formulaire ci-dessous pour entrer en contact avec nous. Chaque message est important pour nous, et nous nous engageons à vous répondre dans les plus brefs délais.
        </p>
        <div class="mt-8">
            <form class="space-y-4">
                <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-4">
                    <input type="text" placeholder="Votre nom" class="w-full px-4 py-3 rounded-lg bg-[#1D1D1D] text-white focus:outline-none focus:ring-2 focus:ring-white">
                    <input type="email" placeholder="Votre e-mail" class="w-full px-4 py-3 rounded-lg bg-[#1D1D1D] text-white focus:outline-none focus:ring-2 focus:ring-white">
                </div>
                <textarea placeholder="Votre message" rows="4" class="w-full px-4 py-3 rounded-lg bg-[#1D1D1D] text-white focus:outline-none focus:ring-2 focus:ring-white"></textarea>
                <button type="submit" class="bg-white text-[#2272FF] px-6 py-3 rounded-full font-medium hover:bg-[#1D1D1D] hover:text-white">
                    Envoyer le message
                </button>
            </form>
        </div>
    </div>
</section>
@endsection
