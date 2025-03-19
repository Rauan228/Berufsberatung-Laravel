<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function getChartData()
    {
        $type = request('type', 'days'); // Получаем тип графика (days, weeks, months)

        $data = [];
        $labels = [];

        if ($type === 'days') {
            $data = [33, 20, 25, 80, 50, 60, 70];
            $labels = ["Пн", "Вт", "Ср", "Чт", "Пт", "Сб", "Вс"];
        } elseif ($type === 'weeks') {
            $data = [241, 190, 300, 200];
            $labels = ["Неделя 1", "Неделя 2", "Неделя 3", "Неделя 4"];
        } elseif ($type === 'months') {
            $data = [1500, 1200, 1100, 1300, 1400, 1500, 1600, 700, 2300, 1900, 200, 2100];
            $labels = ["Янв", "Фев", "Мар", "Апр", "Май", "Июн", "Июл", "Авг", "Сен", "Окт", "Ноя", "Дек"];
        }

        return response()->json([
            'data' => $data,
            'labels' => $labels
        ]);
    }
}
