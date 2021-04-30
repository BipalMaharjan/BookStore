<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSellerRequest;
use App\Jobs\MailJob;
use App\Models\Country;
use App\Models\Seller;
use App\Models\status;
use App\Models\User;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\Http;
use Symfony\Component\VarDumper\Cloner\Data;

class SellerController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','store']]);
         $this->middleware('permission:role-create', ['only' => ['create','store']]);
         $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Seller::get();

        return view('seller.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Seller::get();

        return view('seller.create');

    }


    public function store(StoreSellerRequest $request)
    {
        // $seller()->create([
        //     'status_id'=>$request->status_id,
        // ]);

        // $ip = $request->ip();
        $ip = '134.201.250.155';
        $countryDetail = $this->getCountry($ip);
        // dd($countryDetail);

        // todo: Create a function to get Country code, and name by passing Ip address

        DB::transaction(function () use($request){
            $user=User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ]);

            $user->assignRole('Seller');
            $seller=Seller::create([
                'user_id' => $user->id,
                'shop_name' => $request->shop_name,
                'commission' => $request->commission,
                'country_code' => $request->countrycode,
            ]);
        });



        return redirect()->route('sellers.index')
                        ->with('success','seller created successfully');
    }

    public function show($id)
    {
        $seller = Seller::find($id);
        return view('seller.show',compact('seller'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $seller = Seller::find($id);
        // $roles = Role::pluck('name','name')->all();
        // $sellerRole = $seller->roles->pluck('name','name')->all();
        return view('seller.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, StoreSellerRequest $requestid)
    // {


    // $this->validate($request, [
    //         'name' => 'required',
    //         'email' => 'required|email|unique:sellers,email',
    //         'password' => 'required|same:confirm-password',
    //         // 'roles' => 'required'
    //     ]);

    //     $input = $request->all();
    //     if(!empty($input['password'])){
    //         $input['password'] = Hash::make($input['password']);
    //     }else{
    //         $input = Arr::except($input,array('password'));
    //     }

    //     $seller = Seller::find($id);
    //     $seller->update($input);
    //     DB::table('model_has_roles')->where('model_id',$id)->delete();

    //     $seller->assignRole($request->input('roles'));

    /**
     * Remove the specified resource from storage.
     *Z
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Seller::find($id)->delete();
        return redirect()->route('sellers.index')
                        ->with('success','seller deleted successfully');
    }

    public function getCountry($ip)
    {
        $ipaddress = Http::post('http://api.ipstack.com/'.$ip.'?access_key=3295749de7184a3b6aec14c10e88fd75',[

        ])->json();
        return ($ipaddress);
    }

    public function activate(Seller $seller)
    {
        if($seller->is_active){
            return abort('401');
        }
        // $seller->update([
        //     'is_active'=>1,
        // ]);

        MailJob::dispatch($seller->user);
        return redirect()->route('sellers.index')->with('success','Seller account has been activated');

    }
}
