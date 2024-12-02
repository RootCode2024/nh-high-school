<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Nette\Utils\Html;

class Payment extends Model
{

    protected $guarded = [];

    public function student()
    {
        return $this->belongsTo(\App\Models\Student::class);
    }

    public function period()
    {
        return $this->belongsTo(\App\Models\Period::class);
    }

    public function academic_year()
    {
        return $this->belongsTo(\App\Models\AcademicYear::class);
    }

    public static function payment($state)
    {
        // dd($state);
        $studentId = $state->student_id;
        $student = Student::where('id', $studentId)->first();
        $studentClasseId = $student->classe_id;
        $studentClassLevelId = Classe::where('id', $studentClasseId)->first();
        $classLevel = $studentClassLevelId->level;
        $amount = $state->amount;

        $classesFees = ClassesFees::where('classe_id', $studentClasseId)->first();
        $allPayment = Payment::where('student_id', $studentId)->get();

        $rpf = '';
        $allAmount = [];
        $fees = null;
        foreach ($allPayment as $key => $value) {
            if ($value->payment_for === 'registration_fees') {
                $rpf = 'Frais d\'Inscription.';
                $allAmount[] = $value->amount;
                $fees = $classesFees->registration_fee_amount;
            }
            elseif ($value->payment_for === 'school_fees')
            {
                $rpf = 'Scolarité.';
            }
            elseif ($value->payment_for === 'bus_fees')
            {
                $rpf = 'Frais de Transport.';
            }
            elseif ($value->payment_for === 'other')
            {
                $rpf = 'Frais Divers.';
            }
        }

        $somme = 0;

        foreach ($allAmount as $key => $value) {
            $somme +=$value;
        }

        $reliquat = $fees - $somme;
        $result = '';
        if($reliquat === 0)
        {
            $result = " - SOLDE -";
        }
        else
        {
            $result = ' Reliquat : ' . $reliquat;
        }

        return Html::htmlToText($rpf . $result);
    }

    public function calculator()
    {

    }

}
