<?php

namespace Tracktus\AppBundle\Tests\Entity;

use Tracktus\AppBundle\Entity\Label;

class LabelTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var Label
     */
    private $label;

    public function setUp()
    {
        $this->label = new Label('security');
    }

    public function testName()
    {
        $this->assertEquals('security', $this->label->getName());
        $this->label->setName('design');
        $this->assertEquals('design', $this->label->getName());
    }

    public function testGetId()
    {
        $this->assertEquals(null, $this->label->getId());
    }
}
