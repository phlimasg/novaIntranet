<?php

namespace App\Providers;

use App\Model\Utilizacao;
use App\Model\Veiculo;
use App\Observers\CadVeiculosObserver;
use App\Observers\UtilizacaoObserver;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Veiculo::observe(CadVeiculosObserver::class);
        Utilizacao::observe(UtilizacaoObserver::class);
    }
}
