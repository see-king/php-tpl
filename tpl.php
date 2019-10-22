<?php
/**
 * Elementary templating class.
 * Either create an instance of the class and use render() method to return html, or use static method tpl::html()
 * 
 * Example 1:
 * $tpl = new tpl( "/path/to/file.html", ["title" => "Homepage", "url" => "/" ]); 
 * echo $tpl->render();
 * 
 * Example 2:
 * echo tpl::html("/path/to/file.html", ["title" => "Homepage", "url" => "/" ]);
 * 
 * You can also add data to object or change file path:
 * $tpl->data["subtitle"] = "The site homepage";
 * $tpl->filePath = "/path/to/some/other/file.html";
 * 
 * data and filePath properties are public, so user discretion is required (though, there's a try/catch wrap around action part)
 * 
 * 
 */
namespace SeeKing\tpl;

class tpl {

    /**
     * @var string Path to template file.
     */
    public $filePath = null;

    /**
     * @var mixed[] Data to render in template.
     */
    public $data = array();

    /**
     * @param string $file
     * @param string[] $data Associated array of data to render in template
     */
    function __construct( $file = null, $data = array() ){
        $this->filePath = $file;
        $this->data = $data;
    }

    /**
     * Renders the template file in filePath property with data from data property.
     * @return string Rendered template text
     */
    function render(){
        $html = "";
        try {
            // extract data (skipping the existing values for security purpose (meaning paranoia, of course) )
            extract($this->data, EXTR_SKIP);
            ob_start();
            include($this->filePath);
            $html = ob_get_clean();            
        } catch (Exception $e ){
            $html = $e->getMessage();
        }

        return $html;
    }

    /**
     * Renders given template file with passed data.
     * Call statically with path to file and array data as parameters
     * Example:  tpl::html('path/to/file.html', ['value1'=> 12, 'value2' => 'something'])
     * @param string $file  Path to template file to render
     * @param string[] $data Associated array of data to render in template
     * @return string Rendered template text  
     */
    static function html( $file, $data ){
        $tpl = new self($file, $data);
        $html = $tpl->render();
        unset($tpl); 
        return $html;
    }
}