<?php

namespace AppUnitTests;

use PHPUnit\Framework\TestCase;
use App\Worker;
use App\FreelanceMoneyCollector;
use App\FreelanceMoneyCollectorInterface;
use App\DummyFreelanceMoneyCollector;
use App\FakeFreelanceMoneyCollector;

class WorkerTest extends TestCase 
{
    public function testWorkCallEarnMoney()
    {
        //Prophecy
        $spy = $this->prophesize(FreelanceMoneyCollector::class);
        $repo = $spy->reveal();
        $worker = new Worker($repo, 500);

        $worker->work(1);

        $spy->earnMoney(500)->shouldHaveBeenCalledOnce();

        // Mockery
        $spy = \Mockery::spy(FreelanceMoneyCollector::class);
        $worker = new Worker($spy, 500);

        $worker->work(1);

        $spy->shouldHaveReceived('earnMoney');
    }

    public function testWorkSendCorrectAmountToEarnMoney()
    {
        // Prophecy
        $mock = $this->getMockBuilder(FreelanceMoneyCollector::class)
            ->disableOriginalConstructor()
            ->getMock();

        // arrange    
        $mock->expects($this->once())
            ->method('earnMoney')
            ->with(500);
        
        $worker = new Worker($mock, 500);

        // act
        $worker->work(1);

        // Mockery
        $mock = \Mockery::mock(FreelanceMoneyCollector::class);
        $mock->shouldReceive('earnMoney')
            ->with(500)
            ->once();

        $worker = new Worker($mock, 500);

        $worker->work(1);

        $mock->shouldHaveReceived('earnMoney')
            ->with(500)
            ->once();
    }

    public function testGoHomeCallWithdrawMoney()
    {
        // Dummy
        $stub = new DummyFreelanceMoneyCollector();

        // Fake
        $stub = new FakeFreelanceMoneyCollector();

        // Stub Prophecy
        $stub = $this->createMock(FreelanceMoneyCollectorInterface::class);
        $stub->method('withdrawMoney')->willReturn('Какой-то текст');

        // Stub Mockery
        $stub = \Mockery::mock(FreelanceMoneyCollectorInterface::class);
        $stub->shouldReceive('withdrawMoney')->andReturn('Какой-то текст');

        $worker = new Worker($stub, 500);

        $result = $worker->goHome();

        $this->assertStringContainsString("Это был тяжелый день.", $result);
    }
}