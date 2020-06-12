<?php

namespace App\Http\Controllers\Backend;

use App\Models\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Backend\StoreCustomerRequest;
use App\Repositories\Backend\CustomerRepository;
use App\Repositories\Backend\CompanyRepository;

class CustomerController extends Controller
{
	/**
     * @var CustomerRepository
     */
    protected $customerRepository;

    /**
     * UserController constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function index() {
    	// dd();
    	return view('backend.customer.index', ['customers'=>$this->customerRepository->getActivePaginated(25, 'id', 'asc')]);
    }

    public function create(CompanyRepository $companyRepository) {
    	return view('backend.customer.create', ['companies'=>$companyRepository->where('active',1)->get(['id'=>'name'])]);
    }

    public function store(StoreCustomerRequest $request){
    	// dd($request->all());
    	$this->customerRepository->create($request->only(
            'name',
            'mobile',
            'email',
            'company_id',
            'about',
            'active'
        ));

        return redirect()->route('admin.customer.index')->withFlashSuccess(__('Customer created successfully.'));
    }

    public function show(Customer $customer) {
    	return view('backend.customer.show', ['customer'=>$customer]);
    }

    public function edit(Customer $customer, CompanyRepository $companyRepository) {
    	// dd();
    	return view('backend.customer.edit', ['customer'=>$customer, 'companies'=>$companyRepository->get(['id', 'name'])]);
    }

    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $this->customerRepository->update($customer, $request->only(
            'name',
            'mobile',
            'email',
            'company_id',
            'active'
        ));

        return redirect()->route('admin.customer.index')->withFlashSuccess(__('Customer updated successfully.'));
    }

    public function destroy(Customer $customer) {
    	$this->customerRepository->deleteById($customer->id);
    	return redirect()->route('admin.customer.index')->withFlashSuccess(__('Customer Deleted.'));
    }

    public function deactivated() {
    	return view('backend.customer.deactivated', ['customers'=>$this->customerRepository->getInActivePaginated(25, 'id', 'asc')]);
    }

    /**
     * @param Request $request
     * @param Customer              $customer
     * @param                   $status
     *
     * @throws \App\Exceptions\GeneralException
     * @return mixed
     */
    public function mark(Request $request, Customer $customer, $status)
    {
        $this->customerRepository->mark($customer, (int) $status);

        return redirect()->route(
            (int) $status === 1 ?
            'admin.customer.index' :
            'admin.customer.deactivated'
        )->withFlashSuccess(__('The customer was successfully updated.'));
    }
}
