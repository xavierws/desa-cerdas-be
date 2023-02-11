<?php

namespace App\Http\Controllers\api\profile;

use App\Actions\helpers\BudgetHelper;
use App\Actions\SendResponse;
use App\Http\Controllers\Controller;
use App\Models\Budget;
use Illuminate\Http\Request;

class BudgetController extends Controller
{
    public function store(Request $request)
    {
        if ($request->input('category') === 'pendapatan') {
            $categoryId = 1;
        } elseif ($request->input('category') === 'belanja') {
            $categoryId = 2;
        } else {
            $categoryId = 3;
        }

        $budgets = [];
        $totalCost = 0;

        foreach ($request->input('apbdes_data') as $apbdes) {
            $budget = Budget::create([
                'name' => $apbdes['name'],
                'description' => $apbdes['description'],
                'year' => $request->input('year'),
                'cost' => $apbdes['cost'],
                'category_id' => $categoryId,
            ]);

            $budgets[] = $budget;
            $totalCost += $apbdes['cost'];
        }

        return SendResponse::handle([
            'total_cost' => $totalCost,
            'apbdes' => $budgets
        ], 'apbdes berhasil dibuat');
    }

    public function index(Request $request)
    {
        $categoryId = BudgetHelper::idCategory($request->query('category'));

        $budgets = Budget::query()->where([
            ['year', $request->query('year')],
            ['category_id', $categoryId]
        ])->get();

        $count = Budget::query()->where([
            ['year', $request->query('year')],
            ['category_id', $categoryId]
        ])->count();

        $i = 0;
        $totalCost = BudgetHelper::countTotalCost($budgets);
        foreach ($budgets as $budget) {
            $percentage = BudgetHelper::countPercentage($budget->cost, $totalCost);
            $budgets[$i]['percentage'] = $percentage;
            $budgets[$i]['color'] = BudgetHelper::pickDiagramColor($i);

            $i++;
        }

        return SendResponse::handle([
            'total_cost' => $totalCost,
            'apbdes' => $budgets
        ], 'data berhasil diambil');
    }
}
