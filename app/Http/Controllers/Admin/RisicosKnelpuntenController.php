<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RisicosKnelpuntenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Dummy data for Risico's
        $risicos = [
            [
                'id' => 1,
                'titel' => 'Personele wisselingen bij BZK',
                'status' => 'Loopt risico',
                'status_color' => 'yellow',
                'eigenaar' => 'Saïd Ahamri',
                'created_at' => '2025-01-15',
                'updated_at' => '2025-01-20'
            ],
            [
                'id' => 2,
                'titel' => 'Technische uitdagingen API integratie',
                'status' => 'Hoog risico',
                'status_color' => 'red',
                'eigenaar' => 'Jan de Vries',
                'created_at' => '2025-01-10',
                'updated_at' => '2025-01-18'
            ],
            [
                'id' => 3,
                'titel' => 'Budget overschrijding monitoring',
                'status' => 'Gemiddeld risico',
                'status_color' => 'orange',
                'eigenaar' => 'Maria van der Berg',
                'created_at' => '2025-01-12',
                'updated_at' => '2025-01-19'
            ]
        ];

        // Dummy data for Knelpunten
        $knelpunten = [
            [
                'id' => 1,
                'titel' => 'Onduidelijkheid over definitieve PSA',
                'status' => 'Uit de pas',
                'status_color' => 'red',
                'eigenaar' => 'Saïd Ahamri',
                'created_at' => '2025-01-14',
                'updated_at' => '2025-01-21'
            ],
            [
                'id' => 2,
                'titel' => 'Vertraging in documentatie proces',
                'status' => 'Achterstand',
                'status_color' => 'orange',
                'eigenaar' => 'Lisa Bakker',
                'created_at' => '2025-01-08',
                'updated_at' => '2025-01-17'
            ],
            [
                'id' => 3,
                'titel' => 'Coördinatie problemen tussen teams',
                'status' => 'Opgelost',
                'status_color' => 'green',
                'eigenaar' => 'Peter Jansen',
                'created_at' => '2025-01-05',
                'updated_at' => '2025-01-16'
            ]
        ];

        return view('admin.risicos-knelpunten.index', compact('risicos', 'knelpunten'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.risicos-knelpunten.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // TODO: Implement store logic
        return redirect()->route('admin.risicos-knelpunten.index')
            ->with('success', 'Risico/Knelpunt succesvol aangemaakt!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('admin.risicos-knelpunten.show', compact('id'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('admin.risicos-knelpunten.edit', compact('id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // TODO: Implement update logic
        return redirect()->route('admin.risicos-knelpunten.index')
            ->with('success', 'Risico/Knelpunt succesvol bijgewerkt!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // TODO: Implement delete logic
        return redirect()->route('admin.risicos-knelpunten.index')
            ->with('success', 'Risico/Knelpunt succesvol verwijderd!');
    }
}
