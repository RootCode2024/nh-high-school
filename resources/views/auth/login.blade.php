@extends('layouts.auth')

@section('title', 'Login')

@section('content')

<div class="container mx-auto p-4">
    <div class="flex items-center justify-center">
        <form class="w-full max-w-md" method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                <input type="email" name="email" id="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('email') }}" required>
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Mot de passe</label>
                <input type="password" name="password" id="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Connexion</button>
                <a href="{{ route('password.request') }}" class="text-sm text-blue-500 hover:underline">Mot de passe oubli  ?</a>
            </div>
        </form>
    </div>
</div>
