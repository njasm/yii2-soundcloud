<?php

namespace Njasm\Soundcloud\yii2;

use Njasm\Soundcloud\SoundcloudFacade as Sc;
use yii\base\Component;
use yii\base\InvalidConfigException;

/**
 * Soundcloud.com API Wrapper Component for Yii2.
 *
 * @package Njasm\Soundcloud\yii2
 * @author  Nelson João Morais <njmorais@gmail.com>
 * @see     http://www.github.com/njasm/yii2-soundcloud
 * @since   2.0
 *
 * @method  string                                      getAuthUrl()            getAuthUrl(array $params = array())
 * @method  \Njasm\Soundcloud\Request\ResponseInterface userCredentials()       userCredentials(string $username, string $password)
 * @method  \Njasm\Soundcloud\Request\ResponseInterface codeForToken()          codeForToken(string $code, array $params = array())
 * @method  \Njasm\Soundcloud\Request\ResponseInterface refreshAccessToken()    refreshAccessToken($refreshToken = null, array $params = array())
 * @method  \Njasm\Soundcloud\Request\ResponseInterface download()              download($trackID, $download = false)
 * @method  \Njasm\Soundcloud\Request\ResponseInterface upload()                upload($trackPath, array $params = array())
 *
 */
class Soundcloud extends Component
{
    /**
     * @var string Soundcloud Client ID
     */
    protected $clientId;

    /**
     * @var string Soundcloud Client Secret
     */
    protected $clientSecret;

    /**
     * @var string Soundcloud Auth Callback Url
     */
    protected $callbackUrl;

    /**
     * @var Sc Soundcloud
     */
    protected $soundcloud;

    public function __construct($config = [])
    {
        foreach ($config as $param => $value) {
            $this->$param = $value;
        }

        $this->validateParameters();
        $this->init();
    }

    /**
     * Validates supplied Params.
     *
     * @return void
     * @throws InvalidConfigException
     */
    protected function validateParameters()
    {
        if (empty($this->clientId) || !is_string($this->clientId)) {
            throw new InvalidConfigException("clientId cannot be empty and it must be a string");
        }

        if (empty($this->clientSecret) || !is_string($this->clientSecret)) {
            throw new InvalidConfigException("clientSecret cannot be empty and it must be a string");
        }
    }

    /**
     * {@inheritdoc}
     *
     * @return void
     */
    public function init()
    {
        $this->soundcloud = new Sc($this->clientId, $this->clientSecret, $this->callbackUrl);
    }

    public function __call($method, $args = [])
    {
        return call_user_func_array(array($this->soundcloud, $method), $args);
    }
}
