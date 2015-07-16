<?php
/**
 * Created by PhpStorm.
 * User: abdou
 * Date: 7/14/15
 * Time: 10:47 AM
 */

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType  extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add(
                'title',
                "text",
                array('label' => 'Title')
            )
            ->add(
                'content',
                "textarea",
                array(
                    'label' => 'Content',
                    'attr'  => array('style' => 'width:400px;height:200px')
                )
            )
            ->add(
                'category',
                "entity",
                array(
                    'class' => 'AppBundle:Category',
                    'property' => 'name',
                )
            );



    }
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'AppBundle\Entity\Article',
            )
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'post_action';
    }

}