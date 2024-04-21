<?php
$memcached = new Memcached();
$memcached->connect('localhost', 11211);

//неатомарный вариант
$count = $memcached->get('count');
$count++;
$memcached->set('count', $count);

// атомарный вариант
$memcached->increment('count');

// запись только в случае неизменного значения(имитация атомарности)
$result = $memcached->get('some_key', null, Memcached::GET_EXTENDED);
$value = $result['value'];
$cas = $result['cas'];
$newValue = calcNewValue($value);
if (($memcached->cas($cas, 'some_key', $newValue) === false) &&
    ($memcached->getResultCode() === Memcached::RES_DATA_EXISTS)) {

    //Делаем что-то (повторяем попытку, например)
}