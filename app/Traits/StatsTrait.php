<?php

namespace App\Traits;

trait StatsTrait
{
    public function countScoreQuestion(string $p): int
    {
        return \App\Models\Score::where('question', $p)->count();
    }

}
