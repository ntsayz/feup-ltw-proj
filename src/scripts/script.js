

//     ---------                HOME PAGE FUNCTIONS     --------------

// toggle to show and hide the sidebar
const sidebarToggle = document.getElementById('sidebar-toggle');
const sidebar = document.querySelector('.sidebar');
sidebarToggle.addEventListener('click', () => {
  sidebar.classList.toggle('visible');
});






//      ---------                FAQ PAGE FUNCTIONS     --------------


 // Gets all the FAQ titles
 var faqTitles = document.getElementsByClassName("faq-title");
 for (var i = 0; i < faqTitles.length; i++) {
     faqTitles[i].addEventListener("click", toggleAnswer);
 }

 // Toggle the display of the FAQ answer
 function toggleAnswer() {
  var answerContainer = this.nextElementSibling;
  var answer = answerContainer.getElementsByClassName("faq-answer")[0];
  answer.classList.toggle("faq-answer-show");
}



var deleteButtons = document.querySelectorAll('.delete-button');

// Add event listeners to delete buttons
deleteButtons.forEach(function (button) {
    button.addEventListener('click', deleteFAQ);
});

// Function to handle the delete button click
function deleteFAQ() {
    var faqId = this.getAttribute('data-id');

    // Send an HTTP request to delete the FAQ with the specified ID
var deleteURL = '/actions/action_delete_faq.php?id=' + faqId;

    fetch(deleteURL, { method: 'DELETE' })
        .then(function (response) {
            if (response.ok) {
                // Reload the page to reflect the updated FAQ list
                location.reload();
            } else {
                console.error('Error deleting FAQw');
            }
        })
        .catch(function (error) {
            console.error('Error deleting FAQ:', error);
        });
}