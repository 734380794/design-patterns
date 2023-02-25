<?php

declare(strict_types=1);

/*
 * This file is modified from `xiaohuangniu/26`.
 *
 * @see https://github.com/xiaohuangniu/26
 */

header('Content-type: text/html; charset=utf-8');

/**
 * 接口 - 技能设定.
 */
interface IProduct
{
    public function Attack(); // 攻击

    public function Defense(); // 防御
}

/**
 * 创建 - 步兵.
 */
class XPinfantry implements IProduct
{
    public function Attack()
    {
        echo '步兵进攻，攻击力：10~ '.PHP_EOL;
    }

    public function Defense()
    {
        echo '步兵防守，防御力：20~ '.PHP_EOL;
    }
}

/**
 * 创建 - 骑兵.
 */
class XPcavalry implements IProduct
{
    public function Attack()
    {
        echo '骑兵进攻，攻击力：30~ '.PHP_EOL;
    }

    public function Defense()
    {
        echo '骑兵防守，防御力：5~ '.PHP_EOL;
    }
}

/**
 * 工厂角色.
 */
class ProductFactory
{
    public static function GetInstance($style)
    {
        switch ($style) {
            case 1: // 创建步兵
                return new XPinfantry();
                break;
            case 2: // 创建骑兵
                return new XPcavalry();
                break;
            default:
                return null;
        }
    }
}

$obj = [];
$obj[] = ProductFactory::GetInstance(1); // 生产一个步兵
$obj[] = ProductFactory::GetInstance(2); // 生产一个骑兵
$obj[] = ProductFactory::GetInstance(3); // 生产错了
$obj[] = ProductFactory::GetInstance(2); // 生产一个骑兵

foreach ($obj as $val) {
    if ($val) {
        $val->Attack(); // 进攻
        $val->Defense(); // 防守
    } else {
        echo '暂无该类兵种！'.PHP_EOL;
    }
}
