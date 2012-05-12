<?php

namespace Tracktus\AppBundle\Form\Type;

use Tracktus\AppBundle\Entity\Project;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ProjectFormType extends AbstractType {
    
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('name', 'text');
        $builder->add('description', 'textarea');
    }

    public function getName() 
    {
        return 'ProjectForm';
    }

}