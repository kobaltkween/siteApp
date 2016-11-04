<?php
/* A generic Page, with a main image, a title, and some text
 */
class Page extends \Kobalt\Simplebase\Model {
    
    /* The upload directory for the page's images
     * @var string
     */
    public $uploadDir;
    
    /* The maximum height of the main image in pixels
     * @var int
     */
    public $imgMaxHeight;
    
    /* The maximum width of the main image in pixels
     * @var int
     */
    public $imgMaxWidth;
    
    /* The maximum filesize of the main image in MB
     * @var int
     */
    public $imgMaxSize;
    
    /* Set the main table it talks to
     * Set the upload directory for the page's main image
     * This refers to a table created in the dbinit file
     * @return: void
     */
    protected function setBase() {
        $this->table = $pageTable;
        // Check on the image directory
        if (!file_exists(UP_IMG)) {
            mkdir(UP_IMG, 0755);
        }
        // Set the properties for its images
        $this->uploadDir = UP_IMG;
        $this->imgMaxHeight = 3000;
        $this->imgMaxWidth = 6000;
        $this->imgMaxSize = 1.5;
    }
    
    /* A filter input function that's just here to demonstrate how to filter input
     * Specific model subclasses will need to override this to handle particular fields
     * @return: void
     * @throws: FilterExcept (from the filters) or \Exception
     */
    protected function filterInParam() {
        foreach ($this->input as $k => $v) {
            switch($k) {
                case "id":
                    $v = $this->filterInt($v, $k, false);
                    if ($v <= 0) {
                        $this->invalid($k);
                    }
                    break;
                case "name":
                    $v = $this->filterHTML($v, $k, true);
                    break;
                case "body":
                    $v = $this->filterHTML($v, $k);
                    break;
                case "mainImg":
                    $v = $this->filterFN($v, $k);
                default: 
                    $v = $this->filterText($v, $k);
            }
    }
    
    protected function filterImage($dirty, $name, $req = false) {
        
    }
    
}
