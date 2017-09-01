<?php
/**
 * Created by PhpStorm.
 * User: MeetWEB
 * Date: 3/28/2017
 * Time: 3:19 PM
 */

namespace ITBLOG;

/**
 * Importing Facebook classes
 */
use Facebook\Facebook as Facebook;
use Facebook\Exceptions\FacebookResponseException as FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException as FacebookSDKException;
use Facebook\FacebookRequest as FacebookRequest;

class FacebookAPI
{

    /**
     * @var string $app_id Unique Facebook Application ID
     */
    public $app_id = '1887696564820120';
    /**
     * @var string $app_secret Unique secret of passsword for facebook
     */
    public $app_secret = 'bdc9b3e69e803eb88e143080725e06ce';
    /**
     * @var string $link The link to be sent with the message
     */
    public $link = '';
    /**
     * @var string $content The message to be sent
     */
    public $content = '';
    /**
     * @var \Facebook\Facebook Facebook Class
     */
    protected $fb;

    protected $token = 'EAAa02ZAswmJgBAHgESz3Bb9SluX5Xko014vsViMSF8SSBpPty97qgiH3PZBGWXUft6WvAyJAKyguKgXL478fmAL79yBHGdB3oh785mFwX5eaSv8CGZB6JWZB1Qo8BjQFopvZCYHUbk067JgWZCMZBRViYBZC4O2QrsIZD';

    /**
     * FacebookAPI constructor.
     */
    public function __construct()
    {
        $this->fb = new Facebook([
            'app_id' => $this->app_id,
            'app_secret' => $this->app_secret,
            'default_graph_version' => 'v2.9',
        ]);
    }

    /**
     * @return array The information to be sent to Facebook
     */
    protected function linkData()
    {
        return array('link' => $this->link, 'message' => $this->content);
    }

    /**
     * This method is in charge of posting message to the timeline of a user
     * @return string Returns information about the sent message in JSON format
     */
    public function postLink()
    {
        try {
            // Returns a `Facebook\FacebookResponse` object
            $response = $this->fb->post('/me/feed', $this->linkData(), $this->token);
        } catch (FacebookResponseException $e) {
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch (FacebookSDKException $e) {
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }
        echo $response->getGraphNode();
    }

    public function getUser()
    {

// Use one of the helper classes to get a Facebook\Authentication\AccessToken entity.
//   $helper = $fb->getRedirectLoginHelper();
//   $helper = $fb->getJavaScriptHelper();
//   $helper = $fb->getCanvasHelper();
//   $helper = $fb->getPageTabHelper();
        try {
            // Get the \Facebook\GraphNodes\GraphUser object for the current user.
            // If you provided a 'default_access_token', the '{access-token}' is optional.
            $response = $this->fb->get('/me', 'EAAa02ZAswmJgBAA6kj6gna3atouQYi9pZALqzqJxBZA8sfqxiZC1x4HSD04ofKvSf3PINAN5bWneXZCE3FGt1SHNlJ9eIOJyvckXpekF0z5z41LxMEEVltWTRnAMW2t9lW1CDrRXVWf3YP3I04g1MxiZBmc7BxTn2eerlejYdOhJQlEUuEwnOSGVGI3ZBw0dXEZD');
        } catch (FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch (FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        //Getting the information of the current user logged in
        return $response->getGraphUser();

    }


    public function getToken()
    {
        $request = $this->fb->post('/me',
            array(
                'access_token' => 'http://itblog.com.ng'
            )
        );

        $response = $request->execute();
        $graphObject = $response->getGraphObject();
        /* handle the result */
    }
}

