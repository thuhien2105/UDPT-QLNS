<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use Illuminate\Support\Facades\Log;
use App\Services\RegisterService;
use App\Services\LoginService;
use App\Services\LogoutService;

class RabbitMQServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(RegisterService::class, function ($app) {
            return new RegisterService();
        });

        $this->app->singleton(LoginService::class, function ($app) {
            return new LoginService();
        });

        $this->app->singleton(LogoutService::class, function ($app) {
            return new LogoutService();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->startRabbitMQListener();
    }

    /**
     * Start the RabbitMQ listener.
     *
     * @return void
     */
    protected function startRabbitMQListener()
    {
        $connection = new AMQPStreamConnection(
            env('RABBITMQ_HOST', '127.0.0.1'),
            env('RABBITMQ_PORT', 5672),
            env('RABBITMQ_USER', 'guest'),
            env('RABBITMQ_PASSWORD', 'guest')
        );

        $channel = $connection->channel();
        $channel->queue_declare('topic-auth', false, true, false, false);

        $callback = function (AMQPMessage $msg) {
            $data = json_decode($msg->body, true);
            $action = $data['action'] ?? null;

            switch ($action) {
                case 'register':
                    app(RegisterService::class)->handle($data);
                    break;

                case 'login':
                    $result = app(LoginService::class)->handle($data);
                    if ($result) {
                        Log::info('Login successful: ', $result);
                    } else {
                        Log::warning('Login failed: ', $data);
                    }
                    break;

                case 'logout':
                    $result = app(LogoutService::class)->handle($data);
                    if ($result) {
                        Log::info('Logout successful: ', $result);
                    } else {
                        Log::warning('Logout failed: ', $data);
                    }
                    break;

                default:
                    Log::warning('Unknown action: ' . $action);
                    break;
            }
        };

        $channel->basic_consume('topic-auth', '', false, true, false, false, $callback);

        while ($channel->callbacks) {
            $channel->wait();
        }

        $channel->close();
        $connection->close();
    }
}
