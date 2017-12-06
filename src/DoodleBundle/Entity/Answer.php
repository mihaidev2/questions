<?php

namespace DoodleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Kisphp\Entity\KisphpEntityInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="answers", options={"colate": "utf8_general_ci", "charset": "utf8"})
 */
class Answer implements KisphpEntityInterface
{
    const DELIMITER = '-delimiter-';

    /**
	 * @var int
	 *
	 * @ORM\Column(type="integer", options={"unsigned":true})
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", nullable=false, options={"unsigned": true})
     */
	protected $id_question;

	/**
	 * @ORM\ManyToOne(targetEntity="Question", inversedBy="answers", cascade={"persist"})
	 * @ORM\JoinColumn(name="id_question", referencedColumnName="id")
	 */
	protected $question;

	/**
	 * @var string
	 *
	 * @ORM\Column(type="string", length=255)
	 */
	protected $answer;

	/**
	 * @var string
	 *
	 * @ORM\Column(type="string", length=255)
	 */
	protected $name;

    /**
     * @param $id
     */
	public function setId($id)
    {
    	$this->id = $id;
    }

    /**
     * @return int
     */
    public function getId()
    {
    	return $this->id;
    }

    /**
     * @param array $answers
     */
    public function setAnswer(array $answers)
    {
        $answersList = [];
        foreach ($answers as $item) {
            $answersList[] = trim($item);
        }

    	$this->answer = implode(self::DELIMITER, $answersList);
    }

    /**
     * @return array
     */
    public function getAnswer()
    {
    	return explode(self::DELIMITER, $this->answer);
    }

    /**
     * @return int
     */
    public function getIdQuestion(): int
    {
        return $this->id_question;
    }

    /**
     * @return Question
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * @param Question $question
     */
    public function setQuestion(Question $question)
    {
        $this->question = $question;
        $this->id_question = $question->getId();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
}
