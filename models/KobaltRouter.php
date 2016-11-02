<?php
/* A router for the Kobaltkween web app
 * Establishes the particular controllers to  hit
 */
class KobaltRouter extends \Kobalt\SimpleBase\Router {
    
    /* A function to send the request to the right controller for this particular app
     * @return: void
     */ 
    public function routeRequest() {
        // How to deal with ignored paths
        if (in_array($this->urlElements[0], self::$ignore)) {
            header($_SERVER['REQUEST_URI']);
        } else {
            if ($this->urlElements[0] == "admin") {
                $this->controller = "Admin";
                if (count($this->urlElements) == 1 || $this->urlElements[1] == "3d") {
                    $this->controller .= "3D";
                } else if ($this->urlElements[1] == "code") {
                    $this->controller .= "Code";
                }
            } else {
                // Default
                $this->controller = "MainView";
            }  
            $this->controller .= "Controller";
        }
    }
}
