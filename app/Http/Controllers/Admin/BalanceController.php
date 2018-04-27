<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Balance;
use App\Http\Requests\MoneyValidationFormRequest;
use App\User;
use App\Models\Historic;

class BalanceController extends Controller
{
    private $rowsPerPage = 5;

    public function index()
    {
        // neste caso, balance nao e um atributo de user, mas uma funcao
        $balance = auth()->user()->balance;
        $amount = $balance ? $balance->amount : 0;

        return view('admin.balance.index', compact('amount'));
    }

    public function deposit()
    {
        return view('admin.balance.deposit');
    }
    
    public function depositStore(MoneyValidationFormRequest $request)
    {
        $balance = auth()->user()->balance()->firstOrCreate([]);
        
        $response = $balance->deposit($request->new_value);

        if ($response['success']) {
            return (
                redirect()
                ->route('admin.balance')
                ->with('success', $response['message'])
            );
        }

        return (
            redirect()
            ->back()
            ->with('error', $response['message'])
        );
    }

    public function withdraw()
    {
        return view('admin.balance.withdraw');
    }

    public function withdrawStore(MoneyValidationFormRequest $request)
    {
        $balance = auth()->user()->balance()->firstOrCreate([]);
        
        $response = $balance->withdraw($request->new_value);

        if ($response['success']) {
            return (
                redirect()
                ->route('admin.balance')
                ->with('success', $response['message'])
            );
        }

        return (
            redirect()
            ->back()
            ->with('error', $response['message'])
        );
    }

    public function transfer()
    {
        return view('admin.balance.transfer');
    }

    public function receiverConfirm(Request $request, User $user)
    {
        $receiver = $user->searchReceiver($request->receiver_user);
        
        if (!$receiver) {
            return (
                redirect()
                ->back()
                ->with('error', 'O favorecido não foi encontrado! Por favor, informe novamente')
            );
        }

        if ($receiver->id === auth()->user()->id) {
            return (
                redirect()
                ->back()
                ->with('error', 'Ops! Não é possível realizar uma transferência para você mesmo.')
            );
        }
        
        $balance = auth()->user()->balance;

        return view('admin.balance.transfer-validate', compact('receiver', 'balance'));
    }

    public function transferStore(MoneyValidationFormRequest $request, User $user)
    {
        $receiver = $user->find($request->receiver_id);

        if (!$receiver) {
            return (
                redirect()
                ->route('balance.transfer')
                ->with('error', 'Favorecido não identificado, por favor, tente novamente.')
            );
        }

        $balance = auth()->user()->balance()->firstOrCreate([]);
        
        $response = $balance->transfer($request->new_value, $receiver);

        if ($response['success']) {
            return (
                redirect()
                ->route('admin.balance')
                ->with('success', $response['message'])
            );
        }

        return (
            redirect()
            ->route('balance.transfer')
            ->with('error', $response['message'])
        );
    }

    public function historic(Historic $historic)
    {
        // neste caso, historics e uma funcao de user, mas pode ser chamado como atributo
        $historics = auth()->user()->historics()->with(['userSender'])->paginate($this->rowsPerPage);

        $types = $historic->type();

        return view('admin.balance.historic', compact('historics', 'types'));
    }

    public function searchHistoric(Request $request)
    {
        dd($request->all());
    }
}
