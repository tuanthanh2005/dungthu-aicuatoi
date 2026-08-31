@extends('layouts.admin')

@section('title', 'Quản lý Sản phẩm - Admin')

@section('page_title', 'Sản phẩm')

@push('styles')
<style>
    .admin-card {
        background: white;
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.06);
    }

    .product-image-small {
        width: 56px;
        height: 56px;
        object-fit: cover;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    }

    /* Modern Table */
    .custom-table {
        border-collapse: separate;
        border-spacing: 0 10px;
    }

    .custom-table thead th {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        padding: 14px 16px;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 12.5px;
        letter-spacing: 0.5px;
    }

    .custom-table thead th:first-child {
        border-radius: 12px 0 0 12px;
    }

    .custom-table thead th:last-child {
        border-radius: 0 12px 12px 0;
    }

    .custom-table tbody tr {
        background: white;
        box-shadow: 0 2px 10px rgba(0,0,0,0.03);
        transition: all 0.25s ease;
    }

    .custom-table tbody tr:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0,0,0,0.08);
    }

    .custom-table tbody td {
        padding: 14px 16px;
        vertical-align: middle;
        border: none;
    }

    .custom-table tbody tr td:first-child {
        border-radius: 12px 0 0 12px;
    }

    .custom-table tbody tr td:last-child {
        border-radius: 0 12px 12px 0;
    }

    .badge-category {
        padding: 6px 12px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 11px;
        text-transform: uppercase;
    }

    .badge-tech {
        background: linear-gradient(135deg, #00d4ff 0%, #0099cc 100%);
        color: white;
    }

    .badge-fashion {
        background: linear-gradient(135deg, #ff6b6b 0%, #ee5a6f 100%);
        color: white;
    }

    .badge-doc {
        background: linear-gradient(135deg, #00acc1 0%, #0097a7 100%);
        color: white;
    }

    .badge-ebooks {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        color: white;
    }

    /* Compact Search Form */
    .compact-search-form {
        display: flex;
        align-items: center;
        background: #f1f5f9;
        border-radius: 30px;
        padding: 6px 16px;
        border: 1.5px solid transparent;
        transition: all 0.3s ease;
        min-width: 240px;
    }
    .compact-search-form:focus-within {
        background: #fff;
        border-color: #667eea;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.15);
        min-width: 290px;
    }
    .compact-search-input {
        border: none;
        outline: none;
        background: transparent;
        font-size: 0.9rem;
        color: #1e293b;
        width: 100%;
        font-weight: 500;
    }
    .compact-search-icon {
        color: #667eea;
        font-size: 0.9rem;
        margin-right: 10px;
    }

    /* Modern Filter Bar */
    .filter-bar-card {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
        flex-wrap: wrap;
        background: #f8fafc;
        border: 1.5px solid #e2e8f0;
        border-radius: 20px;
        padding: 12px 18px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.02);
    }

    .filter-pills-wrapper {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }

    .filter-pill {
        display: inline-flex;
        align-items: center;
        background: #ffffff;
        border: 1.5px solid #e2e8f0;
        border-radius: 30px;
        padding: 2px 6px 2px 14px;
        transition: all 0.25s ease;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.03);
    }

    .filter-pill:hover, .filter-pill:focus-within {
        border-color: #667eea;
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.12);
    }

    .filter-pill-label {
        font-size: 13px;
        font-weight: 700;
        color: #475569;
        display: flex;
        align-items: center;
        gap: 6px;
        white-space: nowrap;
        padding-right: 8px;
        border-right: 1px solid #e2e8f0;
    }

    .filter-pill-select {
        border: none;
        outline: none;
        background: transparent;
        font-size: 13px;
        font-weight: 600;
        color: #1e293b;
        padding: 6px 8px;
        cursor: pointer;
    }

    .filter-actions-right {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-left: auto;
    }

    .btn-filter-action {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 18px;
        border-radius: 30px;
        font-size: 13px;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.25s ease;
    }

    .btn-filter-action.active-flash {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: #ffffff;
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.25);
    }

    .btn-filter-action.inactive-flash {
        background: #ffffff;
        color: #ef4444;
        border: 1.5px solid #fca5a5;
    }

    .btn-filter-action.inactive-flash:hover {
        background: #fef2f2;
        color: #dc2626;
        border-color: #ef4444;
        transform: translateY(-1px);
    }

    .btn-filter-reset {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 16px;
        background: #ffffff;
        border: 1.5px solid #e2e8f0;
        border-radius: 30px;
        font-size: 13px;
        font-weight: 600;
        color: #64748b;
        text-decoration: none;
        transition: all 0.25s ease;
    }

    .btn-filter-reset:hover {
        background: #f1f5f9;
        color: #334155;
        border-color: #cbd5e1;
    }
</style>
@endpush

@section('content')
<div class="container-fluid px-0">
        <!-- Products Management -->
        <div class="admin-card" data-aos="fade-up">
            <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
                <div class="d-flex align-items-center gap-3 flex-wrap">
                    <h3 class="fw-bold mb-0 text-dark">
                        <i class="fas fa-box text-primary me-2"></i>Quản lý Sản phẩm
                    </h3>
                    
                    <form action="{{ route('admin.products') }}" method="GET" class="compact-search-form">
                        <i class="fas fa-search compact-search-icon"></i>
                        <input type="text" name="search" class="compact-search-input" placeholder="Tìm sản phẩm..." value="{{ request('search') }}">
                        <button type="submit" class="d-none"></button>
                    </form>
                </div>
                <div class="d-flex align-items-center gap-2 flex-wrap">
                    <form action="{{ route('admin.flash-sale.toggle') }}" method="POST" class="d-inline ajax-global-toggle-form">
                        @csrf
                        <button type="submit" class="btn {{ $flashSaleEnabled ? 'btn-outline-danger' : 'btn-outline-success' }} rounded-pill px-4 fw-semibold">
                            <i class="fas fa-bolt me-2"></i><span>{{ $flashSaleEnabled ? 'Tắt' : 'Bật' }} Flash Sale</span>
                        </button>
                    </form>
                    <a href="{{ route('admin.products.create', 'tech') }}" class="btn btn-primary rounded-pill px-4 fw-semibold shadow-sm" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none;">
                        <i class="fas fa-plus me-2"></i>Thêm sản phẩm
                    </a>
                </div>
            </div>

            <!-- Modern Filter Bar -->
            <form action="{{ route('admin.products') }}" method="GET" class="filter-bar-card mb-4">
                @if(request('search'))
                    <input type="hidden" name="search" value="{{ request('search') }}">
                @endif
                @if(request('flash_sale'))
                    <input type="hidden" name="flash_sale" value="{{ request('flash_sale') }}">
                @endif

                <div class="filter-pills-wrapper">
                    <!-- Dropdown Tồn kho -->
                    <div class="filter-pill">
                        <span class="filter-pill-label">
                            <i class="fas fa-boxes text-primary"></i> Tồn kho
                        </span>
                        <select name="stock_status" id="stockSelect" class="filter-pill-select" onchange="this.form.submit()">
                            <option value="" {{ !request('stock_status') || request('stock_status') == 'all' ? 'selected' : '' }}>Tất cả kho</option>
                            <option value="in_stock" {{ request('stock_status') == 'in_stock' ? 'selected' : '' }}>✅ Còn hàng</option>
                            <option value="out_of_stock" {{ request('stock_status') == 'out_of_stock' ? 'selected' : '' }}>❌ Hết hàng</option>
                        </select>
                    </div>

                    <!-- Dropdown Trạng thái Hiển thị/Ẩn -->
                    <div class="filter-pill">
                        <span class="filter-pill-label">
                            <i class="fas fa-eye text-success"></i> Hiển thị
                        </span>
                        <select name="active_status" id="activeSelect" class="filter-pill-select" onchange="this.form.submit()">
                            <option value="" {{ !request('active_status') ? 'selected' : '' }}>Tất cả trạng thái</option>
                            <option value="active" {{ request('active_status') == 'active' ? 'selected' : '' }}>🟢 Đang hiển thị</option>
                            <option value="hidden" {{ request('active_status') == 'hidden' ? 'selected' : '' }}>⚪ Đã ẩn</option>
                        </select>
                    </div>

                    <!-- Dropdown Danh mục -->
                    <div class="filter-pill">
                        <span class="filter-pill-label">
                            <i class="fas fa-layer-group text-info"></i> Danh mục
                        </span>
                        <select name="category" id="categorySelect" class="filter-pill-select" onchange="this.form.submit()">
                            <option value="all" {{ !request('category') || request('category') == 'all' ? 'selected' : '' }}>Tất cả danh mục</option>
                            <option value="tech" {{ request('category') == 'tech' ? 'selected' : '' }}>💻 Công nghệ</option>
                        </select>
                    </div>
                </div>

                <!-- Flash Sale & Reset Filters -->
                <div class="filter-actions-right">
                    <a href="{{ route('admin.products', array_merge(request()->query(), ['flash_sale' => request('flash_sale') ? null : 1, 'page' => null])) }}" 
                       class="btn-filter-action {{ request('flash_sale') ? 'active-flash' : 'inactive-flash' }}">
                        <i class="fas fa-bolt"></i> Flash Sale
                    </a>
                    @if(request()->except(['page']))
                        <a href="{{ route('admin.products') }}" class="btn-filter-reset" title="Đặt lại bộ lọc">
                            <i class="fas fa-undo"></i> Đặt lại
                        </a>
                    @endif
                </div>
            </form>

            @if($products->count() > 0)
            <div class="table-responsive">
                <table class="table custom-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Hình ảnh</th>
                            <th>Tên sản phẩm</th>
                            <th>Danh mục</th>
                            <th>Loại</th>
                            <th>Giá</th>
                            <th>Flash Sale</th>
                            <th>Tồn kho</th>
                            <th>Trạng thái</th>
                            <th>Gán Home</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                        <tr>
                            <td><strong>#{{ $product->id }}</strong></td>
                            <td>
                                <img src="{{ $product->image ?? 'https://via.placeholder.com/60' }}" 
                                     alt="{{ $product->name }}" 
                                     class="product-image-small">
                            </td>
                            <td>
                                <strong>{{ $product->name }}</strong><br>
                                <small class="text-muted">{{ Str::limit($product->description, 50) }}</small>
                            </td>
                            <td>
                                @if($product->categoryRelation)
                                    <span class="badge-category badge-{{ $product->categoryRelation->type }}">
                                        {{ $product->categoryRelation->name }}
                                    </span>
                                @else
                                    @if($product->category === 'tech')
                                        <span class="badge-category badge-tech">Công nghệ</span>
                                    @elseif($product->category === 'ebooks')
                                        <span class="badge-category badge-ebooks">Ebooks</span>
                                    @else
                                        <span class="badge-category badge-doc">Tài liệu</span>
                                    @endif
                                @endif
                            </td>
                            <td>
                                @if($product->delivery_type === 'digital')
                                    <span class="badge bg-primary">
                                        <i class="fas fa-qrcode me-1"></i>QR
                                    </span>
                                @else
                                    <span class="badge bg-success">
                                        <i class="fas fa-shipping-fast me-1"></i>Ship
                                    </span>
                                @endif
                            </td>
                            <td>
                                <strong class="text-primary">{{ number_format($product->price, 0, ',', '.') }}đ</strong>
                            </td>
                            <td>
                                <form action="{{ route('admin.products.toggle-flash-sale', $product) }}" method="POST" class="d-inline ajax-toggle-form" data-type="flash-sale">
                                    @csrf
                                    <button type="submit" class="btn btn-sm {{ $product->is_flash_sale ? 'btn-danger' : 'btn-outline-danger' }}">
                                        <i class="fas fa-bolt me-1"></i><span>{{ $product->is_flash_sale ? 'Đang bật' : 'Bật' }}</span>
                                    </button>
                                </form>
                            </td>
                            <td>
                                @if($product->stock > 0)
                                    <span class="badge bg-success">{{ $product->stock }}</span>
                                @else
                                    <span class="badge bg-danger">Hết hàng</span>
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('admin.products.toggle-active', $product) }}" method="POST" class="d-inline ajax-toggle-form" data-type="active">
                                    @csrf
                                    <button type="submit" class="btn btn-sm {{ $product->is_active ? 'btn-success' : 'btn-secondary' }}" style="font-weight: 600; font-size: 11px; padding: 4px 10px; border-radius: 20px;">
                                        <i class="fas {{ $product->is_active ? 'fa-eye' : 'fa-eye-slash' }} me-1"></i>
                                        <span>{{ $product->is_active ? 'Hiển thị' : 'Đã ẩn' }}</span>
                                    </button>
                                </form>
                            </td>
                            <td>
                                <div class="d-flex flex-column gap-1">
                                    <form action="{{ route('admin.products.toggle-featured', $product) }}" method="POST" class="ajax-toggle-form" data-type="featured">
                                        @csrf
                                        <button type="submit" class="btn btn-sm w-100 {{ $product->is_featured ? 'btn-warning' : 'btn-outline-warning' }}" style="font-size: 10px; padding: 2px 5px;">
                                            <i class="fas fa-star me-1"></i>Nổi bật
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.products.toggle-exclusive', $product) }}" method="POST" class="ajax-toggle-form" data-type="exclusive">
                                        @csrf
                                        <button type="submit" class="btn btn-sm w-100 {{ $product->is_exclusive ? 'btn-info' : 'btn-outline-info' }}" style="font-size: 10px; padding: 2px 5px;">
                                            <i class="fas fa-gem me-1"></i>Độc quyền
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.products.toggle-combo-ai', $product) }}" method="POST" class="ajax-toggle-form" data-type="combo-ai">
                                        @csrf
                                        <button type="submit" class="btn btn-sm w-100 {{ $product->is_combo_ai ? 'btn-success' : 'btn-outline-success' }}" style="font-size: 10px; padding: 2px 5px;">
                                            <i class="fas fa-robot me-1"></i>Combo AI
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.products.toggle-banner', $product) }}" method="POST" class="ajax-toggle-form" data-type="banner">
                                        @csrf
                                        <button type="submit" class="btn btn-sm w-100 {{ $product->show_on_banner ? 'btn-primary' : 'btn-outline-primary' }}" style="font-size: 10px; padding: 2px 5px;">
                                            <i class="fas fa-image me-1"></i>Gán Home
                                        </button>
                                    </form>
                                </div>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.products.edit', array_merge(['product' => $product->id], request()->only(['page', 'search', 'category', 'flash_sale']))) }}" 
                                       class="btn btn-sm btn-outline-primary rounded-start"
                                       title="Chỉnh sửa">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.products.clone', $product) }}" 
                                          method="POST" 
                                          class="d-inline"
                                          onsubmit="return confirm('Bạn có chắc muốn nhân bản sản phẩm này?')">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-success rounded-0" title="Nhân bản (Clone)">
                                            <i class="fas fa-clone"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.products.delete', $product) }}" 
                                          method="POST" 
                                          class="d-inline ajax-delete-form"
                                          data-name="{{ $product->name }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger rounded-end" title="Xóa">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center mt-4 flex-wrap gap-3">
                <div class="text-muted">
                    Hiển thị {{ $products->firstItem() ?? 0 }} đến {{ $products->lastItem() ?? 0 }} của {{ $products->total() }} sản phẩm
                </div>
                <div>
                    {{ $products->links() }}
                </div>
            </div>
            @else
            <div class="text-center py-5">
                <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                <p class="text-muted">Không tìm thấy sản phẩm nào</p>
                <a href="{{ route('admin.products.create', 'tech') }}" class="btn btn-primary rounded-pill px-4">
                    <i class="fas fa-plus me-2"></i>Thêm sản phẩm mới
                </a>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    AOS.init({ duration: 800, once: true });

    // AJAX Toggle Forms
    document.querySelectorAll('.ajax-toggle-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const button = this.querySelector('button[type="submit"]');
            const type = this.getAttribute('data-type');
            const url = this.getAttribute('action');

            button.disabled = true;

            fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: data.message,
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 2000
                    });

                    if (type === 'flash-sale') {
                        if (data.value) {
                            button.className = 'btn btn-sm btn-danger';
                            button.innerHTML = '<i class="fas fa-bolt me-1"></i><span>Đang bật</span>';
                        } else {
                            button.className = 'btn btn-sm btn-outline-danger';
                            button.innerHTML = '<i class="fas fa-bolt me-1"></i><span>Bật</span>';
                        }
                    } else if (type === 'featured') {
                        if (data.value) {
                            button.className = 'btn btn-sm w-100 btn-warning';
                        } else {
                            button.className = 'btn btn-sm w-100 btn-outline-warning';
                        }
                        button.innerHTML = '<i class="fas fa-star me-1"></i>Nổi bật';
                    } else if (type === 'exclusive') {
                        if (data.value) {
                            button.className = 'btn btn-sm w-100 btn-info';
                        } else {
                            button.className = 'btn btn-sm w-100 btn-outline-info';
                        }
                        button.innerHTML = '<i class="fas fa-gem me-1"></i>Độc quyền';
                    } else if (type === 'combo-ai') {
                        if (data.value) {
                            button.className = 'btn btn-sm w-100 btn-success';
                        } else {
                            button.className = 'btn btn-sm w-100 btn-outline-success';
                        }
                        button.innerHTML = '<i class="fas fa-robot me-1"></i>Combo AI';
                    } else if (type === 'banner') {
                        if (data.value) {
                            button.className = 'btn btn-sm w-100 btn-primary';
                        } else {
                            button.className = 'btn btn-sm w-100 btn-outline-primary';
                        }
                        button.innerHTML = '<i class="fas fa-image me-1"></i>Gán Home';
                    } else if (type === 'active') {
                        if (data.value) {
                            button.className = 'btn btn-sm btn-success';
                            button.style.borderRadius = '20px';
                            button.innerHTML = '<i class="fas fa-eye me-1"></i><span>Hiển thị</span>';
                        } else {
                            button.className = 'btn btn-sm btn-secondary';
                            button.style.borderRadius = '20px';
                            button.innerHTML = '<i class="fas fa-eye-slash me-1"></i><span>Đã ẩn</span>';
                        }
                    }
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Lỗi!',
                        text: data.message || 'Không thể cập nhật trạng thái.'
                    });
                }
            })
            .catch(err => {
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi!',
                    text: err.message || 'Không thể kết nối đến server.'
                });
            })
            .finally(() => {
                button.disabled = false;
            });
        });
    });

    // AJAX Global Toggle
    const globalToggleForm = document.querySelector('.ajax-global-toggle-form');
    if (globalToggleForm) {
        globalToggleForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const button = this.querySelector('button[type="submit"]');
            const url = this.getAttribute('action');
            const originalContent = button.innerHTML;

            button.disabled = true;
            button.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Đang xử lý...';

            fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: data.message,
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 2000
                    });

                    if (data.enabled) {
                        button.className = 'btn btn-outline-danger rounded-pill px-4 fw-semibold';
                        button.innerHTML = '<i class="fas fa-bolt me-2"></i><span>Tắt Flash Sale</span>';
                    } else {
                        button.className = 'btn btn-outline-success rounded-pill px-4 fw-semibold';
                        button.innerHTML = '<i class="fas fa-bolt me-2"></i><span>Bật Flash Sale</span>';
                    }
                }
            })
            .catch(err => {
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi kết nối!',
                    text: 'Không thể kết nối đến server.'
                });
                button.innerHTML = originalContent;
            })
            .finally(() => {
                button.disabled = false;
            });
        });
    }

    // AJAX Delete Forms
    document.querySelectorAll('.ajax-delete-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const name = this.getAttribute('data-name');
            const url = this.getAttribute('action');
            const row = this.closest('tr');

            Swal.fire({
                title: 'Xác nhận xóa?',
                text: `Bạn có chắc muốn xóa sản phẩm "${name}"?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Đồng ý xóa',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(url, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: new URLSearchParams({
                            '_method': 'DELETE'
                        })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: data.message,
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 2000
                            });
                            
                            // Fade out row
                            row.style.transition = 'all 0.5s ease';
                            row.style.opacity = '0';
                            row.style.transform = 'translateX(20px)';
                            setTimeout(() => {
                                row.remove();
                            }, 500);
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Thất bại!',
                                text: data.message || 'Không thể xóa sản phẩm.'
                            });
                        }
                    })
                    .catch(err => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Lỗi kết nối!',
                            text: 'Không thể kết nối đến server.'
                        });
                    });
                }
            });
        });
    });
</script>
@endpush
