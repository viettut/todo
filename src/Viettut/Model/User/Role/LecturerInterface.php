<?php

namespace Viettut\Model\User\Role;

interface LecturerInterface extends UserRoleInterface
{
    /**
     * @return string
     */
    public function getFirstName();

    /**
     * @param string $firstName
     * @return self
     */
    public function setFirstName($firstName);

    /**
     * @return string
     */
    public function getLastName();

    /**
     * @param string $lastName
     * @return self
     */
    public function setLastName($lastName);

    /**
     * @return string
     */
    public function getCompany();

    /**
     * @param string $company
     * @return self
     */
    public function setCompany($company);

    /**
     * @return string
     */
    public function getPhone();

    /**
     * @param string $phone
     * @return self
     */
    public function setPhone($phone);

    /**
     * @return string
     */
    public function getCity();

    /**
     * @param string $city
     * @return self
     */
    public function setCity($city);

    /**
     * @return string
     */
    public function getState();

    /**
     * @param string $state
     * @return self
     */
    public function setState($state);

    /**
     * @return string
     */
    public function getAddress();

    /**
     * @param string $address
     * @return self
     */
    public function setAddress($address);

    /**
     * @return string
     */
    public function getPostalCode();

    /**
     * @param string $postalCode
     * @return self
     */
    public function setPostalCode($postalCode);

    /**
     * @return string
     */
    public function getCountry();

    /**
     * @param string $country
     * @return self
     */
    public function setCountry($country);

    /**
     * @return string
     */
    public function getEmail();

    /**
     * @return string
     */
    public function getAvatar();

    /**
     * @param $avatar
     * @return self
     */
    public function setAvatar($avatar);

    /**
     * @return mixed
     */
    public function getSettings();

    /**
     * @param mixed $settings
     */
    public function setSettings($settings);
}