<?php

declare(strict_types=1);

/*
 * This file is modified from `xiaohuangniu/26`.
 *
 * @see https://github.com/xiaohuangniu/26
 */

header('Content-type: text/html; charset=utf-8');

/* 产品 */

// 接口 - 兵营
interface Barracks
{
    public function Make(); // 生产
}

// 接口 - 装备库
interface Equipment
{
    public function Make(); // 生产
}

/* 生产士兵 */

// 创建 - 步兵
class Infantry implements Barracks
{
    public function Make()
    {
        echo '，步兵防守! '.PHP_EOL;
    }
}

// 创建 - 骑兵
class Cavalry implements Barracks
{
    public function Make()
    {
        echo '，骑兵冲锋! '.PHP_EOL;
    }
}

/* 生产装备 */

// 创建 - 武器
class Arms implements Equipment
{
    public function Make()
    {
        echo '装备武器，攻击力+100 ';
    }
}

// 创建 - 盔甲
class Nail implements Equipment
{
    public function Make()
    {
        echo '装备盔甲，防御力+50 ';
    }
}

/* 工厂 */

// 接口 - 顶级抽象工厂
interface TopFactory
{
    public function Arms(); // 武器

    public function Nail(); // 盔甲

    public function Go($Barracks); // 士兵执行动作
}

// 具体化 - 工厂A - 该套餐只能装备武器
class A implements TopFactory
{
    // 只有武器
    public function Arms()
    {
        return new Arms();
    }

    // 没有盔甲
    public function Nail()
    {
        return null;
    }

    public function Go($Barracks)
    {
        $A = $this->Arms();
        $N = $this->Nail();
        if ($A) {
            $A->Make();
        }
        if ($N) {
            $N->Make();
        }
        $Barracks->Make();
    }
}

// 具体化 - 工厂B - 该套餐只能装备盔甲
class B implements TopFactory
{
    // 没有武器
    public function Arms()
    {
        return null;
    }

    // 只有盔甲
    public function Nail()
    {
        return new Nail();
    }

    public function Go($Barracks)
    {
        $A = $this->Arms();
        $N = $this->Nail();
        if ($A) {
            $A->Make();
        }
        if ($N) {
            $N->Make();
        }
        $Barracks->Make();
    }
}

// 具体化 - 工厂C - 该套餐什么装备都有，土豪必备
class C implements TopFactory
{
    // 有武器
    public function Arms()
    {
        return new Arms();
    }

    // 有盔甲
    public function Nail()
    {
        return new Nail();
    }

    public function Go($Barracks)
    {
        $A = $this->Arms();
        $N = $this->Nail();
        if ($A) {
            $A->Make();
        }
        if ($N) {
            $N->Make();
        }
        $Barracks->Make();
    }
}

/* 测试 */
$A = new A(); // 套装-1
$B = new B(); // 套装-2
$C = new C(); // 套装-3

$B->Go(new Infantry()); // 步兵使用套装-2
$A->Go(new Cavalry()); // 骑兵使用套装-1
$C->Go(new Cavalry()); // 骑兵使用套装-3
