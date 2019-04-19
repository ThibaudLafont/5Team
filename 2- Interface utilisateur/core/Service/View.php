<?php
namespace Core\Service;

class View {

    // view data
    protected $_data = [];

    /**
     * @param $key
     * @param $value
     *
     * Set variables in $_data for future rendering
     */
    public function __set($key, $value)
    {
        $this->_data[ $key ] = $value;
    }

    /**
     * @param $key
     * @return mixed|null
     *
     * Get data value from key
     */
    public function __get( $key )
    {
        if( array_key_exists($key, $this->_data))
        {
            return $this->_data[ $key ];
        }
        return null;
    }

    /**
     * @param $file
     * @return string
     *
     * Render template from $file path
     */
    public function render($file)
    {
        if( is_file( $file ) )
        {
            $view = $this;
            ob_start();
            include($file);
            return ob_get_clean();
        }
        return 'Template not found: '.$file;
    }
}