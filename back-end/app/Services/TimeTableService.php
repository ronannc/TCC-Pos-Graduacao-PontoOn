<?php

namespace App\Services;


use App\Models\TimeTablesDescription;
use App\Repositories\Contracts\TimeTableRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TimeTableService
{
    protected $repository;

    /**
     * syndicateService constructor.
     * @param TimeTableRepository $repository
     */
    public function __construct( TimeTableRepository $repository )
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
            $time_table = $this->repository->save( $data['time-table'] );
            $time_table->time_tables()->createMany($data['entry-exit']);
            return $time_table;
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
     * @return array|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|ModelNotFoundException|null
     */
    public function findOneOrFail( $id )
    {
        try {
            $time_table = TimeTablesDescription::with('time_tables')->find($id);
            if($time_table) {
                return $time_table;
            }else{
                return new ModelNotFoundException('Model not found by ID ' . $id);
            }
        } catch ( \Exception $exception ) {
            return [
                'error'   => true,
                'message' => $exception->getMessage()
            ];
        }
    }
}
