<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Http\Requests\CompanyRequest;
class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company = Company::paginate(10);
        return view("company.company_list")->with('company', $company); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company.company_create_edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyRequest $request)
    {
        $user = new Company;
        $user->name =  $request->name;
        $user->email = $request->email;
        $user->website = $request->website;
        if($request->hasFile('logo')){
            $file = $request->file('logo');
           $filename = $file->getClientOriginalName();
           $file->storeAs('images/',$filename);
           $user->logo =  $file->getClientOriginalName();
         }
         // $input = $request->all();
         $user->save();
       
         return redirect('/company')->with('success', 'Company created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        return view('company.company_create_edit')->with('company', $company);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyRequest $request, $id)
    {
        $company = Company::find($id);
        $company->name = $request->name;
        $company->email = $request->email;
        $company->website = $request->website;
      
        if($request->hasFile('logo')){
            $file = $request->file('logo');
           $filename = $file->getClientOriginalName();
           $file->storeAs('public/',$filename);
           $company->logo = $filename;
         
        }
        $company->save();

        return redirect('/company')->with('success', 'Company Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Company::find($id);
        $company->status = "Inactive";
        $company->update();
        return back()->with('success', 'Company Deleted successfully.');
    }
}
