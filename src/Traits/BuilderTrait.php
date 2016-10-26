<?php
/**
 * Created by graphql-query-builder.
 * User: Ruslan Evchev
 * Date: 25.10.16
 * Email: aion.planet.com@gmail.com
 */

namespace QueryBuilder\Traits;

use QueryBuilder\Interfaces\BuilderInterface;
use QueryBuilder\Util;

trait BuilderTrait
{

    protected $name = null;

    protected $arguments;

    protected $body;

    protected $argKeys = [];

    protected $bodyPrototype = [];

    /**
     * @param string $name
     *
     * @return BuilderInterface|BuilderTrait $this
     */
    public function name(string $name)
    {
        if ($this->name === null) {
            $this->name = $name;
        }

        return $this;
    }

    /**
     * @param array $arguments
     *
     * @return BuilderInterface|BuilderTrait $this
     */
    public function arguments(array $arguments)
    {
        if (empty($this->arguments)) {
            $this->processArgumentsNames($arguments);

            $this->arguments = $this->replacePlaceholders(sprintf('(%s)', trim(json_encode($arguments), '{}')));
        }

        return $this;
    }

    /**
     * @param array $body
     *
     * @return BuilderInterface|BuilderTrait $this
     */
    public function body(array $body)
    {
        if (empty($this->body)) {
            $this->bodyPrototype = $body;
            $bodyString          = Util::PARSER_L_BRACE . Util::PARSER_EOL;

            $this->processBody($body, $bodyString);
            $this->body = $bodyString . Util::PARSER_R_BRACE . Util::PARSER_EOL;
        }

        return $this;
    }

    protected function processArgumentsNames(array $arguments)
    {
        foreach ($arguments as $argumentName => $argumentValue) {
            if (is_string($argumentName) && !is_numeric($argumentName)) {
                $this->argKeys[$argumentName] = $argumentName;
            }

            if (is_array($argumentValue)) {
                $this->processArgumentsNames($argumentValue);
            }
        }
    }

    protected function replacePlaceholders($argsString)
    {
        foreach ($this->argKeys as $argKey) {
            $argsString = str_replace(
                sprintf('"%s":', $argKey), sprintf('%s:', $argKey), $argsString
            );
        }

        return $argsString;
    }

    protected function processBody($elements, &$bodyString)
    {
        foreach ($elements as $key => $element) {
            if (is_int($key)) {
                $bodyString .= $element . Util::PARSER_EOL;
            } elseif (is_string($key) && is_array($element)) {
                $bodyString .= $key . Util::PARSER_L_BRACE . Util::PARSER_EOL;
                $this->processBody($element, $bodyString);
                $bodyString .= Util::PARSER_R_BRACE . Util::PARSER_EOL;
            }
        }
    }
}