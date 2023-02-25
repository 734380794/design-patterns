<?php

declare(strict_types=1);

/*
 * This file is modified from `xiaohuangniu/26`.
 *
 * @see https://github.com/xiaohuangniu/26
 */

header('Content-type: text/html; charset=utf-8');

/**
 * 抽象出通知者类.
 */
abstract class Subject
{
    private $observers = []; // 用户保存观察成员

    // 添加观察成员
    public function Attach($observer)
    {
        array_push($this->observers, $observer);
    }

    // 删除观察成员
    public function Detach($observer)
    {
        foreach ($this->observers as $k => $v) {
            if ($v == $observer) {
                unset($this->observers[$k]);
            }
        }
    }

    // 向观察成员群发消息
    public function Notify()
    {
        foreach ($this->observers as $v) {
            $v->Update();
        }
    }
}

// 具体通知者（Boss和Secretary）
class ConcreteSubject extends Subject
{
    public $subject_state; // 推送的内容
}

// 抽象观察者
abstract class Observer
{
    abstract public function Update();
}

// 具体观察者
class ConcreteObserver extends Observer
{
    public $subject; // 通知者实例，作用是保证大家都在同一频道内

    private $name; // 观察者名称

    private $observerState; // 保存通知者推送过来的内容

    // 初始化成员属性
    public function __construct($_sub, $_name)
    {
        $this->subject = $_sub;
        $this->name = $_name;
    }

    // 输出推送的内容
    public function Update()
    {
        $this->observerState = $this->subject->subject_state;
        echo '观察者：'.$this->name.'接受到的内容是:'.$this->observerState.PHP_EOL;
    }
}

// 实例化一个频道
$A = new ConcreteSubject();

// 添加两个观察者 - 并加入同一频道
$zs = new ConcreteObserver($A, '张三');
$ls = new ConcreteObserver($A, '李四');

// 让两个观察者获得接受数据推送的权限
$A->Attach($zs);
$A->Attach($ls);

// 注入推送内容
$A->subject_state = 'I Love You 小黄牛！';

// 推送消息
$A->Notify();
