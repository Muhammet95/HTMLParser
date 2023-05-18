<?php

namespace App\Services;

class ParseRequestService extends BaseService
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
     * @var array - Заголовки запроса.
     */
    private array $headers;

    /**
     * @var string - User-Agent для запросов.
     */
    private string $user_agent = 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36';

    private array $curl_configs;


    /**
     * @param string $url
     */
    public function __construct(string $url)
    {
        $this->url = $url;
        $this->headers = array(
            'Accept: text/javascript, application/javascript, application/ecmascript, application/x-ecmascript, */*; q=0.01',
            'Accept-Language: ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7',
            'X-Requested-With: XMLHttpRequest'
        );

        $this->curl_configs = array(
            # Устанавливаем Uri для выполнения метода
            CURLOPT_URL => $url,
            # Возвращает заголовки
            CURLOPT_HEADER => false,
            # Возвращает результат в переменную, а не выводит на экран
            CURLOPT_RETURNTRANSFER => true,
            # Устанавливаем максимальное время подключения к серверу
            CURLOPT_CONNECTTIMEOUT => 60,
            # Устанавливаем максимальное время ожидания ответа от сервера
            CURLOPT_TIMEOUT => 60,
            # Устанавливаем автоматическое определение Referer
            CURLOPT_AUTOREFERER => true,
            # Устанавливаем автоматические редиректы
            CURLOPT_FOLLOWLOCATION => true,
            # Устанавливаем максимальное допустимое кол-во редиректов
            CURLOPT_MAXREDIRS => 5,
            # Устанавливаем кодировку
            CURLOPT_ENCODING => "gzip, deflate",
            # Настраиваем SSL
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            # Устанавливаем User-Agent
            CURLOPT_USERAGENT => $this->user_agent,
            # Устанавливаем заголовки запроса
            CURLOPT_HTTPHEADER => $this->headers
        );
    }

    /**
     * @return void
     */
    public function handle(): void
    {
        $curl = curl_init();
        curl_setopt_array($curl, $this->curl_configs);
        $result = curl_exec($curl);
        $errorCount = curl_errno($curl);
        curl_close($curl);

        if ($errorCount > 0)
            $this->result = json_encode(['status' => 'error', 'result' => 'Возникли ошибки при попытке спрасить источник']);
        else
            $this->result = json_encode(['status' => 'success', 'result' => $result]);
    }

    /**
     * @return string
     */
    public function getResult(): string
    {
        return $this->result;
    }
}