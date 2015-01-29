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
 * @method  string  getAuthUrl()    getAuthUrl(array $params = array())
 * @method  \Njasm\Soundcloud\Request\Response  userCredentials()   userCredentials(string $username, string $password)
 * @method  \Njasm\Soundcloud\Request\Response  codeForToken()  codeForToken(string $code, array $params = array())
 * @method  \Njasm\Soundcloud\Request\Response  refreshAccessToken()    refreshAccessToken($refreshToken = null, array $params = array())
 * @method  \Njasm\Soundcloud\Request\Response  download()  download($trackID, $download = false)
 * @method  \Njasm\Soundcloud\Request\Response  upload()    upload($trackPath, array $params = array())
 *
 * @method  string  getAuthClientID()   getAuthClientID()
 * @method  string|null getAuthToken()  getAuthToken()
 * @method  string|null getAuthScope()  getAuthScope()
 * @method  string|null getExpires()    getExpires()
 * @method  void setAccessToken()   setAccessToken(string $accessToken)
 * @method  void setAuthScope()   setAuthScope(string $scope)
 * @method  void setAuthExpires()   setAuthExpires(string $expires)
 * @method  void setRefreshToken()  setRefreshToken(string $refreshToken)
 * @method  \Njasm\Soundcloud\Soundcloud    get()   get(string $path, array $params = array())
 * @method  \Njasm\Soundcloud\Soundcloud    put()   put(string $path, array $params = array())
 * @method  \Njasm\Soundcloud\Soundcloud    post()  post(string $path, array $params = array())
 * @method  \Njasm\Soundcloud\Soundcloud    delete()    delete(string $path, array $params = array())
 * @method  \Njasm\Soundcloud\Soundcloud    setParams() setParams(array $params = array())
 * @method  \Njasm\Soundcloud\Request\Response  request()   request(array $params = array())
 * @method  \Njasm\Soundcloud\Request\Response|null getCurlResponse()   getCurlResponse()
 * @method  \Njasm\Soundcloud\Soundcloud    asXml() asXml()
 * @method  \Njasm\Soundcloud\Soundcloud    asJson()    asJson()
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
