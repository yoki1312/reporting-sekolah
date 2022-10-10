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
        "dom": 'lrtip',
        "info": true,
        ajax: {
            url: baseurl + 'user',
            data: function (d) {
                d.id_kecamatan = $('.id_kecamatan').val();
                d.id_sekolah = $('.id_sekolah').val();
                d.id_jenjang = $('.id_jenjang').val();
                d.id_jabatan = $('.id_jabatan').val();
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
                data: 'nama_user',
                className: 'text-left',
            },
            {
                data: 'nip',
                className: 'text-center',
            },
            {
                data: 'nuptk',
                className: 'text-center',
            },
            {
                data: 'nama_sekolahan',
                className: 'text-left',
            },
            {
                data: 'nama_kecamatan',
                className: 'text-center',
            },
            {
                data: 'nama_jenjang',
                className: 'text-center',
            },
            {
                data: 'nama_jabatan',
                className: 'text-center',
            },
            // {
            //     data: 'action',
            //     className: 'text-center',
            // },

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

    $('.id_jabatan').select2({})
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
    $('.id_sekolah').select2({
		placeholder: 'Pilih Sekolah',
		allowClear: true,
		ajax: {
			dataType: "json",
			method: 'POST',
			url: baseurl + "referensi/sekolahSelect2",
			delay: 300,
			processResults: function (data) {
				return {
					results: data.map(function (item) {
						item.id = item.id_sekolahan;
						item.text = item.nama_sekolahan;
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
