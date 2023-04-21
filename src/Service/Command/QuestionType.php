<?php

namespace Studoo\Service\Command;

use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;

/**
 * Class QuestionType
 * Gestion des questions via console
 *
 * @author Benoit Foujols
 */
class QuestionType extends QuestionHelper
{
    private $input;
    private $output;

    public function __construct(InputInterface $input, OutputInterface $output)
    {
        $this->input = $input;
        $this->output = $output;
    }

    /**
     * Gestion des questions à choix multiple
     *
     * @param string $nameQuestion
     * @param array $choiseQuestion
     * @param string $messageError
     * @param bool $activeMulti
     *
     * @return mixed
     */
    public function Choice(string $nameQuestion, array $choiseQuestion, string $messageError = ' %s is invalid.', bool $activeMulti = false)
    {
        $question = new ChoiceQuestion(
            $nameQuestion,
            $choiseQuestion
        );
        $question->setMultiselect($activeMulti);
        $question->setErrorMessage($messageError);
        $question->setMaxAttempts(5);

        return $this->ask($this->input, $this->output, $question);
    }


}
