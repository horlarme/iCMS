<?php

namespace ITBLOG;

/**
 * A pagination Class
 * @author Lawal Oladipupo <lawboi4love@gmail.com
 * @version 1.0
 */
class Pagination extends \ITBLOG\Blogging
{

    public $totalRow = '';
    public $postPerPage = '';
    public $postQuery = '';
    public $totalPage = ''; // The total number of the pages which is available for the post query
    public $currentPage = '';
    public $db;

    /**
     * This will initiate a connection to the database
     * @param object $connection PDO Object for database connection
     */
    public function __construct($connection)
    {
        $this->db = parent::__construct($connection);
    }

    /**
     * This will set up the values to be used by the pagination class
     * @param array $values
     */
    public function setUp($values)
    {
//First checking the number of the values in the $values
//If the values is less than one, then the values will be using their default values
        if (count($values) < 1) {
            THROW NEW Exception("Make sure you parse a minimum of one value");
        } else {
            foreach ($values as $key => $value) {
                $this->$key = $value;
            }
        }

        //Setting the other values of the page which aren't set by parsing of values
        $this->totalRow(); //Setting the total row 
        $this->currentPage(); //Setting the current page 
        $this->totalPage(); //Setting the total page
    }

    public function totalRow()
    {
        $q = $this->postQuery;
        $db = $this->db;
        $qu = $db->query($q)->rowCount();
        $this->totalRow = $qu;
    }

    /**
     * The total number of page the pagination will be having
     * @return int The total number of pages the pagination will be having
     */
    public function totalPage()
    {
        $this->totalPage = ceil($this->totalRow / $this->postPerPage);
    }

    /**
     * Getting the page the user wished to view
     *
     * @return int The current number of the page the user requested to view
     */
    public function currentPage()
    {
        return $this->currentPage = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
    }

    /**
     * Showing the results of the posts and setting the pagination link
     * @param int $page The current page to be showed
     */
    public function show($page)
    {
        $query = $this->postQuery . $this->limit($page);
        $db = $this->db;

        //Show if the result is bigger than one
        if ($this->totalRow < 1) {
            echo "<h1>There is currently no post in this place...</h1>";
        }
        //Else, show an error message
        $query = $db->query($query);
        //Rendering the page for the users/clients to be able to see
        return parent::withPage($query);
    }

    /**
     * Creating the query to be used by show()
     * @param int $page The number of page to show
     * @return string Query to be added to the new query
     */
    public function limit($page)
    {
        $query = $this->postPerPage;
        $offset = (($page * $this->postPerPage) - $this->postPerPage);
        $show = $this->postPerPage;

        $limit = sprintf(" LIMIT  %s, %s", $offset, $show);
        return $limit;
    }

    /**
     * Check if the current page is also the last page in the number of pages
     * @return Boolean True Only if the page is the last page
     * @return Boolean False Only if the page is not the last page
     */

    public function isLastPage()
    {
        $currentPage = $this->currentPage;
        $lastPage = $this->totalPage;

        if ($currentPage === $lastPage) {
            return true;
        }
        return false;
    }

    /**
     * Check if the current page is also the first page in the number of pages
     * @return Boolean True Only if the page is the first page
     * @return Boolean False Only if the page is not the first page
     */
    public function isFirstPage()
    {
        $currentPage = $this->currentPage;
        //Since the first page will be number one (1)
        $firstPage = 1;

        if($currentPage === $firstPage){
            return true;
        }
        return false;
    }

}