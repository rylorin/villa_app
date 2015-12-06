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
 * Class SmallAboutBlockService
 *
 * Renders a block
 *
 */
class SmallContactInfoBlockService extends BaseBlockService
{

    /**
     * {@inheritdoc}
     */
    public function execute(BlockContextInterface $blockContext, Response $response = null)
    {
        return $this->renderResponse($blockContext->getTemplate(), array(
            'block'     => $blockContext->getBlock(),
            'settings'  => $blockContext->getSettings(),
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
                array('address', 'text', array('required' => false)),
                array('phone', 'text', array('required' => false)),
                array('mail', 'text', array('required' => false)),
                array('map', 'text', array('required' => false)),
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
	            ->assertMaxLength(array('limit' => 50))
	        ->end();
    }

    /**
     * {@inheritdoc}
     */
    public function configureSettings(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
        	'title'	   			=> 'Contact Info',
            'template' 			=> 'RylReignThemeBundle:Block:about-sm.html.twig',
        ));
    }
    
}