<?php
/**
 * Created by graphql-query-builder.
 * User: Ruslan Evchev
 * Date: 25.10.16
 * Email: aion.planet.com@gmail.com
 */

namespace QueryBuilder\Query;

use QueryBuilder\Interfaces\BuilderInterface;
use QueryBuilder\Traits\BuilderTrait;

class QueryBuilder implements BuilderInterface
{

    use BuilderTrait;

    public function build()
    {
        return sprintf('query {%s}', $this->name . $this->arguments . $this->body);
    }

}