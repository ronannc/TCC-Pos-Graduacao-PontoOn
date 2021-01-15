<?php

namespace App\Services;


use App\Models\RegisterPoint;
use App\Repositories\Contracts\EmployeeRepository;
use App\Repositories\Contracts\HolidayRepository;
use App\Repositories\Contracts\RegisterPointRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class RegisterPointService
{
    protected $repository;
    protected $employeeRepository;
    protected $holidayRepository;
    protected $bankHourService;

    /**
     * RegisterPointService constructor.
     * @param RegisterPointRepository $repository
     * @param EmployeeRepository $employeeRepository
     */
    public function __construct( RegisterPointRepository $repository, EmployeeRepository $employeeRepository, HolidayRepository $holidayRepository, BankHourService $bankHourService )
    {
        $this->repository         = $repository;
        $this->employeeRepository = $employeeRepository;
        $this->holidayRepository  = $holidayRepository;
        $this->bankHourService    = $bankHourService;
    }

    /**
     * Adiciona uma empresa.
     *
     * @param array $data
     * @return array|\Illuminate\Database\Eloquent\Model
     */
    public function store( array $points )
    {
        try {
            return DB::transaction( function () use ( $points ) {
                $employee                       = $this->employeeRepository->findOne( $points->first()[ 'employee_id' ] );
                $time_table                     = $employee->time_table_description->time_tables;
                $syndicate                      = $employee->syndicate;
                foreach ($points as $data){
                    $register_point = $this->repository->findOneBy( [ 'date' => $data['date'] ] );
                    if($register_point){
                        return [
                            'error'   => true,
                            'message' => 'Existe um registro de ponto neste dia'
                        ];
                    }
                    $register_point                 = $this->repository->save( $data );
                    $holiday                        = $this->holidayRepository->findOneBy( [ 'date' => $register_point->date ] );
                    $schedules                      = $register_point->schedule()->createMany( $data[ 'entry_exit' ] );
                    $register_point->minutes_worked = self::get_minutes_worked( $schedules );
                    $register_point->overtime       = self::get_overtime( $register_point, $time_table, $holiday );
                    $register_point->type_overtime  = self::get_type_overtime( $register_point, $syndicate, $holiday );
                    $register_point->type           = self::get_type_registered_point( $data, $holiday, $schedules );
                    $register_point->save();
                    $this->bankHourService->create_bank_hours($register_point, $data['company_id']);
                }

                return 'ok';
            } );
        } catch ( \Exception $exception ) {
            return [
                'error'   => true,
                'message' => $exception->getMessage()
            ];
        }
    }

    /**
     * @param $schedule
     * @return int
     */
    private function get_minutes_worked( $schedule )
    {
        $datetimes      = $schedule->sortBy( 'datetime' )->pluck( 'datetime' )->chunk( 2 );
        $minutes_worked = 0;
        foreach ( $datetimes as $datetime ) {
            $date1          = new Carbon( $datetime->first() );
            $date2          = new Carbon( $datetime->last() );
            $minutes_worked += $date1->diffInMinutes( $date2 );
        }
        return $minutes_worked;
    }

    private function get_overtime( $register_point, $time_table, $holiday )
    {
        $date            = new Carbon( $register_point->date );
        $day             = $date->dayOfWeek;
        $minutes_to_work = $this->hours_to_minutes( $time_table->where( 'day', $day )->first()[ 'quantity_hours_day' ] );
        if ( $holiday ) {
            $minutes_to_work = 0;
        }
        return $register_point->minutes_worked - $minutes_to_work;
    }

    private function hours_to_minutes( $time )
    {
        if ( $time == null ) {

            return 0;
        }
        $time = explode( ':', $time );

        return ( $time[ 0 ] * 60 ) + ( $time[ 1 ] ) + ( $time[ 2 ] / 60 );

    }

    private function get_type_overtime( $register_point, $syndicate, $holiday )
    {
        $day = date( 'D', strtotime( $register_point->date ) );
        if ( $holiday ) {
            $type = $syndicate[ 'type_holiday' ];
        } elseif ( $day == "Sat" ) {
            $type = $syndicate[ 'type_sat' ];
        } else if ( $day == "Sun" ) {
            $type = $syndicate[ 'type_sun' ];
        } else {
            $type = $syndicate[ 'type_week' ];
        }

        return $type;
    }

    private function get_type_registered_point( $data, $holiday, $schedules )
    {
        if ( $schedules->count() > 0 )
            $type = RegisterPoint::WORKED;
        elseif ( $holiday )
            $type = RegisterPoint::HOLIDAY;
        elseif ( isset( $data[ 'type' ] ) )
            $type = $data[ 'type' ];

        return $type;
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
