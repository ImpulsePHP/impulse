<?php

declare(strict_types=1);

return array (
  'generated_at' => '2026-04-10T19:14:15+00:00',
  'up' => 
  array (
    0 => 'CREATE TABLE "users" (
    "id" integer NOT NULL,
    "email" text (255) NOT NULL,
    "password" text (255) NOT NULL,
    "roles" text NOT NULL,
    "created_at" datetime NOT NULL,
    "updated_at" datetime NOT NULL,
    PRIMARY KEY ("id")
);',
    1 => 'CREATE TABLE "vehicles" (
    "id" integer NOT NULL,
    "user_id" integer NOT NULL,
    "brand" text (255) NOT NULL,
    "model" text (255) NOT NULL,
    "trim" text (255) NULL,
    "registration_plate" text (255) NOT NULL,
    "acquired_at" datetime NOT NULL,
    "purchase_condition" text (255) NOT NULL,
    "powertrain" text (255) NOT NULL,
    "year" integer NULL,
    "odometer_km" integer NOT NULL,
    "battery_capacity_kwh" real NULL,
    "average_consumption_kwh" real NULL,
    "range_km" integer NULL,
    "next_service_at" datetime NULL,
    "is_active" integer NOT NULL,
    "created_at" datetime NOT NULL,
    "updated_at" datetime NOT NULL,
    PRIMARY KEY ("id")
);',
  ),
  'down' => 
  array (
  ),
  'summary' => 
  array (
    'created_tables' => 
    array (
      0 => 'users',
      1 => 'vehicles',
    ),
    'updated_tables' => 
    array (
    ),
    'dropped_tables' => 
    array (
    ),
    'changes' => 
    array (
      0 => 
      array (
        'table' => 'users',
        'action' => 'create_table',
      ),
      1 => 
      array (
        'table' => 'vehicles',
        'action' => 'create_table',
      ),
    ),
    'statement_count' => 2,
  ),
  'name' => '20260410191415_00_schema.php',
);