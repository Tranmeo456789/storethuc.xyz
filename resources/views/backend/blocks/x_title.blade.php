<div class="card-header">
    <h3 class="card-title">{{ $title }}</h3>
    @php
        if (!isset($hideBtn) || !$hideBtn ){
            echo '<div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                  </div>';
        }
    @endphp
</div>