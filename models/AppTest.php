<?php
/* A class to use when testing the app and autoloading
 */
class AppTest extends \Kobalt\SimpleBase\Test {
    /* A message to display
     * @var string
     */
    public $message = "";
    
    /* Constructor for the Test class
     */
    public function __construct() {
        $this->message .= "An instance of the AppTest class has been created.";
    }
    
    /* Adds another line to the message
     * @param: string
     * @return: void
     * @throws \Exception
     */
    public function addToMessage($text) {
        if (empty($text)) {
            throw new \Exception("Sorry, you need to have some text to add");
        } else {
            $this->message .= "<br>$text<br>";
        }
    }
}
?>
