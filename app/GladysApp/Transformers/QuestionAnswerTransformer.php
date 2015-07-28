<?php


namespace App\GladysApp\Transformers;


class QuestionAnswerTransformer extends Transformer {

    public $format = ['question_id', 'answer'];

    public function transform($questionAnswer)
    {
        return [
            'question_id' => $questionAnswer['question_id'],
            'answer' => $questionAnswer['answer'],
            'checked' => (boolean) $questionAnswer['checked']
        ];
    }

}