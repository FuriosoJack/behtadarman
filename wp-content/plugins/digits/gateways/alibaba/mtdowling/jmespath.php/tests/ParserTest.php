<?php
namespace JmesPath\Tests;

use JmesPath\Lexer;
use JmesPath\Parser;
use JmesPath\SyntaxErrorException;
use PHPUnit_Framework_TestCase;

/**
 * @covers JmesPath\Parser
 */
class ParserTest extends PHPUnit_Framework_TestCase
{
    /**
     * @expectedException SyntaxErrorException
     * @expectedExceptionMessage Syntax error at character 0
     */
    public function testMatchesFirstTokens()
    {
        $p = new Parser(new Lexer());
        $p->parse('.bar');
    }

    /**
     * @expectedException SyntaxErrorException
     * @expectedExceptionMessage Syntax error at character 1
     */
    public function testThrowsSyntaxErrorForInvalidSequence()
    {
        $p = new Parser(new Lexer());
        $p->parse('a,');
    }

    /**
     * @expectedException SyntaxErrorException
     * @expectedExceptionMessage Syntax error at character 2
     */
    public function testMatchesAfterFirstToken()
    {
        $p = new Parser(new Lexer());
        $p->parse('a.,');
    }

    /**
     * @expectedException SyntaxErrorException
     * @expectedExceptionMessage Unexpected "eof" token
     */
    public function testHandlesEmptyExpressions()
    {
        (new Parser(new Lexer()))->parse('');
    }
}
