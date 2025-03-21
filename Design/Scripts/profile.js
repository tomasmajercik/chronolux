function openSidebar() {
    document.querySelector(".sidebar").classList.toggle("active");
    
    if (sidebar.classList.contains("active")) {
        console.log("Sidebar is now HIDDEN");
    } else {
        console.log("Sidebar is now VISIBLE");
    }
}