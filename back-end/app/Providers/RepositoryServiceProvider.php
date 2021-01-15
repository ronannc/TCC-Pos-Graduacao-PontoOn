<?php

namespace App\Providers;

use App\Models\BankHour;
use App\Models\Companie;
use App\Models\Holiday;
use App\Models\RegisterPoint;
use App\Models\Syndicate;
use App\Models\TimeTablesDescription;
use App\Repositories\Contracts\BankHourRepository;
use App\Repositories\Contracts\CompanieRepository;
use App\Repositories\Contracts\HolidayRepository;
use App\Repositories\Contracts\RegisterPointRepository;
use App\Repositories\Contracts\SyndicateRepository;
use App\Repositories\Contracts\TimeTableRepository;
use App\Repositories\EloquentBankHourRepository;
use App\Repositories\EloquentCompanieRepository;
use App\Repositories\EloquentEmployeeRepository;
use App\Repositories\EloquentHolidayRepository;
use App\Repositories\EloquentRegisterPointRepository;
use App\Repositories\EloquentSyndicateRepository;
use App\Repositories\EloquentTimeTableRepository;
use Illuminate\Support\ServiceProvider;

use App\Models\Employee;
use App\Repositories\Contracts\EmployeeRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EmployeeRepository::class, function () {
            return new EloquentEmployeeRepository(new Employee());
        });

        $this->app->bind(BankHourRepository::class, function () {
            return new EloquentBankHourRepository(new BankHour());
        });

        $this->app->bind(CompanieRepository::class, function () {
            return new EloquentCompanieRepository(new Companie());
        });

        $this->app->bind(HolidayRepository::class, function () {
            return new EloquentHolidayRepository(new Holiday());
        });

        $this->app->bind(RegisterPointRepository::class, function () {
            return new EloquentRegisterPointRepository(new RegisterPoint());
        });

        $this->app->bind(TimeTableRepository::class, function () {
            return new EloquentTimeTableRepository(new TimeTablesDescription());
        });

        $this->app->bind(SyndicateRepository::class, function () {
            return new EloquentSyndicateRepository(new Syndicate());
        });

    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            EmployeeRepository::class,
            BankHourRepository::class,
            CompanieRepository::class,
            HolidayRepository::class,
            RegisterPointRepository::class,
            TimeTableRepository::class,
            SyndicateRepository::class,
        ];
    }
}
