<x-admin-layout>
    <x-slot name="content">

        <div class="container-fluid">

            <div class="row">

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Customer</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        {{ $customerCount }}
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-users fa-2x text-gray-300"></i>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Stock Going In</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        {{ $stockIn }}
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-box-open fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Stock Going Out</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            {{ $stockOut }}
                                        </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-dolly fa-2x text-gray-300"></i>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Suppliers</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            {{ $suppliersCount }}
                                        </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-truck-moving fa-2x text-gray-300"></i>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </x-slot>
</x-admin-layout>
