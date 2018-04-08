<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Balance extends Model
{
    public $timestamps = false;

    public function deposit(float $value) : Array
    {
        DB::beginTransaction();

        $totalBefore = $this->amount ? $this->amount : 0;
        $this->amount += number_format($value, '2', '.', '');
        $deposit = $this->save();

        $historic = auth()->user()->historics()->create([
            'type' => 'I',
            'amount' => $value,
            'total_before' => $totalBefore,
            'total_after' => $this->amount,
            'date' => date('Y-m-d')
        ]);

        if ($deposit && $historic) {
            
            DB::commit();
            
            return [
                'success' => true,
                'message' => 'Depósito realizada com sucesso!'
            ];

        } else {
            
            DB::rollback();

            return [
                'success' => false,
                'message' => 'Falha ao realizar o depósito. Tente novamente!'
            ];

        }
    }

    public function withdraw(float $value) : Array
    {
        if ($this->amount < $value) {
            return [
                'success' => false,
                'message' => 'Você não pode sacar uma quantia maior que seu saldo.'
            ];
        }
        
        DB::beginTransaction();

        $totalBefore = $this->amount ? $this->amount : 0;
        $this->amount -= number_format($value, '2', '.', '');
        $withdraw = $this->save();

        $historic = auth()->user()->historics()->create([
            'type' => 'O',
            'amount' => $value,
            'total_before' => $totalBefore,
            'total_after' => $this->amount,
            'date' => date('Y-m-d')
        ]);

        if ($withdraw && $historic) {
            
            DB::commit();
            
            return [
                'success' => true,
                'message' => 'Saque realizada com sucesso!'
            ];

        } else {
            
            DB::rollback();

            return [
                'success' => false,
                'message' => 'Falha ao realizar o saque. Tente novamente!'
            ];

        }
    }
}
