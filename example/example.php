<?php
/**
 * Created by graphql-query-builder.
 * User: Ruslan Evchev
 * Date: 23.11.16
 * Email: aion.planet.com@gmail.com
 */

require_once '../vendor/autoload.php';

$builder = \QueryBuilder\Builder::createQueryBuilder();

$readyQuery = $builder
    ->name('myQueryNameInGraphQl')
    ->arguments([
        'firstArg' => 'foo',
        'secondListArgs' => [
            [
                'foo' => 'bar',
                'bar' => 'baz'
            ],
            [
                'foo' => 'bar2',
                'bar' => 'baz2'
            ]
        ],
        'myEnumArg' => 'MY_ENUM_VALUE'
    ])
    ->body([
        'someOneFiled',
        'someListFields' => [
            'subFieldWithList' => [
                'foo',
                'bar'
            ]
        ],
        'baz'
    ])
    ->build();

echo $readyQuery;

//query {
//  myQueryNameInGraphQl(
//      firstArg:"foo",
//      secondListArgs:[
//          {foo:"bar",bar:"baz"},
//          {foo:"bar2",bar:"baz2"}
//      ],
//      myEnumArg:"MY_ENUM_VALUE"
//      ){
//      someOneFiled
//      someListFields{
//          subFieldWithList{
//              foo
//              bar
//          }
//      }
//      baz
//     }
//  }