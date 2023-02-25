<?php

declare(strict_types=1);

/*
 * This file is modified from `xiaohuangniu/26`.
 *
 * @see https://github.com/xiaohuangniu/26
 */

header('Content-type: text/html; charset=utf-8');

/**
 * 接口 - 数据库.
 */
interface DataBase
{
    public function Connect(); // 链接数据库

    public function Select(); // 查询操作
}

/**
 * 实现两种数据库操作类.
 */
class Mysql implements DataBase
{
    // 链接数据库
    public function Connect()
    {
        echo '链接Mysql '.PHP_EOL;
    }

    // 查询操作
    public function Select()
    {
        echo '查询Mysql '.PHP_EOL;
    }
}

class Oracle implements DataBase
{
    // 链接数据库
    public function Connect()
    {
        echo '链接Oracle '.PHP_EOL;
    }

    // 查询操作
    public function Select()
    {
        echo '查询Oracle '.PHP_EOL;
    }
}

/**
 * 实现适配器 - 使用组件切换的模式，达到适配效果
 * 注意：适配器也应该继承与 对应适配类的接口.
 */
class Adapter implements DataBase
{
    private $DataBase; // 数据库操作的实例 - 也就是组件操作的实例

    public function __construct($DataBase)
    {
        $this->DataBase = $DataBase;
    }

    // 根据适配器调用对应的方法
    public function Connect()
    {
        $this->DataBase->Connect();
    }

    public function Select()
    {
        $this->DataBase->Select();
    }
}

// 实例化适配器，并传入Mysql组件
$obj = new Adapter(new Mysql());
$obj->Connect();
$obj->Select();

// 实例化适配器，并传入Oracle组件
$obj = new Adapter(new Oracle());
$obj->Connect();
$obj->Select();
