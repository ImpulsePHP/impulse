<?php

declare(strict_types=1);

return array (
  'generated_at' => '2026-04-09T18:16:28+00:00',
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
  ),
  'down' => 
  array (
  ),
  'summary' => 
  array (
    'created_tables' => 
    array (
      0 => 'users',
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
    ),
    'statement_count' => 1,
  ),
  'name' => '20260409181628_00_schema.php',
);