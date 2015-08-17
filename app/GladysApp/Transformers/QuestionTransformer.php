<?php


namespace App\GladysApp\Transformers;


class QuestionTransformer extends Transformer{

    public $format = ['fact_id', 'question_title', 'question_type'];

    public function transform($question)
    {
        return [
            'question_id' => $question['id'],
            'fact_id' => $question['fact_id'],
            'question_title' => $question['question_title'],
            'question_type' => $question['question_type']
        ];
    }

}