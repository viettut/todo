<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 10/21/15
 * Time: 9:07 PM
 */

namespace Viettut\Model\Core;


use Viettut\Model\ModelInterface;

interface TagInterface extends ModelInterface
{
    /**
     * @param $id
     * @return self
     */
    public function setId($id);


    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     * @return self
     */
    public function setName($name);

    /**
     * @return string
     */
    public function getIcon();

    /**
     * @param string $icon
     * @return self
     */
    public function setIcon($icon);

    /**
     * @return int
     */
    public function getCount();

    /**
     * @param int $count
     * @return self
     */
    public function setCount($count);

    /**
     * @return \DateTime
     */
    public function getCreatedAt();

    /**
     * @return \DateTime
     */
    public function getDeletedAt();
}