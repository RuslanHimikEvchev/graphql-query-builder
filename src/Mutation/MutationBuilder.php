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

    public function build()
    {
        return sprintf('mutation {%s}', $this->name . $this->arguments . $this->body);
    }

    /**
     * @param array $arguments
     *
     * @return MutationBuilder $this
     */
    public function arguments(array $arguments)
    {
        if (empty($this->arguments)) {
            $this->processArgumentsNames($arguments);

            $this->arguments = $this->replacePlaceholders(sprintf('(input:{%s})', substr(json_encode($arguments, JSON_UNESCAPED_SLASHES), 1, strlen(json_encode($arguments, JSON_UNESCAPED_SLASHES)) - 2)));
        }

        $this->processEnums();

        return $this;
    }

}