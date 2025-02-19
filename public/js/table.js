// JavaScript for pagination and search
let currentPage = 1;
const rowsPerPage = 2;
const rows = Array.from(document.querySelectorAll('#data-table tbody tr'));
const searchInput = document.getElementById('search-input');
const pagination = document.getElementById('pagination');

function showPage(page) {
    currentPage = page;

    // Hide all rows
    rows.forEach(row => row.style.display = 'none');

    // Show only the rows for the current page
    const start = (currentPage - 1) * rowsPerPage;
    const end = start + rowsPerPage;
    const rowsToShow = rows.slice(start, end);
    rowsToShow.forEach(row => row.style.display = '');

    updatePagination();
}

function updatePagination() {
    const totalPages = Math.ceil(rows.length / rowsPerPage);

    // Hide all pagination buttons
    pagination.querySelectorAll('.page-item').forEach(item => item.classList.remove('active'));

    // Mark the current page as active
    pagination.querySelector(`#page-${currentPage}`).classList.add('active');

    // Disable "Previous" button if on first page
    document.getElementById('prev').classList.toggle('disabled', currentPage === 1);

    // Disable "Next" button if on last page
    document.getElementById('next').classList.toggle('disabled', currentPage === totalPages);
}

// Search functionality
searchInput.addEventListener('input', function() {
    const searchTerm = searchInput.value.toLowerCase();

    rows.forEach(row => {
        const cells = row.querySelectorAll('td');
        const text = Array.from(cells).map(cell => cell.textContent.toLowerCase()).join(' ');
        row.style.display = text.includes(searchTerm) ? '' : 'none';
    });

    showPage(1);  // Reset to first page after filtering
});

// Pagination click events
document.getElementById('prev').addEventListener('click', function() {
    if (currentPage > 1) showPage(currentPage - 1);
});

document.getElementById('next').addEventListener('click', function() {
    const totalPages = Math.ceil(rows.length / rowsPerPage);
    if (currentPage < totalPages) showPage(currentPage + 1);
});

pagination.addEventListener('click', function(event) {
    if (event.target.classList.contains('page-link')) {
        const page = parseInt(event.target.textContent);
        showPage(page);
    }
});

// Initialize
showPage(1);
