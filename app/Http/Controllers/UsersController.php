<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Validator;
use App\Models\User;
use Auth;
class UsersController extends Controller
{
    public function index(){
        $user = Auth::user();
        echo json_encode($user);
    }
 public function login(){
  if(Auth::attempt(['name' => request('name'), 'password' => request('password')])){
   $user = Auth::user();
   $success['token'] = $user->createToken('appToken')->accessToken;
   return response()->json([
    'success' => true,
    'token' => $success,
    'user' => $user,
   ]);
  } else{
   return response()->json([
    'success' => false,
    'message' => 'Invalid Email or Password',
   ], 401);
  }
 }
 public function register(Request $request){
    $validator = Validator::make($request->all(), [
     'name' => ['required', 'string', 'max:255'],
     'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
     'password' => ['required', 'string', 'min:8'],
    ]);
    if($validator->fails()){
     return response()->json([
      'success' => false,
      'message' => $validator->errors(),
     ], 401);
    }
    $input = $request->all();
    $input['password'] = bcrypt($input['password']);
    $user = User::create($input);
    $success['token'] = $user->createToken('appToken')->accessToken;
    return response()->json([
     'success' => true,
     'token' => $success,
     'user' => $user
    ]);
   }
   public function logout(Request $request){
    if(Auth::user()){
     $user = Auth::user()->token();
     $user->revoke();
  return response()->json([
      'success' => true,
      'message' => 'Logout successfully',
     ]);
    } else{
     return response()->json([
      'success' => false,
      'message' => 'Unable to Logout',
     ]);
    }
   }
}