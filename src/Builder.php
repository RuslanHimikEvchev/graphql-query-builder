<?php
/**
 * Created by graphql-query-builder.
 * User: Ruslan Evchev
 * Date: 25.10.16
 * Email: aion.planet.com@gmail.com
 */

namespace QueryBuilder;

use QueryBuilder\Mutation\MutationBuilder;
use QueryBuilder\Query\QueryBuilder;

class Builder
{
    public static function createQueryBuilder()
    {
        return new QueryBuilder();
    }

    public static function createMutationBuilder()
    {
        return new MutationBuilder();
    }
}