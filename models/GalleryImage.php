<?php
class GalleryImage extends \Kobalt\Simplebase\Model {
    
    /* The constructor, which sets up the database manager
     */
    public function __construct() {
        $this->dbm = new DbManager();
        $this->table = new DbTable("Image", "id");
        $this->fkCols[] = "seriesID";
    }
