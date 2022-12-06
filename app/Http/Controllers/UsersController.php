<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Users;
use App\Rules\EmailValidation;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class UsersController extends Controller
{

    /**
     * @author Eduardo da Silva
     * @since 03/12/2022
     * @param Request $request
     *
     * @return Response
     *
     * Autenticação de usuário
     */
    public function authenticateUser(Request $request)
    {

        try {

            $credentials = $request->only(
                'email',
                'password',
            );

            $searchUser = Users::where('email', $credentials['email'])->first();

            if (!$searchUser || !Hash::check($credentials['password'], $searchUser->password)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Usuário ou senha inválidos.'
                ], 401);
            }

            return response()->json([
                'success' => true,
                'message' => 'Login efetuado com sucesso',
                'user' => $searchUser,
                'token' => $searchUser->createToken('user_token')->plainTextToken
            ], 200);

        } catch (\Throwable $th) {

            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);

        }
    }

    /**
     * @author Eduardo da Silva
     * @since 03/12/2022
     * @param Request $request
     *
     * @return Response
     *
     * Inserir usuário
     */
    public function addUser(Request $request)
    {

        try {

            $credentialsUser = $request->only(
                'name',
                'email',
                'password',
            );

            $credentialsAddress = $request->only(
                'cep',
                'street',
                'number',
                'district',
                'city',
                'state'
            );

            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
                'name' => 'required',
                'cep' => 'required|max:8|min:8',
                'street' => 'required',
                'number' => 'required',
                'district' => 'required',
                'city' => 'required',
                'state' => 'required'
            ]);

            $credentialsUser['password'] = bcrypt($credentialsUser['password']);

            // primeiro salvamos o endereço para receber seu id
            $newAddress = Address::create($credentialsAddress);

            $credentialsUser['address_id'] = $newAddress->id;

            $newUser = Users::create($credentialsUser);

            if (!$newUser) {
                return response()->json([
                    'success' => false,
                    'message' => 'Erro ao criar um novo usuário'
                ], 500);
            }

            return response()->json([
                'success' => true,
                'message' => 'Usuário criado com sucesso',
                'user' => $newUser,
                'token' => $newUser->createToken('user_token')->plainTextToken
            ], 200);

        } catch (\Throwable $th) {

            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);

        }

    }

    /**
     * @author Eduardo da Silva
     * @since 03/12/2022
     * @return Response
     *
     * Encerrar a sessão do usuário, deletando seu token
     */
    public function endSession()
    {

        auth()->user()->tokens()->delete();

        return response()->json([
            'message' => 'Logout efetuado com sucesso'
        ], 200);

    }

    /**
     * @author Eduardo da Silva
     * @since 03/12/2022
     * @return Response
     *
     * Retornar todos os usuários
     */
    public function listAllUsers()
    {

        try {

            $users = Users::all();

            return response()->json([
                'success' => true,
                'data' => $users
            ], 200);

        } catch (\Throwable $th) {

            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);

        }

    }

}
