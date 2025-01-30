<?php

namespace App\DataTables;

use App\Models\Pendaftaran;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PendaftaranDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
                ->rawColumns(['aksi'])
                ->addIndexColumn()
                ->editColumn('aksi', function($row){
                    return '<div class="flex space-x-2">
                                <a data-id="'.$row->id.'" data-jenis="edit" 
                                    href="/pendaftaran/'. $row->id .'/edit"
                                    class="text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 
                                    font-medium rounded-lg text-sm px-3 py-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                    </svg>
                                </a>
                
                                <button data-jenis="delete" type="button" data-id="'.$row->id.'" 
                                    class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:ring-red-300 
                                    font-medium rounded-lg text-sm px-3 py-2 action">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                </button>
                            </div>';
                })
                
                ->filter(function ($query) {
                    if (request()->has('search') && request()->search['value'] != '') {
                        $search = request()->search['value'];
                
                        $query->where(function ($q) use ($search) {
                            $q->where('no_pendaftaran', 'like', "%$search%")
                                ->orWhere('waktu_kunjungan', 'like', "%$search%")
                                ->orWhere('antrian', 'like', "%$search%");
                
                            $q->orWhereHas('pasien', function ($q) use ($search) {
                                $q->where('nama_pasien', 'like', "%$search%");
                            });
                
                            $q->orWhereHas('instalasi', function ($q) use ($search) {
                                $q->where('nama_instalasi', 'like', "%$search%");
                            });
                
                            $q->orWhereHas('layanan', function ($q) use ($search) {
                                $q->where('nama_layanan', 'like', "%$search%");
                            });
                
                            $q->orWhereHas('dokter', function ($q) use ($search) {
                                $q->where('nama_dokter', 'like', "%$search%");
                            });
                
                            $q->orWhereHas('jaminan', function ($q) use ($search) {
                                $q->where('nama_jaminan', 'like', "%$search%");
                            });
                        });
                    }
                });
                
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Pendaftaran $model): QueryBuilder
    {
        return $model->newQuery()
            ->with(['pasien', 'instalasi', 'layanan', 'dokter', 'jaminan'])
            ->selectRaw("*, DATE_FORMAT(waktu_kunjungan, '%d/%m/%Y %H:%i') as waktu_kunjungan");
    }


    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('pendaftaran-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->parameters([
                        'processing' => true,
                        'language' => [
                            'processing' => '<div id="loader-overlay" class="loader-overlay"><div class="loading-table"></div></div>'
                        ],
                        'drawCallback' => 'function() {
                            $("#pendaftaran-table thead").addClass("bg-biru")
                            $("#pendaftaran-table thead tr th").addClass("text-white bg-biru")
                            $("#pendaftaran-table thead span").addClass("text-white")
                            $("#pendaftaran-table tbody tr").addClass("border-b odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600")
                        }',
                        'select' => false
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('DT_RowIndex')->title('No.')->searchable(false)->orderable(false),
            Column::computed('pasien.nama_pasien')->title('Nama Pasien')->label('Nama Pasien')->orderable(true),
            Column::computed('no_pendaftaran')->title('No. Pendaftaran')->label('No. Pendaftaran')->orderable(true),
            Column::computed('waktu_kunjungan')->title('Waktu Kunjungan')->label('Waktu Kunjungan')->orderable(true),
            Column::computed('antrian')->title('Antrian')->label('Antrian')->orderable(true),
            Column::computed('instalasi.nama_instalasi')->title('Instalasi')->label('Instalasi')->orderable(true),
            Column::computed('layanan.nama_layanan')->title('Layanan')->label('Layanan')->orderable(true),
            Column::computed('dokter.nama_dokter')->title('Dokter')->label('Dokter')->orderable(true),
            Column::computed('jaminan.nama_jaminan')->title('Jaminan')->label('Jaminan')->orderable(true),
            Column::computed('aksi')->orderable(false)
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Pendaftaran_' . date('YmdHis');
    }
}
