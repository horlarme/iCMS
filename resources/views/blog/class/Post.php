<?php

namespace ITBLOG;

class Post
{
    //Database connection
    protected $db;

    public function __construct($database)
    {
//        return $this->db = parent::__construct($database);
        return $this->db = $database;
    }

    /*
     * The Title of the post to be added to the blog
     * var $title string
     */

    public function title()
    {
        return $this->db->quote($_POST['blogtitle']);
    }

    /**
     * @return String The quoted content
     */
    public function content()
    {

        $content = $_POST['blogcontent'];
        //Removing Some Tags

        $content = str_replace("<!DOCTYPE html>
<html>
<head>
</head>
<body>", "", $content);
        $content = str_replace("</body>
</html>", "", $content);

        return $this->db->quote($content);

    }

    /*
     * The name of the author of the post
     * @return string
     */
    public function author($author = "Lawal Oladipupo")
    {
        return $this->db->quote($author);
    }

    /*
     * The current day
     * @return string
     */

    public function day()
    {
        return date("d");
    }

    /*
     * The current month
     * @return string
     */

    public function month()
    {
        return date("m");
    }

    /*
     * The current year
     * @return string
     */

    public function year()
    {
        return date("Y");
    }

    /*
     * The description of the post.
     * var $description string
     */
    public function description()
    {
        return $this->db->quote($_POST['blogdescription']);
    }

    /*
     * The image file path to be uploaded as a sting.
     * var $imagePath String
     */
    public function image()
    {
        return $this->db->quote($_POST['blogimage']);
    }

    /*
     * The category to put the blog post
     * var $category String
     */
    public function category()
    {
        return $this->db->quote($_POST['category']);
    }

    /*
     * The tags
     * var $tags String
     */
    public function tags()
    {
        return $this->db->quote($_POST['tag']);
    }

    /*
     * Create a new post.
     * return false on error
     */
    public function addPost()
    {
        $URL = $this->createURL($this->title());

        //Theinformation needed to post to the database
        $qu = "INSERT INTO postlist(`title`,`description`,`image`,`content`,`author`,`day`,`month`,`year`,`category_id`,`type`,`tags`,`URL`)";
        $qu .= "VALUES(";
        $qu .= $this->title() . ",";
        $qu .= $this->description() . ",";
        $qu .= $this->image() . ",";
        $qu .= $this->content() . ",";
        $qu .= $this->author() . ",";
        $qu .= $this->day() . ",";
        $qu .= $this->month() . ",";
        $qu .= $this->year() . ",";
        $qu .= $this->category() . ",";
        $qu .= "'published'" . ",";
        $qu .= $this->tags() . ",";
        $qu .= $this->db->quote($URL);
        $qu .= ")";

        //Adding value to the table
        if ($this->db->query($qu)) {
            return true;
        }
    }

    /**
     * This function creates a URL Address for each post
     * @return String A URL which has no space
     * @param $title String Convert a string to a URL Like string
     */
    public function createURL($title)
    {
        $title = strtolower($title);
        /** @var array $tr The values to be checked for and replaced */
        $tr = array("<", ">", ".", ",", "/", "?", " ", ";", ":", "'", "\"", "[", "]", "{", "}", "\\", "=", "+", "-", "_", ")", "(", "*", "&", "^", "%", "$", "#", "@", "!", "`", "~");
        //The variable to hold the replaced elements
        $URL = str_replace($tr, "_", $title);

        $this->address = APP_ADD . strtolower(substr($URL, 0, 50));

        //Returning the URL
        return $URL;
    }

    public $address = "";

    public function uploadImage()
    {
        //Upload Location
        $t = "uploads/tmp/";
        //Uploaded file
        $u = $t . basename($_FILES['image']['name']);

        //Checking to see if the file was uploaded successfully
        if (move_uploaded_file($_FILES['image']['tmp_name'], $u)) {
            $b = new Blogging($this->db);
            return $b->uploadImage($u);
        }

    }

    public function savePost(){
    $db = $this->db;
    //Notification Class
    $not = new \ITBLOG\OneSignal;
    //Main Blogging Class
    $b = new \ITBLOG\Blogging($db);
    //Blog Post Class
    $p = new \ITBLOG\Post($db);

    //Calling the post script to upload the data in the form when this page was called upon
    //If the method "addPost()" successfully add the form

    if ($p->addPost()) {
//        Notification Details
        $not->address = $p->address;
        $not->content = $_POST['blogdescription'];
        $not->image = $_POST['blogimage'];
        $not->title = $_POST['blogtitle'];
//        Send notification to the subscribers
        $not->sendMessage();

        //Checking if this post is requested to be posted to Facebook
        if ($_REQUEST['postLink'] === 'yes') {
            echo "The user choose to share this on Facebook";
            $link = $p->address;
            $message = $_POST['blogdescription'];

            $fb = new ITBLOG\FacebookAPI();

            //Adding the values to be sent to Facebook
            $fb->link = "" . $link . "";
            $fb->content = "" . $message . "";
            //Posting to Facebook
            $fb->postLink();
        }
    //        Changing the location of the page to the post's page
    header('location: ' . $p->address);
   
        
    } else {
        echo "<h3>There's an error posting your story! you are free to reload this page to re-post...</h3>";
    }




    }
}
