<?php 

namespace App\Repositories\Backend;

use App\Models\Company;
use App\Models\Customer;
use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Exceptions\GeneralException;
use Illuminate\Support\Facades\DB;

class CompanyRepository extends BaseRepository
{
	/**
     * CompanyRepository constructor.
     *
     * @param  Company  $model
     */
    public function __construct(Company $model)
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
        // Example 1
    	// DB::enableQueryLog();
        // $company = $this->model
        //     ->where('active', 1)
        //     ->orderBy($orderBy, $sort)
        //     ->paginate($paged);
        // $query = DB::getQueryLog();
        // echo "<pre>"; print_r($query);die;

        return $this->model
            ->where('active', 1)
            ->with('customers')
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
     * @return Company
     */
    public function create(array $data): Company
    {
        return DB::transaction(function () use ($data) {
            // dd($data);
            $company = $this->model::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'logo' => 'test.jpg',
                'website' => $data['website'],
                'active' => $data['active']
            ]);

            if($company) {
                return $company;
            }
            throw new GeneralException(__('There was a problem creating this company. Please try again.'));
        });
    }

    /**
     * @param Company  $company
     * @param array $data
     *
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     * @return Company
     */
    public function update(Company $company, array $data): Company
    {
        // dd($data);
        $this->checkCompanyByEmail($company, $data['email']);

        return DB::transaction(function () use ($company, $data) {
            if ($company->update([
                'name' => $data['name'],
                'email' => $data['email'],
                'logo' => 'test.jpg',
                'website' => $data['website'],
                'active' => $data['active']
            ])) {

                // event(new UserUpdated($user));

                return $company;
            }

            throw new GeneralException(__('There was a problem updating this company. Please try again.'));
        });
    }

    /**
     * @param Company $company
     * @param      $status
     *
     * @throws GeneralException
     * @return Company
     */
    public function mark(Company $company, $status): Company
    {
        $company->active = $status;

        // switch ($status) {
        //     case 0:
        //         event(new UserDeactivated($user));
        //     break;
        //     case 1:
        //         event(new UserReactivated($user));
        //     break;
        // }

        if ($company->save()) {
            return $company;
        }

        throw new GeneralException(__('There was a problem updating this company. Please try again.'));
    }

    /**
     * @param Company $company
     * @param      $email
     *
     * @throws GeneralException
     */
    protected function checkCompanyByEmail(Company $company, $email)
    {
        // Figure out if email is not the same and check to see if email exists
        if ($company->email !== $email && $this->model->where('email', '=', $email)->first()) {
            throw new GeneralException(trans('That email address belongs to a different company.'));
        }
    }
}