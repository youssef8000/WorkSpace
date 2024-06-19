document.addEventListener("DOMContentLoaded", function () {
  const optionClient = document.querySelector(".option-client");
  const optionFreelancer = document.querySelector(".option-freelancer");
  const checkboxClient = document.querySelector(".option-client .checkmark");
  const checkboxFreelancer = document.querySelector(
    ".option-freelancer .checkmark"
  );

  optionClient.addEventListener("click", function () {
    if (checkboxClient.checked) {
      checkboxClient.checked = false;
    } else {
      checkboxClient.checked = true;
      checkboxFreelancer.checked = false;
    }
  });

  optionFreelancer.addEventListener("click", function () {
    if (checkboxFreelancer.checked) {
      checkboxFreelancer.checked = false;
    } else {
      checkboxFreelancer.checked = true;
      checkboxClient.checked = false;
    }
  });
});

////////////////////////////////////////////////

document.addEventListener("DOMContentLoaded", function () {
  const showMoreBtn = document.querySelector(".show-more-btn");
  const hiddenJobListings = document.querySelectorAll(".hidden-job-listing");

  // Hide additional job listings initially
  hiddenJobListings.forEach(function (job) {
    job.style.display = "none";
  });

  showMoreBtn.addEventListener("click", function () {
    hiddenJobListings.forEach(function (job) {
      job.style.display = "block";
    });

    // Hide the 'Show More' button
    showMoreBtn.style.display = "none";
  });
});
///////////////////////////////////////////////////
