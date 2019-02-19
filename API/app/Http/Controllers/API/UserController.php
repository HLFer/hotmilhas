<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller; 
use App\User;
use App\WebCrawler\SearchVehicle; 
use Illuminate\Support\Facades\Auth; 
use Illuminate\Http\Request; 
use Validator;



class UserController extends Controller 
{
    public $successStatus = 200;
    private $vehicle;

    public function __construct(SearchVehicle $vehicle)
    {
        $this->vehicle = $vehicle;
    }
    /** 
     * login api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function login(){ 
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('MyApp')-> accessToken; 
            return response()->json(['success' => $success], $this-> successStatus); 
        } 
        else{ 
            return response()->json(['error'=>'Unauthorised'], 401); 
        } 
    }


    /** 
     * Register api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function register(Request $request) 
    { 
        $validator = Validator::make($request->all(), [ 
            'name' => 'required', 
            'email' => 'required|email', 
            'password' => 'required', 
            'confirm_password' => 'required|same:password', 
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        $input = $request->all(); 
        $input['password'] = bcrypt($input['password']); 
        $user = User::create($input); 
        $success['token'] =  $user->createToken('MyApp')-> accessToken; 
        $success['name'] =  $user->name;
        return response()->json(['success'=>$success], $this-> successStatus); 
    }
    /** 
     * details api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function accountDetails() 
    { 
        $user = Auth::user(); 
        return response()->json(['success' => $user], $this-> successStatus); 
    }
    public function searchVehicle($brand, $model){  
        $brand_ok = false;
        $id = 0;     
        $result_brand = $this->vehicle->findBrands();
        foreach($result_brand as $key){          
            if(ucfirst(strtolower($brand)) == $key['brand']){
                $brand_ok = true;
                $id = $key['id'];
            } 
        }
        if($brand_ok){
            $result_model = $this->vehicle->findModels($model, $id);
            if(!empty($result_model)){
                $result = $this->vehicle->searchVehicle($result_model, $brand);
            }else{
                return response()->json(['erro'=>"Modelo não encontrado"], 401);   
            }
        }else{
            return response()->json(['erro'=>"Marca não encontrada"], 401);   
        }
    }
    public function vehicleDetails() 
    { 
        return 'teste detalhes';
    }
}