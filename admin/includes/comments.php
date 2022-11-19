<?php
// class for photos
class Comment extends Db_object
{
    protected static $db_table = 'comments';
    protected static $db_table_feilds = array('id', 'photo_id', 'author', 'body');
    public $id;
    public $photo_id;
    public $author;
    public $body;

    // instatitaite comments properties
    public static function create_comment($photo_id , $author, $body)
    {
        if (!empty($photo_id) && !empty($author) && !empty($body)) {
            $comment = new Comment();
            $comment->photo_id = (int) $photo_id;
            $comment->author = $author;
            $comment->body = $body;

            return $comment;

        } else {
            return false;
        }
    }

    // function to find comments
    public static function find_comment($photo_id)
    {
        global $database;
        $sql = "SELECT * FROM " . self::$db_table . " WHERE photo_id = " . $database->escape_string($photo_id) . " ORDER BY photo_id ASC";
        $result = self::find_by_query($sql);
        return $result;

    }

}
