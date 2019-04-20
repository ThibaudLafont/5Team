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

    public function createElement($element)
    {

    }

    public function editElement($element, $values)
    {

    }

    public function removeElement($id)
    {
        $data = $this->getData();
        unset($data[$id]);
        $this->setData($data);
    }

    public function write()
    {
        if(is_null($this->getData())) {
            throw new Exception("Call createElement(), editElement() or removeElement() before calling write()");
        } else {
            file_put_contents($this->getPath(), json_encode($this->getData()));
        }
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
    public function getData()
    {
        // Check if data already been decode
        if(!is_null($this->data)) {
            return $this->data;
        // Else decode, store and return
        } else {
            return $this->setData(
                json_decode(file_get_contents($this->getPath()), true)
            );
        }
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
