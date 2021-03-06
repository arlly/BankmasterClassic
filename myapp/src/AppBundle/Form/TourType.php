<?php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class TourType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, ['label' => 'ツアー名'])
            ->add('startDate', DateType::class, ['label' => '開始日', 'widget' => 'single_text'])
            ->add('endDate', DateType::class, ['label' => '終了日', 'widget' => 'single_text'])
            ->add('send', SubmitType::class, ['label' => '登録する']);
    }
}