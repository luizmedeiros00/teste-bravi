<?php

namespace Tests\Unit;

use App\Utils\ValidateExpression;
use PHPUnit\Framework\TestCase;

class ValidateExpressionTest extends TestCase
{
    /** @test */
    public function should_return_true()
    {
        $valid = ValidateExpression::validate('[{()}](){}');

        $this->assertTrue($valid);
    }

    /** @test */
    public function should_return_false()
    {
        $valid = ValidateExpression::validate('[{)]');

        $this->assertFalse($valid);
    }
}
