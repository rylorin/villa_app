<?php

namespace Ryl\ReignThemeBundle\Block;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Sonata\NewsBundle\Block\RecentCommentsBlockService;

/**
 * Class BottomRecentCommentsBlockService
 *
 * Renders a block
 *
 */
class BottomRecentCommentsBlockService extends RecentCommentsBlockService
{
		
	/**
     * {@inheritdoc}
     */
    public function configureSettings(OptionsResolver $resolver)
    {
        parent::configureSettings($resolver);
    	$resolver->setDefault('template', 'RylReignThemeBundle:Block:comments_bottom.html.twig');
    }

}
