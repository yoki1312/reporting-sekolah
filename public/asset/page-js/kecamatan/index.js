$(document).ready(function () {
    let table = $('#dt-hasil').DataTable({
        "autoWidth": false,
        "responsive": false,
        "scrollCollapse": true,
        "processing": true,
        "serverSide": true,
        "displayLength": 15,
        "paginate": true,
        "lengthChange": false,
        "filter": true,
        "dom": 'lrtip',
        "sort": true,
        "info": true,
        ajax: {
            url: baseurl + 'kecamatan',
            data: function (d) {
                return d;
            }
        },
        columns: [{
                data: 'id_sekolahan',
                orderable: false,
                searchable: false,
                className: 'text-center',
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {
                data: 'nama_kecamatan',
                className: 'text-left',
            },
            {
                data: 'nama_kecamatan',
                className: 'text-right',
                orderable: false,
                searchable: false,
                render : function(meta,data,row){
                    return row.total_sekolah + ' Sekolah'
                }
            },


        ]
    });

    $('input[type=search]').keypress(function (e) {
        if (e.which == 13) {
            table.search($(this).val()).draw();
        }
    });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.id_kecamatan').select2({
        placeholder: 'Pilih Kecamatan',
        allowClear: true,
        ajax: {
            dataType: "json",
            method: 'POST',
            url: baseurl + "referensi/kecamatanSelect2",
            delay: 300,
            processResults: function (data) {
                return {
                    results: data.map(function (item) {
                        item.id = item.id_kecamatan;
                        item.text = item.nama_kecamatan;
                        return item;
                    })
                };
            },
        },
        escapeMarkup: function (m) {
            return m;
        }
    });
    $('.id_jenjang').select2({
        placeholder: 'Pilih Jenjang',
        allowClear: true,
        ajax: {
            dataType: "json",
            method: 'POST',
            url: baseurl + "referensi/jenjangSelect2",
            delay: 300,
            processResults: function (data) {
                return {
                    results: data.map(function (item) {
                        item.id = item.id_jenjang;
                        item.text = item.nama_jenjang;
                        return item;
                    })
                };
            },
        },
        escapeMarkup: function (m) {
            return m;
        }
    });

    $(document).on('change', '.filter', function () {
        table.ajax.reload(null, true);
    })
});
