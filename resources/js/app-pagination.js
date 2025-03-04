
// PAGINATION IN SCHEDULES

document.addEventListener('DOMContentLoaded', () => {
    const itemsPerPage = 5; 
    let currentPage = 1; 
  
    const prevButton = document.getElementById('prev');
    const nextButton = document.getElementById('next');
    const pageNum = document.getElementById('page-num');
    const scheduleList = document.getElementById('schedule-list');
    const allItems = Array.from(scheduleList.children); 
  
    const totalItems = allItems.length; 
    const totalPages = Math.ceil(totalItems / itemsPerPage); 
  
  
    function displaySchedules(page) {
  
        allItems.forEach((item, index) => {
            item.style.display = 'none';
        });
  
  
        const start = (page - 1) * itemsPerPage;
        const end = start + itemsPerPage;
        allItems.slice(start, end).forEach((item) => {
            item.style.display = 'flex'; 
        });
    }
  
  
    function handlePagination() {
        prevButton.disabled = currentPage === 1;
        nextButton.disabled = currentPage === totalPages;
        pageNum.textContent = currentPage;
    }
  
    prevButton.addEventListener('click', () => {
        if (currentPage > 1) {
            currentPage--;
            displaySchedules(currentPage);
            handlePagination();
        }
    });
  
    nextButton.addEventListener('click', () => {
        if (currentPage < totalPages) {
            currentPage++;
            displaySchedules(currentPage);
            handlePagination();
        }
    });
  
    displaySchedules(currentPage);
    handlePagination();
  });
  