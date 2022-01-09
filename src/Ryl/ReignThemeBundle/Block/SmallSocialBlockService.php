<?php

namespace Ryl\ReignThemeBundle\Block;

use Sonata\AdminBundle\Form\FormMapper;
use Sonata\CoreBundle\Validator\ErrorElement;
use Sonata\BlockBundle\Block\BaseBlockService;
use Sonata\BlockBundle\Block\BlockContextInterface;
use Sonata\BlockBundle\Model\BlockInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class SmallSocialBlockService
 *
 * Renders a block
 *
 */
class SmallSocialBlockService extends BaseBlockService
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
	            array('facebook', 'text', array('required' => false)),
                array('twitter', 'text', array('required' => false)),
                array('pinterest', 'text', array('required' => false)),
                array('behance', 'text', array('required' => false)),
                array('google', 'text', array('required' => false)),
	        	array('linkedin', 'text', array('required' => false)),
	        )
	    ));
    }

    /**
     * {@inheritdoc}
     */
    /*
    public function validateBlock(ErrorElement $errorElement, BlockInterface $block)
    {
	    $errorElement
	        ->with('settings.title')
	            ->assertNotNull(array())
	            ->assertNotBlank()
	            ->assertMaxLength(array('limit' => 50))
	        ->end();
    }
    */

    /**
     * {@inheritdoc}
     */
    public function configureSettings(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'facebook' 			=> false,
            'twitter' 			=> false,
            'pinterest'			=> false,
            'behance' 			=> false,
            'google'	 		=> false,
            'linkedin' 			=> false,
        	'template' 			=> 'RylReignThemeBundle:Block:social-sm.html.twig',
        ));
    }
    
}