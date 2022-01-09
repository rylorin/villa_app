<?php

namespace Ryl\ReignThemeBundle\Block;

use Sonata\AdminBundle\Form\FormMapper;
use Sonata\CoreBundle\Validator\ErrorElement;
use Sonata\BlockBundle\Block\BlockContextInterface;
use Sonata\BlockBundle\Model\BlockInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Sonata\BlockBundle\Block\BaseBlockService;

/**
 * Class HomeTitleBlockService
 *
 * Renders a block
 *
 */
class HomeTitleBlockService extends BaseBlockService
{

    /**
     * {@inheritdoc}
     */
    public function execute(BlockContextInterface $blockContext, Response $response = null)
    {
        return $this->renderResponse($blockContext->getTemplate(), array(
            'context'	=> $blockContext,
        	'block'   	=> $blockContext->getBlock(),
        	'settings'	=> $blockContext->getSettings(),
        ));
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
    					array('linktitle', 'text', array('required' => false)),
    					array('url', 'text', array('required' => false)),
    			)
    	));
    }
    
    /**
     * {@inheritdoc}
     */
    public function validateBlock(ErrorElement $errorElement, BlockInterface $block)
    {
    	$errorElement
	    	->with('settings.title')
	    	->assertNotNull(array())
	    	->assertNotBlank()
	    	->assertMaxLength(array('limit' => 20))
    	->end();
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureSettings(OptionsResolver $resolver)
    {
    	$resolver->setDefaults(array(
    			'title'	   		=> 'To Begin, Begin',
    			'subtitle'  	=> 'Thats How My Life Rolls',
    			'linktitle'  	=> 'Our Services',
    			'url'  			=> '#services',
    			 
    			'template' 		=> 'RylReignThemeBundle:Block:home_title.html.twig',
    	));
    }
    
}