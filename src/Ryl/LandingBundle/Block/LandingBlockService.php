<?php

namespace Ryl\LandingBundle\Block;

use Sonata\AdminBundle\Form\FormMapper;
use Sonata\CoreBundle\Validator\ErrorElement;
use Sonata\BlockBundle\Block\BaseBlockService;
use Sonata\BlockBundle\Block\BlockContextInterface;
use Sonata\BlockBundle\Model\BlockInterface;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Security\Core\SecurityContextInterface;

/**
 * Class LandingBlockService
 *
 * Renders a landing page item
 *
 */
class LandingBlockService extends BaseBlockService
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
    /*
    public function __construct($name, EngineInterface $templating, FormFactoryInterface $formFactory, $formType)
    {
        parent::__construct($name, $templating);

        $this->form = $formFactory->create($formType);
    }
    */

    /**
     * {@inheritdoc}
     */
    public function execute(BlockContextInterface $blockContext, Response $response = null)
    {
        return $this->renderPrivateResponse($blockContext->getTemplate(), array(
            'block'   => $blockContext->getBlock(),
            'context' => $blockContext,
//            'form'    => $this->form->createView(),
        	'settings'=> $blockContext->getSettings(),
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function buildEditForm(FormMapper $form, BlockInterface $block)
    {
	    $form->add('settings', 'sonata_type_immutable_array', array(
	        'keys' => array(
	            array('url', 'url', array('required' => false)),
	            array('title', 'text', array('required' => false)),
	        )
	    ));
    }

    /**
     * {@inheritdoc}
     */
    public function validateBlock(ErrorElement $errorElement, BlockInterface $block)
    {
	    $errorElement
	        ->with('settings.url')
	            ->assertNotNull(array())
	            ->assertNotBlank()
	        ->end()
	        ->with('settings.title')
	            ->assertNotNull(array())
	            ->assertNotBlank()
	            ->assertMaxLength(array('limit' => 50))
	        ->end();
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultSettings(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'template' => 'RylLandingBundle:Block:landitem.html.twig',
            'ttl'      => 0
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'Landing item Block';
    }
}