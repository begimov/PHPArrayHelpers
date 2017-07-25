<?php

require 'vendor/autoload.php';

$arr = [
  'first' => 'first',
  'second' => 'second',
  'third' => [
    'first' => 'third.first',
    'second' => 'third.second',
  ],
  'fourth' => [
    'first' => 'fourth.first',
    [
      'first' => 'fourth.0.first',
      'second' => 'fourth.0.second',
      ['fourth.0.0.0']
    ],
    'second' => [
      'first' => 'fourth.second.first',
      'second' => 'fourth.second.second',
    ]
  ],
  'fifth' => [],
  'sixth' => null
];

var_dump(array_get($arr, 'fourth.second'));
