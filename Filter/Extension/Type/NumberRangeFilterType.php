<?php

namespace Lexik\Bundle\FormFilterBundle\Filter\Extension\Type;

use Lexik\Bundle\FormFilterBundle\Filter\FilterOperands;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Filter type for numbers.
 *
 * @author Cédric Girard <c.girard@lexik.fr>
 */
class NumberRangeFilterType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder->add('left_number', 'filter_number', $options['left_number']);
        $builder->add('right_number', 'filter_number', $options['right_number']);

        $builder->setAttribute('filter_value_keys', array(
            'left_number'  => $options['left_number'],
            'right_number' => $options['right_number']
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        parent::setDefaultOptions($resolver);

        $resolver
            ->setDefaults(array(
                'required'               => false,
                'left_number'            => array('condition_operator' => FilterOperands::OPERATOR_GREATER_THAN_EQUAL),
                'right_number'           => array('condition_operator' => FilterOperands::OPERATOR_LOWER_THAN_EQUAL),
                'data_extraction_method' => 'value_keys',
            ))
            ->setAllowedValues(array(
                'data_extraction_method' => array('value_keys'),
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'filter_number_range';
    }
}
