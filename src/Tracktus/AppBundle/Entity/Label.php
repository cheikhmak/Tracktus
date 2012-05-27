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
}
