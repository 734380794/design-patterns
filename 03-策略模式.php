<?php

declare(strict_types=1);

/*
 * This file is modified from `xiaohuangniu/26`.
 *
 * @see https://github.com/xiaohuangniu/26
 */

header('Content-type: text/html; charset=utf-8');

/**
 * 抽象策略类
 * 派生出相关的算法和行为.
 */
abstract class RotateItem
{
    // 暂定2个
    abstract public function Algorithm();

    abstract public function Behavior();
}

/**
 * 策略角色类 - 算法1.
 */
class AItem extends RotateItem
{
    public function Algorithm()
    {
        echo '算法1：我爱计算，头脑好好！'.PHP_EOL;
    }

    public function Behavior()
    {
        echo '算法1：我爱洗澡，皮肤好好！'.PHP_EOL;
    }
}

/**
 * 策略角色类 - 算法2.
 */
class BItem extends RotateItem
{
    public function Algorithm()
    {
        echo '算法2：我爱计算，头脑好好！'.PHP_EOL;
    }

    public function Behavior()
    {
        echo '算法2：我爱洗澡，皮肤好好！'.PHP_EOL;
    }
}

/**
 * 环境角色类 - 通过这个类调用对应的策略算法.
 */
class ContextItem
{
    // 用户存储一个策略类的引用，最终返还给客户端调用。
    private $item;

    public function getItem($item_name, $fun_name)
    {
        // 1、通过系统 ReflectionClass方法获得类的各项参数
        $class = new ReflectionClass($item_name);
        // 2、再通过系统 newInstance方法实例化一个类
        $this->item = $class->newInstance();
        // 3、根据方法名调用对应的算法或行为
        $this->item->{$fun_name}();
    }
}

// 实例DEMO
$obj = new ContextItem();
$obj->getItem('BItem', 'Algorithm');
$obj->getItem('AItem', 'Behavior');
