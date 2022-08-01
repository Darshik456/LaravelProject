<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\users1;
use Illuminate\Support\Facades\DB;
use App\Models\products;
use App\Models\pdetails;

class Darshik extends Controller
{
    function index(){
        return view('index');
    }

    function shop(){
        $items = products::all();
        $data = compact('items');
        return view('shop',$data);
    }

    function detail(){
        $items = products::all();
        $data = compact('items');
        return view('detail',$data);
    }

    function cart(){
        return view('cart');
    }

    function checkout(){
        return view('checkout');
    }

    function contact(){
        return view('contact');
    }

    function signup(){
        return view('Signup');
    }

    function addUser(Request $request){

        $data = [

            'fname' => $request['fname'],
            'lname' => $request['lname'],
            'email' => $request['email'],
            'pass' => $request['pass'],
            'phoneNo' => $request['PhoneNo'],
            'address' => $request['address'],
            'country' => $request['country'],
            'city' => $request['city'],
            'state' => $request['state'],
            'zipCode' => $request['zipCode'],
            'Role_id' => 2,


        ];

        $Query = DB::table('users1')->insert($data);


        return redirect('login');
    }

    function logincheck(Request $request){

        $f1 = users1::where('email',$request['email'])->first();
        $f2 = users1::where('pass',$request['pass'])->first();

        if($f1!== null && $f2 !== null){

            if($f1->Role_id == 1){

                request()->session()->put('User',$f1);

           
                return view('admin.index');

            }else{
            
            request()->session()->put('User',$f1);
            return redirect('shop');
        }
        }else{

            echo 'Incorrect email or password';
        }
    }

      function Productform(){
        return view('admin.pages.forms.Productform');
      }

     function  ProductTable(){

        $items = products::all();
        $data = compact('items');

      
        return view('admin.pages.tables.Products' ,$data);
     }

     function UsersTable(){
        $users = users1::all();
        $data = compact('users');

        return view('admin.pages.tables.Users',$data);
     }



     function AddProduct(Request $request){
        
  


 

        $data = [

            'Name' => $request['Name'],
            'Price' => $request['Price'],
            'img' => $request->file('img')->getClientOriginalName(),
 

        ];

     

        $picname = request()->img->getClientOriginalName();
        request()->img->move(public_path('Uploads'),$picname);

        
     
    

        $Query = DB::table('products')->insert($data);


   

    

        
        
       
       
        $ff = products::where('Name',$request['Name'])->first();
        // $id = $ff->id;

        $id = $ff->id;
      
        if($id!==null){


       

        $data2 = [

            'img1' => $request->file('img1')->getClientOriginalName(),
            'img2' => $request->file('img2')->getClientOriginalName(),
            'img3' => $request->file('img3')->getClientOriginalName(),
            'pid'  => $id,
   

        ];

        $p1 = request()->img1->getClientOriginalName();
        request()->img1->move(public_path('Uploads'),$p1);
        $p2 = request()->img2->getClientOriginalName();
        request()->img2->move(public_path('Uploads'),$p2);
        $p3 = request()->img3->getClientOriginalName();
        request()->img3->move(public_path('Uploads'),$p3);

        $Query = DB::table('pdetails')->insert($data2);

    }

     
        return redirect('/ProductsTable');
    }

     function DeleteProduct($id){


        $Query = DB::table('products')->where('id',$id)->delete();

        return redirect('/ProductsTable');


     }

     function logout(){

        session()->forget('User');
        return redirect('/login');

     }
}
