$(function () {
    $(document).on('click', '[data-toggle-password]', function () {
        var $input = $(this).siblings('input');
        var show = $input.attr('type') === 'password';

        $input.attr('type', show ? 'text' : 'password');
        $(this)
            .text(show ? 'Sembunyi' : 'Lihat')
            .attr({
                'aria-pressed': show,
                'aria-label': show ? 'Sembunyikan password' : 'Tampilkan password'
            });
    });

    $('input[type=file][data-preview]').on('change', function () {
        var file = this.files && this.files[0];
        var $target = $($(this).data('preview'));

        if (!file || !/^image\//.test(file.type)) {
            $target.addClass('d-none');
            return;
        }

        var reader = new FileReader();
        reader.onload = function (e) {
            $target.attr('src', e.target.result).removeClass('d-none');
        };
        reader.readAsDataURL(file);
    });

    $('input[data-filter-table]').on('input', function () {
        var keyword = $(this).val().toLowerCase();

        $($(this).data('filter-table')).find('tbody tr').each(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(keyword) > -1);
        });
    });

    $(document).on('click', '[data-print]', function () {
        window.print();
    });
});

$(function () {
    var $bank = $('#bank-fields');
    if (!$bank.length) return;
    $('input[name=role]').on('change', function () {
        $bank.toggleClass('d-none', $('input[name=role]:checked').val() !== 'petani');
    });
});

$(function () {
    var $info = $('#transfer-info');
    if (!$info.length) return;
    function sync() {
        $info.toggleClass('d-none', $('input[name=method]:checked').val() !== 'transfer');
    }
    $('input[name=method]').on('change', sync);
    sync();
});

$(function () {
    var $wa = $('#wa-admin');
    if (!$wa.length) return;
    var $email = $($wa.data('wa-email-input'));
    function sync() {
        var text = 'Halo Admin Tanimart, saya lupa password akun dengan email: ' + ($email.val() || '');
        $wa.attr('href', 'https://wa.me/' + $wa.data('wa-number') + '?text=' + encodeURIComponent(text));
    }
    $email.on('input', sync);
    sync();
});

$(document).on('click', '[data-copy]', function () {
    var $btn = $(this);
    var text = $($btn.data('copy')).text().trim();
    if (navigator.clipboard) {
        navigator.clipboard.writeText(text).then(function () {
            $btn.text('Tersalin');
        });
    }
});
