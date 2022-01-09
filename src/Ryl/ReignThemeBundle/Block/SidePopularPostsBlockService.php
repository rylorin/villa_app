<?php

namespace Ryl\ReignThemeBundle\Block;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Sonata\NewsBundle\Block\RecentPostsBlockService;

/**
 * Class SidePopularPostsBlockService
 *
 * Renders a block
 *
 */
class SidePopularPostsBlockService extends RecentPostsBlockService
{
		
	/**
     * {@inheritdoc}
     */
    public function configureSettings(OptionsResolver $resolver)
    {
        parent::configureSettings($resolver);
    	$resolver->setDefault('template', 'RylReignThemeBundle:Block:posts_side.html.twig');
    }

}
