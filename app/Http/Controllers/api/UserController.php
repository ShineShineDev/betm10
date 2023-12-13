<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use App\Models\Customer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;
use App\Models\GoogleToken;


class UserController extends Controller
{
    public function login(Request $request){
        $request->validate([
            'phone' => 'required|exists:customers,phone',
            'password' => 'required',
      
        ]);

        $customer = Customer::withCount('googleTokens')->where('phone', $request->phone)->first();

        if (!$customer || !Hash::check($request->password, $customer->password)) {
            return response()->json(["message" => 'The provided credentials are incorrect.'], 401);
        }
      
        if ($customer->google_token_count >= 5) {
          $firstGoogleToken = GoogleToken::where('customer_id',$customer->id)->orderBy('id','asc')->first();
          $firstGoogleToken->update(['token' => $request->google_token]);
        } else {
          GoogleToken::create([
            'customer_id' => $customer->id,
            'token' => $request->google_token,
          ]);
        }

        $token = $customer->createToken($request->phone)->plainTextToken;

        return response()->json([
            'user' => $customer,
            'token' => $token,
        ]);
    }
    
     public function changePassword(Request $request){
           if($request->newPassword === $request->comfirmPassword){ 
            $cus = Customer::where('id',$request->user()->id)->first();
             if (!Hash::check($request->oldPassword,$cus->password)){
                return response()->json(["message" => "Old password is invalid. Please try again."], 422);
                }
                $user = Customer::find($request->user()->id);
                $user->password =  Hash::make($request->newPassword);
                $user->update();
                return response()->json(["message" => "Successfully Change Password."]);
           }else{
            return response()->json(['message'=> 'New Password and Comfirm Password does not match!'],422);
           }
    }

    public function register(Request $request){
       $validated = $request->validate([
            'name' => 'required',
            'phone' => 'required|unique:customers,phone',
            'password' => 'required',
        ]);
        $validated["password"] = Hash::make($validated["password"]);
        $validated["referral_code"] = Str::random(6);
        $validated['friend_code'] = $request->friend_code;
        $validated["type"] = 'Customer';
        if($request->image){
        $imageName = time() . '-' . Str::random(10) . '.' . $request->file('image')->getClientOriginalExtension();
        $request->file('image')->move(public_path('uploads/image'), $imageName);
        $validated['image'] = '/uploads/image/' . $imageName;
        }
        $user = Customer::create($validated);
      
      	GoogleToken::create([
            'customer_id' => $user->id,
            'google_token' => $request->google_token,
        ]);
        $token = $user->createToken($request->phone)->plainTextToken;
        return response()->json([
            'user' => Customer::find($user->id),
            'token' => $token,
        ]);
    }

    public function getInfo() {
        $user = request()->user();
        return response()->json([
            'user' => $user
        ]);
    }


    public function update_profile(Request $request){
         $request->validate([
            'name' => 'required|max:255',
            'phone' => 'required|unique:customers,phone,' . request()->user()->id,
            'image' => 'nullable|image'

        ]);

        $customer = request()->user();
        
       if($request->has('image')){
        $imageName = time() . '-' . Str::random(10) . '.' . $request->file('image')->getClientOriginalExtension();
        $request->file('image')->move(public_path('uploads/image'), $imageName);
  

        if (!empty($customer)) {
            $customer->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'image'=>  '/uploads/image/' . $imageName
            ]);
        }
       }else{
           if (!empty($customer)) {
            $customer->update([
                'name' => $request->name,
                'phone' => $request->phone,
            ]);
       }
       }
       
       $data = Customer::where('id',$customer->id)->first();
       $data->image = 'https://admin.kmlottery.com' . $data->image;
      
        return response()->json([
           "data" => $data,
          "message" => 'Your account has been updated,successfully!'
          ]);

    }
}
