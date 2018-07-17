<?php
/**
 * Created by PhpStorm.
 * User: xiao
 * Date: 2018/1/12
 * Time: 15:28
 */

namespace CommonModule\Utils;


class NetUtils
{
    const G = 'GET';                                    // GET请求
    const P = 'POST';                                   // POST请求

    /**
     * CURL 的GET请求
     * @param $url @请求地址
     * @param null $data @请求参数
     * @return mixed                @请求的返回值
     */
    public static function GET($url, $data = null)
    {
        // 1. 生成浏览器
        $ch = curl_init();

        // 2. 设置浏览器
        $url = self::joinUrl($url, $data);

        curl_setopt($ch, CURLOPT_URL, $url);                    // 访问地址

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);         // 希望请求成功后 XX以html文档流(html字符串的形式)返回

        curl_setopt($ch, CURLOPT_HEADER, 0);

        // 3. 执行
        $str = curl_exec($ch);
        // 4. 关闭浏览器
        curl_close($ch);

        //把请求的数据进行返回
        return $str;
    }


    /**
     * CURL 的post请求
     * @param $url
     * @param null $data
     * @param null $header
     * @return mixed
     */
    public static function POST($url, $data = null, $header = null)
    {
        // 1. 生成浏览器
        $ch = curl_init();

        // 2. 设置配置信息

        curl_setopt($ch, CURLOPT_URL, $url);                    // 访问地址

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);         // 希望请求成功后 XX以html文档流(html字符串的形式)返回

        if (!empty($header)) @curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

        if (is_array($data)) $data = http_build_query($data);

        @curl_setopt($ch, CURLOPT_POST, true);
        @curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        // 3. 执行
        $str = curl_exec($ch);

        // 4. 关闭浏览器
        curl_close($ch);
        //把请求的数据进行返回
        return $str;
    }


    /**
     * 链接拼接
     * @param string $url
     * @param string $options key1=value1&key2=value2
     * @return string
     */
    public static function joinUrl($url = '', $options = null)
    {
        $result = $url;

        if (is_array($options)) $options = http_build_query($options);

        if (empty($options)) return $result;

        if (strrpos($result, '?')) {

            $result .= '&' . $options;

        } else {

            $result .= '?' . $options;

        }
        return $result;
    }


}