<?php
class 3dHomeView extends \Kobalt\SimpleBase\View {
    
    /* Setting the components of the /3d/ view
     * The UI and CSS directory constants should be defined in your application's init file
     * @return: void
     */
    public function buildPage() {
        // Set the css
        $this->css = CSS_DIR . "home.css";
        // The title of the page
        $this->title = $this->data->name
        $this->frame3D();
    
        if ($this->code <= 300) {
            $this->body = UI_DIR . "3dHomeBody.php";
        } else {
            $this->body = UI_DIR . "error.php";
        }
        // Put all of the elements into an array for easy rendering
        $this->parts = [$this->header, $this->nav, $this->body, $this->footer];
    }
    
    protected function frame3D() {
        $this->header = UI_DIR . "3dheader.php";
        $this->footer = UI_DIR . "3dfooter.php";
    }    
}
