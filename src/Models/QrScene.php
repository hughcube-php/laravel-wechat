<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2022/3/3
 * Time: 18:32
 */

namespace HughCube\Laravel\WeChat\Models;

use Exception;
use Illuminate\Support\Str;

/**
 * @see https://developers.weixin.qq.com/doc/offiaccount/Account_Management/Generating_a_Parametric_QR_Code.html
 */
class QrScene
{
    /**
     * @var string|int|null
     */
    protected $type;

    /**
     * @var string|int
     */
    protected $value;

    /**
     * @param  string|int  $value
     * @param  string|int|null  $type
     */
    public function __construct($value, $type = null)
    {
        $this->type = $type;
        $this->value = $value;
    }

    /**
     * @param  string|int  $value
     * @param  string|int|null  $type
     * @return static
     */
    public static function new($value, $type = null): QrScene
    {
        $class = static::class;
        return new $class($value, $type);
    }

    /**
     * @param  mixed  $data
     * @return null|static
     */
    public static function create($data): ?QrScene
    {
        if (is_int($data) || (is_numeric($data) && ctype_digit(strval($data)))) {
            return static::new($data);
        }

        if (!is_string($data)) {
            return null;
        }

        $scene = $data;
        if (Str::startsWith($scene, 'qrscene_')) {
            $scene = Str::afterLast($data, 'qrscene_');
        }

        if (!Str::contains($scene, ':')) {
            return static::new($scene);
        }

        $items = explode(':', $scene, 2);
        return static::new($items[1], $items[0]);
    }

    /**
     * @return string|int|null
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return string|int
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return string
     * @throws Exception
     */
    public function toString(): string
    {
        if (null === $this->getType()) {
            $string = strval($this->getValue());
        } else {
            $string = sprintf('%s:%s', $this->getType(), $this->getValue());
        }

        if (64 < strlen($string) || empty($string)) {
            throw new Exception('The value is a string of 1 to 64 characters');
        }

        return $string;
    }

    /**
     * @return string
     * @throws Exception
     */
    public function __toString()
    {
        return $this->toString();
    }
}
