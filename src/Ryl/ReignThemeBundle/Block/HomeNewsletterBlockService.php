<?php

namespace Ryl\ReignThemeBundle\Block;

use Sonata\AdminBundle\Form\FormMapper;
use Sonata\CoreBundle\Validator\ErrorElement;
use Sonata\BlockBundle\Block\BaseBlockService;
use Sonata\BlockBundle\Block\BlockContextInterface;
use Sonata\BlockBundle\Model\BlockInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\Form\FormFactoryInterface;

/**
 * Class SmallSocialBlockService
 *
 * Renders a block
 *
 */
class HomeNewsletterBlockService extends BaseBlockService
{
	/**
	 * @var FormInterface
	 */
	protected $form;
	
    /**
     * Constructor
     *
     * @param string               $name        A block name
     * @param EngineInterface      $templating  Twig engine service
     * @param FormFactoryInterface $formFactory Symfony FormFactory service
     * @param string               $formType    Newsletter form type
     */
    public function __construct($name, EngineInterface $templating, FormFactoryInterface $formFactory, $formType)
    {
        parent::__construct($name, $templating);

        $this->form = $formFactory->create($formType);
    }

	/**
     * {@inheritdoc}
     */
    public function execute(BlockContextInterface $blockContext, Response $response = null)
    {
        return $this->renderResponse($blockContext->getTemplate(), array(
            'block_context'  => $blockContext,
            'block'          => $blockContext->getBlock(),
            'settings'  	 => $blockContext->getSettings(),
            'form'    => $this->form->createView(),
        ), $response);
    }
	
    /**
     * {@inheritdoc}
     */
    public function buildEditForm(FormMapper $formMapper, BlockInterface $block)
    {
        $formMapper->add('settings', 'sonata_type_immutable_array', array(
	        'keys' => array(
	            array('title', 'text', array('required' => true)),
	            array('subtitle', 'text', array('required' => false)),
	            array('note', 'text', array('required' => false)),
	        )
	    ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureSettings(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
        	'title'	   			=> 'Subscribe',
        	'subtitle' 			=> 'to our newsletter',
        	'note'			 	=> '* We will never spam you',
        	'template' 			=> 'RylReignThemeBundle:Block:home_newsletter.html.twig',
        ));
    }
    
}