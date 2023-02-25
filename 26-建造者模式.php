<?php

declare(strict_types=1);

/*
 * This file is modified from `xiaohuangniu/26`.
 *
 * @see https://github.com/xiaohuangniu/26
 */

header('Content-type: text/html; charset=utf-8');

/**
 * 实体 - 产品角色 - 汽车.
 */
class Car
{
    public $_head; // 车头
    public $_door; // 车门
    public $_foot; // 车尾

    public function show()
    {
        echo "车头的颜色:{$this->_head}".PHP_EOL;
        echo "车门的颜色:{$this->_door}".PHP_EOL;
        echo "车尾的颜色:{$this->_foot}".PHP_EOL;
    }
}

/**
 * 抽象 - 汽车的建造者.
 */
abstract class CarBuilder
{
    protected $_car; // 汽车实例

    public function __construct()
    {
        $this->_car = new Car();
    }

    abstract public function BuildHead(); // 改变车头颜色

    abstract public function BuildDoor(); // 改变车门颜色

    abstract public function BuildFoot(); // 改变车尾颜色

    abstract public function GetBird(); // 返回汽车实例
}

/**
 * 具体化 - 建造者 - 蓝色宝马
 */
class BlueCar extends CarBuilder
{
    public function BuildHead()
    {
        $this->_car->_head = '蓝色';
    }

    public function BuildDoor()
    {
        $this->_car->_door = '蓝色';
    }

    public function BuildFoot()
    {
        $this->_car->_foot = '蓝色';
    }

    public function GetBird()
    {
        return $this->_car;
    }
}

/**
 * 具体化 - 建造者 - 红色宝马
 */
class RedCar extends CarBuilder
{
    public function BuildHead()
    {
        $this->_car->_head = '红色';
    }

    public function BuildDoor()
    {
        $this->_car->_door = '红色';
    }

    public function BuildFoot()
    {
        $this->_car->_foot = '红色';
    }

    public function GetBird()
    {
        return $this->_car;
    }
}

/**
 * 实体 - 指挥者.
 */
class Director
{
    // 执行改造
    public function Construct($_builder)
    {
        $_builder->BuildHead();
        $_builder->BuildDoor();
        $_builder->BuildFoot();

        return $_builder->GetBird();
    }
}

// 测试
$director = new Director();
echo '蓝色宝马的车辆信息： '.PHP_EOL;
$blue_car = $director->Construct(new BlueCar());
$blue_car->Show();

echo PHP_EOL;

echo '红色宝马的车辆信息： '.PHP_EOL;
$red_car = $director->Construct(new RedCar());
$red_car->Show();
