<?php

namespace DoodleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Kisphp\Entity\KisphpEntityInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="questions", options={"colate": "utf8_general_ci", "charset": "utf8"})
 * @ORM\Entity(repositoryClass="DoodleBundle\Repository\QuestionRepository")
 */
class Question implements KisphpEntityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 1;
    const STATUS_ACTIVE = 2;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", options={"unsigned": true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", options={"unsigned": true, "default": DoodleBundle\Entity\Question::STATUS_ACTIVE})
     */
    protected $status = self::STATUS_ACTIVE;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    protected $title;

	/**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    protected $variants;

    /**
     * @ORM\OneToMany(targetEntity="Answer", mappedBy="question")
     */
    protected $answers;

    public function getAnswers() 
    {
        return $this->answers;
    }

    public function getVariantsList()
    {
        return explode("\n", $this->getVariants());
    }

    public function setId($id)
    {
    	$this->id = $id;
    }

    public function getId()
    {
    	return $this->id;
    }

    public function setTitle($title)
    {
    	$this->title = $title;
    }

    public function getTitle()
    {
    	return $this->title;
    }

    public function setVariants($variants)
    {
    	$this->variants = $variants;
    }

    public function getVariants()
    {
    	return $this->variants;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus(int $status)
    {
        $this->status = $status;
    }
}
