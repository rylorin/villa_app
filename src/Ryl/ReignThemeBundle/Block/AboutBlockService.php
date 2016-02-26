<?php

namespace Ryl\ReignThemeBundle\Block;

use Sonata\AdminBundle\Form\FormMapper;
use Sonata\CoreBundle\Validator\ErrorElement;
use Sonata\BlockBundle\Block\BlockContextInterface;
use Sonata\BlockBundle\Model\BlockInterface;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Sonata\MediaBundle\Block\MediaBlockService;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Sonata\CoreBundle\Model\ManagerInterface;

/**
 * Class AboutBlockService
 *
 * Renders a block
 *
 */
class AboutBlockService extends MediaBlockService
{

    /**
     * Constructor
     *
     * @param string               $name        A block name
     * @param EngineInterface      $templating  Twig engine service
     * @param ContainerInterface 
     * @param ManagerInterface               
     */
    public function __construct($name, EngineInterface $templating, ContainerInterface $container, ManagerInterface $mediaManager)
    {
        parent::__construct($name, $templating, $container, $mediaManager);
    }

    /**
     * {@inheritdoc}
     */
    public function execute(BlockContextInterface $blockContext, Response $response = null)
    {
    	parent::execute($blockContext);
    	
        return $this->renderPrivateResponse($blockContext->getTemplate(), array(
            'context' => $blockContext,
        	'block'   	=> $blockContext->getBlock(),
        	'settings'	=> $blockContext->getSettings(),
            'media'     => $blockContext->getSetting('mediaId'),
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function buildEditForm(FormMapper $formMapper, BlockInterface $block)
    {
        parent::buildEditForm($formMapper, $block);
    	
        $formatChoices = $this->getFormatChoices($block->getSetting('mediaId'));
        $formMapper->add('settings', 'sonata_type_immutable_array', array(
	        'keys' => array(
	            array('title', 'text', array('required' => true)),
	            array('subtitle', 'text', array('required' => false)),
	            array('subtitleleft', 'text', array('required' => false)),
	            array('textleft', 'textarea', array('required' => false)),
	        	array('subtitleright', 'text', array('required' => false)),
	        	array('textright', 'textarea', array('required' => false)),
                array($this->getMediaBuilder($formMapper), null, array()),
                array('format', 'choice', array('required' => count($formatChoices) > 0, 'choices' => $formatChoices)),
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
        	'title'	   			=> false,
        	'subtitle' 			=> false,
        	'subtitleleft'	 	=> false,
        	'textleft'			=> false,
        	'subtitleright'		=> false,
        	'textright' 		=> false,
        	'image'				=> false,
            'media'    			=> false,
            'context'  			=> false,
            'mediaId'  			=> null,
            'format'   			=> false,
        	'template'			=> 'RylReignThemeBundle:Block:about.html.twig',
        ));
    }

}