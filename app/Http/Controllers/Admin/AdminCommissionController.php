<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Support\Str;

class AdminCommissionController extends Controller
{
    /**
     * Seed initial products if DB is empty or missing user request products
     */
    private function ensureInitialProductsExist()
    {
        try {
            $defaultProducts = [
                ['name' => 'Tài Khoản Kiro AI Pro Giá Rẻ - 1000 credit', 'price' => 340000],
                ['name' => 'Tài Khoản Wink SVIP 1 Tháng', 'price' => 135000],
                ['name' => 'Nâng cấp tài khoản ChatGPT Plus', 'price' => 450000],
                ['name' => 'VEO3 Ultra Slot 12 Tháng', 'price' => 4200000],
                ['name' => 'VEO3 Ultra Slot 1 Tháng', 'price' => 590000],
                ['name' => 'ExpressVPN Premium 3 Ngày', 'price' => 30000],
                ['name' => 'Tài Khoản NORD VPN', 'price' => 269000],
                ['name' => 'Tài Khoản ElevenLabs Creator', 'price' => 230000],
                ['name' => 'Tài Khoản NordVPN 7 Ngày', 'price' => 35000],
                ['name' => 'Tài Khoản Zoom Pro 1 Tháng', 'price' => 79000],
                ['name' => 'Tài Khoản Meitu VIP 1 Tháng', 'price' => 250000],
                ['name' => 'ProtonVPN Plus 1 Tháng', 'price' => 100000],
                ['name' => 'Mua PIA VPN Premium', 'price' => 40000],
                ['name' => 'Nâng cấp VEO3 Ultra 25K Credit', 'price' => 620000],
                ['name' => 'Canva Pro EDU Chính Chủ 6 Tháng', 'price' => 165000],
                ['name' => 'Tài Khoản VEO3 Ultra 25.000 Credit', 'price' => 1600000],
                ['name' => 'Tài Khoản CapCut Pro 1 Ngày', 'price' => 55000],
                ['name' => 'OneDrive 1TB Chính Chủ 1 Năm', 'price' => 319000],
                ['name' => 'ChatGPT Plus 1 Tháng Dùng Chung', 'price' => 90000],
                ['name' => 'Mua Key HMA VPN 30 Ngày', 'price' => 63000],
                ['name' => 'Nâng Cấp Surfshark VPN 7 Ngày', 'price' => 45000],
                ['name' => 'ChatGPT Plus 1 Tháng Chính Hãng', 'price' => 460000],
                ['name' => 'Gemini Pro 1 Năm Chính Chủ', 'price' => 580000],
                ['name' => 'Gemini Pro 1 Tháng Chính Chủ', 'price' => 69000],
                ['name' => 'Netflix Premium 4K 1 Tháng', 'price' => 120000],
                ['name' => 'Antigravity Ultra 1 Tháng', 'price' => 640000],
                ['name' => 'Gemini Pro 4 Tháng Chính Chủ', 'price' => 320000],
                ['name' => 'YouTube Premium Chính Chủ 1 Tháng', 'price' => 45000],
                ['name' => 'Figma Pro Edu 1 Năm', 'price' => 179000],
                ['name' => 'Office 365 Chính Chủ 1 Năm', 'price' => 350000],
                ['name' => 'Canva Pro EDU Chính Chủ 1 Năm', 'price' => 350000],
                ['name' => 'IntelliJ IDEA Ultimate 1 Năm', 'price' => 239000],
                ['name' => 'CapCut Pro 1 Tháng Giá Rẻ', 'price' => 125000],
            ];

            foreach ($defaultProducts as $item) {
                $exists = Product::where('name', $item['name'])->exists();
                if (!$exists) {
                    Product::create([
                        'name' => $item['name'],
                        'slug' => Str::slug($item['name']) . '-' . Str::random(5),
                        'price' => $item['price'],
                        'stock' => 999,
                        'is_active' => true,
                        'commission_percent' => 0,
                        'commission_amount' => 0,
                    ]);
                }
            }
        } catch (\Throwable $e) {
            // Ignore if DB issue occurs
        }
    }

    /**
     * Display commission management table
     */
    public function index(Request $request)
    {
        $this->ensureInitialProductsExist();

        $query = Product::query();

        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where('name', 'like', "%{$search}%");
        }

        // Sorting
        $sort = $request->get('sort', 'id');
        $direction = $request->get('direction', 'asc');
        if (in_array($sort, ['id', 'name', 'price', 'commission_percent', 'commission_amount'], true)) {
            $query->orderBy($sort, $direction === 'desc' ? 'desc' : 'asc');
        } else {
            $query->orderBy('id', 'asc');
        }

        $products = $query->paginate(50)->withQueryString();

        // Calculate total summary stats for page header
        $allProducts = Product::all();
        $totalProducts = $allProducts->count();
        $totalSystemRevenue = 0;
        $totalCommissionPaid = 0;

        foreach ($allProducts as $prod) {
            $commAmount = $prod->calculated_commission_amount;
            $sysAmount = $prod->calculated_system_amount;
            $totalCommissionPaid += $commAmount;
            $totalSystemRevenue += $sysAmount;
        }

        $currentUser = auth()->user();
        $canEdit = in_array($currentUser->role ?? '', ['sieusuperadmin', 'admin'], true);

        return view('admin.commissions.index', compact(
            'products',
            'totalProducts',
            'totalSystemRevenue',
            'totalCommissionPaid',
            'canEdit'
        ));
    }

    /**
     * Update product commission (% or fixed amount)
     * ONLY accessible by sieusuperadmin / admin
     */
    public function update(Request $request)
    {
        $currentUser = auth()->user();
        if (!in_array($currentUser->role ?? '', ['sieusuperadmin', 'admin'], true)) {
            if ($request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Bạn không có quyền chỉnh sửa. Quyền của bạn (superadmin_1) chỉ được phép XEM và XUẤT EXCEL.'
                ], 403);
            }
            return back()->with('error', 'Tài khoản superadmin_1 chỉ có quyền XEM & XUẤT EXCEL, không được sửa dữ liệu!');
        }

        // Handle single inline update via AJAX
        if ($request->has('product_id')) {
            $request->validate([
                'product_id' => 'required|exists:products,id',
                'commission_percent' => 'nullable|numeric|min:0|max:100',
                'commission_amount' => 'nullable|numeric|min:0',
            ]);

            $product = Product::findOrFail($request->product_id);
            $price = (float) ($product->effective_price ?? $product->price ?? 0);

            $percent = $request->filled('commission_percent') ? (float) $request->commission_percent : 0;
            $amount = $request->filled('commission_amount') ? (float) $request->commission_amount : 0;

            // If user updated percent, re-calculate amount, or vice versa
            if ($request->filled('commission_percent') && !$request->filled('commission_amount')) {
                $amount = round(($price * $percent) / 100, 2);
            } elseif ($request->filled('commission_amount') && !$request->filled('commission_percent')) {
                $percent = $price > 0 ? round(($amount / $price) * 100, 2) : 0;
            }

            $product->update([
                'commission_percent' => $percent,
                'commission_amount' => $amount,
            ]);

            if ($request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Cập nhật hoa hồng thành công!',
                    'data' => [
                        'id' => $product->id,
                        'price' => $price,
                        'commission_percent' => $percent,
                        'commission_amount' => $amount,
                        'formatted_commission_amount' => number_format($amount, 0, ',', '.') . 'đ',
                        'system_amount' => max(0, $price - $amount),
                        'formatted_system_amount' => number_format(max(0, $price - $amount), 0, ',', '.') . 'đ',
                    ]
                ]);
            }

            return back()->with('success', "Cập nhật hoa hồng cho '{$product->name}' thành công!");
        }

        // Handle batch bulk update from form submit
        if ($request->has('commissions') && is_array($request->commissions)) {
            foreach ($request->commissions as $productId => $data) {
                $product = Product::find($productId);
                if (!$product) continue;

                $price = (float) ($product->effective_price ?? $product->price ?? 0);
                $percent = isset($data['percent']) && $data['percent'] !== '' ? (float) $data['percent'] : 0;
                $amount = isset($data['amount']) && $data['amount'] !== '' ? (float) $data['amount'] : 0;

                if ($percent > 0 && ($amount == 0 || isset($data['updated_field']) && $data['updated_field'] === 'percent')) {
                    $amount = round(($price * $percent) / 100, 2);
                } elseif ($amount > 0 && ($percent == 0 || isset($data['updated_field']) && $data['updated_field'] === 'amount')) {
                    $percent = $price > 0 ? round(($amount / $price) * 100, 2) : 0;
                }

                $product->update([
                    'commission_percent' => $percent,
                    'commission_amount' => $amount,
                ]);
            }

            return back()->with('success', 'Đã lưu toàn bộ thông tin % Hoa hồng thành công!');
        }

        return back()->with('error', 'Không có dữ liệu nào được cập nhật.');
    }

    /**
     * Export Commission Table to Excel CSV (UTF-8 BOM formatted)
     * Accessible by BOTH superadmin_1 and sieusuperadmin
     */
    public function exportExcel(Request $request)
    {
        $this->ensureInitialProductsExist();

        $query = Product::query();
        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where('name', 'like', "%{$search}%");
        }

        $products = $query->orderBy('id', 'asc')->get();

        $fileName = 'bang-hoa-hong-san-pham-' . date('Y-m-d_H-i') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$fileName}\"",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        $callback = function () use ($products) {
            $file = fopen('php://output', 'w');

            // Output UTF-8 BOM for Microsoft Excel to parse Vietnamese accent marks properly
            fprintf($file, chr(0xEF) . chr(0xBB) . chr(0xBF));

            // CSV Column Headers
            fputcsv($file, [
                'STT',
                'Tên sản phẩm',
                'Giá (VNĐ)',
                '% Hoa Hồng',
                'Hoa Hồng Nhận Được (VNĐ)',
                'Tiền Về Hệ Thống (VNĐ)',
            ]);

            foreach ($products as $index => $product) {
                $price = (float) ($product->effective_price ?? $product->price ?? 0);
                $percent = (float) $product->calculated_commission_percent;
                $commAmount = (float) $product->calculated_commission_amount;
                $sysAmount = (float) $product->calculated_system_amount;

                fputcsv($file, [
                    $index + 1,
                    $product->name,
                    number_format($price, 0, ',', '.') . 'đ',
                    $percent > 0 ? $percent . '%' : '—',
                    $commAmount > 0 ? number_format($commAmount, 0, ',', '.') . 'đ' : '—',
                    number_format($sysAmount, 0, ',', '.') . 'đ',
                ]);
            }

            fclose($file);
        };

        return new StreamedResponse($callback, 200, $headers);
    }
}
