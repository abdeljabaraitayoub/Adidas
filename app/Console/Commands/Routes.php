<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Route as ModelsRoute;
use Illuminate\Support\Facades\Route;

class Routes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'routes:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $routes = Route::getRoutes()->getRoutesByName();

        $routes = array_slice($routes, 4);

        foreach ($routes as $route) {

            $name = $route->getName();
            $methods = $route->methods()[0];
            $uri = $route->uri();
            $actionetcontroller = explode('@', $route->getActionName());
            $controller = $actionetcontroller[0];
            $action = $actionetcontroller[1];

            $ModelsRoute = new ModelsRoute();
            $model = ModelsRoute::all()->where('name', $name);
            if ($model->isEmpty()) {
                $ModelsRoute->name = $name;
                $ModelsRoute->endpoint = $uri;
                $ModelsRoute->method = $methods;
                $ModelsRoute->controller = $controller;
                $ModelsRoute->action = $action;
                $ModelsRoute->save();
            }



            // ::create([
            //     'name' => $name,
            //     'endpoint' => $uri,
            //     'method' => $methods,
            //     'controller' => $controller,
            //     'action' => $action,
            // ]);
        }
        //
    }
}
