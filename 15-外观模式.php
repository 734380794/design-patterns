<?php

declare(strict_types=1);

/*
 * This file is modified from `xiaohuangniu/26`.
 *
 * @see https://github.com/xiaohuangniu/26
 */

header('Content-type: text/html; charset=utf-8');

/**
 * 动物接口.
 */
interface AnimalInterface
{
    public function Produce(); // 生产方法
}

/**
 * 创建 - 鸡模型.
 */
class ChiCken implements AnimalInterface
{
    public function Produce()
    {
        echo '这是一只鸡~'.PHP_EOL;
    }
}

/**
 * 创建 - 猪模型.
 */
class Pig implements AnimalInterface
{
    public function Produce()
    {
        echo '这是一只猪~'.PHP_EOL;
    }
}

/**
 * 外观类.
 */
class AnimalMaker
{
    private $_chicken; // 鸡模型实例

    private $_pig; // 猪模型实例

    public function __construct()
    {
        $this->_chicken = new Chicken();
        $this->_pig = new Pig();
    }

    /**
     * 生产鸡
     */
    public function produceChicken()
    {
        $this->_chicken->produce();
    }

    /**
     * 生产猪.
     */
    public function producePig()
    {
        $this->_pig->produce();
    }
}

// 初始化外观类
$animalMaker = new AnimalMaker();
// 生产一只猪
$animalMaker->producePig();
// 生产一只鸡
$animalMaker->produceChicken();
