<?php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use AppBundle\Entity\Tour;

class TournamentType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class, [
            'label' => 'トーナメント名'
        ])
            ->add('startDate', DateType::class, [
            'label' => '開始日',
            'widget' => 'single_text'
        ])
            ->add('endDate', DateType::class, [
            'label' => '終了日',
            'widget' => 'single_text'
        ])
            ->add('tour', EntityType::class, [
            'class' => Tour::class
        ])
            ->
        add('send', SubmitType::class, [
            'label' => '登録する'
        ]);
    }
}