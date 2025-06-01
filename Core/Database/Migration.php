<?php

namespace Core\Database;

use Illuminate\Database\Capsule\Manager as Capsule;

abstract class Migration
{
    protected $schema;

    public function __construct()
    {
        $this->schema = Capsule::schema();
    }

    abstract public function up();
    abstract public function down();
}
