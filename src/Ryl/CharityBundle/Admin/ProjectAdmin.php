<?php

namespace Ryl\CharityBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class ProjectAdmin extends Admin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
        	->add('title')
            ->add('abstract')
            ->add('enabled')
            ->add('content', null, array('safe' => true))
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
        	->add('title')
            ->add('enabled')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('General', array(
                    'class' => 'col-md-8'
                ))
        		->add('sponsor', 'sonata_type_model')
                ->add('title')
            	->add('abstract')
                ->add('content', 'sonata_formatter_type', array(
                    'event_dispatcher' => $formMapper->getFormBuilder()->getEventDispatcher(),
                    'format_field'   => 'contentFormatter',
                    'source_field'   => 'rawContent',
                    'source_field_options'      => array(
                        'horizontal_input_wrapper_class' => $this->getConfigurationPool()->getOption('form_type') == 'horizontal' ? 'col-lg-12': '',
                        'attr' => array('class' => $this->getConfigurationPool()->getOption('form_type') == 'horizontal' ? 'span10 col-sm-10 col-md-10': '', 'rows' => 20)
                    ),
                    'ckeditor_context'     => 'news',
                    'target_field'   => 'content',
                    'listener'       => true,
                ))
            ->end()
            ->with('Options', array(
                        'class' => 'col-md-4'
                 ))
                 ->add('enabled')
            ->end()
            ->with('Media', array(
                        'class' => 'col-md-8'
                 ))
/*            ->add('image', 'sonata_type_model_list', array('required' => false), array(
                        'link_parameters' => array(
                            'context' => 'sponsor'
                        )
                )) */
            	->add('image', 'sonata_media_type', array(
            		'provider' => 'sonata.media.provider.image',
            		'context'  => 'project'
            	))
			->end();
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('sponsor')
        	->add('title')
            ->add('abstract')
            ->add('enabled')
            ->add('id')
        ;
    }
}
