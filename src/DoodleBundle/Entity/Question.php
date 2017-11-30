<?php

namespace DoodleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="questions", options={"colate": "utf8_general_ci", "charset": "utf8"})
 */
class Question
{
	/**
     * @var int
     *
     * @ORM\Column(type="integer", options={"unsigned": true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

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
     * @return array
     */
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
}
