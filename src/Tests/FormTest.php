<?php

namespace tests;

use App\Form;
use PHPUnit\Framework\TestCase;

class FormTest extends TestCase
{
    public function testForm()
    {
        $this->assertIsString(Form::generate());
    }
}
