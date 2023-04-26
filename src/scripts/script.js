
const sidebarToggle = document.getElementById('sidebar-toggle');
const sidebar = document.querySelector('.sidebar');
sidebarToggle.addEventListener('click', () => {
  sidebar.classList.toggle('visible');
});
