<?php

namespace App\Providers;

// use BezhanSalleh\FilamentShield\FilamentShield;
use BezhanSalleh\FilamentShield\Facades\FilamentShield;
use Carbon\CarbonImmutable;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // FilamentShield::prohibitDestructiveCommands($this->app->isProduction());
        Table::configureUsing(function (Table $table): void {
            $table
                ->defaultPaginationPageOption(50)
                ->paginationPageOptions([10, 25, 50, 100]);
        });
        $this->configureDefaults();
    }

    /**
     * Configure default behaviors for production-ready applications.
     */
    protected function configureDefaults(): void
    {
        Date::use(CarbonImmutable::class);

        DB::prohibitDestructiveCommands(
            app()->isProduction(),
        );

        Password::defaults(
            fn (): ?Password => app()->isProduction()
            ? Password::min(12)
                ->mixedCase()
                ->letters()
                ->numbers()
                ->symbols()
                ->uncompromised()
            : null,
        );
    }
}
