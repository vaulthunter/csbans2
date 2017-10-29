<?php

namespace app\components\theme;

class Author
{
    private $nickName;
    private $firstName;
    private $lastName;
    private $email;
    private $contacts;
    private $role;

    /**
     * Author's popular nick name
     * @return string
     */
    public function getNickName()
    {
        return $this->nickName;
    }

    /**
     * Author's first name
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Author's last name
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Author's e-mail address
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Author's additional contacts. Allow any HTML code, except javascript. All javascript will be cut out.
     * @return string
     */
    public function getContacts()
    {
        return $this->contacts;
    }

    /**
     * Author's role in this theme project
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param string $nickName
     * @return Author
     */
    public function setNickName($nickName)
    {
        $this->nickName = $nickName;
        return $this;
    }

    /**
     * @param string $firstName
     * @return Author
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @param string $lastName
     * @return Author
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * @param string $email
     * @return Author
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @param string $contacts
     * @return Author
     */
    public function setContacts($contacts)
    {
        $this->contacts = $contacts;
        return $this;
    }

    /**
     * @param string $role
     * @return Author
     */
    public function setRole($role)
    {
        $this->role = $role;
        return $this;
    }
}