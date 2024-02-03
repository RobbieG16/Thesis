const circles = document.querySelectorAll(".circle"),
  progressBar = document.querySelector(".indicator");

let currentStep = -1;
const totalSteps = circles.length;

const updateSteps = () => {
  currentStep = (currentStep % totalSteps) + 1;

  circles.forEach((circle, index) => {
    const stepNumber = index + 1;
    const isCurrentStep = stepNumber === currentStep;
    const isDoneStep = stepNumber < currentStep;

    circle.innerHTML = isDoneStep || isCurrentStep ? '<i class="uil uil-check"></i>' : stepNumber;
    circle.classList[isCurrentStep ? "add" : "remove"]("active");

    // Add the "active" class to the circles representing the completed steps
    if (isDoneStep) {
      circle.classList.add("active");
    }
  });

  progressBar.style.width = `${((currentStep - 1) / (totalSteps - 1)) * 100}%`;
};

const autoProgress = () => {
  updateSteps();
  setTimeout(autoProgress, 2000);
};

// Initial call to start auto-progress
autoProgress();