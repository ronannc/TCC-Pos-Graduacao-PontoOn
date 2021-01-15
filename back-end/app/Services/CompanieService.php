<?php

namespace App\Services;


use App\Repositories\Contracts\CompanieRepository;

class CompanieService
{
    protected $repository;

    /**
     * syndicateService constructor.
     * @param CompanieRepository $repository
     */
    public function __construct( CompanieRepository $repository )
    {
        $this->repository = $repository;
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
    public function destroy($id): array
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
