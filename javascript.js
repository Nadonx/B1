function scrollToBottom() {
            
    const documentHeight = Math.max(document.body.scrollHeight, document.documentElement.scrollHeight);
    
  
    window.scrollTo({
        top: documentHeight,
        behavior: 'smooth'
    });
}
document.addEventListener('DOMContentLoaded', function () {
const toggleSidebarButton = document.getElementById('toggle-sidebar');
const sidebar = document.getElementById('sidebar');

toggleSidebarButton.addEventListener('click', function () {
sidebar.style.right = sidebar.style.right === '0px' ? '-250px' : '0px';
});
});
document.addEventListener('DOMContentLoaded', function () {
const sidebar = document.getElementById('sidebar');
const menuToggle = document.getElementById('menu-toggle');

menuToggle.addEventListener('click', function () {
sidebar.style.right = (sidebar.style.right === '0px' || sidebar.style.right === '') ? '-250px' : '0';
});

const categories = document.querySelectorAll('.category');

categories.forEach(category => {
category.addEventListener('mouseover', function () {
    this.querySelector('.subcategories').style.display = 'block';
});

category.addEventListener('mouseout', function () {
    this.querySelector('.subcategories').style.display = 'none';
});
});
});