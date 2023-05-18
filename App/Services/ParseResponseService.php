<?php

namespace App\Services;

class ParseResponseService extends BaseService
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
        $service = new ParseRequestService($this->url);
        $service->handle();
        $result = json_decode($service->getResult(), true);
        if ($result['status'] === 'error')
            $this->result = json_encode($result);
        else {
            $page = $result['result'];
            $tags = [];
            $tag = null;
            for ($i = 0; $i < strlen($page); $i ++) {
                if ($page[$i] === '<') {
                    $tag = '<';
                    continue;
                }
                if (ctype_alpha($page[$i]) && ctype_lower($page[$i]) && !empty($tag)) {
                    $tag .= $page[$i];
                    continue;
                }
                if (!empty($tag) && strlen($tag) > 1) {
                    $tags[] = $tag;
                    $tag = null;
                }
                $tag = null;
            }

            $this->result = json_encode(['status' => 'success', 'result' => $tags]);
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