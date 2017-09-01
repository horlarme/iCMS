<?php

namespace ITBLOG;

class Comment extends \ITBLOG\Blogging {

    public $db;

    public function __construct($connection) {
        $this->db = parent::__construct($connection);
    }

    public function comment_Name() {
        if (parent::has_value($_REQUEST['fullname'])) {
            return $this->db->quote($_REQUEST['fullname']);
        }
    }

    public function comment_Date() {
        $day = Date("d");
        $month = Date("m");
        $year = Date("Y");
        return "'" . $day . "','" . $month . "','" . $year . "'";
    }

    public function comment_Content() {
        if (parent::has_value($_REQUEST['comment'])) {
            return $this->db->quote($_REQUEST['comment']);
        }
    }

    public function comment_Email() {
        if (parent::has_value($_REQUEST['email'])) {
            return $this->db->quote($_REQUEST['email']);
        }
    }
//
//    public function post_Id() {
//        if (parent::has_value($_REQUEST['fullname'])) {
//            return $this->db->quote($_REQUEST['fullname']);
//        }
//    }

    public function addComment($post_Id) {
        $comment = sprintf("INSERT INTO comment(`postid`,`name`,`email`,`comment`,`day`,`month`,`year`) VALUES(%s,%s,%s,%s,%s)", $post_Id, $this->comment_Name(), $this->comment_Email(),$this->comment_Content(), $this->comment_Date());
        $this->db->query($comment);
    }

}
