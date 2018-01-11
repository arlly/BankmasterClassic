<?php
/**
 * Created by PhpStorm.
 * User: arlly
 * Date: 2018/01/11
 * Time: 18:01
 */
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class LivewellType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('field', TextType::class, ['label' => 'フィールド'])
            ->add('size', TextType::class, ['label' => 'サイズ'])
            ->add('photo1', FileType::class, ['label' => '写真1'])
            ->add('photo2', FileType::class, ['label' => '写真2'])
            ->add('photo3', FileType::class, ['label' => '写真3'])
            ->add('send', SubmitType::class, ['label' => '送信する']);
    }
}