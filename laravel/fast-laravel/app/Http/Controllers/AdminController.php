<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Food;
use App\Models\Reservation;
use App\Models\Foodchef;
use App\Models\Order;
// use Illuminate\Support\Facades\Validator;


class AdminController extends Controller
{

    // public function _construct(){
    //     $this->middleware('auth:api',['execut'=>['login', 'register']]);
    // }
    // public function Register(Request $request){
    //     $validator = Validator::make($request->all(), [
    //         'name'=>'required',
    //         'email'=>'required|email',
    //         'password'=>'required|confirmed|min:8'
    //     ]);
    //     if($validator->fails()){
    //         return response()->json($validator->errors()->toJson(), 400);
    //     }
    //     $user = User::create(array_merge(
    //         $validator->validated(),
    //         ['password'=>bcrypt($request->password)]
    //     ));
    //     return response()->json([
    //         'message'=>'User successfully registered',
    //         'user'=>$user
    //     ],201);
    // }
    // public function login(Request $request){
    //     $validator = Validator::make($request->all(), [
    //         'email'=>'required|email',
    //         'password'=>'required|min:8'
    //     ]);
    //     if($validator->fails()){
    //         return response()->json($validator->errors(), 422);
    //     }
    //     if(!$token=auth()->attempt($validator->validated())){
    //         return response()->json(['error'=>'Unauthorized'], 401);
    //     }
    //     return $this->createNewToken($token);
    // }

    // public function createNewToken($token){
    //     return response()->json([
    //         'access_token'=>$token,
    //         'token_type'=>'bearer',
    //         'expires'=>auth()->factory()->getTTL()*60,
    //         'user'=>auth()->user()
    //     ]);
    // }
    // public function profile(){
    //     return response()->json(auth()->user());
    // }
    // public function logout(){
    //     auth()->logout();
    //     return response()->json([
    //         'message'=>'User logged out'
    //     ],201);
    // }
    
    
    
    public function user(){
        $data = user::all();

        return view("admin.users",compact("data"));
    }



    public function deleteuser($id){
        $data = user::find($id);
        $data->delete();
        return redirect()->back();
        return view("admin.users",compact("data"));
    }

    public function deletemenu($id){
        $data = food::find($id);
        $data->delete();
        return redirect()->back();
    }



    public function foodmenu(){
        $data = food::all();
        return view("admin.foodmenu",compact("data"));
    }


public function updateview($id){
    $data = food::find($id);
    return view("admin.updateview",compact("data"));
}

public function update(Request $request , $id){

    $data = food::find($id);

    $image=$request->image;

    $imagename =time().'.'.$image->getClientOriginalExtension();
               $request->image->move('foodimage',$imagename);
               $data->image=$imagename;

               $data->title=$request->title;

               $data->price=$request->price;

               $data->description=$request->description;

               $data->save();

               return redirect()->back();
}





    public function uploadfood(Request $request){
        $data = new food;
        $image=$request->image;
        $imagename =time().'.'.$image->getClientOriginalExtension();
                   $request->image->move('foodimage',$imagename);
                   $data->image=$imagename;

                   $data->title=$request->title;

                   $data->price=$request->price;

                   $data->description=$request->description;

                   $data->save();

                   return redirect()->back();
                      
                
    }





    public function reservation(Request $request){
        $data = new reservation;
       

                   $data->name=$request->name;

                   $data->email=$request->email;

                   $data->phone=$request->phone;
                   $data->guest=$request->guest;
                   $data->date=$request->date;
                   $data->time=$request->time;
                   $data->massage=$request->massage;

                   $data->save();

                   return redirect()->back();
                      
                
    }

    public function viewreservation(){
        if(Auth::id())
        {

     
        $data =reservation::all();
        return view("admin.adminreservation",compact("data"));
        }
        else{
            return redirect('login');
        }
    }

   public function viewchef(){
      $data = foodchef::all();
      return view("admin.adminchef",compact("data"));
   }


   public function uploadchef(Request $request)
   {
    $data = new foodchef;
    $image = $request->image;
    $imagename = time().'.'.$image->getClientOriginalExtension();
               $request->image->move('chefimage',$imagename);
               $data->image=$imagename;

               $data->name=$request->name;

               $data->speciality=$request->speciality;


               $data->save();

                return redirect()->back();
   }


   public function updatechef($id)
   {


    $data=foodchef::find($id);
    return view("admin.updatechef",compact("data"));
          
   }

   public function updatefoodchef(Request $request,$id){


       $data=foodchef::find($id);
       $image = $request->image;

       if($image){
       $imagename = time().'.'.$image->getClientOriginalExtension();
               $request->image->move('chefimage',$imagename);
               $data->image=$imagename;

       }

               $data->name=$request->name;
               $data->speciality=$request->speciality;
               $data->save();
               return redirect()->back();

   }
    public function deletechef($id)
   {
         $data=foodchef::find($id);
         $data->delete();
         return redirect()->back();
   }
   public function orders(){
    $data=order::all();
    return view('admin.orders',compact('data'));
   }


   public function search(Request $request){
    $search=$request->search;
    $data=order::where('name','Like','%'.$search.'%')->orWhere('foodname','Like','%'.$search.'%')
    ->get();
    return view('admin.orders',compact('data'));
   }

    
}
