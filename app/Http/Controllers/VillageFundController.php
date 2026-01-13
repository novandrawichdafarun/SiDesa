<?php

namespace App\Http\Controllers;

use App\Models\FundCategory;
use App\Models\FundTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class VillageFundController extends Controller
{
    public function index(Request $request)
    {
        $year = $request->input('year', date('Y'));

        //? Ambil data kategori berdasarkan tahun
        $categories = FundCategory::with('transactions')
            ->where('fiscal_year', $year)
            ->orderBy('created_at', 'desc')
            ->get();

        if ($categories->isEmpty()) {
            $categories = collect([]);
        }

        //? Hitung Ringkasan
        $totalIncomePlanned = $categories->where('type', 'income')->sum('budget_cap');
        $totalIncomeRealized = $categories->where('type', 'income')->sum('realized_amount'); //! Menggunakan accessor model

        $totalExpensePlanned = $categories->where('type', 'expense')->sum('budget_cap');
        $totalExpenseRealized = $categories->where('type', 'expense')->sum('realized_amount');

        return view('pages.funds.index', compact(
            'categories',
            'year',
            'totalIncomePlanned',
            'totalIncomeRealized',
            'totalExpensePlanned',
            'totalExpenseRealized'
        ));
    }

    public function storeCategory(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:income,expense',
            'fiscal_year' => 'required|integer|digits:4',
            'budget_cap' => 'required|numeric|min:0',
            'description' => 'nullable|string'
        ]);

        FundCategory::create($validated);

        return redirect('/funds')->with('success', 'Pos Anggaran berhasil ditambahkan.');
    }

    public function updateCategory(Request $request, $id)
    {
        $category = FundCategory::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'budget_cap' => 'required|numeric|min:0',
            'description' => 'nullable|string'
        ]);

        $category->update($validated);

        return redirect('/funds')->with('success', 'Pos Anggaran berhasil diperbarui.');
    }

    public function destroyCategory($id)
    {
        $category = FundCategory::findOrFail($id);
        $category->delete(); //! Transaksi terkait akan terhapus otomatis karena onDelete cascade di migration

        return redirect('/funds')->with('success', 'Pos Anggaran berhasil dihapus.');
    }

    public function storeTransaction(Request $request)
    {
        $validated = $request->validate([
            'fund_category_id' => 'required|exists:fund_categories,id',
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'transaction_date' => 'required|date',
            'proof_file' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Max 2MB
            'description' => 'nullable|string'
        ]);

        //? Handle File Upload
        if ($request->hasFile('proof_file')) {
            $path = $request->file('proof_file')->store('fund-proofs', 'public');
            $validated['proof_file'] = $path;
        }

        //? Tambahkan user_id otomatis dari yang login
        $validated['user_id'] = Auth::id();

        FundTransaction::create($validated);

        return redirect('/funds')->with('success', 'Transaksi berhasil dicatat.');
    }

    public function destroyTransaction($id)
    {
        $transaction = FundTransaction::findOrFail($id);

        //? Hapus file bukti jika ada
        if ($transaction->proof_file) {
            Storage::disk('public')->delete($transaction->proof_file);
        }

        $transaction->delete();

        return redirect('/funds')->with('success', 'Transaksi berhasil dihapus.');
    }
}
