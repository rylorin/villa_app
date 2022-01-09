<?php

namespace Ryl\ReignThemeBundle\Block;

use Sonata\AdminBundle\Form\FormMapper;
use Sonata\CoreBundle\Validator\ErrorElement;
use Sonata\BlockBundle\Block\BaseBlockService;
use Sonata\BlockBundle\Block\BlockContextInterface;
use Sonata\BlockBundle\Model\BlockInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class CopyrightBlockService
 *
 * Renders a block
 *
 */
class CopyrightBlockService extends BaseBlockService
{

    /**
     * {@inheritdoc}
     */
    public function execute(BlockContextInterface $blockContext, Response $response = null)
    {
        return $this->renderResponse($blockContext->getTemplate(), array(
            'block_context'  => $blockContext,
            'block'          => $blockContext->getBlock(),
            'settings'  	 => $blockContext->getSettings(),
        ), $response);
    }
	
    /**
     * {@inheritdoc}
     */
    public function buildEditForm(FormMapper $formMapper, BlockInterface $block)
    {
        $formMapper->add('settings', 'sonata_type_immutable_array', array(
	        'keys' => array(
	            array('year', 'text', array('required' => false)),
                array('author', 'text', array('required' => false)),
	        )
	    ));
    }

    /**
     * {@inheritdoc}
     */
    public function validateBlock(ErrorElement $errorElement, BlockInterface $block)
    {
	    $errorElement
	        ->with('settings.author')
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
        	'enabled'			=> true,
        	'year'	   			=> false,
        	'author'  			=> false,
            'template' 			=> 'RylReignThemeBundle:Block:copyright.html.twig',
        ));
    }
    
}