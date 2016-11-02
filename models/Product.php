<?php
class Product extends \Kobalt\Simplebase\Model {
    
    public function setBase() {
        $this->table = $productTable;
        $this->children = ["Brokerage" => $prodLinkTable, "Software" => $prodSoftTable];
    }
    
    /* A filter input function that's just here to demonstrate how to filter input
     * Specific model subclasses will need to override this to handle particular fields
     * @return: void
     * @throws: FilterExcept (from the filters) or \Exception
     */
    protected function filterInput() {
        foreach ($this->input as $k => $v) {
            if (in_array($k, ["id", "limAmt", "seriesID"]) {
                $v = $this->filterInt($v, $k, false);
                if ($v <= 0 && $k != "limOffset") {
                    $this->invalid($k);
                } 
            } else if ($k == "sort") {
                $v = $this->filterSort($v);
                $this->table->sort = $v;
            } else if ($k == "sortDir") {
                $v = $this->filterSortDir($v);
                $this->table->sortDir = $v;
            } else {
                // Treat everything else as unrequired text
                $v = filterText($v, $k);
            }
            $this->input[$k] = $v;
        }
    }
    
    /* If the series is set, use that as a condition
     * Should parse the relevant input keys and values 
     * And use them to set the condition and values
     */
    protected function setConditions() {
        // See if the appropriate keys are in the input
        if (array_key_exists("seriesID", $this->input)) {
            // Set the cond and condVals as appropriate
            $this->cond = "seriesID = :sID";
            $this->condVals = [$this->input["seriesID"]];
        }
    }
}
