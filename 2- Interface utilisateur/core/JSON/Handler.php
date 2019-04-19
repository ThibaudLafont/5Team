<?php
namespace Core\JSON;

class Handler
{

    /**
     * @var string
     */
    private $path;

    /**
     * @var array
     *
     * Used to store decoded json
     */
    private $data;

    public function __construct(string $path)
    {
        $this->setPath($path);
    }

    public function extract()
    {
        // Check if data already been decode
        if(!is_null($this->getData())) {
            return $this->getData();
        // Else decode, store and return
        } else {
            return $this->setData(
                json_decode(file_get_contents($this->getPath()), true)
            );
        }
    }

    public function createElement($element)
    {

    }

    public function editElement($element, $values)
    {

    }

    public function removeElement($element)
    {

    }

    private function write()
    {

    }

    /**
     * @return string
     */
    private function getPath(): string
    {
        return $this->path;
    }

    /**
     * @param string $path
     */
    private function setPath(string $path): void
    {
        $this->path = $path;
    }

    /**
     * @return array
     */
    private function getData()
    {
        return $this->data;
    }

    /**
     * @param array $data
     * @return array
     */
    private function setData(array $data): array
    {
        $this->data = $data;
        return $this->data;
    }

}
