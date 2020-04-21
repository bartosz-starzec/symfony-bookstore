<?php
namespace App\Form\Type;

use App\Entity\Author;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class FIlterByAuthorType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('author', EntityType::class, [
                'class' => Author::class,
                'choice_label' => 'getName'
            ])
            ->add('save', SubmitType::class);
    }
}
