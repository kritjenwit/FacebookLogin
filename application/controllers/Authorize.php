<?php

/**
 * Created by PhpStorm.
 * User: AI System
 * Date: 23-Jul-18
 * Time: 5:13 PM
 */

require_once './vendor/autoload.php';
class Authorize extends CI_Controller
{

    public function login(){

        if(!session_id()) {
            session_start();
        }

        $fb = new Facebook\Facebook([
            'app_id' => '225540354951451', // Replace {app-id} with your app id
            'app_secret' => 'fc9eb08ec54eca06364953ea07120c45',
            'default_graph_version' => 'v3.0',
        ]);

        $helper = $fb->getRedirectLoginHelper();

        $permissions = ['email','user_likes','user_link']; // Optional permissions
        $loginUrl = $helper->getLoginUrl('https://1db515db.ngrok.io/callback', $permissions);

        $data['url'] = '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>';
        $data['title'] = 'Login';

        # ------ Validation from login form -----------------
        $this->form_validation->set_rules('email','Email','required');
        $this->form_validation->set_rules('password','Password','required');
        if($this->form_validation->run() === FALSE){
            $this->load->view('templates/header', $data);
            $this->load->view('authorize/login', $data);
            $this->load->view('templates/footer', $data);
        }else{
            $this->user_model->insert_user();
            redirect('/login');
        }
    }

    public function callback(){
        if(!session_id()) {
            session_start();
        }

        $fb = new Facebook\Facebook([
            'app_id' => '225540354951451', // Replace {app-id} with your app id
            'app_secret' => 'fc9eb08ec54eca06364953ea07120c45',
            'default_graph_version' => 'v2.2',
        ]);

        $helper = $fb->getRedirectLoginHelper();

        try {
            $accessToken = $helper->getAccessToken();
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        if (! isset($accessToken)) {
            if ($helper->getError()) {
                header('HTTP/1.0 401 Unauthorized');
                echo "Error: " . $helper->getError() . "\n";
                echo "Error Code: " . $helper->getErrorCode() . "\n";
                echo "Error Reason: " . $helper->getErrorReason() . "\n";
                echo "Error Description: " . $helper->getErrorDescription() . "\n";
            } else {
                header('HTTP/1.0 400 Bad Request');
                echo 'Bad request';
            }
            exit;
        }

// Logged in
        echo '<h3>Access Token</h3>';
        var_dump($accessToken->getValue());

// The OAuth 2.0 client handler helps us manage access tokens
        $oAuth2Client = $fb->getOAuth2Client();

// Get the access token metadata from /debug_token
        $tokenMetadata = $oAuth2Client->debugToken($accessToken);
        echo '<h3>Metadata</h3>';

        echo '<pre>';
        print_r($tokenMetadata);
        echo '</pre>';

// Validation (these will throw FacebookSDKException's when they fail)
        $tokenMetadata->validateAppId('225540354951451'); // Replace {app-id} with your app id
// If you know the user ID this access token belongs to, you can validate it here
//$tokenMetadata->validateUserId('123');
        $tokenMetadata->validateExpiration();

        if (! $accessToken->isLongLived()) {
            // Exchanges a short-lived access token for a long-lived one
            try {
                $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
            } catch (Facebook\Exceptions\FacebookSDKException $e) {
                echo "<p>Error getting long-lived access token: " . $e->getMessage() . "</p>\n\n";
                exit;
            }

            echo '<h3>Long-lived</h3>';
            var_dump($accessToken->getValue());
        }

        $_SESSION['fb_access_token'] = (string) $accessToken;

        $response = $fb->get('/me?fields=id,name,gender,email,link', $accessToken);

        $user = $response->getGraphUser()->asArray();

        $id = $user['id'];
        $name = $user['name'];
        $email = $user['email'];
        $link = $user['link'];
        $picture = "https://graph.facebook.com/". $user['id'] ."/picture?type=large";

        if(!$this->fbuser_model->get_user($id)){
            $this->fbuser_model->insert_user($id,$name,$email,$link,$picture);
        }

        $user_data = array(
            'id' => $id,
            'name' => $name,
            'email' => $email,
            'link' => $link,
            'picture' => $picture,
            'logged' => 1
        );

        $this->session->set_userdata($user_data);
        redirect('/');
    }

    public function register(){
        $data['title'] = 'Register';

        $this->form_validation->set_rules('email','Email','required');
        $this->form_validation->set_rules('password','Password','required');
        if($this->form_validation->run() === FALSE){
            $this->load->view('templates/header', $data);
            $this->load->view('authorize/register', $data);
            $this->load->view('templates/footer', $data);
        }else{
            # ----- Upload image ------
            $config['upload_path'] = './assets/images/profile';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '2048';
            $config['max_width'] = '500';
            $config['max_height'] = '500';
            $this->load->library('upload', $config);

            # --- Check if it upload or not ---
            if(!$this->upload->do_upload()){
                $errors = array('error' => $this->upload->display_errors());
                $profile_image = 'noimage.jpg';
            }else{
                $data = array('upload_data' => $this->upload->data());
                $profile_image = $_FILES['userfile']['name'];
            }


            $this->user_model->create_user($profile_image);
            redirect('/login');
        }
    }

    public function logout(){
        $this->session->sess_destroy();
        redirect('/');
    }
}