<?php 

namespace App\Repositories\Backend;

use App\Models\Customer;
use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Exceptions\GeneralException;
use Illuminate\Support\Facades\DB;

class CustomerRepository extends BaseRepository
{
	/**
     * CustomerRepository constructor.
     *
     * @param  Customer  $model
     */
    public function __construct(Customer $model)
    {
        $this->model = $model;
    }

    /**
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return mixed
     */
    public function getActivePaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc'): LengthAwarePaginator
    {
        return $this->model
            ->where('active', 1)
            ->with('company')
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    /**
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return mixed
     */
    public function getInActivePaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc'): LengthAwarePaginator
    {
        // dd($this->model->active()->orderBy($orderBy, $sort)->paginate($paged));
        return $this->model
            ->where('active', 0)
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    /**
     * @param array $data
     *
     * @throws \Exception
     * @throws \Throwable
     * @return Customer
     */
    public function create(array $data): Customer
    {
        return DB::transaction(function () use ($data) {
            // dd($data);
            $customer = $this->model::create([
                'name' => $data['name'],
                'mobile' => $data['mobile'],
                'email' => $data['email'],
                'company_id' => $data['company_id'],
                'about'=>$data['about'],
                'active' => $data['active']
            ]);

            if($customer) {
                return $customer;
            }
            throw new GeneralException(__('There was a problem creating this customer. Please try again.'));
        });
    }

    /**
     * @param Customer  $customer
     * @param array $data
     *
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     * @return Customer
     */
    public function update(Customer $customer, array $data): Customer
    {
        // dd($data);
        $this->checkCustomerByEmail($customer, $data['email']);

        return DB::transaction(function () use ($customer, $data) {
            if ($customer->update([
                'name' => $data['name'],
                'mobile' => $data['mobile'],
                'email' => $data['email'],
                'company_id' => $data['company_id'],
                'active' => $data['active']
            ])) {

                // event(new UserUpdated($user));

                return $customer;
            }

            throw new GeneralException(__('There was a problem updating this customer. Please try again.'));
        });
    }

    /**
     * @param Customer $customer
     * @param      $status
     *
     * @throws GeneralException
     * @return Customer
     */
    public function mark(Customer $customer, $status): Customer
    {
        $customer->active = $status;

        // switch ($status) {
        //     case 0:
        //         event(new UserDeactivated($user));
        //     break;
        //     case 1:
        //         event(new UserReactivated($user));
        //     break;
        // }

        if ($customer->save()) {
            return $customer;
        }

        throw new GeneralException(__('There was a problem updating this customer. Please try again.'));
    }

    /**
     * @param Customer $customer
     * @param      $email
     *
     * @throws GeneralException
     */
    protected function checkCustomerByEmail(Customer $customer, $email)
    {
        // Figure out if email is not the same and check to see if email exists
        if ($customer->email !== $email && $this->model->where('email', '=', $email)->first()) {
            throw new GeneralException(trans('That email address belongs to a different customer.'));
        }
    }
}