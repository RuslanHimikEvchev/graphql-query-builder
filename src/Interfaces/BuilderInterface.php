<?php
/**
 * Created by graphql-query-builder.
 * User: Ruslan Evchev
 * Date: 25.10.16
 * Email: aion.planet.com@gmail.com
 */

namespace QueryBuilder\Interfaces;

interface BuilderInterface
{

    public function name(string $name);

    public function arguments(array $arguments);

    public function body(array $body);

    public function build() : string;
}