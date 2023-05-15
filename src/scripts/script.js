

// GENERAL FUNCTIONS

// toggle to show and hide the sidebar
const sidebarToggle = document.getElementById('sidebar-toggle');
const sidebar = document.querySelector('.sidebar');
sidebarToggle.addEventListener('click', () => {
  sidebar.classList.toggle('visible');
});






// FAQ PAGE FUNCTIONS


 // Gets all the FAQ titles
 var faqTitles = document.getElementsByClassName("faq-title");
 for (var i = 0; i < faqTitles.length; i++) {
     faqTitles[i].addEventListener("click", toggleAnswer);
 }

 // Toggle the display of the FAQ answer
 function toggleAnswer() {
     var answer = this.nextElementSibling;
     answer.classList.toggle("faq-answer-show");
 }