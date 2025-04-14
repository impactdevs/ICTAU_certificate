<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Mail\MailManager;
use App\Mail\Transport\InfobipTransport;


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
        Relation::enforceMorphMap([
            'MembershipType' => \App\Models\Membership_Type::class,
        ]);

        $this->app->make(MailManager::class)->extend('infobip', function () {
            $config = config('services.infobip');
            return new InfobipTransport(
                $config['base_url'],
                $config['api_key'],
                $config['email_from'],
                $config['name'],
            );
        });
    }
}
