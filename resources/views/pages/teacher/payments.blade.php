@extends('layouts.dashboard')

@section('title', 'Paiements')

@section('content')
<div class="max-w-4xl mx-auto py-5">
    <div>
        <h2 class="font-bold text-xl">Coût Scolaire</h2>
        <ul>
            <li>
                Frais d'inscription :
                {{ $classeFees->registration_fee_amount . ' F CFA' }}
                Reliquat : 
            </li>
            <li>Frais de transport : {{ $classeFees->transport_fee_amount . ' F CFA' }}</li>
            <li>Frais scolaire : {{ $classeFees->school_fee_amount . ' F CFA' }}</li>
            <li>Total Annuel : {{ $classeFees->registration_fee_amount+$classeFees->transport_fee_amount+$classeFees->school_fee_amount . ' F CFA' }}</li>
        </ul>
    </div>
    <div class="overflow-x-auto">
        <table class="table-auto w-full">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 text-left">Année scolaire</th>
                    <th class="px-4 py-2 text-left">Etudiant(e)</th>
                    <th class="px-4 py-2 text-left">P riode</th>
                    <th class="px-4 py-2 text-left">Montant</th>
                    <th class="px-4 py-2 text-left">Commentaire</th>
                    <th class="px-4 py-2 text-left">Mode de paiement</th>
                    <th class="px-4 py-2 text-left">Type de paiement</th>
                    <th class="px-4 py-2 text-left">Date</th>
                </tr>
            </thead>
            <tbody>
                @if ($payments)
                @foreach ($payments as $payment)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border">{{ $payment->academic_year->name }}</td>
                        <td class="px-4 py-2 border">{{ $payment->student->first_name }} {{ $payment->student->last_name }}</td>
                        <td class="px-4 py-2 border">{{ $payment->period->name }}</td>
                        <td class="px-4 py-2 border">{{ number_format($payment->amount, 0, ',', ' ') }} F CFA</td>
                        <td class="px-4 py-2 border">{{ $payment->comment }}</td>
                        <td class="px-4 py-2 border">{{ ucfirst($payment->payment_mode) }}</td>
                        <td class="px-4 py-2 border">{{ ucfirst($payment->payment_for) }}</td>
                        <td class="px-4 py-2 border">{{ $payment->date }}</td>
                    </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
