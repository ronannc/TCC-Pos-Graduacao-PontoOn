<?php

namespace App\Services;


use App\Repositories\Contracts\BankHourRepository;

class BankHourService
{
    protected $repository;

    /**
     * syndicateService constructor.
     * @param BankHourRepository $repository
     */
    public function __construct( BankHourRepository $repository )
    {
        $this->repository = $repository;
    }

    public function create_bank_hours($register_point, $company_id)
    {
        $bank_hours = $this->repository->findOneBy(['employee_id' => $register_point->employee_id]);
        if(!$bank_hours){
            $bank_hours = $this->repository->save(['employee_id' => $register_point->employee_id, 'company_id' => $company_id]);
        }
        if($register_point->overtime > 0){
            $bank_hours->bank_details()->create([
                'date' => $register_point->date,
                'point_id' => $register_point->id,
                'minutes' => $register_point->overtime,
                'type_overtime' => $register_point->type_overtime,
            ]);
        }
    }

    /**
     * Adiciona uma empresa.
     *
     * @param array $data
     * @return array|\Illuminate\Database\Eloquent\Model
     */
    public function store( array $data )
    {
        try {
            return $this->repository->save( $data );
        } catch ( \Exception $exception ) {
            return [
                'error'   => true,
                'message' => $exception->getMessage()
            ];
        }
    }

    /**
     * @param array $data
     * @param $id
     * @return array|\Illuminate\Database\Eloquent\Model
     */
    public function update( array $data, $id )
    {
        try {
            $company = $this->repository->findOne( $id );
            return $this->repository->update( $company, $data );
        } catch ( \Exception $exception ) {
            return [
                'error'   => true,
                'message' => $exception->getMessage()
            ];
        }
    }

    /**
     * @param $id
     * @return array|mixed
     */
    public function destroy( $id ): array
    {
        try {
            $company = $this->repository->findOneOrFail( $id );
            return $this->repository->delete( $company );
        } catch ( \Exception $exception ) {
            return [
                'error'   => true,
                'message' => $exception->getMessage()
            ];
        }
    }

    /**
     * @param $id
     * @return array|\Illuminate\Database\Eloquent\Model|null
     */
    public function findOne( $id )
    {
        try {
            return $this->repository->findOne( $id );
        } catch ( \Exception $exception ) {
            return [
                'error'   => true,
                'message' => $exception->getMessage()
            ];
        }
    }

    /**
     * @param $id
     * @return array|\Illuminate\Database\Eloquent\Model|null
     */
    public function findOneOrFail( $id )
    {
        try {
            return $this->repository->findOneOrFail( $id );
        } catch ( \Exception $exception ) {
            return [
                'error'   => true,
                'message' => $exception->getMessage()
            ];
        }
    }
}
