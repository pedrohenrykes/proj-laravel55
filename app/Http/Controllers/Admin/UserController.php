<?php

namespace App\Http\Controllers\Admin;

// use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileFormRequest;

class UserController extends Controller
{
    public function profile()
    {
        return view('site.profile.profile');
    }

    public function profileUpdate(UpdateProfileFormRequest $request)
    {
        $user = auth()->user();

        $data = $request->all();

        if ($data['password'] != null) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        $data['image'] = $user->image;

        $ext = $request->image->extension();

        if (
            $request->hasFile('image') && 
            $request->file('image')->isValid() && 
            ($ext == 'jpeg' || $ext == 'jpg' || $ext == 'png' )
        ) {

            if ($user->image) {
                $name = explode('.', $user->image)[0];
            } else {
                $name = $user->id . kebab_case($user->name);
            }

            $name = "{$name}.{$ext}";

            $upload = $request->image->storeAs('users', $name);
            
            if (!$upload) {
                return redirect()->back()
                ->with('error', ':( Houve algo de errado com a imagem enviada. Tente novamente!');
            }

            $data['image'] = $name;

        } else {
            return redirect()->back()
            ->with('error', 'O arquivo enviado, não é uma imagem valida. Tente novamente!');
        }

        $update = $user->update($data);

        if ($update) {
            return redirect()->route('profile')
            ->with('success', 'Suas informações foram atualizadas!');
        }

        return redirect()->back()
        ->with('error', 'Oops! Não foi possivél atualizar suas informações. Tente novamente!');
    }
}
