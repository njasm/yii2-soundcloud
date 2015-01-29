<?php

namespace Njasm\Soundcloud\yii2;

use yii\base\Component;

class Soundcloud extends Component
{
    protected $clientId;
    protected $clientSecret;
    protected $callbackUrl;

    public function getClientId()
    {
        return $this->clientId;
    }

}