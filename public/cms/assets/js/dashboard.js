function toggleSidebar() {
    const sidebar = document.getElementById("sidebar");
    const mainContainer = document.querySelector(".main-container");
    const tooltipTriggerList = document.querySelectorAll(
        '[data-bs-toggle="tooltip"]'
    );
    sidebar.classList.toggle("collapsed");
    if (sidebar.classList.contains("collapsed")) {
        [...tooltipTriggerList].forEach((tooltipTriggerEl) => {
            new bootstrap.Tooltip(tooltipTriggerEl);
        });
        mainContainer.classList.add("adjust-margin");
    } else {
        mainContainer.classList.remove("adjust-margin");
        [...tooltipTriggerList].forEach((tooltipTriggerEl) => {
            const tooltipInstance =
                bootstrap.Tooltip.getInstance(tooltipTriggerEl);
            if (tooltipInstance) {
                tooltipInstance.dispose();
            }
        });
    }
}

// add work schedule logic for add doctors page
document
    .getElementById("add-schedule-btn")
    .addEventListener("click", function () {
        // Clone the first schedule input group
        const scheduleGroup = document.querySelector(".working-schedule");
        const newScheduleGroup = scheduleGroup.cloneNode(true);

        // Clear the input fields in the cloned group
        const inputs = newScheduleGroup.querySelectorAll("input");
        inputs.forEach((input) => {
            input.value = ""; // Clear the values
        });

        // Add a delete button to the new schedule group
        const deleteButton = document.createElement("button");
        deleteButton.type = "button";
        deleteButton.classList.add("btn", "btn-danger", "delete-schedule-btn");
        deleteButton.innerHTML = '<i class="bi bi-trash"></i>';

        // Append the delete button to the new schedule group
        newScheduleGroup.appendChild(deleteButton);

        // Add an event listener to the delete button
        deleteButton.addEventListener("click", function () {
            newScheduleGroup.remove(); // Remove the schedule group when delete is clicked
        });
        console.log(newScheduleGroup);

        // Append the cloned group with the delete button to the container
        document
            .getElementById("working-schedules-container")
            .appendChild(newScheduleGroup);
    });

document.querySelectorAll(".delete-schedule-btn").forEach((button) => {
    button.addEventListener("click", function () {
        this.closest(".d-flex").remove();
    });
});


