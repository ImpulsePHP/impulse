<?php

return array (
  'env' => 'dev',
  'debug' => true,
  'logs' => 
  array (
    'enabled' => false,
  ),
  'state_encryption_key' => 'vxyoAR8OTQqq08oVdUAtxkZJZgRdCz1SQWmkN+gvcHs=',
  'template_engine' => 'blade',
  'template_path' => 'views',
  'template_layout' => 'App\\Layout\\Default\\DefaultLayout',
  'middlewares' => 
  array (
  ),
  'providers' => 
  array (
    0 => 'Impulse\\Db\\DbProvider',
    1 => 'Impulse\\Translation\\TranslatorProvider',
    3 => 'Impulse\\UI\\UIProvider',
    4 => 'Impulse\\Validator\\ValidatorProvider',
    5 => 'Impulse\\Story\\StoryProvider',
    6 => 'Impulse\\Auth\\AuthProvider',
  ),
  'locale' => 'fr',
  'cache' => 
  array (
    'enabled' => false,
    'ttl' => 600,
  ),
  'component_namespaces' => 
  array (
    0 => 'App\\Component\\',
    1 => 'Impulse\\UI\\Component\\',
    2 => 'Impulse\\Story\\Component\\',
    3 => 'Impulse\\Story\\Layout\\',
    4 => 'Impulse\\Story\\Page\\',
    5 => 'App\\Page\\',
    6 => 'App\\Layout\\',
  ),
  'css' => 
  array (
    0 => 
    array (
      'path' => '/../public/css/ui.css',
      'base' => '/Users/guillaume/Sites/ImpulsePHP/project_test/vendor/impulsephp/ui/src',
      'inline' => true,
    ),
    1 => 
    array (
      'path' => '/../public/css/ui.css',
      'base' => '/Users/guillaume/Sites/ImpulsePHP/ui/src',
      'inline' => true,
    ),
  ),
  'story' => 
  array (
    'paths' => 
    array (
      0 => 'vendor/impulsephp/ui/src/Story',
    ),
  ),
  'database' => 
  array (
    'name' => 'project',
    'driver' => 'sqlite',
    'database' => '/Users/guillaume/Sites/ImpulsePHP/project_test/var/storage/project.sqlite',
  ),
  'auth' => 
  array (
    'entity' => 'App\\Entity\\User',
    'identifier_field' => 'email',
    'password_field' => 'password',
    'id_field' => 'id',
  ),
);
