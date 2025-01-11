@extends('layouts.main')

@section('content')
    <div class="page-heading">
        <h3>User Management</h3>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-md-12">
                @if (session('success'))
                    <div class="alert alert-light-success color-success"><i class="bi bi-check-circle"></i>
                        {{ session('success') }}</div>
                @endif

                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <div class="row">
                            <div class="col-6">
                                <h4 class="text-white">List Role</h4>
                            </div>
                            <div class="col-6">
                                @can('create role')
                                    <a href="/role/create" class="btn icon icon-left btn-light float-end"><i
                                            data-feather="plus-square"></i>
                                        Role</a>
                                @endcan
                            </div>
                        </div>
                    </div>
                    <div class="card-body mt-3">
                        <div class="table-responsive">
                            <table id="table_id" class="table table-bordered table-hover table-striped table-condensed">
                                <thead>
                                    <tr>
                                        <th style="text-align: left;">No</th>
                                        <th>Role</th>
                                        @canany(['edit role', 'delete role'])
                                            <th>Opsi</th>
                                        @endcanany
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Datatable -->
    <script>
        $(document).ready(function() {
            if (!$.fn.dataTable.isDataTable('#table_id')) {
                let table = $('#table_id').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: '/role/get-data'
                    },
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false,
                            createdCell: function(td) {
                                $(td).css('text-align', 'left');
                            }
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        @canany(['edit role', 'delete role'])
                            {
                                data: 'opsi',
                                name: 'opsi',
                                orderable: false,
                                searchable: false
                            }
                        @endcanany
                    ],
                    drawCallback: function() {
                        $('.swal-confirm').on('click', function(e) {
                            e.preventDefault();
                            var form = $(this).closest('form');
                            Swal.fire({
                                title: 'Yakin ingin menghapus?',
                                text: "Data ini akan dihapus secara permanen!",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#d33',
                                cancelButtonColor: '#3085d6',
                                confirmButtonText: 'Ya, hapus!',
                                cancelButtonText: 'Batal'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    form.submit();
                                }
                            });
                        });
                    }
                })
            }
        });
    </script>
@endsection
