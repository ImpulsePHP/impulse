<?php

declare(strict_types=1);

return array (
  'generated_at' => '2026-04-08T15:37:21+00:00',
  'up' => 
  array (
    0 => 'CREATE TABLE "spiral_temp_users_69d676315aa0f" (
    "id" integer NOT NULL,
    "email" text (255) NOT NULL,
    "password" text (255) NOT NULL,
    "roles" text NOT NULL,
    "created_at" datetime NOT NULL,
    "updated_at" datetime NOT NULL,
    PRIMARY KEY ("id")
);',
    1 => 'INSERT INTO "spiral_temp_users_69d676315aa0f" ("id", "email", "password", "created_at", "updated_at") SELECT "id", "email", "password", "created_at", "updated_at" FROM "users";',
    2 => 'DROP TABLE "users";',
    3 => 'ALTER TABLE "spiral_temp_users_69d676315aa0f" RENAME TO "users";',
  ),
  'down' => 
  array (
  ),
  'summary' => 
  array (
    'created_tables' => 
    array (
    ),
    'updated_tables' => 
    array (
      0 => 'users',
    ),
    'dropped_tables' => 
    array (
    ),
    'changes' => 
    array (
      0 => 
      array (
        'table' => 'users',
        'action' => 'alter_table',
        'added_columns' => 
        array (
          0 => 'roles',
        ),
        'dropped_columns' => 
        array (
        ),
        'altered_columns' => 
        array (
        ),
      ),
    ),
    'statement_count' => 4,
  ),
  'name' => '20260408133718_00_schema.php',
);