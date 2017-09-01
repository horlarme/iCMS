<?php

namespace ITBLOG;

/**
 * Class SiteMap
 * This class creates a site map for a website.
 * @package ITBLOG
 */

class SiteMap
{

    /**
     * The website address of the app.
     * @var string Web Address
     */
    public $site = "www.siteaddress.com";

    /**
     * SiteMap constructor.
     * Create the database needed.
     * @param $db PDOObject The database to be used in this class
     */
    public function __construct($db)
    {
        //Creating the database connection
        $this->database = $db;
    }

    /**
     * @var  database PDO Object
     */
    public $database;

    /**
     * @var  $query string Database Query
     */
    public $query;

    /**
     * @var  $otherQuery string Database Query
     */
    public $otherQuery;

    /**
     * This returns the complete list of the pages from ITBLOG.com.ng
     * @return String
     */
    public function pages()
    {
        $query = $this->query;

        $list = $this->database->query($query);

//        Storing the results in a string format
        $result = "";

        while ($url = $list->fetch()) {
            $result .= "<url>" . "\r\n";
            $result .= "<loc>" . $this->site . "/" . strtolower(str_replace(" ", "_", $url['URL'])) . "</loc>" . "\r\n";
            $result .= "<changefreq>daily</changefreq>" . "\r\n";
            $result .= "</url>" . "\r\n";
        }

        return $result;
    }

    /**
     * This returns the complete list of the pages from ITBLOG.com.ng
     * @return String
     */
    public function categories()
    {
        $query = $this->otherQuery;

        $list = $this->database->query($query);

//        Storing the results in a string format
        $result = "";

        while ($category = $list->fetch()) {
            $result .= "<url>" . "\r\n";
            $result .= "<loc>" . $this->site . "/" . strtolower($category['category_name']) . "/</loc>" . "\r\n";
            $result .= "<changefreq>daily</changefreq>" . "\r\n";
            $result .= "</url>" . "\r\n";
        }

        return $result;
    }

    /**
     * This creates the full sitemap for the website
     */
    public function createSiteMap()
    {
        //The heading of the website
        echo "<?ml version=\"1.0\" encoding=\"UTF-8\" ?>" . "\r\n";
        echo "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">" . "\r\n";
        //The homepage of the website
        echo "<url>" . "\r\n";
        echo "<loc>" . $this->site . "</loc>" . "\r\n";
        echo "<changefreq>daily</changefreq>" . "\r\n";
        echo "</url>" . "\r\n";

        //The categories list
        echo $this->categories();

        //The posts of the website
        echo $this->pages();

        echo "</urlset>";


    }
}