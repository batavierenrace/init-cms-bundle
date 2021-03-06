<?php
/**
 * This file is part of the Networking package.
 *
 * (c) net working AG <info@networking.ch>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Networking\InitCmsBundle\Model;
use Doctrine\Common\Collections\ArrayCollection;
use Networking\InitCmsBundle\Helper\PageHelper;

/**
 * Class Tag
 * @package Networking\InitCmsBundle\Model
 * @author Yorkie Chadwick <y.chadwick@networking.ch>
 */
abstract class Tag
{
    /**
     * @var integer $id
     *
     */
    protected $id;

    /**
     * @var string $name
     *
     */
    protected $name;

    /**
     * @var string $path
     */
    protected $path;

    /**
     * @var integer $level
     */
    protected $level;

    /**
     * @var string $slug
     */
    protected $slug;


    /**
     * @var ArrayCollection
     */
    protected $children;

    /**
     * @var
     */
    protected $parent;

    /**
     * @var array
     */
    protected $parentNames;

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
     * Set name
     *
     * @param  string $name
     * @return Tag
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
     * Set slug
     *
     * @param  string $slug
     * @return Tag|false
     */
    public function setSlug($slug)
    {
        if (!empty($this->slug)) return false;
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param string $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * @return int
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * @param int $level
     */
    public function setLevel($level)
    {
        $this->level = $level;
    }

    /**
     * @param Tag $parent
     */
    public function setParent(Tag $parent = null){
        $this->parent = $parent;
    }

    /**
     * @return Tag
     */
    public function getParent(){
        return $this->parent;
    }

    /**
     * @return ArrayCollection
     */
    public function getChildren(){
        return $this->children;
    }


    /**
     * @return string
     */
    public function getAdminTitle()
    {
        return $this->path;
    }

    /**
     * @param  array $parentNames
     * @return $this
     */
    public function setParentNames(array $parentNames)
    {
        $this->parentNames = $parentNames;

        return $this;
    }

    /**
     * @return array
     */
    public function getParentNames()
    {
        if (!$this->parentNames) {

            $page = $this;
            $parentNames = array($page->getName());

            while ($page->getParent()) {
                $page = $page->getParent();
                $parentNames[] = $page->getName();
            }

            $this->setParentNames(array_reverse($parentNames));
        }

        return $this->parentNames;
    }


    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }
}
