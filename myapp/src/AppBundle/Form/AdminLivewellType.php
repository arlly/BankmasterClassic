<?php
/**
 * Created by PhpStorm.
 * User: arlly
 * Date: 2018/01/11
 * Time: 18:01
 */

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdminLivewellType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('size', TextType::class, ['label' => 'サイズ'])
            ->add('approval', ChoiceType::class, ['label' => '承認', 'choices' => [
                '未承認' => 0,
                '承認' => 1
            ]])
            ->add('send', SubmitType::class, ['label' => '送信する']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'validation_groups' => [
                'admin'
            ]
        ]);
    }
}