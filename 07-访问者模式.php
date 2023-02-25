<?php

declare(strict_types=1);

/*
 * This file is modified from `xiaohuangniu/26`.
 *
 * @see https://github.com/xiaohuangniu/26
 */

header('Content-type: text/html; charset=utf-8');

/**
 * 抽象出 实体类.
 */
abstract class Entity
{
    public $people_name; // 人的名称

    /**
     * 触发行为
     * $Visitor 对应行为的实例.
     * @param  mixed  $Visitor
     */
    abstract public function Accept($Visitor);
}

/**
 * 创建一个 男性.
 */
class VMan extends Entity
{
    public function __construct()
    {
        $this->people_name = '男人';
    }

    public function Accept($Visitor)
    {
        $Visitor->VManRelease($this);
    }
}

/**
 * 创建一个 女性.
 */
class VWoman extends Entity
{
    public function __construct()
    {
        $this->people_name = '女人';
    }

    public function Accept($Visitor)
    {
        $Visitor->VWomanRelease($this);
    }
}

/**
 * 抽象出 行为类.
 */
abstract class Behavior
{
    protected $bh_name;

    /**
     * 行为逻辑 - 男性
     * $ResNew 对应实体的实例.
     * @param  mixed  $ResNew
     */
    abstract public function VManRelease($ResNew);

    /**
     * 行为逻辑 - 女性
     * $ResNew 对应实体的实例.
     * @param  mixed  $ResNew
     */
    abstract public function VWomanRelease($ResNew);
}

/**
 * 创建一个 吃东西行为.
 */
class Eat extends Behavior
{
    public function __construct()
    {
        $this->bh_name = '吃东西';
    }

    public function VManRelease($VMan)
    {
        echo "{$VMan->people_name} : {$this->bh_name}时，都很粗鲁。".PHP_EOL;
    }

    public function VWomanRelease($VMan)
    {
        echo "{$VMan->people_name} : {$this->bh_name}时，都很斯文。".PHP_EOL;
    }
}

/**
 * 创建一个 运动行为.
 */
class Motion extends Behavior
{
    public function __construct()
    {
        $this->bh_name = '运动';
    }

    public function VManRelease($VMan)
    {
        echo "{$VMan->people_name} : {$this->bh_name}时，大汗淋漓。".PHP_EOL;
    }

    public function VWomanRelease($VMan)
    {
        echo "{$VMan->people_name} : {$this->bh_name}时，休闲漫步。".PHP_EOL;
    }
}

/**
 * 设计一个 结构对象类，用于聚合实体信息.
 */
class Object
{
    private $entity = []; // 存储实体对象

    // 新增实体
    public function Add($entity)
    {
        array_push($this->entity, $entity);
    }

    // 移除实体
    public function Remove($entity)
    {
        foreach ($this->entity as $k => $v) {
            if ($v == $entity) {
                unset($this->entity[$k]);
                break;
            }
        }
    }

    // 查看对应行为描述
    public function Display($Visitor)
    {
        foreach ($this->entity as $v) {
            $v->Accept($Visitor);
        }
    }
}

// 先聚合实体
$os = new Object();
$os->Add(new VMan());
$os->Add(new VWoman());

// 查看吃东西的行为
$os->Display(new Eat());
// 查看运动的行为
$os->Display(new Motion());
