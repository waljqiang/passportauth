<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;

class CheckAuthException extends AuthorizationException
{
    /**
     * @var int
     */
    private $httpStatusCode;

    /**
     * @var string
     */
    private $errorType;

    /**
     * @var null|string
     */
    private $hint;

    /**
     * @var null|string
     */
    private $redirectUri;

    /**
     * @var array
     */
    private $payload;

    /**
     * Throw a new exception.
     *
     * @param string      $message        Error message
     * @param int         $code           Error code
     * @param string      $errorType      Error type
     * @param int         $httpStatusCode HTTP status code to send (default = 400)
     * @param null|string $hint           A helper hint
     * @param null|string $redirectUri    A HTTP URI to redirect the user back to
     */
    public function __construct($message, $code, $errorType, $httpStatusCode = 400, $hint = null, $redirectUri = null)
    {
        parent::__construct($message, $code);
        $this->httpStatusCode = $httpStatusCode;
        $this->errorType = $errorType;
        $this->hint = $hint;
        $this->redirectUri = $redirectUri;
        $this->payload = [
            'error'   => $errorType,
            'message' => $message,
        ];
        if ($hint !== null) {
            $this->payload['hint'] = $hint;
        }
    }

    /**
     * Returns the current payload.
     *
     * @return array
     */
    public function getPayload()
    {
        return $this->payload;
    }

    /**
     * Updates the current payload.
     *
     * @param array $payload
     */
    public function setPayload(array $payload)
    {
        $this->payload = $payload;
    }

    /**
     * Invalid scope error.
     *
     * @param string      $scope       The bad scope
     * @param null|string $redirectUri A HTTP URI to redirect the user back to
     *
     * @return static
     */
    public static function noScope($scope, $redirectUri = null)
    {
        $errorMessage = "The access_token do not has the scope of {$scope}";
        $hint = 'Check the scopes of the access_token';
        return new static($errorMessage, 5, 'invalid_scope', 400, $hint, $redirectUri);
    }

    /**
     * Returns the HTTP status code to send when the exceptions is output.
     *
     * @return int
     */
    public function getHttpStatusCode()
    {
        return $this->httpStatusCode;
    }

    /**
     * @return null|string
     */
    public function getHint()
    {
        return $this->hint;
    }

    public function getErrorType(){
        return $this->errorType;
    }

}
