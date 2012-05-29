<?php
namespace Tracktus\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Description of Label
 * @ORM\Entity
 * @author pierre
 */
class Label
{
    /**
     * Label id
     * @var int
     * @ORM\Id
     * @ORM\generatedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * Label name
     * @var string
     * @ORM\Column(type="string", length="50")
     */
    private $name;

    public function __construct($name = null)
    {
        $this->name = $name;
    }

    /**
     * Return the id of the label
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the name of the label
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Return the name of the label
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}
