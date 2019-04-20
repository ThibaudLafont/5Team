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
     * Store decoded json
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

    /**
     * @param $id
     *
     * Remove element with given Id from $this->data
     */
    public function removeElement($id)
    {
        $data = $this->getData();
        unset($data[$id]);
        $this->setData($data);
    }

    /**
     * Write $this->data as json string in $this->getPath file
     */
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
     *
     * Return JSON file path
     */
    private function getPath(): string
    {
        return $this->path;
    }

    /**
     * @param string $path
     *
     * Set JSON file path
     */
    private function setPath(string $path): void
    {
        $this->path = $path;
    }

    /**
     * @return array
     *
     * If $this->data is not defined, inquire it from $this->path file
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
     *
     * Set $this->data from array
     */
    private function setData(array $data): array
    {
        $this->data = $data;
        return $this->data;
    }
}
