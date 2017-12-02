<?php

namespace Tests\AppBundle\Entity;

use DoodleBundle\Entity\Answer;
use PHPUnit\Framework\TestCase;

class AnswerTest extends TestCase
{
    public function test_setAnswers_list()
    {
        $answer = new Answer();

        $data = [
            "alfa\n",
            "beta\n",
            "\ngama\n",
        ];

        $answer->setAnswer($data);

        self::assertSame('alfa-delimiter-beta-delimiter-gama', implode('-delimiter-', $answer->getAnswer()));
    }
}
