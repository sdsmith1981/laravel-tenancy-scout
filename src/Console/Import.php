<?php

namespace GeneaLabs\LaravelTenantScout\Console;

use Hyn\Tenancy\Contracts\Repositories\WebsiteRepository;
use Hyn\Tenancy\Database\Connection;
use Hyn\Tenancy\Traits\AddWebsiteFilterOnCommand;
use Illuminate\Contracts\Events\Dispatcher;
use Laravel\Scout\Console\ImportCommand;

class Import extends ImportCommand
{
    use AddWebsiteFilterOnCommand;

    private $websites;
    private $connection;

    public function __construct()
    {
        parent::__construct();

        $this->setName('tenancy:' . $this->getName());
        $this->specifyParameters();

        $this->websites = app(WebsiteRepository::class);
        $this->connection = app(Connection::class);
    }

    public function handle(Dispatcher $event) : void
    {
        $this->processHandle(function ($website) use ($event) {
            $this->connection->set($website);
            parent::handle($event);
            $this->connection->purge();
        });
    }

    protected function getOptions() : array
    {
        return array_merge(
            [$this->addWebsiteOption()],
            parent::getOptions()
        );
    }
}
