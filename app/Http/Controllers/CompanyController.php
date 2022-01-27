<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::orderBy('id','desc')->paginate(10);

     	return view('company.index', [
     		'companies' => $companies
     	]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'email',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:ratio=1/1',
        ]);

        $company = new Company();
        $company->name = $request->name;
        $company->email = $request->email;
        $logoName = time().'.'.$request->logo->extension();
        $request->logo->storeAs('public', $logoName);
        $company->logo = $logoName;
        $company->website = $request->website;
        $company->save();

        return redirect()->route('company.all')->with('status', 'Successfully created new company');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Company::find($id);
        return view('company.edit-modal',[
            'company' => $company
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'email',
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:ratio=1/1',
        ]);

        $company = Company::find($id);
        $company->name = $request->name;
        $company->email = $request->email;
        if ($request->hasFile('logo')) {
            if(Storage::exists('public/' . $company->logo))
            {
                Storage::delete('public/' . $company->logo);
            }
            $logoName = time().'.'.$request->logo->extension();
            $request->logo->storeAs('public', $logoName);
            $company->logo = $logoName;
        }

        $company->website = $request->website;
        $company->save();

        return redirect()->route('company.all')->with('status', 'Successfully Updated Company');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Company::find($id);
        if(Storage::exists('public/' . $company->logo))
        {
            Storage::delete('public/' . $company->logo);
        }
        $company->delete();
        return redirect()->route('company.all')->with('status', 'Deleted company');
    }
}
