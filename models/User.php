<?php

namespace app\models;

use yii\base\BaseObject;

class User extends BaseObject
{
    private $id;
    private $username;
    private ClientGroup $clientGroup;

    /**
     * @param $id
     * @param $username
     */
    public function __construct($id, $username, ClientGroup $clientGroup = NULL)
    {
        parent::__construct();
        $this->id = $id;
        $this->username = $username;
        $this->clientGroup = $clientGroup;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username): void
    {
        $this->username = $username;
    }

    public function getClientGroup(): ?ClientGroup
    {
        return $this->clientGroup;
    }

    public function setClientGroup(?ClientGroup $clientGroup): void
    {
        $this->clientGroup = $clientGroup;
    }


}
