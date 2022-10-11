<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyStoreRequest;
use App\Http\Requests\CompanyUpdateRequest;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $count = Company::count();

        $company = Company::all();

        return view("companies.index", compact('company','count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("companies.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyStoreRequest $request)
    {
        $company = $request->all();

        if($photo = $request->file('photo')){
            $company['photo'] = $request->file('photo')->store('uploads', 'public');
        }

        Company::create($company);

        return redirect()->route("companies.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = Company::find($id);

        return view("companies.show", compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Company::find($id);

        return view('companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyUpdateRequest $request, $id)
    {
        if ($request->hasFile('photo')){
            $photo = $request->file('photo')->store('uploads',' public');
            $logo = 1; 
        }else{
            $logo = 0;
        }

        $company = Company::find(1);

        $company->name = $request->name;
        $company->business_name = $request->business_name;
        $company->ruc = $request->ruc;
        $company->phone = $request->phone;
        $company->movile = $request->movile;
        $company->email = $request->email;
        $company->country = $request->country;
        $company->state = $request->state;
        $company->city = $request->city;
        $company->street = $request->street;
        $company->postal_code = $request->postal_code;
        $company->entry = $request->entry;
        $company->description = $request->description;

        if($logo == 1){
            $company->photo = $request->photo->getClientOriginalName();
        }

        $company->save();

        return redirect()->route('companies.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
