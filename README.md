# 📈 Laravel Zabbix Graph

Get a graph from Zabbix to display on a webpage or to save to a file. If you are not using Laravel, then please check out [this repository](https://github.com/casperboone/zabbix-graph). 

## Original Package
https://github.com/casperboone/laravel-zabbix-graph

## Installation
You can install the package via composer:

```bash
composer require alexdeoliveira/laravel-zabbix-graph
```

You must install the service provider:
```php
// config/app.php
'providers' => [
    ...
    Alexdeoliveira\LaravelZabbixGraph\ZabbixGraphServiceProvider::class,
],
```

If you want to, you can also add the facade:
```php
// config/app.php
'aliases' => [
    ...
    'ZabbixGraph' => Alexdeoliveira\LaravelZabbixGraph\ZabbixGraphFacade::class,
],
```
You can publish the config file with (the [default config file](https://github.com/alexdeoliveira/laravel-zabbix-graph/blob/master/config/zabbixgraph.php) will suffice in most cases):
```
php artisan vendor:publish --provider="Alexdeoliveira\LaravelZabbixGraph\ZabbixGraphServiceProvider"
```
Make sure to update the config file or your .env file with the details of your Zabbix server.

## Usage
Output a Zabbix graph to an HTTP endpoint (using method injection):
```php
<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Alexdeoliveira\ZabbixGraph\ZabbixGraph;

class GraphsController extends Controller
{
    public function show(Request $request, ZabbixGraph $zabbixGraph, $id)
    {
        $graph = $zabbixGraph->startTime(Carbon::now()->subDay())
            ->width($request->input('width', 1000))
            ->height($request->input('height', 200))
            ->find($id);

        return response($graph)
            ->header('Content-Type', 'image/png');
    }
}
```

You can also use the facade, if you prefer:
```php
<?php

namespace App\Http\Controllers;

use ZabbixGraph;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GraphsController extends Controller
{
    public function show(Request $request, $id)
    {
        $graph = ZabbixGraph::startTime(Carbon::now()->subDay())
            ->width($request->input('width', 1000))
            ->height($request->input('height', 200))
            ->find($id);

        return response($graph)
            ->header('Content-Type', 'image/png');
    }
}
```

For all available methods and options, see [casperboone/zabbix-graph](https://github.com/casperboone/zabbix-graph).