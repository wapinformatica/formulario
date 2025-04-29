<div class="col-md-12">
    @if (session()->has('success'))
    <div class="card bg-gradient-success">
        <div class="card-header">
            <h3 class="card-title">{{ session('success') }}</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    </div>
    @endif

    @if (session()->has('warning'))
    <div class="card bg-gradient-warning">
        <div class="card-header">
            <h3 class="card-title">{{ session('warning') }}</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    </div>
    @endif

    @if (session()->has('danger'))
    <div class="card bg-gradient-danger">
        <div class="card-header">
            <h3 class="card-title">{{ session('danger') }}</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    </div>
    @endif

</div>
