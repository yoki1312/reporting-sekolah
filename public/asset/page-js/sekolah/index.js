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
            url: baseurl + 'sekolah',
            data: function (d) {
                d.id_kecamatan = $('.id_kecamatan').val();
                d.id_jenjang = $('.id_jenjang').val();
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
                data: 'nama_sekolahan',
                className: 'text-left',
            },
            {
                data: 'npsn',
                className: 'text-center',
            },
            {
                data: 'nama_jenjang',
                className: 'text-center',
            },
            {
                data: 'nama_kecamatan',
                className: 'text-center',
            },
            {
                data: 'nama_kecamatan',
                className: 'text-center',
                render : function(meta,data,row){
                    return '<button class="btn btn-sm btn-success btn-reset" type="button">Reset Password</button>'
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

    $(document).on('click','.btn-reset', function(){
        let row = table.row( $(this).closest('tr') ).data();
        Swal.fire({
            title: 'Reset Password?',
            text: "Password akan di reset menjadi default ( tendikgresik )",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Lanjutkan !'
          }).then((result) => {
            if (result.isConfirmed) {
                $.get(baseurl + "resetPassword/" + row.id_sekolahan , function(data, status){
                    // alert("Data: " + data + "\nStatus: " + status);
                      Swal.fire(
                        'Berhasil!',
                        'password dikembalikan ke default.',
                        'success'
                      )
                  });
            }
          })
    })

    $('.id_kecamatan').select2({
        placeholder: 'Semua Kecamatan',
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
        placeholder: 'Semua Jenjang',
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
