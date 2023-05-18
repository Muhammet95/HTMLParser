<?php

namespace App\Services;

class URLInfoService extends BaseService
{
    /**
     * @var string
     */
    private string $url;
    /**
     * @var string
     */
    private string $result;

    /**
     * @param string $url
     */
    public function __construct(string $url)
    {
        $this->url = $url;
    }

    /**
     * @return void
     */
    public function handle(): void
    {
        $service = new ParseResponseService($this->url);
        $service->handle();
        $result = json_decode($service->getResult(), true);
        if ($result['status'] === 'error')
            $this->result = json_encode($result);
        else {
            $assoc_array = [];
            foreach ($result['result'] as $tag) {
                if (array_key_exists("$tag>", $assoc_array))
                    $assoc_array["$tag>"] ++;
                else
                    $assoc_array["$tag>"] = 1;
            }

            $this->result = json_encode(['status' => 'success', 'result' => $assoc_array]);
        }
    }

    /**
     * @return string
     */
    public function getResult(): string
    {
        return $this->result;
    }
}