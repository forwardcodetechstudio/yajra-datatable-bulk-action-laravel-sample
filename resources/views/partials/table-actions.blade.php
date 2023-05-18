<div class="button-list">
    @if (isset($edit))
        <div class="d-inline">
            <a href="{{ $edit }}" class="btn btn-success-rgba" data-toggle="tooltip" data-placement="top"
                title="Edit"><i class="feather icon-edit-2"></i></a>
        </div>
    @endif

    @foreach ($extras ?? [] as $extra)
        @if ($extra['name'] == 'Browse ')
            <div class="d-inline">
                <a {{ $extra['attrs'] ?? '' }} href="{{ $extra['url'] }}" class="btn btn-success-rgba"><i
                        class="feather {{ $extra['icon'] }}"></i></a>
            </div>
        @endif
    @endforeach

    <div class="d-inline">
        @if (isset($delete))
            <form class="d-inline" action="{{ $delete }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Are you sure To delete?');" class="btn btn-danger-rgba"
                    data-toggle="tooltip" data-placement="top" title="Delete"><i
                        class="feather icon-trash"></i></button>
            </form>
    </div>
    @endif


    @if (isset($options) && sizeof($options) > 0)
        <div class="btn-group mr-2">
            <div class="dropdown">
                <button class="btn btn-round btn-primary-rgba" type="button" id="CustomdropdownMenuButton4"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                        class="feather icon-more-horizontal-"></i></button>
                <div class="dropdown-menu" aria-labelledby="CustomdropdownMenuButton4" x-placement="bottom-start"
                    style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 40px, 0px);">

                    @foreach ($options as $option)
                        @if (!empty($option))
                            @if ($option['name'] == 'Delete ')
                                <a class="dropdown-item" href="javascript:void(0);" data-url="{{ $option['url'] }}"
                                    onclick="deleteData(this);" {{ $option['attr'] ?? '' }}>
                                    @isset($option['icon'])
                                        <i class="feather {{ $option['icon'] }}"></i>
                                    @endisset
                                    {{ $option['name'] }}
                                </a>
                            @else
                                @if ($option['url'])
                                    <a class="dropdown-item" href="{{ $option['url'] ?? 'javascript:;' }}"
                                        {{ $option['attr'] ?? '' }}>
                                        @isset($option['icon'])
                                            <i class="feather {{ $option['icon'] }}"></i>
                                        @endisset
                                        {{ $option['name'] }}
                                    </a>
                                @endif
                            @endif
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    @endif

</div>
