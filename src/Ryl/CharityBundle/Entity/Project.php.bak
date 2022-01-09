<?php

namespace Ryl\CharityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Project
 */
class Project
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $abstract;

    /**
     * @var boolean
     */
    protected $enabled;

    protected $image;
    
    protected $content;

    protected $rawContent;

    protected $contentFormatter;
    
    /**
     * Sponsor for this project
     *
     * @var \Ryl\CharityBundle\Entity\Sponsor
     */
    protected $sponsor;
    
    protected $createdAt;
    
    protected $updatedAt;
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return $this->getTitle() ?: 'n/a';
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Project
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set abstract
     *
     * @param string $abstract
     * @return Project
     */
    public function setAbstract($abstract)
    {
        $this->abstract = $abstract;

        return $this;
    }

    /**
     * Get abstract
     *
     * @return string 
     */
    public function getAbstract()
    {
        return $this->abstract;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     * @return Project
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return boolean 
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * {@inheritdoc}
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * {@inheritdoc}
     */
    public function getImage()
    {
        return $this->image;
    }
    
    /**
     * {@inheritdoc}
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * {@inheritdoc}
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param $contentFormatter
     */
    public function setContentFormatter($contentFormatter)
    {
    	$this->contentFormatter = $contentFormatter;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getContentFormatter()
    {
    	return $this->contentFormatter;
    }
    
    /**
     * {@inheritdoc}
     */
    public function setRawContent($rawContent)
    {
    	$this->rawContent = $rawContent;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getRawContent()
    {
    	return $this->rawContent;
    }
    
    /**
     * {@inheritdoc}
     */
    public function setSponsor($sponsor)
    {
        $this->sponsor = $sponsor;
    }

    /**
     * {@inheritdoc}
     */
    public function getSponsor()
    {
        return $this->sponsor;
    }
    
    /**
     * {@inheritdoc}
     */
    public function setCreatedAt(\DateTime $createdAt = null)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * {@inheritdoc}
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * {@inheritdoc}
     */
    public function setUpdatedAt(\DateTime $updatedAt = null)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * {@inheritdoc}
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function prePersist()
    {
//        if (!$this->getPublicationDateStart()) {
//            $this->setPublicationDateStart(new \DateTime);
//        }

        $this->setCreatedAt(new \DateTime);
        $this->setUpdatedAt(new \DateTime);
    }

    public function preUpdate()
    {
//        if (!$this->getPublicationDateStart()) {
//            $this->setPublicationDateStart(new \DateTime);
//        }

        $this->setUpdatedAt(new \DateTime);
    }

    /**
     * Constructor
     */
    public function __construct()
    {
//        $this->comments = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $donations;


    /**
     * Add donations
     *
     * @param \Application\Sonata\ProductBundle\Entity\Donation $donations
     * @return Project
     */
    public function addDonation(\Application\Sonata\ProductBundle\Entity\Donation $donations)
    {
        $this->donations[] = $donations;

        return $this;
    }

    /**
     * Remove donations
     *
     * @param \Application\Sonata\ProductBundle\Entity\Donation $donations
     */
    public function removeDonation(\Application\Sonata\ProductBundle\Entity\Donation $donations)
    {
        $this->donations->removeElement($donations);
    }

    /**
     * Get donations
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDonations()
    {
        return $this->donations;
    }
}
