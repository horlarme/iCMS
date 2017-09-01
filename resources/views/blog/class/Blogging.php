<?php

namespace ITBLOG;

/*
  This is the script for the blog.
 */

//Using Intervention Image Library as Image
//use Intervention\Image\Image as Image;

//Using Gregwar/Image
use \Gregwar\Image\Image as Image;
use \Defr\PhpMimeType\MimeType as FileType;
use \vakata\random\Generator as RandomGen;

/**
 * Class Blogging
 * @package ITBLOG
 */
class Blogging
{

    protected $sqlCon;
    public $paginationQuery = '';

    public function __construct($connection)
    {
        return $this->sqlCon = $connection;
    }

    public function get_pageURL()
    {
        /* @var $_SERVER string */
        if (isset($_SERVER['REQUEST_URI'])) {
            $q = $_SERVER['REQUEST_URI'];
        } else {
            $q = "";
        }
        return $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . $q;
    }

    public function get_pageTitle($pageTitle)
    {
        if (isset($pageTitle)) {
            return $pageTitle;
        } else {
            return PAGE_TITLE;
        }
    }

    public function get_pageDescription($description)
    {
        if (isset($description)) {
            return $description;
        } else {
            return PAGE_DESCRIPTION;
        }
    }

    public function get_pageImage($image)
    {
        if (isset($image)) {
            return $image;
        } else {
            return APP_IMAGE;
        }
    }

    public function postCount($month, $year)
    {
        $sqlCon = $this->sqlCon;
        $query = $sqlCon->query("SELECT * FROM blogpost WHERE year = '" . $year . "' AND month = '" . $month . "' ORDER BY day DESC");
        return $this->byDateCount = $query->rowCount();
    }

    public function searchCount($searchQuery)
    {
        $sqlCon = $this->sqlCon;
        $query = $sqlCon->query("SELECT * FROM blogpost WHERE category LIKE '%" . $searchQuery . "%' OR title LIKE '%" . $searchQuery . "%' OR tag LIKE '%" . $searchQuery . "%' OR content LIKE '%" . $searchQuery . "%'");
        return $this->byDateCount = $query->rowCount();
    }

    public function onView($postid)
    {
        $db = $this->sqlCon;
        $c = $db->query("SELECT * FROM postlist WHERE id = '" . $postid . "'")->fetch();
        $newPostView = $c['views'] + 1;
        $db->query("UPDATE `postlist` SET `views` = '" . $newPostView . "' WHERE `id` = '" . $postid . "'");
    }

    public function postNewTopic($title, $day, $month, $year, $tags, $content, $image, $category, $keyword)
    {
        //connecting to database
        $sqlCon = $this->sqlCon;

        //making text to be sql injection free
        $title = $sqlCon->quote($title);
        $tag = $sqlCon->quote($tags);
        $day = $sqlCon->quote($day);
        $month = $sqlCon->quote($month);
        $image = $sqlCon->quote($image);
        $year = $sqlCon->quote($year);
        $category = $sqlCon->quote($category);
        $keyword = $sqlCon->quote($keyword);

        $content = str_replace("<script", "&lt;script", $content);
        $content = str_replace("</script>", "&lt;/script&gt;", $content);
        $content = nl2br($content);
        $content = $sqlCon->quote($content);

        //this means the user didn't try to post anything on the page
        if (strlen($content) <= 20 && strlen($title) <= 7 && strlen($tags) <= 3) {
            echo "<div class='error'>Please try and fill in the provided boxes below</div>";
        } else {
            try {
                //preparing everything for posting
                $insert = $sqlCon->query("INSERT INTO `blogpost`(`title`,`day`, `month`, `year`, `content`, `tag`,`image`,`category`,`keyword`)
                                                        VALUE($title,$day,$month,$year,$content,$tag,$image,$category,$keyword)");
                if ($insert) {
                    echo "Your post is posted successfully.";
                } else {
                    throw new Exception('There\'s an error posting the topic');
                }
            } catch (PDOException $e) {
                echo "Error: " . $e;
            }
        }
    }

    public function imageUploader($imageUploaded, $imageSaveName, $imageSavePath)
    {
        $imageSavePath = $imageSavePath . $imageSaveName;

        if (move_uploaded_file($imageUploaded['tmp_name'], $imageSavePath)) {
            echo "The image has been uploaded successfully.<br />";
        }
    }

    public function categories()
    {
        //Connecting to database
        $database = $this->sqlCon;
        //Retrieving and storing data from the database
        $n = $database->query("SELECT * FROM `categories` ORDER BY `category_name` ASC");
        // looping through the results from the database
        while ($r = $n->fetch()) {
            //By putting [] at the front of result variable makes the value in it still available and 
            //the array which it is equal to is just appending a new array list
            $result[] = array('name' => $r['category_name'],
                'title' => $r['category_title'],
                'id' => $r['category_id'],
                'icon' => $r['category_icon']);
        }
        //Returning the results as an array
        return $result;
    }

    public function showPosts($category, $limit = " LIMIT 8", $order = " ORDER BY `id` DESC")
    {
        //Connecting to database
        $database = $this->sqlCon;

//        if category is set
        if (isset($category) AND $category != "") {
            $query = $database->query("SELECT * FROM `postlist` P, `categories` C WHERE P.`type` = 'published' AND P.`category_id` = " . $category . " AND C.category_id = P.category_id " . $order . $limit);
        } //This will be used if the above code returns false
        else {
            $query = $database->query("SELECT * FROM `postlist` P, `categories` C WHERE P.`type` = 'published' AND C.category_id = P.category_id " . $order . $limit);
        }

        //Retrieving and storing data from the database
        // looping through the results from the database
        while ($r = $query->fetch()) {
            //By putting [] at the front of result variable makes the value in it still available and 
            //the array which it is equal to is just appending a new array list
            $result[] = array('id' => $r['id'],
                'title' => $r['title'],
                'description' => $r['description'],
                'image' => $r['image'],
                'content' => strip_tags($r['content']),
                'author' => $r['author'],
                'day' => $r['day'],
                'month' => $r['month'],
                'date' => date("D d M", mktime(0, 0, 0, $r['month'], $r['day'], $r['year'])),
                'year' => $r['year'],
                'category_id' => $r['category_id'],
                'category_name' => $r['category_name'],
                'category_title' => $r['category_title'],
                'category_icon' => $r['category_icon'],
                'views' => $r['views'],
                'tags' => $r['tags'],
                'URL' => APP_ADD . $r['URL']);
        }
        //Returning the results as an array
        return $result;
    }

    public function withPage($query)
    {
        //Connecting to database
        $database = $this->sqlCon;

        //Retrieving and storing data from the database
        // looping through the results from the database
        while ($r = $query->fetch()) {
            //By putting [] at the front of result variable makes the value in it still available and 
            //the array which it is equal to is just appending a new array list
            $result[] = array('id' => $r['id'],
                'title' => $r['title'],
                'description' => $r['description'],
                'image' => $r['image'],
                'content' => strip_tags($r['content']),
                'author' => $r['author'],
                'day' => $r['day'],
                'month' => $r['month'],
                'date' => date("D d M", mktime(0, 0, 0, $r['month'], $r['day'], $r['year'])),
                'year' => $r['year'],
                'category_id' => $r['category_id'],
                'category_name' => $r['category_name'],
                'category_title' => $r['category_title'],
                'category_icon' => $r['category_icon'],
                'views' => $r['views'],
                'tags' => $r['tags'],
                'URL' => APP_ADD . $r['URL']);
        }
        //Returning the results as an array
        return $result;
    }

    public function category($id, $name)
    {
        //This shows the details of a category
        $dbase = $this->sqlCon;

        if (isset($name)) {
            $query = $dbase->query("SELECT * FROM `categories` WHERE category_name = '" . strtolower($name) . "'")->fetch();
        } elseif (isset($id)) {
            $query = $dbase->query("SELECT * FROM `categories` WHERE category_id = '" . $id . "'")->fetch();
        }
        return array('name' => $query['category_name'], 'title' => $query['category_title'], 'icon' => $query['category_icon'], 'id' => $query['category_id']);
    }

    public function recentPosts()
    {
        $dbase = $this->sqlCon;
        $query = $dbase->query("SELECT * FROM `postlist` P, `categories` C WHERE P.`type` = 'published' AND C.`category_id` = P.`category_id` ORDER BY `id` DESC LIMIT 8");
        while ($post = $query->fetch()) {
            $result[] = array('URL' => $post['URL'], 'title' => $post['title'], 'day' => $post['day'], 'month' => $post['month'], 'category_name' => $post['category_name']);
        }
        return $result;
    }

    public function listTags()
    {
        $dbase = $this->sqlCon;
        $list = $dbase->query("");
    }

    public function showPost($URL)
    {
        $db = $this->sqlCon;

        $r = $db->query("SELECT * FROM `postlist` P, `categories` C WHERE P.URL = $URL AND C.category_id = P.category_id");

        //Displaying the post if it is found
        if ($r->rowCount() === 1) {
            $r = $r->fetch();
            return array(
                'id' => $r['id'],
                'title' => $r['title'],
                'description' => $r['description'],
                'image' => $r['image'],
                'content' => $r['content'],
                'author' => $r['author'],
                'day' => $r['day'],
                'month' => $r['month'],
                'year' => $r['year'],
                'date' => date("D d M", mktime(0, 0, 0, $r['month'], $r['day'], $r['year'])),
                'category_id' => $r['category_id'],
                'category_name' => $r['category_name'],
                'category_icon' => $r['category_icon'],
                'category_title' => $r['category_title'],
                'views' => $r['views'],
                'tags' => $r['tags'],
                'URL' => APP_ADD . $r['URL']
            );
        } else {
//            returning the user to an error page if the post is not
            header('Location: 404.php');
        }

    }

    /**
     * Displaying the comments of a particular post
     * @param int $postid
     * @return array An array of values
     */
    public function showComments($postid)
    {
        $db = $this->sqlCon;
        $postid = $db->quote($postid);
        $c = $db->query("SELECT * FROM `comment` WHERE postid = " . $postid);
        if ($c->rowCount() >= 1) {
            while ($d = $c->fetch()) {
                $re[] = array('name' => $d['name'],
                    'email' => $d['email'],
                    'comment' => $d['comment'],
                    'month' => $d['month'],
                    'day' => $d['day'],
                    'year' => $d['year']);
            }
            return $re;
        } else {
            return FALSE;
        }
    }

    /**
     * Checks if a value actually has a value
     * @param type $value
     * @return true if the value passed has a value
     * and FALSE if otherwise
     */
    public function has_value($value)
    {
        if (FALSE != $value || $value != "") {
            return TRUE;
        } else {
            return FALSE;
        }
    }


    /**
     * @param $mimeType
     * @return bool false If the mime doesn't match any in the array
     */
    public function isImage($mimeType)
    {
        $images = array('image/png',
            'image/jpeg',
            'image/jpeg',
            'image/jpeg',
            'image/gif',
            'image/bmp',
            'image/vnd.microsoft.icon',
            'image/tiff',
            'image/tiff',
            'image/svg+xml',
            'image/svg+xml');
        //Checking if the file type matches any file type in the array list
        if (in_array($mimeType, $images)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Create a random character
     * @param $type String The type of data to be returned -number -string -special(string & number)
     * @param $min Int The minimum number of character to be received
     * @param $min Int The maximum number of character to be received
     */
    public function createRandom($type = 'number', $min = 3, $max = 10)
    {
        switch ($type) {
            case 'number':
                //Generating a number character
                return RandomGen::number($min, $max);
                break;

            case 'string' :
                //Generating a string char.
                return RandomGen::string($min, $max);
                break;

            case 'special' :
                return RandomGen::string(RandomGen::number($min, $max));
                break;

        }
    }

    /**
     * This method will upload image files to their folder and assign to them a name
     * @param file $image The path of the file
     * @return array The response (boolean) and the message (string)
     */
    public function uploadImage($image)
    {
        //The Image file
        $resized = Image::open($image);
        //Getting the extension of the image file
        $fileMime = FileType::get($image);

        //Checking if the file type is an image
        if ($this->isImage($fileMime) == true) {
            //The folder to save the uploaded file
            $target = "uploads/";
//            Creating a new name for the file
            $newName = $target . $this->createRandom('string', 3, 10) . "." . $this->getExt($image);
//            We take precaution by checking if the file doesn't exist before so not to replace it
                if (file_exists($newName)) {
                    $newName = $target . $this->createRandom('string', 3, 10) . "." . $this->getExt($image);
                }
//            Now we are ready to create a new image file
                if ($resized->save($newName, 'guess', 60)) {
                    //Storing the response in JSON format
                    $response = array('response' => 'true', 'message' => APP_ADD . $newName);
                    //Deleting the file in temporary folder
                    unlink($image);
                    //Returning the JSON format response
                    return $response;
                } else {
                    $response = array('response' => 'false', 'message' => 'The Image cannot be uploaded to the new location');
                    return $response;
                }
            } else {
            unlink($image);
            return array('response' => 'false', 'message' => 'The uploaded image file is not supported.');
        }
    }

    /**
     * @param $file
     * @return string The extension of the file
     */
    public
    function getExt($file)
    {
        return strtolower(array_pop((explode('.', $file))));
    }

}