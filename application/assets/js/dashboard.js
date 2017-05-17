$(document).ready(function (e) {

    var currentPage = 0;
    var maxCountRows = 0;

    function navBarBlock() {
        console.log(currentPage);
        console.log(maxCountRows);
        $('#nav-bar-prev').attr('disabled',false);
        $('#nav-bar-next').attr('disabled',false);
        if (currentPage == 0) {
            $('#nav-bar-prev').attr('disabled', true);
        }
        if (currentPage >= maxCountRows) {
            $('#nav-bar-next').attr('disabled',true);
        }
    }

    filteredForm();

    $('#filterButton').on('click', function (e) {
        e.preventDefault();
        currentPage = 0;
        filteredForm();
        navBarBlock();
    });

    $('#nav-bar-next').on('click', function (e) {
        e.preventDefault();
        currentPage++;
        filteredForm();
        navBarBlock();
    });

    $('#nav-bar-prev').on('click', function (e) {
        e.preventDefault();
        currentPage--;
        filteredForm();
        navBarBlock();
    });

    function filteredForm() {
        $.ajax({
            url: '/main/dashboards',
            method: 'post',
            dataType: 'JSON',
            data: {
                filterFormData: $('#dashboardFilter').serialize().split('&'),
                currentPage: currentPage
            },
            success: function (response) {
                $('#feedbackTable').html(response[0]);
                maxCountRows = response[1];
            },
            error: function (e) {
                console.log(e);
            }
        });
    }
});