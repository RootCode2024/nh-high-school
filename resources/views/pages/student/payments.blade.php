@extends('layouts.dashboard')

@section('title', 'Paiements')

@section('content')
<div class="max-w-6xl mx-auto py-10">
<!-- Section Coût Scolaire -->
<div class="bg-gradient-to-r from-blue-50 to-blue-100 shadow-lg rounded-xl p-6 mb-8">
    <h2 class="text-3xl font-extrabold text-blue-700 mb-6 border-b pb-2">💼 Coût Scolaire</h2>

    <ul class="divide-y divide-blue-200">
        <!-- Frais d'inscription -->
        <li class="py-4 flex justify-between items-center">
            <div class="flex items-center">
                <span class="text-blue-500 text-xl mr-3">📋</span>
                <span class="text-gray-700 text-lg">Frais d'inscription</span>
            </div>
            <div class="text-right">
                <p class="text-lg font-semibold text-gray-800">{{ number_format($classeFees->registration_fee_amount, 0, ',', ' ') }} F CFA</p>
                <p class="text-sm text-gray-500">Reliquat : <span class="text-red-500 font-semibold">{{ number_format($classeFees->registration_fee_amount - $paidFees['registration_fee_paid'], 0, ',', ' ') }} F CFA</span></p>
            </div>
        </li>

        <!-- Frais de transport -->
        <li class="py-4 flex justify-between items-center">
            <div class="flex items-center">
                <span class="text-blue-500 text-xl mr-3">🚍</span>
                <span class="text-gray-700 text-lg">Frais de transport</span>
            </div>
            <div class="text-right">
                <p class="text-lg font-semibold text-gray-800">{{ number_format($classeFees->transport_fee_amount, 0, ',', ' ') }} F CFA</p>
                <p class="text-sm text-gray-500">Reliquat : <span class="text-red-500 font-semibold">{{ number_format($classeFees->transport_fee_amount - $paidFees['transport_fee_paid'], 0, ',', ' ') }} F CFA</span></p>
            </div>
        </li>

        <!-- Frais scolaire -->
        <li class="py-4 flex justify-between items-center">
            <div class="flex items-center">
                <span class="text-blue-500 text-xl mr-3">📚</span>
                <span class="text-gray-700 text-lg">Frais scolaire</span>
            </div>
            <div class="text-right">
                <p class="text-lg font-semibold text-gray-800">{{ number_format($classeFees->school_fee_amount, 0, ',', ' ') }} F CFA</p>
                <p class="text-sm text-gray-500">Reliquat : <span class="text-red-500 font-semibold">{{ number_format($classeFees->school_fee_amount - $paidFees['school_fee_paid'], 0, ',', ' ') }} F CFA</span></p>
            </div>
        </li>

        <!-- Total Annuel -->
        <li class="py-6 flex justify-between items-center text-xl font-bold text-gray-900">
            <span class="text-blue-700">🧾 Total Annuel</span>
            <span>{{ number_format($classeFees->registration_fee_amount + $classeFees->transport_fee_amount + $classeFees->school_fee_amount, 0, ',', ' ') }} F CFA</span>
        </li>

        <!-- Reliquat Total -->
        <li class="py-6 flex justify-between items-center text-lg font-bold text-gray-800">
            <span class="text-gray-600">🧮 Reliquat Total</span>
            <span class="text-red-500">{{ number_format(
                ($classeFees->registration_fee_amount + $classeFees->transport_fee_amount + $classeFees->school_fee_amount)
                - ($paidFees['registration_fee_paid'] + $paidFees['transport_fee_paid'] + $paidFees['school_fee_paid']),
                0, ',', ' '
            ) }} F CFA</span>
        </li>
    </ul>
</div>

<!-- Table des Paiements -->
<div class="bg-gradient-to-r from-indigo-50 to-indigo-100 shadow-lg rounded-lg p-6">
    <h2 class="text-3xl font-extrabold text-indigo-700 mb-6 border-b pb-2">💳 Historique des Paiements</h2>
    <div class="overflow-x-auto">
        <table class="table-auto w-full border-collapse rounded-lg overflow-hidden shadow-sm">
            <thead>
                <tr class="bg-indigo-600 text-white text-sm uppercase tracking-wide">
                    <th class="px-4 py-3 text-left">Année scolaire</th>
                    <th class="px-4 py-3 text-left">Étudiant(e)</th>
                    <th class="px-4 py-3 text-left">Période</th>
                    <th class="px-4 py-3 text-left">Montant</th>
                    <th class="px-4 py-3 text-left">Commentaire</th>
                    <th class="px-4 py-3 text-left">Mode de paiement</th>
                    <th class="px-4 py-3 text-left">Type de paiement</th>
                    <th class="px-4 py-3 text-left">Date</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200 text-gray-700 text-sm">
                @if ($payments->isNotEmpty())
                    @foreach ($payments as $payment)
                        <tr class="hover:bg-indigo-50 transition duration-150">
                            <td class="px-4 py-3 font-medium">{{ $payment->academic_year->name }}</td>
                            <td class="px-4 py-3">{{ $payment->student->first_name }} {{ $payment->student->last_name }}</td>
                            <td class="px-4 py-3">{{ $payment->period->name }}</td>
                            <td class="px-4 py-3 text-green-600 font-bold">{{ number_format($payment->amount, 0, ',', ' ') }} F CFA</td>
                            <td class="px-4 py-3 italic">{{ $payment->comment }}</td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-semibold">
                                    {{ ucfirst($payment->payment_mode) }}
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 bg-purple-100 text-purple-800 rounded-full text-xs font-semibold">
                                    {{ ucfirst($payment->payment_for) }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-gray-500">{{ $payment->date }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="8" class="px-4 py-6 text-center text-gray-500">
                            Aucun paiement trouvé pour le moment.
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>

</div>
@endsection
