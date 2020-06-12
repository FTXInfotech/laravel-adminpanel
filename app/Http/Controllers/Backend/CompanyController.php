<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Backend\StoreCompanyRequest;
use App\Http\Requests\Backend\UpdateCompanyRequest;
use App\Models\Company;
use App\Repositories\Backend\CompanyRepository;

class CompanyController extends Controller
{
    /**
     * @var CompanyRepository
     */
    protected $companyRepository;

    /**
     * UserController constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(CompanyRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    public function index() {
    	// dd($this->companyRepository->getActivePaginated(25, 'id', 'asc'));
    	return view('backend.company.index', ['companies'=>$this->companyRepository->getActivePaginated(25, 'id', 'asc')]);
    }

    public function create() {
    	return view('backend.company.create');
    }

    public function store(StoreCompanyRequest $request){
    	
    	$this->companyRepository->create($request->only(
            'name',
            'email',
            'logo',
            'website',
            'active'
        ));

        return redirect()->route('admin.company.index')->withFlashSuccess(__('Company created successfully.'));
    	
    }

    public function show(Company $company) {
    	return view('backend.company.show', ['company'=>$company]);
    }

    public function edit(Company $company) {
    	return view('backend.company.edit', ['company'=>$company]);	
    }

    public function update(UpdateCompanyRequest $request, Company $company)
    {
        $this->companyRepository->update($company, $request->only(
            'name',
            'email',
            'logo',
            'website',
            'active'
        ));

        return redirect()->route('admin.company.index')->withFlashSuccess(__('Company updated successfully.'));
    }

    public function destroy(Company $company) {
    	$this->companyRepository->deleteById($company->id);
    	return redirect()->route('admin.company.index')->withFlashSuccess(__('Company Deleted.'));
    }

    protected function validationAttributes() {
    	return request()->validate([
    		'name'=>['required', 'min:3', 'max:100'],
    		'email'=>['required'],
    		'website'=>'required',
    		'logo'=>'nullable',
    		'active'=>'required'
    	]);
    }

    public function deactivated() {
    	return view('backend.company.deactivated', ['companies'=>$this->companyRepository->getInActivePaginated(25, 'id', 'asc')]);
    }

    /**
     * @param Request $request
     * @param Company $company
     * @param $status
     *
     * @throws \App\Exceptions\GeneralException
     * @return mixed
     */
    public function mark(Request $request, Company $company, $status)
    {
        $this->companyRepository->mark($company, (int) $status);

        return redirect()->route(
            (int) $status === 1 ?
            'admin.company.index' :
            'admin.company.deactivated'
        )->withFlashSuccess(__('The company was successfully updated.'));
    }
}
