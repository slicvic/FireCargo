<?php namespace App\Http\Controllers;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Validator;

use App\Models\Company;
use App\Helpers\Flash;

class CompaniesController extends BaseAuthController {

    public function __construct(Guard $auth)
    {
        parent::__construct($auth);
        $this->middleware('admin');
    }

    /**
     * Displays a list of companies.
     */
    public function getIndex()
    {
        $companies = Company::all();
        return view('companies.index', ['companies' => $companies]);
    }

    /**
     * Shows the form for creating a new company.
     */
    public function getCreate()
    {
        return view('companies.form', ['company' => new Company()]);
    }

    /**
     * Stores a newly created company.
     */
    public function postStore(Request $request)
    {
        $validator = Validator::make($input = $request->all(), Company::$rules);

        if ($validator->fails())
        {
            Flash::error($validator->messages());
            return redirect()->back()->withInput();
        }

        Company::create($input);

        return redirect('companies');
    }

    /**
     * Shows the form for editing a company.
     */
    public function getEdit($id)
    {
        $company = Company::findOrFail($id);
        return view('companies.form', ['company' => $company]);
    }

    /**
     * Updates the specified user.
     */
    public function postUpdate(Request $request, $id)
    {
        $company = Company::findOrFail($id);

        $validator = Validator::make($input = $request->all(), Company::$rules);

        if ($validator->fails())
        {
            Flash::error($validator->messages());
            return redirect()->back()->withInput();
        }

        $company->update($input);

        return redirect('companies');
    }
}
