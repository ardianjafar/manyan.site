@push('scripts')
<script>
    $(document).on('click', '.share-buttons > a', function(e) {
        e.preventDefault();
        window.open($(this).attr('href'), '', 
            'height=450,width=450,top=' + ($(window).height()/2 - 275) + 
            ', left=' + ($(window).width()/2 - 225) + 
            ', toolbar=0, location=0, menubar=0, directories=0, scrollbars=0'
        );
        return false;
    });
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('searchInput');
    const table = document.getElementById('wordTable');
    const rows = Array.from(table.querySelectorAll('tbody tr'));

    searchInput.addEventListener('input', function () {
        const keyword = searchInput.value.toLowerCase().trim();

        rows.forEach((row, index) => {
            const text = row.innerText.toLowerCase();
            const match = text.includes(keyword);

            row.style.display = match ? '' : 'none';
            if (match) row.cells[0].innerText = index + 1;
        });
    });
});
</script>
@endpush
