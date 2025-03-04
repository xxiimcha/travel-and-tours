document.addEventListener('DOMContentLoaded', function () {
    const loader = document.getElementById('loader');

    // Simulate content loading
    setTimeout(() => {
        loader.style.display = 'none'; // Hide loader after 3 seconds
    }, 3000); // Adjust time as needed
});
