<?php
/**
 * Created by graphql-query-builder.
 * User: Ruslan Evchev
 * Date: 25.10.16
 * Email: aion.planet.com@gmail.com
 */

namespace QueryBuilder\Mutation;

use QueryBuilder\Interfaces\BuilderInterface;
use QueryBuilder\Traits\BuilderTrait;

class MutationBuilder implements BuilderInterface
{
    use BuilderTrait;

    public function build() : string
    {
        return sprintf('mutation {%s}', $this->name . $this->arguments . $this->body);
    }

}