<?php

declare(strict_types=1);

/*
 * This file is modified from `xiaohuangniu/26`.
 *
 * @see https://github.com/xiaohuangniu/26
 */

header('Content-type: text/html; charset=utf-8');

/**
 * 抽象出处理者类.
 */
abstract class Manager
{
    protected $name; // 处理者名称

    protected $manager; // 上级处理者的实例

    // 设置上级处理者名称
    public function __construct($_name)
    {
        $this->name = $_name;
    }

    // 设置上级处理者
    public function SetHeader($_new)
    {
        $this->manager = $_new;
    }

    /**
     * 处理业务申请
     * $RegNew 是一个业务申请内容的实例.
     * @param  mixed  $RegNew
     */
    abstract public function Apply($RegNew);
}

/**
 * 创建一个CEO处理者.
 */
class Ceo extends Manager
{
    // 调用父类构造函数，申明处理者名称
    public function __construct($_name)
    {
        parent::__construct($_name);
    }

    // 处理业务申请内容
    public function Apply($RegNew)
    {
        // 处理申请
        if ($RegNew->requestType == '请假' && $RegNew->num >= 2) {
            echo "{$this->name} : 请假时间 {$RegNew->num} 天，已超过公司制度，不允批准。".PHP_EOL;

            return true;
        }
        // 判定是否存在上级处理者，是则向上级提交
        if (isset($this->manager)) {
            $this->manager->Apply($RegNew);
        }
    }
}

/**
 * 创建一个 人事处理者.
 */
class Personnel extends Manager
{
    // 调用父类构造函数，申明处理者名称
    public function __construct($_name)
    {
        parent::__construct($_name);
    }

    // 处理业务申请内容
    public function Apply($RegNew)
    {
        // 处理申请
        if ($RegNew->requestType == '请假' && $RegNew->num >= 2) {
            echo "{$this->name} : 请假时间 {$RegNew->num} 天，超过公司制度，但事发突然，建议可允批准。".PHP_EOL;
        }
        // 判定是否存在上级处理者，是则向上级提交
        if (isset($this->manager)) {
            $this->manager->Apply($RegNew);
        }
    }
}

/**
 * 模拟一个 业务实例.
 */
class Request
{
    public $num; // 请假天数

    public $requestType; // 业务类型
}

// 实例化所有处理者
$Boss = new Ceo('张总');
$Rens = new Personnel('人事经理');

// 设置上级处理者， CEO在业务总是顶级， 而人事经理的上级则是直属与CEO，所以我们只需要设置一下人事经理的上级处理者即可
$Rens->SetHeader($Boss);

// 向人事部递交一份申请
$res = new Request();
$res->requestType = '请假';
$res->num = 2;
$Rens->Apply($res);
