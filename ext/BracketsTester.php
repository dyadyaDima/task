<?php

namespace ext;

    /**
     *
     * Class BracketsTester
     *
     * Useful for testing matching brackets in arithmetic expressions
     */
    class BracketsTester
    {
        /**
         * Regular expression for brackets
         */
        const BRACKETS_REGEXP = '/(\(|\[|\{|\)|\]|\})/';

        /**
         * Regular expression for search correlation of brackets
         */
        const BRACKETS_CORRELATION_REGEXP = '/(\(\))|(\[\])|(\{\})/';

        /**
         * @var array contain all matches for brackets
         */
        protected $bracketsMatches = [];

        /**
         * @var array contain all correlations for brackets
         */
        protected $correlationOfBrackets = [
            '()',
            '[]',
            '{}'
        ];

        /**
         * BracketsTester constructor.
         *
         * @param $arithmeticExpressions string that contain brackets
         *
         * @throws \Exception if brackets not found
         */
        public function __construct($arithmeticExpressions)
        {
            $this->bracketsMatches = $this->parseExpression($arithmeticExpressions);

            if (empty($this->bracketsMatches))
                throw new \Exception('Entered string doesn\'t contain any brackets');
        }

        /**
         * @return bool true if arithmetic expressions is correct
         */
        public function runTest()
        {
            if (count($this->bracketsMatches) % 2 !== 0)
                return false; //if there are not even number of brackets arithmetic expressions is wrong

            $result = $this->testBracketsString(implode('', $this->bracketsMatches));

            return $result == ''; // if returned string empty - arithmetic expressions correct
        }

        /**
         * @param $bracketsString string string that contain only brackets
         *
         * @return string replaced string where removed all correlation of brackets
         */
        protected function testBracketsString($bracketsString)
        {
            $bracketsString = str_replace($this->correlationOfBrackets, '', $bracketsString);

            // check if there are correlations of brackets replace string one more time
            if (preg_match(self::BRACKETS_CORRELATION_REGEXP, $bracketsString)) {
                $bracketsString = $this->testBracketsString($bracketsString);
            }

            return $bracketsString;

        }

        /**
         * @param $arithmeticExpression string arithmetic expression
         *
         * @return array
         */
        protected function parseExpression($arithmeticExpression){
            $matches = [];

            preg_match_all(self::BRACKETS_REGEXP, $arithmeticExpression, $matches);

            return !empty($matches) ? current($matches) : $matches;
        }
    }
