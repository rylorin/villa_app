<?php

namespace Ryl\CharityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sponsor
 */
class Sponsor
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $shortDescription;

    protected $image;
    
    protected $enabled;
    
    protected $content;

    protected $rawContent;

    protected $contentFormatter;
    
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
        return $this->getName() ?: 'n/a';
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Sponsor
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set shortDescription
     *
     * @param string $shortDescription
     * @return Sponsor
     */
    public function setShortDescription($shortDescription)
    {
        $this->shortDescription = $shortDescription;

        return $this;
    }

    /**
     * Get shortDescription
     *
     * @return string 
     */
    public function getShortDescription()
    {
        return $this->shortDescription;
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
    public function setEnabled($enabled)
    {
    	$this->enabled = $enabled;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getEnabled()
    {
    	return $this->enabled;
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
     * @var \Doctrine\Common\Collections\Collection
     */
    private $projects;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->projects = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add projects
     *
     * @param \Ryl\CharityBundle\Entity\Project $projects
     * @return Sponsor
     */
    public function addProject(\Ryl\CharityBundle\Entity\Project $projects)
    {
        $this->projects[] = $projects;

        return $this;
    }

    /**
     * Remove projects
     *
     * @param \Ryl\CharityBundle\Entity\Project $projects
     */
    public function removeProject(\Ryl\CharityBundle\Entity\Project $projects)
    {
        $this->projects->removeElement($projects);
    }

    /**
     * Get projects
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProjects()
    {
        return $this->projects;
    }
}
