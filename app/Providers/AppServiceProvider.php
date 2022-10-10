<?php

namespace App\Providers;

use App\Service\MessageServiceInterface;
use App\Service\MessageService;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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
        $this->app->singleton(MessageServiceInterface::class, MessageService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        DB::listen(
            function ($query) {
                $sql = $query->sql;
                if (strlen($sql) <= env('SQL_LOG_LIMIT')) {
                    //プリペアードステイトメントから生SQL
                    foreach ($query->bindings as $binding) {
                        if (is_string($binding)) {
                            $binding = "'{$binding}'";
                        } elseif (is_bool($binding)) {
                            $binding = $binding ? '1' : '0';
                        } elseif (is_int($binding)) {
                            $binding = (string) $binding;
                        } elseif ($binding === null) {
                            $binding = 'NULL';
                        } elseif ($binding instanceof Carbon) {
                            $binding = "'{$binding->toDateTimeString()}'";
                        } elseif ($binding instanceof DateTime) {
                            $binding = "'{$binding->format('Y-m-d H:i:s')}'";
                        }
                        $sql = preg_replace('/\\?/', $binding, $sql, 1);
                    }

                    Log::debug('SQL', ['sql' => $sql, 'time' => "{$query->time} ms"]);
                }
            }
        );
    }
}
