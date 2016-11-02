<?php
/* A controller for the main displays (products and images)
 */
class MainViewController extends \Kobalt\SimpleBase\Controller {
     
    
    /* A basic function for figuring out what the model is based on the smart URL
     * Assumes a relationship such that the endpoint name is plural (s), but the model name is singular
     * This controller is only called if the base isn't admin
     * @return: void
    */
    protected function setMV() {
        // Set the possible models for this controller
        $this->models = ["Page", "Product", "GalleryImage", "Series"];
        // Get the number of endpoints
        $count = count($this->urlElements);
        // Find the base element
        $base = ($count) ? $this->urlElements[0] : null;
        // If we're only one layer in, set up for the code or 3d view
        if ($count <= 1) {
            $this->modelName = "Page";
            // Page parameters
            $this->params["home"] = true;  // Is it a home page
            $this->params["prime"] = false; // Is it a prime example page
            $this->params["lang"] = "html"  // What language is it in
            if ($base && in_array($base, ["3d", "code"])) {
                $viewName = $base . "HomeView"
                $this->params["base"] = $base;
            } else {
                // Default to the 3d home
                $viewName = "3dHomeView";
                $this->params["base"] = 3d;
            }
        } else {
            // If there's more than 1 URL element
            if ($base == "code") {
                $this->modelName = "Page";
                $this->params["base"] = "code";
                $this->params["home"] = false;
                $second = $this->urlElements[1];
                // Set what the values of the prime examples linked from the home page should be
                $primes = ["jscript", "php", "python"];
                // If the second element is one of the main examples
                if (in_array($second, $primes)) {
                    $this->params["prime"] = true;
                    $this->params["lang"] = $second;
                    $viewName = "CodePageView";
                } else {
                    // Assume it's looking at the examples
                    $this->params["prime"] = false;
                    if ($count >= 3 && is_numeric($this->urlElements[3])) {
                        $this->params["id"] = $this->urlElements[3];
                        $viewName = "CodePageView";
                    } else {
                        $viewName = "CodeListView";
                    }
                } 
                
            } else {
                // The default situation is as if the base is "3d"
                $defaultView = "ProductListView";
                // Should only care about first three elements, for instance /3d/products/{id#}
                $modelName = $this->getModelName($this->urlElements[1]);
                // Make sure the modelName is one of the models
                if (in_array($modelName, array_slice($this->models, 1))) {
                    if ($count > 2 && is_numeric($this->urlElements[2])) {
                        // Should be for viewing a particular product, gallery image, or series
                        $this->params["id"] = (int)$this->urlElements[2];
                        if ($modelName == "Product" || $modelName == "GalleryImage") {
                            $viewName = $modelName . "View";
                        } else if ($modelName == "Series") {
                            $viewName = "ProductListView";
                        }
                    } else {
                        // For viewing a list
                        if ($modelName == "GalleryImage") {
                            $viewName = $modelName . "ListView"; // Use the variable for future expansion
                        } else {
                            // Default view
                            $viewName = "ProductListView";
                        }
                    }
                    
                } else {
                    // Default if everything is wrong after the base
                    $modelName = "Product";
                    $view = $defaultView;
                }
            } 
        }
        $this->modelName = $modelName;
        $this->viewName = $viewName;
        $this->model = new $modelName();
        if ($this->format == "html") {
            $this->view = new $viewName();
        } else {
            $this->view = "JSONView";
        }
    }
}
