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
 * Class PictureBlockService
 *
 * Renders a picture block
 *
 */
class PictureBlockService extends MediaBlockService
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
     *
     * {@inheritdoc}
     */
    public function execute(BlockContextInterface $blockContext, Response $response = null)
    {
        parent::execute($blockContext);
        
        return $this->renderPrivateResponse($blockContext->getTemplate(), array(
            'context' => $blockContext,
            'block' => $blockContext->getBlock(),
            'settings' => $blockContext->getSettings(),
            'media' => $blockContext->getSetting('mediaId')
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
	            array('title', 'text', array('required' => false)),
                array($this->getMediaBuilder($formMapper), null, array()),
                array('format', 'choice', array('required' => count($formatChoices) > 0, 'choices' => $formatChoices)),
	        )
	    ));
    }

    /**
     * {@inheritdoc}
     
    public function validateBlock(ErrorElement $errorElement, BlockInterface $block)
    {
	    $errorElement
	        ->with('settings.title')
	            ->assertNotNull(array())
	            ->assertNotBlank()
	            ->assertMaxLength(array('limit' => 250))
	        ->end();
    }*/

    /**
     * {@inheritdoc}
     */
    public function configureSettings(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
         	'title'	   			=> false,
          	'image'				=> false,
            'media'    			=> false,
            'context'  			=> false,
            'mediaId'  			=> null,
            'format'   			=> false,
         	'template'			=> 'RylReignThemeBundle:Block:picture.html.twig',
        ));
    }

}