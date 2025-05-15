@extends('layouts.dashboard.app')
<title>{{ __('static.products.show_product') }}</title>

@section('breadcrumbs')
    @include('dashboard.includes.breadcrumb', [
        'title' => __('static.products.show_product'),
        'breadcrumbs' => [
            ['title' => __('static.global.home'), 'url' => route('dashboard.home')],
            ['title' => __('static.products.title'), 'url' => route('dashboard.products.index')],
            ['title' => $product->name, 'url' => ''],
        ],
    ])
@endsection
@section('content')
    <div class="row" style="display: flex; justify-content: center;">
        <div class="col-md-11">
            <div class="content-body">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="basic-layout-colored-form-control">
                            {{ $product->name }}
                        </h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                <li><a data-action="close"><i class="ft-x"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            @include('dashboard.includes.toster-error')
                            @include('dashboard.includes.toster-success')
                            <div class="row">
                                <!-- Product Details -->
                                <div class="col-md-6">
                                    <h3>{{ $product->name }}</h3>
                                    <p class="text-muted">{{ $product->small_desc }}</p>
                                    <p>{{ $product->desc }}</p>

                                    <!-- Price and Discount -->
                                    <div class="mt-2">
                                        @if ($product->has_variants)
                                            <span
                                                class="badge badge-warning">{{ __('static.products.has_variants') }}</span>
                                        @else
                                            <h4>
                                                <span class="text-danger">
                                                    ${{ $product->price }}
                                                </span>
                                                @if ($product->has_discount)
                                                    <small class="text-muted">
                                                        <del>${{ $product->price + $product->discount }}</del>
                                                    </small>
                                                @endif
                                            </h4>
                                            @if ($product->manage_stock && !$product->has_variants)
                                                <h4>
                                                    <span class="text-muted">
                                                        {{ $product->quantity }}
                                                    </span>
                                                </h4>
                                            @endif
                                            </h4>
                                        @endif
                                    </div>

                                    <!-- Availability -->
                                    <div class="mt-3">
                                        <p>
                                            <i class="fa fa-calendar-check text-success"></i>
                                            {{ __('static.global.available_for') }}:
                                            {{ $product->available_for ? $product->available_for : 'N/A' }}
                                        </p>
                                        <p>
                                            <i class="fa fa-box text-primary"></i>
                                            {{ __('static.products.in_stock') }}:
                                            {{ $product->available_in_stock ? __('static.global.yes') : __('static.global.no') }}
                                        </p>
                                    </div>

                                    <!-- SKU -->
                                    <div>
                                        <p>
                                            <i class="fa fa-barcode text-info"></i>
                                            {{ __('static.products.product_sku') }}: {{ $product->sku }}
                                        </p>
                                    </div>

                                    <!-- Views -->
                                    <div>
                                        <p>
                                            <i class="fa fa-eye text-secondary"></i>
                                            {{ __('static.products.views') }}: {{ $product->views }}
                                        </p>
                                    </div>

                                    <!-- Category and Brand -->
                                    <div class="mt-2">
                                        <p>
                                            <i class="fa fa-tag text-warning"></i>
                                            {{ __('static.products.product_category') }}: {{ $product->category->name }}
                                        </p>
                                        <p>
                                            <i class="fa fa-industry text-danger"></i>
                                            {{ __('static.products.product_brand') }}: {{ $product->brand->name }}
                                        </p>
                                    </div>
                                </div>

                                <!-- Product Image -->
                                <div class="col-md-6 text-center">
                                    <!-- Product Image Slider -->
                                    <div id="productImageSlider" class="carousel slide" data-ride="carousel">
                                        <div class="carousel-inner">
                                            @foreach ($product->images as $key => $image)
                                                <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                                    <img src="{{ asset('uploads/products/' . $image->file_name) }}"
                                                        class="d-block w-100 rounded shadow-sm" alt="{{ $product->name }}">
                                                </div>
                                            @endforeach
                                        </div>
                                        <a class="carousel-control-prev" href="#productImageSlider" role="button"
                                            data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">{{ __('static.global.previous') }}</span>
                                        </a>
                                        <a class="carousel-control-next" href="#productImageSlider" role="button"
                                            data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">{{ __('static.global.next') }}</span>
                                        </a>
                                    </div>
                                    <div class="mt-3">
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#fullscreenModal">
                                            <i class="fa fa-expand"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- Variants Section -->
                            @if ($product->has_variants)
                                <div class="mt-5">
                                    <h4>{{ __('static.products.has_variants') }}</h4>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Price</th>
                                                    <th>Stock</th>
                                                    <th>Attributes</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($product->variants as $variant)
                                                    <tr id="variant_{{ $product->id }}">
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>${{ $variant->price }}</td>
                                                        <td>{{ $variant->stock }}</td>
                                                        <td>
                                                            @foreach ($variant->variantAttributes as $variantAttribute)
                                                                <span class="badge badge-primary">
                                                                    {{ $variantAttribute->attributeValue->attribute->name }}:
                                                                    {{ $variantAttribute->attributeValue->value }}
                                                                </span>
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            @if ($product->variants->count() > 1)
                                                                <a href="javascript:void(0)" class="btn btn-danger btn-sm"
                                                                    data-url="{{ route('dashboard.products.variants.delete', $variant->id) }}"
                                                                    data-message="{{ __('messages.delete_confirmation') }}"
                                                                    data-title="{{ __('static.global.sure') }}"
                                                                    data-item_id="variant_{{ $product->id }}"
                                                                    onclick="confirmDelete(event, this.dataset.url,this.dataset.item_id, this.dataset.message, this.dataset.title)">
                                                                    <i class="la la-trash"></i>
                                                                </a>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @else
                                <p class="text-muted info">{{ __('static.products.no_variants') }}</p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="card-footer text-right">
                    <a href="{{ route('dashboard.products.edit', $product->id) }}" class="btn btn-secondary">
                        <i class="fa fa-edit"></i> {{ __('static.products.edit_product') }}
                    </a>
                    <a href="{{ route('dashboard.products.index') }}" class="btn btn-secondary">
                        <i class="fa fa-arrow-left"></i> {{ __('static.products.back_to_products') }}
                    </a>

                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Fullscreen Modal -->
    <div class="modal fade" id="fullscreenModal" tabindex="-1" role="dialog" aria-labelledby="fullscreenModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="fullscreenModalLabel">{{ __('static.global.full_screen') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="fullscreenCarousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($product->images as $key => $image)
                                <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                    <img src="{{ asset('uploads/products/' . $image->file_name) }}" class="d-block w-100"
                                        alt="Fullscreen Image">
                                </div>
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#fullscreenCarousel" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">{{ __('static.global.previous') }}</span>
                        </a>
                        <a class="carousel-control-next" href="#fullscreenCarousel" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">{{ __('static.global.next') }}</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
