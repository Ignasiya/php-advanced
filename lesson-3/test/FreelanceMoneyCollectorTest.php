<?php

namespace AppUnitTests;

use App\FreelanceMoneyCollector;
use Exception;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use PHPUnit\Runner\DeprecationCollector\Collector;

class FreelanceMoneyCollectorTest extends TestCase 
{
    public function testEarnMoney(): void 
    {
        $collector = new FreelanceMoneyCollector('Александр');
        $collector->earnMoney(11000);

        $result = $collector->withdrawMoney();

        static::assertSame('Александр заработал 11000 руб. на фрилансе.', $result, 'Александр должен был вывести 11000 руб.');
    }

    #[DataProvider('someDataProvider')]
    public function testEarnMoneyWithDataProvider(string $name, array $collected, int $expectedCollectedAmount): void
    {
        $collector = new FreelanceMoneyCollector($name);
        foreach ($collected as $item) {
            $collector->earnMoney($item);
        }

        $result = $collector->withdrawMoney();

        static::assertSame("$name заработал $expectedCollectedAmount руб. на фрилансе.", $result);
    }

    public static function someDataProvider(): array 
    {
        return [
            'Василий' => ['Василий', [20000, 4400], 24400],
            'Михаил' => ['Михаил', [15000, 0], 15000],
            'Алексей' => ['Алексей', [15000, 3300, 50000, 13000], 81300]
        ];
    }

    public function testEarnTooMuchMoney() : void 
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('/^Роман/');   
        
        $collector = new FreelanceMoneyCollector('Роман');
        $collector->earnMoney(1000001);

        $result = $collector->withdrawMoney();
    }
}