<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\View;
class CachedPageController extends Controller
{
    public function index()
    {
        // Попытка получения кэшированной HTML-страницы
        $cachedPage = Redis::get('cached_page');

        if ($cachedPage) {
            return $cachedPage;
        }

        // Генерация HTML-страницы с использованием Blade-шаблона
        $page = View::make('index');

        // Сохранение в Redis с временем жизни 1 час
        Redis::setex('cached_page', 3600, $page->render());
        
        return $page;
    }
}