<?php

declare(strict_types=1);

/*
 * This file is modified from `xiaohuangniu/26`.
 *
 * @see https://github.com/xiaohuangniu/26
 */

header('Content-type: text/html; charset=utf-8');

/**
 * 单例.
 */
class SingLeton
{
    public $age; // 测试成员

    private static $instance = null; // 创建静态对象变量,用于存储唯一的对象实例

    // 私有化构造函数，防止外部调用
    private function __construct()
    {
    }

    // 私有化克隆函数，防止外部克隆对象
    private function __clone()
    {
    }

    /**
     * 实例化对象方法，供外部获得唯一的对象
     */
    public static function getInstance()
    {
        // 只有第一次调用，才允许创建对象实例
        if (empty(self::$instance)) {
            self::$instance = new SingLeton();
        }

        return self::$instance;
    }
}

$single1 = SingLeton::getInstance();
$single1->age = 22;
echo "未被改变成员属性前，变量1的age:{$single1->age}".PHP_EOL;

$single2 = SingLeton::getInstance();
$single2->age = 24;
echo "被改变成员属性前，变量1的age:{$single1->age}".PHP_EOL;
echo "被改变成员属性前，变量2的age:{$single2->age}".PHP_EOL;
