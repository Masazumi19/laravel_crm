<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use Illuminate\Http\Request;
use App\Models\Customer;
use GuzzleHttp\Client;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::all();
        return view('customers.index', compact('customers'));
    }


    public function postcode()
    {
        return view('customers.postcode');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $method = 'GET';
        $zipcode = $request->postcode;
        $url = 'https://zipcloud.ibsnet.co.jp/api/search?zipcode=' . $zipcode;

        $client = new Client();
        try {
            $response = $client->request($method, $url);
            $body = $response->getBody();
            $zip_cloud = json_decode($body, true);
            $result = $zip_cloud['results'][0];
            $address = $result['address1'] . $result['address2'] . $result['address3'];
            $postcode = $result['zipcode'];
        } catch (\Throwable $th) {
            $address = null;
            $postcode = null;
        }

        return view('customers.create')->with(compact('address', 'postcode'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRequest $request)
    {
         $customer = new Customer; // 空のインスタンスを作るって意味
        //$customer->customerid = $request->customerid; //左側が空の受け皿的な役割で､(下に続く)
        $customer->name = $request->name; //左側が空の受け皿的な役割で､(下に続く)
        $customer->email = $request->email; //右側が入力されたフォームが飛んできて､それを右側に代入する
        $customer->postcode = $request->postcode; 
        $customer->address= $request->address; 
        $customer->phonenumber= $request->phonenumber; 
        $customer->save();

        return redirect('/customers');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = Customer::find($id);
        return view('customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = Customer::find($id);
        return view('customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $customer = Customer::find($id);
        
        $customer->name = $request->name;
        $customer->email= $request->email;
        $customer->postcode= $request->postcode;
        $customer->address = $request->address;
        $customer->phonenumber = $request->phonenumber;
        $customer->save();
        return redirect('/customers');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::find($id);
        $customer->delete();

        return redirect('/customers');
    }
}
