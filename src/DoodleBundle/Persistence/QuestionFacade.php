<?php

namespace DoodleBundle\Persistence;

use DoodleBundle\Entity\Question;
use DoodleBundle\Repository\QuestionRepository;
use Kisphp\Entity\KisphpEntityInterface;
use Kisphp\Model\AbstractModel;

/**
 * @method QuestionRepository getRepository()
 * @method Question|KisphpEntityInterface find()
 */
class QuestionFacade extends AbstractModel
{
    const REPOSITORY = 'DoodleBundle:Question';

    /**
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getAllQuestions()
    {
        return $this->getRepository()->getAllQuestions();
    }

    /**
     * @param int $id
     *
     * @return Question|null|object
     */
    public function getQuestionByIdOrCreate($id)
    {
        $question = $this->getRepository()->find($id);

        if ( ! $question) {
            $question = $this->createEntity();
        }

        return $question;
    }

    /**
     * @return Question
     */
    public function createEntity()
    {
        return new Question();
    }
}
