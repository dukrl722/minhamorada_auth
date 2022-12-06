<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class PasswordController extends Controller
{

    /**
     * @author Eduardo da Silva
     * @since 06/12/2022
     * @param Request $request
     * @return Response
     *
     * Retornar o token enviado por email
     */
    public function returnTokenReset(Request $request)
    {

        $token = $request->only('token');

        return response()->json([
            'token' => $token
        ], 200);

    }

    /**
     * @author Eduardo da Silva
     * @since 06/12/2022
     * @param Request $request
     * @return RedirectResponse
     *
     * Enviar email para resetar a senha
     */
    public function recoverMail(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status == Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withInput($request->only('email'))
                ->withErrors(['email' => __($status)]);

    }

    /**
     * @author Eduardo da Silva
     * @since 06/12/2022
     * @param Request $request
     * @return RedirectResponse
     *
     * Resetar a senha do usuário
     */
    public function resetPassword(Request $request)
    {

        try {

            $request->validate([
                'token' => 'required',
                'email' => 'required|email',
                'password' => 'required|confirmed',
            ]);

            $status = Password::reset(
                $request->only('email', 'password', 'password_confirmation', 'token'),
                function ($user, $password) {
                    $user->forceFill([
                        'password' => Hash::make($password)
                    ])->setRememberToken(Str::random(60));

                    $user->save();

                    event(new PasswordReset($user));
                }
            );

            $newPassword = bcrypt($request->only('password'));

            $update = Users::where('email', $credentials['email'])->update(['password' => $newPassword]);
            $update->save();

            return $status === Password::PASSWORD_RESET
                ? redirect()->route('login')->with('status', __($status))
                : back()->withErrors(['email' => [__($status)]]);

        } catch (\Throwable $th) {

            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);

        }
    }

}
