function toggleSidebar() {
    const sidebar = document.getElementById("sidebar");
    const tooltipTriggerList = document.querySelectorAll(
        '[data-bs-toggle="tooltip"]'
    );
    sidebar.classList.toggle("collapsed");
    if (sidebar.classList.contains("collapsed")) {
        [...tooltipTriggerList].forEach((tooltipTriggerEl) => {
            new bootstrap.Tooltip(tooltipTriggerEl);
        });
    } else {
        [...tooltipTriggerList].forEach((tooltipTriggerEl) => {
            const tooltipInstance =
                bootstrap.Tooltip.getInstance(tooltipTriggerEl);
            if (tooltipInstance) {
                tooltipInstance.dispose();
            }
        });
    }
}
